<?php
session_start();
if ( !isset($_SESSION['name'] ) ) {
 die("Name parameter missing");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>360993be G.V.VISHNUPRIYA Automobile Tracker</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo $_SESSION['name']?></h1>
<?php
require_once "pdo.php";
if (isset($_SESSION['smsg'])){
    echo('<p style="color: green;">'.htmlentities($_SESSION['smsg'])."</p>\n");
}
?>
<h2>Automobiles</h2>
<ul>
	<?php
	if (isset($_SESSION['smsg']))
	{
		$stmt2=$pdo->query("SELECT make,year,mileage FROM autos");
	while( $row=$stmt2->fetch(PDO::FETCH_ASSOC))
	{
		$m=$row['make'];
		$yr=$row['year'];
		$mi=$row['mileage'];
        echo "<ul>";
  echo "<li>" .htmlentities($m) .",".htmlentities($yr)."/".htmlentities($mi)."</li>";
echo "</ul>";
	}
	unset($_SESSION['smsg']);
}
	?>
<p>
</ul>
<p>
<a href="add.php">Add New</a> |
<a href="logout.php">Logout</a>
</p>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
