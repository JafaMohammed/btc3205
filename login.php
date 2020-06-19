<?php
include_once "user.php";
include_once "dbConnect.php";

$con = new DBConnector();

if(isset($_POST['btn-login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(User::isPasswordCorrect($password,$username))
    {
        User::createUserSession($username);
        echo "complete";
        header("Location:privatePage.php");
    }
    else
    {
        header('Location:login.php');
        echo ""."error";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <form method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF']?>">
        <table align="center">
            <tr>
                <td><input type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><input type="password" name="password"  placeholder="Password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
        </table>
    </form>
</body>
</html>