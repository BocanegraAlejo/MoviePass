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
                $query = "INSERT INTO ".$this->tableName." (email, clave, nombre, admin) VALUES (:email, :clave, :nombre, :admin);";
                
                $parameters["email"] = $usuario->getEmail();
                $parameters["clave"] = $usuario->getClave();
                $parameters["nombre"] = $usuario->getNombre();
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
                    $usuario->setClave($row["clave"]);
                    $usuario->setNombre($row["nombre"]);
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
        public function VerifExistenciaUser($user) {
            try
            {
                $query = "SELECT * FROM `".$this->tableName."` WHERE email='$user'";

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