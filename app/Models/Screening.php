<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;

    protected $table = 'films';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
