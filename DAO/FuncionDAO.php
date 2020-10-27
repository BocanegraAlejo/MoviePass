<?php
namespace DAO;

use DAO\Connection as Connection;
use \Exception as Exception;
use models\Funcion;
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
    //retorna hora y dia de funcion + datos pelicula
    public function getAll_FuncionconDatosPeli_XCine($id_cine) {
        try
        {
            $query = "SELECT f.id_funcion, p.id_pelicula,p.titulo,p.descripcion,p.id_genero,p.duracion, p.imagen, lxp.nombre as `idioma`, p.fecha_lanzamiento, f.horaYdia as `horaYdia_funcion`
            FROM ".$this->tableName." f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje_x_pelicula lxp ON lxp.id_lenguaje=p.id_lenguaje
            WHERE id_cine='$id_cine' GROUP BY p.id_pelicula";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            return $resultSet;

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function BuscarFuncionXid($id_funcion) {
        try
        {
            $query = "SELECT * FROM `".$this->tableName."` WHERE id_funcion='$id_funcion'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            return $resultSet[0];
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function modificarFuncion($funcion) {
        try
        {
            $query = "UPDATE ".$this->tableName." SET horaYdia=:horaYdia where id_funcion= :id";
            
            $parameters["id"] = $funcion->getId_Funcion();
            $parameters["horaYdia"] = $funcion->gethoraYdia();
            
            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
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

    public function getAllPeliculasXcine($id_cine) {
        try
        {
            $peliculasList = array();

            $query = "SELECT *
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

    // retorna todos los rangos de horas ocupadas de un cine en un determinado dia
    public function BuscarHorasOcupadasCine($id_cine) {
        try
        {

            $horasList = array();

            $query = "SELECT  DISTINCT TIME(horaYdia) horaYdia FROM `".$this->tableName."` WHERE id_cine='$id_cine'";

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
            return $resultSet;
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    // Retorna un Array con Todas las fechas de peliculas correspondientes a un dia en un cine
    public function BuscarDiasXPelicula($id_cine, $id_pelicula) {
        try
        {
            $query = "SELECT  DISTINCT DATE(horaYdia) horaYdia FROM `".$this->tableName."` WHERE id_cine='$id_cine' and id_pelicula='$id_pelicula'";

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