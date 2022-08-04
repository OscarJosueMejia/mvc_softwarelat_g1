<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">Roles Registrados</h2> 
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
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
                    {{if ~CanView}}
                    <td><a href="index.php?page=admin_rol&mode=DSP&id={{rolescod}}">{{rolescod}}</a></td>
                    {{endif ~CanView}}

                    {{ifnot ~CanView}}
                    <td>{{rolescod}}</td>
                    {{endifnot ~CanView}}

                    <td>{{rolesdsc}}</td>
                    <td>{{rolesest}}</td>

                    <td>
                        {{if ~CanUpdate}}
                        <a href="index.php?page=admin_rol&mode=UPD&id={{rolescod}}"><i class="fas fa-pen"></i></a>
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        <a class="ml-3" href="index.php?page=admin_rolesfn&id={{rolescod}}">
                            <i class="fas fa-list-alt"></i></a>
                        {{endif ~CanUpdate}}
                        &NonBreakingSpace;
                        &NonBreakingSpace;
                        {{if ~CanDelete}}
                        <a class="ml-3" href="index.php?page=admin_rol&mode=DEL&id={{rolescod}}">
                            <i class="fas fa-trash-alt"></i></a>
                        {{endif ~CanDelete}}
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