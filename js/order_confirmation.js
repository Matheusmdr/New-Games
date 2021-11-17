function randomNumber() {
    let max = Math.floor(11);
    let min = Math.ceil(1);

    return Math.floor(Math.random() * (max - min) + min);
}


$(document).ready(function () {
    SetPurchase()
})