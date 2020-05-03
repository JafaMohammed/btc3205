<?php
    require 'crud.php';
    require 'dbConnect.php';
    include 'authenticator.php';
    class User implements Crud, Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        private $username;
        private $password;
 

        function __construct($first_name,$last_name,$city_name){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;

            $this->username = $username;
            $this->password = $password;
        
        }
        //php does not allow multilee constructors, because when we log in,
        // we do not have all the details we onlyhave username and password
        //and we still need to use this same class.
        //We make this methid static so that we access it wuth the class rarher than object 


        //static constructor

        public static function create() {
            $instance = new self();
            return $instance;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
        }


        public function getUserId(){
            return $this->$user_id;
        }
        public function setUsername($username)
        {
            $this->username = $username;
        }
    
       
        public function getUsername()
        {
            return $this->username;
        }
    
        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getPassword()
        {
            return $this->password;
        }
    
       
      
    
        public function save(){
            $con = new DBConnector();
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            $username = $this->username;
            $this->hashPassword();
            $pass = $this->password;
           
            $res = mysqli_query($con->conn,"INSERT INTO user(first_name, last_name,user_city,username,password) VALUES('$fn','$ln','$city', '$username', '$pass')") or die("Error " .mysqli_error());    
            return $res;
            $con->closeDatabase();
        }



        public function readAll(){
            $con = new DBConnector();
            $array = array();
            $query = 'SELECT * FROM user';
            $res = mysqli_query($con->conn, $query);
            // while($row = mysqli_fetch_assoc($res)){
            //             $array[] = $row;
    
            // }
            // return $array;
            return $res;
        }
        public function readUnique(){
            return null;
        }
        public function search(){
            return null;
        }
        public function update(){
            return null;
        }
        public function removeOne(){
            return null;
        }
        public function removeAll(){
            return null;
        }
        public function validateForm()
        {
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
    
            if($fn == "" || $ln == "" || $city == "")
            {
                return false;
            }
            return true;
        }
    
        public function createFormErrorSessions()
        {
            session_start();
            $_SESSION['form_errors'] = 'All fields are required';
        }
        public function hashPassword()
        {
            //inbuilt function password_hash hases our passwords
            $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        }
        public function isPasswordCorrect($username,$password){
            $con = new DBConnector;
            $found = false;
            $res = mysqli_query($con->conn,'SELECT * FROM user') or die("Error" .mysqli_error());
       
       while($row = $res->fetch_assoc()){
           if(password_verify($password,$row['password'] && $username == $row['username'])){
               $found=true;
           }
       }
    }
    public function login(){
        if($this->isPasswordCorrect()){
            //password is correct so we load the protected page
            header("Location:private_page.php");
        }
    }

    public  function createUserSession($username){
        session_start();
        $_SESSION['username'] = $username;

    }
    public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }
    }
?>