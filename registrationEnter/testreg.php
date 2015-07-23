


<?php

header("content-type:text/html;charset=utf-8");

include 'bd.php';

$e_login = stripslashes(htmlspecialchars(trim($_POST['e_login'])));
$e_password = stripslashes(htmlspecialchars(md5($_POST['e_password'])));
$query = mysql_query("SELECT * FROM users WHERE login='$e_login'");
$userData = mysql_fetch_array($query);
$username = $userData['username'];


if (empty($e_login) || empty($e_password)) { //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    exit("f");
}


if (isset($userData['activation']) && $userData['activation'] == 0) {
    exit('Активируйте акаунт!');
}

if ($userData['password'] == $e_password) {
    echo 'Вы успешно вошли на сайт!';
    setcookie('Login', 'true', time() + 3600, "/");
    setcookie('username', $username, time() + 3600, "/");
    session_start();
    $_SESSION['name'] = $e_login;
    $_SESSION['username'] = $username;
} else {
    exit('Неверный логин или пароль');
}



