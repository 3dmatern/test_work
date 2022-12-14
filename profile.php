<?php
    session_start();
    if(!$_SESSION['login']){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль Manao - test</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <nav class="nav">
        <ul>
            <li><a href="chek.php">Chek</a></li>
            <li><a href="index.php">Вход</a></li>
            <li><a href="register.php">Регистрация</a></li>
            <li><a href="vendor/logout.php" class="logout">Выход</a></li>
        </ul>
    </nav>
        <!-- Профиль -->
    <h1>Hello,<span class="title_name"></span>:)</h1>
    <span class="form_prof">
        <!-- Изменение имени -->
        <form>
            <input class="block_off" name="login" value="">
            <label for="name"></label>
            <input id="name" type="text" name="name" placeholder="Введите новое имя">
            <button type="submit" class="btn name_btn">Изменить имя</button>
        </form>
        <!-- Изменение пароля -->
        <form>
            <input class="block_off" name="login" value="">
            <label for="password"></label>
            <input id="password" type="password" name="password" placeholder="Введите новый пароль">
            <button type="submit" class="btn password_btn">Изменить пароль</button>
        </form>
        <!-- Удаление аккаунта -->
        <form>
            <p class="msg block_off"></p>
            <input class="block_off" name="login" value="">
            <a class="btn deleted_btn" href="vendor/logout.php">Удалить профиль</a>
        </form>
    </span>

    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>