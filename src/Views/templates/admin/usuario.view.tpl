<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <h2 class="d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div style="width:40%">
                <form action="index.php?page=admin_usuario" method="post"
                    style="border-radius:1rem; padding:1rem; font-size:1.1rem">
                    <input type="hidden" name="mode" value="{{mode}}" />
                    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
                    <input type="hidden" name="usercod" value="{{usercod}}" />

                    <div class="form-group" style="border-color:transparent;">
                        <label for="useremail">Email</label>
                        <input class="form-control" {{if readonlyEmail}} readonly {{endif readonlyEmail}} type="text"
                            id="useremail" name="useremail" placeholder="Email" value="{{useremail}}" />
                        {{if error_useremail}}
                        {{foreach error_useremail}}
                        <div class="error">{{this}}</div>
                        {{endfor error_useremail}}
                        {{endif error_useremail}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="username">Nombre Usuario</label>
                        <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text"
                            id="username" name="username" placeholder="Nombre de Usuario" value="{{username}}" />
                        {{if error_username}}
                        {{foreach error_username}}
                        <div class="error">{{this}}</div>
                        {{endfor error_username}}
                        {{endif error_username}}
                    </div>

                    {{if isInsert}}
                    <div class="form-group" style="border-color:transparent;">
                        <label for="userpswd">Contraseña</label>
                        <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="password"
                            id="userpswd" name="userpswd" value="{{userpswd}}" />
                        {{if error_userpswd}}
                        {{foreach error_userpswd}}
                        <div class="error">{{this}}</div>
                        {{endfor error_userpswd}}
                        {{endif error_userpswd}}
                    </div>
                    {{endif isInsert}}
                    {{ifnot isInsert}}
                    <div class="form-group" style="border-color:transparent;">
                        <label for="userest">Estado</label><br />
                        <select name="userest" id="userest" {{if readonly}} readonly disabled {{endif readonly}}
                            class="form-control col-md-6">
                            {{foreach userestArr}}
                            <option value="{{value}}" {{selected}}>{{text}}</option>
                            {{endfor userestArr}}
                        </select>
                    </div>
                    {{endifnot isInsert}}


                    <div class="form-group" style="border-color:transparent;">
                        <label for="usertipo">Tipo</label><br />
                        <select name="usertipo" id="usertipo" {{if readonly}} readonly disabled {{endif readonly}}
                            class="form-control col-md-6">
                            {{foreach usertipoArr}}
                            <option value="{{value}}" {{selected}}>{{text}}</option>
                            {{endfor usertipoArr}}
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
</div>
<!-- /.content -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("btnCancelar").addEventListener("click", function (e) {
            e.preventDefault(); e.stopPropagation();
            window.location.href = "index.php?page=admin_usuarios";
        });
    });
</script>