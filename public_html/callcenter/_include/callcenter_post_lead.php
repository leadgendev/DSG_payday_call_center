<?php
// contains function(s) to post lead data to Lead Capsule

function callcenter_post_lead()
{
	$response = NULL;
	
	$post_url = 'http://datastream.leadcapsule.com/Leads/LeadPost.aspx';
	
	$post_data = array(
		'CampaignId' => $_POST['CampaignId'],
		'IsTest' => $_POST['IsTest'],
		'Timestamp' => $_POST['Timestamp'],
		'affid' => $_POST['affid'],
		'MilitaryActive' => $_POST['is_military'],
		'DirectDeposit' => $_POST['direct_deposit'],
		'IncomeType' => $_POST['income_type'],
		'AmountRequested' => $_POST['requested_amount'],
		'FirstName' => $_POST['first_name'],
		'LastName' => $_POST['last_name'],
		'Address1' => $_POST['street_addr1'],
		'Address2' => $_POST['street_addr2'],
		'City' => $_POST['city'],
		'State' => $_POST['state'],
		'Zip' => $_POST['zip'],
		'AddressLengthMonths' => $_POST['months_at_address'],
		'AddressType' => $_POST['home_owner'],
		'HomePhone' => $_POST['phone_home'],
		'CellPhone' => $_POST['phone_cell'],
		'Email' => $_POST['email'],
		'DriversLicenseNumber' => $_POST['drivers_license'],
		'DriversLicenseState' => $_POST['drivers_license_st'],
		'Employer' => $_POST['employer_name'],
		'WorkPhone' => $_POST['phone_work'],
		'WorkPhoneExtension' => $_POST['phone_work_ext'],
		'EmployedLengthMonths' => $_POST['months_employed'],
		'PayFrequency' => $_POST['pay_frequency'],
		'LastPayCheck' => $_POST['last_pay_check'],
		'GrossMonthlyIncome' => $_POST['income_monthly'],
		'BankName' => $_POST['bank_name'],
		'BankLengthMonths' => $_POST['months_at_bank'],
		'BankAccountType' => $_POST['bank_account_type'],
		'BankRoutingNumber' => $_POST['bank_aba'],
		'BankAccountNumber' => $_POST['bank_account'],
		'DateOfBirth' => $_POST['birth_date'],
		'NextPayDate' => $_POST['pay_day1'],
		'SecondPayDate' => $_POST['pay_day2'],
		'Social' => $_POST['social_security'],
		'IPAddress' => $_POST['client_ip_address']
	);
	
	$post_str = '';
	foreach ($post_data as $key => $value) {
		$post_str .= $key . '=' . urlencode($value) . '&';
	}
	
	$curl_session = curl_init($post_url);
	curl_setopt($curl_session, CURLOPT_POST, 1);
	curl_setopt($curl_session, CURLOPT_POSTFIELDS, $post_str);
	curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, TRUE);
	
	$response = curl_exec($curl_session);
	curl_close($curl_session);
	
	$response = explode('<?xml version="1.0" encoding="utf-8"?>', $response);
	$response = $response[1];
	
	return $response;
}
?>