<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class AnnuaireController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        $lettre = $request->input('lettre');

        $query = Structure::actives()
            ->withCount(['eservices' => function($q) {
                $q->where('en_ligne', true)->where('actif', true);
            }]);

        if ($type) {
            $query->where('type', $type);
        }

        if ($lettre) {
            $query->where('nom', 'like', $lettre . '%');
        }

        $structures = $query->orderBy('type')
            ->orderBy('ordre')
            ->orderBy('nom')
            ->paginate(20);

        $types = [
            'ministere' => 'Ministères',
            'institution' => 'Institutions',
            'direction' => 'Directions',
            'secretariat' => 'Secrétariats',
            'autre' => 'Autres structures',
        ];

        return view('pages.annuaire.index', compact('structures', 'types', 'type', 'lettre'));
    }

    public function show($slug)
    {
        $structure = Structure::actives()
            ->where('slug', $slug)
            ->with(['enfants' => function($q) {
                $q->where('actif', true)->orderBy('nom');
            }, 'eservices' => function($q) {
                $q->where('en_ligne', true)->where('actif', true);
            }, 'documents' => function($q) {
                $q->where('actif', true)->orderBy('date_signature', 'desc')->limit(5);
            }, 'actualites' => function($q) {
                $q->actives()->publiees()->recentes(3);
            }])
            ->firstOrFail();

        return view('pages.annuaire.show', compact('structure'));
    }

    public function ministere($slug)
    {
        return $this->show($slug);
    }

    public function institution($slug)
    {
        return $this->show($slug);
    }

    public function direction($slug)
    {
        return $this->show($slug);
    }
}
