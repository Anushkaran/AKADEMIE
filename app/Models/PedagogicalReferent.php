<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedagogicalReferent extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'email',
    ];

    public function partner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Partner::class)->withDefault([
            'id' => 'undefined',
            'name' => 'none',
            'phone' => 'none',
            'email' => 'none',
            'leader' => 'none',
        ]);
    }
}
