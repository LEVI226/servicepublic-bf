<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\EService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckEservicesHealth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eservices:health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie la santé des URL des e-services et désactive ceux qui échouent 3 fois de suite';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eservices = EService::active()->get();
        $this->info("Vérification de " . $eservices->count() . " e-services...");

        foreach ($eservices as $eservice) {
            // On ne vérifie que les URL externes
            if (!filter_var($eservice->url, FILTER_VALIDATE_URL) || str_contains($eservice->url, 'localhost')) {
                continue;
            }

            try {
                $response = Http::timeout(15)->get($eservice->url);
                
                if ($response->successful()) {
                    $eservice->update(['fail_count' => 0, 'is_online' => true]);
                } else {
                    $this->markAsFailed($eservice, "Statut HTTP: " . $response->status());
                }
            } catch (\Exception $e) {
                $this->markAsFailed($eservice, "Erreur: " . $e->getMessage());
            }
        }

        $this->info("Vérification terminée.");
    }

    /**
     * Gère l'échec d'une vérification
     */
    protected function markAsFailed(EService $eservice, $reason)
    {
        $eservice->increment('fail_count');
        
        if ($eservice->fail_count >= 3) {
            $eservice->update(['is_online' => false]);
            Log::warning("E-service '{$eservice->title}' [ID: {$eservice->id}] est hors ligne après 3 échecs consécutifs. Raison: {$reason}");
        }
        
        $this->error("Échec pour '{$eservice->title}': {$reason} (Compteur: {$eservice->fail_count}/3)");
    }
}
