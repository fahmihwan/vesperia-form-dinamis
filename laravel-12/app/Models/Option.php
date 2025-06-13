<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Option extends Model
{

    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // ← generate UUID
            }
        });
    }
    public function payload()
    {
        return $this->belongsTo(Payload::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    
}
