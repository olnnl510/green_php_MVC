<?php

namespace application\controllers;

use application\models\BoardModel;

// use application\controllers\Controller; // 같은 namespace면 굳이 use 적어줄 필요 없음

class BoardController extends Controller // extends 상속
{
    public function list()
    {
        $model = new BoardModel();
        // $this->list = $model->selBoardList();
        $this->addAttribute("title", "리스트");
        $this->addAttribute("list", $model->selBoardList());
        $this->addAttribute("js", ["board/list"]); // 끝에 .js 자동으로 붙음
        return 'board/list.php'; //view 파일명. 문자열 리턴
    }

    public function detail() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        // print "i_board : {$i_board} <br>";
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute("js", ["board/detail"]); // 끝에 .js 자동으로 붙음
        return "board/detail.php";
    }

    public function del() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->delBoard($param));
        return "redirect:/board/list";
    }

    public function mod() {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));

        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }

}


// 네이밍규칙 중요. 네이밍에따라 class 파일을 로딩함

// 모델 : DB
// 뷰 : html, css, javascript
// 컨트롤러 : 모델-뷰 다리역할

// MCV : model-view-controller

// 쌤 프레임워크 : 파일선택/메소드선택 (최소 2차 주소 까지는 있어야함)


// 모델 : 데이터베이스와 관련!
// DAO data access object

// BoardController에서
// $this->addAttribute("list", $model->selBoardList());

// BoardModel에서
// selBoardList 실행
// 쿼리문이 실행돼서
// 받아온 iboard~~~~것들을
// 배열에 담아서

// list.php에서 뿌려줌