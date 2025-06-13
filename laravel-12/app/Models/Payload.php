<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
class Payload extends Model
{

    use HasFactory, SoftDeletes;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // ← generate UUID
            }
        });
    }
    

    protected $casts = [
        'support_file' => 'array',
        'answer' => 'array',
    ];


    // public function answer()
    // {
        // return $this->belongsTo(Answer::class);
    // }

    public function options()
    {
        return $this->hasMany(Option::class,'parent_id');
    }


    public function subPayloads()
    {
        return $this->hasMany(Payload::class, 'sub_payload_id');
    }

    // Parent dari payload ini
    public function parentPayload()
    {
        return $this->belongsTo(Payload::class, 'sub_payload_id');
    }

}
