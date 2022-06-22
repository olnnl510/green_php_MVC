<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>

<body>
    <h1>detail</h1>

    <div>
        <a href="mod?i_board=<?= $this->data->i_board ?>"><button id="btnMod" data-i_board="<?= $this->data->i_board ?>">수정</button></a>
        <button id="btnDel" data-i_board="<?= $this->data->i_board ?>">삭제</button>
        <a href="list"><button id="btnList">리스트</button></a>
    </div>
    <div>글번호 : <?= $this->data->i_board ?></div>
    <div>제목 : <?= $this->data->title ?></div>
    <div>내용 : <?= $this->data->ctnt ?></div>
    <div>글쓴이 : <?= $this->data->nm ?></div>
    <div>작성일 : <?= $this->data->created_at ?></div>
</body>

</html>