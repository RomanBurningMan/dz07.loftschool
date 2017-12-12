<?php
require_once "./vendor/autoload.php";
require_once "./mailer.php";

require_once "./core/MainController.php";
require_once "./core/MainModel.php";
require_once "./core/view.php";

require_once "./models/user.php";
require_once "./models/userData.php";

$routes = explode('/', $_SERVER['REQUEST_URI']);
$controller_name = "Main";
$action_name = 'index';
// получаем контроллер
if (!empty($routes[1]))
{
    $controller_name = $routes[1];
}

// получаем действие
if (!empty($routes[2]))
{
    $action_name = $routes[2];
}

$filename = "controllers/".strtolower($controller_name).".php";

try {
    if (file_exists($filename))
    {
        require_once $filename;
    } else {
        throw new Exception("File not found");
    }

    $classname = '\App\\'.ucfirst($controller_name);

    if (class_exists($classname))
    {
        $controller = new $classname();
    } else {
        throw new Exception("File found but class not found");
    }

    if (method_exists($controller, $action_name)) {

        if(isset($routes[3]))
        {
            $controller->$action_name($routes[3]);
        }
        else {
            $controller->$action_name();
        }
    } else {
        throw new Exception("Method not found");
    }
} catch (Exception $e) {
    echo $e->getMessage()."<br>";
    require "errors/404.php";
}

//router + controller + model

