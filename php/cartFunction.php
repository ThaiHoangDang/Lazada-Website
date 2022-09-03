<script>
    let productID = '<?= $product["Product ID"]; ?>';
    let productName = `<?= $product["Product Name"]?>`;
    let productLink = '<?= "/html/productpage/product_customer.php/get?id=".$product["Product ID"]?>';
    let productImgLink = '<?= "$images[0]"?>';
    let productPrice = '<?= $product["Price"]?>';
    var productQuantity = 0;

    let cartItem = {
        "product_ID": productID,
        "product_name": productName,
        "product_link": productLink,
        "product_img": productImgLink,
        "product_price": productPrice,
        "product_quantity": 0
    };

    function addToCartEvents() {
        addProductToCart();
        alert("Product has been added to cart")
    }

    function buyNowEvents() {
        addProductToCart();
        window.location.replace("../../cart/cart.php");
    }

    function addProductToCart() {
        let cartItems = localStorage.getItem("cartItems");
        cartItems = JSON.parse(cartItems);

        if (cartItems != null) {
            if (cartItems[productID] === undefined) {
                cartItems = {
                    ...cartItems,
                    [productID]: cartItem
                };
            }
            cartItems[productID].product_quantity += Number(document.getElementById("quantity").value);
        } else {
            cartItem.product_quantity = Number(document.getElementById("quantity").value);
            cartItems = {
                [productID]: cartItem
            };
        }
        localStorage.setItem("cartItems", JSON.stringify(cartItems));
    }
</script>