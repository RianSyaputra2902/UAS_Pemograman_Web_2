<?php
/**
 
 */
class Database{
    private $dbname = 'sql310.epizy.com';
    private $dbuser = 'epiz_32027674';
    private $dbpwd = '';
    private $dbhost = 'epiz_32027674_data_kendaraan';
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