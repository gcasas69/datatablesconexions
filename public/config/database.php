<?php
class Database{
    
    private $db_host = 'localhost';
    private $db_name = 'iferreta';
    private $db_username = 'phpmyadmin';
    private $db_password = '5gD!Qmv6';
    private $charset= "SET NAMES utf8";
    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => $this->charset));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
        
        
    }
}
?>