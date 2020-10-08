<?php
namespace DAO;
use DAO\ICineDAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use models\Cine;
use DAO\PDO;


class CineDAO implements ICineDAO {
    private $connection;
    private $tableName = "cine";

    public function Add(Cine $cine)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (nombre, direccion, horario_apertura, horario_cierre, valor_entrada, capacidad_total) VALUES (:nombre, :direccion, :horario_apertura, :horario_cierre, :valor_entrada, :capacidad_total);";
            
            $parameters["nombre"] = $cine->getNombre();
            $parameters["direccion"] = $cine->getDireccion();
            $parameters["horario_apertura"] = $cine->getHorario_apertura();
            $parameters["horario_cierre"] = $cine->getHorario_cierre();
            $parameters["valor_entrada"] = $cine->getValorEntrada();
            $parameters["capacidad_total"] = $cine->getCapacidadTotal();
            

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function BuscarId($id) {
        try
        {
            $query = "SELECT * FROM `".$this->tableName."` WHERE id_cine=$id";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            return $resultSet[0];
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }
    public function ModificarCine(Cine $cine)
    {
        try
        {
            $query = "UPDATE `.$this->tableName.` SET nombre=:nombre,direccion=:direccion,horario_apertura=:horario_apertura,horario_cierre=:horario_cierre,valor_entrada=:valor_entrada,capacidad_total=:capacidad_total  where id_cine= :id";
            
            $parameters["id"] = $cine->getId();
            $parameters["nombre"] = $cine->getNombre();
            $parameters["direccion"] = $cine->getDireccion();
            $parameters["horario_apertura"] = $cine->getHorario_apertura();
            $parameters["horario_cierre"] = $cine->getHorario_cierre();
            $parameters["valor_entrada"] = $cine->getValorEntrada();
            $parameters["capacidad_total"] = $cine->getCapacidadTotal();

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function EliminarCine($id_cine)
    {
        try
        {
            $query = "DELETE FROM `". $this->tableName."` WHERE id_cine= :id_cine";
            
            $parameters["id_cine"] = $id_cine;

            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function GetAll()
    {
        try
        {
            $cinesList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {               
                $cine = new Cine();
                $cine->setId($row["id_cine"]);
                $cine->setNombre($row["nombre"]);
                $cine->setDireccion($row["direccion"]);
                $cine->setHorario_apertura($row["horario_apertura"]);
                $cine->setHorario_cierre($row["horario_cierre"]);
                $cine->setValorEntrada($row["valor_entrada"]);
                $cine->setCapacidadTotal($row["capacidad_total"]);
                
                array_push($cinesList, $cine);
            }

            return $cinesList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}


?>