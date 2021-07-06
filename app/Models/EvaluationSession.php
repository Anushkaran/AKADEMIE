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
        'evaluation_id', 'user_id', 'center_id', 'name', 'date', 'note',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'date' => 'date'
    ];

    /**
     * @return BelongsTo
     */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

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
}
