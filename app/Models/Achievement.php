<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Achievement extends MorphPivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'task',
    ];

    protected $table = 'achievements';

    public function scopeNextAchievement($query, $attributes = null)
    {
        $query->when($attributes['type'] ?? false, function ($query, $type) {
            $query->where('type', $type);
        });
        $query->when($attributes['achievements'] ?? false, function ($query, $achievements) {
            $query->whereNotIn('name', $achievements->pluck('name'));
        });
    }
}
