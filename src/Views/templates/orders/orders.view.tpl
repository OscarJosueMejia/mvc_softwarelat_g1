<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-4">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center ">Historial de Compras</h2>
                <img class="ml-4"
                    src="https://firebasestorage.googleapis.com/v0/b/servientregasbd.appspot.com/o/shophistoric.png?alt=media&token=feeb6b26-012d-4469-ac14-bd5d3a626a47"
                    width="60px">
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid mt-4 px-5">
        <label for="grid">Orden a buscar</label>
        <table id="grid">
            <thead>
                <th># Referencia</th>
                <th>Fecha</th>
                <th>Precio Total</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Orders}}
                <tr>
                    <td>{{orderCode}}</td>
                    <td>{{created_at}}</td>
                    <td>Lps. {{total}}</td>
                    <td>
                        <a id="update" href="index.php?page=orders_order&mode=DSP&id={{orderId}}" role="button">
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