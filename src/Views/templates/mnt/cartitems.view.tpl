<h2 class="text-center pt-4">Carrito ({{ItemsCount}})</h2>
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

                            <div class="d-flex flex-row align-items-center">

                                <div class="d-flex flex-row align-items-center mr-5">
                                    <form class="d-flex flex-row align-items-center" style="margin-bottom: -0.2rem;"
                                        action="index.php?page=mnt_cartItems" method="post">
                                        <input type="hidden" id="cartItemId" name="cartItemId" value="{{cartItemId}}">
                                        <input type="hidden" id="invPrdId" name="invPrdId" value="{{invPrdId}}">
                                        <input type="hidden" id="quantity" name="quantity" value="{{quantity}}">

                                        <button class="mx-3"
                                            style="border:none; border-radius: 10px; background-color:#f4f4f4; color:black; height:2.4rem; width:2.4rem"
                                            type="submit" id="increaseQty" name="increaseQty">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1237/1237946.png"
                                                width="15px">
                                        </button>
                                        <div class="d-flex justify-content-center p-3"
                                            style="background-color:#f7f4f4; width:5rem; border-radius:5px; font-size: 1.3rem;">
                                            {{quantity}}
                                        </div>
                                        <button class="mx-3"
                                            style="border:none; border-radius: 10px; background-color:#f4f4f4; color:black; height:2.4rem; width:2.4rem"
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
                                            style="background-color:#fb9090; border:none; border-radius:10px; margin-top:0.7rem; height:2.6rem; width:2.6rem">
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
            {{if existentItems}}
            <small style="font-size: 1.2rem;"> <i>El precio de cada producto tiene I.S.V. incluidos.</i></small>
            {{endif existentItems}}

        </div>


        <div class="mr-5 px-4 py-3 shadow-sm mt-4" style="background-color: white; border-radius:5px">
            <h4 class="text-center mt-2">Resumen de Compra</h4>
            <div class="mt-4">
                <h5><strong>Cantidad:</strong> {{ItemsCount}} artículos</h5>
                <h5><strong>SubTotal:</strong> Lps. {{SubTotal}}</h5>
                <hr class="mt-5">
                <h5 class="mt-4"><strong>Total (ISV Incluidos):</strong> Lps. {{Total}}</h5>
                <h5><strong>Total USD:</strong> ${{DollarsTotal}}</h5>
            </div>
            <div class="text-center mt-5">
                {{if existentItems}}
                <form action="index.php?page=mnt_cartItems" method="post">
                    <button style="background-color: #ffc43c; border:none; border-radius:50px; width: 20rem;
                        height:2.7rem" id="goPayPal" name="goPayPal">
                        <img src="https://logodownload.org/wp-content/uploads/2014/10/paypal-logo.png" width="110px">
                    </button>
                </form>
                {{endif existentItems}}
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="errorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="color: red;">¡Lo sentimos!</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 1.2rem;"> {{ErrorDescription}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

</section>
{{ErrorTrigger}}