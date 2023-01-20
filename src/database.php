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

    public function getUserInfo($user_id) {
        $stmt = $this->db->prepare("SELECT email, password, salt, nome, cognome, bio, user_image  FROM user WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserDetail($username){
        $stmt = $this->db->prepare("SELECT user_id, username, nome,cognome ,bio,user_image, back_image FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowers($user_id) {
        $stmt = $this->db->prepare("SELECT u.username
        FROM user u
        JOIN follower f 
        ON 	u.user_id=f.source_id AND u.user_id
        WHERE f.target_id =?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsOfPersonal($user_id){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome ,p.* 
        from `user` u 
        join post p on u.user_id=p.creator_id 
        where u.user_id =?");
        $stmt->bind_param('i', $user_id, $index);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostsOfFollowing($user_id, $index){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome, p.*
        from follower f 
        join `user` u on target_id =user_id 
        join post p on  f.target_id=p.creator_id
        where source_id =?
        order by p.created_at desc
        LIMIT 10 OFFSET ?*10"
        );
        $stmt->bind_param('ii', $user_id, $index);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Check if the user is following another user
    public function isFollowing($user_id, $target_id) {
        $stmt = $this->db->prepare("SELECT * FROM follower WHERE source_id = ?  AND target_id = ?");
        $stmt->bind_param('ii', $user_id, $target_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getFollowersCount($user_id){
        $follow=array();
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follower WHERE target_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $follow['followers']=$result->fetch_all(MYSQLI_ASSOC)[0]["COUNT(*)"];
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follower WHERE source_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $follow['following']=$result->fetch_all(MYSQLI_ASSOC)[0]["COUNT(*)"];
        return $follow;
    }

    public function toggleFollow($user_id, $target_id, $flag) {
        $stmt = $this->db->prepare("SELECT  follower (source_id, target_id) VALUES (?, ?)");
    }

    public function follow($user_id, $target_id) {
        try {
            $stmt = $this->db->prepare("INSERT INTO follower (source_id, target_id) VALUES (?, ?)");
            $stmt->bind_param('ii', $user_id, $target_id);
            $stmt->execute();
        } catch(mysqli_sql_exception $e) {
            if($e->getCode() == 1062) {
                echo('Already following');
            } else {
                throw $e;
            }
        }
    }

    public function unfollow($user_id, $target_id) {
        $stmt = $this->db->prepare("DELETE FROM follower WHERE source_id = ? AND target_id = ?");
        $stmt->bind_param('ii', $user_id, $target_id);
        $stmt->execute();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT user_id, username, email, password, salt FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getImage($user_id) {
        $stmt = $this->db->prepare("SELECT user_image FROM user WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addAttempt($user_id, $now) {
        $this->db->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
    }

    public function updateProfile($user_id, $email, $password, $salt, $nome, $cognome, $bio, $image) {
        $insert_stmt = $this->db->prepare("UPDATE user SET email=?,password=?,salt=?,nome=?,cognome=?,bio=?,user_image=?
                                                 WHERE user_id=?");
        $insert_stmt->bind_param('sssssssi',  $email, $password, $salt, $nome, $cognome, $bio, $image, $user_id);
        $insert_stmt->execute();
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
