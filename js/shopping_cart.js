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

function SetCartProducts() {
    let orders = []
    orders = JSON.parse(sessionStorage.getItem('products'))
    let $CartTable = $("#orders")
    const path = "../images/"

    if (orders == null || orders.length == 0) {
        let row = document.createElement("tr")
        let span = document.createElement("th")
        span.innerHTML = "Cart is Empty"
        span.colSpan = "4"

        row.append(span);
        $CartTable.append(row);
    } else {
        for (let index = 0; index < orders.length; index++) {
            let row = document.createElement("tr")
            let imageColumn = document.createElement("th")
            let image = document.createElement("img")
            let titleColumn = document.createElement("th")
            let PriceColumn = document.createElement("th")
            let counterCol = document.createElement("th")
            let counterDiv = document.createElement("div")
            counterDiv.classList.add("counter")

            let spanDown = document.createElement("span")
            spanDown.id = (orders[index])[2]
            spanDown.innerHTML = "-"
            spanDown.classList.add("down")
            spanDown.onclick = decreaseCount

            let quantity = document.createElement("input")
            quantity.type = "text"
            quantity.value = (orders[index])[4]
            quantity.id = index


            let spanUp = document.createElement("span")
            spanUp.id = (orders[index])[2]
            spanUp.innerHTML = "+"
            spanUp.classList.add("up")
            spanUp.onclick = increaseCount

            counterDiv.append(spanDown)
            counterDiv.append(quantity)
            counterDiv.append(spanUp)
            counterCol.append(counterDiv)


            image.src = path + (orders[index])[3]
            titleColumn.innerHTML = (orders[index])[0]
            PriceColumn.innerHTML = "$" + (orders[index])[2]

            imageColumn.append(image);
            row.append(imageColumn);
            row.append(titleColumn);
            row.append(PriceColumn);
            row.append(counterCol)
            $CartTable.append(row);
        }
        let foot = document.createElement("tfoot")
        let row = document.createElement("tr");
        let totalText = document.createElement("th");
        let total = document.createElement("th");
        let aux = JSON.parse(sessionStorage.getItem('Total'))
        row.classList.add("table-foot-total")
        row.id = "total";
        totalText.innerText = "TOTAL";
        totalText.colSpan = "3"
        total.innerHTML = "$" + aux.toFixed(2);
        total.colSpan = "1"
        total.id = "totalValue"

        row.append(totalText);
        row.append(total);
        foot.append(row)
        $CartTable.append(foot);
    }
}

function increaseCount() {
    var input = this.previousElementSibling;
    var value = parseInt(input.value, 10);
    let index = input.id
    cart = JSON.parse(sessionStorage.getItem('products'));
    value = (cart[index])[4];
    if (value < 99) {
        value = isNaN(value) ? 0 : value;
        value++;
        input.value++
            (cart[index])[4] = value
        let totalText = document.querySelector('#totalValue')
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('Total')) + parseFloat(this.id)));
        let total = parseFloat(JSON.parse(sessionStorage.getItem('Total')))
        totalText.innerHTML = "$" + total.toFixed(2)
        sessionStorage.setItem('products', JSON.stringify(cart))
    }
}

function decreaseCount() {
    var input = this.nextElementSibling;
    var value = parseInt(input.value, 10);
    let index = input.id
    cart = JSON.parse(sessionStorage.getItem('products'));
    value = (cart[index])[4];
    if (value > 1) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value--
            (cart[index])[4] = value
        let totalText = document.querySelector('#totalValue')
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('Total')) - parseFloat(this.id)));
        let total = parseFloat(JSON.parse(sessionStorage.getItem('Total')))
        totalText.innerHTML = "$" + total.toFixed(2)
        sessionStorage.setItem('products', JSON.stringify(cart))
    }
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
    SetCartProducts()
    let orders = []
    orders = JSON.parse(sessionStorage.getItem('products'))
    let div = document.getElementById("content-form-div")
    if (orders == null || orders.length == 0) {
        div.style.display = "none"
    } else {
        div.style.display = "initial"
    }

    console.log(orders)
})