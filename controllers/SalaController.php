<?php
    namespace Controllers;
    use Models\Sala;
    use DAO\SalaDAO;

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
            $arrSalas = $this->SalaDAO->getAllSalasXcine($id_cine);
            require_once(VIEWS_PATH."administra_salas.php");
        }

        public function altaSala($id_cine, $nombre, $capacidad) {
            $sala = new Sala('',$id_cine,$nombre,$capacidad);
            $this->SalaDAO->addSala($sala);
            $this->ShowAdministraSalas($id_cine);
        }

        public function modificaSala($id_sala) {
            $resultado = $this->SalaDAO->BuscarSalaXid($id_sala);
            
            if(!empty($resultado))
            {
                $ObjectSala = new Sala($resultado['id_sala'],$resultado['id_cine'],$resultado['nombre_sala'],$resultado['capacidad']);

            }
            return $ObjectSala;
        }
        
        public function ModificarSala2($id_cine, $id_sala,$nombre, $capacidad) {
            $ObjectSala = new Sala($id_sala,$id_cine,$nombre,$capacidad);
            $this->SalaDAO->ModificarSala($ObjectSala);
            $this->ShowAdministraSalas($id_cine);
           
        }

        public function elimSala($id_sala) {
            $this->SalaDAO->elimSala($id_sala);
            $this->ShowAdministraSalas($_SESSION['cineActual']);
        }

    }
?>