<?php
    if(empty($_COOKIE)) {
        setcookie('name', 'yes', time() + 3600, '/');
    }
    session_start();
    if(!empty($_SESSION['login'])){
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация Manao - test</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!-- Форма авторизации -->
    <span class="form">
        <form>
            <label for="login"></label>
            <input id="login" type="text" name="login" placeholder="Введите логин" >

            <label for="password"></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль" >
            <button type="submit" class="btn login_btn">Войти</button>
            <p class="link">
                У Вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь</a>
            </p>
            <p class="msg block_off"></p>
        </form>
    </span>
    
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>