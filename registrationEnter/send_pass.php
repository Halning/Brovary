
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
header("content-type:text/html;charset=utf-8");
$email = stripslashes(trim(filter_input(INPUT_POST, 'email_p', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)));

if (empty($email)) {
    exit("Некоректный email");
}

if (isset($email)) { 
    
    $db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());
    
    $res = mysqli_query($db,"SELECT id,password,login FROM users WHERE  email='$email' AND activation='1'") or die(mysqli_error());  
    $myrow = mysqli_fetch_assoc($res);
    $password = $myrow['password'];
    $login = $myrow['login'];
    if (empty($myrow['id']) or $myrow['id'] == '') {
        exit("Пользователя с    таким e-mail адресом не обнаружено ни в одной базе ЦРУ :)");
    }

    $datenow = date('YmdHis'); 
    $new_password = substr($datenow, 2, 6); 

    $new_password_sh = md5($new_password); 
    mysqli_query($db,"UPDATE users SET    password='$new_password_sh' WHERE login='$login'")or die(mysqli_error()); 

    $message = "Здравствуйте,    " . $login . "!\n Ваш пароль:\n" . $new_password; 
    $response = mail($email, "Восстановление пароля", $message, "Content-type:text/html;    Charset=utf-8\r\n");  
    if ($response == TRUE) {
        echo 'На вашу почту ' . $email . ' было отправлено письмо с паролем';
    } else {
        echo 'Ошибка отправки письма, попробуйте еще раз!';
    }
} 

