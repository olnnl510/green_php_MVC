<?php

namespace application\models; // 프로젝트 만들다보면 같은 class명 만들 수 있는데, 구분하기 위해서. (namespace : 홀드 개념)
use PDO;

class BoardModel extends Model
{
    public function selBoardList()
    {
        $sql = "SELECT A.i_board, A.title, A.created_at, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                ORDER BY i_board DESC";
        $stmt = $this->pdo->prepare($sql); // statement : 맨 쿼리문 실행함. 문자열에서 원하는 위치에 원하는 값을 쏙쏙 넣고싶을 때 씀
        $stmt->execute(); // 실행
        return $stmt->fetchAll(PDO::FETCH_OBJ); // 여기서 넘겨주는 객체를 받음. 하나하나=객체, 담고있는것=배열
    }
    public function selBoard($param)
    {
        $sql = "SELECT A.i_board, A.title, A.ctnt, A.i_user, A.created_at, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE A.i_board=:i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
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



// 자바스크립트에서
// fetch = 쿼리셀렉터
// fetchall = 쿼리셀렉터All (한줄이면 객체)