<?php

    // session_start();
    include_once 'user.php';
    include_once 'dbConnect.php';
    include_once 'fileUploader.php';
    $con = new DBConnector;

    if(isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //lab3 controls
        $timestamp = $_POST['utcTimestamp'];
        $offset = $_POST['timeZoneOffset'];



//       Get the name of the file selected, the size and the file type
$imageName = $_FILES['fileToUpload']['name'];
$imageTmp = $_FILES['fileToUpload']['tmp_name'];
$imageSize = $_FILES['fileToUpload']['size'];
$imageType = $_FILES['fileToUpload']['type'];

//lab3

        $user = new User($first_name, $last_name, $city,$username,$password,$timestamp,$offset);
        $uploader = new FileUploader($imageName,$imageTmp,$imageSize,$imageType);
        if($uploader->uploadFile())
        {
            echo "<script>alert(\"Image uploaded successfully!\")</script>";
        }

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
    //include jquery here
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="timezone.js"></script>
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
            <td><label for="first_name">First Name</label></td>
           <td><input type="text" name="first_name" placeholder="First Name"/></td>
           </tr>
           <tr>
           <td><label for="last_name">Last Name</label></td>
            <td><input type="text" name="last_name" placeholder="Last Name"/></td>
            </tr>
            <tr>
            <td><label for="city_name">City name</label></td>
            <td><input type="text" name="city_name" placeholder="City"/></td>
            </tr>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="user_name" id="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" placeholder="Enter your password"></td>
            </tr>
            <tr>
                <td><label for="fileToUpload">Profile Picture</label></td>
                <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            <tr>
            <td><button type="submit" name="btn-save"><strong>SAVE</button></button></td>
            </tr>
            //hidden controls to store client utc date and timezone
            <input type="hidden" name="utcTimestamp" id="utcTimestamp">
            <input type="hidden" name="timeZoneOffset" id="timeZoneOffset">
            <tr>
            <td><a href="login.php">Login</a></td>
            </tr>
            
            </table>
        </form>
        <a href="viewAllRecords.php" >View All Records</a>
</body>
</html>