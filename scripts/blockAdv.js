
/* global array */
var $section, $name;
(function ($) {
    $().ready(function () {

        var $body = $(document.body), $middleBA = $('#middleBA'),
                $domBackBA = $('#domBackBA'), $domShowBA = $('#domShowBA'),
                $tableBA = $('.tableBA'),
                $domBackBAspanNotLast = $('#domBackBA span:not(:last)'),
                $lastSpan = $('#lastSpan'),
                $goBackBA = $('#goBackBA'), $rightImgShowBA = $('.rightImgShowBA'),
                $listings = $('.listings'), $pages = $('.pages'),
                $pagePrev = $('#pagePrev'), $pageNext = $('#pageNext');

        var listingsCount = 11;
        var listingsOnPage = 5;

        var arrayBackPanel = {
            "Чтото": ["Товары", "Продам"],
            //---------
            //----------
            "Ноутбуки": ["Услуги", "Автосервис"],
            "Вакансии": ["Работа"]
        };

        var arrayLastSpan = {
            "nout": ["Ноутбуки"],
            "ctoto": ["Чтото"],
            "vacancii": ["Вакансии"]
        };

//------------------------------------------------------------------------------
//                           Main
//------------------------------------------------------------------------------
//-----------------------------------------------------------------------1------

        for (var key in arrayLastSpan) {
            if (key === $name) {
                $lastSpan.text(arrayLastSpan [key]);
                $('title').text(arrayLastSpan [key]);
                break;
            }
        }
        var text = $lastSpan.text();
        var elemShow = $section;
//------------------------------------------------------------------------2-----

        $('#pageOne').nextUntil().not('hr').hide();
        var p = 1;
        for (var i = 1; i < listingsCount; i++) {
            $('#listFirst').clone().appendTo($middleBA);
            $listings = $('.listings');
            if (i % listingsOnPage === 0) {
                $pages.eq(p).show();
                p++;
            }
        }
        $pagePrev.hide();

        if (listingsCount > 5) {
            $pageNext.show();
        }
//------------------------------------------------------------------------------
//                              Events Middle
//------------------------------------------------------------------------------

//------------------------------------------------------------------------1-----
//                              Create title
//------------------------------------------------------------------------------

        $('.lookImg').hover(function (event) {
            var titleText = $(this).attr('title');
            $(this)
                    .data('tipText', titleText)
                    .removeAttr('title');
            $('<p class="tooltip"></p>')
                    .text(titleText)
                    .appendTo('body')
                    .css('top', (event.pageY - 10) + 'px')
                    .css('left', (event.pageX + 20) + 'px')
                    .fadeIn('slow');
        }, function () {
            $(this).attr('title', $(this).data('tipText'));
            $('.tooltip').remove();
        }).mousemove(function (event) {
            $('.tooltip')
                    .css('top', (event.pageY - 10) + 'px')
                    .css('left', (event.pageX + 20) + 'px');
        });

//----------------------------------------------------------------------2-------

        $('#lookTile').click(function () {
            $listings.css({
                float: "left",
                width: "31%",
                height: "300px",
                margin: "0 0 0 20px"
            });
            $listings.find('img').css({
                width: "100%",
                height: "70%"
            });
            $listings.find('br:not(:last)').hide();
        });

        $('#lookList').click(function () {
            $listings.css({
                float: "none",
                width: "100%",
                height: "100px",
                margin: "15px 0 0 0"
            });
            $listings.find('img').css({
                width: "15%",
                height: "98%"
            });
            $listings.find('br:not(:last)').show();
        });
//----------------------------------------------------------------------3-------

        $domBackBA.hover(function () {
            for (var key in arrayBackPanel) {
                if (key === text) {
                    var arr = arrayBackPanel [key];
                    changeSpan(arr);
                    break;
                }
            }
            $domBackBAspanNotLast.animate({opacity: "1"}, 300);
            $lastSpan.css({letterSpacing: "2px"});
            $rightImgShowBA.animate({opacity: "1"}, 300);
        }, function () {
            $domBackBAspanNotLast.animate({opacity: "0"}, 300);
            $lastSpan.css({letterSpacing: "normal"});
            $rightImgShowBA.animate({opacity: "0"}, 300);
        });
//-----------------------------------------------------------------------4------

        $goBackBA.click(function () {
            goBack();
            $lastSpan.before('<br>');
            $domBackBA.hover(function () {
                $domBackBAspanNotLast.css({display: "inline"});
                $lastSpan.css({letterSpacing: "2px"});
                $rightImgShowBA.css({display: "inline"});
            }, function () {
                $domBackBAspanNotLast.css({display: "none"});
                $lastSpan.css({letterSpacing: "normal"});
                $rightImgShowBA.css({display: "none"});
            });
        });
//------------------------------------------------------------------------5-----

        $tableBA.mouseenter(function () {
            $(this).css({backgroundColor: "#6A5ACD",
                boxShadow: "inset 0 -10px 0px #483D8B"
            }).prepend('<img id="goRight" src="images/right.png"/>');
        });
        $tableBA.mouseleave(function () {
            $(this).css({backgroundColor: "#8470FF",
                boxShadow: "none"});
            $("#goRight").remove();
        });
//-----------------------------------------------------------------------6------

        var s = 0;
        var returnn;
        var textSlaid;
        $tableBA.click(function () {
            textSlaid = $(this).text();
            $("#domBackBA span").eq(s).next().next().animate({opacity: "0"}, 0).text(textSlaid).css({display: "inline", fontSize: "16px"});
            $rightImgShowBA.eq(s).css({display: "inline"});
            returnn = searchText($(this));
            s++;

        });
//------------------------------------------------------------------------7-----

        $domBackBAspanNotLast.click(function () {
            $(this).nextUntil('div').fadeOut(500);
            slideShow(elemShow);
            searchText($(this));
            nextPage();
            $domBackBA.off();
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
        });
//------------------------------------------------------------------------8-----

        $('#listName strong, .prevNext strong').hover(function () {
            $(this).css({
                background: "#1E90FF",
                color: "white"
            });
        }, function () {
            $(this).css({
                background: "white",
                color: "#1E90FF"
            });
        });
//------------------------------------------------------------------------9-----

        $pages.click(function () {
            var pageNumber = parseInt($(this).text());
            $(this).css({backgroundColor: "#1E90FF"});
            $(this).find('strong').css({color: "white"});
            $pages.not($(this)).css({backgroundColor: "white"});
            $pages.find('strong').not($(this).find('strong')).css({color: "#1E90FF"});
            if (pageNumber !== 1) {
                $pagePrev.show();
            } else {
                $pagePrev.hide();
            }

            if (pageNumber === p) {
                $pageNext.hide();
            } else {
                $pageNext.show();
            }
        });
//------------------------------------------------------------------------10----

        var pageHref, $activePage, pageNumberPN;
        $('.prevNext').click(function () {
            var textPrevNext = $(this).text();
            for (var i = 0; i < p; i++) {
                if ($pages.eq(i).css("backgroundColor") === 'rgb(30, 144, 255)') {
                    if (textPrevNext === "Следующая>>") {
                        $activePage = $pages.eq(i).next();
                        pageNumberPN = parseInt($pages.eq(i).next().text());
                        pageHref = $pages.eq(i).next().find('a').attr('href');
                    } else {
                        $activePage = $pages.eq(i).prev();
                        pageNumberPN = parseInt($pages.eq(i).prev().text());
                        pageHref = $pages.eq(i).prev().find('a').attr('href');
                    }
                    break;
                }
            }
            $(this).attr('href', pageHref);
            $activePage.css({backgroundColor: "#1E90FF"});
            $activePage.find('strong').css({color: "white"});
            $pages.not($activePage).css({backgroundColor: "white"});
            $pages.find('strong').not($activePage.find('strong')).css({color: "#1E90FF"});
            if (pageNumberPN !== 1) {
                $pagePrev.show();
            } else {
                $pagePrev.hide();
            }
            if (pageNumberPN === p) {
                $pageNext.hide();
            } else {
                $pageNext.show();
            }
        });
//------------------------------------------------------------------------------
//                              Functions
//------------------------------------------------------------------------------
//------------------------------------------------------------------------1-----

        function slideShow(elemShow) {
            if (elemShow === "work" || elemShow === "organization") {
                $domShowBA.find('.tableBA').slice(7, 30).hide();
                $domShowBA.find('#advS2,#imgNextPageBA, #imgBeforePageBA').hide();
            } else if (elemShow === "goods") {
                $domShowBA.find('.tableBA').slice(3, 30).hide();
                $domShowBA.find('.advertising,#imgNextPageBA, #imgBeforePageBA').hide();
            }
            $goBackBA.css({opacity: "1"});
        }
//------------------------------------------------------------------------2-----

        function goBack() {
            $lastSpan.prevUntil('div').fadeOut(500);
            $domShowBA.slideUp(700);
            $domShowBA.find('.tableBA,.advertising, #nextPageBA').slice(0, 30).show(700);
            $lastSpan.fadeIn(1000);
            $goBackBA.css({opacity: "0"});
            s = 0;
        }
//------------------------------------------------------------------------3-----    

        function scroll_to_elem(elem, speed, top) {
            var destination = $(elem).offset().top - top;
            $body.animate({scrollTop: destination}, speed); //1100 - скорость
        }
//------------------------------------------------------------------------4-----

        function nextPage() {
            $('#imgNextPageBA').click(function () {
                $domShowBA.animate({scrollTop: "490"}, 1000);
            });
            $('#imgBeforePageBA').click(function () {
                $domShowBA.animate({scrollTop: "0"}, 1000);
            });
        }
//----------------------------------------------------------------------5-------

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
                $tableBA.css({backgroundColor: "#8470FF",
                    boxShadow: "none"});
                $("#goRight").remove();
                return 0;
            }
        }
//------------------------------------------------------------------------6-----

        function changeMiddleText(arr) {
            var len = arr.length;
            $domShowBA.each(function () {
                for (var i = 0; i < len; i++) {
                    $domShowBA.find('a').eq(i).replaceWith(arr[i][0]);
                    $domShowBA.find('a').eq(i).attr('href', arr[i][1]).css({color: "#000"});
                }
            });
            changingTheNumberOfTables(len);
            animateShow();
        }
//-----------------------------------------------------------------------7-----

        function changeSpan(arr) {
            var len = arr.length;
            if (len === 1) {
                $('.rightImgShowBA:eq(0)').css({display: "inline"});
            } else if (len === 2) {
                $('.rightImgShowBA:eq(0), .rightImgShowBA:eq(1)').css({display: "inline"});
            } else {
                $('.rightImgShowBA:eq(0), .rightImgShowBA:eq(1), .rightImgShowBA:eq(2)').css({display: "inline"});
            }
            $domBackBA.each(function () {
                for (var i = 0; i < len; i++) {
                    $domBackBA.find('span').eq(i).text(arr[i]);
                }
            });
        }
//-----------------------------------------------------------------------8------

        function changingTheNumberOfTables(len) {
            $domShowBA.find('.tableBA').show().slice(len, 30).hide();
            $domShowBA.css({
                maxHeight: "470px",
                overflowY: "scroll"
            });
            if (len < 8 && len > 3) {
                $('#advS2, #imgNextPageBA, #imgBeforePageBA').css({display: "none"});
            } else if (len <= 3) {
                $('#advS1,#advS2, #imgNextPageBA, #imgBeforePageBA').css({display: "none"});
            } else {
                $('#advS1,#advS2, #imgNextPageBA, #imgBeforePageBA').show();
            }
        }
//------------------------------------------------------------------------9-----

        function animateShow() {
            $domShowBA.children().css({opacity: "0"});
            $domShowBA.width("1%");
            $domShowBA.animate({width: "100%"}, 700);
            $domShowBA.children().delay(1000).animate({opacity: "1"}, 300);
            $("#domBackBA span").animate({opacity: "1"}, 500);
            $rightImgShowBA.animate({opacity: "1"}, 1000);
            $domShowBA.slideDown(1000);
            $tableBA.css({backgroundColor: "#8470FF",
                boxShadow: "none"});
            $("#goRight").remove();
        }
    });
})(jQuery);