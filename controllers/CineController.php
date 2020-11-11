<?php
    namespace Controllers;
    use models\Cine;
    use DAO\PDO\CineDAO;
    use DAO\PDO\SalaDAO;
    use Exception;

class CineController {
        private $CineDAO;
        private $SalaDAO;

        public function __construct() {
            $this->CineDAO = new CineDAO();
            $this->SalaDAO = new SalaDAO();
            
        }

        public function index() {
            
        }

        public function ShowAltaView() {
            require_once(VIEWS_PATH."add_cine.php");
        }

        public function ShowAdministraCine() {
           
            $arrCines = $this->getAllCines();
            require_once(VIEWS_PATH."administra_cines.php");
        }
        

        
        public function altaCine($nombre, $direccion, $horario_apertura, $horario_cierre, $valor_entrada) {
            try {
                $cine = new Cine('',$_SESSION['loggedUser']->getId_usuario(),$nombre,$direccion,$horario_apertura,$horario_cierre, $valor_entrada, '');
                $this->CineDAO->Add($cine);
                $_SESSION["Alertmessage"] = "El cine se agrego correctamente!";
                $this->ShowAdministraCine();
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }

        public function ModificaCine($id) {
            try {
                 $ObjectCine = $this->CineDAO->BuscarId($id);
                if(!empty($ObjectCine))
                {
                    return $ObjectCine;
                }
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
        }

        public function ModificarCine2($id,$nombre, $direccion, $horario_apertura, $horario_cierre, $valor_entrada) {
            try {
                  $ObjectCine = new Cine($id,$_SESSION['loggedUser']->getId_usuario(),$nombre,$direccion,$horario_apertura,$horario_cierre,$valor_entrada,'');
                $this->CineDAO->ModificarCine($ObjectCine);
                $this->ShowAdministraCine();
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
          
           
        }
        
        public function ElimCine($id_cine) {
            try {
                $this->CineDAO->EliminarCine($id_cine);
                $this->ShowAdministraCine();
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
            

        }
        public function getAllCines() {
            try {
                $arrCines = $this->CineDAO->GetAll($_SESSION['loggedUser']->getId_usuario());
                foreach ($arrCines as $key => $value) {
                    $value->setCapacidadTotal($this->SalaDAO->calcularTotalCapacidadAllSalas($value->getId()));
                }
                return $arrCines; 
               
            }
            catch(Exception $ex) {
                $_SESSION["Alertmessage"] = "Ha ocurrido un Error: {$ex}";
            }
           
        }
    }
        


?>