<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>list</h1>
    <table>
        <tr>
            <td>번호</td>
            <td>제목</td>
            <td>작성일</td>
        </tr>
    <?php foreach($this->list as $item) { ?>
        <tr>
            <td><?=$item->i_board?></td>
            <td><?=$item->title?></td>
            <td><?=$item->created_at?></td>
        </tr>
    <?php } ?>

    </table>
</body>
</html>