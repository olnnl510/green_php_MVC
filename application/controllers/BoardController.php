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