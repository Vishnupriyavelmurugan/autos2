<?php
session_start();
if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}
?>
<?php
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123
$failure = false;
$emailErr= false;
if ( isset($_POST['email']) && isset($_POST['pass']) )
 {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 )
     {
        $_SESSION['error'] = "email and password are required";
       header("Location: login.php");
       return;
        
    }
   else if (preg_match("/[@]/",$_POST['email'])) 
   {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) 
        {
          $_SESSION['name'] = $_POST['email'];
          error_log("Login success ".$_POST['email']);
          header("Location: view.php");
            return;
        } else 
        {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
            header("Location: login.php");
            return;

        }
    }
            else
            {
        $_SESSION['error']="Email must have an at-sign (@)";
        header("Location: login.php");
            return;

    }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "pdo.php"; ?>
<title>360993be Login Page</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php
if ( isset($_SESSION['error']) )
 {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);

}
?>
<form method="POST">
<label for="nam">email</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>