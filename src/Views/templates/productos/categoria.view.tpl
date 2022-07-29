<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Starter Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <h2 class="d-flex align-items-center justify-content-center">{{mode_desc}}</h2>
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div style="width:40%">
        <form action="index.php?page=productos_Categoria" method="post" style="border-radius:1rem; padding:1rem; font-size:1.1rem">
          <input type="hidden" name="mode" value="{{mode}}" />
          <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
          <input type="hidden" name="catid" value="{{catid}}" />

          <div class="form-group" style="border-color:transparent;">
            <label for="catnom">Nombre Categoría</label>
            <input class="form-control" {{if readonly}} readonly {{endif readonly}} type="text" id="catnom" name="catnom" placeholder="Nombre" value="{{catnom}}" />
            {{if error_catnom}}
            {{foreach error_catnom}}
            <div class="error">{{this}}</div>
            {{endfor error_catnom}}
            {{endif error_catnom}}
          </div>

          <div class="form-group" style="border-color:transparent;">
            <label for="catest">Estado</label><br />
            <select name="catest" id="catest" {{if readonly}} readonly disabled {{endif readonly}} class="form-control col-md-6">
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
            <button class="btn btn-danger" name="btnCancelar" id="btnCancelar">Eliminar</button>
          </div>

        </form>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>
  document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
  window.location.href = "index.php?page=productos_Categorias"; }); });
</script>