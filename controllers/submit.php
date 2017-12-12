<?php
/**
 * Created by PhpStorm.
 * User: пользователь
 * Date: 26.11.2017
 * Time: 15:52
 */

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use ReCaptcha\ReCaptcha as ReCaptcha;
use Illuminate\Database\QueryException;

class Submit extends MainController
{
    public $name;
    public $email;
    public $ip_address;
    public $phone;
    public $street;
    public $house;
    public $house_block;
    public $apt;
    public $floor;
    public $comment;
    public $need_cashback;
    public $need_callback;
    public $photo;

    public function index() {
        self::setData();
//        $recapt = new ReCaptcha('6LdFjjwUAAAAAAzvTrOi9zRUHMbhH1bQdu45vdrd');
//        $response = $recapt->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
//        if ($response->isSuccess()){
            if (!empty($this->name) && !empty($this->email))
            {
                if (!empty($this->photo['name'])) {
                    self::validateInfo();
                }
                try {
                    // db query
                    $user = User::updateOrCreate(['user_email' => $this->email],
                        ['user_name' => $this->name,'ip_addr' => $this->ip_address,'photo' => $this->photo['name']]);
                    $user_id = $user->id;

                    UserData::create(['user_id' => $user_id,'tel' => $this->phone,'street' => $this->street,
                        'house' => $this->house,'house_block' => $this->house_block,'apt' => $this->apt,'floor' => $this->floor,
                        'comments' => $this->comment,'need_cashback' => $this->need_cashback,
                        'need_callback' => $this->need_callback])->where('user_id','=',$user_id);
                }
                catch (QueryException $e)
                {
                    die("<h2>Ошибка работы с базой данных!</h2>");
                }

                // send email
                $quantity = UserData::where('user_id','=',$user_id)->count();
                $title = 'Заказ бургера.';
                if ($quantity == 1) {
                    $orderInMessage = "Спасибо, это ваш первый заказ!";
                } else {
                    $orderInMessage = "Спасибо! Это уже $quantity заказ.";
                }
                $message = "Ваш заказ будет доставлен по адресу: ул.".$this->street.",".
                    $this->house_block.",".$this->apt.". Заказ: DarkBeefBurger за 500 рублей, 1 шт. ".$orderInMessage;
                $message = wordwrap($message, 70, "\r\n");
                $mailer = new Mailer($this->email,$this->name,$title,$message,$message);
                //$mailer->sendMail();
            }

            $this->view->renderTwig('submit', array('name' => $this->name, 'email' => $this->email));
//        } else {
//            $recapthcaError = "Вы не подтвердили, что вы не робот.";
//            die($recapthcaError);
//        };
    }

    public function update($id = null) {
        self::setData();
        if (!empty($this->photo['name'])) {
            self::validateInfo();
        }
        try {
            // db query
            if (empty($id))
            {
                $user = User::create(['user_email' => $this->email,'user_name' => $this->name,
                    'ip_addr' => $this->ip_address, 'photo' => $this->photo['name']]);

                UserData::create(['user_id' => $user->id,'tel' => $this->phone,'street' => $this->street,
                    'house' => $this->house,'house_block' => $this->house_block,'apt' => $this->apt,
                    'floor' => $this->floor,'comments' => $this->comment,'need_cashback' => $this->need_cashback,
                    'need_callback' => $this->need_callback]);
            }
            else
            {
                UserData::where('id','=',$id)
                    ->update(['tel' => $this->phone,'street' => $this->street,'house' => $this->house,
                        'house_block' => $this->house_block,'apt' => $this->apt,'floor' => $this->floor,
                        'comments' => $this->comment,'need_cashback' => $this->need_cashback,
                        'need_callback' => $this->need_callback]);
                $userData = UserData::where('id','=',$id)
                    ->first()
                    ->toArray();

                User::where('id','=',$userData['user_id'])
                    ->update(['user_email' => $this->email,'user_name' => $this->name,'ip_addr' => $this->ip_address,
                        'photo' => $this->photo['name']]);
            }

            $this->redirect('admin');
        }
        catch (QueryException $e)
        {
            die("<h2>Ошибка работы с базой данных!</h2>");
        }
    }

    public function delete($id)
    {
        UserData::where('id','=',$id)
            ->delete();
        $this->redirect('admin');
    }

    protected function setData()
    {
        $this->name          = htmlspecialchars($_POST["name"]);
        $this->email         = htmlspecialchars($_POST["email"]);
        $this->ip_address    = $_SERVER['REMOTE_ADDR'];
        $this->phone         = htmlspecialchars($_POST["phone"]);
        $this->street        = htmlspecialchars($_POST["street"]);
        $this->house         = htmlspecialchars($_POST["home"]);
        $this->house_block   = htmlspecialchars($_POST["part"]);
        $this->apt           = htmlspecialchars($_POST["appt"]);
        $this->floor         = htmlspecialchars($_POST["floor"]);
        $this->comment       = htmlspecialchars($_POST["comment"]);
        $this->need_cashback = htmlspecialchars($_POST["payment"]);
        $this->need_callback = htmlspecialchars($_POST["callback"]);
        $this->photo         = $_FILES['photo'];
    }

    protected function validateInfo()
    {
        // photo validation
        $fileExtension = strtolower(pathinfo($this->photo['name'],PATHINFO_EXTENSION));
        $validExtension = ['jpg','png','gif','jpeg'];
        $separateExtension = explode('/', $this->photo['type']);

        if (!in_array($fileExtension,$validExtension) ||
            !in_array('image',$separateExtension)) die("<h2>Ошибка: Добавьте изображение с расширением jpg, png, gif, jpeg.</h2>");

        if ($this->photo['error'] !== UPLOAD_ERR_OK) die("<h2>Ошибка загрузки файла.</h2>");

        $uploadMaxSize = self::fileSizeCount(ini_get('upload_max_filesize'));
        $postMaxSize = self::fileSizeCount(ini_get('post_max_size'));
        if ($this->photo['size'] == 0) {
            die("<h2>Файл пустой.</h2>");
        } elseif ($this->photo['size'] > $uploadMaxSize || $this->photo['size'] > $postMaxSize) {
            die("<h2>Загрузите файл меншего размера.</h2>");
        }

        // save photo
        Image::make($this->photo['tmp_name'])
            ->resize(480,480)
            ->save(__DIR__.'./../upload/'.$this->photo['name']);
    }

    protected function fileSizeCount($size) {
        $size = strtoupper(trim($size));
        $length = strlen($size) - 1;

        switch ($size[$length])
        {
            case 'G':
                $size *= 1024;
            case 'M':
                $size *= 1024;
            case 'K':
                $size *= 1024;
        }
        return $size;
    }
}