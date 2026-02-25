<?php

namespace App\Filament\Pages;

use App\Services\DataImportService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;

class ImportData extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?string $navigationLabel = 'Import de données';
    protected static ?string $navigationGroup = 'Outils & Médias';
    protected static ?int $navigationSort = 100;
    protected static ?string $title = 'Import de données en masse';
    protected static string $view = 'filament.pages.import-data';

    // State
    public ?string $uploadedFile = null;
    public ?string $selectedImporter = null;
    public ?array $jsonData = null;
    public ?array $analysis = null;
    public ?array $importReport = null;
    public string $step = 'upload'; // upload → preview → result

    public function form(Form $form): Form
    {
        $service = new DataImportService();

        return $form->schema([
            FileUpload::make('uploadedFile')
                ->label('Fichier JSON')
                ->acceptedFileTypes(['application/json'])
                ->directory('imports')
                ->maxSize(50 * 1024) // 50MB max
                ->helperText('Formats acceptés : .json (catégories, procédures, e-services, organismes, événements de vie)')
                ->reactive()
                ->visible(fn () => $this->step === 'upload'),

            Select::make('selectedImporter')
                ->label('Type de données (auto-détecté)')
                ->options($service->availableImporters())
                ->helperText('Le type est détecté automatiquement. Changez-le uniquement si la détection est incorrecte.')
                ->reactive()
                ->visible(fn () => $this->step === 'preview'),
        ]);
    }

    /**
     * Appelé quand l'utilisateur uploade un fichier.
     */
    public function analyzeFile(): void
    {
        if (!$this->uploadedFile) {
            Notification::make()->title('Aucun fichier sélectionné')->danger()->send();
            return;
        }

        try {
            $path = Storage::disk('public')->path($this->uploadedFile);
            $content = file_get_contents($path);
            $this->jsonData = json_decode($content, true);

            if (!$this->jsonData || !is_array($this->jsonData)) {
                Notification::make()->title('Fichier JSON invalide')->danger()->send();
                return;
            }

            // Auto-détection du type
            $service = new DataImportService();
            $detectedClass = $service->detect($this->jsonData);

            if ($detectedClass) {
                $this->selectedImporter = $detectedClass;
                $this->analysis = $service->analyze($detectedClass, $this->jsonData);
                $this->step = 'preview';

                Notification::make()
                    ->title("Type détecté : " . $detectedClass::label())
                    ->body(count($this->jsonData) . " enregistrements trouvés")
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Type de données non reconnu')
                    ->body('Sélectionnez manuellement le type ci-dessous.')
                    ->warning()
                    ->send();
                $this->step = 'preview';
            }
        } catch (\Exception $e) {
            Notification::make()->title('Erreur: ' . $e->getMessage())->danger()->send();
        }
    }

    /**
     * Re-analyser avec un importer différent.
     */
    public function reAnalyze(): void
    {
        if (!$this->jsonData || !$this->selectedImporter) return;

        $service = new DataImportService();
        $this->analysis = $service->analyze($this->selectedImporter, $this->jsonData);
    }

    /**
     * Lancer l'import.
     */
    public function executeImport(): void
    {
        if (!$this->jsonData || !$this->selectedImporter) {
            Notification::make()->title('Aucune donnée à importer')->danger()->send();
            return;
        }

        try {
            $service = new DataImportService();
            $this->importReport = $service->import($this->selectedImporter, $this->jsonData);
            $this->step = 'result';

            $total = ($this->importReport['created'] ?? 0) + ($this->importReport['updated'] ?? 0);
            Notification::make()
                ->title("Import terminé : {$total} enregistrements traités")
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()->title('Erreur import: ' . $e->getMessage())->danger()->send();
        }
    }

    /**
     * Reset pour un nouvel import.
     */
    public function resetImport(): void
    {
        $this->uploadedFile = null;
        $this->selectedImporter = null;
        $this->jsonData = null;
        $this->analysis = null;
        $this->importReport = null;
        $this->step = 'upload';
    }
}
