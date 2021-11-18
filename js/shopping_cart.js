function onlyNumberKey(evt) {
    var Key = (evt.which) ? evt.which : evt.keyCode
    if (Key > 31 && (Key < 48 || Key > 57))
        return false;
    return true;
}

function onlyLetterKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 191 && charCode <= 255))
        return true;
    return false;
}

function onlyEmail(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 32)
        return false;
    if (!(charCode == 46 || charCode == 95 || (charCode >= 64 || charCode <= 91) || (charCode >= 97 || charCode <= 122) || (charCode >= 48 || charCode <= 57)))
        return false;
    return true;
}

function validateEmail(value) {
    var input = document.createElement('input');

    input.type = 'email';
    input.required = true;
    input.value = value;

    return typeof input.checkValidity === 'function' ? input.checkValidity() : /\S+@\S+\.\S+/.test(value);
}


function getForm() {
    let name = document.getElementById("name").value
    let email = document.getElementById("email").value
    let street = document.getElementById("street").value
    let num = document.getElementById("house-number").value
    let neighborhood = document.getElementById("neighborhood").value
    let city = document.getElementById("city").value
    let country = document.getElementById("country").value
    let zipcode = document.getElementById("zipcode").value


    let data = {
        "name": `${name}`,
        "email": `${email}`,
        "street": `${street}`,
        "num": `${num}`,
        "neighborhood": `${neighborhood}`,
        "city": `${city}`,
        "country": `${country}`,
        "zipcode": `${zipcode}`
    }
    console.log(data)
    sessionStorage.setItem('userdata', JSON.stringify(data))
}


$(document).ready(function () {
    let orders = []
    orders = JSON.parse(sessionStorage.getItem('products'))
    let div = document.getElementById("content-form-div")
    if (orders == null || orders.length == 0) {
        div.style.display = "none"
    } else {
        div.style.display = "initial"
    }
    SetCartProducts()
})
