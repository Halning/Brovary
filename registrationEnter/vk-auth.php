
<?php

header("content-type:text/html;charset=utf-8");
$client_id = '4998094'; // ID приложения
$client_secret = 'mwMuCWQYB26JRl5WOt6V'; // Защищённый ключ
$redirect_uri = 'http://brovary/index.php'; // Адрес сайта


if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
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

    if ($result) {
        //echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
        //echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        //echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
        //echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
        //echo "День Рождения: " . $userInfo['bdate'] . '<br />';
        //echo '<img src="' . $userInfo['photo_big'] . '" />';
        //echo "<br />";

        $userId = $userInfo['uid'];
        $login = $userInfo['screen_name'];
        $username = $userInfo['first_name'];
        $avatar = $userInfo['photo_big'];

        include 'bd.php';


        $query1 = mysql_query("SELECT * FROM uservk WHERE id='$userId'") or die(mysql_error());
        $userData = mysql_fetch_array($query1);

        if (!isset($userData['id']) && $userData['id'] != $userId) {
            $query = mysql_query("INSERT INTO uservk (id, login, username, avatar)    VALUES('$userId', '$login','$username', '$avatar')") or die(mysql_error());
            //var_dump($userData['id']);
        } else if ($login != $userData['login'] || $username != $userData['username'] || $avatar != $userData['avatar']) {
            $query = mysql_query("UPDATE  uservk SET  username =  '$username', login = '$login', avatar = '$avatar' WHERE id = '$userId'") or die(mysql_error());
            echo 'Смена данных!!!';
 
        }
            session_start();
            $_SESSION['name'] = $login;
            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = $avatar;
            setcookie('avatar', $avatar, time() + 3600, "/");
            setcookie('Login', 'true', time() + 3600, "/");
            setcookie('username', $username, time() + 3600, "/");
            
        
    }
}







