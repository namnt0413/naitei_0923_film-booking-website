<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genres::class);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function screenings(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
