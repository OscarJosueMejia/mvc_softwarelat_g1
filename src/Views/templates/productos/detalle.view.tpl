<!-- Single Starts Here -->
<div class="single-product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h1>{{invPrdName}}</h1>
        </div>
      </div>
      <div class="col-md-6">
          <div class="product-slider">
            <div id="slider" class="flexslider">
              <img class="img-fluid" src="{{invPrdImg}}" />
            </div>
          </div>
        </div>
      <div class="col-md-6">
        <div class="right-content">
          <h4>{{invPrdName}}</h4>
          <div>
            {{invPrdDsc}}
          </div>
          <h6>L. {{invPrdPriceISV}}</h6>
          <span {{if isOutStock}} style="color: red;" {{endif isOutStock}} >{{disponibles_venta}} disponibles {{if isOutStock}} SIN STOCK {{endif isOutStock}}</span>
          <form id="form" action="" method="post">
            <label for="txtCant">Cantidad:</label>
            <input {{if isOutStock}} disabled {{endif isOutStock}} name="txtCant" type="number" class="quantity-text" id="txtCant" value="1" min="1" max="10">
            <button  {{if isOutStock}} disabled {{endif isOutStock}} type="button" class="button" id="btnComprar" name="btnComprar"> <i class="fas fa-cart-plus fa-lg"></i> &nbsp; Agregar al Carrito</button>
          </form>
          <div class="down-content">
            <div class="categories">
              <h6>Categoría: <span>{{catnom}}</span></h6>
            </div>
            <div class="share">
              <h6>Compartir: <span><a href="#"><i class="fab fa-facebook"></i></a><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-whatsapp"></i></a></span></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Single Page Ends Here -->
<!-- Similar Starts Here -->
<div class="featured-items">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h1>Productos Relacionados</h1>
        </div>
      </div>
      <div class="col-md-12">
        <div class="owl-carousel owl-theme">
          {{foreach Productos}}
            <a href="index.php?page=productos_detalle&id={{invPrdId}}">
              <div class="featured-item">
                <img src="{{invPrdImg}}" alt="{{invPrdId}}">
                <p class="mt-2">{{catnom}}</p>
                <h4>{{invPrdName}}</h4>
                <h6>L. {{invPrdPriceISV}}</h6>
              </div>
            </a>
          {{endfor Productos}}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Similar Ends Here -->

<script>
  $(document).ready(function(){
    $("#btnComprar").click(function(){
      if($("#txtCant").val() <= {{disponibles_venta}}){
        $("#sinStock").remove();

      }
      else{
        $(`<span id="sinStock" style="color: red;margin-bottom: 0;">¡STOCK INSUFICIENTE!</span>`).insertAfter("#form");
      }
    });
  });
</script>
