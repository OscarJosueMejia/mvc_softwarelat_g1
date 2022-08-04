<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">Categorías</h2> 
                <img class="ml-4" src="https://cdn-icons-png.flaticon.com/512/347/347674.png" width="60px">
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Categorías buscar</label>
        <table id="grid">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Categorias}}
                <tr>
                    <td>{{catid}}</td>

                    <td>
                        {{if ~CanView}}
                            <a href="index.php?page=admin_categoria&mode=DSP&id={{catid}}">{{catnom}}</a>
                        {{endif ~CanView}}
                        {{ifnot ~CanView}}
                            {{catnom}}
                        {{endifnot ~CanView}}
                    </td>
                    <td>{{catest}}</td>

                    <td>
                        {{if ~CanUpdate}}
                            <a id="update" href="index.php?page=admin_categoria&mode=UPD&id={{catid}}" role="button"><i class="fas fa-pen"></i></a>
                        {{endif ~CanUpdate}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{if ~CanDelete}}
                            <a id="delete" href="index.php?page=admin_categoria&mode=DEL&id={{catid}}" role="button"><i class="fas fa-trash-alt"></i></a>
                        {{endif ~CanDelete}}
                    </td>
                </tr>
                {{endfor Categorias}}
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
        $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_categoria&mode=INS&id=0" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");
    {{endif CanInsert}}
</script>