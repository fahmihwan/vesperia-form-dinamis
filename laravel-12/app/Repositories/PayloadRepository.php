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
}
