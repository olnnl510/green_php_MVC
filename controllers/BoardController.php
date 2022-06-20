<?php

namespace application\controllers;

use application\models\BoardModel;

// use application\controllers\Controller; // 같은 namespace면 굳이 use 적어줄 필요 없음

class BoardController extends Controller // extends 상속
{
    public function list()
    {
        $model = new BoardModel();
        $this->list = $model->selBoardList();
        // $this->addAttribute("list", $model->selBoardList());
        return 'board/list.php'; //view 파일명
    }
}


// 네이밍규칙 중요. 네이밍에따라 class 파일을 로딩함

// 모델 : DB
// 뷰 : html, css, javascript
// 컨트롤러 : 모델-뷰 다리역할

// MCV : model-view-controller

// 쌤 프레임워크 : 파일선택/메소드선택 (최소 2차 주소 까지는 있어야함)