<?php
require_once('../_include/database.php');
require_once('../_include/callcenter_offer_definitions.php');
require_once('../_include/link_template.php');

$base_href = dirname($_SERVER['PHP_SELF']);
$base_href = dirname($base_href);

// sanity check: only proceed if AT LEAST one offer was checked to be sent
$offer_count = 0;
foreach ($_POST as $key => $value) {
	if ($value == "CERTIFIED") {
		$offer_count++;
	}
}
if ($offer_count < 1) {
	header('Location: http://www.leadsanddata.net' . $base_href . '/' . $_POST['vendor_id'] . '/');
	die;
}

// (1) retrieve stored application from the database using $_POST['application_id']

$dbh = open_db();
$sql = "SELECT * FROM applications WHERE application_id = :application_id;";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':application_id', $_POST['application_id']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
if ($row == FALSE) {
	echo 'Database error while trying to retrieve record for application_id = ' . $_POST['application_id'];
	die;
} else {
	$stmt->closeCursor();
	$stmt = NULL;
	$sql = NULL;
}

// added transformation for the date of birth (required for Mongo offer)
$row['DOB'] = sprintf("%04u-%02u-%02u", $row['bday_year'], $row['bday_month'], $row['bday_day']);

// (2) create the top of the e-mail body
$msg_body = "Hello " . $row['first_name'] . " " . $row['last_name'] . "!\r\n";
$msg_body .= "\r\n";
$msg_body .= "Here are the links for the special offers which you requested:\r\n";
$msg_body .= "\r\n";

// (3) create a new record in the offer_mailings table, save the insert id
$sql = "INSERT INTO offer_mailings (application_id, message_to, message_subject, message_body, message_headers) VALUES (:application_id, :message_to, :message_subject, :message_body, :message_headers);";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':application_id', $row['application_id']);
$stmt->bindValue(':message_to', '');
$stmt->bindValue(':message_subject', '');
$stmt->bindValue(':message_body', '');
$stmt->bindValue(':message_headers', '');
$stmt->execute();

$offer_mailing_id = $dbh->lastInsertId();

$stmt->closeCursor();
$stmt = NULL;

// (4) iterate over elements of $_POST searching for elements with a value of 'CERTIFIED'
//		(4a) use the key of a matching element to look it up in $callcenter_offer_definitions
//		(4b) append a line for the title of the offer to the e-mail body
//		(4c) process the link template using the application retrieved from the database
//		(4d) create a new record in the offer_links table for this offer link
//		(4e) append a line for a link like the following to the e-mail body:
//				http://www.leadsanddata.net/callcenter/_api/go.php?offer_link_id=31337

$sql = "INSERT INTO offer_links (offer_mailing_id, url, security_token) VALUES (:offer_mailing_id, :url, :security_token);";
$stmt = $dbh->prepare($sql);

foreach ($_POST as $key => $value) {
	if ($value == "CERTIFIED") {
		$offer = $callcenter_offer_definitions[$key];
		
		$msg_body .= "\r\n";
		$msg_body .= "" . $offer['title'] . "\r\n";
		$msg_body .= "\r\n";
		
		$offer_link = process_link_template($offer['link_template'], $row);
		
		$security_token = 'DSG|' . $offer_link . '|' . time();
		$security_token = md5($security_token);
		
		$stmt->bindValue(':offer_mailing_id', $offer_mailing_id);
		$stmt->bindValue(':url', $offer_link);
		$stmt->bindValue(':security_token', $security_token);
		$stmt->execute();
		
		$offer_link_id = $dbh->lastInsertId();
		$msg_offer_link = 'http://www.leadsanddata.net' . $base_href . '/_api/go.php';
		$msg_offer_link .= '?offer_link_id=' . $offer_link_id;
		$msg_offer_link .= '&security_token=' . $security_token;
		
		$msg_body .= "\t" . $msg_offer_link . "\r\n";
		$msg_body .= "\r\n";
		
		$stmt->closeCursor();
		
		$msg_offer_link = NULL;
		$offer_link_id = NULL;
		$offer_link = NULL;
		$offer = NULL;
	}
}

$stmt = NULL;
$sql = NULL;

// (5) append necessary closing lines to the e-mail body

$msg_body .= "\r\n";
$msg_body .= "Have a wonderful day!\r\n";
$msg_body .= "\r\n";
$msg_body .= "\r\n";

// (6) set up any other information necessary for e-mail
//		(6a) create string for 'To' line
//		(6b) create string for 'From' line (but is set with headers...)
//		(6c) create string for 'Subject' line
//		(6d) create any other necessary headers

$msg_to = '' . $row['first_name'] . ' ' . $row['last_name'];
$msg_to .= ' <' . $row['email'] . '>';

$msg_subject = 'Here are Special Offers for ' . $row['first_name'] . ' ' . $row['last_name'];

$msg_headers = "From: Special Offers <specialoffers@leadsanddata.net>\r\n";
$msg_headers .= "Reply-To: Special Offers <specialoffers@leadsanddata.net>\r\n";
$msg_headers .= "Return-Path: Special Offers <specialoffers@leadsanddata.net>\r\n";
$msg_headers .= "Message-ID: <" . md5(time()) . "%offer_mailing_id=" . $offer_mailing_id . "@" . $_SERVER['SERVER_NAME'] . ">\r\n";
$msg_headers .= "X-Mailer: PHP v" . phpversion() . "\r\n";
$msg_headers .= "MIME-Version: 1.0\r\n";
$msg_headers .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
$msg_headers .= "Content-Transfer-Encoding: 8bit\r\n";

// (7) update the record which was created in the offer_mailings table

$sql = "UPDATE offer_mailings SET message_to=:message_to, message_subject=:message_subject, message_body=:message_body, message_headers=:message_headers WHERE offer_mailing_id=:offer_mailing_id;";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':message_to', $msg_to);
$stmt->bindValue(':message_subject', $msg_subject);
$stmt->bindValue(':message_body', $msg_body);
$stmt->bindValue(':message_headers', $msg_headers);
$stmt->bindValue(':offer_mailing_id', $offer_mailing_id);
$stmt->execute();
$stmt->closeCursor();
$stmt = NULL;
$sql = NULL;

// (8) use the standard PHP mail(...) function to send e-mail to consumer

mail($msg_to, $msg_subject, $msg_body, $msg_headers);

// (9) redirect back to application form based on $_POST['vendor_id']
header('Location: http://www.leadsanddata.net' . $base_href . '/' . $_POST['vendor_id'] . '/');
// ... be sure that...
die;
// ... nothing down here gets executed (e.g. no whitespace characters being
// inadvertently sent in the output stream to the user agent)...
?>