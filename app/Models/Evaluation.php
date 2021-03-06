<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'name', 'start_date', 'end_date','partner_id','center_id','state','date_exam','type'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'date_exam'   => 'date',
        'state' => 'boolean'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withTimestamps()
            ->withPivot('is_canceled');
    }

    public function scopeActive($q)
    {
        return $q->where('state',true);
    }

    /**
     * @return BelongsTo
     */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
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

    public function finalSession()
    {
        return $this->sessions()->where('is_final',true);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function referents(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PedagogicalReferent::class)->withTimestamps();
    }
}
