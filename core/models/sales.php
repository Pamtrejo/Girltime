<?php
class Sales extends Validator{
    //Atributos de la clase
    private $id=null;
    private $idCliente=null;
    private $fecha=null;
    private $idEstado=null;

    public function setId($value){
        if($this->validateId($value)){
            $this->id=$value;
            return true;
        }else{
            return false;
        }
    }

    public function getId(){
        return $this->id;
    }

    public function setIdCliente($value){
        if($this->validateId($value)){
            $this->idCliente=$value;
            return true;
        }else{
            return false;
        }
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setFecha($value){
        if($this->validateDate($value)){
            $this->fecha=$value;
            return true;
        }else{
            return false;
        }
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setIdEstado($value){
        if($this->validateId($value)){
            $this->idEstado=$value;
            return true;
        }else{
            return false;
        }
    }

    public function getIdEstado(){
        return $this->idEstado;
    }

    //Metodos para el manejo de SCRUD
    public function readVentas(){
        $sql='SELECT idVenta, nombre, fecha_hora, estadoventa.estado FROM cliente, estadoventa, venta WHERE cliente.idCliente=venta.idCliente AND estadoventa.idEstado=venta.idEstado ORDER by idVenta ASC';
        $params=array(null);
        return Database::getRows($sql, $params);
    }

    public function obtenerDetalle(){
        $sql='SELECT idDetalle,nombre, detalle_venta.cantidad, producto.precio,  (producto.precio * detalle_venta.cantidad) AS Total FROM detalle_venta, producto WHERE producto.idProducto= detalle_venta.idProducto AND idVenta = ?';
        $params=array($this->id);
        return Database::getRows($sql,$params);
    }

    public function searchVenta(){
        $sql='SELECT idVenta, nombre, fecha_hora, estadoventa.estado FROM cliente, estadoventa, venta WHERE cliente.idCliente=venta.idCliente AND estadoventa.idEstado=venta.idEstado AND fecha_hora = ?  ORDER by idVenta ASC';
        $params=array($this->fecha);
        return Database::getRows($sql, $params);
    }

    public function ventaCliente(){
        $sql='SELECT idVenta, nombre, fecha_hora, estadoventa.estado FROM venta, estadoventa, cliente WHERE cliente.idCliente= venta.idCliente AND estadoventa.idEstado= venta.idEstado AND venta.idCliente = ?';
        $params=array($this->idCliente);
        return Database::getRows($sql, $params);

    }
}
?>