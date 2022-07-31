<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Producto a buscar</label>
        <table id="grid">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Productos}}
                <tr>
                    <td>{{invPrdId}}</td>

                    <td>
                        {{if ~CanView}}
                            <a href="index.php?page=admin_producto&mode=DSP&id={{invPrdId}}">{{invPrdName}}</a>
                        {{endif ~CanView}}
                        {{ifnot ~CanView}}
                            {{invPrdName}}
                        {{endifnot ~CanView}}
                    </td>
                    <td>{{invPrdCat}}</td>
                    <td>{{stock}}</td>
                    <td>L. {{invPrdPriceISV}}</td>

                    <td>
                        {{if ~CanUpdate}}
                            <a id="update" href="index.php?page=admin_producto&mode=UPD&id={{invPrdId}}" role="button"><i class="fas fa-pen"></i></a>
                        {{endif ~CanUpdate}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{if ~CanDelete}}
                            <a id="delete" href="index.php?page=admin_producto&mode=DEL&id={{invPrdId}}" role="button"><i class="fas fa-trash-alt"></i></a>
                        {{endif ~CanDelete}}
                    </td>
                </tr>
                {{endfor Productos}}
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
        $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_producto&mode=INS&id=0" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");
    {{endif CanInsert}}
</script>