

<div id="enterMain">
    <div id="enterField" class="fields">
        <div id="loading" class="spinner"></div>
        <img class="closeEnter" src="/images/close.png"/>
        <div id="messengerEnter" class="messenger"></div>
        <form id="login" action="" method="post">
            <h1>Форма входа</h1>
            <fieldset id="inputsE">
                <input class="user" name="e_login" type="text" placeholder="Логин" autofocus required>   
                <input class="password" name="e_password" type="password" placeholder="Пароль" required>
            </fieldset>
            <fieldset id="actionsE">
                <input type="submit" id="buttonEnter" value="ВОЙТИ" onclick="AjaxFormRequest('messengerEnter', 'login', 'registrationEnter/testreg.php')">
                <a id="a_pass" href="">Забыли пароль?</a><a id="a_reg" href="">Регистрация</a>
            </fieldset>
        </form>
        <?php
        header("content-type:text/html;charset=utf-8");
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
        $redirect_uri_f = 'http://localhost/BrovaryOnline/index.php'; // Redirect URIs

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
        <p>Зайти через социальные сети.</p>
        <div id="vkImg"><a href="<?php echo $urla ?>"></a></div>
        <div id="facImg"><a href="<?php echo $urla_f ?>"></a></div>

    </div>



    <div id="registrationField" class="fields">
        <div id="loading1" class="spinner"></div>
        <img class="closeEnter" src="/images/close.png"/>
        <div id="messengerReg" class="messenger"></div>

        <form id="regis" action="" method="post">
            <h1>Форма регистрации</h1>
            <fieldset id="inputsR">
                <input class="user" name="username" type="text" placeholder="Username" autofocus required> 
                <input class="user" name="login" type="text" placeholder="Логин" required>
                <input class="email" name="email"    type="text" placeholder="Почта" required>
                <input class="password" name="password" type="password" placeholder="Пароль" required>
                <input class="password" name="r_password" type="password" placeholder="Повтор пароля" required>
            </fieldset>
            <div class="g-recaptcha" data-sitekey="6LdRIgoTAAAAAGuOPPg8mvlBaG70-xFGTMB31Lkg"></div>
            <fieldset id="actionsR">
                <input type="submit" name="submit" id="buttonReg" value="РЕГИСТРАЦИЯ" onclick="AjaxFormRequest('messengerReg', 'regis', 'registrationEnter/save_user1.php')"/>
            </fieldset>
        </form>

    </div> 


    <div id="sendPassField" class="fields">
        <div id="loading2" class="spinner"></div>
        <img class="closeEnter" src="/images/close.png"/>
        <div id="messengerPass" class="messenger"></div>
        <form id="sendPass" action="" method="post">
            <h1>Востановление пароля</h1>
            <fieldset id="inputsP">
                <input class="email" name="email" type="text" placeholder="Почта" required>
            </fieldset>
            <fieldset id="actionsp">
                <input type="submit" id="buttonSendPass" value="ОТПРАВИТЬ" onclick="AjaxFormRequest('messengerPass', 'sendPass', 'registrationEnter/send_pass.php')">
            </fieldset>
        </form>

    </div>


</div>

