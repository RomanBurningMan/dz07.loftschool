<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 11.12.2017
 * Time: 14:45
 */

namespace App;

class Admin extends MainController
{
    public function index()
    {
        $user_data = array('data' => $this->model->getOrders());

        $this->view->renderTwig('admin', $user_data);
    }

    public function edit($id)
    {
        $data          = array('customer' => UserData::where('id','=',$id)->first()->toArray());
        $data['user']  = User::where('id','=',$data['customer']['user_id'])->first()->toArray();
        $data['title'] = 'Редактировать пользователя';

        $this->view->renderTwig('edit', $data);
    }

    public function create()
    {
        $data = array('title' => 'Добавить пользователя');

        $this->view->renderTwig('edit', $data);
    }
}