<?php
    namespace DAO;
    use \Exception as Exception;
    use Models\Usuario;
    

    class UsuarioDAO implements IUsuarioDAO {
        private $connection;
        private $tableName = "usuarios";

        public function Add(Usuario $usuario)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (recordId, firstName, lastName) VALUES (:recordId, :firstName, :lastName);";
                
                $parameters["email"] = $usuario->getEmail();
                $parameters["pass"] = $usuario->getPass();
                $parameters["admin"] = $usuario->getAdmin();

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
                $usuariosList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {               
                    $usuario = new Usuario();
                    $usuario->setEmail($row["email"]);
                    $usuario->setPass($row["clave"]);
                    $usuario->setAdmin($row["admin"]);

                    array_push($usuariosList, $usuario);
                }

                return $usuariosList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }


?>