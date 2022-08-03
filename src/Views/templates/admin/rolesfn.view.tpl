<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Funciones Registradas: <strong>{{rolescod}}</strong></h1>
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
                {{foreach allFunctions}}
                <tr>
                    <td>{{fncod}}</td>
                    <td><a href="index.php?page=admin_funcion&mode=DSP&id={{fncod}}">{{fndsc}}</td>
                    <td>{{fnest}}</td>
                    <td>{{fntyp}}</td>

                    {{if isFunctionInRol}}
                    <td>
                        <form action="index.php?page=admin_rolesfn&id={{rolescod}}" method="post">
                            <input type="hidden" name="rolescod" value="{{rolescod}}" />
                            <input type="hidden" name="fncod" value="{{fncod}}" />
                            <button type="submit" name="btnDeleteFunction" id="btnDeleteFunction"
                                class="btn btn-danger danger">Eliminar</button>
                        </form>
                    </td>
                    {{endif isFunctionInRol}}

                    {{if NotIsFunctionInRol}}
                    <td>
                        <form action="index.php?page=admin_rolesfn&id={{rolescod}}" method="post">
                            <input type="hidden" name="rolescod" value="{{rolescod}}" />
                            <input type="hidden" name="fncod" value="{{fncod}}" />
                            <button type="submit" name="btnAddFunction" id="btnAddFunction"
                                class="btn btn-success success">Agregar</button>
                        </form>
                    </td>
                    {{endif NotIsFunctionInRol}}
                </tr>
                {{endfor allFunctions}}
            </tbody>
        </table>
    </div><!-- /.container-fluid -->
    <div class="d-flex align-items-center justify-content-center mt-5">
        <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Atrás</button>
    </div>
</div>
<!-- /.content -->

<script>

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("btnCancelar").addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "index.php?page=admin_roles";
        });
    });

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