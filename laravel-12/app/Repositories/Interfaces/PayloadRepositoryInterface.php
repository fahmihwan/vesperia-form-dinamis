<?php

// PayloadRepositoryInterface.php
namespace App\Repositories\Interfaces;

interface PayloadRepositoryInterface
{
    public function updateAnswer($id, $answer);
    public function create(array $data);
    public function find($id);
}
