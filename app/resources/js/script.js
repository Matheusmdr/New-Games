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

















function onlyLetterKey(evt) {
  console.log("oi")
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode == 32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 191 && charCode <= 255))
    return true;
  return false;
}

function onlyNumberKey(evt) {
  var Key = (evt.which) ? evt.which : evt.keyCode;
  if (Key > 31 && (Key < 48 || Key > 57))
    return false;
  return true;
}

function username(evt) {
  var Key = (evt.which) ? evt.which : evt.keyCode;
  if (onlyNumberKey(Key)) return false;
  return true;
}

function validateEmail(inputText) {
  var validformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

  if (inputText.value.match(validformat)) {
    alert("Passou");
    document.form.email.focus();
    return true;
  } else {
    alert("Não Passou");
    document.form.email.focus();
    return false;
  }
}

function validateButton() {
  validateEmail();
}