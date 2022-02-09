function CartUp(){
    if (sessionStorage['somaQuant']) {
        let prods = JSON.parse(sessionStorage.getItem('somaQuant'));
        let cartUp = document.getElementById("cart-total");
        if (prods > 0) {
            cartUp.style.display = "block";
            cartUp.innerHTML = `${prods}`;
        } else cartUp.style.display = "none";
    }
}


window.onload = () => {
    CartUp()
}

window.onload = () => {
    CartUp()
}