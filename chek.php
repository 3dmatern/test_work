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
            <li><a href="index.php">Вход</a></li>
            <li><a href="profile.php">Профиль</a></li>
            <li><a href="vendor/logout.php" class="logout">Выход</a></li>
        </ul>
    </nav>
    <h1>Hello,<span class="title_name"></span>:)</h1>
    <h2>Это был мой первый опыт, было интересно и сложно, поэтапная реализация очень помогла выполнить это задание.</h2>
    <h3>Интересно, правильно или нет, с удовольствием буду ждать ответ! :)</h3>

    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>