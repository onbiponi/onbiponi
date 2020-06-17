$(function() {
  var topBtn = $('.pagetop');
  topBtn.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      topBtn.fadeIn();
    }else {
      topBtn.fadeOut();
    }
  });

  var scrollBottom;
  var footerHeight = $('footer').height();
  function getScrollTop(){
    scrollBottom = $('body').height()-$(window).scrollTop()-$(window).height();
    if(scrollBottom < footerHeight){
      $('.pagetop').addClass('pagetop-fix');
    }
    else{
      $('.pagetop').removeClass('pagetop-fix');
    }
  }
  $(window).on("load scroll resize", getScrollTop);

  topBtn.click(function () {
    $('body,html').animate({
    scrollTop: 0
  }, 1000);
  return false;
  });
});