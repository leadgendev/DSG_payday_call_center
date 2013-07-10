<?php
// after a form submission, this is the page that gets displayed if the lead was declined by the lender

function double_play_offer_link()
{
	global $form_config;
	
	$offer_link = 'http://track.thewebgemnetwork.com/aff_c?offer_id=1301&aff_id=3903';
	
	$offer_link .= '&aff_sub=' . urlencode($form_config['affid']);

	$offer_link .= '&first_name=' . urlencode($_POST['first_name']);
	$offer_link .= '&last_name=' . urlencode($_POST['last_name']);
	$offer_link .= '&street_addr1=' . urlencode($_POST['street_addr1']);
	$offer_link .= '&city=' . urlencode($_POST['city']);
	$offer_link .= '&state=' . urlencode($_POST['state']);
	$offer_link .= '&zip=' . urlencode($_POST['zip']);
	//$offer_link .= '&phone_home=' . urlencode($_POST['HomePhone']);
	$offer_link .= '&email=' . urlencode($_POST['email']);
	//$offer_link .= '&bank_aba=' . urlencode($_POST['BankRoutingNumber']);
	//$offer_link .= '&bank_account=' . urlencode($_POST['BankAccountNumber']);
	
	return $offer_link;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Payday Loan Application Declined - <?php echo $form_config['vendor_id']; ?></title>
	<link href="/callcenter/css/reset.css" type="text/css" rel="stylesheet" />
	<link href="/callcenter/css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/callcenter/js/jquery.1.3.2-min.js"></script>
<?php
if ($form_config['offer_on_decline']) {
?>
	<script type="text/javascript">
	$(document).ready(function () {
		$('#offer_link').hide();
		
		$('#offer_link_consent').click(function () {
			var checked = $(this).attr('checked');
			console.log('offer_link_consent.checked = ' + checked);
			if (checked) {
				$('#offer_link').show();
			} else {
				$('#offer_link').hide();
			}
		});
	});
	</script>
<?php
}
?>
</head>
<body>
	<?php require_once('analyticstracking.php'); ?>
	<div id="cc_wrapper">
		<h1>The Lead Application Was Declined by the Lender</h1>
		<ul style="margin: 0 0 15px 15px; list-style-type: inherit;">
			<li>The lender declined this lead's application for a loan</li>
			<li>The specific reason for the declined response is NOT made known to us</li>
<?php
//if ($form_config['offer_on_decline']) {
if (FALSE) {
?>
			<li>The following information <strong>WILL</strong> be prepopulated in the next form for another offer:
				<ul>
					<li><strong>First Name:</strong> <?php echo $_POST['first_name']; ?></li>
					<li><strong>Last Name:</strong> <?php echo $_POST['last_name']; ?></li>
					<li><strong>Street Address:</strong> <?php echo $_POST['street_addr1']; ?></li>
					<li><strong>City:</strong> <?php echo $_POST['city']; ?></li>
					<li><strong>State:</strong> <?php echo $_POST['state']; ?></li>
					<li><strong>Zip Code:</strong> <?php echo $_POST['zip']; ?></li>
					<li><strong>Email:</strong> <?php echo $_POST['email']; ?></li>
				</ul>
			</li>
			<li>The following information <strong>CANNOT</strong> be prepopulated in the next form, <strong>MAKE NOTE OF IT NOW</strong> so that you may manually enter it into the form:
				<ul>
					<li><strong>Primary Phone:</strong> <?php echo $_POST['phone_home']; ?></li>
					<li><strong>ABA/Routing Number:</strong> <?php echo $_POST['bank_aba']; ?></li>
					<li><strong>Check Account Number:</strong> <?php echo $_POST['bank_account']; ?></li>
				</ul>
			</li>
			<li><strong>Indicate that you have received verbal confirmation</strong> from the customer to apply for this offer by checking the box below.</li>
			<li><input id="offer_link_consent" type="checkbox" /> I certify that I have received consent from the customer to apply for the Business Gold Advantage offer.</li>
			<li id="offer_link">Please follow this link for another offer for this lead: <a href="<?php echo double_play_offer_link(); ?>">Business Gold Advantage</a></li>
<?php
}
?>
		</ul>
		
		<h1>Ask the consumer if they would like to receive an e-mail about the following offers:</h1>
		<div id="offers_wrapper">
<?php
if ($form_config['offer_on_decline']) {
	require_once('callcenter_consumer_declined_offers.php');
}
?>
		</div>
	</div>
</body>