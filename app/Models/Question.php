<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

/**
 * @property mixed $id
 */
class Question extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $casts = [
        'draft' => 'boolean',
    ];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function createdBy(): belongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
