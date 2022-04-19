
<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class PlantModel extends Database{
    public function getPlants(){
        return $this->select("SELECT * FROM a21iot15.Plants");
    }
    public function updateOwnedPlant($userId,$plantId,$imgBinary,$nickName){
        return $this->update("UPDATE a21iot15.ownedPlants SET nickName=?,plantId=?,img=? where userId=?",[$nickName,$plantId,$imgBinary,$userId]);
    }
    public function insertOwnedPlant($userId,$plantId,$deviceMAC,$nickName){
//        echo($userId);
//        echo($plantId);
//        echo($imgBinary);
//        echo($nickName);
          return $this->insert("INSERT INTO `a21iot15`.`ownedPlants` (`userId`,`plantId`,`deviceMAC`,`nickName`) VALUES (?,?,?,?);",[$userId,$plantId,$deviceMAC,$nickName]);
    }
    public function listOwnedPlants($userId){
        return $this->select("SELECT * FROM a21iot15.ownedPlants WHERE userId = ?",[$userId]);
    }
}
