<?php

    // session_start();
    include_once 'user.php';
    include_once 'dbConnect.php';
    $con = new DBConnector;

    if(isset($_POST['btn-save'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];

        $user = new User($first_name,$last_name,$city);
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
</head>
<body>
        <form method="POST" action="<?php  echo $_SERVER['PHP_SELF']?>">
        <table align="center">
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
            <td><button type="submit" name="btn-save"><strong>Save</button></button></td>
            </tr>
            </table>
        </form>
</body>
</html>