<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationSession extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'evaluation_id', 'user_id', 'name', 'date', 'note','state'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'state' => 'boolean',
        'date' => 'date',
    ];



    /**
     * @return BelongsTo
     */
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class,Evaluation::class);
    }
}
