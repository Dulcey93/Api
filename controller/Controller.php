<?php

class Controller {

    // atributo de coneccion de la clase
    private $connection;
    protected $endpoint;

    public function __construct(){  
        $this->connection = new Conexion('http://localhost:4000');
        $this->endpoint = '/users';
    }

    // funcion que me permite obtener todos los registros 
    public function getAll()
    {
        $response = $this->connection->sendRequestGetAll($this->endpoint);
        if ($response) {
            return $response;
        }
        unset($this->connection);
    }

    // funcion para obtener un usuario por id 
    public function getUserById($id)
    {
        $response = $this->connection->sendRequestGetById($this->endpoint,$id);
        if ($response) {
            return $response;
        }
        unset($this->connection);
    }

    // funcion que me permite agregar un registro 
    public function addUser($user)
    {
        $response = $this->connection->sendRequestPost($this->endpoint,$user);
        if ($response) {
            return  json_encode([
                'message' => 'Usuario Creado',
                'data' => $user
            ],JSON_PRETTY_PRINT);
        }else{
            return json_encode(['message' => 'Fallo la creacion del Usuario'],JSON_PRETTY_PRINT);
        }
        unset($this->connection);
    }


    

}