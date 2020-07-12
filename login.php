<?php 
include_once 'DBConnector.php';
include_once 'user.php';

$con = new DBConnector;

if (isset($_POST['btn-login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$instance = User::create();
	$instance->setPassword($password);
	$instance->setUsername($username);

	if ($instance->isPasswordCorrect()) {
		$instance->login();
		$con->closeDatabase();
		$instance->createUserSession();
	} else {
		$instance->createFormErrorSessions("Username or password is incorrect");
		$con->closeDatabase();
	}
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Title goes here</title>
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="timezone.js"></script> -->
</head>
<body>
	<form method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF']?>">
    <table align= "center">
	<tr>
        <td><input type="text" name="username" placeholder="Username" required/></td>
    </tr>
    <tr>
        <td><input type="text" name="password" placeholder="Password" required/></td>
    </tr>
   <tr>
   <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
   </tr>
</table>

	</form>
</body>
</html>