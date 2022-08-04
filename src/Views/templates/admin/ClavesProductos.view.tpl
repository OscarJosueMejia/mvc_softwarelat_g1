<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">Productos</h2> 
                <img class="ml-4" src="https://cdn-icons.flaticon.com/png/512/1822/premium/1822045.png?token=exp=1659567515~hmac=b5f16c9f3fb5eb8197bad91b8b59b36f" width="60px">
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
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
          <td>L. {{invPrdPriceISV}}</td>

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