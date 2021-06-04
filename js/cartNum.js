function chegarCartUp(){
    if (localStorage['quantProds']) {
        let prods = JSON.parse(localStorage.getItem('quantProds'));
        let cartUp = document.getElementById("cart-total");
        if (prods > 0) {
            cartUp.style.display = "block";
            cartUp.innerHTML = `${prods}`;
        } else cartUp.style.innerHTML = 0;
    }
}

window.onstorage = () => {
    chegarCartUp();
}

window.onload = () => {
    chegarCartUp();
}