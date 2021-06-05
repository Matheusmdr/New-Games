

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

        $div.id = `${productsList[index].name}${index}`

        $imageDiv.append($imagem)
        $div.append($imageDiv)

        $titleDiv.append($titulo)
        $titleDiv.append($preco)
        $titleDiv.append(botao)
        $div.append($titleDiv)
        $('#popularDivPost').append($div)
    }
}

function SetNewProducts() {
    /*Set new products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = 3; index < 9; index++) {
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

        $div.id = `${productsList[index].name}${index}`

        $imageDiv.append($imagem)
        $div.append($imageDiv)

        $div.append($titulo)
        $div.append($preco)
        $div.append(botao)

        $('#newProductsDiv').append($div)
    }
}

function SetSaleProducts() {
    /*Set sale products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = 9; index < 12; index++) {
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

        $div.id = `${productsList[index].name}${index}`

        $imageDiv.append($imagem)
        $div.append($imageDiv)

        $div.append($titulo)
        $div.append($preco)
        $div.append(botao)

        $('#saleDiv').append($div)
    }
}


function SetProducts() {
    /*Set sale products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = 0; index < productsList.length ; index++) {
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

        $('#productsListDiv').append($div)
    }
}

function getProduct(id) {
    for (let index = 0; index < products.length; index++) {
        if (id == index) return products[index];
    }
    return console.log("item não encontrado!");
}


function AddCart(event){
    let product = getProduct(this.id)
    let cart = []
    if (sessionStorage['products']){
        cart = JSON.parse(sessionStorage.getItem('products'));
        if (!checkCart(cart, product)){
            alert("!! ERRO !!\n\nEste produto já está adicionado no carrinho.");
            return;
        }
    }
    cart.push(product)
    sessionStorage.setItem('products', JSON.stringify(cart))
    if (sessionStorage['somaQuant']){
        sessionStorage.setItem('somaQuant', JSON.stringify(JSON.parse(sessionStorage.getItem('somaQuant'))+1));
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('somaTotal'))+product.price));
    }else{
        sessionStorage.setItem('somaQuant', JSON.stringify(1));
        sessionStorage.setItem('Total', JSON.stringify(product.price));
    }
    if (sessionStorage['quantProds']){
        sessionStorage.setItem('quantProds', JSON.stringify(JSON.parse(sessionStorage.getItem('quantProds')) + 1));
    }else sessionStorage.setItem('quantProds', JSON.stringify(1));
    event.preventDefault()
}


function checkCart(cart, product) {
    let tam = cart.length;
    for (let i = 0; i < tam; i++)
        if (((cart[i]).name == product.name))
            return false;
    return true;
}

function SetProductsHome() {
    SetMostPopular()
    SetNewProducts()
    SetSaleProducts()
}



function start() {
    SetProductsHome()
    SetProducts()
}
start()