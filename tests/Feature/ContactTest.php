<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_loads(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
        $response->assertSee('Nous contacter');
    }

    public function test_contact_stores_message_in_database(): void
    {
        $this->withoutMiddleware();

        $contactData = [
            'nom' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'sujet' => 'Demande d\'information',
            'message' => 'Ceci est un message de test.',
        ];

        $response = $this->post(route('contact.envoyer'), $contactData);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', $contactData);
    }

    public function test_contact_validation_fails_with_missing_fields(): void
    {
        $this->withoutMiddleware();

        $response = $this->postJson(route('contact.envoyer'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['nom', 'email', 'sujet', 'message']);
    }
}
