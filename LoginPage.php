<?php
require     'SoapModel.php';


if (isset($_POST) && count ($_POST) > 0){
    
	$uname = stripslashes($_REQUEST['uname']);
	$pass = stripslashes($_REQUEST['password']);
        $soap = new SoapModel();
        $_SESSION['username'] = $uname;
        $result = $soap->loginUser($uname, $pass);
        if($result > 0){
        header("Location: ./MainPage.php");
        }
        else{
		echo "<div style='color:white;' class='form'>
		<br><br><br>
		<h3>Email/password is incorrect.</h3>
		<br/>Click here to <a href='LandingLogin.php'>Login</a></div>";
	}
        
}
?>
</body>
</html>