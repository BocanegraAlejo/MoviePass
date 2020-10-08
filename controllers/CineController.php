<?php
    namespace Controllers;
    use models\Cine;
    use DAO\CineDAO;

    class CineController {
        private $CineDAO;

        public function __construct() {
            $this->CineDAO = new CineDAO();
        }

        public function ShowAltaView() {
            require_once(VIEWS_PATH."add_cine.php");
        }

        public function ShowAdministraCine() {
            require_once(VIEWS_PATH."administra_cines.php");
        }
        

        
        public function altaCine($nombre, $direccion, $horario_apertura, $horario_cierre, $capacidad_total, $valor_entrada) {
            
            $cine = new Cine($nombre,$direccion,$horario_apertura,$horario_cierre, $capacidad_total, $valor_entrada);
            var_dump($cine);
            $this->CineDAO->Add($cine);
            echo "<script>alert('El cine se agrego correctamente!');</script>";
            require_once(VIEWS_PATH."dashboardAdmin.php");
        }

        public function ModificaCine($id) {
            
            $resultado = $this->CineDAO->BuscarId($id);
            if(!empty($resultado))
            {
                $ObjectCine = new Cine($resultado['nombre'],$resultado['direccion'],$resultado['horario_apertura'],$resultado['horario_cierre'],$resultado['valor_entrada'],$resultado['capacidad_total']);
                require_once(VIEWS_PATH."modify_cine.php");
            }
        }

        public function ModificarCine2($nombre, $direccion, $horario_apertura, $horario_cierre, $valor_entrada, $capacidad_total) {
            $ObjectCine = new Cine($nombre,$direccion,$horario_apertura,$horario_cierre,$valor_entrada,$capacidad_total);
            $this->CineDAO->ModificarCine($ObjectCine);
            
           
        }

        public function ElimCine($id_cine) {
            
            $this->CineDAO->EliminarCine($id_cine);
            require_once(VIEWS_PATH."administra_cines.php");

        }

        public function getAllCines() {
            return $this->CineDAO->GetAll();
        }
    }
        


?>