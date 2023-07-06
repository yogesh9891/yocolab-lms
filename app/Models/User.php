<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\User;

class User extends Authenticatable implements MustVerifyEmail,JWTSubject 
{
    use HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
         'facebook_id',
         'google_id',
    
    ];

    protected $dates = ['two_factor_expires_at'];

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

        // Relationship tying a virtual class to a user (teacher in our case)

    public function myClass() {
        return $this->hasOne(VideoClass::class);
    }

    public function getCreatedAtAttribute($value) 
     {      
        $timezone = optional(auth()->user())->timezone ?? config('app.timezone');
        return Carbon::parse($value)->timezone($timezone);
     }

//      public function sendEmailVerificationNotification()
// {
//     $this->notify(new VerifyEmailNotification());
// }

public function sendPasswordResetNotification($token)
{
    $this->notify(new PasswordReset($token));
}


public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    } 


     public function cart()
    {
        return $this->belongsTo(Cart::class);
    }


}
