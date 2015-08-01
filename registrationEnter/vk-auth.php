 
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//------------------------------------------------------------------------------
//                              Формируем запросы
//------------------------------------------------------------------------------

$client_id = '4998094'; // ID приложения
$client_secret = 'mwMuCWQYB26JRl5WOt6V'; // Защищённый ключ
$redirect_uri = 'http://brovary/index.php'; // Адрес сайта

if (isset($_GET['code'])) {
    $code = htmlspecialchars(htmlentities(strip_tags($_GET['code']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['uid'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }
//------------------------------------------------------------------------------
//          Работаем с полученными данными из вконтакта       
//------------------------------------------------------------------------------   

    if ($result) {
//echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
//echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
//echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
///echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
//echo "День Рождения: " . $userInfo['bdate'] . '<br />';
//echo '<img src="' . $userInfo['photo_big'] . '" />';
//echo "<br />";

        $userId = $userInfo['uid'];
        $login = $userInfo['screen_name'];
        $username = $userInfo['first_name'];
        $avatar = $userInfo['photo_big'];

        $db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());

        $res = mysqli_query($db, "SELECT * FROM uservk WHERE id='$userId'") or die(mysqli_error());
        $userData = mysqli_fetch_assoc($res);

        if (!isset($userData['id']) && $userData['id'] != $userId) {
            mysqli_query("INSERT INTO uservk (id, login, username, avatar)    VALUES('$userId', '$login','$username', '$avatar')") or die(mysqli_error());
        } else if ($login != $userData['login'] || $username != $userData['username'] || $avatar != $userData['avatar']) {
            mysqli_query("UPDATE  uservk SET  username =  '$username', login = '$login', avatar = '$avatar' WHERE id = '$userId'") or die(mysqli_error());
            echo 'Смена данных!!!';
        }
        SetCookie('Login', 'true', time() + 360000, "/", '', 0, true);
        SetCookie('avatar', $avatar, time() + 360000, "/", '', 0, true);
        SetCookie('username', $username, time() + 360000, "/", '', 0, true);
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['username'] = $username;
        $_SESSION['avatar'] = $avatar;
        $u = explode("?", $_SESSION['hurl']);
        var_dump($u);
        if ($u[0] == 'http://brovary/services-nout.html') {
            header('HTTP/1.1 200 OK');
            header('Location:' . $u[0]);
            unset($_SESSION['hurl']);
        } else {
            header('HTTP/1.1 200 OK');
            header('Location: http://Brovary/index.php');
        }
    }
}







