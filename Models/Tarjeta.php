<?php
namespace Models;

class Tarjeta {
    private $id_tarjeta;
    private $nro;
    private $nombre;
    private $mes;
    private $anio;
    private $ccv;

    public function __construct($id_tarjeta, $nro, $nombre, $mes, $anio, $ccv) {
        $this->id_tarjeta = $id_tarjeta;
        $this->nro = $nro;
        $this->nombre = $nombre;
        $this->mes = $mes;
        $this->anio = $anio;
        $this->ccv = $ccv;
    }

    

    public function getId_tarjeta()
    {
        return $this->id_tarjeta;
    }


    public function setId_tarjeta($id_tarjeta)
    {
        $this->id_tarjeta = $id_tarjeta;
    }

    public function getNro()
    {
        return $this->nro;
    }

 
    public function setNro($nro)
    {
        $this->nro = $nro;
    }

  
    public function getNombre()
    {
        return $this->nombre;
    }

 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getMes()
    {
        return $this->mes;
    }

    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    public function getAnio()
    {
        return $this->anio;
    }


    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

  
    public function getCcv()
    {
        return $this->ccv;
    }

    public function setCcv($ccv)
    {
        $this->ccv = $ccv;
    }
}

?>