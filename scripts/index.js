

/* global array */

(function ($) {

    $().ready(function () {
        $('#main').css({height: "150%"});
        $('title').text('Информационный сайт');
        var $body = $(document.body), $middle = $('#middle'),
                $services = $('#services'), $domBack = $('#domBack'), $domShow = $('#domShow'),
                $goods = $('#goods'),
                $work = $('#work'),
                $organization = $('#organization'),
                $goBack = $('#goBack'), $rightImgShow = $('.rightImgShow'),
                $table = $('.table');

//------------------------------------------------------------------------------
//                              Events Middle
//------------------------------------------------------------------------------
//------------------------------------------------------------------------1-----

        $('#buttonReg').click(function () {
            $.post({
                url: 'https://www.google.com/recaptcha/api/siteverify?secret=6LeurQkTAAAAAIO0WQTA2UfwutlNcHC7V0bKBSne&response=post.g-recaptcha-response',
                success: function (data) {
                    alert(1);
                }

            });
        });
        $('#imgNextPage').click(function () {
            $domShow.animate({scrollTop: "490"}, 1000);
        });
        $('#imgBeforePage').click(function () {
            $domShow.animate({scrollTop: "0"}, 1000);
        });

//------------------------------------------------------------------------2-----

        var h = 0;
        var $firstSpan = $('#firstSpan');
        $services.click(function () {
            if (h === 0) {
                h = 1;
                $firstSpan.text('Услуги');
                searchText($firstSpan);
                slideShow($services);
                scroll_to_elem('#services', 1000, 30);
            }
        });
        $goods.click(function () {
            if (h === 0) {
                h = 1;
                $firstSpan.text('Товары');
                searchText($firstSpan);
                slideShow($goods);
                scroll_to_elem('#goods', 1000, 30);
            }

        });
        $work.click(function () {
            if (h === 0) {
                h = 1;
                $firstSpan.text('Работа');
                searchText($firstSpan);
                slideShow($work);
                scroll_to_elem('#work', 1000, 30);
            }
        });
        $organization.click(function () {
            if (h === 0) {
                h = 1;
                $firstSpan.text('Организации');
                searchText($firstSpan);
                slideShow($organization);
                scroll_to_elem('#organization', 1000, 30);
            }
        });
        $goBack.click(function () {
            var firstSpanText = $('#domBack span:first').text();
            if (firstSpanText === "Услуги") {
                goBack($services);
            } else if (firstSpanText === "Товары") {
                goBack($goods);
            } else if (firstSpanText === "Работа") {
                goBack($work);
            } else if (firstSpanText === "Организации") {
                goBack($organization);
            }
            scroll_to_elem('body', 1000, 0);
            h = 0;
        });

//------------------------------------------------------------------------3-----

        $table.mouseenter(function () {
            $(this).css({backgroundColor: "#6A5ACD",
                boxShadow: "inset 0 -10px 0px #483D8B"
            }).prepend('<img id="goRight" src="images/right.png"/>');
        });
        $table.mouseleave(function () {
            $(this).css({backgroundColor: "#8470FF",
                boxShadow: "none"});
            $("#goRight").remove();
        });

//-----------------------------------------------------------------------4------

        var s = 0;
        var returnn;
        var textSlaid;
        $table.click(function () {
            textSlaid = $(this).text();
            $("#domBack span").eq(s).next().next().animate({opacity: "0"}, 0).text(textSlaid).css({display: "inline", fontSize: "16px"});
            $rightImgShow.eq(s).css({display: "inline"});
            returnn = searchText($(this));
            s++;
        });

//---------------------------------------------------------------------------5--

        $("#domBack span:not(:last)").click(function () {

            if (textSlaid !== $(this).text()) {
                searchText($(this));
                s = $(this).index();
                if ($(this).index() === 0) {
                    s = 0;
                }
                if ($(this).index() === 2) {
                    s = s - 1;
                } else
                if ($(this).index() === 4) {
                    s = s - 2;
                }
                $(this).nextUntil('div').css({display: "none"});
            }
        });

//------------------------------------------------------------------------------
//                              Functions
//------------------------------------------------------------------------------
//------------------------------------------------------------------------1-----

        function slideShow(elem) {

            if (elem === $work || elem === $organization) {
                $domShow.find('.table').slice(7, 30).hide();
                $domShow.find('#advS2,#imgNextPage, #imgBeforePage').hide();
            } else if (elem === $goods) {
                $domShow.find('.table').slice(3, 30).hide();
                $domShow.find('.advertising,#imgNextPage, #imgBeforePage').hide();
            }
            elem
                    .after($domShow)
                    .after($domBack)
                    .hide(10);
            $domBack.show(500);
            $domShow.slideDown(500);
        }

//------------------------------------------------------------------------2-----

        function goBack(elem) {
            var SpanFirst = $domBack.find('span:first');
            $domShow.slideUp(700);
            $domBack.hide(700);
            elem.show(700);
            $domShow.find('.table,.advertising, #nextPage').slice(0, 30).show(700);
            SpanFirst.nextUntil('div').css({display: "none"});
            s = 0;
        }
//------------------------------------------------------------------------3-----    

        function scroll_to_elem(elem, speed, top) {
            var destination = $(elem).offset().top - top;
            $('body, html').animate({scrollTop: destination}, speed); //1100 - скорость
        }

//----------------------------------------------------------------------4-------
        function searchText(elem) {
            var text = elem.text();
            for (var key1 in array) {
                if (key1 === text) {
                    var arr = array [key1];
                    changeMiddleText(arr);
                    text = " ";
                    break;
                }
            }

            if (text !== " ") {
                $table.css({backgroundColor: "#8470FF",
                    boxShadow: "none"});
                $("#goRight").remove();
                return 0;
            }
        }

//------------------------------------------------------------------------5-----

        function changeMiddleText(arr) {
            var len = arr.length;
            
            $domShow.each(function () {
                for (var i = 0; i < len; i++) {
                    $domShow.find('a').eq(i).replaceWith(arr[i][0]);
                    $domShow.find('a').eq(i).attr('href', arr[i][1]).css({color: "#000"});
                }
            });
            changingTheNumberOfTables(len);
            animateShow();
        }

//-----------------------------------------------------------------------6-----

        function changingTheNumberOfTables(len) {
            $domShow.find('.table').show().slice(len, 30).hide();;
            $domShow.css({
                maxHeight: "470px",
                overflowY: "scroll"
            });
            if (len < 8 && len > 3) {
                $('#advS2, #imgNextPage, #imgBeforePage').hide();
            } else if (len <= 3) {
                $('#advS1,#advS2, #imgNextPage, #imgBeforePage').hide();
            } else {
                $('#advS1,#advS2, #imgNextPage, #imgBeforePage').show();
            }
        }

//-------------------------------------------------------------------------7----

        function animateShow() {
            $domShow.children().css({opacity: "0"});
            $domShow.width("1%");
            $domShow.animate({width: "100%"}, 500);
            $domShow.children().delay(600).animate({opacity: "1"}, 200);
            $("#domBack span").animate({opacity: "1"}, 500);
            $rightImgShow.animate({opacity: "1"}, 1000);
            $table.css({backgroundColor: "#8470FF",
                boxShadow: "none"});
            $("#goRight").remove();
        }

    });
})(jQuery);