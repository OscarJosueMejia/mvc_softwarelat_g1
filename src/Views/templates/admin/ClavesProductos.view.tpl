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
            {{invPrdName}}
          </td>
          <td>{{invPrdCat}}</td>
          <td>{{stock}}</td>
          <td>L. {{invPrdPrice}}</td>

          <td>
            <a id="clavesView" href="index.php?page=admin_ClavesDetalles&id={{invPrdId}}&opt=1" role="button">
              <i style="font-size:x-large; " class="fas fa-plus-circle"></i></a>
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
</script>