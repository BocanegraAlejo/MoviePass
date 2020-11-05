<?php
namespace DAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use models\Tarjeta;
use DAO\PDO;


class TarjetaDAO  {
    private $connection;
    private $tableName = "tarjeta";
    
    public function verificaTarjeta(Tarjeta $tarjeta) {
        try
        {
            $query = "SELECT * FROM `".$this->tableName."` WHERE nro='$tarjeta->getNro()' and nombre='$tarjeta->getNombre()' and mes='$tarjeta->getMes()' and anio='$tarjeta->getAnio()' and ccv='$tarjeta->getCcv()'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            return $resultSet[0];
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
           
   
}


?>