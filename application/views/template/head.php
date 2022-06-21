<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=isset($this->title) ? $this->title : "게시판"?></title>
    <?php 
        if(isset($this->css)) {
            foreach($this->css as $css) { // 반복문 도니까 배열이구나!
                echo "<link rel='stylesheet' href='/static/css/{$css}.css'>
                ";
            }
        }

        if(isset($this->js)) {
            foreach($this->js as $js) {
                echo "<script defer src='/static/js/{$js}.js'></script>
                ";
            }
        }
    ?>
</head>


<!-- 기능 총 3개

타이틀 찍는 기능
CSS import
자바스크립트 import-->