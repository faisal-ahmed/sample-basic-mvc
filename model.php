<?php

/**
 * Description of model
 *
 * @author Faisal ahmed
 */
class model {

    protected $mysqlObject;

    public function __construct() {
    }

    /**
     * Description of dbConnect()
     *
     * This function is responsible for the database connection
     */
    public function dbConnect($host, $username, $password, $dbName) {
        //connect to mysql server
        $this->mysqlObject = new mysqli($host, $username, $password, $dbName);

        //check if any connection error was encountered
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.";
            exit;
        }
    }

    /**
     * Description of loginCheck()
     *
     * This function is responsible for the login authentication
     */
    public function loginCheck($username, $password) {
        $user = $this->mysqlObject->real_escape_string($username);
        $pass = $this->mysqlObject->real_escape_string($password);

        $sql = "Select * from user where user.username = '" . $user . "' AND user.password = '" . $pass . "'";

        $result = $this->mysqlObject->query($sql);
        $num_results = $result->num_rows;
        if ($num_results > 0) {
            $_SESSION['LOGGED_IN_STATUS'] = true;
            $_SESSION['USERNAME'] = $user;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Description of createUser()
     *
     * This function is responsible for the creation of a user
     */
    public function createUser($username, $password) {
        $user = $this->mysqlObject->real_escape_string($username);
        $pass = $this->mysqlObject->real_escape_string($password);

        $sql = "insert into user
                set
                username = '" . $user . "',
                password = '" . $pass . "'";

        if ($this->mysqlObject->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function dbClose() {
        $this->mysqlObject->close();
    }

}

?>
