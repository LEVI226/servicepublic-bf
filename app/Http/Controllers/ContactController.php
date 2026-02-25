<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }

    public function envoyer(ContactRequest $request)
    {
        $validated = $request->validated();

        // TODO: Envoyer l'email ou stocker en base
        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
