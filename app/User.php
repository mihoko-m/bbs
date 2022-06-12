<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'faculty_id',
        'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }
    
    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }
    
    public function reviews()   
    {
        return $this->hasMany('App\Review');  
    }
    
    public function getByUser(int $limit_count = 3)
    {
        return $this->reviews()->with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
