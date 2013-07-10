<?php
// callcenter/_api/go.php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
	echo 'UNSUPPORTED HTTP REQUEST METHOD';
	die;
}

require_once('../_include/database.php');

$offer_link_id = $_GET['offer_link_id'];

$dbh = open_db();

$sql = "SELECT * FROM offer_links WHERE offer_link_id=:offer_link_id;";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':offer_link_id', $offer_link_id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_BOTH);
if ($row == FALSE) {
	echo 'Database error: could not find record for offer_link_id = ' . $offer_link_id . '';
	die;
} else {
	$stmt->closeCursor();
	$stmt = NULL;
	$sql = NULL;
}

// check the security token
if ($_GET['security_token'] != $row['security_token']) {
	echo 'INVALID SECURITY TOKEN';
	die;
}

/// TODO: Update the following fields in the database, just before sending the 'Location'
///	header to cause a redirect: clicked, clicked_on, client_ip_address and client_user_agent
$sql = "UPDATE offer_links SET clicked=1, clicked_on=NOW(), client_ip_address=:client_ip_address, client_user_agent=:client_user_agent WHERE offer_link_id=:offer_link_id;";
$stmt = $dbh->prepare($sql);

//$clicked = 1;
//$clicked_on = "NOW()";
$client_ip_address = $_SERVER['REMOTE_ADDR'];
$client_user_agent = $_SERVER['HTTP_USER_AGENT'];

//$stmt->bindValue(':clicked', $clicked);
//$stmt->bindValue(':clicked_on', $clicked_on);
$stmt->bindValue(':client_ip_address', $client_ip_address);
$stmt->bindValue(':client_user_agent', $client_user_agent);
$stmt->bindValue(':offer_link_id', $offer_link_id);

$stmt->execute();

$stmt->closeCursor();
$stmt = NULL;
$sql = NULL;

header('Location: ' . $row['url'] . '');
// ... and, just in case...
die;
// ... now we are done...
?>