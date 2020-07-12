<?php
    
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
        // exit();
    }

    include_once "DBConnector.php";
    $con = new DBConnector();

    $username = $_SESSION['username'];

    $sql = "SELECT id FROM user WHERE username = '$username'";
    // $res = $conn->getConnection()->query($sql) or die("Error:".$conn->getConnection()->error);
    $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
    while($row = $res->fetch_array()){
      $_SESSION['id'] = $row['id'];
    }

    function fetchUserApiKey(){
      $id = $_SESSION['id'];
      $con = new DBConnector();
      // $id = $_SESSION['id'];
      $sql = "SELECT api_key FROM api_keys WHERE user_id='$id'";
      $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
      if ($res->num_rows <= 0) {
          return 'Please Generate an API Key';
      }else{
        while($row = $res->fetch_array()){
          $api_key = $row['api_key'];
        }
        // $_SESSION['api_key'] = $api_key;
        return $api_key;
      }
     
   }
  //  echo ("API KEY:".$_SESSION['api_key']);

   
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Title goes here</title>
	<script src="jquery-3.5.1.js"></script>
	<script type="text/javascript" src="validate.js"></script>
	<script type="text/javascript" src="apikey.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<!--bootstrap js -->
	<!--js-->
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!--bootstrap css -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-grid.min.css.map">
</head>
<p align="right"><a href="logout.php">Logout</a></p>
	<hr>
	<h3>Here, we will create an API that will allow Users/Developer to order items from external sytems</h3>
	<hr>
	<h4>We now put this feature of allowing users to generate API key. Click the button to generate API key</h4>
	<p><?php $feedback = fetchUserApiKey();
      echo ($feedback==='Please Generate an API Key') ? 
        '<button class="btn btn-light" id="api-key-btn">Generate API Key</button>' : 
        '<button class="btn btn-light" id="api-key-btn" disabled>Generate API Key</button>';?>
	</p>
	<!--This text area will hold the API key-->
	<strong>Your API key:</strong>(Note that if your API key is already in use by already running application, generating a new key will stop the application from functioning)<br>

	<textarea cols="100" rows="2" id="api-key" readonly><?php echo fetchUserApiKey();?></textarea>

	<h3>Service description:</h3>
	We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it.
	<hr>
</body>
</html>