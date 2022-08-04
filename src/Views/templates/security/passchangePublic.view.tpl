<!-- Main content -->
<div class="content">
    <br>
    <br>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div style="width:30%">
                <div>
                    <h2 class="text-center">Cambia tu contraseña</h2>
                </div>
                <form action="index.php?page=sec_passwordchange" method="post"
                    style="border-radius:1rem; padding:1rem; font-size:1.1rem">
                    <input type="hidden" name="mode" value="{{mode}}" />
                    <input type="hidden" name="catid" value="{{catid}}" />

                    <div class="form-group" style="border-color:transparent;">
                        <label style="font-size: medium;" for="txtContrActual">Contraseña Actual</label>
                        <div>
                            <input class="form-control" type="password" id="txtContrActual" name="txtContrActual" placeholder="Contraseña Actual..." />
                        </div>
                        {{if errorPswdActual}}
                        <div class="error">{{errorPswdActual}}</div>
                        {{endif errorPswdActual}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label style="font-size: medium;" for="txtPswdNew">Contraseña Nueva</label>
                        <input class="form-control" type="password" placeholder="Nueva Contraseña..." id="txtPswdNew" name="txtPswdNew"
                            value="{{txtPswdNew}}" />

                        {{if errorPswdNew}}
                        <div class="error">{{errorPswdTemp}}</div>
                        {{endif errorPswdNew}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="txtPswdConf">Confirmar Contraseña</label>
                        <input class="form-control" type="password" id="txtPswdConf" name="txtPswdConf"  placeholder="Confirmar Contraseña..."/>

                        {{if errorPswdConf}}
                        <div class="error">{{errorPswdConf}}</div>
                        {{endif errorPswdConf}}
                    </div>

                    {{if generalError}}
                    <div class="row">
                        {{generalError}}
                    </div>
                    {{endif generalError}}
                    <br>
                    <div class="main-button m-auto text-center">
                        <button class="main-button-btn" id="btnCambiar" name="btnCambiar" type="submit">Cambiar Contraseña</button>
                        &nbsp;&nbsp;
                        <button class="main-button-btn" id="btnCancelar" type="button">Cancelar</button>
                        &nbsp;
                        &nbsp;
                    </div>
                    <br>
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
      window.location.href = "index.php?page=pages_infouser";
    });
  });
</script>