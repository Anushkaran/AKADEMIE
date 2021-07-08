<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'skill_id', 'name', 'description',
    ];

    /**
     * @return BelongsTo
     */
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
