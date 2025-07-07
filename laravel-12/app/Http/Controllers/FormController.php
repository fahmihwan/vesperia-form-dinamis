<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Option;
use App\Models\Payload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function getFormDinamis()
    {
        $data = Form::with(['payloads.options', 'payloads.subPayloads'])->get();
        return response()->json([
            "data" => $data
        ], 200);
    }

    public function showFormDinamsDetail($id)
    {

        $data = Form::with(['payloads.options', 'payloads.subPayloads'])->where('id', $id)->first();
        // $data = Form::with(['payloads.options'])->where('id', $id)->get();
        return response()->json([
            "data" => $data
        ], 200);
    }


    public function answerForm(Request $request)
    {

        $items = $request->input('items');

        if (empty($items)) {
            return response()->json(['message' => 'Items not found'], 400);
        }

        $parentId = $items[0]['parent_id'] ?? null;
        if (!$parentId) {
            return response()->json(['message' => 'Parent Not Found'], 400);
        }

        $formExists = Form::where('id', $parentId)->exists();
        if (!$formExists) {
            return response()->json(['message' => 'Form not found'], 404);
        }

        foreach ($items as $item) {
            $fieldId = $item['id'];
            $answer = $item['answer'];


            Payload::where('id', $fieldId)
                ->update([
                    'answer' => $answer,
                ]);
        }

        return response()->json([
            'message' => 'Answered',
            'data' => $request->input('items')
        ], 200); // OK
    }


    public function getListForms()
    {

        return response()->json([
            "data" => Form::orderBy('created_at', 'desc')->paginate(5)
        ], 200);
    }


    public function showForm($id)
    {

        $form = Form::find($id);

        if (!$form) {
            return response()->json([
                'message' => 'Form not found'
            ], 404); // Not Found
        }

        return response()->json([
            'data' => $form
        ], 200);
    }

    public function storeForm(Request $request)
    {

        $validated = $request->validate([
            'name' => 'max:50|required',
        ]);

        return response()->json([
            'message' => 'Form created successfully',
            'data' => Form::create($validated)
        ], 201);
    }


    public function updateForm(Request $request, $id)
    {
        $post = Form::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404); // Not Found
        }

        $validated = $request->validate([
            'name' => 'max:50|required',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post
        ], 200); // OK
    }


    public function destroyForm($id)
    {
        $post = Form::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Form not found'
            ], 404); // Not Found
        }
        $post->delete();

        return response()->json([
            'message' => 'Form deleted successfully'
        ], 204); // No Content (ideal for delete without body)
    }
}
