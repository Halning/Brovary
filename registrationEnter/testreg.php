


<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());

$e_login = stripslashes(htmlspecialchars(trim(filter_input(INPUT_POST, 'e_login', FILTER_SANITIZE_STRING))));
$e_password = stripslashes(htmlspecialchars(md5($_POST['e_password'])));
$res = mysqli_query($db, "SELECT * FROM users WHERE login='$e_login'") or die(mysqli_error());
$userData = mysqli_fetch_assoc($res);
$id = $userData['id'];
$username = $userData['username'];
$activation = $userData['activation'];

$avatar = 'http://brovary/registrationEnter/' .$userData['avatar'];


if (empty($e_login) || empty($e_password)) { //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    exit("f");
}


if (isset($activation) && $activation == 0) {
    exit('Активируйте акаунт!');
}

if ($userData['password'] == $e_password || $userData['login'] == $e_login) {
    echo 'Вы успешно вошли на сайт!';
    setcookie('Login', 'true', time() + 3600, "/",'', 0, true);
    SetCookie('avatar', $avatar, time() + 3600, "/", '', 0 , true);
    setcookie('username', $username, time() + 3600, "/", '', 0, true);
    setcookie('id', $id, time() + 3600, "/", '', 0, true);
    session_start();
    $_SESSION['login'] = $e_login;
    $_SESSION['username'] = $username;
    $_SESSION['avatar'] = $avatar;
    $_SESSION['id'] = $id;
} else {
    exit('Неверный логин или пароль');
}



