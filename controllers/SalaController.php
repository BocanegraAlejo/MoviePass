<?php
    namespace Controllers;
    use Models\Sala;
    use DAO\PDO\SalaDAO;
use Exception;

class SalaController
    {
        private $SalaDAO;
        public function __construct()
        {
            
            $this->SalaDAO = new SalaDAO();
           
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."administra_salas.php");
        }

        public function ShowAdministraSalas($id_cine = "")
        {
            try {
                $arrSalas = $this->SalaDAO->getAllSalasXcine($id_cine);
                require_once(VIEWS_PATH."administra_salas.php");
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
        }

        public function altaSala($id_cine, $nombre, $cant_filas, $cant_columnas) {
            try {
                 $sala = new Sala('',$id_cine,$nombre,$cant_filas,$cant_columnas);
                $this->SalaDAO->addSala($sala);
                $this->ShowAdministraSalas($id_cine);
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }

        public function modificaSala($id_sala) {
            try {
                 $ObjectSala = $this->SalaDAO->BuscarSalaXid($id_sala);
            
                if(!empty($ObjectSala))
                {
                    return $ObjectSala;
                }
                
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }
        
        public function ModificarSala2($id_cine, $id_sala,$nombre, $cant_filas,$cant_columnas) {
            try {
                $ObjectSala = new Sala($id_sala,$id_cine,$nombre,$cant_filas,$cant_columnas);
                $this->SalaDAO->ModificarSala($ObjectSala);
                $this->ShowAdministraSalas($id_cine);
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
           
        }

        public function elimSala($id_cine,$id_sala) {
            try {
                $this->SalaDAO->elimSala($id_sala);
                $this->ShowAdministraSalas($id_cine);
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            
        }

    }
?>