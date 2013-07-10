<?php
//

$base_href = dirname($_SERVER['PHP_SELF']);
$base_href = dirname($base_href);

require_once('callcenter_post_lead.php');
require_once('callcenter_insert_application.php');

$post_lead_response = NULL;

$callcenter_application_id = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once('callcenter_form_page.php');
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$post_lead_response = callcenter_post_lead();
	$callcenter_application_id = callcenter_insert_application();
	require_once('callcenter_confirmation_page.php');
} else {
	echo 'UNSUPPORTED HTTP REQUEST METHOD';
}
?>