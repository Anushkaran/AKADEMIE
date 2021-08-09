<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,'session_student_task')
            ->withTimestamps()
            ->withPivot(['session_student_id','user_id']);
    }

    /**
     * @return BelongsToMany
     */
    public function sessionStudents(): BelongsToMany
    {
        return $this->belongsToMany(SessionStudent::class,'session_student_task')
            ->withTimestamps()
            ->withPivot(['student_id','user_id']);
    }
}
