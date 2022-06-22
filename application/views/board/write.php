<?php

session_start();
$login_user = $_SESSION[_LOGINUSER];
// print_r($login_user);
?>
<div>
    <h1>write</h1>
    <form action="writeProc" method="post">
        <input type="hidden">
        <div>제목 : <input type="text" name="title"></div>
        <div>내용 : <textarea name="ctnt"></textarea></div>
        <div>
            <input type="submit" value="글등록">
        </div>
    </form>
</div>