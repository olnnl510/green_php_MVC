<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>
<?php use application\models\UserModel; ?>


<body>
    <h1>list</h1>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->list as $item) { ?>
                <tr data-i_board="<?= $item->i_board ?>">
                    <td><?= $item->i_board ?></td>
                    <td><?= $item->title ?></td>
                    <td><?= $item->nm ?></td>
                    <td><?= $item->created_at ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>