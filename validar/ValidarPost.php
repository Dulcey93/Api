<?php


class ValidarPost {
     
    private $clase;
    protected $observada;
    private $numParameters;
    private $objeto;

    public function __construct($clase, $objeto)
    {
        $this->clase = $clase;
        $this->observada = new ReflectionClass($this->clase);
        $constructor = $this->observada->getConstructor();
        $this->numParameters = $constructor->getNumberOfParameters();
        $this->objeto = $objeto;
    }


    /* 
        estoy tratando de hacer una clase para validar los objetos que envian por post
        revisar modulo api 
    */ 


    public function validarEntradas()
    {
        return $this->objeto;
    }




}