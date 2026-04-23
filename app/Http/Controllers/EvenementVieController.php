<?php

namespace App\Http\Controllers;

use App\Models\LifeEvent;

class EvenementVieController extends Controller
{
    public function index()
    {
        $lifeEvents = LifeEvent::withCount('procedures')->active()
            ->ordered()
            ->get();

        return view('pages.evenements.index', compact('lifeEvents'));
    }

    public function show(string $slug)
    {
        $lifeEvent = LifeEvent::where('slug', $slug)
            ->firstOrFail();

        $procedures = $lifeEvent->procedures()->with('category')
            ->active()
            ->get();

        return view('pages.evenements.show', compact('lifeEvent', 'procedures'));
    }
}
