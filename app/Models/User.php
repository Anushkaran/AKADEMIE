<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'image',
        'email',
        'password',
        'department',
        'organization',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'image_url' , 'name'
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' '.$this->last_name;
    }

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->image,'http'))
        {
            return $this->image;
        }

        return $this->image
            ? asset('storage/'.$this->image)
            : asset('assets/vuexy/app-assets/images/defaults/user-default.jpg');
    }

    /**
     * @return BelongsToMany
     */
    public function evaluationSessions(): BelongsToMany
    {
        return $this->belongsToMany(EvaluationSession::class,'evaluation_session_user')->withTimestamps();
    }

    public function thematics(): BelongsToMany
    {
        return $this->belongsToMany(Thematic::class)->withTimestamps();
    }
}
