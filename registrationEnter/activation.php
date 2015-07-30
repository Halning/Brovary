
<pre>
    <?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    header("content-type:text/html;charset=utf-8");

    $db = mysqli_connect("localhost", "root", "565456a", "Brovary") or die(mysqli_error());

    mysqli_query($db, "DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(date) > 3600") or die(mysqli_error()); //удаляем пользователей из базы


    if (isset($_GET['codee'])) {
        $code = htmlspecialchars(htmlentities(strip_tags($_GET['codee']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
    } //код подтверждения 
    else {
        exit("Вы    зашли на страницу без кода подтверждения!");
    } //если не указали code,    то выдаем ошибку
    if (isset($_GET['login'])) {
        $login = htmlspecialchars(htmlentities(strip_tags($_GET['login']), ENT_QUOTES, "UTF-8"), ENT_QUOTES);
    } //логин,который    нужно активировать
    else {
        exit("Вы    зашли на страницу без логина!");
    } //если не указали логин, то выдаем ошибку


    $res = mysqli_query($db, "SELECT    *     FROM    users WHERE login='$login'") or die(mysqli_error()); //извлекаем    идентификатор пользователя с данным логином
    $userData = mysqli_fetch_assoc($res);
    $username = $userData['username'];
    $id = $userData['id'];
    $avatar = 'http://brovary/registrationEnter/' .$userData['avatar'];
    $activation = md5($userData['id']) . md5($login); //создаем    такой же код подтверждения


    if ($activation == $code) {//сравниваем полученный из url и сгенерированный код 
        session_start();
        setcookie('Login', 'true', time() + 3600, "/", '', 0, true);
        SetCookie('avatar', $avatar, time() + 3600, "/", '', 0, true);
        setcookie('username', $username, time() + 3600, "/", '', 0, true);
        setcookie('id', $id, time() + 3600, "/", '', 0, true);
        $_SESSION['login'] = $login;
        $_SESSION['username'] = $username;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['id'] = $id;
        echo $login . "\n";
        mysqli_query($db, "UPDATE    users SET activation='1' WHERE login='$login'"); //если равны, то активируем пользователя
        echo "Ваш Е-мейл подтвержден! Через пять секунд вы автоматически перейдете на главную страницу!";
        header('HTTP/1.1 200 OK');
        header('refresh: 5; http://Brovary/index.php');
    } else {
        echo "Ошибка! Ваш Е-мейл не    подтвержден! Через пять секунд вы автоматически перейдете на главную страницу!";
        header('HTTP/1.1 200 OK');
        header('refresh: 5; http://Brovary/index.php');
        //если    же полученный из url и    сгенерированный код не равны, то выдаем ошибку
    }
    ?>

</pre>
