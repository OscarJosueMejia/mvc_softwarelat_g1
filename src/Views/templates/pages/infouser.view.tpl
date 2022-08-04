<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center">
            {{with login}}
            <input type="hidden" id="isLogeado" value="true">
            <div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/OOjs_UI_icon_userAvatar.svg/2048px-OOjs_UI_icon_userAvatar.svg.png"
                    height="100" width="100" />
            </div>
            <span class="name mt-3">Nombre: {{userName}}</span>
            <span class="name mt-3">Correo: {{userEmail}}</span>
            <br>    
            <div style="text-align: center;" class="reg-login">
                <a href="index.php?page=sec_passwordchange">Cambiar contraseña</a>
            </div>
            {{endwith login}}
        </div>
    </div>
</div>
