<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address','partner_id'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function scopePerPartner($query,$partner_id)
    {
        return $query->where('partner_id',$partner_id);
    }

    /**
     * @return BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class,'session_student_task')
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
            ->withPivot(['task_id','user_id']);
    }

}
