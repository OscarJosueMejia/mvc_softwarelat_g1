<h1>Carrito</h1>
<section>
    <div class="card-body p-5">

        <div class="row flex-column">
            {{foreach CartItems}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="mr-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/807/807292.png"
                                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                            </div>
                            <div class="ms-3">
                                <h5>{{invPrdName}}</h5>
                                <p class="small mb-0">{{invPrdDsc}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">

                            <div style="width: 50px;">
                                <input type="number" value="{{quantity}}" name="itemQuantity" id="itemQuantity">
                            </div>

                            <div class="mr-5" style="width: 100px;">
                                <h5 class="mb-0">Lps. {{amount}}</h5>
                            </div>
                            <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{endfor CartItems}}

        </div>
    </div>
    <button type="button" id="pressme"> Press me</button>
</section>