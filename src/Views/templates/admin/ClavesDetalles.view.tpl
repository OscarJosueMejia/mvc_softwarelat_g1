<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">Claves de Productos</h2> 
                <img class="ml-4" src="https://cdn-icons.flaticon.com/png/512/4438/premium/4438696.png?token=exp=1659567806~hmac=79da31275bafd6c69da9280d7b2852d1" width="60px">
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Claves buscar</label>
        <table id="grid">
            <thead>
                <th>ID Clave</th>
                <th>Producto</th>
                <th>Clave</th>
                <th>Fecha Expiración</th>
                <th>Estado</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach ClavesDetalles}}
                <tr>
                    <td>{{invClvId}}</td>
                    <td>{{invPrdName}}</td>
                    <td>
                        {{if ~CanView}}
                        <a href="index.php?page=admin_ClavesDetalle&mode=DSP&idC={{invClvId}}&id={{invPrdId}}&opt={{~opt}}">{{invClvSerial}}</a>
                        {{endif ~CanView}}
                        {{ifnot ~CanView}}
                        {{invClvSerial}}
                        {{endifnot ~CanView}}
                    </td>
                    <td>{{invClvExp}}</td>
                    <td>{{invClvEst}}</td>
                    <td>
                        {{if ~Update}}
                            {{if ~CanUpdate}}
                            <a id="update" href="index.php?page=admin_ClavesDetalle&mode=UPD&idC={{invClvId}}&id={{invPrdId}}&opt={{~opt}}" role="button">
                                <i class="fas fa-pen"></i></a>
                            {{endif ~CanUpdate}}
                        {{endif ~Update}}
                        &nbsp;&nbsp;&nbsp;&nbsp;

                        {{if ~Delete}}
                            {{if ~CanDelete}}
                            <a id="delete" href="index.php?page=admin_ClavesDetalle&mode=DEL&idC={{invClvId}}&id={{invPrdId}}&opt={{~opt}}" role="button">
                                <i class="fas fa-trash-alt"></i></a>
                            {{endif ~CanDelete}}
                        {{endif ~Delete}}
                    </td>
                </tr>
                {{endfor ClavesDetalles}}
            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
    $("table#grid").Grid({

        width: "100%",

        language: {
            'search': {
                'placeholder': 'Valor de búsqueda...'
            },
            'pagination': {
                'previous': 'Previa',
                'next': 'Siguiente',
                'showing': 'Mostrando',
                'to': 'a',
                'of': 'de',
                'results': () => 'Registros'
            }
        },

        search: true,
        pagination: true,
        limit: 10,
        sort: true,

        style: {
            table: {
                "width": "100%"
            }
        },

        columns: [{ name: "Acción", width: '95px', sort: false }],
    });

    {{if CanInsert}}
        $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_ClavesDetalle&mode=INS&id={{invPrdId}}&opt={{opt}}" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");
    {{endif CanInsert}}
        $(`<div>
        <a style="float:right; margin-left:10px; margin-right:10px" width:97px; id="showACT"  name="showACT" href="index.php?page=admin_ClavesDetalles&id={{invPrdId}}&opt=1" class="btn btn-info" role="button">ACTIVO</a>
        <a style="float:right; margin-left:10px; width:97px" id="showINA" name="showINA" href="index.php?page=admin_ClavesDetalles&id={{invPrdId}}&opt=2" class="btn btn-info" role="button">INACTIVO</a>
        <a style="float:right; margin-left:10px; width:97px" id="showVEN" name="showVEN" href="index.php?page=admin_ClavesDetalles&id={{invPrdId}}&opt=3" class="btn btn-info" role="button">VENDIDO</a>
    </div>`).insertBefore(".gridjs-search");

</script>