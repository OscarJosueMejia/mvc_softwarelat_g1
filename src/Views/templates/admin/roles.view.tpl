<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Roles Registrados</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Rol a buscar</label>
        <table id="grid">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Roles}}
                <tr>
                    <td><a href="index.php?page=admin_rol&mode=DSP&id={{rolescod}}">{{rolescod}}</a></td>
                    <td>{{rolesdsc}}</td>
                    <td>{{rolesest}}</td>

                    <td>
                        <a href="index.php?page=admin_rol&mode=UPD&id={{rolescod}}">Editar</a>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <a href="index.php?page=admin_rolesfn&id={{rolescod}}">Funciones</a>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <a href="index.php?page=admin_rol&mode=DEL&id={{rolescod}}">Eliminar</a>
                    </td>
                </tr>
                {{endfor Roles}}
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
    $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_rol&mode=INS" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");

</script>