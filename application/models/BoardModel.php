<?php

namespace application\models; // 프로젝트 만들다보면 같은 class명 만들 수 있는데, 구분하기 위해서. (namespace : 홀드 개념) // 같은 model이라 use model 안해줘도 됨
use PDO;

class BoardModel extends Model // 다른파일인데도 불구하고 사용할수 있는 이유 : 같은 namespace
{
    public function selBoardList()
    {
        $sql = "SELECT A.i_board, A.title, A.created_at, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                ORDER BY i_board DESC";
        $stmt = $this->pdo->prepare($sql); // statement : 맨 쿼리문 실행함.
        // prepare : 쿼리문 완성하는것을 도와줌(쿼리문에서 문장의 내용이 바껴야할 때 (where절의 i_board 값이 바뀌거나) 문자열일때 '' 넣어주던가 등등 해줌)
        // stmt는 prepare 해야만 얻을 수 있는 객체.
        $stmt->execute(); // 실행
        return $stmt->fetchAll(PDO::FETCH_OBJ); // 여기서 넘겨주는 객체를 받음. 하나하나=객체, 담고있는것=배열 // fetch:한줄 fetchAll:여러줄
        // PDO::FETCH_OBJ 안주면 배열로 넘어옴.. view에서 값 뿌릴 때 객체: [] 배열: ->
        // BoardController.php function list에서 함수 호출할 것임
    }
    public function selBoard($param)
    {
        $sql = "SELECT A.i_board, A.title, A.ctnt, A.i_user, A.created_at, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE A.i_board=:i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]); // bindValue :  문자열에서 원하는 위치(ex :i_board)에 원하는 값을 쏙쏙 넣고싶을 때 씀
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // 한줄이니까 무조건 객체 하나만 넘어옴
    }

    public function delBoard($param)
    {
        $sql = "DELETE
                FROM t_board
                WHERE i_board=:i_board";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute(); // 실행 까지만 하면 됨. 굳이 가져올 자료 없음
    }

    public function updBoard($param)
    {
        $sql = "UPDATE t_board
                SET title = :title, ctnt = :ctnt
                WHERE i_board=:i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->execute();
    }

    public function insBoard($param)
    {
        $sql = "INSERT INTO t_board (i_user, title, ctnt)
                VALUES (:i_user, :title, :ctnt)";
        $stmt = $this->pdo->prepare($sql); // sql문을 알아서 변환시켜주는것 (문자열-> 문자열, 숫자면 홑따옴표 붙여줌)
        $stmt->bindValue(':i_user', $param["i_user"]);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->execute();
    }
}

// DB랑 통신한걸 list.php 까지 어떻게 전달하는가 : 모델(db관련)

// DB랑 통신하기 위한 모델을 상속받은 친구 BoardModel, UserModel


// 자바스크립트에서
// fetch = 쿼리셀렉터
// fetchall = 쿼리셀렉터All (한줄이면 객체)