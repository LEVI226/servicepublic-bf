<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Category;
use App\Models\Article;

class SitemapController extends Controller
{
    public function index()
    {
        $procedures = Procedure::active()->select('slug', 'category_id', 'updated_at')->with('category:id,slug')->get();
        $categories = Category::active()->select('slug', 'updated_at')->get();
        $articles = Article::published()->select('slug', 'updated_at')->get();

        return response()
            ->view('sitemap', compact('procedures', 'categories', 'articles'))
            ->header('Content-Type', 'text/xml');
    }
}
