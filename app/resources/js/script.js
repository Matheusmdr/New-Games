$(document).ready(function () {
  $nav = $('.nav');
  $toggleCollapse = $('.toggle-collapse');

  $toggleCollapse.click(function () {
    $nav.toggleClass('collapse');
  })

  const gotoTop = document.querySelector(".goto-top");

  window.addEventListener("scroll", e => {
    const scrollHeight = window.pageYOffset;

    if (scrollHeight > 300) {
      gotoTop.classList.add("show-top");
    } else {
      gotoTop.classList.remove("show-top");
    }
  });

  AOS.init();

});