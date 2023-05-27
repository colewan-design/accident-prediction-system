<?php

namespace App\Models;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles(){
        return $this->belongsToMany('App\Models\Role','role_users', 'user_id', 'role_id');
    }
    
    public function scopeNotSelf($query,$id){
        return $query->where('id','!=',$id);
    }

    public function primaryRole(){
        $role = $this->roles()->orderBy('id','asc')->get();
        if($role->count()){
            return $role->first()->role;
        }else{
            return 'Undefine';
        }
    }

    public function isSuperAdmin(){
        $user = Auth::user()->roles->pluck('role');
        if($user->contains('Super-Admin')){
            return true;
        }  
    }

    public function isAdmin(){
        $user = Auth::user()->roles->pluck('role');
        if($user->contains('Admin')){
            return true;
        }  
    }

    public function isUser(){
        $user = Auth::user()->roles->pluck('role');
        if($user->contains('User')){
            return true;
        }  
    }
}
