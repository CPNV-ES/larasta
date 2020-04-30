<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'github_id', 'avatar', 'role'];


    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
