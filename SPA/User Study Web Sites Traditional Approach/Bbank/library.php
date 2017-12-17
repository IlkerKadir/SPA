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

    
    public function Register($name, $email, $username, $password,$phoneNumber, $google_secret_code)
    {
        $query = $this->db->prepare("INSERT INTO users(name, email, username, password,phoneNumber, google_secret_code) VALUES (:name,:email,:username,:password,:phoneNumber,:google_secret_code)");
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("username", $username, PDO::PARAM_STR);
        // $enc_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 11]);
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $query->bindParam("password", $hash, PDO::PARAM_STR);
         $query->bindParam("phoneNumber", $phoneNumber, PDO::PARAM_STR);
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

  
    public function isEmail($email)
    {
        $query = $this->db->prepare("SELECT id FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

  
    public function Login($username, $password)
    {
        $query = $this->db->prepare("SELECT id, password FROM users WHERE username=:username OR email=:email");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("email", $username, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            $enc_password = $result->password;
            if (password_verify($password, $enc_password)) {
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
        $query = $this->db->prepare("SELECT id, name, username, email,phoneNumber, google_secret_code FROM users WHERE id=:user_id");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }
 

}