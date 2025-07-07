<?php

namespace Tests\Feature;

use App\Models\Form;
use App\Models\Payload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_get_list_forms()
    {
        Form::factory()->count(7)->create();

        $response = $this->getJson('/api/forms');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_form()
    {
        $payload = ["name" => 'Form Baryyyu'];

        $response = $this->postJson('/api/form', $payload);
        $response->assertStatus(201)->assertJsonFragment([
            'name' => 'Form Baryyyu'
        ]);
        $this->assertDatabaseHas('forms', ['name' => 'Form Baryyyu']);
    }


    public function test_can_show_single_form()
    {
        $form = Form::factory()->create();

        $response = $this->getJson("/api/forms/{$form->id}");
        $response->assertStatus(200)->assertJsonFragment(['name' => $form->name]);
    }

    public function test_can_update_form()
    {
        $form = Form::factory()->create(['name' => 'Old']);

        $response = $this->putJson("/api/form/{$form->id}", ['name' => 'New']);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New']);

        $this->assertDatabaseHas('forms', ['name' => 'New']);
    }

    public function test_can_delete_form()
    {
        $form = Form::factory()->create();

        $response = $this->deleteJson("/api/form/{$form->id}");

        $response->assertStatus(204);
        // $this->assertDatabaseMissing('forms', ['id' => $form->id]); //delete
        $this->assertSoftDeleted('forms', ['id' => $form->id]); //softDelete
    }



    public function test_can_show_form_dinamis_detail()
    {
        $form = Form::factory()->create();

        $response = $this->getJson("/api/form-dinamis/{$form->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_can_answer_form()
    {

        $form = Form::factory()->create();
        // $payload = Payload::factory()->create(['parent_id' => $form->id]);
        $payloadId = \Illuminate\Support\Str::uuid()->toString();
        $optionId = \Illuminate\Support\Str::uuid()->toString();


        Payload::create([
            "id" => $payloadId,
            'label' => 'Bulan Pelaporan',
            'parent_id' => $form->id,
            'type' => 'radio_button',
            'answer' => [
                "name" => "",
                "value" => [
                    [
                        "id" => $optionId,
                        "value" => "",
                        "parent_id" => $payloadId,
                        "label" => "Januari"
                    ]
                ]
            ],
            'support_file' => [
                'value' => '',
                'name' => ''
            ],
            'orm_only' => 'no',
            'description' => 'Pilih bulan pelaporan',
            'sub_payload_id' => null,
        ]);

        // Lakukan POST ke endpoint
        $response = $this->postJson('/api/form-answer', [
            'items' => [
                [
                    'id' => $payloadId,
                    'answer' => 'Jawaban Tes',
                    'parent_id' => $form->id,
                ]
            ]
        ]);

        // Cek responsenya
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Answered']);
    }
}
