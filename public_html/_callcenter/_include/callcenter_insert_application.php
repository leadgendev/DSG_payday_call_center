<?php
require_once('database.php');

function callcenter_insert_application()
{
	$application_id = NULL;
	
	$dbh = open_db();
	
	$sql = "INSERT INTO applications (CampaignId, affid, is_military, direct_deposit, income_type, requested_amount, first_name, last_name, street_addr1, street_addr2, city, state, zip, months_at_address, home_owner, phone_home, phone_cell, email, ssn, bday_month, bday_day, bday_year, drivers_license, drivers_license_st, employer_name, phone_work, phone_work_ext, months_employed, pay_frequency, pay_date1, pay_date2, last_pay_check, bank_name, months_at_bank, bank_account_type, bank_aba, bank_account, income_monthly, client_ip_address) VALUES (:CampaignId, :affid, :is_military, :direct_deposit, :income_type, :requested_amount, :first_name, :last_name, :street_addr1, :street_addr2, :city, :state, :zip, :months_at_address, :home_owner, :phone_home, :phone_cell, :email, :ssn, :bday_month, :bday_day, :bday_year, :drivers_license, :drivers_license_st, :employer_name, :phone_work, :phone_work_ext, :months_employed, :pay_frequency, :pay_date1, :pay_date2, :last_pay_check, :bank_name, :months_at_bank, :bank_account_type, :bank_aba, :bank_account, :income_monthly, :client_ip_address)";
	
	$stmt = $dbh->prepare($sql);
	
	$stmt->bindValue(':CampaignId', $_POST['CampaignId']);
	$stmt->bindValue(':affid', $_POST['affid']);
	$stmt->bindValue(':is_military', $_POST['is_military']);
	$stmt->bindValue(':direct_deposit', 
		($_POST['direct_deposit'] == 'No') ? 0 : 1);
	$stmt->bindValue(':income_type', $_POST['income_type']);
	$stmt->bindValue(':requested_amount', $_POST['requested_amount']);
	$stmt->bindValue(':first_name', $_POST['first_name']);
	$stmt->bindValue(':last_name', $_POST['last_name']);
	$stmt->bindValue(':street_addr1', $_POST['street_addr1']);
	$stmt->bindValue(':street_addr2', $_POST['street_addr2']);
	$stmt->bindValue(':city', $_POST['city']);
	$stmt->bindValue(':state', $_POST['state']);
	$stmt->bindValue(':zip', $_POST['zip']);
	$stmt->bindValue(':months_at_address', $_POST['months_at_address']);
	$stmt->bindValue(':home_owner',
		($_POST['home_owner'] == 'Rent') ? 0 : 1);
	$stmt->bindValue(':phone_home', $_POST['phone_home']);
	$stmt->bindValue(':phone_cell', $_POST['phone_cell']);
	$stmt->bindValue(':email', $_POST['email']);
	$stmt->bindValue(':ssn',
		encrypt_db($_POST['social_security']));
	$stmt->bindValue(':bday_month', $_POST['bday_month']);
	$stmt->bindValue(':bday_day', $_POST['bday_day']);
	$stmt->bindValue(':bday_year', $_POST['bday_year']);
	$stmt->bindValue(':drivers_license', $_POST['drivers_license']);
	$stmt->bindValue(':drivers_license_st', $_POST['drivers_license_st']);
	$stmt->bindValue(':employer_name', $_POST['employer_name']);
	$stmt->bindValue(':phone_work', $_POST['phone_work']);
	$stmt->bindValue(':phone_work_ext', $_POST['phone_work_ext']);
	$stmt->bindValue(':months_employed', $_POST['months_employed']);
	$stmt->bindValue(':pay_frequency', $_POST['pay_frequency']);
	
	//$stmt->bindValue(':pay_date1', $_POST['pay_day1']);
	$pay_day1 = explode('/', $_POST['pay_day1']);
	$pay_date1 = sprintf("%04u-%02u-%02u", $pay_day1[2], $pay_day1[0], $pay_day1[1]);
	$stmt->bindValue(':pay_date1', $pay_date1);
	//$stmt->bindValue(':pay_date2', $_POST['pay_day2']);
	$pay_day2 = explode('/', $_POST['pay_day2']);
	$pay_date2 = sprintf("%04u-%02u-%02u", $pay_day2[2], $pay_day2[0], $pay_day2[1]);
	$stmt->bindValue(':pay_date2', $pay_date2);
	
	$stmt->bindValue(':last_pay_check', $_POST['last_pay_check']);
	$stmt->bindValue(':bank_name', $_POST['bank_name']);
	$stmt->bindValue(':months_at_bank', $_POST['months_at_bank']);
	$stmt->bindValue(':bank_account_type',
		($_POST['bank_account_type'] == 'S') ? 'SAVINGS' : 'CHECKING');
	$stmt->bindValue(':bank_aba', $_POST['bank_aba']);
	$stmt->bindValue(':bank_account',
		encrypt_db($_POST['bank_account']));
	$stmt->bindValue(':income_monthly', $_POST['income_monthly']);
	$stmt->bindValue(':client_ip_address', $_POST['client_ip_address']);
	
	$stmt->execute();
	//print_r($dbh->errorCode());
	//print_r($dbh->errorInfo());
	//print_r($stmt->errorCode());
	//print_r($stmt->errorInfo());
	$application_id = $dbh->lastInsertId();
	
	$stmt->closeCursor();
	$stmt = NULL;
	$dbh = NULL;
	
	return $application_id;
}

?>