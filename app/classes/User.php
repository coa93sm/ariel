
<?php
//mora se pronaci drugi nacin za konekciju za bazu

class User {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;  // Assign the passed connection object to the class property
    }

    public function create($name, $username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            return true;
        } else {
            die("Execute failed: " . $stmt->error);
            return false;
        }
    }

    public function login($username,$password){

        $sql="select user_id, password from users where username = ?";
        $stmt=$this->conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s",$username);
        $stmt->execute();

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $results=$stmt->get_result();

        if($results->num_rows==1){

            $user=$results->fetch_assoc();
            if(password_verify($password,$user['password'])){
                $_SESSION['user_id']=$user['user_id'];
                return true;
            }
        } return false;
    }

    public function is_logged(){
        if(isset($_SESSION['user_id'])){
            return true;
        }
        return false;
    }

    public function is_admin(){
        $query="SELECT * FROM users WHERE user_id=? AND is_admin=1";
        $stmt=$this->conn->prepare($query);
        $stmt->bind_param('i',$_SESSION['user_id']);
        $stmt->execute();
        $result=$stmt->get_result();

        if($result->num_rows>0){
            return true;
        }
        return false;
    }

    public function logout(){
        unset($_SESSION['user_id']);
    }
}

?>