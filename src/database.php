<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        /*if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }*/
    }

    public function addUser($username, $email, $password, $salt) {
        $insert_stmt = $this->db->prepare("INSERT INTO user (username, email, password, salt) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param('ssss', $username, $email, $password, $salt);
        $insert_stmt->execute();
    }

    public function getUser($username) {
        $stmt = $this->db->prepare("SELECT user_id, username, password, salt FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT user_id, username, email, password, salt FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPassword($user_id) {
        $stmt = $this->db->prepare("SELECT password FROM user WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        if($stmt->num_rows == 1) {      //se l'utente esiste
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function addAttempt($user_id, $now) {
        $this->db->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
    }

    public function checkBrute($user_id) {
        $now = time();
        // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
        $valid_attempts = $now - (2 * 60 * 60);
        if ($stmt = $this->db->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);
            // Eseguo la query creata.
            $stmt->execute();
            $stmt->store_result();
            // Verifico l'esistenza di più di 5 tentativi di login falliti.
            if($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>
