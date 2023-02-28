<?php
namespace Hotel;

use PDO;
use Exception;
use PDOException;
use Configuration\Configuration;
use DateTime;

class BaseService
{
    private static $pdo;

    public function __construct()
    {   
        $this->initializePdo();
    }

    protected function initializePdo()
    {   

        // Check if PDO is already initialized
        if(!empty(self::$pdo)){
            return;
        }

        // Load database configuration
        $config = Configuration::getInstance();
        $dataBaseConfig = $config->getConfig()['database'];

        // Connect to database
        try{
            self::$pdo = new PDO(sprintf("mysql:host=%s;
            dbname=%s;charset=UTF8",$dataBaseConfig['host'],$dataBaseConfig['db_name']),
            $dataBaseConfig['username'],
            $dataBaseConfig['password'],
            [PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'"]);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $ex){
            throw new Exception(sprintf('Could not connect to database. Error: %s', $ex->getMessage()));
            
        }
            

    }

    protected function execute($sql,$parameters)
    {
        
        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);
        
        // Bind parameters
        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        
        $status= $statement->execute();
         
        // Execute
        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }
  
        return $status;
    }

    protected function fetchAll($sql, $parameters=[], $type = PDO::FETCH_ASSOC)
    {

        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);

        // Bind parameters
        foreach ($parameters as $key => $value) {

            // Bind column
            if($key==="sort_by"){
               $status = $statement->bindColumn($value, $value, PDO::PARAM_STR);
                continue;
            }

            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);

        }
        
        // Execute
        $status= $statement->execute();

        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }

        // Fetch all
        return $statement->fetchAll($type);
    }

    protected function fetch($sql, $parameters=[], $type = PDO::FETCH_ASSOC)
    {
        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);

        // Bind parameters
        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        // Execute
        $status= $statement->execute();

        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }

        // Fetch all
        return $statement->fetch($type);
    }

    protected function getPdo()
    {
        return self::$pdo;
    }

    static function checkDateDifference($checkInDate,$checkOutDate){
        
        $checkInDateTime= new DateTime($checkInDate);
        $checkOutDateTime= new DateTime($checkOutDate);
        $dateIn=$checkInDateTime->format("Uv");
        $dateOut=$checkOutDateTime->format("Uv");
 
        return $dateIn<$dateOut;
    }
}
?>