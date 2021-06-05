function CartUp(){
    if (sessionStorage['quantProds']) {
        let prods = JSON.parse(sessionStorage.getItem('quantProds'));
        let cartUp = document.getElementById("cart-total");
        if (prods > 0) {
            cartUp.style.display = "block";
            cartUp.innerHTML = `${prods}`;
        } else cartUp.style.display = "none";
    }
}

window.onstorage = () => {
    CartUp();
};

window.onload = () => {
    CartUp();
}