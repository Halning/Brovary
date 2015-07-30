

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
header("content-type:text/html;charset=utf-8");
$email = stripslashes(trim(filter_input(INPUT_POST, 'email_p', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL)));

if (empty($email)) {
    exit("Некоректный email");
}

//заносим введенный пользователем e-mail, если он    пустой, то уничтожаем переменную
if (isset($email)) {//если существуют необходимые переменные  
    
    $db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());
    
    $res = mysqli_query($db,"SELECT id,password,login FROM users WHERE  email='$email' AND activation='1'") or die(mysqli_error()); //такой ли у пользователя е-мейл 
    $myrow = mysqli_fetch_assoc($res);
    $password = $myrow['password'];
    $login = $myrow['login'];
    if (empty($myrow['id']) or $myrow['id'] == '') {
        //если активированного пользователя с таким логином и е-mail    адресом нет
        exit("Пользователя с    таким e-mail адресом не обнаружено ни в одной базе ЦРУ :)");
    }

    $datenow = date('YmdHis'); //извлекаем    дату 
    $new_password = substr($datenow, 2, 6); //извлекаем из шифра 6 символов начиная    со второго. Это и будет наш случайный пароль. Далее запишем его в базу,    зашифровав точно так же, как и обычно.

    $new_password_sh = md5($new_password); //зашифровали 
    mysqli_query($db,"UPDATE users SET    password='$new_password_sh' WHERE login='$login'")or die(mysqli_error()); // обновили в базе 


    $message = "Здравствуйте,    " . $login . "!\n Ваш пароль:\n" . $new_password; //текст сообщения
    $response = mail($email, "Восстановление пароля", $message, "Content-type:text/plane;    Charset=utf-8\r\n"); //отправляем сообщение 
    if ($response == TRUE) {
        echo 'На вашу почту ' . $email . ' было отправлено письмо с паролем';
    } else {
        echo 'Ошибка отправки письма, попробуйте еще раз!';
    }
} 

