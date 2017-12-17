<?php



class lib
{

    protected $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    function __destruct()
    {
        $this->db = null;
    }

    
    public function Register($username, $password, $google_secret_code)
    {
        $query = $this->db->prepare("INSERT INTO users(username, password, google_secret_code) VALUES (:username,:password,:google_secret_code)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $hash = md5($password);
        $query->bindParam("password", $hash, PDO::PARAM_STR);
        $query->bindParam("google_secret_code", $google_secret_code, PDO::PARAM_STR);
        $query->execute();
        return $this->db->lastInsertId();
    }

    public function isUsername($username)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

  
  
  
    public function Login($username, $password)
    {
        $query = $this->db->prepare("SELECT id, password FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            $enc_password = $result->password;
            if (md5($password) == $enc_password) {
                return $result->id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

 
    public function UserDetails($user_id)
    {
        $query = $this->db->prepare("SELECT id,  username, google_secret_code FROM users WHERE id=:user_id");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }
 

}