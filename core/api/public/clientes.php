<?php
require_once('../../core/helpers/database.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/clientes.php');


//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $cliente = new clientes;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idcliente']) && $_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    header('location: ../../views/dashboard/');
                } else {
                    header('location: ../../views/dashboard/main.php');
                }
                break;
            case 'readProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'editProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($cliente->getcliente()) {
                        $_POST = $cliente->validateForm($_POST);
                        if ($cliente->setNombres($_POST['profile_nombres'])) {
                            if ($cliente->setApellidos($_POST['profile_apellidos'])) {
                                if ($cliente->setCorreo($_POST['profile_correo'])) {
                                    if ($cliente->setAlias($_POST['profile_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $_SESSION['aliascliente'] = $_POST['profile_alias'];
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'password':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST['clave_actual_1'] == $_POST['clave_actual_2']) {
                        if ($cliente->setClave($_POST['clave_actual_1'])) {
                            if ($cliente->checkPassword()) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($cliente->setClave($_POST['clave_nueva_1'])) {
                                        if ($cliente->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'read':
                if ($result['dataset'] = $cliente->readclientes()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay clientes registrados';
                }
                break;
            case 'search':
                $_POST = $cliente->validateForm($_POST);
                if ($_POST['busqueda'] != '') {
                    if ($result['dataset'] = $cliente->searchclientes($_POST['busqueda'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['create_nombres'])) {
                    if ($cliente->setApellidos($_POST['create_apellidos'])) {
                        if ($cliente->setCorreo($_POST['create_correo'])) {
                            if ($cliente->setAlias($_POST['create_alias'])) {
                                if ($_POST['create_clave1'] == $_POST['create_clave2']) {
                                    if ($cliente->setClave($_POST['create_clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'get':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'update':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($cliente->getcliente()) {
                        if ($cliente->setNombres($_POST['update_nombres'])) {
                            if ($cliente->setApellidos($_POST['update_apellidos'])) {
                                if ($cliente->setCorreo($_POST['update_correo'])) {
                                    if ($cliente->setAlias($_POST['update_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'delete':
                if ($_POST['id_cliente'] != $_SESSION['idcliente']) {
                    if ($cliente->setId($_POST['id_cliente'])) {
                        if ($cliente->getcliente()) {
                            if ($cliente->deletecliente()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'cliente incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else if ($_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'read':
                if ($cliente->readclientes()) {
                    $result['status'] = 1;
                    $result['exception'] = 'Existe al menos un cliente registrado';
                } else {
                    $result['status'] = 2;
                    $result['exception'] = 'No existen clientes registrados';
                }
                break;
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['nombres'])) {
                    if ($cliente->setApellidos($_POST['apellidos'])) {
                        if ($cliente->setCorreo($_POST['correo'])) {
                            if ($cliente->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($cliente->setClave($_POST['clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'login':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setAlias($_POST['alias'])) {
                    if ($cliente->checkAlias()) {
                        if ($cliente->setClave($_POST['clave'])) {
                            if ($cliente->checkPassword()) {
                                $_SESSION['idcliente'] = $cliente->getId();
                                $_SESSION['aliascliente'] = $cliente->getAlias();
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Clave inexistente';
                            }
                        } else {
                            $result['exception'] = 'Clave menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Alias inexistente';
                    }
                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $cliente = new clientes;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idcliente']) && $_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    header('location: ../../views/dashboard/');
                } else {
                    header('location: ../../views/dashboard/main.php');
                }
                break;
            case 'readProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'editProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($cliente->getcliente()) {
                        $_POST = $cliente->validateForm($_POST);
                        if ($cliente->setNombres($_POST['profile_nombres'])) {
                            if ($cliente->setApellidos($_POST['profile_apellidos'])) {
                                if ($cliente->setCorreo($_POST['profile_correo'])) {
                                    if ($cliente->setAlias($_POST['profile_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $_SESSION['aliascliente'] = $_POST['profile_alias'];
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'password':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST['clave_actual_1'] == $_POST['clave_actual_2']) {
                        if ($cliente->setClave($_POST['clave_actual_1'])) {
                            if ($cliente->checkPassword()) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($cliente->setClave($_POST['clave_nueva_1'])) {
                                        if ($cliente->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'read':
                if ($result['dataset'] = $cliente->readclientes()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay clientes registrados';
                }
                break;
            case 'search':
                $_POST = $cliente->validateForm($_POST);
                if ($_POST['busqueda'] != '') {
                    if ($result['dataset'] = $cliente->searchclientes($_POST['busqueda'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['create_nombres'])) {
                    if ($cliente->setApellidos($_POST['create_apellidos'])) {
                        if ($cliente->setCorreo($_POST['create_correo'])) {
                            if ($cliente->setAlias($_POST['create_alias'])) {
                                if ($_POST['create_clave1'] == $_POST['create_clave2']) {
                                    if ($cliente->setClave($_POST['create_clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'get':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'update':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($cliente->getcliente()) {
                        if ($cliente->setNombres($_POST['update_nombres'])) {
                            if ($cliente->setApellidos($_POST['update_apellidos'])) {
                                if ($cliente->setCorreo($_POST['update_correo'])) {
                                    if ($cliente->setAlias($_POST['update_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'delete':
                if ($_POST['id_cliente'] != $_SESSION['idcliente']) {
                    if ($cliente->setId($_POST['id_cliente'])) {
                        if ($cliente->getcliente()) {
                            if ($cliente->deletecliente()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'cliente incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else if ($_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'read':
                if ($cliente->readclientes()) {
                    $result['status'] = 1;
                    $result['exception'] = 'Existe al menos un cliente registrado';
                } else {
                    $result['status'] = 2;
                    $result['exception'] = 'No existen clientes registrados';
                }
                break;
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['nombres'])) {
                    if ($cliente->setApellidos($_POST['apellidos'])) {
                        if ($cliente->setCorreo($_POST['correo'])) {
                            if ($cliente->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($cliente->setClave($_POST['clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'login':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setAlias($_POST['alias'])) {
                    if ($cliente->checkAlias()) {
                        if ($cliente->setClave($_POST['clave'])) {
                            if ($cliente->checkPassword()) {
                                $_SESSION['idcliente'] = $cliente->getId();
                                $_SESSION['aliascliente'] = $cliente->getAlias();
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Clave inexistente';
                            }
                        } else {
                            $result['exception'] = 'Clave menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Alias inexistente';
                    }
                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['site']) && isset($_GET['action'])) {
    session_start();
    $cliente = new clientes;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idcliente']) && $_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'logout':
                if (session_destroy()) {
                    header('location: ../../views/dashboard/');
                } else {
                    header('location: ../../views/dashboard/main.php');
                }
                break;
            case 'readProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'editProfile':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    if ($cliente->getcliente()) {
                        $_POST = $cliente->validateForm($_POST);
                        if ($cliente->setNombres($_POST['profile_nombres'])) {
                            if ($cliente->setApellidos($_POST['profile_apellidos'])) {
                                if ($cliente->setCorreo($_POST['profile_correo'])) {
                                    if ($cliente->setAlias($_POST['profile_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $_SESSION['aliascliente'] = $_POST['profile_alias'];
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'password':
                if ($cliente->setId($_SESSION['idcliente'])) {
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST['clave_actual_1'] == $_POST['clave_actual_2']) {
                        if ($cliente->setClave($_POST['clave_actual_1'])) {
                            if ($cliente->checkPassword()) {
                                if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                    if ($cliente->setClave($_POST['clave_nueva_1'])) {
                                        if ($cliente->changePassword()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave nueva menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves nuevas diferentes';
                                }
                            } else {
                                $result['exception'] = 'Clave actual incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Clave actual menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Claves actuales diferentes';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'read':
                if ($result['dataset'] = $cliente->readclientes()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay clientes registrados';
                }
                break;
            case 'search':
                $_POST = $cliente->validateForm($_POST);
                if ($_POST['busqueda'] != '') {
                    if ($result['dataset'] = $cliente->searchclientes($_POST['busqueda'])) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'No hay coincidencias';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
            case 'create':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['create_nombres'])) {
                    if ($cliente->setApellidos($_POST['create_apellidos'])) {
                        if ($cliente->setCorreo($_POST['create_correo'])) {
                            if ($cliente->setAlias($_POST['create_alias'])) {
                                if ($_POST['create_clave1'] == $_POST['create_clave2']) {
                                    if ($cliente->setClave($_POST['create_clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'get':
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($result['dataset'] = $cliente->getcliente()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'update':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setId($_POST['id_cliente'])) {
                    if ($cliente->getcliente()) {
                        if ($cliente->setNombres($_POST['update_nombres'])) {
                            if ($cliente->setApellidos($_POST['update_apellidos'])) {
                                if ($cliente->setCorreo($_POST['update_correo'])) {
                                    if ($cliente->setAlias($_POST['update_alias'])) {
                                        if ($cliente->updatecliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Alias incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    } else {
                        $result['exception'] = 'cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'cliente incorrecto';
                }
                break;
            case 'delete':
                if ($_POST['id_cliente'] != $_SESSION['idcliente']) {
                    if ($cliente->setId($_POST['id_cliente'])) {
                        if ($cliente->getcliente()) {
                            if ($cliente->deletecliente()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'cliente incorrecto';
                    }
                } else {
                    $result['exception'] = 'No se puede eliminar a sí mismo';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else if ($_GET['site'] == 'dashboard') {
        switch ($_GET['action']) {
            case 'read':
                if ($cliente->readclientes()) {
                    $result['status'] = 1;
                    $result['exception'] = 'Existe al menos un cliente registrado';
                } else {
                    $result['status'] = 2;
                    $result['exception'] = 'No existen clientes registrados';
                }
                break;
            case 'register':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setNombres($_POST['nombres'])) {
                    if ($cliente->setApellidos($_POST['apellidos'])) {
                        if ($cliente->setCorreo($_POST['correo'])) {
                            if ($cliente->setAlias($_POST['alias'])) {
                                if ($_POST['clave1'] == $_POST['clave2']) {
                                    if ($cliente->setClave($_POST['clave1'])) {
                                        if ($cliente->createcliente()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                    } else {
                                        $result['exception'] = 'Clave menor a 6 caracteres';
                                    }
                                } else {
                                    $result['exception'] = 'Claves diferentes';
                                }
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Correo incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Apellidos incorrectos';
                    }
                } else {
                    $result['exception'] = 'Nombres incorrectos';
                }
                break;
            case 'login':
                $_POST = $cliente->validateForm($_POST);
                if ($cliente->setAlias($_POST['alias'])) {
                    if ($cliente->checkAlias()) {
                        if ($cliente->setClave($_POST['clave'])) {
                            if ($cliente->checkPassword()) {
                                $_SESSION['idcliente'] = $cliente->getId();
                                $_SESSION['aliascliente'] = $cliente->getAlias();
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Clave inexistente';
                            }
                        } else {
                            $result['exception'] = 'Clave menor a 6 caracteres';
                        }
                    } else {
                        $result['exception'] = 'Alias inexistente';
                    }
                } else {
                    $result['exception'] = 'Alias incorrecto';
                }
                break;
            default:
                exit('Acción no disponible');
        }
    } else {
        exit('Acceso no disponible');
    }
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>