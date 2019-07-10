<?php
class clientes extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $nombres = null;
	private $apellidos = null;
	private $correo = null;
	private $clave = null;

	//Métodos para sobrecarga de propiedades
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNombres($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->nombres = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombres()
	{
		return $this->nombres;
	}

	public function setApellidos($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->apellidos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getApellidos()
	{
		return $this->apellidos;
	}

	public function setCorreo($value)
	{
		if ($this->validateEmail($value)) {
			$this->correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->correo;
	}

	public function setClave($value)
	{
		if ($this->validatePassword($value)) {
			$this->clave = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getClave()
	{
		return $this->clave;
	}

	//Métodos para manejar la sesión del cliente
	public function checkCorreo()
	{
		$sql = 'SELECT id_cliente FROM cliente WHERE correo_cliente';
		$params = array($this->correo);
		$data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['id_cliente'];
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword()
	{
		$sql = 'SELECT clave_cliente FROM cliente WHERE id_cliente = ?';
		$params = array($this->id);
		$data = Database::getRow($sql, $params);
		if (password_verify($this->clave, $data['clave_cliente'])) {
			return true;
		} else {
			return false;
		}
	}

	public function changePassword()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'UPDATE cliente SET clave_cliente = ? WHERE id_cliente = ?';
		$params = array($hash, $this->id);
		return Database::executeRow($sql, $params);
	}

	//Metodos para manejar el CRUD
	public function readClientes()
	{
		$sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente FROM cliente ORDER BY apellidos_cliente';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchClientes($value)
	{
		$sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente, alias_cliente FROM cliente WHERE apellidos_cliente LIKE ? OR nombres_cliente LIKE ? ORDER BY apellidos_cliente';
		$params = array("%$value%", "%$value%");
		return Database::getRows($sql, $params);
	}

	public function createCliente()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO cliente(nombres_cliente, apellidos_cliente, correo_cliente, clave_cliente) VALUES(?, ?, ?, ?)';
		$params = array($this->nombres, $this->apellidos, $this->correo, $hash);
		return Database::executeRow($sql, $params);
	}

	public function getCliente()
	{
		$sql = 'SELECT id_cliente, nombres_cliente, apellidos_cliente, correo_cliente FROM cliente WHERE id_cliente = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateCliente()
	{
		$sql = 'UPDATE cliente SET nombres_cliente = ?, apellidos_cliente = ?, correo_cliente = ? WHERE id_cliente = ?';
		$params = array($this->nombres, $this->apellidos, $this->correo, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteCliente()
	{
		$sql = 'DELETE FROM cliente WHERE id_cliente = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}
}
?>
