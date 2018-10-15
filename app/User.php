<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * Indexes here may be updated without directly updating the model
     *
     * @var array
     */
    protected $fillable = ['forename', 'surname', 'email', 'password'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin() {
        return $this->admin;
    }

    public function shortcuts() {
        return $this->hasMany('\App\UserShortcut');
    }

    public function departments() {
        return $this->belongsToMany('\App\Department');
    }

}
