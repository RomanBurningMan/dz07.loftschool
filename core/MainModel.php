<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 29.11.2017
 * Time: 23:40
 */

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

class MainModel
{
    protected $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'test1',
            'username'  => 'mysql',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function getOrders() {
        return $this->capsule
            ->table('customer_data')
            ->select('*','customer_data.id as customer_id')
            ->leftJoin('users_login','customer_data.user_id','=','users_login.id')
            ->get();
    }
}