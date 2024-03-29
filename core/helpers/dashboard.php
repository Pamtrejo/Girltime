<?php
class Dashboard
{
	public static function headerTemplate($title)
	{
		require_once('../../core/helpers/database.php');
		require_once('../../core/helpers/validator.php');
		require_once('../../core/models/usuarios.php');
		session_start();
		ini_set('date.timezone', 'America/El_Salvador');
		print('
			<!DOCTYPE html>
			<html lang="es">
				<head>
					<meta charset="utf-8">
					<title>Dashboard - '.$title.'</title>
					<link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
					<link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css"/>
					<link type="text/css" rel="stylesheet" href="../../resources/css/icons.css"/>
					<link type="text/css" rel="stylesheet" href="../../resources/css/dashboard.css"/>
					<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				</head>
				<body>
		');
		if (isset($_SESSION['idUsuario'])) {
			$filename = basename($_SERVER['PHP_SELF']);
			$crud = new Usuarios();
			$atributo = $crud->getAtributos($_SESSION['idUsuario']);
			$dato = $atributo['atributos'];

			//echo $dato{0};
			if ($filename != 'index.php') {
				self::modals();
				print('
					<header>
						<div class="navbar-fixed">
							<nav class="pink lighten-5">
								<div class="nav-wrapper">
									<a href="main.php" class="brand-logo"><img src="../../resources/img/logo.png" height="60"></a>
									<a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
									<ul class="right hide-on-med-and-down">');
										if ($dato{0} == 1) {
											print('<li><a href="productos.php" class="black-text text-darken-2 letra">Productos</a></li>');
										}
										if ($dato{1} == 1) {
											print('<li><a href="categorias.php" class="black-text text-darken-2 letra">Categorías</a></li>');
										}
										if ($dato{2} == 1) {
											print('<li><a href="usuarios.php" class="black-text text-darken-2 letra">Usuarios</a></li>');
										}
										
										
				print('<li><a href="#" class="dropdown-trigger black-text text-darken-2 letra" data-target="dropdown"><i class="material-icons left">assignment_ind</i>Cuenta: <b>'.$_SESSION['aliasUsuario'].'</b></a></li>
									</ul>
									<ul id="dropdown" class="dropdown-content">
										<li><a href="#" onclick="modalProfile()" class="pink-text"><i class="material-icons ">face</i>Editar perfil</a></li>
										<li><a href="#modal-password" class="modal-trigger pink-text"><i class="material-icons">lock</i>Cambiar clave</a></li>
										<li><a href="#" onclick="signOff()" class="pink-text"><i class="material-icons">clear</i>Salir</a></li>
									</ul>
								</div>
							</nav>
						</div>
						<ul class="sidenav" id="mobile">');
						if ($dato{0} == 1) {
							print('<li><a href="productos.php"><i class="material-icons">shop</i>Productos</a></li>');
						}
						if ($dato{1} == 1) {
							print('<li><a href="categorias.php"><i class="material-icons">shop_two</i>Categorías</a></li>');
						}
						if ($dato{2} == 1) {
							print('<li><a href="usuarios.php"><i class="material-icons">group</i>Usuarios</a></li>');
						}
							
							
							
							print('<li><a class="dropdown-trigger" href="#" data-target="dropdown-mobile"><i class="material-icons">verified_user</i>Cuenta: <b>'.$_SESSION['aliasUsuario'].'</b></a></li>
						</ul>
						<ul id="dropdown-mobile" class="dropdown-content">
							<li><a href="#" onclick="modalProfile()">Editar perfil</a></li>
							<li><a href="#modal-password" class="modal-trigger">Cambiar clave</a></li>
							<li><a href="#" onclick="signOff()">Salir</a></li>
						</ul>
					</header>
					<main class="container">
						<h3 class="center-align">'.$title.'</h3>
				');
			} else {
				header('location: main.php');
			}
		} else {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php' && $filename != 'register.php') {
				header('location: index.php');
			} else {
				print('
					<header>
						<div class="navbar-fixed">
							<nav class="white">
								<div class="nav-wrapper">
									<a href="index.php" class="brand-logo black-text text-darken-2"><i class="material-icons">dashboard</i></a>
								</div>
							</nav>
						</div>
					</header>
					<main class="container">
						<h3 class="center-align">'.$title.'</h3>
				');
			}
		}
	}

	public static function footerTemplate($controller)
	{
		print('
					</main>
					<footer class="page-footer pink lighten-3">
						<div class="container">
							<div class="row">
								<div class="col s12 m6 l6">
									<h5 class="black-text">Dashboard</h5>
									<a class="black-text" href="mailto:panayelyaguilar@gmail.com"><i class="material-icons left">email</i>Ayuda</a>
								</div>
								<div class="col s12 m6 l6">
									<h5 class="black-text">Enlaces</h5>
									<a class="black-text" href="http://localhost/phpmyadmin/" target="_blank"><i class="material-icons left">cloud</i>phpMyAdmin</a>
								</div>
							</div>
						</div>
						<div class="footer-copyright ">
							<div class="container">
								<span class="black-text">© Girltime, todos los derechos reservados.</span>
								<span class="black-text right">Diseñado con <a class="red-text text-accent-1" href="http://materializecss.com/" target="_blank"><b>Materialize</b></a></span>
							</div>
						</div>
					</footer>
					<script type="text/javascript" src="../../libraries/jquery-3.2.1.min.js"></script>
					<script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
					<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
					<script type="text/javascript" src="../../resources/js/dashboard.js"></script>
					<script type="text/javascript" src="../../core/helpers/functions.js"></script>
					<script type="text/javascript" src="../../core/controllers/dashboard/account.js"></script>
					<script type="text/javascript" src="../../core/controllers/dashboard/'.$controller.'"></script>
				</body>
			</html>
		');
	}

	private function modals()
	{
		print('
			<div id="modal-profile" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Editar perfil</h4>
					<form method="post" id="form-profile">
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person</i>
								<input id="profile_nombres" type="text" name="profile_nombres" class="validate" required/>
								<label for="profile_nombres">Nombres</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person</i>
								<input id="profile_apellidos" type="text" name="profile_apellidos" class="validate" required/>
								<label for="profile_apellidos">Apellidos</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">email</i>
								<input id="profile_correo" type="email" name="profile_correo" class="validate" required/>
								<label for="profile_correo">Correo</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person_pin</i>
								<input id="profile_alias" type="text" name="profile_alias" class="validate" required/>
								<label for="profile_alias">Alias</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>
			<div id="modal-password" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Cambiar contraseña</h4>
					<form method="post" id="form-password">
						<div class="row center-align">
							<label>CLAVE ACTUAL</label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_actual_1" type="password" name="clave_actual_1" class="validate" required/>
								<label for="clave_actual_1">Clave</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_actual_2" type="password" name="clave_actual_2" class="validate" required/>
								<label for="clave_actual_2">Confirmar clave</label>
							</div>
						</div>
						<div class="row center-align">
							<label>CLAVE NUEVA</label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
								<label for="clave_nueva_1">Clave</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
								<label for="clave_nueva_2">Confirmar clave</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Cambiar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>
		');
	}
}
?>
