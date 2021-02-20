<?php
session_start();
$failure = false;
$success= false;
if ( !isset($_SESSION['name'] ) ) {
 die("Name parameter missing");
}
?>
<?php
require_once "pdo.php";
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']))
{

	 if ( strlen($_POST['make']) < 1)
	 {
	  $failure="Make is required";
	  $_SESSION['msg']=$failure;
	  header("Location: add.php");
            return;	 	
	 }
	else if(!is_numeric($_POST['mileage']) || !is_numeric($_POST['year']))
	{
      $failure="Mileage and year must be numeric";
      $_SESSION['msg']=$failure;
       header("Location: add.php");
            return;
   }
     else{

	$sql="INSERT INTO autos(make,year,mileage) VALUES (:make,:year,:mileage)";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(array(
		':make'=> $_POST['make'],
	    ':year'=> $_POST['year'],
	    ':mileage'=> $_POST['mileage']));
	   $success="Record inserted";
	   $_SESSION['smsg']=$success;
	   header("Location: view.php");
            return;
        }
}
?>
<?php
if (isset($_SESSION['msg'])) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['msg'])."</p>\n");
    unset($_SESSION['msg']);
}
?>
<?php
if(isset($_POST['logout'])){
	header('Location: view.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title>360993be </title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo $_SESSION['name']?></h1>
<form method="post">
 <p>Make:
<input type="text" name="make" size="60"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="cancel">
</form>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>

