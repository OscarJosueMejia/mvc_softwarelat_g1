<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">Usuarios Registrados</h2> 
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <label for="grid">Orden a buscar</label>
        <table id="grid">
            <thead>
                <th>Email</th>
                <th>Nombre de Usuario</th>
                <th>Contraseña Expira</th>
                <th>Estado</th>
                <th>Tipo</th>

                <th>Acción</th>
            </thead>
            <tbody>
                {{foreach Usuarios}}
                <tr>
                    <td> <a href="index.php?page=admin_usuario&mode=DSP&id={{usercod}}">{{useremail}}</a></td>
                    <td>{{username}}</td>
                    <td>{{userpswdexp}}</td>
                    <td>{{userest}}</td>
                    <td>{{usertipo}}</td>

                    <td>
                        <a href="index.php?page=admin_usuario&mode=UPD&id={{usercod}}">Editar</a>
                    </td>
                </tr>
                {{endfor Usuarios}}
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
    $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="index.php?page=admin_usuario&mode=INS" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");

</script>