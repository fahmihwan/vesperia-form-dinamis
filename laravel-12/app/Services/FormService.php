<?php

namespace App\Services;


use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\PayloadRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FormService
{

    public function __construct(
        private FormRepositoryInterface $formRepo,
        private PayloadRepositoryInterface $payloadRepo
    ) {}

    public function getAllWithRelations()
    {
        return $this->formRepo->getAllWithRelations();
    }


    public function getFormDetail($id)
    {
        return $this->formRepo->getDetailWithRelations($id);
    }

    public function answerForm(array $items)
    {
        DB::transaction(function () use ($items) {

            foreach ($items as $item) {
                $this->payloadRepo->updateAnswer($item['id'], $item['answer']);
            }
        });

        return true;
    }

    public function paginateForms($limit = 5)
    {
        return $this->formRepo->paginate($limit);
    }

    public function show($id)
    {
        return $this->formRepo->find($id);
    }

    public function store(array $data)
    {
        return $this->formRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->formRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->formRepo->delete($id);
    }

    public function exists($id): bool
    {
        return $this->formRepo->exists($id);
    }

    public function findForm($id)
    {
        return $this->formRepo->find($id);
    }
}
