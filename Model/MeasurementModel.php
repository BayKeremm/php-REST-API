<?php
//INSERT INTO a21iot15.Measurements (`type`, `timestamp`, `value`) VALUES (:measurementtype, :datetime, :value);

require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class MeasurementModel extends Database
{
	public function putValue($type,$timestamp,$value)
	{
		return $this->insert("INSERT INTO a21iot15.Measurements (type, timestamp, value) VALUES (?, ?, ?);",[$type,$timestamp,$value]);
	}
}

