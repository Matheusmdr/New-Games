
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
                let product = document.getElementById(`${products[index].name}`);
                product.style.display = "none";
            } else {
                let product = document.getElementById(`${products[index].name}`);
                product.style.display = "flex";
            }
        }
    } else {
        for (let index = 0; index < products.length; index++) {
            let product = document.getElementById(`${products[index].name}`);
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
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 1){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 20){
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 2){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 40){
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "flex";
                }
            }
        }
        else if (Price == 3){
            for (let index = 0; index < products.length; index++) {
                if(products[index].price > 80){
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                }
                else{
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "flex";
                }
            }
        }
    } else {
        for (let index = 0; index < products.length; index++) {
            let product = document.getElementById(`${products[index].name}`);
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
