<?php
    namespace DAO;
    use models\Usuario;

    interface IUsuarioDAO {

    function Add(Usuario $usuario);
    function GetAll();
    function VerifExistenciaUser($user);
    
}

?>