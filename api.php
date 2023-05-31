<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $_METHOD = $_SERVER['REQUEST_METHOD'];
    $datos = file_get_contents('php://input'); 


    function autoload($class){
        $dirs = [ 
            'conexion',
            'controller',
            'model',
            'validar'
        ];
        foreach ($dirs as $dir) {
            $flie = dirname(__FILE__) . '/'.$dir.'/' . $class . '.php';
            if (file_exists($flie)) {
                require $flie;
                return  dirname($flie);
            }
        }
    }

    spl_autoload_register('autoload'); 

    $control = new Controller();
   


    switch ($_METHOD) {
        case 'GET':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                echo $control->getUserById($id);
            }else{
                echo $control->getAll();
            }
            break;

        case 'POST':

            
            // datos para validar la correcta construccion de la clase user
            $observClass = new ReflectionClass('User'); // obtengo info sobre la clase
            $constructor = $observClass->getConstructor(); // obtengo el constructos
            $numPrameters = $constructor->getNumberOfParameters(); // obtengo la cantidad de parametros
         
            // datos que llegan del post
            $userObj = json_decode($datos); //convierto en objeto los datos del input
            $obj = get_object_vars($userObj);  // asigno las datos del input a un objeto

            $keysInput = array_keys((array) $obj); // llaves del input
            $valuesInput = array_values((array) $obj); // valores del input
            $cantidadKeys = count($keysInput); // cantidad de llaves del objeto input

            if ($numPrameters === $cantidadKeys) {
                $filterValues = array_filter($valuesInput, function($value){
                    return !is_null($value) && $value !== '';
                });

                if (count($keysInput) === count($filterValues)) {
                    $user = new User(...$obj);

                   

                    echo $validar->validarEntradas();

                    //echo $control->addUser($user->getUser());
                }else{
                    echo "el objeto tiene todas las llaves, pero hay llaves sin valores";
                }
            }else{
                echo "el objeto no tiene todos los campos necesarios";
            }
            break;
        default:
            # code...
            break;
    }

    //
    


    







    
