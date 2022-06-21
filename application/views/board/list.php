<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>

<body>
    <h1>list</h1>
    <table>
        <thead>
            <tr>
                <td>번호</td>
                <td>제목</td>
                <td>작성일</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->list as $item) { ?>
                <tr data-i_board="<?= $item->i_board ?>">
                    <td><?= $item->i_board ?></td>
                    <td><?= $item->title ?></td>
                    <td><?= $item->created_at ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>