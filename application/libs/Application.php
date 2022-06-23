<?php
namespace application\libs;

class Application{
    
    public $controller;
    public $action;

    public function __construct() { // ☆생성될 때 이 내용이 실행 (생성자)☆
        $getUrl = '';
        if (isset($_GET['url'])) {
            $getUrl = rtrim($_GET['url'], '/'); // /제거
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }        
        $getParams = explode('/', $getUrl); // /기준으로 구분 (배열로 0번방 1번방 2번방... 만들어짐)
        $controller = isset($getParams[0]) && $getParams[0] != '' ? $getParams[0] : 'board'; // 값이 없다면
        $action = isset($getParams[1]) && $getParams[1] != '' ? $getParams[1] : 'index'; // 마지막 주소값(2차 주소값)

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) { // $controllers값 : board
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }
        $controllerName = 'application\controllers\\' . $controller . 'controller'; // 파일명을 문자열로 완성시킨다음에 new~ (결정적으로 BoardController가 됨)  //찍어보면 $controller . 'controller'; : board      controller //
        new $controllerName($action); //생성자함수(__constructor) 호출한것
        // 중간주소값이 board면 BoardController가 객체화 됨.
        //              User면 UserController가 객체화 됨.
        // 이름에 맞춰서 class 파일을 로딩하기 때문에 네이밍규칙 꼭 지켜줘야함 (ex BoardController)

        // $action : 마지막 주소값(2차 주소값) 을 controller 한테 객체 생성할 때 보냄

                            // __construct 생성자함수를 호출한 것(부모에 있는 constroller가 호출됨)
    }
}
    // 로딩할 파일명을 결정.
    // 실제로 파일을 여는것

// __construct : 생성될 때 밑 내용이 실행됨;

// / 파일찾을때
// \ namespace

// import = include = require   

// librery. 셋팅 쪽 담당;


// 1차주소값 : 파일 선택
// 2차주소값 : 메소드 선택