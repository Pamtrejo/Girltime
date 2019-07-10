<?php
class Productos extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $descripcion = null;
	private $precio = null;
	private $imagen = null;
	private $categoria = null;
	private $estado = null;
	private $marca = null;
	private $ruta = '../../resources/img/productos/';

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

	public function setNombre($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombre = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setDescripcion($value)
	{
		if ($this->validateAlphanumeric($value, 1, 200)) {
			$this->descripcion = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function setPrecio($value)
	{
		if ($this->validateMoney($value)) {
			$this->precio = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getPrecio()
	{
		return $this->precio;
	}

	public function setImagen($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->imagen = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	public function getImagen()
	{
		return $this->imagen;
	}

	public function setCategoria($value)
	{
		if ($this->validateId($value)) {
			$this->categoria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCategoria()
	{
		return $this->categoria;
	}

	public function setEstado($value)
	{
		if ($value == '1' || $value == '0') {
			$this->estado = $value;
			return true;
		} else {
			return false;
		}
	}

	public function setMarca($value)
	{
		if ($this->validateId($value)) {
			$this->marca = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getMarca()
	{
		return $this->marca;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	

	public function getRuta()
	{
		return $this->ruta;
	}

	//Metodos para el manejo del CRUD
	public function readProductosCategoria()
	{
		$sql = 'SELECT nombre_categoria, id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto FROM productos INNER JOIN categorias USING(id_categoria) WHERE id_categoria = ? AND estado_producto = 1 ORDER BY nombre_producto';
		$params = array($this->categoria);
		return Database::getRows($sql, $params);
	}

	public function readProductos()
	{
		$sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, nombre_categoria, estado_producto,marca FROM productos INNER JOIN categorias USING(id_categoria) INNER JOIN marca USING(id_marca) ORDER BY nombre_producto';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchProductos($value)
	{
		$sql = 'SELECT id_producto, imagen_producto, nombre_producto, descripcion_producto, precio_producto, nombre_categoria, estado_producto FROM productos INNER JOIN categorias USING(id_categoria) WHERE nombre_producto LIKE ? OR descripcion_producto LIKE ? ORDER BY nombre_producto';
		$params = array("%$value%", "%$value%");
		return Database::getRows($sql, $params);
	}

	public function readCategorias()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, imagen_categoria, descripcion_categoria FROM categorias';
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function readMarcas()
	{
		$sql = 'SELECT id_marca, marca FROM marca';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function createProducto()
	{
		$sql = 'INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, imagen_producto, estado_producto, id_categoria, id_marca) VALUES(?, ?, ?, ?, ?, ?,?)';
		$params = array($this->nombre, $this->descripcion, $this->precio, $this->imagen, $this->estado, $this->categoria,$this->marca);
		return Database::executeRow($sql, $params);
	}

	public function getProducto()
	{
		$sql = 'SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, imagen_producto, id_categoria, estado_producto, id_marca FROM productos WHERE id_producto = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateProducto()
	{
		$sql = 'UPDATE productos SET nombre_producto = ?, descripcion_producto = ?, precio_producto = ?, imagen_producto = ?, estado_producto = ?, id_categoria = ?, id_marca = ? WHERE id_producto = ?';
		$params = array($this->nombre, $this->descripcion, $this->precio, $this->imagen, $this->estado, $this->categoria, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteProducto()
	{
		$sql = 'DELETE FROM productos WHERE id_producto = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}
	// Métodos para los gráficos y reportes del sistema.
	public function cantidadProductosCategoria()
	{
		$sql = 'SELECT nombre_categoria, COUNT(id_producto) cantidad FROM productos INNER JOIN categorias USING(id_categoria) GROUP BY id_categoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function ProductosporMarca()
	{
		$sql = 'SELECT marca, COUNT(id_producto) cantidad FROM productos INNER JOIN marca USING(id_marca) GROUP BY id_marca';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function MontoporCategoria()
	{
		$sql = 'SELECT SUM(venta_total) cantidad , nombre_categoria  FROM `detalle_venta` INNER JOIN (productos) USING (id_producto) INNER JOIN (categorias) USING (id_categoria) GROUP BY id_categoria';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function MontoporMarca()
	{
		$sql = 'SELECT SUM(venta_total) cantidad , marca  FROM `detalle_venta` INNER JOIN (productos) USING (id_producto) INNER JOIN (marca) USING (id_marca) GROUP BY id_marca';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function VentaporFecha()
	{
		$sql = 'SELECT COUNT(`id_venta`) cantidad, `fecha` FROM venta GROUP BY day(fecha) LIMIT 3';
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	
}
?>
