<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users_login';
    protected $fillable = ['user_name', 'user_email', 'ip_addr', 'photo'];
    public $timestamps = false;
}