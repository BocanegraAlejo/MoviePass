<?php
    namespace DAO;
    use models\Cine;

interface ICineDAO {
    function Add(Cine $cine);
    function GetAll();

}

?>