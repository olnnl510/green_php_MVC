<?php
namespace application\libs;

class Application{
    
    public $controller;
    public $action;

    public function __construct() {
        $getUrl = '';
        if (isset($_GET['url'])) {
            $getUrl = rtrim($_GET['url'], '/');
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }        
        $getParams = explode('/', $getUrl);
        $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board';
        $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }
        $controllerName = 'application\controllers\\' . $controller . 'controller';        
        new $controllerName($action);                       //board      controller
                            // __construct 생성자함수를 호출한 것(부모에 있는 constroller가 호출됨)
    }
}

// __construct : 생성될 때 밑 내용이 실행됨