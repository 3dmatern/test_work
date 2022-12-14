<?php
    session_start();
    /* Подключаем файлы с функцией checkName */
    require_once('../function/checkName.php');
    
    /* Проверка Ajax ли запрос */
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        
        /* Если пришло пустое значение, то вернём имя */
        if($_POST['chekname']===''){
            $login = $_SESSION['login'];
            $name = checkName($login);
            $response = [
                "message" => $name
            ];
            echo json_encode($response);
            die();
        }
        /* удаляем класс */
        $user -> __destruct();
    } else {
        die('Это не ajax запрос!');
    }
?>