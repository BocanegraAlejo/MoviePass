<?php
    namespace DAO;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class Lenguaje_x_peliculaDAO 
    {
        private $connection;
        private $tableName = "lenguaje_x_pelicula";

       
        public function add($id_lenguaje, $id_pelicula) {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_lenguaje, id_pelicula) VALUES (:id_lenguaje, :id_pelicula);";
                $parameters["id_lenguaje"] = $id_lenguaje;
                $parameters["id_pelicula"] = $id_pelicula;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function buscarLenguajesXidPelicula($id_pelicula) {
            try
            {
                $query = "SELECT * FROM `".$this->tableName."` WHERE id_pelicula='$id_pelicula'";
    
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