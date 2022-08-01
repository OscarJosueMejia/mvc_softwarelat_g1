<!-- Main content -->
<div class="content">
    <h2 class="pt-5 mb-4 d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div style="width:50%">

                <form action="index.php?page=admin_funcion" method="post" id="function_form"
                    style="border-radius:1rem; padding:1rem; font-size:1.1rem">

                    <input type="hidden" name="mode" value="{{mode}}" />
                    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
                    <input type="hidden" name="fncod" value="{{fncod}}" />

                    <div class="form-group" style="border-color:transparent;">
                        <label for="fncod">Código</label>
                        <input class="form-control" type="text" id="fncod" name="fncod" placeholder="Código"
                            value="{{fncod}}" {{if readonly}} readonly {{endif readonly}} />
                        {{if error_fncod}} {{foreach error_fncod}} <div class="error">{{this}}</div>
                        {{endfor error_fncod}}
                        {{endif error_fncod}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="fndsc">Descripción</label>
                        <input class="form-control" type="text" id="fndsc" name="fndsc" placeholder="Descripción"
                            value="{{fndsc}}" {{if readonly}} readonly {{endif readonly}} />

                        {{if error_fndsc}} {{foreach error_fndsc}} <div class="error">{{this}}</div>
                        {{endfor error_fndsc}}
                        {{endif error_fndsc}}
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="fntyp">Tipo</label>
                        <select class="form-control" name="fntyp" id="fntyp" {{if readonly}} readonly disabled
                            {{endif readonly}}>
                            {{foreach fntypArr}}
                            <option value="{{value}}" {{selected}}>{{text}}</option>
                            {{endfor fntypArr}}
                        </select>
                    </div>

                    <div class="form-group" style="border-color:transparent;">
                        <label for="fnest">Estado</label>
                        <select class="form-control" name="fnest" id="fnest" {{if readonly}} readonly disabled
                            {{endif readonly}}>
                            {{foreach fnestArr}}
                            <option value="{{value}}" {{selected}}>{{text}}</option>
                            {{endfor fnestArr}}
                        </select>
                    </div>

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
                <img class="mt-3" style="margin: auto; width:50px" src="https://i.ibb.co/6Bz2x2r/question.png"
                    alt="question" border="0">
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
            e.preventDefault();
            e.stopPropagation();
            window.location.href = "index.php?page=admin_funciones";
        });
    });

    $('#btnEnviar').click(function () {
        $('#function_form').submit();
    });

</script>