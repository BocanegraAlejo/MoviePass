<?php
    namespace DAO\PDO;
    use \Exception as Exception;
    use models\Genero;
    class Genero_x_peliculaDAO 
    {
        private $connection;
        private $tableName = "genero_x_pelicula";

       
        public function add($id_genero, $id_pelicula) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_genero, id_pelicula) VALUES (:id_genero, :id_pelicula);";
                $parameters["id_genero"] = $id_genero;
                $parameters["id_pelicula"] = $id_pelicula;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getGenerosOnePelicula($id_pelicula) {
            try
            {
                $funcionList = array();
    
                $query = "SELECT g.nombre FROM ".$this->tableName." gxp INNER JOIN genero g ON gxp.id_genero=g.id_genero
                WHERE gxp.id_pelicula='$id_pelicula'";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                $arrGeneros = array();
                foreach ($resultSet as $row)
                {
                    array_push($arrGeneros, $row["nombre"]);
                }
    
                return $arrGeneros;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       

    }
?>