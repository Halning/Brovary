
(function ($) {
    $().ready(function () {
        $(document).ready(function () {

            var $middle = $('#middle');

            $(document).pjax('.table a:not(.logout-link,.login-link,.login_link,[id*="login_link"],[href*="#"],[target="_blank"],'
                    + '[href$="mp3"],[href$="jpg"],[href$="jpeg"],[href$="gif"],[href$="png"],[href$="doc"],[href$="pdf"]), .tableBA a:not(.logout-link,.login-link,.login_link,[id*="login_link"],[href*="#"],[target="_blank"],'
                    + '[href$="mp3"],[href$="jpg"],[href$="jpeg"],[href$="gif"],[href$="png"],[href$="doc"],[href$="pdf"])', '#middle', {timout: 0, scrollTo: 0});




            $(document).on('pjax:start', function () {
                $(this).addClass('loading');
                $middle.animate({opacity: "0"}, 0);
            });
            $(document).on('pjax:end', function () {
                $(this).removeClass('loading');
                jQuery.getScript("scripts/array.js");
                jQuery.getScript("scripts/index.js");
                jQuery.getScript('scripts/slider.js');
                jQuery.getScript('scripts/blockAdv.js');

                $middle.animate({opacity: "1"}, 500);
            });




        });
    });

})(jQuery);
