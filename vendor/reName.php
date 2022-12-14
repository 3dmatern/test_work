<?php
    session_start();
    //Подключаем класс
    use classes\User;
    function my_autoload($className){
        require_once('../'.$className.'.class.php');
    }
    spl_autoload_register('my_autoload');
    $user = new User();

    /* переменная $error_fields в которую будут помещаться данные с ошибками и с помощью 
    jQuery будет активироваться lable относящийся к inputu в котором ошибка */
    $error_fields = [];

    /* Проверка Ajax ли запрос */
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if($_POST['login']==='' && $_POST['name']!==''){
            $login = $_SESSION['login'];
            /* проверка на пробелы */
            if(preg_match("/\s/", $_POST['name'])===1){
                $error_fields[] = 'name';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Давай без пробелов в имени? :)",
                    "fields" => ['name']
                ];
                echo json_encode($response);
                die();
            }
            /* проверка на кол-во символов и только буквы */
            if(mb_strlen($_POST['name'])<2 || preg_match("/^[a-zа-я]+$/iu", $_POST['name']) === 0) {
                $error_fields[] = 'name';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Имя минимум из 2-ух букв",
                    "fields" => ['name']
                ];
                echo json_encode($response);
                die();
            }
            $name = htmlspecialchars($_POST['name']);
            $user -> update($login, $name);
            $response = [
                "status" => true,
                "type" => 1,
                "message" => 'Имя успешно изменено',
                "fields" => ['name']
            ];
            echo json_encode($response);
            die();
        } else {
            /* если пусто */
            $error_fields[] = 'name';
            $response = [
                "status" => false,
                "type" => 0,
                "message" => "Введите Имя",
                "fields" => ['name']
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