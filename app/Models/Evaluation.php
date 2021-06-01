<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'start_date', 'end_date',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
