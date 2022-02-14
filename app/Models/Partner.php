<?php

namespace App\Models;

use App\Notifications\Partner\PartnerResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Partner extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'leader',
        'department',
        'state',
        'pedagogical_referent',
        'legal_referent',
        'legal_referent_phone',
        'administrative_referent',
        'administrative_referent_phone',
        'password',
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
        'avatar_name'
    ];

    public function getAvatarNameAttribute()
    {
        return ucwords(Str::substr($this->name,0,1));
    }

    public function isActive()
    {
        return $this->state === 1;
    }

    /**
     * @return HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }


    public function sendPasswordResetNotification($token) :void
    {
        $this->notify(new PartnerResetPasswordNotification($token));
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function resources(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Resource::class)->withTimestamps();
    }

    public function settingSheet()
    {
        return $this->hasOne(PartnerSheetSetting::class);
    }
}
