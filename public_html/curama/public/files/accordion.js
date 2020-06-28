$(function() {
  $(".accordion dt").click(function(){
    $(this).next("dd").slideToggle();
    $(this).next("dd").siblings("dd").slideUp();
    $(this).toggleClass("open");
    $(this).siblings("dt").removeClass("open");
  });
});

$(function() {
  $(".accordion-head").click(function(){
    $(this).next(".accordion-content").slideToggle();
    $(this).next(".accordion-content").siblings(".accordion-content").slideUp();
    $(this).toggleClass("open");
    $(this).siblings(".accordion-head").removeClass("open");
  });
});