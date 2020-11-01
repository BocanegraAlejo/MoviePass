<?php
    namespace DAO;
    use DAO\Connection as Connection;
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

       

    }
?>