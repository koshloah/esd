<?php

class User {
    // property declaration
    public $firstName;
    public $lastName;
    public $email;
    public $phone;    
    public $password;
    public $role;
    
    public function __construct($firstName='', $lastName='', $email='', $phone='',$password='', $role='') {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->role = $role;
    }
    
    public function authenticate($enteredPwd) {
        return password_verify ($enteredPwd, $this->password);
    }
}

?>