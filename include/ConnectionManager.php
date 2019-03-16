<?php


class ConnectionManager {

   
    public function getConnection() {
        /*
        
        $config = parse_ini_file('../../private/bookstore.ini'); 

        $url  = "mysql:host={$config['servername']};dbname={$config['dbname']}";
        
        // PDO
        return new PDO($url, $config['username'], $config['password']);  
        
        */
        
        $host = "localhost";
        $username = "root";
        $password = "";  
        $dbname = "dog_application";
        $port = 3306;    

        $url  = "mysql:host={$host};dbname={$dbname}";
        
        $conn = new PDO($url, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;  
        
    }

    
}

?>