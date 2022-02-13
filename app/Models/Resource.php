<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'link',
        'access',
    ];

    protected $appends = [
        'full_link'
    ];

    public function getFullLinkAttribute()
    {
        if (Str::contains($this->link,'HTTP'))
        {
            return $this->link;
        }

        return  $this->link ? asset('storage/'.$this->link) : '';
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ResourceCategory::class,'resource_resource_category')->withTimestamps();
    }

    public function partners(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Partner::class)->withTimestamps();
    }
}
