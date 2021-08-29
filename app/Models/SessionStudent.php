<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionStudent extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'evaluation_session_id',
        'student_id',
        'note',
    ];

    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EvaluationSession::class,'evaluation_session_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)
            ->withTimestamps()
            ->withPivot(['student_id','user_id']);
    }


}
