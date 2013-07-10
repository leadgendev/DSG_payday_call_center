<?php
// after a form submission, this is the page that gets displayed if there was an internal server error or similar
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Payday Loan Application Error - <?php echo $form_config['vendor_id']; ?></title>
	<link href="/callcenter/css/reset.css" type="text/css" rel="stylesheet" />
	<link href="/callcenter/css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/callcenter/js/jquery.1.3.2-min.js"></script>
</head>
<body>
	<div id="cc_wrapper">
		<h1>An Error Occurred While Processing the Application</h1>
		<ul style="margin: 0 0 15px 15px; list-style-type: inherit;">
			<li>It is not possible to complete the application at this time</li>
			<li>Please contact the system administrator regarding this problem</li>
		</ul>
	</div>
</body>