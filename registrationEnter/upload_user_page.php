<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

//------------------------------------------------------------------------------
//                      Проверяем залогинен ли пользователь                      
//------------------------------------------------------------------------------

session_start();

$db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());

if (isset($_COOKIE['id'])) {
    $id = filter_var($_COOKIE['id'], FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
} else if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    exit("Вы зашли на    страницу без параметра!");
}


//------------------------------------------------------------------------------
//     Дополнительная проверка если залогинен записываем имя пользователя
//------------------------------------------------------------------------------

if (!empty($_SESSION['username']) && !empty($_SESSION['avatar'])) {
    $username = $_SESSION['username'];
} else if (isset($_COOKIE['Login']) && isset($_COOKIE['avatar']) && isset($_COOKIE['username'])) {
    $username = filter_input(INPUT_COOKIE, 'username', FILTER_SANITIZE_STRING);
}
//------------------------------------------------------------------------------
//                      Изменяем данные клиента
//------------------------------------------------------------------------------

if (isset($username)) {
    $response = mysqli_query($db, "SELECT id,login, avatar FROM    users WHERE  username='$username'");
    $userData = mysqli_fetch_assoc($response);
    $oldAvatar = $userData['avatar'];

    if (empty($userData['login'])) {
        exit("Пользователя не существует! Возможно он был удален.");
    } //если такого не существует 

    if (empty($userData['id'])) {
        exit("Вход на эту страницу разрешен    только зарегистрированным пользователям!");
    } else if (empty($_POST['usernameNew']) && empty($_POST['loginNew']) && $_FILES['fileNew']['name'] == "") {
        exit('Вы не внесли никаких изменений!');
    } else {
        if (!empty($_POST['usernameNew'])) {
            $usernameNew = stripslashes(htmlspecialchars(trim(filter_input(INPUT_POST, 'usernameNew', FILTER_SANITIZE_STRING))));
        } else {
            $usernameNew = $username;
        }
        if (!empty($_POST['loginNew'])) {
            $loginNew = stripslashes(htmlspecialchars(trim(filter_input(INPUT_POST, 'loginNew', FILTER_SANITIZE_STRING))));
            if (strlen($loginNew) < 3 || strlen($loginNew) > 15) {
                exit("Логин должен состоять не менее чем из 3 символов и не более чем из    15.");
            }
        } else {
            $loginNew = $userData['login'];
        }

        if (isset($_FILES['fileNew'])) {

            $fupload = $_FILES['fileNew'];
            if ($fupload == '' or empty($fupload)) {
                unset($fupload); // если переменная $fupload пуста, то удаляем ее
            }
        }
//------------------------------------------------------------------------------
//                      Изменяем аватар клиента
//------------------------------------------------------------------------------       

        if ($_FILES['fileNew']['name'] == "") {
            $avatarNew = $userData['avatar'];
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

            $fileType = exif_imagetype($_FILES["fileNew"]["tmp_name"]);
            $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
            if (!in_array($fileType, $allowed)) {
                exit("Аватар должен быть в    формате <strong>JPG,GIF или PNG</strong>");
            }

            $source = $_FILES["fileNew"]["tmp_name"];
            $path_to_90_directory = 'avatars/';
            $date = time();
            $avatarNew = $path_to_90_directory . $date . ".jpg";
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
            if (isset($image)) {
                file_put_contents($avatarNew, $image);
                if ($oldAvatar != 'avatars/net-avatara.jpg') {
                    unlink($oldAvatar);
                }
            }
        }
//------------------------------------------------------------------------------
//        Записываем новые данные в базу,куки и сессию
//------------------------------------------------------------------------------        

        var_dump($avatarNew);
        var_dump($usernameNew);
        var_dump($loginNew);
        $res = mysqli_query($db, "UPDATE  users SET  username =  '$usernameNew', login = '$loginNew', avatar='$avatarNew' WHERE id = '$id'") or die(mysqli_error());
        if ($res == 'TRUE') {
            unset($_SESSION['login']);
            unset($_SESSION['username']);
            unset($_SESSION['avatar']);
            SetCookie('avatar', '', time() - 360000, "/", '', 0, true);
            SetCookie('username', '', time() - 360000, "/", '', 0, true);
            $_SESSION['login'] = $loginNew;
            $_SESSION['username'] = $usernameNew;
            $_SESSION['avatar'] = $avatarNew;
            SetCookie('avatar', 'http://brovary/registrationEnter/' . $avatarNew, time() + 360000, "/", '', 0, true);
            setcookie('username', $usernameNew, time() + 360000, "/", '', 0, true);
            echo 'Новые данные сохранены!!!';
        }
    }
} else {
    exit("Вход на эту    страницу разрешен только зарегистрированным пользователям!");
}



