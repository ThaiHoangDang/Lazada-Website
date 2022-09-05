let productID = window.location.search.substr(4,);
let productName = document.querySelector(".product-info-main h2").innerHTML;
let productLink = window.location.href;
let productLinkArray = productLink.split('/');
productLinkArray.splice(productLinkArray.length - 2);
let storeName = document.getElementById("store-name").innerHTML;
let storeLink = document.getElementById("store-name").href;
let finalPrice = document.querySelector(".product-info-price").innerHTML.slice(1,);
let productImg = document.querySelector(".product-info-main-img img").src;
let cartItem = {
    "product_ID": productID,
    "product_name": productName,
    "product_Link": productLink,
    "store_name": storeName,
    "store_Link": storeLink,
    "final_price": finalPrice,
    "product_img": productImg,
    "product_quantity": 0
};

const BUY_NOW_BUTTON = document.querySelector(".buy-now");
const ADD_BUTTON = document.querySelector(".add-to-cart");
ADD_BUTTON.addEventListener("click", addToCartEvents);
BUY_NOW_BUTTON.addEventListener("click", buyNowEvents);

function addItemToCart() {
    let cartProducts = localStorage.getItem("cartProducts");
    cartProducts = JSON.parse(cartProducts);

    if(cartProducts != null) {
        if(cartProducts[productID] === undefined) {
            cartProducts = {
                ...cartProducts, // for product that is added 1st time
                [productID]: cartItem
            };
        }
        cartProducts[productID].product_quantity += 1; // for products that are already in cart
    } else { //
        cartItem.product_quantity= 1;
        cartProducts = {
            [productID]: cartItem // for empty cart
        };
    }
    localStorage.setItem("cartProducts", JSON.stringify(cartProducts));

}

function addToCartMsg() {
    document.body.insertAdjacentHTML("beforeend", "<div class=\"done-msg-wrapper\">\n" +
        "<div class=\"done-msg\">\n" +
        "<i class=\"fas fa-check\"></i>\n" +
        "<p class=\"done-add-to-cart\">Product has been added to the cart</p>\n"+
        " </div>\n" +
        " </div>");
    setTimeout(function() {
        const doc = document.querySelector(".product-content");
        const doneMsg = document.querySelector(".done-msg-wrapper");
        doc.removeChild(doneMsg);
    },3000);
    setTimeout(function() {
        location.reload();
    },5000);
}

function addToCartEvents() {
    addItemToCart();
    addToCartMsg();
}

function buyNowEvents() {
    addItemToCart();
    window.location.href = BUY_NOW_BUTTON.querySelector("a").href;
}
