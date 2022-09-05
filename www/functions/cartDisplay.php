<script>
    let productsPrice = 0;
    let productList = localStorage.getItem("cartItems");
    productList = JSON.parse(productList);

    if (localStorage.getItem("cartItems") === "{}") {
    localStorage.removeItem("cartItems");
    }

    function displayCart() {
        let productTable = document.querySelector(".productTable");
        let productsPrice = 0;
        if (productList != null){
            Object.values(productList).map(function(item){
                productsPrice += Number(item.product_price) * item.product_quantity;
                productTable.innerHTML += `
                    <div class="card mb-3" >
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="container ratio ratio-1x1"> 
                                    <img src="${item.product_img}" class="img-fluid rounded-start p-2" alt="Product Image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="${item.product_link}">
                                        <h5 class="card-title">${item.product_name}</h5>
                                    </a>
                                    <span class="card-text"><small class="text-muted">$${item.product_price} | Quantity: ${item.product_quantity} | Total: $${Number((item.product_price)*item.product_quantity).toFixed(2)}</small></span>
                                    <div class="row">
                                        <div class="container pt-2">
                                            <button type="button" class="btn btn-outline-danger" onclick="removeItem(id)" id="${item.product_ID}">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
            })
        }

        document.getElementById("productsPrice").innerHTML += productsPrice.toFixed(2);
        document.getElementById("totalPrice").innerHTML += (productsPrice + 2).toFixed(2);
    }

    function removeItem(id) {
        let productList = localStorage.getItem("cartItems");
        productList = JSON.parse(productList);
        let productID = id;
        delete productList[productID];
        localStorage.setItem("cartItems", JSON.stringify(productList));
        location.reload();
    }


    function placeOrder() {
        if (localStorage.getItem("cartItems") != null) {
            <?php
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            ?>

            let customer = '<?= $_SESSION["user_data"]["username"]?>';
            let time = '<?=date("H:i:s")?>'
            let date = '<?=date("j/n/Y")?>'
          
            let hubs = ["DH1", "DH2", "DH3", "DH4"];
            let choosenHub = hubs[Math.floor(Math.random()*hubs.length)];
            let orderInfo = customer + "," + time + "," + date + "," + choosenHub

            let orderItems = "Order items =";
            Object.values(productList).map(function(item){
                orderItems += ([item.product_ID +"-"+ item.product_quantity]+",");
            });

            document.cookie = "Order info" + "=" + orderInfo + "; path=/";
            document.cookie = orderItems + "; path=/";

            window.location.replace("/functions/addOrder.php");

        } else {
            alert("Your cart doesn't have any products!");
        }
    }

</script>

