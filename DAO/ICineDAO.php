<?php
    namespace DAO;
    use models\Cine;

interface ICineDAO {
    function Add(Cine $cine);
    function BuscarId($id);
    function ModificarCine(Cine $cine);
    function EliminarCine($id_cine);
    function GetAll();

}

?>