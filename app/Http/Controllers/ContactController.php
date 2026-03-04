<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }

    public function envoyer(ContactRequest $request)
    {
        $validated = $request->validated();

        // Store message in database
        ContactMessage::create($validated);

        // Send email notification to admin
        try {
            Mail::to(config('mail.admin_address', 'contact@servicepublic.gov.bf'))
                ->send(new ContactFormMail($validated));
        } catch (\Exception $e) {
            Log::error('Contact email failed', ['error' => $e->getMessage()]);
            // Don't fail the request if email sending fails — message is already stored in DB
        }

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}

