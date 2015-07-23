
<pre>
    <?php
    header("content-type:text/html;charset=utf-8");
    
    include ("bd.php"); // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто    измените путь  

    mysql_query("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() -    UNIX_TIMESTAMP(date) > 3600"); //удаляем пользователей из базы
    
    if (isset($_GET['code'])) {
        $code = htmlspecialchars($_GET['code']);
    } //код подтверждения 
    else {
        exit("Вы    зашли на страницу без кода подтверждения!");
    } //если не указали code,    то выдаем ошибку
    if (isset($_GET['login'])) {
        $login = htmlspecialchars($_GET['login']);
    } //логин,который    нужно активировать
    else {
        exit("Вы    зашли на страницу без логина!");
    } //если не указали логин, то выдаем ошибку
    
    
    $result = mysql_query("SELECT    id, username     FROM    users WHERE login='$login'"); //извлекаем    идентификатор пользователя с данным логином
    $myrow = mysql_fetch_array($result);
    $username = $myrow['username'];
    $activation = md5($myrow['id']) . md5($login); //создаем    такой же код подтверждения


    if ($activation == $code) {//сравниваем полученный из url и сгенерированный код 
        session_start();
        $_SESSION['name'] = $login;
        setcookie('Login', 'true', time() + 259200, "/");
        setcookie('username', $username, time() + 259200, "/");
        echo $login . "\n";
        mysql_query("UPDATE    users SET activation='1' WHERE login='$login'"); //если равны, то активируем пользователя
        echo "Ваш Е-мейл подтвержден! Теперь вы можете    зайти на сайт под своим логином! <a href='http://brovary/index.php'>Главная    страница</a>";
    } else {
        echo "Ошибка! Ваш Е-мейл не    подтвержден! <a    href='http://brovary/index.php'>Главная    страница</a>";
        //если    же полученный из url и    сгенерированный код не равны, то выдаем ошибку
    }
    ?>

</pre>
