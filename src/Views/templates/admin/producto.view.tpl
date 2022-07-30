<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <h2 class="d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:40%">
        <form action="index.php?page=productos_Producto" method="post" style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="invPrdId" value="{{invPrdId}}" />

          <div class="form-group" style="border-color:transparent;">
            <label for="invPrdName">Nombre Producto</label>
            <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invPrdName" name="invPrdName" placeholder="Nombre" value="{{invPrdName}}" />
            {{if error_invPrdName}}
            {{foreach error_invPrdName}}
            <div class="error">{{this}}</div>
            {{endfor error_invPrdName}}
            {{endif error_invPrdName}}
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="invPrdDsc">Descripción Producto</label>
            <textarea class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invPrdDsc" name="invPrdDsc" placeholder="Descripción" value="{{invPrdDsc}}" /></textarea>
            {{if error_invPrdDsc}}
            {{foreach error_invPrdDsc}}
            <div class="error">{{this}}</div>
            {{endfor error_invPrdDsc}}
            {{endif error_invPrdDsc}}
          </div>

           <div class="form-group" style="border-color:transparent;">
              <label for="invPrdCat"> Categoría</label><br />
              <select name="invPrdCat" id="invPrdCat" {{if readonly}} readonly disabled {{endif readonly}} class="form-control col-md-6">
                {{foreach invPrdCatArr}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor invPrdCatArr}}
              </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6" style="border-color:transparent;">
              <label for="invPrdPrice"> Precio</label><br />
              <input type="number" class="form-control" id="invPrdPrice" placeholder="Precio" name="invPrdPrice" {{if readonly}} readonly {{endif readonly}} value="{{invPrdPrice}}"/>
               {{if error_invPrdPrice}}
               {{foreach error_invPrdPrice}}
               <div class="error">{{this}}</div>
               {{endfor error_invPrdPrice}}
               {{endif error_invPrdPrice}}
            </div>

            <div class="form-group col-md-6" style="border-color:transparent;">
              <label for="invPrd">Cantidad</label><br />
              <input type="number" class="form-control"  id="invPrd" placeholder="Cantidad" name="invPrd" {{if readonly}} readonly {{endif readonly}} value="{{invPrd}}"/>
              {{if error_invPrd}}
              {{foreach error_invPrd}}
              <div class="error">{{this}}</div>
              {{endfor error_invPrd}}
              {{endif error_invPrd}}
            </div>
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="invPrdEst">Estado</label><br />
            <select name="invPrdEst" id="invPrdEst" {{if readonly}} readonly disabled {{endif readonly}} class="form-control col-md-6">
              {{foreach invPrdEstArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor invPrdEstArr}}
            </select>
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="invPrdImg">Imagen</label>
              <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invPrdImg" name="invPrdImg" placeholder="Imagen" value="{{invPrdImg}}" />
              {{if error_invPrdImg}}
              {{foreach error_invPrdImg}}
              <div class="error">{{this}}</div>
              {{endfor error_invPrdImg}}
              {{endif error_invPrdImg}}
          </div>

          <hr className="mt-5" />
          <br />

          <div class="d-flex align-items-center justify-content-center">
            {{if showBtn}}
            <button name="btnEnviar" class="btn btn-warning" type="submit">{{btnEnviarText}}</button>
            &nbsp;&nbsp;&nbsp;
            {{endif showBtn}}
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Eliminar</button>
          </div>

        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
  window.location.href = "index.php?page=productos_Productos"; }); });
</script>