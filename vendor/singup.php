<?php
    //Подключаем класс
    use classes\User;
    function my_autoload($className){
        require_once('../'.$className.'.class.php');
    }
    spl_autoload_register('my_autoload');

    /* Подключаем файл с функцией salt */
    require_once('../function/salt.php');

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
            /* Если длина меньше 6*/
            if(strlen($_POST['login'])<6) {
                $error_fields[] = 'login';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "login минимум 6 символов :/",
                    "fields" => ['login']
                ];
                echo json_encode($response);
                die();
            }
            /* Проверка на криллицу и пробелы*/
            if(preg_match("/[а-я\s]/ui", $_POST['login']) === 1) {
                $error_fields[] = 'login';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Латинские буквы или убери пробелы ;)",
                    "fields" => ['login']
                ];
                echo json_encode($response);
                die();
            }
            /* Сохраняем login в переменную с преобразованием спецсимволов в HTML-сущности */
            $login = htmlspecialchars($_POST['login']);
           
            //проверка login на уникальность
            $result = $user->read($login);
            
            /* Если login существует, вернётся 1, она запишется в $result */
            if($result === 1){
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "login уже существует :(",
                    "fields" => ['login']
                ];
                echo json_encode($response);
                die();
            }
        }
        /* Если данные пришли, начинаем проверку */
        if(isset($_POST['email'])){
            /* Если пусто */
            if($_POST['email'] == ''){
                $error_fields[] = 'email';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Введите E-mail",
                    "fields" => ['email']
                ];
                echo json_encode($response);
                die();
            }
            /* Проверка на пробелы */
            if(preg_match("/[\s]/", $_POST['email'])===1){
                $error_fields[] = 'email';
                $response = [
                "status" => false,
                "type" => 0,
                "message" => "Давай без пробелов в E-mail? :)",
                "fields" => ['email']
                ];
                echo json_encode($response);
                die();
            }
            /* фильтрация email на соотвествие */
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
                $error_fields[] = 'email';
                $response = [
                "status" => false,
                "type" => 0,
                "message" => "Введите корректный E-mail",
                "fields" => ['email']
                ];
                echo json_encode($response);
                die();
            }
            $email = htmlspecialchars($_POST['email']);
            
            //проверка email на уникальность
            $result = $user->read($email);
            if($result === 1){
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "E-mail уже существует :(",
                    "fields" => ['email']
                ];
                echo json_encode($response);
                die();
            }
        }
        /* Если данные пришли, начинаем проверку */
        if(isset($_POST['name'])){
            /* если пусто */
            if($_POST['name'] == ''){
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
        }
        /* Если данные пришли, начинаем проверку */
        if(isset($_POST['password']) && isset($_POST['password_confirm'])){
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
            if($_POST['password_confirm'] == ''){
                $error_fields[] = 'password_confirm';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Подтвердите пароль",
                    "fields" => ['password_confirm']
                ];
                echo json_encode($response);
                die();
            }
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
            /* проверка на соотвествие вводимых паролей */
            if($_POST['password'] !== $_POST['password_confirm']){
                $error_fields[] = 'password_confirm';
                $response = [
                    "status" => false,
                    "type" => 0,
                    "message" => "Пароли не совпадают :(",
                    "fields" => ['password_confirm']
                ];
                echo json_encode($response);
                die();
            }
            /* генерация соли */
            $salt = generateSalt();
           
            /* хеширование паролья с добавлением слои */
            $password = md5($salt.trim(htmlspecialchars($_POST['password'])));
            
            /* заносим данные в vendor/db.json */
            $user = (new User($login, $password, $email, $name))->create($salt);
            $response = [
                "status" => true,
                "type" => 1,
                "message" => "Регистрация прошла успешно!"
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
