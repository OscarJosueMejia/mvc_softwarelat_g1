<!-- Main content -->
<div class="content">
  <br>
  <br>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:30%">
        <div>
          <h2 class="text-center">Inicio de Sesión</h2>
        </div>
        <form action="index.php?page=sec_login" method="post"
          style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="catid" value="{{catid}}" />

          <div>
            <div class="form-group" style="border-color:transparent;">
              <label style="font-size: medium;" for="txtEmail">Correo Electrónico</label>
              <div>
                <input class="form-control" type="email" id="txtEmail" placeholder="Correo Electrónico..." name="txtEmail" value="{{txtEmail}}" />
              </div>
              {{if errorEmail}}
              <div class="error">{{errorEmail}}</div>
              {{endif errorEmail}}
            </div>

            <div class="form-group" style="border-color:transparent;">
              <label style="font-size: medium;" for="txtPswd">Contraseña</label>
              <div>
                <input class="form-control" type="password" id="txtPswd" name="txtPswd" placeholder="Contraseña..." value="{{txtPswd}}" />
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

            <div style="text-align: center;" class="reg-login">
              <a href="index.php?page=sec_passwordrecovery">¿Olvidaste tu Contraseña?</a>
            </div>
          </div>
          <br>
          <div class="main-button m-auto text-center">
            <button class="main-button-btn" id="btnLogin" type="submit"> Iniciar sesión &nbsp; <i style="font-weight: 600;" class="fas fa-sign-in-alt"></i> </button>
          </div>
          <br>
          <hr className="mt-5" />
          <div style="text-align: center;" class="reg-login">
              <a style="font-size: 15px;" href="index.php?page=sec_register">¿No tienes una Cuenta? Crea una aquí</a>
          </div>
          <br />
        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->