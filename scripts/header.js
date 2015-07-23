(function ($) {
    $(document).ready(function () {

        var $header = $('#header');
        var $news = $('#news');
        var i = 0;
        var $listings = $('#listings');
        var $search = $('#search');
        var $headerDown = $('#headerDown');
        var $searchMain = $('#searchMain');
        var $enter = $('#enter');
        var $enterMain = $('#enterMain');
//------------------------------------------------------------------------------
//                            Events Header
//------------------------------------------------------------------------------

//-----------------------------------------------------------------------1------

        $news.click(function () {

            $('#panelNews').slideToggle('slow');
            i = 1;
            hideHeader();
            $news.css({
                borderBottom: "none",
                boxShadow: "inset 0px 5px 10px #000"
            });
            this.clicked = this.clicked === undefined ? false : !this.clicked;
            if (this.clicked) {
                i = 0;
                showHeader();
            }
        });
//--------------------------------------------------------------------------2---

        $header.hover(
                function () {
                    if (i === 0) {
                        $(this).data('timeout', setTimeout(function () {
                            showHeader();
                        }, 1000));
                    }
                },
                function () {
                    if (i === 0) {
                        clearTimeout($(this).data('timeout'));
                        $(this).data('timeout', setTimeout(function () {
                            $news.css({
                                height: "24px",
                                marginTop: "0px",
                                border: "solid 1px black"
                            });
                            hideHeader();
                        }, 1000));
                    }
                });
//------------------------------------------------------------------------3-----

        $search.click(function () {

            $searchMain.css({
                display: "inline"
            }).animate({opacity: 0.97}, 500);
        });
        $('#closeSearch').click(function () {
            $searchMain.css({display: "none", opacity: 0});
        });
//------------------------------------------------------------------------4-----

        $enter.click(function () {

            $enterMain.css({
                display: "inline"
            }).animate({opacity: 0.97}, 500);
            $('#registrationField').fadeOut();
            $('#sendPassField').fadeOut();
            $('#enterField').fadeIn();
        });
        $('.closeEnter').click(function () {
            $enterMain.css({display: "none", opacity: 0});
            $('#messengerEnter, #messengerReg, #messengerPass').css({opacity: "0"});
        });
        $('#a_reg').click(function (e) {
            e.preventDefault();
            $('#enterField').fadeOut(500);
            $('#registrationField').fadeIn(500);
        });
        $('#a_pass').click(function (e) {
            e.preventDefault();
            $('#enterField').fadeOut(500);
            $('#sendPassField').fadeIn(500);
        });
//------------------------------------------------------------------------5-----

        $('#buttonEnter').click(function () {
            
            setTimeout(function () {
                var $messengerEnterText = $('#messengerEnter').text().trim();
                if ($messengerEnterText !== "f") {
                    $('#messengerEnter').animate({opacity: "1"}, 500);
                } else {
                    $('#messengerEnter').css({opacity: "0"});
                }
                if ($messengerEnterText === "Вы успешно вошли на сайт!") {
                    
                    location.reload();
                    alert($messengerEnterText);
                }
            }, 50);
        });
//------------------------------------------------------------------------6-----

        $('#buttonReg').click(function () {
            $('body, html').animate({scrollTop: 0}, 0);
            setTimeout(function () {
                var $messengerRegText = $('#messengerReg').text().trim();
                if ($messengerRegText !== "f") {
                    $('#messengerReg').animate({opacity: "1"}, 500);
                } else {
                    $('#messengerReg').css({opacity: "0"});
                }
            }, 500);
        });
//------------------------------------------------------------------------7-----

        $('#buttonSendPass').click(function () {
            setTimeout(function () {
                var $messengerPassText = $('#messengerPass').text().trim();
                if ($messengerPassText !== "f") {
                    $('#messengerPass').animate({opacity: "1"}, 500);
                } else {
                    $('#messengerPass').css({opacity: "0"});
                }
            }, 50);
        });
//------------------------------------------------------------------------8-----

        $('#logout').click(function () {
            $.cookie('Login', null);
            $.cookie('uresname', null);
            $.cookie('avatar', null);
            location.reload();
        });

//------------------------------------------------------------------------9----- 
             
//------------------------------------------------------------------------------
//                              Functions
//------------------------------------------------------------------------------
//------------------------------------------------------------------------1-----
        function showHeader() {

            $headerDown.css("borderBottom", "none");
            $news.css({
                height: "50px",
                marginTop: "-25px",
                border: "solid 1px black"

            });
            $listings.css({
                height: "50px",
                width: "300px",
                marginTop: "-25px",
                border: "solid 1px black",
                font: "24px arial",
                lineHeight: "50px"
            });
            $search.css({
                height: "50px",
                width: "450px",
                marginTop: "-25px"

            }).empty().append('<div  id="text" >Поиск..........Бровары</div>').append('<div id="send">');
            $('#text').css({
                float: "left",
                height: "50px",
                width: "398px",
                border: "solid 1px black",
                font: "24px arial",
                lineHeight: "50px",
                backgroundColor: "white"
            });
            $('#send').css({
                float: "right",
                height: "50px",
                width: "48px",
                border: "solid 1px black",
                backgroundImage: "url(images/loopa.png)",
                backgroundSize: "100%"
            });
        }

//------------------------------------------------------------------------2-----

        function hideHeader() {

            $headerDown.css({
                borderBottom: "solid 1px #000"
            });
            $listings.css({
                height: "24px",
                width: "200px",
                marginTop: "0px",
                border: "solid 1px black",
                font: "14px arial",
                lineHeight: "25px"
            });
            $('#text').remove();
            if ($search.length) {
                $search.empty();
            }

            $search.css({
                height: "24px",
                width: "100px",
                backgroundColor: "white",
                float: "right",
                font: "17px arial",
                verticalAlign: "top",
                margin: "0"

            }).append('<p>Поиск...<img id="searchImg" src="images/loopa.png" /></p>');
        }



//------------------------------------------------------------------------3-----


    });
})(jQuery);
function AjaxFormRequest(result_id, formMain, url) {
    jQuery('.spinner').css({display: "inline"});
    jQuery.ajax({
        url: url,
        type: "POST",
        dataType: "html",
        data: $("#" + formMain).serialize(),
        success: function (response) {
            document.getElementById(result_id).innerHTML = response;
            jQuery('.spinner').css({display: "none"});
        },
        error: function (response) {
            document.getElementById(result_id).innerHTML = "<p>Возникла ошибка при отправке формы. Попробуйте еще раз</p>";
        }
    });
    jQuery('form').submit(function () {
        return false;
    });
}

