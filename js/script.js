$(document).ready(function () {
    $nav = $('.nav');
    $toggleCollapse = $('.toggle-collapse');

    $toggleCollapse.click(function () {
      $nav.toggleClass('collapse');
    })

    $('.owl-carousel').owlCarousel({
      loop: true,
      autoplay: true,
      dots: true,
      autoplayTimeout: 6000,
      items : 1,
    });

  });