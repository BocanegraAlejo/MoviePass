<?php
namespace DAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use models\Sala;
use DAO\PDO;


class SalaDAO  {
    private $connection;
    private $tableName = "sala";
    
    public function addSala(Sala $sala) {
        
            try
            {
             
                $query = "INSERT INTO ".$this->tableName." (id_cine, nombre_sala,capacidad) VALUES (:id_cine, :nombre_sala, :capacidad);";
               
                $parameters["id_cine"] = $sala->getId_cine();
                $parameters["nombre_sala"] = $sala->getNombre_sala();
                $parameters["capacidad"] = $sala->getCapacidad();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function modificarSala($sala) {
        try
        {
            $query = "UPDATE ".$this->tableName." SET nombre_sala=:nombre,capacidad=:capacidad where id_sala= :id";
            
            $parameters["id"] = $sala->getId_sala();
            $parameters["nombre"] = $sala->getNombre_sala();
            $parameters["capacidad"] = $sala->getCapacidad();
            

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function elimSala($id_sala) {
        try
        {
            $query = "DELETE FROM `". $this->tableName."` WHERE id_sala= :id_sala";
            
            $parameters["id_sala"] = $id_sala;

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function buscarSalaXid($id_sala) {
        try
        {
            $query = "SELECT * FROM `".$this->tableName."` WHERE id_sala='$id_sala'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            return $resultSet[0];
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

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