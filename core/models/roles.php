<?php 
 class roles extends Validator{
    private $idRol = null;
	private $nombre_Role = null;
	private $Fecha_creacion = null;
	private $Activo = null;
	private $IdUsuario = null;
	
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->idRol = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->idRol;
	}
	public function setNombre($value)
	{
		if ($this->validateId($value)) {
			$this->nombre_Role = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->nombre_Role;
	}
	public function setFecha($value)
	{
		if ($this->validateId($value)) {
			$this->Fecha_creacion = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getFecha()
	{
		return $this->Fecha_creacion;
	}
	public function setActivo($value)
	{
		if ($this->validateId($value)) {
			$this->Activo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getActivo()
	{
		return $this->Activo;
	}
	public function setUsuario($value)
	{
		if ($this->validateId($value)) {
			$this->IdUsuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getUsuario()
	{
		return $this->Activo;
	}


	public function readVistas()
	{
		$sql = 'SELECT d.* FROM `roles` a inner join usuariorole b on a.Idrole=b.IdRol inner join vistaroles c on a.idRole=c.IdRole inner join vistas d on c.IdVista=d.IdVista where b.IdUsuario=?';
		$params = array($this->IdUsuario);
		return Database::getRows($sql, $params);
	}
	public function ValidarContrasena()
	{
		$sql = 'SELECT DATEDIFF(FechaVencimiento,current_date) from usuarios WHERE IdUsuario=? ';
		$params = array($this->IdUsuario);
		return Database::getRows($sql, $params);
	}
	
	
}

?>