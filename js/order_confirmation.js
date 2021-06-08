function randomNumber() {
    let max = Math.floor(11);
    let min = Math.ceil(1);

    return Math.floor(Math.random() * (max - min) + min);
}

function SetPurchase() {
    let orders = []
    orders = JSON.parse(sessionStorage.getItem('products'))
    let $CartTable = $("#orders")
    const path = "../images/"
    for (let index = 0; index < orders.length; index++) {
        let row = document.createElement("tr")
        let imageColumn = document.createElement("th")
        let image = document.createElement("img")
        let titleColumn = document.createElement("th")
        let PriceColumn = document.createElement("th")
        let counterCol = document.createElement("th")
        let counterDiv = document.createElement("div")
        counterDiv.classList.add("counter")


        let quantity = document.createElement("p")
        quantity.type = "text"
        quantity.innerHTML = (orders[index])[4]

        quantity.id = index


        counterDiv.append(quantity)
        counterCol.append(counterDiv)


        image.src = path + (orders[index])[3]
        titleColumn.innerHTML = (orders[index])[0]
        PriceColumn.innerHTML = "$" + (orders[index])[2]

        imageColumn.append(image);
        row.append(imageColumn);
        row.append(titleColumn);
        row.append(PriceColumn);
        row.append(counterCol)
        $CartTable.append(row);
    }
    let row = document.createElement("tr");
    let totalText = document.createElement("th");
    let total = document.createElement("th");
    let aux = JSON.parse(sessionStorage.getItem('Total'))
    row.id = "total";
    totalText.innerText = "TOTAL";
    totalText.colSpan = "3"
    total.innerHTML = "$" + aux.toFixed(2);
    total.colSpan = "1"
    total.id = "totalValue"

    row.append(totalText);
    row.append(total);
    $CartTable.append(row);

    row = document.createElement("tr")
    row.classList.add("delivery-information-title")
    let Title = document.createElement("th")
    Title.innerHTML = "Delivery Information"
    Title.colSpan = "4"

    row.append(Title)
    $CartTable.append(row)

    let UserData = JSON.parse(sessionStorage.getItem("userdata"))

    row = document.createElement("tr")
    Title = document.createElement("th")
    Title.innerHTML = "Name: "+ `${UserData.name}`
    Title.colSpan = "4"
    row.append(Title)
    $CartTable.append(row)

    row = document.createElement("tr")
    Title = document.createElement("th")
    Title.innerHTML = "Email: "+ `${UserData.email}`
    Title.colSpan = "4"
    row.append(Title)
    $CartTable.append(row)

    row = document.createElement("tr")
    Title = document.createElement("th")
    Title.innerHTML = "Adress: "+ `${UserData.street}`+","+`${UserData.num}`
    Title.colSpan = "4"
    row.append(Title)
    $CartTable.append(row)
    
    row = document.createElement("tr")
    Title = document.createElement("th")
    Title.innerHTML = "City: "+ `${UserData.city}` + "," + `${UserData.country}`
    Title.colSpan = "2"
    row.append(Title)
    let zipcode = document.createElement("th")
    zipcode.colSpan = "2"
    zipcode.innerHTML = "Zipcode: "+`${UserData.zipcode}`
    row.append(zipcode)
    $CartTable.append(row)

    row = document.createElement("tr")
    Title = document.createElement("th")
    Title.innerHTML = "Your order will arrive in "+randomNumber()+" business days!"
    Title.colSpan = "4"
    row.append(Title)
    $CartTable.append(row)
  
}



$(document).ready(function () {
    SetPurchase()
})