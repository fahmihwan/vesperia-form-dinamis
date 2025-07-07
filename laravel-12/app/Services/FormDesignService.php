<?php

namespace App\Services;


use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\PayloadRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FormDesignService
{

    public function __construct(
        private FormRepositoryInterface $formRepo,
        private PayloadRepositoryInterface $payloadRepo
    ) {}

    public function storeDesign(array $data)
    {
        return DB::transaction(function () use ($data) {
            // $form = $this->formRepo->find($data['parent_id']);
            // if (!$form) {
            //     return false;
            // }
            $payload = $this->payloadRepo->create($data);


            if (!empty($data['options'])) {
                $options = array_map(function ($opt) use ($payload) {
                    return [
                        'parent_id' => $payload->id,
                        'label' => $opt['label'],
                        'value' => ''
                    ];
                }, $data['options']);

                $payload->options()->createMany($options);
            }

            return $payload;
        });
    }

    public function deleteDesign($id)
    {
        return DB::transaction(function () use ($id) {
            $payload = $this->payloadRepo->find($id);
            $payload->delete();
        });
    }
}
