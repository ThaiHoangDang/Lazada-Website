<script>
    // info of cart item
    let productID = '<?= $product["Product ID"]; ?>';
    let productName = `<?= $product["Product Name"]?>`;
    let productLink = '<?= "/pages/productpage/product_customer.php/get?id=".$product["Product ID"]?>';
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
        // relocate to cart.php
        window.location.replace("../../Cart/cart.php");
    }

    // adding new product to cart
    function addProductToCart() {
        // reading cartItems in local storage
        let cartItems = localStorage.getItem("cartItems");
        cartItems = JSON.parse(cartItems);

        // if there is cartItems 
        if (cartItems != null) {
            // if there is no product with that id
            if (cartItems[productID] === undefined) {
                cartItems = {
                    ...cartItems,
                    [productID]: cartItem
                };
            }
            // if there is a product with that id before
            cartItems[productID].product_quantity += Number(document.getElementById("quantity").value);
        } else {
            // create a new cartItems with an item inside
            cartItem.product_quantity = Number(document.getElementById("quantity").value);
            cartItems = {
                [productID]: cartItem
            };
        }
        // writing data to local storage
        localStorage.setItem("cartItems", JSON.stringify(cartItems));
    }
</script>