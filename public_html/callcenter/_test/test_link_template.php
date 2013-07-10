<?php
require_once('../_include/link_template.php');

$link_template = $_GET['link_template'];
unset($_GET['link_template']);

$link = process_link_template($link_template, $_GET);

echo "\n\n";
echo $link;
echo "\n\n";
?>