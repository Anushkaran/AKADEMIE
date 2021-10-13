<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EvaluationSession extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'evaluation_id', 'name', 'date', 'note' , 'is_final'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'date' => 'date',
        'is_final' => 'boolean',
    ];



    /**
     * @return BelongsTo
     */
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'Evaluation_session_user')->withTimestamps();
    }

    public function students(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Student::class,Evaluation::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
