function getList(array) {
    let list = []
    for (let index = 0; index < array.length; index++) {
        list.push(array[index])
    }
    return list
}

function SetMostPopular() {
    /*Set most popular */
    let productsList = getList(products)
    const path = "../images/"

    for (let index = 0; index < 3; index++) {
        let $div = $("<div class='game-content'></div>")

        let $imageDiv = $("<div></div>")
        let $imagem = $('<img></img>')

        let $titleDiv = $("<div class='game-title'></div>")

        let $titulo = $('<h3></h3>')
        let $preco = $('<h4></h4>')
        let botao = document.createElement("button")
        botao.id = index
        botao.classList.add("btn")
        botao.innerHTML = "Add To Cart"
        botao.onclick = AddCart

        $imagem.prop("src", path + productsList[index].image)
        $titulo.text(productsList[index].name)
        $preco.text("$" + productsList[index].price)

        $div.id = `${productsList[index].name}`

        $imageDiv.append($imagem)
        $div.append($imageDiv)

        $titleDiv.append($titulo)
        $titleDiv.append($preco)
        $titleDiv.append(botao)
        $div.append($titleDiv)
        $('#popularDivPost').append($div)
    }
}

function SetHomeProducts(ini,fim,local) {
    /*Set New and Sale products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = ini; index < fim; index++) {
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

        $div.id = `${productsList[index].name}`

        $imageDiv.append($imagem)
        $div.append($imageDiv)

        $div.append($titulo)
        $div.append($preco)
        $div.append(botao)

        $(local).append($div)
    }
}

$(document).ready(function () {
    SetMostPopular()
    SetHomeProducts(3,9,"#newProductsDiv")
    SetHomeProducts(9,12,"#saleDiv")
})