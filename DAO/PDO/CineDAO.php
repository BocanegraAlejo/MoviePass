<?php
namespace DAO\PDO;
use \Exception as Exception;
use models\Cine;



class CineDAO {
    private $connection;
    private $tableName = "cine";

    public function Add(Cine $cine)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_usuario, nombre, direccion, horario_apertura, horario_cierre, valor_entrada) VALUES (:id_usuario, :nombre, :direccion, :horario_apertura, :horario_cierre, :valor_entrada);";
            $parameters["id_usuario"] = $cine->getId_usuario();
            $parameters["nombre"] = $cine->getNombre();
            $parameters["direccion"] = $cine->getDireccion();
            $parameters["horario_apertura"] = $cine->getHorario_apertura();
            $parameters["horario_cierre"] = $cine->getHorario_cierre();
            $parameters["valor_entrada"] = $cine->getValorEntrada();
            

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function BuscarId($id_cine) {
        try
        {
            $query = "SELECT * FROM `".$this->tableName."` WHERE id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            return new Cine($resultSet[0]['id_cine'],$_SESSION['loggedUser']->getId_usuario(),$resultSet[0]['nombre'],$resultSet[0]['direccion'],$resultSet[0]['horario_apertura'],$resultSet[0]['horario_cierre'],$resultSet[0]['valor_entrada'],'');
           
           
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
            $query = "UPDATE ".$this->tableName." SET nombre=:nombre,direccion=:direccion,horario_apertura=:horario_apertura,horario_cierre=:horario_cierre,valor_entrada=:valor_entrada  where id_cine= :id";
            
            $parameters["id"] = $cine->getId();
            $parameters["nombre"] = $cine->getNombre();
            $parameters["direccion"] = $cine->getDireccion();
            $parameters["horario_apertura"] = $cine->getHorario_apertura();
            $parameters["horario_cierre"] = $cine->getHorario_cierre();
            $parameters["valor_entrada"] = $cine->getValorEntrada();
            

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
    public function GetAll($id_user)
    {
        try
        {
            $cinesList = array();
            
            $query = "SELECT * FROM $this->tableName WHERE id_usuario='$id_user'";

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
                
                array_push($cinesList, $cine);
            }
            
            return $cinesList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetAllCines()
    {
        try
        {
            $cinesList = array();

            $query = "SELECT * FROM $this->tableName";

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