<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
 
class Form extends Model
{
    /** @use HasFactory<\Database\Factories\FormFactory> */
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // ← generate UUID
            }
        });
    }
    

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function payloads()
    {
        return $this->hasMany(Payload::class,'parent_id');
    }

  
}
