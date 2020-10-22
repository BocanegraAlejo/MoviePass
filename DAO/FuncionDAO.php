<?php
namespace DAO;

use DAO\Connection as Connection;
use \Exception as Exception;
use models\FuncionDB;
use DAO\PDO;


class FuncionDAO implements IFuncionDAO {
    private $connection;
    private $tableName = "funcion";

    public function AddFuncion(FuncionDB $funcion) {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_cine, id_sala, id_pelicula, horaYdia) VALUES (:id_cine, :id_sala, :id_pelicula, :horaYdia);";
            
            $parameters["id_cine"] = $funcion->getId_cine();
            $parameters["id_sala"] = $funcion->getId_sala();
            $parameters["id_pelicula"] = $funcion->getId_pelicula();
            $parameters["horaYdia"] = $funcion->gethoraYdia();
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getAllFuncionesXsala($id_sala, $id_cine) {
        try
        {
            $funcionList = array();

            $query = "SELECT f.id_funcion, p.titulo, lxp.nombre as `idioma`, p.duracion, f.horaYdia
            FROM ".$this->tableName." f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje_x_pelicula lxp ON lxp.id_lenguaje=p.id_lenguaje
            WHERE id_sala='$id_sala' AND id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $funcion = new Funcion();
                $funcion->setId_funcion($row["id_funcion"]);
                $funcion->setTitulo_pelicula($row["titulo"]);
                $funcion->setIdioma($row["idioma"]);
                $funcion->setDuracion($row["duracion"]);
                $funcion->setFechaYhora($row["horaYdia"]);

                array_push($funcionList, $funcion);
            }

            return $funcionList;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getAllFuncionesXCine($id_cine) {
        try
        {
            $funcionList = array();

            $query = "SELECT f.id_funcion, p.titulo, lxp.nombre as `idioma`, p.duracion, f.horaYdia
            FROM ".$this->tableName." f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje_x_pelicula lxp ON lxp.id_lenguaje=p.id_lenguaje
            WHERE id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $funcion = new Funcion();
                $funcion->setId_funcion($row["id_funcion"]);
                $funcion->setTitulo_pelicula($row["titulo"]);
                $funcion->setIdioma($row["idioma"]);
                $funcion->setDuracion($row["duracion"]);
                $funcion->setFechaYhora($row["horaYdia"]);

                array_push($funcionList, $funcion);
            }

            return $funcionList;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function eliminarFuncion($id_funcion) {
        try
        {
            $query = "DELETE FROM `". $this->tableName."` WHERE id_funcion= :id_funcion";
            
            $parameters["id_funcion"] = $id_funcion;

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