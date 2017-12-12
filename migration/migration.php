<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 12.12.2017
 * Time: 22:37
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

function migration()
{
    Capsule::schema()->create('goods', function (Blueprint $table){
        $table->increments('id');
        $table->text('goods_name');
        $table->integer('amount');
        $table->tinyInteger('category_id');
        $table->timestamps();
    });

    Capsule::schema()->create('categories', function (Blueprint $table){
        $table->increments('id');
        $table->text('category_name');
    });
}