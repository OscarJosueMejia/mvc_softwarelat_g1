<script src="/{{BASE_DIR}}/vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
      selector: '#invPrdDsc',
      plugins: [
        'link', 'preview'
      ],
  });
</script>
<!-- Main content -->
<div class="content">
  <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div id="containerForm">
        <form id="form" action="index.php?page=admin_producto" method="post" style="border-radius:1rem; padding:1rem; font-size:1.1rem">
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
            <textarea class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invPrdDsc" name="invPrdDsc" placeholder="Descripción"/>{{invPrdDsc}}</textarea>
            {{if error_invPrdDsc}}
            {{foreach error_invPrdDsc}}
            <div class="error">{{this}}</div>
            {{endfor error_invPrdDsc}}
            {{endif error_invPrdDsc}}
          </div>

          <div class="form-group" style="border-color:transparent;">
              <label for="invPrdCat"> Categoría</label><br />
              <select name="invPrdCat" id="invPrdCat" {{if readonly}} readonly disabled {{endif readonly}} class="form-control col-md-12">
                {{foreach invPrdCatArr}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor invPrdCatArr}}
              </select>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-12" style="border-color:transparent;">
              <label for="invPrdPrice"> Precio</label><br />
              <input type="number" class="form-control" id="invPrdPrice" placeholder="Precio" name="invPrdPrice" {{if readonly}} readonly {{endif readonly}} value="{{invPrdPrice}}"/>
               {{if error_invPrdPrice}}
               {{foreach error_invPrdPrice}}
               <div class="error">{{this}}</div>
               {{endfor error_invPrdPrice}}
               {{endif error_invPrdPrice}}
            </div>

            <div class="form-group col-md-6 col-sm-12" style="border-color:transparent;">
              <label for="invPrdEst">Estado</label><br />
              <select name="invPrdEst" id="invPrdEst" {{if readonly}} readonly disabled {{endif readonly}} class="form-control">
                {{foreach invPrdEstArr}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor invPrdEstArr}}
              </select>
            </div>
          </div>

          <div class="form-group" style="border-color:transparent;">
            
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
            <button name="btnEnviar" class="btn btn-warning" type="button" data-toggle="modal" data-target="#confirm-submit">{{btnEnviarText}}</button>
            &nbsp;&nbsp;&nbsp;
            {{endif showBtn}}
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Cancelar</button>
          </div>

        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->

  <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <b>Confirmación de Operación</b>
            </div>
            <img class="mt-3" style="margin: auto; width:50px" src="https://i.ibb.co/6Bz2x2r/question.png" alt="question" border="0">
            <div class="modal-body">
                ¿Está seguro de ejecutar esta operación?

            </div>

            <div class="modal-footer">
                <button type="button" name="btnCancelar" id="btnCancelar" class="btn btn-danger" data-dismiss="modal">No</button>
                <button type="button" name="btnEnviar" id="btnEnviar" class="btn btn-success success">Sí</button>
            </div>
        </div>
    </div>
  </div>

</div>
<!-- /.content -->
<script>
  document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
  window.location.href = "index.php?page=admin_Productos"; }); });
  $('#btnEnviar').click(function(){
      $('#form').submit();
  });
</script>