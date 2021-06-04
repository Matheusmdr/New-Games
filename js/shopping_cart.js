
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
            spanDown.innerHTML = "-"
            spanDown.classList.add("down")
            spanDown.onclick = decreaseCount

            let quantity = document.createElement("input")
            quantity.type = "text"
            quantity.value = 1


            let spanUp = document.createElement("span")
            spanUp.innerHTML = "+"
            spanUp.classList.add("up")
            spanUp.onclick = increaseCount

            counterDiv.append(spanDown)
            counterDiv.append(quantity)
            counterDiv.append(spanUp)
            counterCol.append(counterDiv)

            valorTotal = valorTotal + pedidos[index].price;

            imagem.src = path + pedidos[index].image;
            colunaTitulo.innerHTML = pedidos[index].name;
            colunaPreco.innerHTML = "$" + pedidos[index].price;

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

        linha.classList.add("teste","table-foot-total")
        linha.id = "total";
        totalText.innerText = "TOTAL";
        totalText.colSpan = "3"
        total.innerHTML = "$" + valorTotal;
        total.colSpan = "1"

        linha.append(totalText);
        linha.append(total);
        foot.append(linha)
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