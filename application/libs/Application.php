<?php
namespace application\libs;

class Application{
    
    public $controller;
    public $action;

    public function __construct() {
        $getUrl = '';
        if (isset($_GET['url'])) {
            $getUrl = rtrim($_GET['url'], '/'); // /제거
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }        
        $getParams = explode('/', $getUrl); // /기준으로 구분 (배열로 0번방 1번방 2번방... 만들어짐)
        $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board'; // 값이 없다면
        $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) { // $controllers값 : board
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }
        $controllerName = 'application\controllers\\' . $controller . 'controller';        
        new $controllerName($action);                       //board      controller
                            // __construct 생성자함수를 호출한 것(부모에 있는 constroller가 호출됨)
    }
}

// __construct : 생성될 때 밑 내용이 실행됨;

// / 파일찾을때
// \ namespace

// import = include = require