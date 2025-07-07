<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Option;
use App\Models\Payload;
use App\Services\FormService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{

    public function __construct(private FormService $formService) {}

    public function getFormDinamis()
    {

        $data = $this->formService->getAllWithRelations();
        return response()->json(["data" => $data], 200);
    }

    public function showFormDinamsDetail($id)
    {

        $data = $this->formService->getFormDetail($id);
        return $data
            ? response()->json(['data' => $data])
            : response()->json(['message' => 'Form not found'], 404);
    }


    public function answerForm(Request $request)
    {

        $items = $request->input('items');
        $parentId = $items[0]['parent_id'] ?? null;

        if (!$parentId || !$this->formService->exists($parentId)) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        $this->formService->answerForm($items);

        return response()->json(['message' => 'Answered', 'data' => $items]);
    }


    public function getListForms()
    {
        $data = $this->formService->paginateForms();
        return response()->json(['data' => $data], 200);
    }


    public function showForm($id)
    {
        $form = $this->formService->findForm($id);
        return $form
            ? response()->json(['data' => $form])
            :  response()->json(['message' => 'Form not found'], 404);
    }

    public function storeForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:50|required',
        ]);

        $form = $this->formService->store($validated);
        return response()->json(['message' => 'Form created', 'data' => $form], 201);
    }


    public function updateForm(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'max:50|required',
        ]);

        $updated = $this->formService->update($id, $validated);
        return response()->json(['message' => 'Form updated', 'data' => $updated]);
    }


    public function destroyForm($id)
    {

        $this->formService->delete($id);
        return response()->json(['message' => 'Form deleted'], 204);
    }
}
