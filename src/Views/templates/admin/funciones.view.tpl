<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Funciones Registradas</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Función a buscar</label>
        <table id="grid">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Funciones}}
                <tr>
                    {{if ~CanView}}
                    <td><a href="index.php?page=admin_funcion&mode=DSP&id={{fncod}}">{{fncod}}</td>
                    {{endif ~CanView}}

                    {{ifnot ~CanView}}
                    <td>{{fncod}}</td>
                    {{endifnot ~CanView}}

                    <td>{{fndsc}}</td>
                    <td>{{fnest}}</td>
                    <td>{{fntyp}}</td>

                    <td>
                        {{if ~CanUpdate}}
                        <a href="index.php?page=admin_funcion&mode=UPD&id={{fncod}}"><i class="fas fa-pen"></i></a>
                        {{endif ~CanUpdate}}
                        &NonBreakingSpace;
                        {{if ~CanDelete}}
                        <a href="index.php?page=admin_funcion&mode=DEL&id={{fncod}}">
                            <i class="ml-3 fas fa-trash-alt"></i>
                        </a>
                        {{endif ~CanDelete}}
                    </td>
                </tr>
                {{endfor Funciones}}
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
    $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_funcion&mode=INS" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");

</script>