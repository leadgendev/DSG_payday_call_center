<?php
require_once('_include/database.php');

$APP_ROOT = '/_callcenter';

session_start();

// check to see if the user is already logged in
if (isset($_SESSION['user_id'])) {
	// the user is already logged in, so redirect them to the application page
	header('Location: ' . $APP_ROOT . '/application.php');
	die;
}

// check the HTTP request method, and handle accordingly
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	// show the login page
?>
<!DOCTYPE html>
<html lang="us">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link type="text/css" rel="stylesheet" href="<?php echo $APP_ROOT; ?>/css/reset.css" />
	
	<title>DSG Payday Call Center - Login</title>
</head>
<body>
	<div id="login_form_wrapper">
		<form id="login_form" name="login_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="login_username">Username</label>
			<input id="login_username" name="username" type="text" value=""/>
			
			<label for="login_password">Password</label>
			<input id="login_password" name="password" type="password" value=""/>
			
			<input id="login_submit" type="submit" value="Login" />
		</form>
	</div>
</body>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// authenitcate the user with the supplied credentials and 
	// initialize the user session
	print_r($_POST);
} else {
	echo 'UNSUPPORTED HTTP REQUEST METHOD';
}

?>