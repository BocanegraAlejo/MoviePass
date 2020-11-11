<?php

namespace DAO\PDO;

use \Exception as Exception;
use Models\entrada;



class EntradaDAO  {
    private $connection;
    private $tableName = "entrada";

    public function Add(Entrada $entrada)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_compra,id_funcion,qr_code) VALUES (:id_compra,:id_funcion,:qr_code);";
           
            $parameters["id_compra"] = $entrada->getId_compra();
            $parameters["id_funcion"] = $entrada->getId_funcion();
            $parameters["qr_code"] = $entrada->getQr_code();
           
            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }


    public function buscaXqr($qr) {
        try
        {
            $qrList = array();

            $query = "SELECT qr_code FROM `".$this->tableName."` WHERE qr_code='$qr'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
          
           return $resultSet;

        }
        catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }


}

?>