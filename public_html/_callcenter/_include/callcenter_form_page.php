<?php
// callcenter/_include/callcenter_form_page.php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Payday Loan Application - <?php echo $form_config['vendor_id']; ?></title>
	<link href="<?php echo $base_href; ?>/css/reset.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo $base_href; ?>/css/style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo $base_href; ?>/js/jquery.1.3.2-min.js"></script>
	<script type="text/javascript" src="<?php echo $base_href; ?>/js/payday2.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
			/* use a function for the exact format desired... */
			function ISODateString(d){
				function pad(n){return n<10 ? '0'+n : n}
				return d.getUTCFullYear()+'-'
				  + pad(d.getUTCMonth()+1)+'-'
				  + pad(d.getUTCDate())+'T'
				  + pad(d.getUTCHours())+':'
				  + pad(d.getUTCMinutes())+':'
				  + pad(d.getUTCSeconds())+'Z'
			  }
			var d = new Date();
			var ts = ISODateString(d);
			$("#Timestamp").val(ts);
	 });	

	</script>
	<!-- Eliminate any double-click on submit issues -->
	<script type="text/javascript">
	$(document).ready(function () {
		$('form#lf_app_form').submit(function () {
			$('input.lf_app_submit').hide();
			return true;
		});
	});
	</script>
