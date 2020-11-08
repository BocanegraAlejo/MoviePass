<?php
    namespace DAO\PDO;
    use \Exception as Exception;
    use models\Idioma;
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
                $query = "SELECT l.id_lenguaje, l.nombre  FROM `".$this->tableName."`lxp
                INNER JOIN lenguaje l ON lxp.id_lenguaje=l.id_lenguaje
                 WHERE id_pelicula='$id_pelicula'";
    
                $this->connection = Connection::GetInstance();
                
                $resultSet = $this->connection->Execute($query);
                
                $listIdiomas = array();
                foreach ($resultSet as $key => $row) {
                    $idioma = new Idioma();
                    $idioma->setId_lenguaje($row["id_lenguaje"]);
                    $idioma->setNombre($row["nombre"]);

                    array_push($listIdiomas,$idioma);
                }
                return $listIdiomas;
               
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }
?>