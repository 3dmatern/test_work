<?php
    /* Старт сессии чтобы записать имя пользователя в глобальную переменную */
    session_start();
    //Подключаем класс
    use classes\User;
    function my_autoload($className){
        require_once('../'.$className.'.class.php');
    }
    spl_autoload_register('my_autoload');
    $user = new User();

    /* Подключаем файлы с функциями checkHash checkSalt */
    require_once('../function/checkHash.php');
    require_once('../function/checkSalt.php');

    /* переменная $error_fields в которую будут помещаться данные с ошибками и с помощью 
    jQuery будет активироваться lable относящийся к inputu в котором ошибка */
    $error_fields = [];
    
    /* Проверка Ajax ли запрос */
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        
        /* Если данные из login пришли, то начинаем проверку */
        if(isset($_POST['login'])){
            /* Если login пуст */
            if($_POST['login'] == ''){
                $error_fields[] = 'login';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Введите login",
                    "fields" => ['login']
                ];
                echo json_encode($response);
                die();
            }
            /* Сохраняем login в переменную с удалением пробелов в начале и конце,
             преобразование спецсимволов в HTML-сущности */
            $login = trim(htmlspecialchars($_POST['login']));
            //проверка login на существование
            $result = $user->read($login);
            /* Если login не существует, вернётся NULL и запишется в $result */
            if($result === null){
                $error_fields[] = 'login';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "login не существует",
                    "fields" => ['login']
                ];
                echo json_encode($response);
                die();
            }
        }
    
        /* Если данные пришли, начинаем проверку */
        if(isset($_POST['password'])){
            /* если пусто */
            if($_POST['password'] == ''){
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
            //находим Hash пароля пользователя в базе
            $hash = checkHash($login);
            //находим Соль пароля пользователя в базе
            $salt = checkSalt($login);
            //Записываем в сессию имя текущего пользователя
            $_SESSION['login'] = $login;
    
            $password = md5($salt.trim(htmlspecialchars($_POST['password'])));
            if($password === $hash){
                $response = [
                    "status" => true,
                    "type" => 1
                ];
                echo json_encode($response);
            } else {
                $error_fields[] = 'password';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Неверный пароль :(",
                    "fields" => ['password']
                ];
                echo json_encode($response);
                die();
            }
        }
        $user -> __destruct();
    } else {
        die('Это не ajax запрос!');
    }
?>