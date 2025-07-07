<?php

namespace Tests\Feature;

use App\Models\Form;
use App\Models\Payload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormDesignControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase;

    public function test_can_store_design()
    {

        $form = \App\Models\Form::factory()->create();

        $response = $this->postJson('/api/form-design', [
            'parent_id'    => $form->id,
            'type'         => 'radio_button',
            'label'        => 'Bulan Pelaporan',
            'description'  => 'Pilih bulan pelaporan',
            'orm_only'     => 'no',
            // sub_type, support_file, answer dikirim dalam bentuk string JSON
            'sub_type'     => json_encode([""]),
            'supporting_file' => json_encode([
                'name' => '',
                'value' => ''
            ]),
            'options'      => [
                ['label' => 'Januari'],
                ['label' => 'Februari'],
            ]
        ]);

        // dump($response->json());

        $response->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'Design created successfully.',
            ]);

        $this->assertDatabaseHas('payloads', [
            'parent_id' => $form->id,
            'label' => 'Bulan Pelaporan',
            'type' => 'radio_button',
        ]);
    }

    public function test_can_delete_design()
    {

        // Buat form dan payload
        $form = Form::factory()->create();


        $payload = Payload::create([
            'parent_id' => $form->id,
            'label' => 'Field untuk dihapus',
            'type' => 'text_field',
            'answer' => json_encode(['name' => '', 'value' => '']),
            'support_file' => json_encode(['value' => '', 'name' => '']),
            'orm_only' => 'no',
            'description' => 'Deskripsi',
            'sub_type' => json_encode([]),
        ]);
        // Hapus
        $response = $this->deleteJson("/api/form-design/{$payload->id}");

        // Assert
        $response->assertStatus(204); // No content
        $this->assertSoftDeleted('payloads', ['id' => $payload->id]);
    }
}
