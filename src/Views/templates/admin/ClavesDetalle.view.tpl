<!-- Main content -->
<div class="content">
  <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div id="containerForm">
        <form id="form" action="index.php?page=admin_ClavesDetalle&id={{invPrdId}}&opt={{opt}}" method="post"
          style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="invClvId" value="{{invClvId}}" />
          <input type="hidden" name="invPrdId" value="{{invPrdId}}" />


          <div class="form-group" style="border-color:transparent;">
            <label for="invPrdName">Producto</label>
            <input class="form-control" {{if readonlyProduct}} readonly {{endif readonlyProduct}} type="text" id="invPrdName"
              name="invPrdName" placeholder="ID" value="{{invPrdName}}" />
            {{if error_invPrdName}}
            {{foreach error_invPrdName}}
            <div class="error">{{this}}</div>
            {{endfor error_invPrdName}}
            {{endif error_invPrdName}}
          </div>


          {{if viewProduct}}
          <div class="form-group" style="border-color:transparent;">
            <label for="invClvSerial">Clave</label>
            <textarea class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invClvSerial"
              name="invClvSerial" placeholder="Clave de producto, Formato: Separadas por Coma" value="{{invClvSerial}}" rows="20" /></textarea>
            {{if error_invClvSerial}}
            {{foreach error_invClvSerial}}
            <div class="error">{{this}}</div>
            {{endfor error_invClvSerial}}
            {{endif error_invClvSerial}}
          </div>
          {{endif viewProduct}}

          {{if viewProductI}}
          <div class="form-group" style="border-color:transparent;">
            <label for="invClvSerial">Clave</label>
            <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="invClvSerial"
              name="invClvSerial" placeholder="Clave de producto" value="{{invClvSerial}}" />
            {{if error_invClvSerial}}
            {{foreach error_invClvSerial}}
            <div class="error">{{this}}</div>
            {{endfor error_invClvSerial}}
            {{endif error_invClvSerial}}
          </div>
          {{endif viewProductI}}

          {{if viewDate}}
          <div class="form-group" style="border-color:transparent;">
            <label for="invClvExp">Fecha de Expiración</label>
            <input class="form-control" {{if readonlyDate}} readonly {{endif readonlyDate}} type="text" id="invClvExp"
              name="invClvExp" placeholder="Nombre" value="{{invClvExp}}" />
            {{if error_invClvExp}}
            {{foreach error_invClvExp}}
            <div class="error">{{this}}</div>
            {{endfor error_invClvExp}}
            {{endif error_invClvExp}}
          </div>
          {{endif viewDate}}

          {{if viewState}}
          <div class="form-group" style="border-color:transparent;">
            <label for="invClvEst">Estado</label><br />
            <select name="invClvEst" id="invClvEst" {{if readonly}} readonly disabled {{endif readonly}}
              class="form-control col-md-6">
              {{foreach invClvEstArr}}
              <option value="{{value}}" {{selected}}>{{text}}</option>
              {{endfor invClvEstArr}}
            </select>
          </div>
          {{endif viewState}}

          {{if viewSwitch}}
          <div class="custom-control custom-switch text-center">
              <input type="checkbox" class="custom-control-input" id="checkbox" name="checkbox">
              <label class="custom-control-label" for="checkbox">Agregar +30 días de vencimiento</label>
          </div>
          {{endif viewSwitch}}

          <input type="hidden" id="goingtoUPDdate" value="0" name="goingtoUPDdate"/>

          <hr className="mt-5"/>
          <br />

          <div class="d-flex align-items-center justify-content-center">
            {{if showBtn}}
            <button name="btnEnviar" class="btn btn-warning" type="button" data-toggle="modal"
              data-target="#confirm-submit">{{btnEnviarText}}</button>
            &nbsp;&nbsp;&nbsp;
            {{endif showBtn}}
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->

  <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <b>Confirmación de Operación</b>
        </div>
        <img class="mt-3" style="margin: auto; width:50px" src="https://i.ibb.co/6Bz2x2r/question.png" alt="question"
          border="0">
        <div class="modal-body">
          ¿Está seguro de ejecutar esta operación?
        </div>

        <div class="modal-footer">
          <button type="button" name="btnCancelar" id="btnCancelar" class="btn btn-danger"
            data-dismiss="modal">No</button>
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
      window.location.href = "index.php?page=admin_ClavesDetalles&id={{invPrdId}}&opt={{opt}}";
    });
  });

  $('#btnEnviar').click(function () {
    $('#form').submit();
  });

  var checkbox = document.querySelector('input[type="checkbox"]');
    checkbox.addEventListener('change', function (e) {
      if(this.checked){
        $('#goingtoUPDdate').val("1");
      }else{
        $('#goingtoUPDdate').val("0");
      }
  });


</script>