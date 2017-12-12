<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 05.12.2017
 * Time: 22:30
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'customer_data';
    protected $fillable = ['user_id','tel','street',
        'house','house_block','apt','floor','comments','need_cashback',
        'need_callback'];
}