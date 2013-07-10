/// <reference path="jquery.js"/>
// JScript File
var bAlert = true; //Uses the Browser Alert Box to Tell user about validation errors.
///    !!!DO NOT make any changes below this line!!!          ///
var lf = {}; //used as namespace to avoid conflicts
$(document).ready(function () {
    lf.bindEvents();
    lf.popDrops();
    lf.buildCalendars();
    lf.ConfigurePayDayTriggers();
});
/* validation functions */
lf.valReq = function valReq(obj, errorMsg, onValidFunction) {
    var sVal = lf.getTrimmedValue(obj)
    var isValid = false;
    if (sVal == "") {
        lf.setError(obj, errorMsg);
    }else {
        isValid = true;
        lf.clearError(obj);
        if (onValidFunction != undefined) {
            onValidFunction(obj);
        }
    }
    return isValid;
}
lf.valReg = function valReg(obj, regExp, errorMsg, onValidFunction) {
    var sVal = lf.getTrimmedValue(obj);
    if (sVal != '') {
        if (sVal.match(regExp) == null) {
            lf.setError(obj, errorMsg);
        }else {
            lf.clearError(obj);
            if (onValidFunction != undefined) {
                onValidFunction(obj);
            }
        }
    }else {//not enought to validate, just clear error
        lf.clearError(obj);
    }
}
lf.valDate = function valDate(obj, errorMsg, minDateDiff, minDateDiffError, onValidFunction) {
    //if you do not require a min date diff, pass 0 and '' for the error msg.
    var sDate = '';
    var objid;
    var isSelect = false;
    var isValid = false;
    if ($(obj).is('select')) {//multiple dropdowns make a date,
        //dropdown id should be XXXX_day for the day, XXXX_year...and so on
        isSelect = true;
        objid = lf.getCmbDateId(obj);
        sDate = lf.getCmbDate(obj);
    }else {
        sDate = $(obj).val();
    }
    if (sDate != '') {
        if (lf.isDate(sDate)) {
            if (minDateDiff != 0) { //validate min age.
                if (lf.isMinimunAge(sDate, minDateDiff)) {
                    isValid = true;
                } else {
                    errorMsg = minDateDiffError;
                }
            }
        }
        if (isValid) {
            if (isSelect) {
                lf.clearError($('#' + objid + '_month'));
                lf.clearError($('#' + objid + '_day'));
                lf.clearError($('#' + objid + '_year'));
            } else {
                lf.clearError(obj);
            }
                if (onValidFunction != undefined) {
                    onValidFunction(obj);
                }
        } else {
            if (isSelect) {
                lf.setError($('#' + objid + '_month'), errorMsg);
                lf.setError($('#' + objid + '_day'), errorMsg);
                lf.setError($('#' + objid + '_year'), errorMsg);
            } else {
                lf.setError(obj, errorMsg);
            }
        
        }
    }
}
lf.getCmbDateId = function getCmbDateId(obj) {
    var objid;
    var ic = $(obj).children().length; //item count
    switch (ic) {
        case 13: //month
            objid = $(obj).attr('id').replace('_month', '');
            break;
        case 32: //day
            objid = $(obj).attr('id').replace('_day', '');
            break;
        default: //year
            objid = $(obj).attr('id').replace('_year', '');
            break;
    }
    return objid;
}
lf.getCmbDate = function getCmbDate(obj) {
    //dropdown id should be XXXX_day for the day, XXXX_year...and so on
    var sDate = '';
    var m, d, y;
    var objid = lf.getCmbDateId(obj);
    m = $('#' + objid + '_month').val();
    d = $('#' + objid + '_day').val();
    y = $('#' + objid + '_year').val();
    if ((m != '') && (d != '') && (y != '')) { //have all values..validate
        sDate = m + '/' + d + '/' + y;
    }
    return sDate;
}
lf.valComp = function valComp(obj, compareID, errorMsg, onValidFunction) {
    var sVal = lf.getTrimmedValue(obj);
    var sCompVal = lf.getTrimmedValue($("#" + compareID));
  
    if (sVal != sCompVal) {
        lf.setError(obj, errorMsg);
    }else {
        lf.clearError(obj);
        if (onValidFunction != undefined) {
            onValidFunction(obj);
        }
    }
}
lf.valABA = function valABA(obj, errorMsg, onValidFunction) {
    var bIsValid = false;
    var sVal = lf.getTrimmedValue(obj);
	// Run through each digit and calculate the total.
	var c = 0;
	var i = 0;
	var n = 0;
	var t = "";
	try {
	    for (i = 0; i < sVal.length; i++) {
	        c = parseInt(sVal.charAt(i), 10);
			t = t + c;
		}


		if (t.length == 9)// pass 9 digit check
		{
		    // Now run through each digit and calculate the total.
		    n = 0;
		    for (i = 0; i < t.length; i += 3) {
		        n += (parseInt(t.charAt(i), 10) * 3) + (parseInt(t.charAt(i + 1), 10) * 7) + parseInt(t.charAt(i + 2), 10);
		    }
		    // If the resulting sum is an even multiple of ten (but not zero),
		    // the aba routing number is good.
		    bIsValid = (n != 0 && n % 10 == 0);
		}
	}
	catch(err) {
		//do nothing
	}
	if (bIsValid == false) {
	    lf.setError(obj, errorMsg);
	} else {
	    lf.clearError(obj);
	    if (onValidFunction != undefined) {
	        onValidFunction(obj);
	    }
	}
}
lf.setError = function setError(obj, errorMsg) {
    $(obj).attr('class', 'lf_error_control');
    $("#" + $(obj).attr('id') + "_img").attr('alt', errorMsg).attr('title', errorMsg).show();
}
lf.clearError = function clearError(obj) {
    $("#" + $(obj).attr('id') + "_img").hide();
    $(obj).removeAttr('class');
}
lf.submitForm = function submitForm() {
    lf.formValidate();
    if (lf.isFormValid() == true) {
        //do some data move
        var dt;
        dt = new Date($("#pay_date1").val());
        $("#pay_day1").val(lf.getFormattedDate(dt));
        dt = new Date($("#pay_date2").val());
        $("#pay_day2").val(lf.getFormattedDate(dt));
        dt = new Date(lf.getCmbDate($("#bday_day")));
        $("#birth_date").val(lf.getFormattedDate(dt));
        $("#income_monthly").val(lf.getMonthlyIncome());
        //simple moves
        $("#social_security").val($("#ssn1").val() + $("#ssn2").val() + $("#ssn3").val());
        $("#phone_home").val($("#phone_home1").val() + $("#phone_home2").val() + $("#phone_home3").val());
        $("#phone_work").val($("#phone_work1").val() + $("#phone_work2").val() + $("#phone_work3").val());
        $("#phone_cell").val($("#phone_cell1").val() + $("#phone_cell2").val() + $("#phone_cell3").val());
        $('#lf_app_form').submit();
    } else {
        if (bAlert){
            var sAlert = 'Please Correct the following:\n';
            $.each($('.lf_img_error:visible'), function(i, n) {
                if (i < 11){
                    sAlert += '\n' + $(n).attr('alt');
                }
                else{
                    sAlert += '\n\n' + 'We\'ve found too many errors...';
                    return false;
                }
            });
            alert(sAlert);
        }
    }
}
lf.formValidate = function formValidate() {
    $('#lf_app_form').find('input').blur();
    $('#lf_app_form').find('select').change();
    var ctlid = $('.lf_error_control:first').attr('id');
    if ((ctlid == 'pay_date1') || (ctlid == 'pay_date2')) {
        $('#pay_frequency').focus(); //pay frequency is the next 1 up, set to that one because dates are disabled
    } else {
        $('#' + ctlid).focus();
    }
}
lf.isFormValid = function isFormValid() {
    return ($('.lf_error_control').length == 0);
}
lf.getTrimmedValue = function getTrimmedValue(obj) {
    var sVal = $(obj).val();
    if (sVal.length > 0) { //test first and last
        if ((sVal[0] == ' ') || (sVal[sVal.length - 1] == ' ')) { //replace
            sVal = lf.trim(sVal);
            $(obj).val(sVal);//replace contents
        }
    }
    return sVal;
}
lf.trim = function trim(i_value ) {
    return $.trim(i_value);
}
lf.popDrops = function popDrops() {//populate dropdowns
    iYear = new Date().getFullYear() - 17;
    var sHTML = "<option value='' selected>Year</option>";
    for (i = 0; i < 100; i++) {
        iYear = iYear - 1;
        sHTML += "<option value='" + iYear + "'>" + iYear + "</option>";
    }
    $('#bday_year').html(sHTML);
}
lf.isDate = function isDate(dateStr) 
{
    var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var matchArray = dateStr.match(datePat); // is the format ok?

    if (matchArray == null) 
    { return false; }

    month = matchArray[1];// parse date into variables
    day = matchArray[3]; 
    year = matchArray[5];

    if (month < 1 || month > 12) 
    { // check month range
    return false;
    }

    if (day < 1 || day > 31) 
    { return false; }

    if ((month==4 || month==6 || month==9 || month==11) && day==31) 
    { return false; }

    if (month == 2) 
    { // check for february 29th
        var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
        if (day > 29 || (day==29 && !isleap)) 
        { return false; }
    }
    return true; // date is valid
}
lf.isMinimunAge = function isMinimunAge(i_date, minAge) {
    i_date = new Date(i_date);
    var dtDate = new Date(); //today
    var intAge;
    intAge = dtDate.getFullYear() - i_date.getFullYear();
    i_date.setYear(dtDate.getFullYear())
    i_date.setHours(0, 0, 0, 0);
    i_date.setHours(0, 0, 0, 0);
    if (dtDate < i_date)
    { intAge--; }

    if (intAge < minAge)
        return false;
    else
        return true;

}
lf.bindEvents = function bindEvents() {
    $('#requested_amount').change(function () { lf.valReq(this, 'Requested Amount is required'); });
    $('#first_name').blur(function () { lf.valReq(this, 'First Name is required', function (obj) { lf.valReg(obj, '^[a-z A-Z]+$', 'First Name is invalid - Only letters are allowed'); }); });
    $('#last_name').blur(function () { lf.valReq(this, 'Last Name is required', function (obj) { lf.valReg(obj, '^[a-z A-Z]+$', 'Last Name is invalid - Only letters are allowed'); }); });
    $('#street_addr1').blur(function () { lf.valReq(this, 'Street Address is required', function (obj) { lf.valReg(obj, '^[a-z A-Z0-9]+$', 'Street Address is invalid - Only Letters/Numbers are allowed'); }); });
    $('#street_addr2').blur(function () { lf.valReg(this, '^[a-z A-Z0-9]+$', 'Apartment # is invalid - Only letters and numbers are allowed'); });
    $('#city').blur(function () { lf.valReq(this, 'City is required', function (obj) { lf.valReg(obj, '^[a-z A-Z]+$', 'City is invalid - Only letters are allowed'); }); });
    $('#zip').blur(function () { lf.valReq(this, 'Zip Code is required', function (obj) { lf.valReg(obj, '[0-9]{5}', 'Zip code is invalid - Zip code must be 5 Numbers'); }); });
    $('#ssn1').blur(function () { lf.valReq(this, 'Social Security #(Part 1) is required', function (obj) { lf.valReg(obj, '[0-9]{3}', 'Social Security #(Part 1) is invalid - Social Security #(Part 1) must be 3 Numbers'); }); });
    $('#ssn2').blur(function () { lf.valReq(this, 'Social Security #(Part 2) is required', function (obj) { lf.valReg(obj, '[0-9]{2}', 'Social Security #(Part 2) is invalid - Social Security #(Part 2) must be 2 Numbers'); }); });
    $('#ssn3').blur(function () { lf.valReq(this, 'Social Security #(Part 3) is required', function (obj) { lf.valReg(obj, '[0-9]{4}', 'Social Security #(Part 3) is invalid - Social Security #(Part 3) must be 4 Numbers'); }); });
	
    $('#phone_home1').blur(function () { lf.valReq(this, 'Primary Phone (Part 1) is required', function (obj) { lf.valReg(obj, '[0-9]{3}', 'Primary Phone (Part 1) is invalid - Primary Phone (Part 1) must be 3 Numbers'); }); });
    $('#phone_home2').blur(function () { lf.valReq(this, 'Primary Phone (Part 2) is required', function (obj) { lf.valReg(obj, '[0-9]{3}', 'Primary Phone (Part 2) is invalid - Primary Phone (Part 2) must be 3 Numbers'); }); });
    $('#phone_home3').blur(function () { lf.valReq(this, 'Primary Phone (Part 3) is required', function (obj) { lf.valReg(obj, '[0-9]{4}', 'Primary Phone (Part 3) is invalid - Primary Phone (Part 3) must be 4 Numbers'); }); });
	
	$( '#phone_cell1' ).blur( function () {
		lf.valReq( this, 'Cell Phone (Part 1) is required, if none then copy Primary Phone (Part 1) here',
			function ( obj ) {
				lf.valReg( obj, '[0-9]{3}', 'Cell Phone (Part 1) is invalid - Cell Phone (Part 1) must be 3 numbers' );
			}
		);
	} );
	$( '#phone_cell2' ).blur( function () {
		lf.valReq( this, 'Cell Phone (Part 2) is required, if none then copy Primary Phone (Part 2) here',
			function ( obj ) {
				lf.valReg( obj, '[0-9]{3}', 'Cell Phone (Part 2) is invalid - Cell Phone (Part 2) must be 3 numbers' );
			}
		);
	} );
	$( '#phone_cell3' ).blur( function () {
		lf.valReq( this, 'Cell Phone (Part 3) is required, if none then copy Primary Phone (Part 3) here',
			function ( obj ) {
				lf.valReg( obj, '[0-9]{4}', 'Cell Phone (Part 3) is invalid - Cell Phone (Part 3) must be 4 numbers' );
			}
		);
	} );
	
    /*$('#phone_cell1').blur(function () { lf.valReg(this, '[0-9]{3}', 'Alternate Phone (Part 1) is invalid - Alternate Phone (Part 1) must be 3 Numbers'); });
    $('#phone_cell2').blur(function () { lf.valReg(this, '[0-9]{3}', 'Alternate Phone (Part 2) is invalid - Alternate Phone (Part 2) must be 3 Numbers'); });
    $('#phone_cell3').blur(function () { lf.valReg(this, '[0-9]{4}', 'Alternate Phone (Part 3) is invalid - Alternate Phone (Part 3) must be 4 Numbers'); });*/
	
    $('#email').blur(function () { lf.valReq(this, 'Email is required', function (obj) { lf.valReg(obj, '^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$', 'Email is invalid - Valid Format: xxxxxx@xxxxxx.xxx', function () { lf.valComp($('#email_verify'), 'email', 'Emails do not match - Verify email should be the same as the email field.'); }); }); });
    $('#email_verify').blur(function () { lf.valReq(this, 'You must verify your email', function (obj) { lf.valComp(obj, 'email', 'Emails do not match - Verify email should be the same as the email field.'); }); });
    $('#email_alternate').blur(function () { lf.valReg(this, '^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$', 'Email is invalid - Valid Format: xxxxxx@xxxxxx.xxx'); });
    $('#drivers_license').blur(function () { lf.valReq(this, 'Drivers License/State ID# is required', function (obj) { lf.valReg(obj, '^([a-zA-Z0-9 _\\-\\.]+)$', 'Invalid characters found in Drivers License field.'); }); });
    $('#employer_name').blur(function () { lf.valReq(this, 'Employer is required', function (obj) { lf.valReg(obj, '^([a-zA-Z0-9 _\\-\\.\\&]+)$', 'Invalid characters found in employer field.'); }); });
    $('#pay_date1').blur(function () { lf.valReq(this, 'Pay date 1 is required'); });
    $('#pay_date2').blur(function () { lf.valReq(this, 'Pay date 2 is required'); });
    $('#phone_work1').blur(function () { lf.valReq(this, 'Employer Phone (Part 1) is required', function (obj) { lf.valReg(obj, '[0-9]{3}', 'Employer Phone (Part 1) is invalid - Employer Phone (Part 1) must be 3 Numbers'); }); });
    $('#phone_work2').blur(function () { lf.valReq(this, 'Employer Phone (Part 2) is required', function (obj) { lf.valReg(obj, '[0-9]{3}', 'Employer Phone (Part 2) is invalid - Employer Phone (Part 2) must be 3 Numbers'); }); });
    $('#phone_work3').blur(function () { lf.valReq(this, 'Employer Phone (Part 3) is required', function (obj) { lf.valReg(obj, '[0-9]{4}', 'Employer Phone (Part 3) is invalid - Employer Phone (Part 3) must be 4 Numbers'); }); });
    $('#phone_work_ext').blur(function () { lf.valReg(this, '^[0-9]{1,5}$', 'Employer Phone Extension is invalid - Employer Phone Extension must be numeric'); });
    $('#bank_name').blur(function () { lf.valReq(this, 'Bank name is required', function (obj) { lf.valReg(obj, '^([a-zA-Z0-9 _\\-\\.\\&]+)$', 'Invalid characters found in bank name field.'); }); });
    $('#bank_aba').blur(function () { lf.valReq(this, 'ABA/Routing number is required', function (obj) { lf.valReg(obj, '[0-9]{9}', 'ABA/Routing number is invalid - ABA/Routing number must be 9 Numbers', function (obj) { lf.valABA(obj, 'ABA/Routing number appears to be invalid.'); }); }); });
    $('#bank_account').blur(function () { lf.valReq(this, 'Account number is required', function (obj) { lf.valReg(obj, '[0-9]+', 'Account number is invalid - Account number must be numeric', function (obj) { lf.valReg(obj, '[0-9]{5,18}', 'Account number must have a minimum of 5 Numbers'); }); }); });
    $('#state').change(function () { lf.valReq(this, 'State is required'); });
    $('#months_at_address').change(function () { lf.valReq(this, 'Months at address is required'); });
    $('#bday_month').change(function () { lf.valReq(this, 'Date of Birth (Month) is required', function (obj) { lf.valDate(obj, 'Invalid Date!', 18, 'You must be at Least 18 to apply!'); }); });
    $('#bday_day').change(function () { lf.valReq(this, 'Date of Birth (Day) is required', function (obj) { lf.valDate(obj, 'Invalid Date!', 18, 'You must be at Least 18 to apply!'); }); });
    $('#bday_year').change(function () { lf.valReq(this, 'Date of Birth (Year) is required', function (obj) { lf.valDate(obj, 'Invalid Date!', 18, 'You must be at Least 18 to apply!'); }); });
    $('#drivers_license_st').change(function () { lf.valReq(this, 'ID state is required'); });
    $('#home_owner').change(function () { lf.valReq(this, 'Home owner question is required'); });
    $('#income_type').change(function () { lf.valReq(this, 'Income type  is required'); });
    $('#months_employed').change(function () { lf.valReq(this, 'Months employed is required'); });
    $('#is_military').change(function () { lf.valReq(this, 'Are you Active Military question is required'); });
    $('#pay_frequency').change(function () { lf.valReq(this, 'How often you are paid is required'); });
    $('#direct_deposit').change(function () { lf.valReq(this, 'How do you receive your paycheck is required'); });
    $('#last_pay_check').change(function () { lf.valReq(this, 'Amount of last paycheck is required'); });
    $('#bank_account_type').change(function () { lf.valReq(this, 'Type of Account is required'); });
    $('#months_at_bank').change(function () { lf.valReq(this, 'Months with Bank Account is required.'); });

}
/* Calendar functions */
lf.buildCalendars = function buildCalendars() {
    var dt = new Date();
    lf.buildCalendar('#lf_cal1', dt);
    dt.setMonth(dt.getMonth() + 1);
    lf.buildCalendar('#lf_cal2', dt);
    dt.setMonth(dt.getMonth() + 1);
    lf.buildCalendar('#lf_cal3', dt);
}
lf.buildCalendar = function buildCalendar(calTableSelector, dt) {
    $(calTableSelector).find('caption').html(lf.getMonthName(dt.getMonth()));
    var fs = $(calTableSelector).find('td:first');  //first sunday
    dt.setDate(1); //first of the month
    dt.setHours(6); //set hour to six to avoid timezone issues
    var cm = dt.getMonth();
    var d = 0;
    var today = new Date();
    while (dt.getMonth() == cm) {
        if (d >= dt.getDay()) {
            var dtnum = Number(dt);
            if (dt > today) {
                fs.bind('click', dtnum, function(e) { lf.calPickMe(this, e.data); });
                fs.bind('mouseover', function(e) {
                    var oldColor = $(this).css('background-color');
                    $(this).addClass('lf_cal_td_hover');
                    $(this).bind('mouseout', function() {
                        $(this).removeClass('lf_cal_td_hover');
                    });
                });
            } else { 
                fs.addClass('lf_cal_td_dis');
            }
            fs.html(dt.getDate());
            dt = new Date(dtnum + 86400000);
        }
        else {
            fs.html('&nbsp;');
        }
        d++;
        if (d % 7 == 0) {//move to next row...
            fs = fs.parent().next().children(':first');
        }
        else {
            fs = fs.next();
        }
    }
    //set the space on the rest of cells
    while (d < 42) //42 cells 7x6
    {
        fs.html('&nbsp;');
        d++;
        if (d % 7 == 0) {//move to next row...
            fs = fs.parent().next().children(':first');
        }
        else {
            fs = fs.next();
        }
    }
    
}
lf.getMonthName = function getMonthName(month) {
    var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return monthNames[month];
}
lf.calPickMe = function calPickMe(obj, dtnum) {
    var sc = $(".lf_cal_selected").length;
    if ($(obj).hasClass('lf_cal_selected')) {
        var dt = lf.getFormattedDate(new Date(dtnum));
        $(obj).removeClass('lf_cal_selected');
        if ($('#pay_date1').val() == dt) {
            $('#pay_date1').val($('#pay_date2').val());
            $('#pay_date2').val('');
        } else {
            $('#pay_date2').val('');
        }
    } else {
        if (sc >= 2) {
            alert("You've already selected 2 pay dates! \n\n Click on a selected date to unselect");
        }
        else {
            $(obj).addClass('lf_cal_selected');
            lf.setPayDates(dtnum)
        }
    }
}
lf.setPayDates = function setPayDates(dtnum) {
    var dt1, dt2, nd;
    dt1 = lf.getTrimmedValue($('#pay_date1'));
    if (dt1 != '') dt1 = new Date(dt1);
    dt2 = lf.getTrimmedValue($('#pay_date2'));
    if (dt2 != '') dt2 = new Date(dt2);
    nd = new Date(dtnum); //new date
    if (dt1 == '') {
        dt1 = nd;
    }
    else {
        if (nd < dt1) {
            dt2 = dt1;
            dt1 = nd;
        }
        else
            dt2 = nd;
    }
    if (dt1 != '') {
        $('#pay_date1').val(lf.getFormattedDate(dt1));
        $('#pay_date1').blur();
    }
    if (dt2 != '') {
        $('#pay_date2').val(lf.getFormattedDate(dt2));
        $('#pay_date2').blur();
        lf.HideCalender();
    }
    else {
        $('#pay_date2').blur();
    }

}
lf.getFormattedDate = function getFormattedDate(dt, style) {
    var sDate = ''
    switch (style) {
        case 1:  //  yyyy-mm-dd
            sDate =  dt.getFullYear() + '-' + (dt.getMonth() + 1) + '-' + dt.getDate();
            break;
        default: //   mm/dd/yyyy
            sDate = (dt.getMonth() + 1) + '/' + dt.getDate() + '/' + dt.getFullYear();
    }

    return sDate;
}

