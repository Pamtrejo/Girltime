<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/sales.php');

if(isset($_GET['site']) && isset($_GET['action'])){
    session_start();
    $sales= new Sales();
    $result=array('status'=>0, 'exception'=>'');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if(isset($_SESSION['idAdmin']) && $_GET['site']=='dashboard'){
        switch ($_GET['action']){
            case 'read':
                if($result['dataset']=$sales->readVentas()){
                    $result['status']=1;
                }else{
                    $result['exception']='No hay ventas realizadas';
                }
            break;
            case 'detalle':
                if($sales->setId($_POST['idVenta'])){
                    if($result['dataset']=$sales->obtenerDetalle()){
                        $result['status']=1; 
                    }else{
                        $result['exception']='error';
                    }    
                }else{
                    $result['exception']='Venta incorrecta';
                }
            break;
            case 'search':
                $_POST = $sales->validateForm($_POST);
                if ($_POST['fecha'] != '') {
                    if ($result['dataset'] = $sales->searchVenta($_POST['fecha'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
            break;    
        }
    }else if(isset($_SESSION['idCliente']) && $_GET['site']=='public'){
        switch ($_GET['action']){
            case 'readVentasCliente':            
                if($sales->setIdCliente($_SESSION['idCliente'])){
                    if($result['dataset']=$sales->ventaCliente()){
                        $result['status']=1;
                    }else{
                        $result['exception']='No se han encontrado compras';
                    }
                }else{
                    $result['exception']='Cliente incorrecto';
                }
            break;
            case 'detalle':
            if($sales->setId($_POST['idVenta'])){
                if($result['dataset']=$sales->obtenerDetalle()){
                    $result['status']=1; 
                }else{
                    $result['exception']='error';
                }    
            }else{
                $result['exception']='Venta incorrecta';
            }
        break;
        }
      
    }else{
        exit('Acceso no disponible');
    }
    print(json_encode($result));
}else{
    exit('Recurso denegado');
}
?>