<!-- Main content -->
<div class="content">
  <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:50%">
        <form action="index.php?page=admin_Categoria" method="post"
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
            <label for="catest">Estado</label><br />
            <select name="catest" id="catest" {{if readonly}} readonly disabled {{endif readonly}}
              class="form-control col-md-6">
              {{foreach catestArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor catestArr}}
            </select>
          </div>

          <hr className="mt-5" />
          <br />

          <div class="d-flex align-items-center justify-content-center">
            {{if showBtn}}
            <button name="btnEnviar" class="btn btn-warning" type="submit">{{btnEnviarText}}</button>
            &nbsp;&nbsp;&nbsp;
            {{endif showBtn}}
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Cancelar</button>
          </div>

        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
  <!-- Button trigger modal -->
  <button style="display: none;" id="modalButton" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#staticBackdrop">
    Launch static backdrop modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
</script>