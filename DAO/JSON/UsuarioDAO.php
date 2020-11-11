<?php
    namespace DAO\JSON;
    use Models\Usuario;

   class UsuarioDAO 
   {
       private $userList = array();
       private $fileName;
   
       public function __construct()
       {
           $this->fileName= dirname(__DIR__)."/data/usuario.json";        
       }
   
   
        public function Add(Usuario $usuario)
        { 
            $this->RetrieveData();
            array_push($this->userList,$usuario);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->userList;
        }

        private function SaveData() {
            $arrayToEncode = array();
        
            foreach($this->userList as $user)
            {
                $valuesArray['email'] = $user->getEmail();
                $valuesArray['clave'] = $user->getClave();
                $valuesArray['admin'] = $user->getAdmin();
                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }
    
    
        private function RetrieveData() {
            $this->userList = array();
            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($arrayToDecode as $valuesArray) {
                    $user = new Usuario($valuesArray['email'],$valuesArray['clave'],$valuesArray['admin']);
                    
                    array_push($this->userList, $user);
                   
                }
            }
        }

        public function VerifExistenciaUser($user) {
        
            $this->RetrieveData();
            $valuesArray = array();
            foreach($this->userList as $value)
            {
                if($user == $value->getEmail())
                {
                    $valuesArray[0]['email'] = $value->getEmail();
                    $valuesArray[0]['clave'] = $value->getClave();
                    $valuesArray[0]['admin'] = $value->getAdmin();
                }
            }
            return $valuesArray;  
        }
        

    }

?>