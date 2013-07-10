<?php
$APP_URL = "/_callcenter";
?>
<!DOCTYPE html>
<html lang="us">
<head>
	<meta charset="UTF-8" />
	
	<title>Test - Toolbar</title>
	
	<link type="text/css" rel="stylesheet" href="<?php echo $APP_URL; ?>/css/cupertino/jquery-ui-1.10.2.custom.css" />
	
	<script type="text/javascript" src="<?php echo $APP_URL; ?>/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="<?php echo $APP_URL; ?>/js/jquery-ui-1.10.2.custom.js"></script>
	
	<style type="text/css">
	#logout-link {
		padding: 0.4em 1.0em 0.4em 20px;
		text-decoration: none;
		position: relative;
	}
	
	#logout-link span.ui-icon {
		margin: 0px 5px 0px 0px;
		position: absolute;
		left: 0.2em;
		top: 50%;
		margin-top: -8px;
	}
	</style>
</head>
<body>
	<div id="toolbar" class="ui-widget-header ui-corner-all">
		<p><a id="logout-link" href="<?php echo $APP_URL; ?>/logout.php" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowreturnthick-1-e"></span>Logout</a></p>
	</div>
</body>