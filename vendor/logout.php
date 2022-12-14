<?php
    if(isset($_COOKIE)){
        setcookie('name', '', 1, '/');
    }
    session_start();
    $_SESSION = array();
    unset($_SESSION['login']);
    session_destroy();
    header('Location: /index.php')
?>