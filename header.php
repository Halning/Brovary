
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/main.css">
        <link rel="stylesheet" href="style/styleBA.css">
        <link rel="stylesheet" href="style/styleER.css">

        <title></title>
        <link rel="shortcut icon" href="images/ico.ico" >
    </head>
    <body>

        <?php
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);
        include 'enterReg.php';
        ?>

        <!-----------------------------------------------------------------------------> 
        <div class="mainAll" id="searchMain">
            <div id="searchField">
                <img id="closeSearch" src="/images/close.png"/>
                <form action="select1.php" method="post">
                    <input id="inputSearch" type="search" name="sear" placeholder="Поиск..." >
                    <img id="loopW" src="/images/loopaWhite.png" /> 
                    <br><br><br>
                    <p>Настройки поиска:</p>
                    <br>
                    <input class="setingsCost" type="text" placeholder="Цена от (грн.)" name="setingsCostD">
                    <input class="setingsCost" type="text" placeholder="Цена до (грн.)" name="setingsCostU">
                    <input id="subSearch" type="submit" value="Искать"/>
                    <p><select class="ssC" size="1" name="costD">
                            <option value="10">от 10 грн.
                            <option value="100">от 100 грн.
                            <option value="300">от 300 грн.
                            <option value="1000">от 1000 грн.
                        </select>
                        <select class="ssC" size="1" name="costU">
                            <option value="100">до 100 грн.
                            <option value="1000">до 1000 грн.
                            <option value="3000">до 3000 грн.
                            <option value="10000">до 10000 грн.
                        </select>
                </form>
            </div>
        </div>

        <div id="main">
            <!----------------------------------------------------------------------------->
            <div id="header"> 
                <?php
                $Login = filter_input(INPUT_COOKIE, 'Login', FILTER_VALIDATE_BOOLEAN);

                if (isset($Login) && $Login == true) {
                    ?>

                    <div id="headerUp">
                        <form id="logout_f" method="post" action="">
                            <input id="logout" type="submit" name="logout" value="Выйти" onclick="AjaxFormRequest('logout', 'logout_f', 'registrationEnter/exit.php')"/>
                        </form>
                        <span>Добро пожаловать, <strong>
                                <?php
                                $username = filter_input(INPUT_COOKIE, 'username', FILTER_SANITIZE_STRING);
                                if (isset($username)) {
                                    ?>
                                    <a id="userPage"><?php echo $username; ?></a>
                                    <?php
                                } else {
                                    echo $_SESSION['username'];
                                }
                                ?></strong>
                            <?php
                            $avatar = filter_input(INPUT_COOKIE, 'avatar', FILTER_VALIDATE_URL, FILTER_SANITIZE_URL);
                            if (isset($avatar)) {
                                ?>
                                <img id="avatar" src="<?php echo $avatar ?>" /></span>
                            <?php
                        } else if (isset($_SESSION['avatar'])) {
                            ?>

                            <img id="avatar" src="<?php echo '/registrationEnter/' . $_SESSION['avatar'] ?>" /></span>

                            <?php
                        } else {
                            echo '<img id="avatar" src="registrationEnter/avatars/net-avatara.jpg" />';
                        }
                        ?>

                    </div>
                    <?php
                } else {
                    echo ' <img id="men" src="images/man.png" />
                <div id="headerUp">
                <span id="enter">Войти</span>
                </div>';
                }
                ?>

                <!----------------------------------------------------------------------------->

                <div id="headerCenter">

                    <div id="title">
                        <h2>БРОВАРЫ ОНЛАЙН СЕРВИС </h2>
                    </div>

                    <div id="weather">

                        <div id="SinoptikInformer" style="width:200px;" class="SinoptikInformer type1">
                            <div class="siHeader"><div class="siLh">
                                    <div class="siMh">
                                        <a onmousedown="siClickCount();" href="https://sinoptik.ua/" target="_blank">Погода</a>
                                        <a onmousedown="siClickCount();" class="siLogo" href="https://sinoptik.ua/" target="_blank"> </a> 
                                        <span id="siHeader"></span></div></div></div>
                            <div class="siBody"><div class="siCity">
                                    <div class="siCityName">
                                        <a onmousedown="siClickCount();" href="https://sinoptik.ua/погода-бровары" target="_blank">Погода в <span>Броварах</span></a>
                                    </div>
                                    <div id="siCont0" class="siBodyContent">
                                        <div class="siLeft">
                                            <div class="siTerm"></div>
                                            <div class="siT" id="siT0"></div>
                                            <div id="weatherIco0"></div></div>
                                        <div class="siInf"><p>влажность: <span id="vl0"></span></p>
                                            <p>давление: <span id="dav0"></span></p>
                                        </div></div></div>
                            </div>
                            <div class="siFooter">
                                <div class="siLf">
                                    <div class="siMf"></div></div></div></div>
                        <script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities=303002317&amp;lang=ru"></script>
                    </div>

                    <!----------------------------------------------------------------------------->

                    <div id="minfin-informer-m1Fn-currency">Загружаем 
                        <a href="http://minfin.com.ua/currency/" target="_blank">курсы валют</a> 
                    </div>
                    <script type="text/javascript">
                                            var iframe = '<ifra' + 'me width="150" height="105" fram' + 'eborder="0" src="http://informer.minfin.com.ua/gen/course/?color=grey" vspace="0" scrolling="no" hspace="0" allowtransparency="true"style="width:150px;height:105px;ove' + 'rflow:hidden;"></iframe>';
                                            var cl = 'minfin-informer-m1Fn-currency';
                                            document.getElementById(cl).innerHTML = iframe;
                    </script>
                </div>

                <!----------------------------------------------------------------------------->

                <div id="headerDown">
                    <div id="news">Новости</div>
                    <div id="eddListings"><span>+</span>Добавить обьявления</div>
                    <div id="search">
                        <p>Поиск...<img id="searchImg" src="/images/loopa.png" /></p>
                    </div>
                </div>
                <div id="panelNews">

                    <?php
                    include 'news.php';
                    ?>

                </div>
            </div>


            <script  src="js/libs/jquery/jquery.js"></script>
            <script  src="js/libs/jquery.pjax/jquery.pjax.js"></script>
            <script  src="js/libs/spin.js/spin.min.js"></script>
            <script  src="/scripts/header.js"></script>
            <script  src="/scripts/array.js"></script>
            <script  src="/scripts/pjax.js"></script>
            <script  src="/scripts/index.js"></script>
            <script  src="/scripts/slider.js"></script>
            <script  src="/scripts/blockAdv.js"></script>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <script type="text/javascript">
                                            var opts = {
                                                lines: 10, // Число линий для рисования
                                                length: 0, // Длина каждой линии
                                                width: 10, // Толщина линии
                                                radius: 20, // Радиус внутреннего круга
                                                corners: 1, // Скругление углов (0..1)
                                                rotate: 0, // Смещение вращения
                                                direction: 1, // 1: по часовой стрелке, -1: против часовой стрелки
                                                color: '#000', // #rgb или #rrggbb или массив цветов
                                                speed: 2, // Кругов в секунду
                                                trail: 17, // Послесвечение
                                                shadow: true, // Тень(true - да; false - нет)
                                                hwaccel: false, // Аппаратное ускорение
                                                className: 'spinner', // CSS класс
                                                zIndex: 2e9, // z-index (по-умолчанию 2000000000)
                                                top: '35', // Положение сверху относительно родителя
                                                left: '275' // Положение слева относительно родителя
                                            };
                                            var target = document.getElementById('loading');
                                            var spinner = new Spinner(opts).spin(target);
                                            var target1 = document.getElementById('loading1');
                                            var spinner1 = new Spinner(opts).spin(target1);
                                            var target2 = document.getElementById('loading2');
                                            var spinner2 = new Spinner(opts).spin(target2);
                                            var target3 = document.getElementById('loading3');
                                            var spinner3 = new Spinner(opts).spin(target3);
                                            var target4 = document.getElementById('loading4');
                                            var spinner4 = new Spinner(opts).spin(target4);
            </script>