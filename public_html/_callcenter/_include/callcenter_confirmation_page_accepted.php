<?php
// after a form submission, this is the page that gets displayed if there was an internal server error or similar
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Payday Loan Application Accepted - <?php echo $form_config['vendor_id']; ?></title>
	<link href="/callcenter/css/reset.css" type="text/css" rel="stylesheet" />
	<link href="/callcenter/css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/callcenter/js/jquery.1.3.2-min.js"></script>
</head>
<body>
	<div id="cc_wrapper">
		<h1>The Lead's Application for a Loan Was Accepted by the Lender</h1>
		<ul style="margin: 0 0 15px 15px; list-style-type: inherit;">
<?php
if ($transfer_code == '') {
?>
			<li>Campaign ID: 2264</li>
			<li>Please call 701-862-2274 and give the operator the above Campaign ID to complete this conversion.</li>
<?php
} else {
?>
			<li>Application Transfer Code: <?php echo $transfer_code; ?></li>
			<li>Please call 855-852-7424 and give the operator the above transfer code to complete this conversion.</li>
<?php
}
?>
		</ul>
	</div>
</body>