<?php
namespace application\controllers; // namespace 를 주지 않으면 파일 경로로 찾아야함!

include_once "application\utils/SessionUtils.php";

abstract class Controller {
    public function __construct($action) { // 얘가 호출이 됨. 객체 생성자호출 -> 값없음 -> 부모의 생성자 들고옴. 그것이 바로 이 아이 ($action : 2차주소값 을 여기로 보냄.)
        $view = $this->$action(); // $view로 넘어오는것 : board/list.php 문자열
        // this 나 자신에 접근하여 -> $action 문자열 함수를 호출하자 ( list 메소드를 호출하자 ) : BoardController의 function list 가 호출됨. 문자열(board/list.php)이 리턴됨. $view로 넘어감
        require_once $this->getView($view); // 해줬기 때문에 BoardController.php 에 list가 뜨는거임 (화면에 뿌릴 친구 require) (view/board/list.php 파일 소스가 BoardControlloer에 추가 됐다고 생각하면 편함)
        // this 내가 가지고 있는 -> getView 라는 함수를 호출.
    }
    
    protected function addAttribute($key, $val) {
        $this->$key = $val;
    }

    protected function getView($view) { // $view 값(board/list.php 라는 문자열)을 보냄
        if(strpos($view, "redirect:") === 0) {
            header("Location: " . substr($view, 9));
            return;
        }
        return _VIEW . "/" . $view; // 실제 열어야 할 파일명 리턴
    }       // 상수
}