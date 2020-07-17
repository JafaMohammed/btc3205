<?php 

   define('DB_SERVER', 'localhost:8889');
   define('DB_USER', 'root');
   define('DB_PASS', 'root');
   define('DB_NAME', 'labs');

   class DBConnector
   {

    public $conn;


    function __construct()
    {

     $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die("Fatal error: ". mysqli_error());

    }

    public function closeDatabase()
    {

     mysqli_close($this->conn);

    }
   }
?>