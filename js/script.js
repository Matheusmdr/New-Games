$(document).ready(function () {
    $nav = $('.nav');
    $toggleCollapse = $('.toggle-collapse');

    $toggleCollapse.click(function () {
      $nav.toggleClass('collapse');
    })


  });


  const slider1 = document.getElementById("glide_1");


  if (slider1) {
    new Glide(slider1, {
      type: "carousel",
      startAt: 0,
      autoplay: 3000,
      hoverpause: true,
      perView: 1,
      animationDuration: 800,
      animationTimingFunc: "linear",
    }).mount();
  }