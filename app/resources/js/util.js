
function getProduct(id) {
    for (let index = 0; index < products.length; index++) {
        if (id == index) return products[index];
    }
    return console.log("item não encontrado!");
}


function AddCart(event) {
    let product = getProduct(this.id)
    console.log(this.id)
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

    var box = document.getElementById('Price')

    let Price = box.options[box.selectedIndex].value
    console.log(Price)

    if (categoryId != -1) {
        for (let index = 0; index < products.length; index++) {
            if (categoryId != products[index].category) {
                let product = document.getElementById(`${products[index].name}`);
                product.style.display = "none";
            } else {
                let product = document.getElementById(`${products[index].name}`);
                if(products[index].price < Price){
                    product.style.display = "flex";
                }
            }
        }
    } else {
        for (let index = 0; index < products.length; index++) {
            let product = document.getElementById(`${products[index].name}`);
            if(products[index].price < Price){
                product.style.display = "flex";
            }
        }
    }
}

function Filter(){
    let box1 = document.getElementById('Category')

    let categoryId = box1.options[box1.selectedIndex].value


    let box2 = document.getElementById('Price')

    let Price = box2.options[box2.selectedIndex].value

    if(categoryId == -1 && Price == 999){
        for (let index = 0; index < products.length; index++) {
                let product = document.getElementById(`${products[index].name}`);
                product.style.display = "flex";
        }
    }
    else{
        if(categoryId == -1 && Price != 999){
                for (let index = 0; index < products.length; index++) {
                    if(products[index].price < Price){
                        let product = document.getElementById(`${products[index].name}`);
                        product.style.display = "flex";
                    }
                }
        }
        if(categoryId !== -1 && Price === 999){
            for (let index = 0; index < products.length; index++) {
                if (categoryId != products[index].category) {
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                } else {
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "flex";
                    
                }
            }
        }
       
        if(categoryId !== -1 && Price !== 999){
            for (let index = 0; index < products.length; index++) {
                if (categoryId != products[index].category) {
                    let product = document.getElementById(`${products[index].name}`);
                    product.style.display = "none";
                } else {
                    let product = document.getElementById(`${products[index].name}`);
                    if(products[index].price < Price){
                        product.style.display = "flex";
                    }
                }
            }
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
