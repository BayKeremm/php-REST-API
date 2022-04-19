<?php

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class MeasurementModel extends Database
{
	public function putValue($type,$value,$plantId)
	{
		return $this->insert("INSERT INTO a21iot15.Measurements (type, value, plantId) VALUES (?, ?, ?);",[$type,$value,$plantId]);
	}
    public function getMeasurements($limit){
    
        return $this->select("SELECT * FROM a21iot15.Measurements ORDER BY id ASC LIMIT ?", [$limit]);
    }
    public function getDayParameters(){
        return CallAPI("POST","https://api.sunrise-sunset.org/json?lat=50.8823&lng=4.7138",false);

    }
}

