<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }
}
