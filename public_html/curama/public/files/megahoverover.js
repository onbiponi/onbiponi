//マウスオーバー時
$(function() {
    function megaHoverOver() {
        $(this).find(".sub").stop().fadeTo('fast', 1).show();
        (function ($) {
            jQuery.fn.calcSubWidth = function () {
                rowWidth = 0;
                $(this).find("ul").each(function () {
                    rowWidth = $(this).width();
                });
            };
        })(jQuery);
    }

//On Hover Out
    function megaHoverOut() {
        $(this).find(".sub").stop().fadeTo('fast', 0, function () {
            $(this).hide();  //after fading, hide it
        });
    }

    var config = {
        sensitivity: 2,
        interval: 100,
        over: megaHoverOver,
        timeout: 500,
        out: megaHoverOut
    };
    $("ul#topnav li .sub").css({'opacity': '0'});
    $("ul#topnav li").hoverIntent(config);
})