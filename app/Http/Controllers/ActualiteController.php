<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ActualiteController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->published()
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('pages.actualites.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::with('category')->where('slug', $slug)->published()->firstOrFail();
        $relatedArticles = Article::with('category')->published()
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.actualites.show', compact('article', 'relatedArticles'));
    }
}
