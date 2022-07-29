<h1 class="text-center pt-4">Carrito ({{ItemsCount}})</h1>
<section>

    <div class="d-flex flex-wrap justify-content-center">
        <div class="card-body p-5" style="overflow-x:auto;">
            <div class="row flex-column">
                {{foreach CartItems}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="mx-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/807/807292.png"
                                        class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                </div>
                                <div class="ml-3 ms-3">
                                    <h5 style="font-size: 1.4rem;">{{invPrdName}}</h5>
                                    <p class="small mb-0" style="font-size: 1.1rem;">{{invPrdDsc}}</p>
                                </div>
                            </div>

                            <div class="d-flex flex-row">

                                <div class="d-flex flex-row align-items-center mr-5">
                                    <form class="d-flex flex-row align-items-center"
                                        action="index.php?page=mnt_cartItems" method="post">
                                        <input type="hidden" id="cartItemId" name="cartItemId" value="{{cartItemId}}">
                                        <input type="hidden" id="invPrdId" name="invPrdId" value="{{invPrdId}}">
                                        <input type="hidden" id="quantity" name="quantity" value="{{quantity}}">

                                        <button class="mx-3"
                                            style="border:none; border-radius: 10px; background-color:#f4f4f4; color:black; height:3rem;"
                                            type="submit" id="increaseQty" name="increaseQty">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1237/1237946.png"
                                                width="15px">
                                        </button>
                                        <div class="d-flex justify-content-center p-3"
                                            style="background-color:#f7f4f4; width:5rem; border-radius:5px; font-size: 1.3rem; ">
                                            {{quantity}}
                                        </div>
                                        <button class="mx-3"
                                            style="border:none; border-radius: 10px; background-color:#f4f4f4; color:black; height:3rem;"
                                            type="submit" id="decreaseQty" name="decreaseQty">
                                            <img src="https://cdn-icons-png.flaticon.com/512/659/659883.png"
                                                width="15px">
                                        </button>
                                    </form>
                                </div>

                                <div class="d-flex align-items-center mr-4" style="font-size: 1.4rem; width:10rem">
                                    Lps. {{amount}}
                                </div>
                                <div>
                                    <form action="index.php?page=mnt_cartItems" method="post">
                                        <input type="hidden" id="cartItemId" name="cartItemId" value="{{cartItemId}}">

                                        <button type="submit" id="deleteItem" name="deleteItem"
                                            style="background-color:#fb9090; border:none; border-radius:10px; margin-top:0.4rem">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png"
                                                width="25px">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{endfor CartItems}}
            </div>
        </div>

        <div class="mr-5 p-3 shadow-sm mt-4" style="background-color: white; border-radius:5px">
            <h3 class="text-center mt-2">Resumen de Compra</h3>
            <div class="mt-4">
                <h5>Cantidad: {{ItemsCount}} artículos</h5>
                <h5>SubTotal: {{SubTotal}}</h5>
            </div>
            <div class="text-center mt-5">
                <form action="index.php?page=checkout_checkout" method="post">
                    <button style="background-color: #ffc43c; border:none; border-radius:50px; width: 20rem">
                        <img src="https://logodownload.org/wp-content/uploads/2014/10/paypal-logo.png" width="110px">
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>