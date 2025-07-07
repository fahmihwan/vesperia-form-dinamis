<?php
// PayloadRepository.php
namespace App\Repositories;

use App\Models\Payload;
use App\Repositories\Interfaces\PayloadRepositoryInterface;

class PayloadRepository implements PayloadRepositoryInterface
{
    public function updateAnswer($id, $answer)
    {
        return Payload::where('id', $id)->update(['answer' => $answer]);
    }

    public function create(array $data): Payload
    {
        return Payload::create($data);
    }

    public function find($id): ?Payload
    {
        return Payload::find($id);
    }
}
