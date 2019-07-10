<?php
class Commerce
{
	public static function headerTemplate($title)
	{
		ini_set('date.timezone', 'America/El_Salvador');
		print('
			<!DOCTYPE html>
			<html lang="es">
			<head>
				<meta charset="utf-8">
				<title>Girltime - '.$title.'</title>
				<link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
				<link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css"/>
				<link type="text/css" rel="stylesheet" href="../../resources/css/icons.css"/>
				<link type="text/css" rel="stylesheet" href="../../resources/css/commerce.css"/>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body class="pink lighten-5">
				<header>
					<div class="navbar-fixed">
						<nav class="pink lighten-5">
							<div class="nav-wrapper">
								<a href="index.php" class="brand-logo"><img src="../../resources/img/logo.png" height="60"></a>
								<a href="#" data-target="mobile" class="sidenav-trigger black-text text-darken-2"><i class="material-icons">menu</i></a>
								<ul class="right hide-on-med-and-down">
									<li><a href="index.php" class="black-text text-darken-2 letra"><i class="material-icons left">view_module</i>Catálogo</a></li>
									<li><a href="carrito.php" class="black-text text-darken-2 letra"><i class="material-icons left">shopping_cart</i>Mi carrito</a></li>
									<li><a href="acceder.php" class="black-text text-darken-2 letra"><i class="material-icons left">contacts</i>Acceder</a></li>
								</ul>
							</div>
						</nav>
					</div>
					<ul class="sidenav" id="mobile">
						<li><a href="index.php"><i class="material-icons left">view_module</i>Catálogo</a></li>
						<li><a href="#"><i class="material-icons left">shopping_cart</i>Compras</a></li>
						<li><a href="acceder.php"><i class="material-icons left">person</i>Acceder</a></li>
					</ul>
				</header>
				<main>
		');
		self::modals();
	}

	public static function footerTemplate($controller)
	{
		print('
				</main>
				<footer class="page-footer pink lighten-3">
					<div class="container">
						<div class="row">
							<div class="col s12 m6 l6">
								<h5 class="white-text">Nosotros</h5>
								<p>
									<blockquote><a href="#mision" class="modal-trigger white-text"><b>Misión</b></a> | <a href="#vision" class="modal-trigger white-text"><b>Visión</b></a> | <a href="#valores" class="modal-trigger white-text"><b>Valores</b></a></blockquote>
									<blockquote><a href="#terminos" class="modal-trigger white-text"><b>Términos y condiciones</b></a></blockquote>
								</p>
							</div>
							<div class="col s12 m6 l6">
								<h5 class="white-text">Contáctanos</h5>
								<p>
									<blockquote><a class="white-text" href="https://www.facebook.com/" target="_blank"><b>facebook</b></a> | <a class="white-text" href="https://twitter.com/" target="_blank"><b>twitter</b></a></blockquote>
									<blockquote><a class="white-text" href="https://www.instagram.com/" target="_blank"><b>instagram</b></a> | <a class="white-text" href="https://www.youtube.com/" target="_blank"><b>youtube</b></a></blockquote>
								</p>
							</div>
						</div>
					</div>
					<div class="footer-copyright">
						<div class="container">
							<span>© Girltime, todos los derechos reservados.</span>
							<span class="grey-text text-lighten-4 right">Diseñado con <a class="red-text text-accent-1" href="http://materializecss.com/" target="_blank"><b>Materialize</b></a></span>
						</div>
					</div>
				</footer>
				<script type="text/javascript" src="../../libraries/jquery-3.2.1.min.js"></script>
				<script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
				<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
				<script type="text/javascript" src="../../resources/js/commerce.js"></script>
				<script type="text/javascript" src="../../core/helpers/functions.js"></script>
				<script type="text/javascript" src="../../resources/js/Chart.js"></script>
				<script type="text/javascript" src="../../core/controllers/public/'.$controller.'"></script>
			</body>
			</html>
		');
	}

	public static function modals()
	{
		print('
			<!-- Términos y condiciones -->
			<div id="terminos" class="modal">
				<div class="modal-content">
					<h4 class="center-align">TÉRMINOS Y CONDICIONES</h4>
					<p>Nuestra empresa ofrece los mejores productos a nivel nacional con una calidad garantizada y...</p>
				</div>
				<div class="divider"></div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
				</div>
			</div>

			<!-- Misión -->
			<div id="mision" class="modal">
				<div class="modal-content">
					<h4 class="center-align">MISIÓN</h4>
					<p>Ofrecer los mejores productos a nivel nacional para satisfacer a nuestros clientes y...</p>
				</div>
				<div class="divider"></div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
				</div>
			</div>

			<!-- Visión -->
			<div id="vision" class="modal">
				<div class="modal-content">
					<h4 class="center-align">VISIÓN</h4>
					<p>Ser la empresa lider en la región ofreciendo productos de calidad a precios accesibles y...</p>
				</div>
				<div class="divider"></div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
				</div>
			</div>

			<!-- Valores -->
			<div id="valores" class="modal">
				<div class="modal-content center-align">
					<h4>VALORES</h4>
					<p>Responsabilidad</p>
					<p>Honestidad</p>
					<p>Seguridad</p>
					<p>Calidad</p>
				</div>
				<div class="divider"></div>
				<div class="modal-footer">
					<a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
				</div>
			</div>
		');
	}
}
?>
