
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
                <form action="index.php?page=sec_passwordrecovery" method="post"
                    style="border-radius:1rem; padding:1rem; font-size:1.1rem">
                    <input type="hidden" id="intStep" name="intStep" value="2">
                    <input type="hidden" name="mode" value="{{mode}}" />
                    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
                    <input type="hidden" name="catid" value="{{catid}}" />

                    <div class="form-group" style="border-color:transparent;">
                        <label style="font-size: medium;" for="txtEmail">Correo Electrónico</label>
                        <div>
                            <input class="form-control" readonly type="email" id="txtEmail" name="txtEmail" placeholder="Correo Electrónico..." value="{{txtEmail}}" />
                        </div>
                        {{if errorEmail}}
                        <div class="error">{{errorEmail}}</div>
                        {{endif errorEmail}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="txtPswdTemp">Contraseña Temporal</label>
                        <input class="form-control" type="password" id="txtPswdTemp" name="txtPswdTemp"
                            value="{{txtPswdTemp}}" />

                        {{if errorPswdTemp}}
                        <div class="error">{{errorPswdTemp}}</div>
                        {{endif errorPswdTemp}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label style="font-size: medium;" for="txtPswdNew">Contraseña Nueva</label>
                        <input class="form-control" type="password" placeholder="Nueva Contraseña..." id="txtPswdNew" name="txtPswdNew"
                            value="{{txtPswdNew}}" />

                        {{if errorPswdNew}}
                        <div class="error">{{errorPswdTemp}}</div>
                        {{endif errorPswdNew}}
                    </div>

                    {{if generalError}}
                    <div class="row">
                        {{generalError}}
                    </div>
                    {{endif generalError}}
                    <br>
                    <div class="main-button m-auto text-center">
                        <button class="main-button-btn" id="btnLogin" type="submit">Cambiar Contraseña</button>
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