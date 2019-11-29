// for card hover
$(document).ready(function(){
    $('.card').hover(
      function(){
        $(this).animate({
          marginTop: "-=1%",
        },200);
      },
      function(){
        $(this).animate({
          marginTop: "0%",
        },200);
      }
    );
  });

  // for navbar effect
  const disp = 45;
  var top1 = $('#services').offset().top - disp;
  console.log(top1);
  var top2 = $('#category').offset().top - disp;
  var top3 = $('#team').offset().top - disp;

  function nav(){
      // scrollTop property sets or returns the number of pixels an element's content is scrolled vertically.
      if($(this).scrollTop() < 40){   
        $('#mainNav').css({"background-color":"transparent"});
      } else {
        $('#mainNav').css({"background-color":"black"});
      }

      // for collapse of navbar while scrolling
      $('#navbarResponsive').removeClass('show');
      $('.navbar-toggler').addClass('collapsed');
      $(".navbar-toggler").attr("aria-expanded","false");
      
      // for nav-link color
      $('#nav-services').css('color', '#ffffff');
      $('#nav-category').css('color', '#ffffff');
      $('#nav-team').css('color', '#ffffff');
      var scrollPos = $(document).scrollTop();
      if (scrollPos >= top1 && scrollPos < top2) {
        $('#nav-services').css('color', '#ffc107');
      } else if (scrollPos >= top2 && scrollPos < top3) {
        $('#nav-category').css('color', '#ffc107');
      } else if (scrollPos >= top3) {
        $('#nav-team').css('color', '#ffc107');
      }
  }

  $(document).ready(nav);    // document.onload = nav();
  $(document).scroll(nav);