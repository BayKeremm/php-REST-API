<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM a21iot15.Users ORDER BY user_Id ASC LIMIT ?", ["i", $limit]);
    }
}
