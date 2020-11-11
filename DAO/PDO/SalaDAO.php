<?php
namespace DAO\PDO;

use \Exception as Exception;
use models\Sala;


class SalaDAO  {
    private $connection;
    private $tableName = "sala";
    
    public function addSala(Sala $sala) {
        
            try
            {
             
                $query = "INSERT INTO ".$this->tableName." (id_cine, nombre_sala,cant_filas,cant_columnas) VALUES (:id_cine, :nombre_sala, :cant_filas,:cant_columnas);";
               
                $parameters["id_cine"] = $sala->getId_cine();
                $parameters["nombre_sala"] = $sala->getNombre_sala();
                $parameters["cant_filas"] = $sala->getCant_filas();
                $parameters["cant_columnas"] = $sala->getCant_columnas();

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
            $query = "UPDATE ".$this->tableName." SET nombre_sala=:nombre,cant_filas=:cant_filas, cant_columnas=:cant_columnas where id_sala= :id";
            
            $parameters["id"] = $sala->getId_sala();
            $parameters["nombre"] = $sala->getNombre_sala();
            $parameters["cant_filas"] = $sala->getCant_filas();
            $parameters["cant_columnas"] = $sala->getCant_columnas();

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
            
            return new Sala($resultSet[0]['id_sala'],$resultSet[0]['id_cine'],$resultSet[0]['nombre_sala'], $resultSet[0]['cant_filas'],$resultSet[0]['cant_columnas']);
           
           
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
                $sala->setCant_filas($row["cant_filas"]);
                $sala->setCant_columnas($row["cant_columnas"]);

                array_push($salasList, $sala);
            }

            return $salasList;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function calcularTotalCapacidadAllSalas($id_cine) {
        try
        {
           

            $query = "SELECT SUM(cant_filas*cant_columnas) as `capacidad_cine` FROM $this->tableName WHERE id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
           
           return $resultSet[0]["capacidad_cine"];

           

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
   
}


?>