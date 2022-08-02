<!--
<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Iniciar Sesión</h1>
    </section>
    <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">

      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtEmail">Correo Electrónico</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>

      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtPswd">Contraseña</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>

      {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
      {{endif generalError}}

      <div class="row right flex-end px-4">
        <button class="primary" id="btnLogin" type="submit">Iniciar Sesión</button>
      </div>

      <div>
        <a href="index.php?page=sec_register">Crear cuenta</a>
      </div>

    </section>
  </form>
</section>
-->

<!-- Main content -->
<div class="content">
  <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:50%">
        <div>
          <h1 class="text-center">Inisio de Sesion</h1>
        </div>
        <form action="index.php?page=sec_login" method="post"
          style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="catid" value="{{catid}}" />

          <div class="form-group" style="border-color:transparent;">
            <label for="txtEmail">Correo Electrónico</label>
            <div>
              <input class="form-control" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
            </div>
            {{if errorEmail}}
            <div class="error">{{errorEmail}}</div>
            {{endif errorEmail}}
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="txtPswd">Contraseña</label>
            <div>
              <input class="form-control" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
            </div>
            {{if errorPswd}}
            <div class="error">{{errorPswd}}</div>
            {{endif errorPswd}}
          </div>

          {{if generalError}}
          <div class="row">
            {{generalError}}
          </div>
          {{endif generalError}}

          <div>
            <a href="index.php?page=sec_register">Crear cuenta</a>
          </div>

          <div>
            <a href="index.php?page=sec_passwordrecovery">Recuperar Contra</a>
          </div>

          <div class="d-flex align-items-center justify-content-center">
            <button class="btn btn-warning" id="btnLogin" type="submit">Iniciar Sesión</button>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Cancelar</button>
          </div>

          <hr className="mt-5" />
          <br />
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