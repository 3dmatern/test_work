<?php
    namespace classes;
    //Объект Пользователь
    class User{

        //Свойства объекта: login, password, email, name
        private $login;
        private $password;
        private $email;
        private $name;

        //конструктор - метод который создаёт объект (экземпляр класса)
        public function __construct($login=false, $email=false, $name=false, $password=false){
            $this -> login = $login;
            $this -> email = $email;
            $this -> name = $name;
            $this -> password = $password;
            
        }
        //Создание записи в БД, если проверка пройдена
        public function create($login=false, $password=false, $salt=false, $email=false, $name=false){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
                if($login && $password && $salt && $email && $name){
                    $user = [$login, $password, $salt, $email, $name];
                    $jsonArray[] = $user;
                    file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE));
                }
            }
        }
        //Данные пользователя
        public function read($read){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
                if($jsonArray) {
                    foreach($jsonArray as $row){
                        if($row[0] === $read) {
                            return 1;
                        }
                        else if($row[1] === $read) {
                            return 1;
                        }
                        else if($row[2] === $read) {
                            return 1;
                        }
                        else if($row[3] === $read) {
                            return 1;
                        }
                        else if($row[3] === $read) {
                            return 1;
                        }
                    }
                }
            }
        }
        //Обновление данных пользователя
        public function update($login=false, $update=false, $salt=false){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
            }
            for($i=0, $size=count($jsonArray); $i<$size; $i++){
                if($jsonArray[$i][0] === $login){
                    if(preg_match("/^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{6,}$/iu", $update) === 1){
                        $jsonArray[$i][1] = $update;
                        $jsonArray[$i][2] = $salt;
                        if($jsonArray[$i][1] === $update && $jsonArray[$i][2] === $salt){
                            file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
                            return 1;
                        }
                    }
                    if(preg_match("/^[a-zа-я]+$/iu", $update) === 1){
                        $jsonArray[$i][4] = $update;
                        if($jsonArray[$i][4] === $update){
                            file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
                            return 2;
                        }
                    }
                }
            }
        }
        //Удаление пользователя
        public function deleted($login=false){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
            }
            for($i=0, $size=count($jsonArray); $i<$size; $i++){
                if($jsonArray[$i][0] === $login){
                    unset($jsonArray[$i]);
                }
            }
            file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
        }
        //Удаляем класс
        public function __destruct()
        {
            __CLASS__;
        }
    }
?>