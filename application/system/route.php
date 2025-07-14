<?php
include "application/db.php";

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        
        // Получаем путь без параметров
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = explode('/', trim($uri, '/'));
        
        // Получаем имя контроллера
        if (!empty($routes[0])) {
            $controller_name = $routes[0];
        }
        
        // Получаем имя экшена
        if (!empty($routes[1])) {
            $action_name = $routes[1];
        }

        // Для AJAX-запросов
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Специальные обработчики для AJAX
            if ($controller_name === 'Main' && $action_name === 'update_task_status') {
                self::handleAjaxRequest($controller_name, 'update_task_status');
                return;
            }
            
            if ($controller_name === 'Main' && $action_name === 'update_subtusk_status') {
                self::handleAjaxRequest($controller_name, 'update_subtusk_status');
                return;
            }
        }

        // добавляем префиксы
        $model_name = $controller_name.'_model';
        $controller_name = $controller_name.'_controller';
        $action_name = 'action_'.$action_name;

        // Подключаем модель, если существует
        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if (file_exists($model_path)) {
            include $model_path;
        }

        // Подключаем контроллер
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if (file_exists($controller_path)) {
            include $controller_path;
        } else {
            Route::ErrorPage404();
            return;
        }
        
        // Создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }
    
    private static function handleAjaxRequest($controller_name, $action_name)
    {
        // добавляем префиксы
        $controller_name = $controller_name.'_controller';
        $action_name = 'action_'.$action_name;

        // Подключаем контроллер
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        
        if (file_exists($controller_path)) {
            include $controller_path;
            $controller = new $controller_name;
            
            if (method_exists($controller, $action_name)) {
                $controller->$action_name();
                return;
            }
        }
        
        // Если что-то пошло не так
        header('Content-Type: application/json');
        echo json_encode(['result' => 0, 'message' => 'Invalid request']);
    }
    
    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}

class sys {
    static $PDO;
}