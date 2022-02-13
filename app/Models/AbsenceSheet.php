<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id'
    ];
}
