<?php
require_once('../../core/helpers/Commerce.php');
Commerce::headerTemplate('Acceder');
?>
<!-- Formularios para acceder -->
<div class="container">
	<h4 class="center-align pink-text text-darken-2 letras">ACCEDER</h4>
	<ul class="tabs center-align pink lighten-5">
		<li class="tab"><a href="#cuenta">CREAR CUENTA</a></li>
		<li class="tab"><a href="#sesion">INICIAR SESIÓN</a></li>
	</ul>
	<!-- Formulario para crear cuenta -->
	<div id="cuenta">
		<form method="post">
			<div class="row">
				<div class="input-field col s12 m4">
					<i class="material-icons prefix ">account_box</i>
					<input id="nombres" type="text" name="nombres" class="validate">
					<label for="nombres">Nombres</label>
				</div>
				<div class="input-field col s12 m4">
					<i class="material-icons prefix ">account_box</i>
					<input id="apellidos" type="text" name="apellidos" class="validate">
					<label for="apellidos">Apellidos</label>
				</div>
				<div class="input-field col s12 m4">
					<i class="material-icons prefix ">email</i>
					<input id="correo" type="email" name="correo" class="validate">
					<label for="correo">Correo electrónico</label>
				</div>
				<div class="input-field col s12 m4">
					<i class="material-icons prefix ">security</i>
					<input id="clave1" type="password" name="clave1" class="validate">
					<label for="clave1">Contraseña</label>
				</div>
				<div class="input-field col s12 m6">
					<i class="material-icons prefix ">security</i>
					<input id="clave2" type="password" name="clave2" class="validate">
					<label for="clave2">Confirmar contraseña</label>
				</div>
				
				<label class="center-align col s12 ">
					<input id="condicion" type="checkbox" name="condicion">
					<span>Acepto <a href="#terminos" class="modal-trigger pink-text text-darken-2">términos y condiciones</a></span>
				</label>
			</div>
			<div class="row center-align">
				<div class="col s12">
					<button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Registrar"><i class="material-icons">send</i></button>
				</div>
			</div>
		</form>
	</div>
	<!-- Formulario para iniciar sesión -->
	<div id="sesion">
		<form method="post">
			<div class="row">
				<div class="input-field col s12 m6 offset-m3">
					<i class="material-icons prefix">email</i>
					<input id="usuario" type="email" name="usuario" class="validate">
					<label for="usuario">Correo electrónico</label>
				</div>
				<div class="input-field col s12 m6 offset-m3">
					<i class="material-icons prefix">security</i>
					<input id="clave" type="password" name="clave" class="validate">
					<label for="clave">Contraseña</label>
				</div>
			</div>
			<div class="row center-align">
				<button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>
			</div>
		</form>
	</div>
</div>
<!-- Efecto parallax con una altura de 300px -->
<div class="parallax-container">
	<div class="parallax">
		<img id="parallax">
	</div>
</div>
<?php
Commerce::footerTemplate('account.js');
?>
