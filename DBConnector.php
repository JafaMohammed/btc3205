<?php
define('DB_SERVER', 'localhost:8889');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME','btc3205');

class DBConnector {
    public $conn;
        //we connect to our database inside our class constructor
        //so we can always cayse a database connection whenever an object is created
function __construct(){
    $this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die("Error:" .mysqli_error());
    mysqli_select_db($this->conn,DB_NAME);
   
    
}

public function closeDatabase(){
    mysqli_close($this->conn);
}

}

?>
