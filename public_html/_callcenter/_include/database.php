<?php
// callcenter/_include/database.php
//
// Database and related utility functions

$callcenter_db_salt = NULL;

function open_db()
{
	global $callcenter_db_salt;

	$dbh = NULL;
	
	$config_dir = dirname($_SERVER['DOCUMENT_ROOT']) . '/_config';
	$config_file = $config_dir . '/callcenter.ini';
	
	$config = parse_ini_file($config_file, TRUE);
	
	$dsn = $config['database']['dsn'];
	$user = $config['database']['username'];
	$pass = $config['database']['password'];
	
	$dbh = new PDO($dsn, $user, $pass);
	
	$callcenter_db_salt = $config['database']['salt'];
	
	return $dbh;
}

function encrypt_db($text)
{
	global $callcenter_db_salt;
	
	$c_text = '';
	
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	
	$c_text = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $callcenter_db_salt, 
		$text, MCRYPT_MODE_ECB, $iv);
	$c_text = base64_encode($c_text);
	$c_text = trim($c_text);
	
	return $c_text;
}

function decrypt_db($c_text)
{
	global $callcenter_db_salt;
	
	$text = '';
	
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	
	$c_text = base64_decode($c_text);
	
	$text = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $callcenter_db_salt,
		$c_text, MCRYPT_MODE_ECB, $iv);
	$text = trim($text);
	
	return $text;
}

?>