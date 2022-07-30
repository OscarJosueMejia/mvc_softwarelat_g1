<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Compras</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Orden a buscar</label>
        <table id="grid">
            <thead>
                <th>Orden ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Orders}}
                <tr>
                    <td>{{orderId}}</td>
                    <td>{{created_at}}</td>
                    <td>{{total}}</td>
                    <td>
                        <a id="update" href="index.php?page=admin_producto&mode=UPD&id=1" role="button">
                            <i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                {{endfor Orders}}
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
</script>