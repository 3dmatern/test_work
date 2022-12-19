<?php
    session_start();
    //Подключаем класс
    function my_autoload($classname){
        require_once("..\\classes\\{$classname}.class.php");
    }
    spl_autoload_register('my_autoload');

    /* Подключаем файл с функцией salt */
    require_once('../function/salt.php');

    /* переменная $error_fields в которую будут помещаться данные с ошибками и с помощью 
    jQuery будет активироваться lable относящийся к inputu в котором ошибка */
    $error_fields = [];

    /* Проверка Ajax ли запрос */
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if($_POST['login']==='' && $_POST['password']!==''){
            $login = $_SESSION['login'];
            /* проверка длины и соответстиве только буквам и цифрам */
            if(mb_strlen($_POST['password'])<6 || preg_match("/^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{6,}$/iu", $_POST['password']) !== 1){
                $error_fields[] = 'password';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Пароль минимум 6 символов, цифры и буквы",
                    "fields" => ['password']
                ];
                echo json_encode($response);
                die();
            }
            /* генерация соли */
            $salt = generateSalt();
            /* хеширование паролья с добавлением слои */
            $password = md5($salt.trim(htmlspecialchars($_POST['password'])));
            
            /* заносим данные в vendor/db.json */
            $user = (new User($login))->update($password, $salt);
            $response = [
                "status" => true,
                "type" => 1,
                "message" => "Пароль успешно изменен",
                "fields" => ['password']
                ];
            echo json_encode($response);
            die();
        } else {
            /* если пусто */
            $error_fields[] = 'password';
            $response = [
                "status" => false,
                "type" => 0,
                "message" => "Введите пароль",
                "fields" => ['password']
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
