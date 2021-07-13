<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Evaluation extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'start_date', 'end_date','partner_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withTimestamps()
            ->withPivot('is_canceled');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class)
            ->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(EvaluationSession::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
