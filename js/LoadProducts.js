function getList(array) {
    let list = []
    for (let index = 0; index < array.length; index++) {
        list.push(array[index])
    }
    return list
}


function SetProducts() {
    /*Set sale products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = 0; index < productsList.length; index++) {
        let $div = $("<div class='game-content'></div>")

        let $imageDiv = $("<div></div>")
        let $imagem = $('<img></img>')


        let $titulo = $('<a></a>')
        let $preco = $('<span></span>')
        let botao = document.createElement("button")
        botao.id = index
        botao.classList.add("btn")
        botao.innerHTML = "Add To Cart"
        botao.onclick = AddCart
        $imagem.prop("src", path + productsList[index].image)
        $titulo.text(productsList[index].name)
        $preco.text("$" + productsList[index].price)

        $imageDiv.append($imagem)

        $div.append($imageDiv)

        $div.append($titulo)
        $div.append($preco)
        $div.append(botao)
        $div.attr("id", `${productsList[index].name}`)
        $('#productsListDiv').append($div)
    }
    
}

$(document).ready(function () {
    SetProducts()
})