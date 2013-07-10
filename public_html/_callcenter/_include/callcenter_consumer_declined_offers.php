<?php
// (1) generate offers for a given application_id
// (2) display description of each offer in a list
// (3) below each offer, include a checkbox indicating consent of the 
//	consumer has been received for e-mail
// (4) button/link for confirming offer selections, onclick action
//	should cause an AJAX-style call to be made to send the e-mail,
//	but possibly display some kind of modal dialog for double-confirmation
//	(5) redirect operator back to main application page after mail has been
//	sent and confirmation displayed

require_once('callcenter_offer_definitions.php');

?>
<script type="text/javascript">
$(document).ready(function () {

});
</script>

<ul style="margin: 0px 0px 15px 15px; list-style-type: inherit;">
<form name="callcenter_consumer_declined_offers" id="callcenter_consumer_declined_offers" method="post" action="<?php echo $base_href; ?>/_api/send_offers.php">
	<input type="hidden" name="vendor_id" value="<?php echo $form_config['vendor_id']; ?>" />
	<input type="hidden" name="application_id" value="<?php echo $callcenter_application_id; ?>" />
<?php
foreach ($callcenter_offer_definitions as $key => $value) {
?>
	<li>
		<strong><?php echo $value['title']; ?></strong>
		<ul>
			<li><?php echo $value['description']; ?></li>
			<li><input id="offer_consent_<?php echo $key; ?>" name="<?php echo $key; ?>" type="checkbox" value="CERTIFIED" /><?php echo $value['certification_statement']; ?></li>
		</ul>
	</li>
<?php
}
?>
	<li><input type="submit" value="Send Offers" /></li>
</form>
</ul>