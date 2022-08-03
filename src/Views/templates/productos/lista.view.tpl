<!-- Items Starts Here -->
    <div class="featured-page">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Productos</h1>
            </div>
          </div>
          <div class="col-md-8 col-sm-12">
            <div id="filters" class="button-group">
              <label for="selectCategoria">Categoría: &nbsp;</label>
                <select name="selectCategoria" id="selectCategoria" style="width: 250px;" class="custom-select">
                  <option value="-1" selected>Seleccione</option>
                  <option value="-1">Todas</option>
                  {{foreach dataSetCategorias}}
                      <option value="{{catid}}">{{catnom}}</option>
                  {{endfor dataSetCategorias}}
                </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="featured container">
        <div class="search-bar mb-4">
            <form action="" method="post" class="form-inline my-2 my-lg-0">
                <input name="txtBuscar" id="txtBuscar" class="form-control mr-sm-2" type="search" placeholder="🔍&nbsp;Producto..." aria-label="Search">
                <button name="btnBuscar" id="btnBuscar" class="main-button-btn my-2 my-sm-0" type="button">Buscar</button>
            </form>
        </div>
        <p>Mostrando {{perPage}} de {{countProductos}} productos disponibles.</p>
        <div class="row">
          {{foreach Productos}}
            <div id="{{invPrdId}}" class="col-md-4 col-sm-12">
                <a href="index.php?page=productos_detalle&id={{invPrdId}}">
                  <div class="list-item">
                    <img class="img-fluid" src="{{invPrdImg}}" alt="{{invPrdId}}">
                    <p class="mt-2">{{invPrdCat}}</p>
                    <h4>{{invPrdName}}</h4>
                    <h6>L. {{invPrdPriceISV}}</h6>
                    <div style="margin-top: 50px" class="main-button text-center"><i class="fas fa-cart-plus fa-lg"></i> &nbsp; Comprar Ahora</a>
                    </div>
                  </div>
                </a>
            </div>
          {{endfor Productos}}
        </div>
    </div>

    <div class="page-navigation">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul>
                {{htmlPagCount}}
                {{htmlPagBack}}
                {{htmlPag}}
                {{htmlPagNext}}
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Featred Page Ends Here -->

    <script>
        $('#selectCategoria').on('change', function() {
            var selectedValue = $(this).find(":selected").val();
            window.location.assign("index.php?page=productos_lista&pag=1&catid="+selectedValue);
        });
        $('#btnBuscar').on('click', function() {
            var buscarValue = $("#txtBuscar").val();
            window.location.assign("index.php?page=productos_lista&pag=1&sq=" + buscarValue);
        });
    </script>