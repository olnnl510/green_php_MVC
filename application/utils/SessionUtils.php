<?php
if(!isset($_SESSION)) { //세션이 존재하지 않는다면
    session_start(); // 세션스타트
}

function flash($name = '', $val = '') {
    if(!empty($name)) { // 파라미터로 들어온 name이 비어있지 않다면
            // 로그인 상황
        if(!empty($val)) { // 파라미터로 들어온 val이 비어있지 않다면
            $_SESSION[$name] = $val; // val을 세션[name]에 넣는다
            // 로그아웃 상황
        } else if(empty($val) && !empty($_SESSION[$name])) { // 비어있지 않다면 = 박혀있다면
            unset($_SESSION[$name]); // session[name]을 제거한다
        }
    }
}