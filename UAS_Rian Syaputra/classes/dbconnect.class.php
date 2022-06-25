<?php
/**
 
 */
class Database{
    private $dbname = 'kendaraan';
    private $dbuser = 'root';
    private $dbpwd = '';
    private $dbhost = 'localhost';
    public $conn;

    public function connectDB(){
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname,$this->dbuser,$this->dbpwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                }
        catch (PDOException $exception){
            echo "Error Koneksi: ".$exception->getMessage();
        }
        return $this->conn;
    }

}
?>