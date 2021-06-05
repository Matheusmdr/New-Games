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
        $div.attr("id", `${productsList[index].name}${index}`)
        $('#productsListDiv').append($div)
    }
}

function getProduct(id) {
    for (let index = 0; index < products.length; index++) {
        if (id == index) return products[index];
    }
    return console.log("item não encontrado!");
}


function AddCart(event) {
    let product = getProduct(this.id)
    let cart = []
    if (sessionStorage['products']) {
        cart = JSON.parse(sessionStorage.getItem('products'));
        if (!checkCart(cart, product)) {
            alert("Este produto já está adicionado no carrinho.");
            return;
        }
    }
    productItem = []
    productItem.push(product.name)
    productItem.push(product.category)
    productItem.push(product.price)
    productItem.push(product.image)
    productItem.push(1)
    cart.push(productItem)
    sessionStorage.setItem('products', JSON.stringify(cart))
    if (sessionStorage['somaQuant']) {
        sessionStorage.setItem('somaQuant', JSON.stringify(JSON.parse(sessionStorage.getItem('somaQuant')) + 1));
        sessionStorage.setItem('Total', JSON.stringify(JSON.parse(sessionStorage.getItem('Total')) + product.price));
    } else {
        sessionStorage.setItem('somaQuant', JSON.stringify(1));
        sessionStorage.setItem('Total', JSON.stringify(product.price));
    }
    CartUp()
    event.preventDefault()
}

function FilterCategory() {
    var box = document.getElementById('Category')

    let categoryId = box.options[box.selectedIndex].value

    if (categoryId != -1) {
        for (let index = 0; index < products.length; index++) {
            if (categoryId != products[index].category) {
                let product = document.getElementById(`${products[index].name}${index}`);
                product.style.display = "none";
            } else {
                let product = document.getElementById(`${products[index].name}${index}`);
                product.style.display = "flex";
            }
        }
    } else {
        for (let index = 0; index < products.length; index++) {
            let product = document.getElementById(`${products[index].name}${index}`);
            product.style.display = "flex";
        }
    }
}

function FilterPrice(){
    var box = document.getElementById('Price')

    let Price = box.options[box.selectedIndex].value

    if (Price != -1) {
        if(Price == 0){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 10){
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 1){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 20){
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 2){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 40){
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 3){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 80){
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}${index}`);
                    product.style.display = "flex";
                }
            }
        }
    } else {
        for (let index = 0; index < products.length; index++) {
            let product = document.getElementById(`${products[index].name}${index}`);
            product.style.display = "flex";
        }
    }
}


function checkCart(cart, product) {
    let tam = cart.length;
    for (let i = 0; i < tam; i++)
        if (((cart[i])[0] == product.name))
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