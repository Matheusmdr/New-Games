function getList(array) {
    let list = [];
    for (let index = 0; index < array.length; index++) {
        list.push(array[index]);
    }
    return list;
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
        let $botao = $("<button class='btn btn-access'>Add To Cart</button>");

        $imagem.prop("src", path + productsList[index].image)
        $titulo.text(productsList[index].name)
        $preco.text("$" + productsList[index].price)

        $div.id = `${productsList[index].name}${index}`

        $imageDiv.append($imagem);
        $div.append($imageDiv)

        $titleDiv.append($titulo);
        $titleDiv.append($preco);
        $titleDiv.append($botao);
        $div.append($titleDiv)
        $('#popularDivPost').append($div);
    }
}

function setNewProducts() {
    /*Set new products */
    let productsList = getList(products)
    const path = "../images/"


    for (let index = 3; index < 9; index++) {
        let $div = $("<div class='game-content'></div>")

        let $imageDiv = $("<div></div>")
        let $imagem = $('<img></img>')


        let $titulo = $('<a></a>')
        let $preco = $('<span></span>')
        let $botao = $("<button class='btn'>Add To Cart</button>");
        $imagem.prop("src", path + productsList[index].image)
        $titulo.text(productsList[index].name)
        $preco.text("$" + productsList[index].price)

        $div.id = `${productsList[index].name}${index}`

        $imageDiv.append($imagem);
        $div.append($imageDiv)

        $div.append($titulo);
        $div.append($preco);
        $div.append($botao);

        $('#newProductsDiv').append($div);
    }
}


function SetProductsHome() {
    SetMostPopular()
    setNewProducts()
}



function start() {
    SetProductsHome();
}

start();