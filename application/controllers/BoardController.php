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
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/list.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function detail()
    {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        // print "i_board : {$i_board} <br>";
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute("js", ["board/detail"]); // 끝에 .js 자동으로 붙음
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/detail.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function del()
    {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->delBoard($param));
        return "redirect:/board/list";
    }

    public function mod()
    {
        $i_board = $_GET["i_board"];
        $model = new BoardModel();
        $param = ["i_board" => $i_board];
        $this->addAttribute("data", $model->selBoard($param));
        $this->addAttribute(_TITLE, "수정");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/mod.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function modProc()
    {
        $i_board = $_POST["i_board"];
        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];
        $param = [
            "i_board" => $i_board,
            "title" => $title,
            "ctnt" => $ctnt
        ];
        $model = new BoardModel();
        $model->updBoard($param);
        return "redirect:/board/detail?i_board=${i_board}";
    }

    public function write()
    {   
        $model = new BoardModel();
        $this->addAttribute("title", "글쓰기");
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/write.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        return "template/t1.php";
    }

    public function writeProc() {
        // $i_board = $_GET["i_board"];
        $login_user = $_SESSION[_LOGINUSER];
        $i_user = $login_user->i_user;

        $title = $_POST["title"];
        $ctnt = $_POST["ctnt"];
        
        $param = [
            "i_user" => $i_user,
            "title" => $title,
            "ctnt" => $ctnt
        ];
        $model = new BoardModel();
        $model->insBoard($param);
        return "redirect:/board/list";
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

// 1차주소값 'board' -> BoardController
// 2차주소값 메소드


// CRUD
// UI

//     [_VC]                   [M_C]
// 등록 화면(데이터를 받을) >> 등록 처리

//     [MVC]
// 리스트 화면
//     [MVC]
// 디테일 화면
//      [MVC]                                     [M_C]
// 수정 화면 (데이터 뿌리고, 데이터 받아야 함) >> 수정 처리
//     [M_C]
// 글 삭제 처리


// _ : redirect 리다이렉트