<?php

    // session_start();
    include_once 'user.php';
    include_once 'dbConnect.php';
    $con = new DBConnector;

    if(isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        $user = new User($first_name, $last_name, $city,$username,$password);
        if(!$user->validateForm()){
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
          }
         
        $res = $user->save($con->conn);
        if($res){
            echo "Record Saved!";
        }else{
            echo "An Error occured";
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lab1</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
<form method="post" name="user_details" id="user_details" onsubmit="return validateForm()"
              action="<?php  echo $_SERVER['PHP_SELF']?>">
        <table align="center">
        <tr>
                <td>
                    <div id="form-errors">
                        <?php
                            session_start();
                            if(!empty($_SESSION['form_errors']))
                            {
                                echo " ".$_SESSION['form_errors'];
                                unset($_SESSION['form_errors']);
                            }
                        ?>
                    </div>
                </td>
            </tr>
        <tr>
           <td><input type="text" name="first_name" placeholder="First Name"/></td>
           </tr>
           <tr>
            <td><input type="text" name="last_name" placeholder="Last Name"/></td>
            </tr>
            <tr>
            <td><input type="text" name="city_name" placeholder="City"/></td>
            </tr>
            <tr>
                <td><label for="uname">Username</label></td>
                <td><input type="text" name="user_name" id="uname" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
            <td><button type="submit" name="btn-save"><strong>SAVE</button></button></td>
            </tr>
            <tr>
            <td><a href="login.php">LOGIN</a></td>
            </tr>
            
            </table>
        </form>
</body>
</html>