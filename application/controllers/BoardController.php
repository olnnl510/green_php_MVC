<?php

namespace application\controllers; // namespace : 같은 이름의 클래스가 "하나의 프로그램 안"에 공존하는 방법을 할 수 있음
// 여기서는 / 슬래시 못씀. 경로가 아니라 이름임! 전부 문자열! 보기편하게 하기위해 역슬래시 줌.
use application\models\BoardModel;

// use application\controllers\Controller; // 같은 namespace면 굳이 use 적어줄 필요 없음 (// namespace 를 주지 않으면 파일 경로로 찾아야함!)
// use application\controllers\ 아래에 있는 Controller; 를 쓸수 있겠금 하겠다. 외부파일!
// 같은 namespace면 굳이 use 적어줄 필요 없음 (// namespace 를 주지 않으면 파일 경로로 찾아야함!)

class BoardController extends Controller // extends 상속 // 부모, 자식 둘다 생성자 있으면 -> 자식 객체화 하면 -> 자식 생성자만 호출됨 ()
// class 명 꼭 주소값 맞춰서 작성! board
{
    public function list()
    {
        $model = new BoardModel(); // static 메소드가 아니기 때문에, 객체화 해줘야함
        $this->addAttribute("title", "리스트");
        $this->addAttribute("list", $model->selBoardList()); // = $this->list = $model->selBoardList(); 똑같은 말임
        $this->addAttribute("js", ["board/list"]); // 끝에 .js 자동으로 붙음
        $this->addAttribute(_HEADER, $this->getView("template/header.php"));
        $this->addAttribute(_MAIN, $this->getView("board/list.php"));
        $this->addAttribute(_FOOTER, $this->getView("template/footer.php"));
        // return "board/list.php"; // (문자열을 리턴해줌)view 파일명!!. views 이후의 경로만 적으면 됨 
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



// - MVC (model-view-controller)패턴 : 유지보수!
// 디자인 패턴(설계 패턴. 파일 어떻게 만들지 룰을 정해놓은 패턴)

// M모델
// 데이터! DB

// V뷰
// 사용자에게 보여지는 부분을 담당!
// 화면에 띄우는거(html css javascript)

// C컨트롤러
// 중개자! 모델 - 뷰 다리역할(연결)

// libs : librery. 셋팅 쪽 담당

// 쌤 프레임워크 : 파일선택/메소드선택 (최소 2차 주소 까지는 있어야함)

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


// 등록처리가 필요한 데, 이때 V는 필요 없고, M과 C만 필요함
// 리스트화면은 데이터 가지고 오고 뿌리고 보여주고 다 필요함.
// 디테일화면도 데이터 가지고와서 뿌려야하니까 MVC 다 필요함.
// 글삭제처리는 따로 필요하지 않고, 디테일에서 해결하는데, 그때 M,C가 필요함.
// 수정화면(데이터도 뿌려야하고, 데이터(수정할)도 받아야함.) 
//     >> 등록화면과 비슷하지만 안에 내용이 비어있지 않고, 
//     >> 원래의 값이 들어있는 상태(데이터뿌려져있음)에서 수정하는 것.
//
// thanks to 영롱