
function setProducts() {
    let pedidos = []
    pedidos = JSON.parse(sessionStorage.getItem('products'))
    let $CartTable = $("#orders")
    const path = "../images/"

    if (pedidos.length == 0) {
        let row = document.createElement("tr")
        let span = document.createElement("th")
        span.innerHTML = "Cart is Empty"
        span.colSpan = "4"

        row.append(span);
        $CartTable.append(row); 
    } else {
        let valorTotal = 0;
        for (let index = 0; index < pedidos.length; index++) {
            let linha = document.createElement("tr")
            let colunaImg = document.createElement("th")
            let imagem = document.createElement("img")
            let colunaTitulo = document.createElement("th")
            let colunaPreco = document.createElement("th")
            let counterCol = document.createElement("th")
            let counterDiv = document.createElement("div")
            counterDiv.classList.add("counter")

            let spanDown = document.createElement("span")
            spanDown.id = (pedidos[index])[2]
            spanDown.innerHTML = "-"
            spanDown.classList.add("down")
            spanDown.onclick = decreaseCount

            let quantity = document.createElement("input")
            quantity.type = "text"
            quantity.value = (pedidos[index])[4]
            console.log(quantity.value)
            quantity.id = index


            let spanUp = document.createElement("span")
            spanUp.id = (pedidos[index])[2]
            spanUp.innerHTML = "+"
            spanUp.classList.add("up")
            spanUp.onclick = increaseCount

            counterDiv.append(spanDown)
            counterDiv.append(quantity)
            counterDiv.append(spanUp)
            counterCol.append(counterDiv)
   

            imagem.src = path + (pedidos[index])[3]
            colunaTitulo.innerHTML = (pedidos[index])[0]
            colunaPreco.innerHTML = "$" + (pedidos[index])[2]

            colunaImg.append(imagem);
            linha.append(colunaImg);
            linha.append(colunaTitulo);
            linha.append(colunaPreco);
            linha.append(counterCol)
            $CartTable.append(linha);
        }
        let foot = document.createElement("tfoot")
        let linha = document.createElement("tr");
        let totalText = document.createElement("th");
        let total = document.createElement("th");
        let aux = JSON.parse(sessionStorage.getItem('Total'))
        linha.classList.add("table-foot-total")
        linha.id = "total";
        totalText.innerText = "TOTAL";
        totalText.colSpan = "3"
        total.innerHTML = "$" + aux.toFixed(2);
        total.colSpan = "1"
        total.id = "totalValue"

        linha.append(totalText);
        linha.append(total);
        foot.append(linha)
        $CartTable.append(foot);
    }
}

function increaseCount() {
    var input = this.previousElementSibling;
    var value = parseInt(input.value, 10);
    let index = input.id
    cart = JSON.parse(sessionStorage.getItem('products'));
    value = (cart[index])[4];
    if (value < 99){
        value = isNaN(value) ? 0 : value;
        value++;
        input.value++
        (cart[index])[4] = value
        let totalText = document.querySelector('#totalValue')
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('Total'))+parseFloat(this.id)));
        let total = parseFloat(JSON.parse(sessionStorage.getItem('Total')))
        totalText.innerHTML = "$"+ total.toFixed(2)
        sessionStorage.setItem('products', JSON.stringify(cart))
    }
}

function decreaseCount() {
    var input = this.nextElementSibling;
    var value = parseInt(input.value, 10);
    let index = input.id
    cart = JSON.parse(sessionStorage.getItem('products'));
    value = (cart[index])[4];
    if (value > 1){
        value = isNaN(value) ? 0 : value;
        value--;
        input.value--
        (cart[index])[4] = value
        let totalText = document.querySelector('#totalValue')
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('Total'))-parseFloat(this.id)));
        let total = parseFloat(JSON.parse(sessionStorage.getItem('Total')))
        totalText.innerHTML = "$"+ total.toFixed(2)
        sessionStorage.setItem('products', JSON.stringify(cart))
    }
}

  
  setProducts()