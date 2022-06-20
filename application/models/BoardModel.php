<?php
namespace application\models; // 프로젝트 만들다보면 같은 class명 만들 수 있는데, 구분하기 위해서. (namespace : 홀드 개념)
use PDO;

class BoardModel extends Model {
    public function selBoardList() {
        $sql = "SELECT i_board, title, created_at
                FROM t_board
                ORDER BY i_board DESC";
        $stmt = $this->pdo->prepare($sql); // statement : 맨 쿼리문 실행함. 문자열에서 원하는 위치에 원하는 값을 쏙쏙 넣고싶을 때 씀
        $stmt->execute(); // 실행
        return $stmt->fetchAll(PDO::FETCH_OBJ); // 여기서 넘겨주는 객체를 받음. 하나하나=객체, 담고있는것=배열
    }
}





// 자바스크립트에서
// fetch = 쿼리셀렉터
// fetchall = 쿼리셀렉터All (한줄이면 객체)