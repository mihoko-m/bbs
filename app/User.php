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
        'provider_id',
        'email_verified_at',
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
    
    public function questions()   
    {
        return $this->hasMany('App\Question');  
    }
    
    public function replies()   
    {
        return $this->hasMany('App\Reply');  
    }
    
    public function favorites()
    {
        return $this->belongsToMany('App\Review')->withTimestamps();
    }
    
    public function getByUser(int $limit_count = 3)
    {
        return $this->reviews()->with('user')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
}
