<?php
    session_start();
    //Подключаем класс
    use classes\User;
    function my_autoload($className){
        require_once('../'.$className.'.class.php');
    }
    spl_autoload_register('my_autoload');
    $user = new User();

    /* Проверка Ajax ли запрос */
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if($_POST['login']===''){
            $login = $_SESSION['login'];
            $user -> deleted($login);
            if(isset($_COOKIE)){
                setcookie('name', '', 1, '/');
            }
            $_SESSION = array();
            unset($_SESSION['login']);
            session_destroy();
            $response = [
                "status" => true,
                "type" => 1,
                "message" => 'Аккаунт удалён'
            ];
            echo json_encode($response);
            die();
        } else {
            $response = [
                "status" => false,
                "type" => 0,
                "message" => 'Ошибка удаления'
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