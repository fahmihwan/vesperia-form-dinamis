<?php

namespace App\Repositories\Interfaces;


interface FormRepositoryInterface
{
    public function getAllWithRelations();
    public function getDetailWithRelations($id);
    public function exists($id): bool;
    public function paginate($limit);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
