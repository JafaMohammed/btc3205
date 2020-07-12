<?php 
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';
$first_name = '';
$last_name = '';
$city = '';
$uname = '';
$pass = '';
$utc_timestamp = '';
$data = '';
$offset = '';

$user = new User($first_name,$last_name,$city,$uname,$pass,$data,$utc_timestamp,$offset);

$con = new DBConnector;

if (isset($_POST['btn-save'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
   
        $utc_timestamp = $_POST['utc_timestamp'];
        $offset = $_POST['time_zone_offset'];
        $data = $_FILES['filetoUpload'];
        // die($data["name"]);

        //Creating a new user object
        $user = new User($first_name,$last_name,$city_name,$username,$password,$data,$utc_timestamp,$offset);
        //Create the object for File Uploader
        $uploader = new FileUploader($data);

    if (!$user->validateForm()) {
        $user->createFormErrorSessions();
        header("Refresh:0");
        return;
    }else if($user->isUserExists($username)){
        $user->createUsernameErrorSessions();
        header("Refresh:0");
        return;
    }else{
        $res = $user->save();
    }
    $file_upload_response = $uploader->uploadFile();
        

    //Check if the operation occured succesfully
    if ($res && $file_upload_response === TRUE) {
        $message = "Save Operation Was Succesful";
    }else{
        $message = "Save Operation Was Not Succesful";
    }
    $con->closeDatabase();
}
?>

<html>
<head>
    <title>Title goes here</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="timezone.js"></script>
</head>
<body>
<form method="post" id="user_details" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
    <table align="center">
    <tr>
    <td>
    <div id="form-errors">
			<?php 
			session_start();
			if (!empty($_SESSION['form_errors'])) {
				echo " ". $_SESSION['form_errors'];
				unset($_SESSION['form_errors']);
			}
			 ?>
		</div>
        </td>
        </tr>
    <tr>
        <td><input type="text" name="first_name" required placeholder="First Name"/></td>
    </tr>
    <tr>
        <td><input type="text" name="last_name" required placeholder="Last Name"/></td>
    </tr>
    <tr>
        <td><input type="text" name="city_name" required placeholder="City"/></td>
    </tr>
    <tr>
    <td><input type="text" name="username" placeholder="Username"/></td>
    </tr>
    <tr>
    <td><input type="password" name="password" placeholder="Password"/></td>
    </tr>
    <tr>
    
    <td>Profile Image:<input type="file" name="filetoUpload"/></td>
    </tr>
    <tr>
        <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
    </tr>
    <input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
    <input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
    <tr>
    <td><a href="login.php">Login</a></td>
    </tr>
    </table>
    </form>
</body>
</html>