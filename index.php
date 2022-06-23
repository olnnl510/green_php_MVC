<?php
// print "index.php";
require_once 'application/libs/Config.php'; // 상수
require_once 'application/libs/Autoload.php'; // 파일, import(require 해주는 친구)
new application\libs\Application(); // ☆핵심☆ 파일 사용. Application을 객체화 함.