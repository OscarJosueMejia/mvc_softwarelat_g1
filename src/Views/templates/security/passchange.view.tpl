
<!-- Main content -->
<div class="content">
    <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div style="width:50%">
                <div>
                    <h1 class="text-center">Cambia tu contraseña</h1>
                </div>
                <form action="index.php?page=sec_passwordrecovery" method="post"
                    style="border-radius:1rem; padding:1rem; font-size:1.1rem">
                    <input type="hidden" id="intStep" name="intStep" value="2">
                    <input type="hidden" name="mode" value="{{mode}}" />
                    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
                    <input type="hidden" name="catid" value="{{catid}}" />

                    <div class="form-group" style="border-color:transparent;">
                        <label for="txtEmail">Correo Electrónico</label>
                        <div>
                            <input class="form-control" type="email" id="txtEmail" name="txtEmail"
                                value="{{txtEmail}}" />
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
                        <label for="txtPswdNew">Contraseña Nueva</label>
                        <input class="form-control" type="password" id="txtPswdNew" name="txtPswdNew"
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

                    <div class="main-button m-auto text-center">
                        <button class="primary" id="btnLogin" type="submit">Cambiar Contraseña</button>
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