<?php


require_once('../../core/helpers/dashboard.php');
require_once('../../core/helpers/database.php');
Dashboard::headerTemplate('Contraseña a caducado');
?>
<div class="container">
    <div class="row">
        <form method="post" id="form-sesion">
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">person_pin</i>
                <input id="alias" type="text" name="alias" class="validate" required />
                <label for="alias">Usuario</label>
            </div>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">security</i>
                <input id="antigua" type="password" name="antigua" class="validate" required/>
                <label for="antigua">Contraseña antigua</label>
            </div>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">security</i>
                <input id="nuevaclave" type="password" name="nuevaclave" class="validate" required/>
                <label for="nuevaclave">Nueva contraseña</label>
            </div>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">security</i>
                <input id="confirmarclave" type="password" name="confirmarclave" class="validate" required/>
                <label for="confirmarclave">Confirmar contraseña</label>
            </div>
            <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect pink accent-1 tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
            </div>
        </form>
    </div>
</div>
<?php
Dashboard::footerTemplate('index.js');
?>
