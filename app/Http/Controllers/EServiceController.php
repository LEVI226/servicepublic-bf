<?php

namespace App\Http\Controllers;

use App\Models\Eservice;

class EServiceController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Eservice::active()->ordered();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $eservices = $query->paginate(12)->appends($request->query());
        $categories = \App\Models\Category::has('eservices')->orderBy('name')->get();

        return view('pages.eservices.index', compact('eservices', 'categories'));
    }
}
