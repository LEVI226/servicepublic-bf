<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Notification;
use App\Models\User;
use App\Models\Eservice;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->dashboardAdmin();
        }

        if ($user->isAgent()) {
            return $this->dashboardAgent();
        }

        return $this->dashboardCitoyen();
    }

    private function dashboardCitoyen()
    {
        $user = Auth::user();

        $stats = [
            'demandes_en_cours' => $user->demandes()->enCours()->count(),
            'demandes_terminees' => $user->demandes()->terminees()->count(),
            'notifications_non_lues' => $user->notificationsNonLues()->count(),
        ];

        $demandesRecentes = $user->demandes()
            ->with('eservice')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $notifications = $user->notifications()
            ->recentes(5)
            ->get();

        return view('pages.dashboard.citoyen.index', compact('stats', 'demandesRecentes', 'notifications'));
    }

    private function dashboardAgent()
    {
        $stats = [
            'demandes_en_attente' => Demande::where('statut', 'soumise')->count(),
            'demandes_en_cours' => Demande::where('statut', 'en_cours')->count(),
            'demandes_traitees_aujourdhui' => Demande::where('traite_par', Auth::id())
                ->whereDate('date_traitement', today())
                ->count(),
            'total_demandes' => Demande::count(),
        ];

        $demandesEnAttente = Demande::where('statut', 'soumise')
            ->with(['user', 'eservice'])
            ->orderBy('date_soumission')
            ->limit(10)
            ->get();

        $mesDemandes = Demande::where('traite_par', Auth::id())
            ->with(['user', 'eservice'])
            ->orderBy('date_traitement', 'desc')
            ->limit(10)
            ->get();

        return view('pages.dashboard.agent.index', compact('stats', 'demandesEnAttente', 'mesDemandes'));
    }

    private function dashboardAdmin()
    {
        $stats = [
            'total_citoyens' => User::where('type', 'citoyen')->count(),
            'total_agents' => User::where('type', 'agent')->count(),
            'total_demandes' => Demande::count(),
            'demandes_en_cours' => Demande::enCours()->count(),
            'total_eservices' => Eservice::enLigne()->count(),
            'total_documents' => Document::actifs()->count(),
        ];

        $demandesRecentes = Demande::with(['user', 'eservice'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $nouveauxCitoyens = User::where('type', 'citoyen')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        return view('pages.dashboard.admin.index', compact('stats', 'demandesRecentes', 'nouveauxCitoyens'));
    }

    public function demandes()
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isAgent()) {
            $demandes = Demande::with(['user', 'eservice'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $demandes = $user->demandes()
                ->with('eservice')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('pages.dashboard.demandes.index', compact('demandes'));
    }

    public function showDemande($id)
    {
        $user = Auth::user();

        $demande = Demande::with(['user', 'eservice', 'agent'])->findOrFail($id);

        // Vérifier les permissions
        if (!$user->isAdmin() && !$user->isAgent() && $demande->user_id !== $user->id) {
            abort(403, 'Vous n\'êtes pas autorisé à voir cette demande.');
        }

        return view('pages.dashboard.demandes.show', compact('demande'));
    }

    public function updateDemande(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isAgent()) {
            abort(403);
        }

        $demande = Demande::findOrFail($id);

        $validated = $request->validate([
            'statut' => 'required|in:brouillon,soumise,en_cours,en_attente,traitee,rejetee,annulee',
            'commentaire' => 'nullable|string|max:5000',
            'date_rendez_vous' => 'nullable|date',
            'lieu_rendez_vous' => 'nullable|string|max:255',
        ]);

        $ancienStatut = $demande->statut;

        $demande->update([
            'statut' => $validated['statut'],
            'commentaire' => $validated['commentaire'],
            'traite_par' => $user->id,
            'date_traitement' => now(),
            'date_rendez_vous' => $validated['date_rendez_vous'],
            'lieu_rendez_vous' => $validated['lieu_rendez_vous'],
        ]);

        // Notifier le citoyen
        if ($ancienStatut !== $validated['statut']) {
            Notification::create([
                'user_id' => $demande->user_id,
                'titre' => 'Mise à jour de votre demande',
                'message' => "Votre demande \"{$demande->eservice->nom}\" est maintenant : {$demande->statut_label}",
                'type' => $this->getNotificationType($validated['statut']),
                'lien' => route('dashboard.demandes.show', $demande->id),
            ]);
        }

        return back()->with('success', 'La demande a été mise à jour avec succès.');
    }

    private function getNotificationType($statut): string
    {
        return match($statut) {
            'traitee' => 'success',
            'rejetee' => 'danger',
            'en_attente' => 'warning',
            default => 'info',
        };
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Marquer comme lues
        Auth::user()->notificationsNonLues()->update([
            'lu' => true,
            'date_lecture' => now(),
        ]);

        return view('pages.dashboard.notifications', compact('notifications'));
    }
}
