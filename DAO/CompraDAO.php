<?php
namespace DAO;
use DAO\Connection as Connection;
use \Exception as Exception;
use DAO\PDO;
use Models\Compra;


class CompraDAO {
    private $connection;
    private $tableName = "compra";

    public function Add(Compra $compra)
    {
        try
        {
            $query = "INSERT INTO ".$this->tableName." (id_usuario,cantidad,descuento,total) VALUES (:id_usuario,:cantidad,:descuento,:total);";
           
            $parameters["id_usuario"] = $compra->getId_usuario();
            $parameters["cantidad"] = $compra->getCantidad();
            $parameters["descuento"] = $compra->getDescuento();
            $parameters["total"] = $compra->getTotal();
            
            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
   
    public function obtenerUltimoId_compra() {
        
            try
            {
                $query = "SELECT * FROM `".$this->tableName."`  order by id_compra desc limit 1";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
                return $resultSet[0]["id_compra"];
               
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    
        
    }
}


?>