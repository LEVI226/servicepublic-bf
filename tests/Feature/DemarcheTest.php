<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\Procedure;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DemarcheTest extends TestCase
{
    use RefreshDatabase;

    public function test_demarche_index_loads(): void
    {
        $response = $this->get(route('demarches.index'));
        $response->assertStatus(200);
    }

    public function test_download_returns_404_for_unknown_slug(): void
    {
        $response = $this->get(route('demarches.download', 'slug-inexistant'));
        $response->assertStatus(404);
    }

    public function test_download_returns_file_for_valid_slug(): void
    {
        Storage::fake('public');
        
        $category = Category::create([
            'name' => 'Ma Catégorie',
            'slug' => 'ma-categorie',
            'is_active' => true,
        ]);

        $procedure = Procedure::create([
            'category_id' => $category->id,
            'title' => 'Ma Procédure',
            'slug' => 'ma-procedure',
            'description' => 'Description de test',
            'is_active' => true,
            'is_free' => true,
        ]);
        
        $document = Document::create([
            'procedure_id' => $procedure->id,
            'title' => 'Test Document',
            'slug' => 'test-document',
            'file_path' => 'documents/test.pdf',
        ]);

        Storage::disk('public')->put('documents/test.pdf', 'fake content');

        $response = $this->get(route('demarches.download', $document->slug));

        $response->assertStatus(200);
        $this->assertEquals(1, $document->fresh()->downloads_count);
    }
}
