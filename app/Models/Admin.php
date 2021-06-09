<?php

namespace App\Models;

use App\Notifications\Admin\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @method static create(array $data)
 */
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'role', 'password', 'image'
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

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->image,'http'))
        {
            return $this->image;
        }

        return $this->image
            ? asset('storage/'.$this->image)
            : asset('assets/vuexy/app-assets/images/avatars/12.png');
    }

    public function sendPasswordResetNotification($token) :void
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }


}
