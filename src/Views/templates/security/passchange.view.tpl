<section class="fullCenter">
    <form class="grid" method="post" action="index.php?page=sec_passwordrecovery">
        <input type="hidden" id="intStep" name="intStep" value="2">
        <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
            <h1 class="col-12">Cambiar Contraseña</h1>
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
                <label class="col-12 col-m-4 flex align-center" for="txtPswdTemp">Contraseña Temporal</label>
                <div class="col-12 col-m-8">
                    <input class="width-full" type="password" id="txtPswdTemp" name="txtPswdTemp"
                        value="{{txtPswdTemp}}" />
                </div>

                {{if errorPswdTemp}}
                <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswdTemp}}</div>
                {{endif errorPswdTemp}}
            </div>

            <div class="row">
                <label class="col-12 col-m-4 flex align-center" for="txtPswdNew">Contraseña Nueva</label>
                <div class="col-12 col-m-8">
                    <input class="width-full" type="password" id="txtPswdNew" name="txtPswdNew"
                        value="{{txtPswdNew}}" />
                </div>

                {{if errorPswdNew}}
                <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswdTemp}}</div>
                {{endif errorPswdNew}}
            </div>


            {{if generalError}}
            <div class="row">
                {{generalError}}
            </div>
            {{endif generalError}}
            <div class="row right flex-end px-4">
                <button class="primary" id="btnLogin" type="submit">Cambiar Contraseña</button>
            </div>
        </section>
    </form>
</section>