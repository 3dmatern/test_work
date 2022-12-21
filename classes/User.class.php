<?php
    //Объект Пользователь
    class User{

        //Свойства объекта: login, password, email, name
        private $login;
        private $password;
        private $email;
        private $name;

        //конструктор - метод который создаёт объект (экземпляр класса)
        public function __construct($login=false, $password=false, $email=false, $name=false){
            $this -> login = $login;
            $this -> password = $password;
            $this -> email = $email;
            $this -> name = $name;
        }
        //Создание записи в БД, если проверка пройдена
        public function create($salt){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
                if($this -> login && $this -> password && $salt && $this -> email && $this -> name){
                    $user = [$this -> login, $this -> password, $salt, $this -> email, $this -> name];
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
        public function update($update, $salt=false){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
            }
            foreach($jsonArray as $key => $value){
                for($i=0, $size=count($jsonArray); $i<$size; $i++){
                    if($value[$i] === $this -> login){
                        //проверяем $update на соответствие паролю
                        if(preg_match("/^(?=.*\d)(?=.*[a-zа-я])(?=.*[A-ZА-Я])[0-9a-zA-Zа-яА-Я]{6,}$/iu", $update) === 1){
                            $jsonArray[$key][1] = $update;
                            $jsonArray[$key][2] = $salt;
                            if($jsonArray[$key][1] === $update && $jsonArray[$key][2] === $salt){
                                file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
                                return 1;
                            }
                        }
                        //проверяем $update на соответствие имени
                        if(preg_match("/^[a-zа-я]+$/iu", $update) === 1){
                            $jsonArray[$key][4] = $update;
                            if($jsonArray[$key][4] === $update){
                                file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
                                return 2;
                            }
                        }
                    }
                }
            }
        }
        //Удаление пользователя
        public function deleted(){
            if(file_exists('db.json')){
                $json = file_get_contents('db.json');
                $jsonArray = json_decode($json, true);
            }
            foreach($jsonArray as $key => $value){
                for($i=0, $count=count($jsonArray); $i<$count; $i++){
                    if($value[$i] === $this->login){
                        unset($jsonArray[$key]);
                    }
                }
                file_put_contents('db.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
            }
        }
        //Удаляем класс
        public function __destruct()
        {
            __CLASS__;
        }
    }
?>