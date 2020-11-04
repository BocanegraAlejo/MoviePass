<?php
namespace DAO;

use DAO\Connection as Connection;
use \Exception as Exception;
use models\Funcion;
use models\FuncionDB;
use models\HorarioFuncion;
use Models\Sala;
use DAO\PDO;


class FuncionDAO  {
    private $connection;
    private $tableName = "funcion";

    public function AddFuncion(FuncionDB $funcion) {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_sala, id_lenguaje, id_pelicula, horaYdia) VALUES (:id_sala, :id_lenguaje, :id_pelicula, :horaYdia);";
            
            
            $parameters["id_sala"] = $funcion->getId_sala();
            $parameters["id_lenguaje"] = $funcion->getId_idioma();
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
    
    public function getAllFuncionesXsala($id_sala) {
        try
        {
            $funcionList = array();

            $query = "SELECT f.id_funcion, p.id_pelicula, p.titulo,  l.nombre as `idioma`, p.duracion, f.horaYdia
            FROM ".$this->tableName." f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje l ON l.id_lenguaje=f.id_lenguaje
            WHERE id_sala='$id_sala'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $funcion = new Funcion();
                $funcion->setId_funcion($row["id_funcion"]);
                $funcion->setId_pelicula($row["id_pelicula"]);
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

            $query = "SELECT f.id_funcion, p.id_pelicula, s.id_cine, p.titulo, l.nombre as `idioma`, p.duracion, f.horaYdia
            FROM funcion f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje l ON l.id_lenguaje=f.id_lenguaje
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE s.id_cine='$id_cine'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $funcion = new Funcion();
                $funcion->setId_funcion($row["id_funcion"]);
                $funcion->setId_pelicula($row["id_pelicula"]);
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

    public function buscaFuncionesXpeliculaEncine($id_cine, $id_pelicula) {
        try
        {
            $funcionList = array();

            $query = "SELECT f.id_funcion, l.nombre as `idioma`, f.horaYdia
            FROM funcion f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje l ON l.id_lenguaje=f.id_lenguaje
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE s.id_cine='$id_cine' and f.id_pelicula='$id_pelicula'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row)
            {
                $funcion = new Funcion();
                $funcion->setId_funcion($row["id_funcion"]);
                $funcion->setIdioma($row["idioma"]);
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

    public function buscarSalaXid_funcion($id_funcion) {
        try
        {
            $query = "SELECT s.id_sala, s.id_cine, s.nombre_sala, s.cant_filas, s.cant_columnas FROM `".$this->tableName."`f 
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE id_funcion='$id_funcion'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            $sala = new Sala();
            
            $sala->setId_sala($resultSet[0]["id_sala"]);
            $sala->setId_cine($resultSet[0]["id_cine"]);
            $sala->setNombre_sala($resultSet[0]["nombre_sala"]);
            $sala->setCant_filas($resultSet[0]["cant_filas"]);
            $sala->setCant_columnas($resultSet[0]["cant_columnas"]);
            
        
            return $sala;
           
           
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
            $query = "SELECT f.id_funcion, p.id_pelicula, p.titulo, p.descripcion,p.duracion, p.imagen, l.nombre as `idioma`, p.fecha_lanzamiento, f.horaYdia as `horaYdia_funcion`
            FROM ".$this->tableName." f
            INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
            INNER JOIN lenguaje l ON l.id_lenguaje=f.id_lenguaje
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE s.id_cine='$id_cine' GROUP BY p.id_pelicula";

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
            $query = "UPDATE ".$this->tableName." SET id_lenguaje=:id_lenguaje, horaYdia=:horaYdia  where id_funcion= :id";
            
            $parameters["id"] = $funcion->getId_Funcion();
            $parameters["id_lenguaje"] = $funcion->getId_idioma();
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
            INNER JOIN lenguaje_x_pelicula lxp ON lxp.id_lenguaje=f.id_lenguaje
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE s.id_cine='$id_cine'";

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
    public function BuscarHorasOcupadasSala($id_sala, $dia) {
        try
        {
           
            $horarioFuncionList = array();
            
            $query = "SELECT  DISTINCT TIME(horaYdia) horaYdia, p.duracion  FROM `".$this->tableName."`f  INNER JOIN pelicula p ON f.id_pelicula=p.id_pelicula
             WHERE id_sala='$id_sala' and DATE(horaYdia)='$dia'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {
                $HorarioFuncion = new HorarioFuncion();
                $HorarioFuncion->sethora_inicio($row["horaYdia"]);
                $HorarioFuncion->sethora_fin($this->calcularHoras($row["horaYdia"],$row["duracion"]));
                $HorarioFuncion->setDuracion($row["duracion"]);


                array_push($horarioFuncionList, $HorarioFuncion);
            }
          
            return $horarioFuncionList;
           
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
            $query = "SELECT  DISTINCT DATE(horaYdia)  FROM `".$this->tableName."`f 
            INNER JOIN sala s ON s.id_sala=f.id_sala
            WHERE s.id_cine='$id_cine' and id_pelicula='$id_pelicula'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            return $resultSet;
           
           
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    private function calcularHoras($hora1, $hora2) {
        
        $hora2 = strtotime($hora2) - strtotime('today');//convertir los minutos a agregar en segundos
        $hora1 = strtotime('+'.$hora2.' seconds', strtotime($hora1));//agregar los segundos
        $horaFinal = strtotime('+15 minute',$hora1);
        return date('H:i:s', $horaFinal);//imprimir la hora de destino
    }

}


?>