function onlyNumberKey(evt) { 
  var Key = (evt.which) ? evt.which : evt.keyCode
  if (Key > 31 && (Key < 48 || Key > 57))
      return false;
  return true;
}

function onlyLetterKey(evt) { 
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode==32 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 191 && charCode <= 255))
      return true;
  return false;
}

function onlyEmail(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode == 32)
      return false; 
  if (!(charCode==46 || charCode==95 || (charCode >= 64 || charCode<=91) || (charCode >= 97 || charCode<= 122) || (charCode >= 48 || charCode<=57) ) )
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

function setProducts() {
    let orders = []
    orders = JSON.parse(sessionStorage.getItem('products'))
    let $CartTable = $("#orders")
    const path = "../images/"

    if (orders.length == 0) {
        let row = document.createElement("tr")
        let span = document.createElement("th")
        span.innerHTML = "Cart is Empty"
        span.colSpan = "4"

        row.append(span);
        $CartTable.append(row); 
    } else {
        let totalValue = 0;
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
            spanDown.id = orders[index].price
            spanDown.innerHTML = "-"
            spanDown.classList.add("down")
            spanDown.onclick = decreaseCount

            let quantity = document.createElement("input")
            quantity.type = "text"
            quantity.value = 1


            let spanUp = document.createElement("span")
            spanUp.id = orders[index].price
            spanUp.innerHTML = "+"
            spanUp.classList.add("up")
            spanUp.onclick = increaseCount

            counterDiv.append(spanDown)
            counterDiv.append(quantity)
            counterDiv.append(spanUp)
            counterCol.append(counterDiv)
   

            image.src = path + orders[index].image;
            titleColumn.innerHTML = orders[index].name;
            PriceColumn.innerHTML = "$" + orders[index].price;

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

        row.classList.add("teste","table-foot-total")
        row.id = "total";
        totalText.innerText = "TOTAL";
        totalText.colSpan = "3"
        total.innerHTML = "$" + JSON.parse(sessionStorage.getItem('Total'));
        total.colSpan = "1"

        row.append(totalText);
        row.append(total);
        foot.append(row)
        $CartTable.append(foot);
    }
}

function increaseCount() {
    var input = this.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
  }
  
  function decreaseCount() {
    var input = this.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
      value = isNaN(value) ? 0 : value;
      value--;
      input.value = value;
    }
  }
  
  setProducts()