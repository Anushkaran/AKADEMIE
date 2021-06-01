<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'address', 'longitude' , 'latitude'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'longitude' => 'double',
        'latitude' => 'double',
    ];
}
