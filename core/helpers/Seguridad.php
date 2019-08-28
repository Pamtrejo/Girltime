<?php
class Seguridad
{
	
	
	public function validarUsuarioVista($nombreVista)
	{
		$retorno=0;
		session_start();
		$Roles=roles;
		if (isset($_SESSION['idUsuario'])) {
			$usuario=$_SESSION['idUsuario'];
			$Roles->setUsuario($usuario);
			$cadena=$Roles->readVistas();
			if(array_key_exists($nombreVista, $cadena)){
				$retorno=1;
			}
		}
		return $retorno;
	}
	
?>
