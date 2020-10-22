<?php
namespace DAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use models\Sala;
use DAO\PDO;


class SalaDAO implements ISalaDAO {
    private $connection;
    private $tableName = "sala";
    
    
    public function getAllSalasXcine($id_cine) {
        try
        {
            $salasList = array();

            $query = "SELECT * FROM `".$this->tableName."` WHERE id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
           
            foreach ($resultSet as $row)
            {               
                $sala = new Sala();
                $sala->setId_sala($row["id_sala"]);
                $sala->setId_cine($row["id_cine"]);
                $sala->setNombre_sala($row["nombre_sala"]);
                $sala->setCapacidad($row["capacidad"]);

                array_push($salasList, $sala);
            }

            return $salasList;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
   
}


?>