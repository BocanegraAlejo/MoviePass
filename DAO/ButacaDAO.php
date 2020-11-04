<?php
namespace DAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use DAO\PDO;
use Models\Butaca;


class ButacaDAO {
    private $connection;
    private $tableName = "butaca";

    public function Add(Butaca $butaca)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_sala,fila,columna) VALUES (:id_sala, :fila, :columna);";
            $parameters["id_sala"] = $butaca->getId_sala();
            $parameters["fila"] = $butaca->getFila();
            $parameters["columna"] = $butaca->getColumna();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
  
}


?>