<?php


class User {

    private $name;
    private $age;
    private $email;
    protected $password;
    

    public function __construct($name,$age,$email, $password)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->password = $password;
    }


    public function getPass(){
        return $this->password;
    }


    public function getUser()
    {
        return [
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email,
            'password' => $this->password
        ];
    }




    



}