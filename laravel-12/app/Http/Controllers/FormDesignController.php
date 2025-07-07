<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Option;
use App\Models\Payload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormDesignController extends Controller
{
    public function storeDesign(Request $request)
    {


        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'parent_id' => 'required',
                'type' => 'required|string',
                'label' => 'required|string',
                'description' => 'required|string',
                'orm_only' => 'required|in:yes,no',
                // 'sub_type' => 'required',
                // 'support_file' => 'required'
            ]);

            $form = Form::find($validated['parent_id']);

            if (!$form) {
                return response()->json([
                    'message' => 'Parent form not found.'
                ], 404);
            }

            $validated['sub_type'] = [""];
            if (isset($request->sub_type)) {
                $validated['sub_type'] = $request->sub_type;
            }

            if (isset($request->supporting_file)) {
                $validated['supporting_file'] = $request->supporting_file;
            } else {
                $validated['supporting_file'] = [
                    "name" => '',
                    "value" => ''
                ];
            }

            $validated['answer'] = [
                "name" => '',
                "value" => ''
            ];

            $payload =  Payload::create([
                "type" => $validated['type'],
                "answer" => $validated['answer'],
                "parent_id" => $form->id,
                "label" => $validated['label'],
                'description' => $validated['description'],
                'orm_only' => $validated['orm_only'],
                'sub_type' => $validated['sub_type'],
                'supporting_file' => $validated['supporting_file']
            ]);


            if (isset($request->options)) {

                $arr = [];
                foreach ($request->options as $i => $opt) {
                    $arr[$i]['value'] =  '';
                    $arr[$i]['parent_id'] = $payload->id;
                    $arr[$i]['label'] = $opt['label'];
                }

                $payload->options()->createMany($arr);
            }


            DB::commit();

            return response()->json([
                'message' => 'Design created successfully.',
                "data" => $request->all()
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to store design.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function deleteDesign($id)
    {
        // $payload = Payload::find($id);
        // return response()->json([
        //     'message' => $payload->id
        // ], 200);

        try {
            $payload = Payload::find($id);

            if (!$payload) {
                return response()->json([
                    'message' => 'Parent form not found.'
                ], 404);
            }

            // $opt = Option::where('parent_id', $payload->id)->exists();
            // if ($opt) {
            //     Option::where('parent_id', $payload->id)->delete();
            // };


            $payload->delete();
            // Payload::delete($payload->id);
            DB::commit();

            return response()->json([
                'message' => 'Design deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
