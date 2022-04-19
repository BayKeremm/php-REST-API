<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM a21iot15.Users ORDER BY Id ASC LIMIT ?", ["i", $limit]);
    }
    public function checkUserName($username)
    {
		return $this->select("SELECT * FROM a21iot15.Users WHERE username = ?",[$username]);
    }
    public function registerUser($username,$password)
    {
		return $this->insert("INSERT INTO a21iot15.Users (userName, passwordHash) VALUES (?, ?);",[$username,$password]);
    }
    public function loginUser($username,$password)
    {
		return $this->select("SELECT * FROM a21iot15.Users WHERE userName = ? AND passwordHash = ?",[$username,$password]);
    }
}
