<?php

namespace App\Http\Controllers;

use App\Models\EService;
use App\Models\Category;
use Illuminate\Http\Request;

class EServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = EService::query()->active()->ordered();

        $query->when($request->has('category_id') && $request->category_id, function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        $eservices = $query->paginate(12);

        // Fetch only active categories that have active e-services
        $categories = \App\Models\Category::active()
            ->whereHas('eservices', fn($q) => $q->where('is_active', true))
            ->orderBy('order')
            ->get();

        return view('pages.eservices.index', compact('eservices', 'categories'));
    }
}
