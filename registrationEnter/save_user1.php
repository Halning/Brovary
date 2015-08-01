
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
header("content-type:text/html;charset=utf-8");
//------------------------------------------------------------------------------
//              Сохраняем в переменных введенные данные клиента
//------------------------------------------------------------------------------

$username = stripslashes(htmlspecialchars(trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))));
$login = stripslashes(htmlspecialchars(trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING))));
$email = stripslashes(htmlspecialchars(trim($_POST['email'])));
$password = stripslashes(htmlspecialchars($_POST['password']));
$r_password = stripslashes(htmlspecialchars($_POST['r_password']));

if (empty($login) || empty($password) || empty($email) || empty($username) || empty($r_password)) {
    exit("f");
}

if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)) {
    exit("Неверно введен е-mail!");
}
//------------------------------------------------------------------------------
//                              Проверка капчи
//------------------------------------------------------------------------------

$recaptcharesponse = htmlspecialchars(htmlentities(strip_tags($_POST['g-recaptcha-response']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
if ($recaptcharesponse == "") {
    $recaptcharesponse = htmlspecialchars(htmlentities(strip_tags($_POST['g-recaptcha-response']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
    $secret = '6LdRIgoTAAAAAD1MY2uxxei45OXO8mEotCLBXzpm';
    $data = array('key1' => 'value1', 'key2' => 'value2');

    $params = array(
        'secret' => $secret,
        'response' => $recaptcharesponse,
    );

    $token = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify' . '?' . urldecode(http_build_query($params))), true);
    var_dump($token['success']);
    if ($token['success'] != true) {
        exit("Не прошел капчу!");
    }
}
//------------------------------------------------------------------------------
//   Проверка данных(парль и логин на длинну), логин и мыло(есть ли уже в базе)
//------------------------------------------------------------------------------

if (strlen($login) < 3 || strlen($login) > 15) {
    exit("Логин должен состоять не менее чем из 3 символов и не более чем из    15.");
}
if (strlen($password) < 3 || strlen($password) > 15) {
    exit("Пароль должен состоять не менее чем из 3 символов и не более чем из    15.");
}

$db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());

$res = mysqli_query($db, "SELECT login, email FROM users WHERE login='$login' OR  email='$email'") or die(mysqli_error());
$userData = mysqli_fetch_assoc($res);

if ($userData['login'] == $login) {
    exit('Извините, введённый вами логин уже зарегистрирован. Введите другой логин.');
}

if ($userData['email'] == $email) {
    exit('Извините, введённый вами email уже зарегистрирован. Введите другой email.');
}
//------------------------------------------------------------------------------    
//               Проверяем, верно ли введен повтор пароля
//------------------------------------------------------------------------------

if ($password === $r_password) {
    $password = md5($password);

//------------------------------------------------------------------------------    
//             Работаем с аватаром если он был выбран
//------------------------------------------------------------------------------   
    if (isset($_FILES['file'])) {
        $fupload = $_FILES['file'];
        if ($fupload == '' or empty($fupload)) {
            unset($fupload);
        }
    }

    if (!isset($fupload['name']) or empty($fupload['name']) or $fupload['name'] == '') {
        $avatar = "avatars/net-avatara.jpg";
    } else {

        $file_error = $fupload['error'];

        switch ($file_error) {
            case 1:
                exit('Размер файла не больше 2 мб!');
            case 2:
                exit('Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.');
            case 3:
                exit('Загружаемый файл был получен только частично.');
            case 6:
                exit('Отсутствует временная папка.');
            case 7:
                exit('Не удалось записать файл на диск.');
            case 8:
                exit('PHP-расширение остановило загрузку файла. PHP не предоставляет способа определить какое расширение остановило загрузку файла; в этом может помочь просмотр списка загруженных расширений из phpinfo(). Добавлено в PHP 5.2.0.');
        }

        $fileType = exif_imagetype($_FILES["file"]["tmp_name"]);
        $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
        if (!in_array($fileType, $allowed)) {
            exit("Аватар должен быть в    формате <strong>JPG,GIF или PNG</strong>");
        }

        $source = $_FILES["file"]["tmp_name"];
        $path_to_90_directory = 'avatars/';
        $date = time();
        $avatar = $path_to_90_directory . $date . ".jpg";
        $im = 100;
        list($width, $height) = getimagesize($source);

        if ($width > $height) {
            $crop = $height;
            $xCrop = ($width - $crop) / 2;
            $yCrop = 0;
        } else {
            $crop = $width;
            $yCrop = ($height - $crop) / 2;
            $xCrop = 0;
        }

        $image = new Imagick($source);
        $image->cropImage($crop, $crop, $xCrop, $yCrop);
        $image->thumbnailImage($im, $im);
        $image->setImageFormat('jpeg');
        $image->setImageCompressionQuality(90);
    }
//------------------------------------------------------------------------------    
//              Заносим клиента в базу. Отправляем мыло для активации.
//------------------------------------------------------------------------------

    $query = mysqli_query($db, "INSERT INTO users (username,login,password,email,avatar,date)    VALUES('$username','$login','$password','$email', '$avatar',NOW())") or die(mysqli_error());

    if ($query == 'TRUE') {
        $res1 = mysqli_query($db, "SELECT id, login FROM users WHERE login='$login'") or die(mysqli_error());
        $userData1 = mysqli_fetch_assoc($res1);
        $login = $userData1['login'];
        $activation = md5($userData1['id']) . md5($login);
        $subject = "Подтверждение регистрации"; //тема сообщения
        $message = "Здравствуйте! Спасибо за регистрацию на citename.ru\nВаш логин:    " . $login . "\nBaш пароль " . $r_password . "\n
            Перейдите    по ссылке, чтобы активировать ваш    аккаунт:\nhttp://brovary/registrationEnter/activation.php?login=" . $login . "&codee=" . $activation . "\nС    уважением,\n
            Администрация    citename.ru"; //содержание сообщение
        $response = mail($email, $subject, $message, "Content-type:text/html;    Charset=utf-8\r\n"); //отправляем сообщение
        if ($response == TRUE) {
            echo "Вам на E-mail выслано письмо с cсылкой, для подтверждения регистрации.    Внимание! Ссылка действительна 1 час."; //говорим о    отправленном письме пользователю
            if (isset($image)) {
                file_put_contents($avatar, $image);
            }
        } else {
            mysqli_query($db, "DELETE FROM users WHERE login='$login'") or die(mysqli_error());
            echo 'Ошибка отправки письма, попробуйте еще раз!';
        }
    }
} else {
    exit('Неверный повтор пароля!');
}


    