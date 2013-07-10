<?php
// use the global variable $post_lead_response to determine what to show on the confirmation page

$transfer_code = NULL;

if ($post_lead_response == NULL) {
	// if the variable is still set, or was reset, to NULL, this means an error occurred
	require_once('callcenter_confirmation_page_error.php');
} else {
	$xml = new SimpleXMLElement($post_lead_response);
	if ($xml->IsValid == 'True') {
		$transfer_code = $xml->UniqueID;
		require_once('callcenter_confirmation_page_accepted.php');
	} else {
		require_once('callcenter_confirmation_page_declined.php');
	}
}
?>