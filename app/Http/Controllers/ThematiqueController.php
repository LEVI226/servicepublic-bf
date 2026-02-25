<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Procedure;

class ThematiqueController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->has('procedures')
            ->ordered()
            ->withCount('procedures')
            ->with(['subcategories' => fn($q) => $q->active()->withCount('procedures')])
            ->get();

        return view('pages.thematiques.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $subcategories = $category->subcategories()
            ->active()
            ->withCount('procedures')
            ->orderBy('order')
            ->get();

        $procedures = Procedure::with('category')->active()
            ->where('category_id', $category->id)
            ->orderBy('title')
            ->paginate(20);

        $breadcrumb = [
            ['name' => 'Accueil', 'url' => route('home')],
            ['name' => 'Fiches par thème', 'url' => route('thematiques.index')],
            ['name' => $category->name, 'url' => null],
        ];

        return view('pages.thematiques.show', compact(
            'category', 'subcategories', 'procedures', 'breadcrumb'
        ));
    }
}
