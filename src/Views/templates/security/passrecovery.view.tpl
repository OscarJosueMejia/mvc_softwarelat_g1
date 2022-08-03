<div class="content">
  <br>
  <br>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:30%">
        <div>
          <h2 class="text-center">Recupera tu contraseña</h2>
        </div>
        <form action="index.php?page=sec_passwordrecovery" method="post"
          style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="catid" value="{{catid}}" />
          <input type="hidden" id="intStep" name="intStep" value="1">
          
          <div class="form-group" style="border-color:transparent;">
            <label style="font-size: medium;" for="txtEmail">Correo Electrónico</label>
            <div>
              <input class="form-control" type="email" id="txtEmail" placeholder="Correo Eletrónico..." name="txtEmail" value="{{txtEmail}}" />
            </div>
            {{if errorEmail}}
            <div class="error">{{errorEmail}}</div>
            {{endif errorEmail}}
          </div>
          {{if generalError}}
          <div class="row">
            {{generalError}}
          </div>
          {{endif generalError}}
          <br>
          <div class="d-flex align-items-center justify-content-center">
            <button class="main-button-btn" id="btnLogin" type="submit">Enviar correo</button>
            &nbsp;&nbsp;&nbsp;
            <button class="main-button-btn" name="btnCancelar" id="btnCancelar">Cancelar</button>
          </div>

          <hr className="mt-5" />
          <br />
        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault(); e.stopPropagation();
      window.location.href = "index.php?page=sec_login";
    });
  });
</script>