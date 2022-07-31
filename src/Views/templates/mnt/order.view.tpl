<div class="d-flex justify-content-center align-items-center">
    <h1 class="text-center pt-3">Datos de la Compra</h1>
</div>
<hr>
<section>
    <div class="mx-5">
        <h3>Listado de Productos</h3>
        <div class="d-flex justify-content-center mt-4">
            <div class="table-responsive w-75">
                <table class="table table-striped" style="font-size: 1.2rem;">
                    <tr>
                        <th>Producto</th>
                        <th>Clave de Producto</th>
                        <th>Límite de Activación</th>
                        <th>Precio Unitario</th>
                        <th>Fecha de Expiración</th>
                    </tr>
                    {{foreach OrderItems}}
                    <tr>
                        <td>{{invPrdName}}</td>
                        <td>{{invClvSerial}}</td>
                        <td>1</td>
                        <td>Lps. {{invPrdPriceISV}}</td>
                        <td>{{invClvExp}}</td>
                    </tr>
                    {{endfor OrderItems}}
                </table>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center flex-row flex-wrap mt-4">
            <div class="mx-5 mt-4 px-5 py-4" style="background-color: #e8e9ec; border-radius:5px">
                <h3>Detalles de la Orden</h3>
                <div class="ml-1 mt-3">
                    {{foreach OrderDetails}}
                    <h5><strong>Referencia:</strong> {{orderCode}}</h5>
                    <h5><strong>Fecha:</strong> {{created_at}}</h5>
                    <h5><strong>Método de Pago:</strong> {{providerName}}</h5>
                    <h5><strong>Estado del Pago:</strong> {{payStatus}}</h5>
                    <h5><strong>Total:</strong> Lps. {{total}}</h5>
                    <h5><strong>Total USD:</strong> ${{totalUSD}}</h5>
                    {{endfor OrderDetails}}

                </div>
            </div>
            <div class="mx-5 mt-4 px-5 py-4" style="background-color: #e8e9ec; border-radius:5px">
                <h3>Detalles de Facturación</h3>
                <div class="ml-1 mt-3">
                    <h5><strong>Referencia:</strong> {{referenceId}}</h5>
                    <h5><strong>Cliente:</strong> {{customer_name}}</h5>
                    <h5><strong>Dirección:</strong> {{address_line}}</h5>
                    <h5><strong>Dirección:</strong> {{admin_area}}</h5>
                    <h5><strong>Código Postal:</strong> {{postal_code}}</h5>
                    <h5><strong>País:</strong> {{country_code}}</h5>
                    <h5><strong>Email:</strong> {{email_address}}</h5>
                </div>
            </div>
        </div>
    </div>

</section>