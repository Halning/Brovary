
<pre>
    <?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    header("content-type:text/html;charset=utf-8");

    if (isset($_GET['codee'])) {
        $code = htmlspecialchars(htmlentities(strip_tags($_GET['codee']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
    } else {
        exit("Вы    зашли на страницу без кода подтверждения!");
    }
    if (isset($_GET['login']) || isset($code)) {
        $login = htmlspecialchars(htmlentities(strip_tags($_GET['login']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);

        $db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());
        mysqli_query($db, "DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(date) > 3600") or die(mysqli_error());

        $res = mysqli_query($db, "SELECT    *     FROM    users WHERE login='$login'") or die(mysqli_error());
        $userData = mysqli_fetch_assoc($res);
        $username = $userData['username'];
        $id = $userData['id'];
        $avatar = 'http://brovary/registrationEnter/' . $userData['avatar'];
        $activation = md5($userData['id']) . md5($login);

        if ($activation == $code) {
            session_start();
            setcookie('Login', 'true', time() + 360000, "/", '', 0, true);
            SetCookie('avatar', $avatar, time() + 360000, "/", '', 0, true);
            setcookie('username', $username, time() + 360000, "/", '', 0, true);
            setcookie('id', $id, time() + 360000, "/", '', 0, true);
            $_SESSION['login'] = $login;
            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = $avatar;
            $_SESSION['id'] = $id;
            echo $login . "\n";
            mysqli_query($db, "UPDATE    users SET activation='1' WHERE login='$login'");
            echo "Ваш Е-мейл подтвержден! Через пять секунд вы автоматически перейдете на главную страницу!";
            header('HTTP/1.1 200 OK');
            header('refresh: 5; http://Brovary/index.php');
        } else {
            echo "Ошибка! Ваш Е-мейл не    подтвержден! Через пять секунд вы автоматически перейдете на главную страницу!";
            header('HTTP/1.1 200 OK');
            header('refresh: 5; http://Brovary/index.php');
        }
    } else {
        exit("Вы    зашли на страницу без логина!");
    }
    ?>
</pre>
