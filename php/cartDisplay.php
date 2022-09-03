<script>
    let productsPrice = 0;

    function displayCart() {
        let productList = localStorage.getItem("cartItems");
        productList = JSON.parse(productList);
        let productTable = document.querySelector(".productTable");

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
                                    <div class="container pt-2" id="${item.product_ID}">
                                        <button type="button" class="btn btn-outline-danger removeItem" onclick="removeProduct()">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `
        })
        document.getElementById("productsPrice").innerHTML += productsPrice.toFixed(2);
        document.getElementById("totalPrice").innerHTML += (productsPrice + 2).toFixed(2);
    }


    // document.querySelectorAll(".removeItem", function (item){
    //     item.addEventListener("click", function (){
    //         alert("Hi");
    //     })
    // })


    // document.querySelectorAll(".removeItem").forEach(function (item) {
    //     item.addEventListener("click", function () {
    //         alert("Hi");
    //         let productList = localStorage.getItem("cartItems");
    //         productList = JSON.parse(productList);
    //         let productID = this.parentNode.parentNode.id;
    //         delete productList[productID];
    //         localStorage.setItem("cartItems", JSON.stringify(productList));
    //         location.reload();
    //     })
    // })


</script>