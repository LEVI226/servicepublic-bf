<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Categorie;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = Categorie::where('actif', true)
            ->whereHas('faqs', function($q) {
                $q->where('actif', true);
            })
            ->with(['faqs' => function($q) {
                $q->where('actif', true)->ordonnees();
            }])
            ->orderBy('nom')
            ->get();

        $faqsGenerales = Faq::actives()
            ->whereNull('categorie_id')
            ->ordonnees()
            ->get();

        return view('pages.faq.index', compact('categories', 'faqsGenerales'));
    }
}
