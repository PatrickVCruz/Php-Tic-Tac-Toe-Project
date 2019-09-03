<?php
  if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="Assets/Style.css" />
</head>
<body>

<?php
require_once 'SoapModel.php';
require 'LoginPage.php';


    $soapController = new SoapModel();
    

if (isset($_POST) && count ($_POST) > 0){
	$fname = stripslashes($_POST["first_name"]);
	$sname = stripslashes($_POST["last_name"]);
	$uname = stripslashes($_POST["username"]);
	$password1 = stripslashes($_POST["password1"]);
	$password2 = stripslashes($_POST["password2"]);
	$_SESSION['username'] = $uname;
        if($password1 == $password2) {
            $result = $soapController->registerUser($uname, $password1, $fname, $sname);
            if ($result != 0) {
            header("Location: ./MainPage.php");
            $_SESSION["favcolor"] = "green"; 
        } else {
            echo "<div style='color:white;' class='form'>
                    <br><br><br>
                    <h3>Username is already used.</h3>
                    <br/>Click here to <a href='LandingLogin.php'>Login</a></div>";
        }
    }
        else {
           echo "<div style='color:white;' class='form'>
		<br><br><br>
		<h3>Passwords do not match.</h3>
		<br/>Click here to <a href='LandingLogin.php'>Login</a></div>"; 
        }
        
}
?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
    <div class="header2"><img src="./Assets/Title.png"/></div>
	<br>
	<div class="form">
	<h2 class="title4">Registration</h2>
	<form name="registration" method="post">
	<input type="text" name="first_name" maxlength="32" placeholder="First Name" required />
	<input type="text" name="last_name" maxlength="32" placeholder="Last Name" required />
	<input type="text" name="username" maxlength= "32" placeholder="Username" required />
	<input type="password" name="password1" maxlength="32" placeholder="Password" required />
	<input type="password" name="password2" maxlength="32" placeholder="Please re-enter your password" required />
	<input type="submit" name="submit" value="Register" />
	</form>
	<br>
	<br>
        <h3 class="reg">Already a member? <a href='LandingLogin.php'>Log in!</a></h3>
</div><?php }?>

</body>
</html>