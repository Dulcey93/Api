<?php

class Conexion{

    private $baseURL;
    private $ch;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
        $this->ch = curl_init();
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER, true);
    }

    public function sendRequestGetAll($endpoint)
    {
        $url = $this->baseURL . $endpoint;  //armamos el endpoint
        curl_setopt($this->ch,CURLOPT_URL,$url);  // configura la url
        curl_setopt($this->ch,CURLOPT_HTTPGET,true); // realiza el http request
        return $this->execute();  // ejecuta y retorna el request

    }

    public function sendRequestGetById($endpoint,$id)
    {
        $url = $this->baseURL . $endpoint . '/' .$id;  // contruimos el endpoint
        curl_setopt($this->ch,CURLOPT_URL,$url); // configuramos el curl
        curl_setopt($this->ch,CURLOPT_HTTPGET,true); // enviamos por get 
        return $this->execute();    // ejecutamos y retornamos la consulta
    }

    public function sendRequestPost($endpoint,$data)
    {
        $url = $this->baseURL .$endpoint;
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_POST, true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        return $this->execute();
    }

    private function execute()
    {
        $response = curl_exec($this->ch);
        if ($response === false) {
            echo 'Error en execute: ' . curl_error($this->ch);
        }
        return $response;
    }

    
    public function __destruct()
    {
        curl_close($this->ch);
    }
}