<?php
$Login = filter_input(INPUT_COOKIE, 'Login', FILTER_VALIDATE_BOOLEAN);

if (!isset($Login)) {

    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    $client_id = '4998094'; // ID приложения
    $client_secret = 'mwMuCWQYB26JRl5WOt6V'; // Защищённый ключ
    $redirect_uri = 'http://brovary/index.php'; // Адрес сайта

    $url = 'http://oauth.vk.com/authorize';

    $params = array(
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'response_type' => 'code'
    );
    $urla = $url . '?' . urldecode(http_build_query($params));

    include 'registrationEnter/vk-auth.php';


    $client_id_f = '373349032860809'; // Client ID
    $client_secret_f = '82fe53776305b6cbe77554e1885c238d'; // Client secret
    $redirect_uri_f = 'http://localhost/brovary/index.php'; // Redirect URIs

    $url_f = 'https://www.facebook.com/dialog/oauth';

    $params_f = array(
        'client_id' => $client_id_f,
        'redirect_uri' => $redirect_uri_f,
        'response_type' => 'code',
        'scope' => 'email,user_birthday'
    );

    $urla_f = $url_f . '?' . urldecode(http_build_query($params_f));
    include 'registrationEnter/f-auth.php';
    ?>






    <div class="mainAll" id="enterMain">
        <div id="enterField" class="fields">
            <div id="loading" class="spinner"></div>
            <img class="closeEnter" src="/images/close.png"/>
            <div id="messengerEnter" class="messenger"></div>
            <form class="forms" id="loginForm" action="" method="post">
                <h1>Форма входа</h1>
                <fieldset id="inputsE">
                    <div class="icon"></div>
                    <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                    <input class="password" name="e_password" type="password" placeholder="Пароль" required>
                </fieldset>
                <fieldset id="actionsE">
                    <input class="submits" type="submit" id="buttonEnter" value="ВОЙТИ" onclick="AjaxFormRequest('messengerEnter', 'loginForm', 'registrationEnter/testreg.php')">
                    <a id="a_pass" href="">Забыли пароль?</a><a id="a_reg" href="">Регистрация</a>
                </fieldset>
            </form>

            <p>Зайти через социальные сети.</p>
            <div id="vkImg"><a  href="<?php echo $urla ?>"></a></div>
            <div id="facImg"><a href="<?php echo $urla_f ?>"></a></div>

        </div>



        <div id="registrationField" class="fields">
            <div id="loading1" class="spinner"></div>
            <img class="closeEnter" src="/images/close.png"/>
            <div id="messengerReg" class="messenger"></div>

            <form class="forms" id="regisForm" enctype="multipart/form-data" action="" method="post" >
                <h1>Форма регистрации</h1>
                <fieldset id="inputsR">
                    <input class="user" name="username" type="text" placeholder="Username" autofocus required> 
                    <input class="user" name="login" type="text" placeholder="Логин" required>
                    <input class="email" name="email"    type="text" placeholder="Почта" required>
                    <input class="password" name="password" type="password" placeholder="Пароль" required>
                    <input class="password" name="r_password" type="password" placeholder="Повтор пароля" required>
                    <input  class="user" type="file" name="file">
                </fieldset>
                <div class="g-recaptcha" data-sitekey="6LdRIgoTAAAAAGuOPPg8mvlBaG70-xFGTMB31Lkg"></div>
                <fieldset id="actionsR">
                    <input class="submits" type="submit" name="submit" id="buttonReg" value="РЕГИСТРАЦИЯ" onclick="AjaxFormRequest('messengerReg', 'regisForm', 'registrationEnter/save_user1.php')"/>
                </fieldset>
            </form>

        </div> 


        <div id="sendPassField" class="fields">
            <div id="loading2" class="spinner"></div>
            <img class="closeEnter" src="/images/close.png"/>
            <div id="messengerPass" class="messenger"></div>
            <form class="forms" id="sendPassForm" action="" method="post">
                <h1>Востановление пароля</h1>
                <fieldset id="inputsP">
                    <input class="email" name="email_p" type="text" placeholder="Почта" required>
                </fieldset>
                <fieldset id="actionsp">
                    <input class="submits" type="submit" id="buttonSendPass" value="ОТПРАВИТЬ" onclick="AjaxFormRequest('messengerPass', 'sendPassForm', 'registrationEnter/send_pass.php')">
                </fieldset>
            </form>

        </div>


    </div>
<?php } else { ?>

    <div class="mainAll" id="addlistMain">
        <div class="fields" id="addlistField">
            <div id="loading3" class="spinner"></div>
            <img class="closeEnter" src="/images/close.png"/>
            <div id="messengerAddList" class="messenger"></div>
            <form class="forms" id="addlistForm" action="" method="post">
                <h1>Регистрация  предприятия!</h1>
                <fieldset id="inputsAL">
                    <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                    <input class="password" name="e_password" type="password" placeholder="Пароль" required>
                    <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                    <input class="password" name="e_password" type="password" placeholder="Пароль" required>
                    <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                    <input class="password" name="e_password" type="password" placeholder="Пароль" required>
                    <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                    <input class="password" name="e_password" type="password" placeholder="Пароль" required>
                </fieldset>
                <!--<div class="g-recaptcha" data-sitekey="6LdRIgoTAAAAAGuOPPg8mvlBaG70-xFGTMB31Lkg"></div>-->
                <fieldset id="actionsAL">
                    <input class="submits" type="submit" id="buttonAddList" value="Зарегистрировать" onclick="AjaxFormRequest('messengerAddList', 'addlistForm', 'registrationEnter/testreg.php')">
                </fieldset>
            </form>
        </div>


        <?php if(isset($_COOKIE['id'])) { ?>

        <div class="fields" id="pageUserField">
            <div id="loading3" class="spinner"></div>
            <img class="closeEnter" src="/images/close.png"/>
            <div id="messengerPageUser" class="messenger"></div>
            <form class="forms" id="pageUserForm" action=""    method='post'>
                <h1>Страница пользователя<br><?php echo filter_input(INPUT_COOKIE, 'username', FILTER_SANITIZE_STRING);?>!</h1>
                <fieldset id="inputsPU">
                    <input class="user" name="usernameNew" placeholder="Новое Имя">
                    <input class="user" name='loginNew' type='text' placeholder="Новый Логин">               
                    <img alt='аватар' src='<?php echo filter_input(INPUT_COOKIE, 'avatar', FILTER_VALIDATE_URL, FILTER_SANITIZE_URL) ?>'><br>
                    Изображение должно быть    формата jpg, gif или png. Изменить аватар:<br>
                    <input class="user" type="FILE"    name="fileNew">
                </fieldset>
                <fieldset id="actionsPU">
                    <input class="submits" type='submit' id="buttonPageUser" name='submit' value='Сохранить' onclick="AjaxFormRequest('messengerPageUser', 'pageUserForm', 'registrationEnter/upload_user_page.php')">
                </fieldset>
            </form>

        </div>
        <?php } ?>
    </div>
    <?php
}