lf.getMonthlyIncome = function () {
    var income = $("#last_pay_check").val();
    switch ($("#pay_frequency").val()) {
        case "WEEKLY": //weekly
            income = (income * 52) / 12;
            break;
        case "BIWEEKLY": //every 2 weeks
            income = (income * 26) / 12;
            break;
        case "TWICEMONTH": //twice a month
            income = (income * 24) / 12;
            break;
        //        case "MONTHLY": //monthly     
        //            income = income; 
        //            break;   
    }
    return parseInt(income);
}

lf.ConfigurePayDayTriggers = function () {
    var $PayDate1;
    var $PayDate2;
    var $PayDate1Trigger;
    var $PayDate2Trigger;

    $PayDate1 = $("#pay_date1");
    $PayDate2 = $("#pay_date2");
    $PayDate1Trigger = $("#pay_date1_trigger");
    $PayDate2Trigger = $("#pay_date2_trigger");

    //Position the blank GIF over the paydate inputs.


    //Bind the event
    $PayDate1Trigger.click(function () {
        lf.ShowCalender();
    })

    $PayDate2Trigger.click(function () {
        lf.ShowCalender();
    })
}

lf.ShowCalender = function () {
    var $PayDate2;
    var $PayCalendar;

    $PayDate2 = $("#pay_date2");
    $PayCalendar = $("#lf_pay_calendar");
    
    $PayCalendar.fadeOut();
    $PayCalendar.fadeIn();

}

lf.HideCalender = function () {
    var $PayCalendar;

    $PayCalendar = $("#lf_pay_calendar");
    $PayCalendar.fadeOut();
}