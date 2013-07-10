<?php
// callcenter/_include/link_template.php

// processing facilities for link templates

function process_link_template($link_template, $link_subs)
{
	$pattern = '/\[@([a-zA-Z_]+[0-9a-zA-Z_]*)\]/';
	
	$link = '';
	$link .= $link_template;
	
	$regs = array();
	
	preg_match_all($pattern, $link, $regs, PREG_PATTERN_ORDER);
	
	//print_r($regs);
	
	foreach ($regs[0] as $key => $value) {
		$sub_symbol = $regs[1][$key];
		$sub_value = $link_subs[$sub_symbol];
		$sub_value = urlencode($sub_value);
		
		$sub_pattern = preg_quote($value);
		$sub_pattern = '/' . $sub_pattern . '/';
		
		$link = preg_replace($sub_pattern, $sub_value, $link);
	}
	
	return $link;
}
?>