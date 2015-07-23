

<?php

header("content-type:text/html;charset=utf-8");
$email = stripslashes(htmlspecialchars(trim($_POST['email'])));

if (empty($email)) {
    exit("f");
}

//заносим введенный пользователем e-mail, если он    пустой, то уничтожаем переменную
if (isset($email)) {//если существуют необходимые переменные  
    include ("bd.php"); // файл    bd.php должен быть в той же папке, что и все остальные, если это не так, то    просто измените путь 

    $result = mysql_query("SELECT id,password,login FROM users WHERE  email='$email' AND activation='1'"); //такой ли у пользователя е-мейл 
    $myrow = mysql_fetch_array($result);
    $password = $myrow['password'];
    $login = $myrow['login'];
    if (empty($myrow['id']) or $myrow['id'] == '') {
        //если активированного пользователя с таким логином и е-mail    адресом нет
        exit("Пользователя с    таким e-mail адресом не обнаружено ни в одной базе ЦРУ :)");
    }

    $datenow = date('YmdHis'); //извлекаем    дату 
    $new_password = substr($datenow, 2, 6); //извлекаем из шифра 6 символов начиная    со второго. Это и будет наш случайный пароль. Далее запишем его в базу,    зашифровав точно так же, как и обычно.

    $new_password_sh = md5($new_password); //зашифровали 
    mysql_query("UPDATE users SET    password='$new_password_sh' WHERE login='$login'"); // обновили в базе 


    $message = "Здравствуйте,    " . $login . "!\n Ваш пароль:\n" . $new_password; //текст сообщения
    $response = mail($email, "Восстановление пароля", $message, "Content-type:text/plane;    Charset=utf-8\r\n"); //отправляем сообщение 
    if ($response == TRUE) {
        echo 'На вашу почту ' . $email . ' было отправлено письмо с паролем';
    } else {
        echo 'Ошибка отправки письма, попробуйте еще раз!';
    }
} 

