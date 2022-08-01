<h1>{{mode_desc}}</h1>
<section>
  <form action="index.php?page=mnt_ClavesDetalle" method="post">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="crsf_token" value="{{crsf_token}}" />
    <input type="hidden" name="invClvId" value="{{invClvId}}" />

    <fieldset>
      <label for="invPrdId">invPrdId</label>
      <input {{if readonly}} readonly {{endif readonly}} type="text" id="invPrdId" name="invPrdId" placeholder="invPrdId" value="{{invPrdId}}" />
      {{if error_invPrdId}}
      {{foreach error_invPrdId}}
      <div class="error">{{this}}</div>
      {{endfor error_invPrdId}}
      {{endif error_invPrdId}}
    </fieldset>

    <fieldset>
      <label for="invClvSerial">invClvSerial</label>
      <input {{if readonly}} readonly {{endif readonly}} type="text" id="invClvSerial" name="invClvSerial" placeholder="invClvSerial" value="{{invClvSerial}}" />
      {{if error_invClvSerial}}
      {{foreach error_invClvSerial}}
      <div class="error">{{this}}</div>
      {{endfor error_invClvSerial}}
      {{endif error_invClvSerial}}
    </fieldset>

    <fieldset>
      <label for="invClvExp">invClvExp</label>
      <input {{if readonly}} readonly {{endif readonly}} type="text" id="invClvExp" name="invClvExp" placeholder="invClvExp" value="{{invClvExp}}" />
      {{if error_invClvExp}}
      {{foreach error_invClvExp}}
      <div class="error">{{this}}</div>
      {{endfor error_invClvExp}}
      {{endif error_invClvExp}}
    </fieldset>

    <fieldset>
      <label for="invClvEst">Estado</label>
      <select name="invClvEst" id="invClvEst" {{if readonly}} readonly disabled {{endif readonly}}>
        {{foreach invClvEstArr}}
        <option value="{{value}}" {{selected}}>{{text}}</option>
        {{endfor invClvEstArr}}
      </select>
    </fieldset>

    <fieldset>
      {{if showBtn}}
      <button type="submit" name="btnEnviar">{{btnEnviarText}}</button>
      &nbsp;
      {{endif showBtn}}
      <button name="btnCancelar" id="btnCancelar">Cancelar</button>
    </fieldset>
  </form>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function(){ document.getElementById("btnCancelar").addEventListener("click", function(e){ e.preventDefault(); e.stopPropagation();
  window.location.href = "index.php?page=mnt_ClavesDetalles"; }); });
</script>