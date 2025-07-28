<?php 
class database{
	private $host="localhost";
	private $username="root";
	private $password="";
	private $database="sairauma_dr_imran";
	protected $conn;
	    
    public function __construct()
    {
        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
             mysqli_query( $this->conn , "SET SESSION sql_mode = ''");
           
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
        return $this->conn;
    }
}
?>