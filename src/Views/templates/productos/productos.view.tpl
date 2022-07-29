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
        <div id="grid"></div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<script>
    $("div#grid").Grid({

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

        columns: ["ID", "Nombre", "Categoría", "Precio", {name: "Acción", width: '95px', sort: false}],
        data: [
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
            ["1", gridjs.html(`<a href="#" >Office 2021 Professional Plus PA</a>`), "Ofimatica", "L. 400.00", gridjs.html(`<a id="update" href="#" role="button"><i class="fas fa-pen"></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <a id="delete" href="#" role="button"><i class="fas fa-trash-alt"></i></a>`)],
        ]
    });

    $(`<a style="float: right;width: 97px;" class="btn btn-primary" href="#" role="button">AGREGAR</a>`).insertBefore(".gridjs-search");
</script>