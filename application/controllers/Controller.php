<?php
namespace application\controllers;

abstract class Controller {
    public function __construct($action) { // 얘가 호출이 됨. 객체 생성자호출 -> 값없음 -> 부모의 생성자 들고옴. 그것이 바로 이 아이
        $view = $this->$action(); // $view로 넘어오는것 : board/list.php 문자열
        require_once $this->getView($view); // 해줬기 때문에 BoardController.php 에 list가 뜨는거임 (화면에 뿌릴 친구 require)
    }
    
    protected function addAttribute($key, $val) {
        $this->$key = $val;
    }

    protected function getView($view) {
        if(strpos($view, "redirect:") === 0) {
            header("Location: http://" . _HOST . substr($view, 9));
        }
        return _VIEW . "/" . $view; // 실제 열어야 할 파일명 리턴
    }       // 상수
}