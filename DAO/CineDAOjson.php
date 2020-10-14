<?php
namespace DAO;
use Models\Cine as Cine;

class CineDAOjson implements ICineDAO
{
    private $cineList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName= dirname(__DIR__)."/data/cine.json";        
    }


    public function Add(Cine $cine){
        $this->RetrieveData();
        $ultimo = end($this->cineList);
        if($ultimo!=false)
        {
            $cine->setId($ultimo->getId()+1);
        }
        else
        {
           $cine->setId(0);
        }
       
        array_push($this->cineList,$cine);
        $this->SaveData();

    }


    public function GetAll()
    {
        $this->RetrieveData();
        return $this->cineList;
    }


    private function SaveData() {
        $arrayToEncode = array();
        
        foreach($this->cineList as $cine)
        {   
            $valuesArray['id'] = $cine->getId();
            $valuesArray['nombre'] = $cine->getNombre();
            $valuesArray['direccion'] = $cine->getDireccion();
            $valuesArray['horario_apertura'] = $cine->getHorario_apertura();
            $valuesArray['horario_cierre'] = $cine->getHorario_cierre();
            $valuesArray['valorEntrada'] = $cine->getValorEntrada();
            $valuesArray['capacidadTotal'] = $cine->getCapacidadTotal();
            
            
            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode,JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }


    private function RetrieveData() {
        $this->cineList = array();
        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
            
            foreach($arrayToDecode as $valuesArray) {
                $cine = new Cine($valuesArray['id'],$valuesArray['nombre'],$valuesArray['direccion'],$valuesArray['horario_apertura'],$valuesArray['horario_cierre'],$valuesArray['valorEntrada'],$valuesArray['capacidadTotal']);

                array_push($this->cineList, $cine);
               
            }
        }
    }


    public function ModificarCine(Cine $cine){
        $this->RetrieveData();
        foreach($this->cineList as $value){
            
            if($cine->getId() == $value->getId())            
            {   
                $value->setId($cine->getId());
                $value->setNombre($cine->getNombre());
                $value->setDireccion($cine->getDireccion());                
                $value->setHorario_apertura($cine->getHorario_apertura());
                $value->setHorario_cierre($cine->getHorario_cierre());
                $value->setValorEntrada($cine->getValorEntrada());
                $value->setCapacidadTotal($cine->getCapacidadTotal());
                
            }
        }
        $this->SaveData();
    }
    public function BuscarId($id) {
        $this->RetrieveData();
        $valuesArray = array();
        foreach($this->cineList as $value)
        {
            if($id == $value->getId())
            {
                $valuesArray['id_cine'] = $value->getId();
                $valuesArray['nombre'] = $value->getNombre();
                $valuesArray['direccion'] = $value->getDireccion();
                $valuesArray['horario_apertura'] = $value->getHorario_apertura();
                $valuesArray['horario_cierre'] = $value->getHorario_cierre();
                $valuesArray['capacidad_total'] = $value->getCapacidadTotal();
                $valuesArray['valor_entrada'] = $value->getValorEntrada();
               
            }
        }
        return $valuesArray;
       
    }

    public function EliminarCine($id_cine)
    {
        
        $this->RetrieveData();
        foreach($this->cineList as $key =>$value)
        {
            
            if($id_cine == $value->getId())
            {
                unset($this->cineList[$key]);
            }
            
        }
        $this->SaveData();
    }
}
?>


        