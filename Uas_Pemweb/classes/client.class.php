<?php
require_once 'dbconnect.class.php';
/**
 
 */
class client
{
    private $cnct;

    public function __construct()
    {
        $db = new Database;
        $connect = $db->connectDB();
        $this->cnct = $connect;
    }

    private function execReq($sql)
    {
        $stmt = $this->cnct->prepare($sql);
        return $stmt;
    }

    public function createClient($nomor_plat, $merek_kendaraan, $tipe_kendaraan, $tanggal_keluar)
    {
        try {
            $sql = "INSERT INTO perekaman(id,nomor_plat,merek_kendaraan,tipe_kendaraan,tanggal_keluar) VALUES (null,:clt_nomor_plat,:clt_merek_kendaraan,:clt_tipe_kendaraan,:clt_tanggal_keluar)";
            $result = $this->execReq($sql);
                // $result->bindparam(":clt_id", null);
            $result->bindparam(":clt_nomor_plat", $nomor_plat);
            $result->bindparam(":clt_merek_kendaraan", $merek_kendaraan);
            $result->bindparam(":clt_tipe_kendaraan", $tipe_kendaraan);
            $result->bindparam(":clt_tanggal_keluar", $tanggal_keluar);
            $result->execute();
            return $result;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function readAllClients()
    {
        try {
            $sql = 'SELECT * FROM perekaman ORDER BY nomor_plat DESC ';
            $result = $this->execReq($sql);
            $result->execute();
            return $result;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function readSpecificClient($id)
    {
        try {
            $sql = 'SELECT * FROM perekaman WHERE id = :user_id';
            $req = $this->execReq($sql);
            $req->bindparam(":user_id", $id);
            $req->execute();
            return $req;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateClient($id, $nomor_plat, $merek_kendaraan, $tipe_kendaraan, $tanggal_keluar)
    {
        try {
            $sql = 'UPDATE perekaman SET nomor_plat = :clt_nomor_plat,merek_kendaraan = :clt_merek_kendaraan,tipe_kendaraan = :clt_tanggal_keluar WHERE id = :clt_id';
            $result = $this->execReq($sql);
            $result->bindparam(":clt_id", $id);
            $result->bindparam(":clt_nomor_plat", $nomor_plat);
            $result->bindparam(":clt_merek_kendaraan", $merek_kendaraan);
            $result->bindparam(":clt_tipe_kendaraan", $tipe_kendaraan);
            $result->bindparam(":clt_tanggal_keluar", $tanggal_keluar);
            $result->execute();
            return $result;

        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function deleteClient($id)
    {
        try {
            $sql = 'DELETE FROM perekaman WHERE id = :clt_id';
            $result = $this->execReq($sql);
            $result->bindparam(":clt_id", $id);
            $result->execute();
            return $result;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public function deconnect()
    {
        unset($this->cnct);
    }

}
