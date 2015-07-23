
<?php

header("content-type:text/html;charset=utf-8");

include 'bd.php';

$username = stripslashes(htmlspecialchars($_POST['username']));
$login = stripslashes(htmlspecialchars(trim($_POST['login'])));
$email = stripslashes(htmlspecialchars(trim($_POST['email'])));
$password = stripslashes(htmlspecialchars($_POST['password']));
$r_password = stripslashes(htmlspecialchars($_POST['r_password']));


if (empty($login) || empty($password) || empty($email) || empty($username) || empty($r_password)) { //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    exit("f");
}

if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) { //проверка    е-mail адреса регулярными выражениями на корректность
    exit("Неверно введен е-mail!");
}

//-------------------------------------------------------------------------------  

$recaptcharesponse = htmlspecialchars($_POST['g-recaptcha-response']);
$secret = '6LdRIgoTAAAAAD1MY2uxxei45OXO8mEotCLBXzpm';
$data = array('key1' => 'value1', 'key2' => 'value2');

$params = array(
    'secret' => $secret,
    'response' => $recaptcharesponse,
);

$token = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify' . '?' . urldecode(http_build_query($params))), true);
//var_dump($token);
if ($token['success'] == true) {
    
} else {
    exit("Не прошел капчу!");
}

//------------------------------------------------------------------------------

if (strlen($login) < 3 || strlen($login) > 15) {
    exit("Логин должен состоять не менее чем из 3 символов и не более чем из    15.");
}
if (strlen($password) < 3 || strlen($password) > 15) {
    exit("Пароль должен состоять не менее чем из 3 символов и не более чем из    15.");
}



$query = mysql_query("SELECT login FROM users WHERE login='$login'") or die(mysql_error());
$query1 = mysql_query("SELECT email FROM users WHERE email='$email'") or die(mysql_error());
$userData = mysql_fetch_array($query);
$userData1 = mysql_fetch_array($query1);
if (isset($userData['login'])) {
    exit('Извините, введённый вами логин уже зарегистрирован. Введите другой логин.');
}

if (isset($userData1['email']) == $email) {
    exit('Извините, введённый вами email уже зарегистрирован. Введите другой email.');
}

if ($password === $r_password) {
    $password = $password;
    //    если такого нет, то сохраняем данные
    $query = mysql_query("INSERT INTO users (username,login,password,email,date)    VALUES('$username','$login','$password','$email',NOW())") or die(mysql_error());
    

//------------------------------------------------------------------------------    
//    Проверяем, есть ли ошибки
    if ($query == 'TRUE') {
        $query2 = mysql_query("SELECT id, login FROM users WHERE login='$login'"); //извлекаем    идентификатор пользователя. Благодаря ему у нас и будет уникальный код    активации, ведь двух одинаковых идентификаторов быть не может.
        $userData2 = mysql_fetch_array($query2);
        $login = $userData2['login'];
        $activation = md5($userData2['id']) . md5($login); //код активации аккаунта. Зашифруем    через функцию md5 идентификатор и логин. Такое сочетание пользователь вряд ли    сможет подобрать вручную через адресную строку.
        $subject = "Подтверждение регистрации"; //тема сообщения
        $message = "Здравствуйте! Спасибо за регистрацию на citename.ru\nВаш логин:    " . $login . "\nBaш пароль " . $r_password . "\n
            Перейдите    по ссылке, чтобы активировать ваш    аккаунт:\nhttp://brovary/registrationEnter/activation.php?login=" . $login . "&code=" . $activation . "\nС    уважением,\n
            Администрация    citename.ru"; //содержание сообщение
        $response = mail($email, $subject, $message, "Content-type:text/plane;    Charset=utf-8\r\n"); //отправляем сообщение
        if ($response == TRUE) {
            echo "Вам на E-mail выслано письмо с cсылкой, для подтверждения регистрации.    Внимание! Ссылка действительна 1 час."; //говорим о    отправленном письме пользователю
        } else {
            mysql_query("DELETE FROM users WHERE login='$login'");
            echo 'Ошибка отправки письма, попробуйте еще раз!';
        }
    }
} else {
    exit('Неверный повтор пароля!');
}
















/*if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) { //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    exit("f");
}
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
// подключаемся к базе
include ("bd.php"); // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
// проверка на существование пользователя с таким же логином
$result = mysql_query("SELECT id FROM users WHERE login='$login'", $db);
$myrow = mysql_fetch_array($result);
if (!empty($myrow['id'])) {
    exit("<p>Извините, введённый вами логин уже зарегистрирован. Введите другой логин.</p>");
}
// если такого нет, то сохраняем данные
$result2 = mysql_query("INSERT INTO users (login,password) VALUES('$login','$password')");
// Проверяем, есть ли ошибки
if ($result2 == 'TRUE') {
    echo "<p>Вы успешно зарегистрированы!</p>";
} else {
    echo "<p>Ошибка! Вы не зарегистрированы.</p>";
}*/
    
