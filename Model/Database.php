<?php
class Database
{
    protected $connection = null;

    public function __construct(){
        try{
            $this->connection = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE_NAME);

            if(mysqli_connect_errno()){
                throw new Exception("Could not connect to the database.");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function insert($query = "",$params = [])
    {
    	try{
            if(isset($params[3]))
    		$stmt = $this->executeOwnedPlantInsert($query,$params);
            else if(isset($params[2]))
    		$stmt = $this->executeInsert($query,$params);
            else
    		$stmt = $this->executeUserInsert($query,$params);
		    $stmt->close();
            return true;


	    }catch(Exception $e){
		    throw New Exception( $e->getMessage());	
	    }
	    return false;
    }
    public function executeOwnedPlantInsert($query= "",$params=[])
    {
	    try{
            	$stmt = $this->connection->prepare( $query );

		        if($stmt == false){
                    	throw New Exception("Unable to do prepared statement: " . $query);
			
		        }
		        $stmt->bind_param("ssss",$params[0],$params[1],$params[2],$params[3]);
            	$stmt->execute();
            	return $stmt;
		    
	    
	    }catch(Exception $e){
            	throw New Exception( $e->getMessage() );
	    }		
    }

    public function executeUserInsert($query= "",$params=[])
    {
	    try{
            	$stmt = $this->connection->prepare( $query );

		        if($stmt == false){
                    	throw New Exception("Unable to do prepared statement: " . $query);
			
		        }
		        $stmt->bind_param("ss",$params[0],$params[1]);
            	$stmt->execute();
            	return $stmt;
		    
	    
	    }catch(Exception $e){
            	throw New Exception( $e->getMessage() );
	    }		
    }

    public function executeInsert($query= "",$params=[])
    {
	    try{
            	$stmt = $this->connection->prepare( $query );

		        if($stmt == false){
                    	throw New Exception("Unable to do prepared statement: " . $query);
			
		        }
		        $stmt->bind_param("sss",$params[0],$params[1],$params[2]);
            	$stmt->execute();
            	return $stmt;
		    
	    
	    }catch(Exception $e){
            	throw New Exception( $e->getMessage() );
	    }		
    }
	


    public function select($query = "",$params = []){
        try{
            $stmt = $this->executeStatement($query,$params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
            $stmt->close();
            return $result;
        }catch(Exception $e){
            throw New Exception($e->getMessage());
        }
        return false;
    }
    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
                            }
             
            if( $params ) {
                if(isset($params[1]))
                $stmt->bind_param("ss",$params[0], $params[1]);
                else
                $stmt->bind_param("s",$params[0]);
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
    public function update($query = "",$params = []){
        try{
            $stmt = $this->executeUpdate($query,$params);
            $stmt->close();
            return true;
        }catch(Exception $e){
            throw New Exception($e->getMessage());
        }
        return false;
    }
    private function executeUpdate($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
                            }
             
            if( $params ) {
                $stmt->bind_param("ssss",$params[0], $params[1],$params[2],$params[3]);
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }


}