</head>
<body>
	<div id="cc_wrapper">
		<form name="HomeForm" id="lf_app_form" action="<?php echo $_SERVER['PHP_SELF']; ?>"
		method="post">
		<!-- /// #################### Configuration Start #################### //-->
		<input type="hidden" id="CampaignId" name="CampaignId" value="<?php echo $form_config['CampaignId']; ?>" />
		<input type="hidden" id="affid" name="affid" value="<?php echo $form_config['affid']; ?>" />
		
		<input type="hidden" id="IsTest" name="IsTest" value="false" />
		
		<!-- /// #################### Configuration End #################### //-->
		<h1>
			Before we get started with your application, you will need to have the following
			information handy.</h1>
		<ul style="margin: 0 0 15px 15px; list-style-type: inherit;">
			<li>Your bank routing information and account number</li>
			<li>Your email address</li>
			<li>Your drivers license or state issued ID</li>
		</ul>
		<div class="cc_step" style="margin-top: 40px;">
			<ol>
				<li><span>Are you active military? (or dependent)</span>
					<label for="is_military">
						*Active military? (or dependent)</label>
					<select id="is_military" name="is_military" tabindex="5">
						<option selected="selected" value="">-Select-</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
					<img id="is_military_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>Do you receive your pay by paper check or direct deposit?</span>
					<label for="direct_deposit">
						*Direct Deposit?</label>
					<select id="direct_deposit" name="direct_deposit" tabindex="10" style="width: 250px">
						<option selected="selected" value="">-Select-</option>
						<option value="Yes">Electronic Deposit into Bank Account</option>
						<option value="No">Paper Check from Employer</option>
					</select>
					<img id="direct_deposit_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your source of Income?</span>
					<label for="income_type">
						*Source of Income?</label>
					<select id="income_type" name="income_type" tabindex="15" style="width: 105px">
						<option value="">-Select-</option>
						<option value="EMPLOYMENT">Employment</option>
						<option value="BENEFITS">Benefits</option>
					</select>
					<img id="income_type_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need to know how I receive my paycheck?</p>
						R: In order to ensure that your lender can send money directly to your account, they
						need to know if you are set up for automatic deposit of your pay. </li>
					<li>
						<p class="objection">
							O: Why do you need any of this information to apply for a loan?</p>
						R: In order to present a complete application to our lender network, they require
						this information to be filled out and your bank account will be used to deposit
						funds into your account. </li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is the minimum amount you would like to borrow?</span>
					<label for="requested_amount">
						*Minimum Loan Amount</label>
					<select id="requested_amount" name="requested_amount" tabindex="20" style="width: 130px;">
						<option value="">-Select-</option>
						<option value="100">$100.00</option>
						<option value="200">$200.00</option>
						<option value="300">$300.00</option>
						<option value="400">$400.00</option>
						<option value="500">$500.00</option>
						<option value="600">$600.00</option>
						<option value="700">$700.00</option>
						<option value="800">$800.00</option>
						<option value="900">$900.00</option>
						<option value="1000">$1000.00</option>
						<option value="1100">$1100.00</option>
						<option value="1200">$1200.00</option>
						<option value="1300">$1300.00</option>
						<option value="1400">$1400.00</option>
						<option value="1500">$1500.00</option>
					</select>
					<img id="requested_amount_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your first name?</span>
					<label for="first_name">
						*First Name</label>
					<input type="text" maxlength="35" id="first_name" name="first_name" tabindex="25"
						style="width: 125px" />
					<img id="first_name_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your last name?</span>
					<label for="last_name">
						*Last Name</label>
					<input type="text" maxlength="35" id="last_name" name="last_name" tabindex="30" style="width: 125px" />
					<img id="last_name_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: How much money should I try to borrow?</p>
						R: We recommend applying for $500 in order to be matched with the most lenders -
						greatly increasing your chances of getting approved for your loan today. </li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is your address? (PO Box addresses are not permitted)</span>
					<ul>
						<li>
							<label for="street_addr1">
								*Street Address</label>
							<input type="text" maxlength="50" id="street_addr1" name="street_addr1" tabindex="35"
								style="width: 125px" />
							<img id="street_addr1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
						</li>
						<li>
							<label for="street_addr2">
								Apartment #</label>
							<input type="text" maxlength="50" id="street_addr2" name="street_addr2" tabindex="40"
								style="width: 50px" />
							<img id="street_addr2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
						</li>
					</ul>
				</li>
				<li><span>What city do you live in?</span>
					<label for="city">
						*City</label>
					<input type="text" maxlength="35" id="city" name="city" tabindex="45" style="width: 125px" />
					<img id="city_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<label>
						*State</label>
					<select id="state" name="state" tabindex="46">
						<option value="">-Select-</option>
						<option value="AK">AK</option>
						<option value="AL">AL</option>
						<option value="AR">AR</option>
						<option value="AZ">AZ</option>
						<option value="CA">CA</option>
						<option value="CO">CO</option>
						<option value="CT">CT</option>
						<option value="DC">DC</option>
						<option value="DE">DE</option>
						<option value="FL">FL</option>
						<option value="GA">GA</option>
						<option value="HI">HI</option>
						<option value="IA">IA</option>
						<option value="ID">ID</option>
						<option value="IL">IL</option>
						<option value="IN">IN</option>
						<option value="KS">KS</option>
						<option value="KY">KY</option>
						<option value="LA">LA</option>
						<option value="MA">MA</option>
						<option value="MD">MD</option>
						<option value="ME">ME</option>
						<option value="MI">MI</option>
						<option value="MN">MN</option>
						<option value="MO">MO</option>
						<option value="MS">MS</option>
						<option value="MT">MT</option>
						<option value="NC">NC</option>
						<option value="ND">ND</option>
						<option value="NE">NE</option>
						<option value="NH">NH</option>
						<option value="NJ">NJ</option>
						<option value="NM">NM</option>
						<option value="NV">NV</option>
						<option value="NY">NY</option>
						<option value="OH">OH</option>
						<option value="OK">OK</option>
						<option value="OR">OR</option>
						<option value="PA">PA</option>
						<option value="RI">RI</option>
						<option value="SC">SC</option>
						<option value="SD">SD</option>
						<option value="TN">TN</option>
						<option value="TX">TX</option>
						<option value="UT">UT</option>
						<option value="VA">VA</option>
						<option value="VT">VT</option>
						<option value="WA">WA</option>
						<option value="WI">WI</option>
						<option value="WV">WV</option>
						<option value="WY">WY</option>
					</select>
					<img id="state_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<label for="city">
						*Zip Code</label>
					<input type="text" maxlength="5" id="zip" name="zip" tabindex="47" style="width: 125px" />
					<img id="zip_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>How many months have you lived at your address?</span>
					<label for="months_at_address">
						*Months at address?</label>
					<select id="months_at_address" name="months_at_address" tabindex="50">
						<option value="">-Select-</option>
						<option value="1">1 month</option>
						<option value="2">2 months</option>
						<option value="3">3 months</option>
						<option value="6">4 to 6 months</option>
						<option value="12">7 to 12 months</option>
						<option value="24">More than 1 year</option>
					</select>
					<img id="months_at_address_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>Are you a home owner?</span>
					<label for="home_owner">
						*Home owner?</label>
					<select id="home_owner" name="home_owner" tabindex="51">
						<option value="">-Select-</option>
						<option value="Rent">No</option>
						<option value="Own">Yes</option>
					</select>
					<img id="home_owner_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need to know how long I've lived at my address?</p>
						R: The criteria for getting a loan varies from lender to lender. Some lenders require
						a longer time at your current residence, and others do not have requirements for
						this. </li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is the best phone number at which you can be reached?</span>
					<label>
						*Home Phone</label>
					<input type="text" maxlength="3" id="phone_home1" name="phone_home1" tabindex="55" style="width: 25px" />
					<img id="phone_home1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="3" id="phone_home2" name="phone_home2" tabindex="60" style="width: 25px" />
					<img id="phone_home2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="4" id="phone_home3" name="phone_home3" tabindex="65" style="width: 35px" />
					<img id="phone_home3_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>Is there a second number at which you can be reached?</span>
					<label>
						Cell Phone</label>
					<input type="text" maxlength="3" id="phone_cell1" name="phone_cell1" tabindex="70" style="width: 25px" />
					<img id="phone_cell1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="3" id="phone_cell2" name="phone_cell2" tabindex="75" style="width: 25px" />
					<img id="phone_cell2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="4" id="phone_cell3" name="phone_cell3" tabindex="80" style="width: 35px" />
					<img id="phone_cell3_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your email address?</span>
					<label for="email">
						*Email</label>
					<input type="text" maxlength="50" id="email" name="email" tabindex="85" style="width: 200px" />                    
					<img id="email_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<br />
					<label for="email_verify">
						*Verify Email</label>
					<input type="text" maxlength="50" id="email_verify" name="email_verify" tabindex="90"
						style="width: 200px" />                    
					<img id="email_verify_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: I don't have an email address?</p>
						R: An email address is required - so that if you are matched with a lender - they
						can reach you. Please call back when you have an email address. </li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is your Social Security Number?</span>
					<label>
						*Social Security #</label>
					<input type="text" maxlength="3" id="ssn1" name="ssn1" tabindex="95" style="width: 25px" />
					<img id="ssn1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="2" id="ssn2" name="ssn2" tabindex="100" style="width: 20px" />
					<img id="ssn2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<input type="text" maxlength="4" id="ssn3" name="ssn3" tabindex="105" style="width: 35px" />
					<img id="ssn3_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your date of birth?</span>                    
					<label for="bday_month">
						*DOB</label>
					<select id="bday_month" name="bday_month" tabindex="106">
						<option value="">Month</option>
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
					<img id="bday_month_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />                   
					<select id="bday_day" name="bday_day" tabindex="107">
						<option value="">Day</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<img id="bday_day_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />               
						<select id="bday_year" name="bday_year" tabindex="108">
						</select>                    
					<img id="bday_year_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your Driver's License or State ID #?</span>
					<label for="drivers_license">
						*Driver's License/State ID #</label>
					<input type="text" maxlength="25" id="drivers_license" name="drivers_license" tabindex="110"
						style="width: 125px" />
					<img id="drivers_license_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>In what state?</span>
					<label for="drivers_license_st">
						*ID State</label>
					<select id="drivers_license_st" name="drivers_license_st" tabindex="115">
						<option value="">-Select-</option>
						<option value="AK">AK</option>
						<option value="AL">AL</option>
						<option value="AR">AR</option>
						<option value="AZ">AZ</option>
						<option value="CA">CA</option>
						<option value="CO">CO</option>
						<option value="CT">CT</option>
						<option value="DC">DC</option>
						<option value="DE">DE</option>
						<option value="FL">FL</option>
						<option value="GA">GA</option>
						<option value="HI">HI</option>
						<option value="IA">IA</option>
						<option value="ID">ID</option>
						<option value="IL">IL</option>
						<option value="IN">IN</option>
						<option value="KS">KS</option>
						<option value="KY">KY</option>
						<option value="LA">LA</option>
						<option value="MA">MA</option>
						<option value="MD">MD</option>
						<option value="ME">ME</option>
						<option value="MI">MI</option>
						<option value="MN">MN</option>
						<option value="MO">MO</option>
						<option value="MS">MS</option>
						<option value="MT">MT</option>
						<option value="NC">NC</option>
						<option value="ND">ND</option>
						<option value="NE">NE</option>
						<option value="NH">NH</option>
						<option value="NJ">NJ</option>
						<option value="NM">NM</option>
						<option value="NV">NV</option>
						<option value="NY">NY</option>
						<option value="OH">OH</option>
						<option value="OK">OK</option>
						<option value="OR">OR</option>
						<option value="PA">PA</option>
						<option value="RI">RI</option>
						<option value="SC">SC</option>
						<option value="SD">SD</option>
						<option value="TN">TN</option>
						<option value="TX">TX</option>
						<option value="UT">UT</option>
						<option value="VA">VA</option>
						<option value="VT">VT</option>
						<option value="WA">WA</option>
						<option value="WI">WI</option>
						<option value="WV">WV</option>
						<option value="WY">WY</option>
					</select>
					<img id="drivers_license_st_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need my Social Security Number?</p>
						R: This information is required to process your application for a payday loan. We
						use it to verify your identity. </li>
					<li>
						<p class="objection">
							O: Why do you need my date of birth?</p>
						R: This information is required to process your application for a payday loan. We
						use it to verify your identity. </li>
					<li>
						<p class="objection">
							O: Why do you need my driver's license number?</p>
						R: This information is used to verify that you are a resident of your state.
					</li>
					<li>
						<p class="objection">
							O: Is this a secure process?</p>
						R: Payday Loan Application has implemented measures to prevent unauthorized access
						and improper use of the information we collect. To read our complete Privacy Policy
						please visit (website address) for further details. </li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is the name of your employer?</span>
					<label for="employer_name">
						*Employer</label>
					<input type="text" maxlength="35" id="employer_name" name="employer_name" tabindex="120"
						style="width: 125px" />
					<img id="employer_name_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your employer's phone number?</span>
					<ul>
						<li>
							<label>
								*Employer Phone</label>
							<input type="text" maxlength="3" id="phone_work1" name="phone_work1" tabindex="125" style="width: 25px" />
							<img id="phone_work1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
							<input type="text" maxlength="3" id="phone_work2" name="phone_work2" tabindex="130" style="width: 25px" />
							<img id="phone_work2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
							<input type="text" maxlength="4" id="phone_work3" name="phone_work3" tabindex="135" style="width: 35px" />
							<img id="phone_work3_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
						</li>
						<li>
							<label for="phone_work_ext">
								Extension</label>
							<input type="text" maxlength="5" id="phone_work_ext" name="phone_work_ext" tabindex="140"
								style="width: 50px" />
							<img id="phone_work_ext_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
								class="lf_img_error" />
						</li>
					</ul>
				</li>
				<li><span>How many months have you been with your employer?</span>
					<label for="months_employed">
						*Months Employed?</label>
					<select id="months_employed" name="months_employed" tabindex="145">
						<option value="">-Select-</option>
						<option value="1">1 month</option>
						<option value="2">2 months</option>
						<option value="3">3 months</option>
						<option value="6">4 to 6 months</option>
						<option value="12">7 to 12 months</option>
						<option value="24">More than 1 year</option>
					</select>
					<img id="months_employed_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need to know where I work?</p>
						R: We ask for employer information for identification purposes. </li>
					<li>
						<p class="objection">
							O: Why do you need my work phone number?</p>
						R: We ask for employer telephone number for identification purposes. </li>
					<li>
						<p class="objection">
							O: Why do you need to know how long I've worked there?</p>
						R: The criteria for getting a loan varies from lender to lender. Some lenders require
						a longer time at your current job, and others do not have any requirements for this.
					</li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>How often do you receive a paycheck?</span>
					<label for="pay_frequency">
						*How often are you paid?</label>
					<select id="pay_frequency" name="pay_frequency" tabindex="150" style="width: 120px">
						<option selected="selected" value="">-Select-</option>
						<option value="WEEKLY">Weekly</option>
						<option value="BIWEEKLY">Every 2 weeks</option>
						<option value="TWICEMONTH">Twice a Month</option>
						<option value="MONTHLY">Monthly</option>
					</select>
					<img id="pay_frequency_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What are your next two pay dates?</span>
					<label for="pay_date1">
						*Pay Date One (mm/dd/yyyy)</label>
					<input type="text" maxlength="10" id="pay_date1" name="pay_date1" tabindex="155" style="width: 75px;"
						disabled="disabled" />
					<img id="pay_date1_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<img id="pay_date1_trigger" src="<?php echo $base_href; ?>/images/calendar.gif" alt="Calendar" style="width: 21px !important;
						height: 21px !important;" />
					<label for="pay_date2">
						*Pay Date Two (mm/dd/yyyy)</label>
					<input type="text" maxlength="10" id="pay_date2" name="pay_date2" tabindex="160" style="width: 75px;"
						disabled="disabled" />
					<img id="pay_date2_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
					<img id="pay_date2_trigger" src="<?php echo $base_href; ?>/images/calendar.gif" alt="Calendar" style="width: 21px !important;
						height: 21px !important;" />
					<div id="lf_pay_calendar" style="display: none">
						<table>
							<tr>
								<td>
									<table id="lf_cal1" class="lf_cal_table">
										<caption>
										</caption>
										<tbody>
											<tr>
												<th>
													S
												</th>
												<th>
													M
												</th>
												<th>
													T
												</th>
												<th>
													W
												</th>
												<th>
													T
												</th>
												<th>
													F
												</th>
												<th>
													S
												</th>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
									<table id="lf_cal2" class="lf_cal_table">
										<caption>
										</caption>
										<tbody>
											<tr>
												<th>
													S
												</th>
												<th>
													M
												</th>
												<th>
													T
												</th>
												<th>
													W
												</th>
												<th>
													T
												</th>
												<th>
													F
												</th>
												<th>
													S
												</th>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td>
									<table id="lf_cal3" class="lf_cal_table">
										<caption>
										</caption>
										<tbody>
											<tr>
												<th>
													S
												</th>
												<th>
													M
												</th>
												<th>
													T
												</th>
												<th>
													W
												</th>
												<th>
													T
												</th>
												<th>
													F
												</th>
												<th>
													S
												</th>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
						<input type="button" name="Close" onclick="lf.HideCalender(); return false;" value="Close Calendar" />
					</div>
					<! -- End calendars -- > </li>
				<li><span>What was the amount of your last paycheck?</span>
					<label for="last_pay_check">
						*Amount of Last Paycheck:</label>
					<select tabindex="165" id="last_pay_check" name="last_pay_check">
						<option value="">-Select-</option>
						<option value="499">Less than $500</option>
						<option value="750">$500-$750</option>
						<option value="1000">$751-$1000</option>
						<option value="1250">$1001-$1250</option>
						<option value="1500">$1251-$1500</option>
						<option value="1750">$1501-$1750</option>
						<option value="2000">$1751-$2000</option>
						<option value="2250">$2001-$2250</option>
						<option value="2500">$2251-$2500</option>
						<option value="2750">$2501-$2750</option>
						<option value="3000">$2751-$3000</option>
						<option value="3250">$3001-$3250</option>
						<option value="3500">$3251-$3500</option>
						<option value="3750">$3501-$3750</option>
						<option value="4000">$3751-$4000</option>
						<option value="4250">$4001-$4250</option>
						<option value="4500">$4251-$4500</option>
						<option value="4750">$4501-$4750</option>
						<option value="5000">$4751-$5000</option>
						<option value="5001">More than $5000</option>
					</select>
					<img id="last_pay_check_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need to know when I get paid?</p>
						R: We collect pay dates so that we can verify that you receive your pay by direct
						deposit. </li>
					<li>
						<p class="objection">
							O: Why do you need to know how much I get paid?</p>
						R: This information is used to determine how much you are eligible to receive.
					</li>
				</ul>
			</div>
		</div>
		<div class="cc_step">
			<ol>
				<li><span>What is the name of your bank?</span>
					<label for="bank_name">
						*Bank Name</label>
					<input type="text" maxlength="30" id="bank_name" name="bank_name" tabindex="170"
						style="width: 125px" />
					<img id="bank_name_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>How many months have you been with your bank?</span>
					<label for="months_at_bank">
						*Months with Bank Account</label>
					<select id="months_at_bank" name="months_at_bank" tabindex="175">
						<option value="">-Select- </option>
						<option value="1">1 month</option>
						<option value="2">2 months</option>
						<option value="3">3 months</option>
						<option value="6">4 to 6 months</option>
						<option value="12">7 to 12 months</option>
						<option value="24">More than 1 year</option>
					</select>
					<img id="months_at_bank_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What type of account do you have?</span>
					<label for="bank_account_type">
						*Account Type</label>
					<select id="bank_account_type" name="bank_account_type" tabindex="176">
						<option value="">-Select- </option>
						<option value="C">Checking</option>
						<option value="S">Savings</option>
					</select>
					<img id="bank_account_type_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li>
                <img alt="Check" src="<?php echo $base_href; ?>/images/check-image.png" class="checkImage">
                <span>What is the ABA/Routing Number for your account?</span>
					<label for="bank_aba">
						*ABA/Routing Number</label>
					<input type="text" maxlength="9" id="bank_aba" name="bank_aba" tabindex="180" style="width: 125px" />
					<img id="bank_aba_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li><span>What is your account number?</span>
					<label for="bank_account">
						Account Number</label>
					<input type="text" maxlength="18" id="bank_account" name="bank_account" tabindex="185"
						style="width: 125px" />
					<img id="bank_account_img" src="<?php echo $base_href; ?>/images/exclamation.gif" alt="Error" style="display: none;"
						class="lf_img_error" />
				</li>
				<li>
					<input type="button" class="lf_app_submit" value=" " onclick="lf.submitForm();" tabindex="250"
						title="Submit Form" style="width: 393px; height: 71px; margin-top: 20px; background: url(<?php echo $base_href; ?>/images/submit.gif);
						padding: 0; border: none;" />
				</li>
			</ol>
			<div class="or_sidebar">
				<h3>
					Objections &amp; Rebuttals</h3>
				<ul>
					<li>
						<p class="objection">
							O: Why do you need my bank account information?</p>
						R: Once approved, your lender uses this information to send you the money. </li>
					<li>
						<p class="objection">
							O: Why do you need to know how long I have been with my bank?</p>
						R: The criteria for getting a loan varies from lender to lender. Some lenders require
						that your bank account be open for a longer period of time, other do not care how
						long your account has been open. </li>
				</ul>
			</div>
			<!-- do not change any of the files below //-->
			<input type="hidden" id="birth_date" name="birth_date" />
			<input type="hidden" id="pay_day1" name="pay_day1" />
			<input type="hidden" id="pay_day2" name="pay_day2" />
			<input type="hidden" id="social_security" name="social_security" />
			<input type="hidden" id="phone_home" name="phone_home" />
			<input type="hidden" id="phone_cell" name="phone_cell" />
			<input type="hidden" id="phone_work" name="phone_work" />
			<input type="hidden" id="client_ip_address" name="client_ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
			
			<input type="hidden" id="income_monthly" name="income_monthly" value="0" />
			
			<input type="hidden" id="Timestamp" name="Timestamp" value="" />
		</div>
		</form>
	</div>
</body>
</html>