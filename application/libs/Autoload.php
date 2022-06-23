<?php
    spl_autoload_register(function ($path) {
        $path = str_replace('\\','/',$path);
        $paths = explode('/', $path);
        if (preg_match('/model/', strtolower($paths[1]))) { // 1차 주소값
            $className = 'models';
        } else if (preg_match('/controller/',strtolower($paths[1]))) {
            $className = 'controllers';
        } else {
            $className = 'libs';
        }

        $loadpath = $paths[0].'/'.$className.'/'.$paths[2].'.php'; // ex) 2번 : BoardController
        
        //              1(localhost) / 2 / 보드컨트롤러, 유저컨트롤러 등
        // echo 'autoload $path : ' . $loadpath . '<br>';
        
        if (!file_exists($loadpath)) {
            echo " --- autoload : file not found. ($loadpath) ";
            exit();
        }
        require_once $loadpath;
    });

    
    // 그 파일을 쓸 수 있도록 require_once 해주는것
    // 0번방 : localhost