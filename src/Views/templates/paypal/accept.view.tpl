<div class="d-flex justify-content-center align-items-center mt-5 mb-4">
    <div class="d-flex align-items-center pt-3 mt-4">
        <h1 class="text-center ">Compra Realizada</h1>
        <img class="ml-4" src="https://cdn-icons-png.flaticon.com/512/1828/1828651.png" width="60px">
    </div>
</div>
<hr>
<section>
    <div class="mx-5 mt-4 mb-5">
        <div class="d-flex justify-content-center mt-4">
            <div class="table-responsive w-75">
                <h3 class="text-left">Listado de Productos</h3>
                <table class="table table-striped mt-3" style="font-size: 1.2rem;">
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Clave de Producto</th>
                        <th>Límite de Activación</th>
                        <th>Precio Unitario</th>
                    </tr>
                    {{foreach OrderItems}}
                    <tr>
                        <td>{{invPrdName}}</td>
                        <td>{{catnom}}</td>
                        <td>{{invClvSerial}}</td>
                        <td>1</td>
                        <td>Lps. {{invPrdPriceISV}}</td>
                    </tr>
                    {{endfor OrderItems}}
                </table>
                <small style="font-size: 1rem;"> <i>El precio de cada item tiene impuestos incluidos.</i></small>

            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center flex-row flex-wrap mt-4">

            <div class="mx-5 mt-4 px-5 py-4 shadow-sm" style="background-color: #e8e9ec; border-radius:20px">
                <div class="align-items-center justify-content-center shadow" style="display:flex; position:relative; top:-40px; right:70px; width: 4rem; height:4rem; border-radius:50px;
                background-color:#efefef">
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="" width="55px">
                </div>

                <div class="d-flex justify-content-center align-items-center px-4 pt-3 pb-2 shadow-sm"
                    style="background-color: #efefef; border-radius:10px; margin-top:-3rem; ">
                    <h3 class=" mr-4">Detalles de la Orden</h3>
                </div>
                <div class="mt-4">
                    {{foreach OrderDetails}}
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Referencia:</strong> {{orderCode}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem; margin-top:1rem;"><strong>Fecha: </strong>
                        {{created_at}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Método de Pago: </strong>
                        {{providerName}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Estado del Pago: </strong> {{payStatus}}
                    </h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem; margin-top:2rem;"><strong>Total: </strong>Lps.
                        &nbsp;{{total}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Total USD:</strong> $ {{totalUSD}}</h5>
                    {{endfor OrderDetails}}

                </div>
            </div>

            <div class="mx-5 mt-4 px-5 py-4 shadow-sm" style="background-color: #e8e9ec; border-radius:20px">
                <div class="align-items-center justify-content-center shadow" style="display:flex; position:relative; top:-40px; right:70px; width: 4rem; height:4rem; border-radius:50px;
                background-color:#efefef">
                    <img src="https://firebasestorage.googleapis.com/v0/b/servientregasbd.appspot.com/o/paypal.png?alt=media&token=05a5c5bb-b80d-4895-a12c-a56ed682bff9"
                        alt="" width="55px">
                </div>
                <div class="d-flex justify-content-center align-items-center px-4 pt-3 pb-2 shadow-sm"
                    style="background-color: #efefef; border-radius:10px; margin-top:-3rem; ">
                    <h3 class=" mr-4">Detalles de Facturación</h3>
                </div>
                <div class="ml-1 mt-3">
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Referencia:</strong> {{referenceId}}
                    </h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem; margin-top:1rem;"><strong>Cliente: </strong>
                        {{customer_name}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Dirección 1:</strong> {{address_line}}
                    </h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Dirección 2:</strong> {{admin_area}}
                    </h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Código Postal:</strong> {{postal_code}}
                    </h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>País:</strong> {{country_code}}</h5>
                    <h5 style="line-height: 2.1rem; margin-left:-1rem;"><strong>Email:</strong> {{email_address}}</h5>
                </div>
            </div>
        </div>
    </div>
</section>