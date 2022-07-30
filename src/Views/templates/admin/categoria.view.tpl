<!-- Main content -->
<div class="content">
  <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div id="containerForm">
        <form id="form" action="index.php?page=admin_Categoria" method="post"
          style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="catid" value="{{catid}}" />

          <div class="form-group" style="border-color:transparent;">
            <label for="catnom">Nombre Categoría</label>
            <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="catnom"
              name="catnom" placeholder="Nombre" value="{{catnom}}" />
            {{if error_catnom}}
            {{foreach error_catnom}}
            <div class="error">{{this}}</div>
            {{endfor error_catnom}}
            {{endif error_catnom}}
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="catdesc">Descripción Categoría</label>
            <textarea class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="catdesc" name="catdesc" placeholder="Descripción" />{{catdesc}}</textarea>
            {{if error_catdesc}}
            {{foreach error_catdesc}}
            <div class="error">{{this}}</div>
            {{endfor error_catdesc}}
            {{endif error_catdesc}}
          </div>
          
          {{if viewState}}
            <div class="form-group" style="border-color:transparent;">
            <label for="catest">Estado</label><br />
            <select name="catest" id="catest" {{if readonly}} readonly disabled {{endif readonly}}
              class="form-control col-md-6">
              {{foreach catestArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor catestArr}}
            </select>
          </div>
          {{endif viewState}}

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
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault(); e.stopPropagation();
      window.location.href = "index.php?page=admin_Categorias";
    });
  });
  $('#btnEnviar').click(function(){
    $('#form').submit();
});
</script>