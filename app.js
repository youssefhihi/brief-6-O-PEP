 // Open the popup
 function openPopup(img, nom,prix) {
    document.getElementById("imgProduct").src = img;
    document.getElementById("nomProduct").innerText = nom;
    document.getElementById("priceProduct").innerText = "price : " + price;
    document.getElementById("popup").classList.remove("hidden");
}

// Close the popup when clicking outside the popup content
window.onclick = function (event) {
var popup = document.getElementById("popup");
if (event.target == popup) {
popup.classList.add("hidden");
}
};