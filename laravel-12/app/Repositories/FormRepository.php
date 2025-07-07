<?php

namespace App\Repositories;

use App\Models\Form;
use App\Repositories\Interfaces\FormRepositoryInterface;

class FormRepository implements FormRepositoryInterface
{
    public function getAllWithRelations()
    {
        return Form::with(['payloads.options', 'payloads.subPayloads'])->get();
    }

    public function getDetailWithRelations($id)
    {
        return Form::with(['payloads.options', 'payloads.subPayloads'])->find($id);
    }

    public function exists($id): bool
    {
        return Form::where('id', $id)->exists();
    }

    public function find($id)
    {
        return Form::find($id);
    }

    public function paginate($limit)
    {
        return Form::orderBy('created_at', 'desc')->paginate($limit);
    }

    public function create(array $data)
    {
        return Form::create($data);
    }

    public function update($id, array $data)
    {
        $form = Form::findOrFail($id);
        $form->update($data);
        return $form;
    }

    public function delete($id)
    {
        $form = Form::findOrFail($id);
        return $form->delete();
    }
}
