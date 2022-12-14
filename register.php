<?php
    session_start();
    if(!empty($_SESSION['login'])){
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация Manao - test</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!-- Форма регистрации -->
    <span class="form">
        <form>
            <label for="login"></label>
            <input id="login" type="text" name="login" placeholder="Введите логин" >

            <label for="password"></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль" >

            <label for="password_confirm"></label>
            <input id="password_confirm" type="password" name="password_confirm" placeholder="Подтвердите пароль" >

            <label for="email"></label>
            <input id="email" type="text" name="email" placeholder="Введите E-mail" >

            <label for="name"></label>
            <input id="name" type="text" name="name" placeholder="Введите имя" >
            <button type="submit" class="btn reg_btn">Зарегистрироваться</button>
            <p class="link">
                У Вас уже есть аккаунт? - <a href="./">Войти</a>
            </p>
            <p class="msg block_off"></p>
        </form>
    </span>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>