<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Value extends Model
{
    /** @use HasFactory<\Database\Factories\ValueFactory> */
    use HasFactory, SoftDeletes;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $incrementing = false;
    protected $keyType = 'string';
}
