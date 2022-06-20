<?php
namespace application\controllers;

abstract class Controller {
    public function __construct($action) {        
        $view = $this->$action();
        require_once $this->getView($view); // 해줬기 때문에 BoardController.php 에 list가 뜨는거임
    }
    
    protected function addAttribute($key, $val) {
        $this->$key = $val;
    }

    protected function getView($view) {
        if(strpos($view, "redirect:") === 0) {
            header("Location: http://" . _HOST . substr($view, 9));
        }
        return _VIEW . "/" . $view;
    }       // 상수
}