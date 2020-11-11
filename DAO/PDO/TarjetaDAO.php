<?php
namespace DAO\PDO;
use \Exception as Exception;
use models\Tarjeta;



class TarjetaDAO  {
    private $connection;
    private $tableName = "tarjeta";
    
    public function verificaTarjeta(Tarjeta $tarjeta) {
        try
        {
            
            $nro = $tarjeta->getNro();
            $nombre = $tarjeta->getNombre();
            $mes = $tarjeta->getMes();
            $anio = $tarjeta->getAnio();
            $ccv = $tarjeta->getCcv();
            
            $query = "SELECT * FROM `".$this->tableName."` WHERE nro='$nro' and nombre='$nombre' and mes='$mes' and anio='$anio' and ccv='$ccv'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            return $resultSet;
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
           
   
}


?>