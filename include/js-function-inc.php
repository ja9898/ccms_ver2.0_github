
<script type="text/javascript">


var $_LIST=Array('Select [label] ','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');


var $_LIST90=Array('Select [label] ','00:00','01:30','03:00','04:30','06:00','07:30','09:00','10:30','12:00','13:30','15:00','16:30','18:00','19:30','21:00','22:30');



function toPakTime(value,resultDiv){
	//alert(value);
	document.getElementById(resultDiv).value= $_LIST[value];
	
	}

function toZoneTime(value,resultDiv){
//alert(<?php  //echo getList('','startTime','zone1','Start Time');?>);
var listData;
	switch(value){
	case '1':
			{
			listData="<?php $value=getList('','startTime','zone1','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '2':
			{
			listData="<?php $value=getList('','startTime','zone2','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '3':
			{
			listData="<?php $value=getList('','startTime','zone3','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '4':
			{
			listData="<?php $value=getList('','startTime','zone4','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '5':
			{
			listData="<?php $value=getList('','startTime','zone5','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '6':
			{
			listData="<?php $value=getList('','startTime','zone6','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}
	case '7':
			{
			listData="<?php $value=getList('','startTime','zone7','Start Time','toPakTime','paktime'); echo addslashes($value);?>";
			break;	}

	
	
	}
	
	document.getElementById('paktime').value="";
	document.getElementById(resultDiv).innerHTML=listData;
	}

	
//Function for populating DESIGNATIONS by selecting the DEPARTMENTS
/*function populate_designation(value,resultDiv){
//alert(<?php  //echo getList('','startTime','zone1','Start Time');?>);
var listData_designation;
	switch(value){
	case '1':
			{
			listData_designation="<?php $value=getList('','designationID','Management','','',''); echo addslashes($value);?>";
			break;	}
	case '2':
			{
			listData_designation="<?php $value=getList('','designationID','HR','','',''); echo addslashes($value);?>";
			break;	}
	case '3':
			{
			listData_designation="<?php $value=getList('','designationID','Teaching','','',''); echo addslashes($value);?>";
			break;	}
	case '4':
			{
			listData_designation="<?php $value=getList('','designationID','Finance','','',''); echo addslashes($value);?>";
			break;	}
	case '5':
			{
			listData_designation="<?php $value=getList('','designationID','Sales','','',''); echo addslashes($value);?>";
			break;	}
	case '6':
			{
			listData_designation="<?php $value=getList('','designationID','IT','','',''); echo addslashes($value);?>";
			break;	}
	case '7':
			{
			listData_designation="<?php $value=getList('','designationID','Reporting','','',''); echo addslashes($value);?>";
			break;	}

	
	
	}
	document.getElementById('').value="";
	document.getElementById(resultDiv).innerHTML=listData_designation;
	}*/

	
//Function for populating DESIGNATIONS by selecting the DEPARTMENTS		//DIFFERENT APPROACH
/*function populate_designation(value,resultDiv)
	{
		var designationID = document.getElementById(resultDiv);
		//var designationID_index = document.getElementById("designationID_index");
		
		designationID.length=0;// To Empty the current designationID array on every ** departmentId selection **
		switch (value)
		{
		case "1":
		arr = new Array('Select','Chairman','CEO','Director','GM','AGM','PA to CEO');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		//document.getElementById("designationID_index").value = designationID.selectedIndex;
		break;


		case "2":
		arr = new Array('Select','Manager','Officer','Admin Officer');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		//document.getElementById("designationID_index").value = designationID.value;
		//alert(document.getElementById("designationID_index").value);
		//window.location.href="index.php?desig="+designationID.selectedIndex;
		break;
		

		case "3":
		arr = new Array('Select','Collection Manager','Coordinator','Sr.Teacher','Jr.Teacher','Trainee');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		break;

		case "4":
		arr = new Array('Select','Officer','Collection Officer');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		break;
		
		case "5":
		arr = new Array('Select','TeamLeads','Sr.Agent','Jr.Agent','Trainee');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		break;
		
		case "6":
		arr = new Array('Select','Manager','Officer');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		break;
		
		case "7":
		arr = new Array('Select','Reporting Manager','Developer');
		designationID.disabled = false;
		for (var i=0;i<arr.length;i++) {
		option = new Option(arr[i],arr[i]);
		designationID.options[i] = option;
		}
		break;


		default:
		designationID.disabled = false;
		designationID.options.length = 0;
		break;
		}
	}*/
	
	function get_designation_index(value,resultDiv) //This function was called during DESIGNATION onchange event,
													//the INDEX value was returning fine, but wasn't shown during $_POST
													//But instead the value of the index was shown
	{
		//alert(document.getElementById(resultDiv).selectedIndex);
		//document.getElementById("designationID_index").innerHTML = document.getElementById(resultDiv).selectedIndex;
		//document.getElementById("designationID_index").value = document.getElementById(resultDiv).selectedIndex;
		//alert(document.getElementById("designationID_index"));
	}
	

function availableTeacher(value,resultDiv){
	var course=document.getElementById('courseID').value;
	var classType=document.getElementById('classType').value
	var pakTimelist=document.getElementById('paktime');
	pakTime = pakTimelist.options[pakTimelist.selectedIndex].text;
	//alert(pakTime);
	var zoneID=0; 
	var slotDuration=document.getElementById('slotDuration').value  
	
	
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
			xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(resultDiv).innerHTML=xmlhttp.responseText;
		}
	  }
	  /* if(zoneID>7){
         xmlhttp.open("GET","include/getAvailableTeachers90.php?slotDuration="+slotDuration+"&course="+course+"&classType="+classType+"&pakTime="+pakTime,true);
	  } */
	  //else{
		 xmlhttp.open("GET","include/getAvailableTeachers.php?slotDuration="+slotDuration+"&course="+course+"&classType="+classType+"&pakTime="+pakTime,true);
	//	  }
xmlhttp.send();
	
	
	}
	


function availableTeacherGROUP(value,resultDiv){
alert('NEW SCHEDULE-GROUP');
	var course=document.getElementById('courseID').value;
	var classType=document.getElementById('classType').value
	var pakTime=document.getElementById('paktime').value
	var zoneID=document.getElementById('zoneID').value 
	var slotDuration=document.getElementById('slotDuration').value  
	var group_value = document.getElementsByName('group_value')[0].value;  
	if(group_value==1)
	{
		alert(group_value);
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
			xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(resultDiv).innerHTML=xmlhttp.responseText;
		}
	  }

		xmlhttp.open("GET","include/getAvailableTeachersGroup.php?slotDuration="+slotDuration+"&course="+course+"&classType="+classType+"&pakTime="+pakTime+"&group_value="+group_value,true);

xmlhttp.send();
	
	
	}
	
	
	//Availability of Teacher Regardless of the subject				// for boo_scheduler_new_teacher_available.php
	//REMOVING COURSE HERE
	function availableTeacher_no_subject(value,resultDiv){
	//var course=document.getElementById('courseID').value;
	var classType=document.getElementById('classType').value
	var pakTime=document.getElementById('paktime').value
	var zoneID=document.getElementById('zoneID').value 
	var slotDuration=document.getElementById('slotDuration').value  
	
	
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
			xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(resultDiv).innerHTML=xmlhttp.responseText;
		}
	  }
	  if(zoneID>7){
         xmlhttp.open("GET","include/getAvailableTeachers90.php?slotDuration="+slotDuration+"&course="+course+"&classType="+classType+"&pakTime="+pakTime,true);
	  }
	  else{
		 xmlhttp.open("GET","include/getAvailableTeachers_teachers_available.php?slotDuration="+slotDuration+"&classType="+classType+"&pakTime="+pakTime,true);
		  }
xmlhttp.send();
	
	
	}
	
	
	  

function ajaxhttp_func()
	{
		//Making variable for ajax object
		var ajaxhttp_obj=false;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		 	
		return ajaxhttp_obj;
    }
	
function availableTeamLead(usertype_teamlead) {		
		var req = ajaxhttp_func();
		var usertype_teamlead=document.getElementById('usertype_teamlead').value;
		var strURL="include/getavailableTeamLead.php?usertype_teamlead="+usertype_teamlead;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statediv").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	
function availableTeamUnder(usertype_teamlead,usertype_teamlead_id) {		
		var req = ajaxhttp_func();
		var usertype_teamlead_id=document.getElementById('state').value;
		var strURL="include/getavailableTeamUnder.php?usertype_teamlead="+usertype_teamlead+"&usertype_teamlead_id="+usertype_teamlead_id;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statedivunder").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	
	//////////////////////////////// MAIN TEAMLEAD CATEGORY //////////////////////////////////////
	function availableTeamLead_main(usertype_teamlead_main) {		
		var req = ajaxhttp_func();
		var usertype_teamlead_main=document.getElementById('usertype_teamlead_main').value;
		var strURL="include/getavailableTeamLead_main.php?usertype_teamlead_main="+usertype_teamlead_main;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statediv_main").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	
function availableTeamUnder_main(usertype_teamlead_main,usertype_teamlead_id_main) {		
		var req = ajaxhttp_func();
		var usertype_teamlead_id_main=document.getElementById('state_main').value;
		var strURL="include/getavailableTeamUnder_main.php?usertype_teamlead_main="+usertype_teamlead_main+"&usertype_teamlead_id_main="+usertype_teamlead_id_main;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statedivunder_main").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	//////////////////////////////// POPULATE CURRENCY VALUES //////////////////////////////////////
	function getCurrencyValue(currency_id) {		
		var req = ajaxhttp_func();
		var currency_id=document.getElementById('currency_id').value;
		var strURL="include/getCurrencyValueFromDB.php?currency_id="+currency_id;
		
/* 		document.getElementById("amountDefaultNew").value='';
		document.getElementById("amountOriginalNew").value='';
		document.getElementById("totalReceivedNew").value='';
		document.getElementById("feeDeductNew").value='';
		document.getElementById("discountNew").value='';
		
		document.getElementById("amountDefaultNew_Usd").value='';
		document.getElementById("amountOriginalNew_Usd").value='';
		document.getElementById("amountUsdSimpleNew").value='';
		document.getElementById("feeDeductNew_Usd").value='';
		document.getElementById("discountNew_Usd").value=''; */
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("value_of_currency").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	////////////////////////////////////////////////////////////////////
	
	
	
	//////////////////////////////// POPULATE LeaveEndDate in LEAVE APPLICATION //////////////////////////////////////
	function getDate_days(days_to_add) {		
		//var req = ajaxhttp_func();
		var days_to_add=document.getElementById('NoOfDays').value;
		//var strURL="include/getCurrencyValueFromDB.php?currency_id="+currency_id;
			
			
		var sick_leave = document.getElementById('sick_leave').checked;
		var casual_leave = document.getElementById('casual_leave').checked;
		var other_leave = document.getElementById('other_leave').checked;
		
		//alert(sick_leave);
		//alert(casual_leave);
		
		if((sick_leave==1 && casual_leave==1) || (casual_leave==1 && other_leave==1))
		{
			alert('Select one check box at a time');
			document.getElementById("LeaveStartDate").value='';
			document.getElementById("LeaveEndDate").value='';
			return false;
		}
		
		if(days_to_add>1 && casual_leave==1)
		{
			alert('Casual Leave - Days Selection ERROR');
			document.getElementById("LeaveStartDate").value='';
			document.getElementById("LeaveEndDate").value='';
			return false;
		}
		
		else if(days_to_add>4 && sick_leave==1)
		{
			alert('Sick Leave - Days Selection ERROR');
			document.getElementById("LeaveStartDate").value='';
			document.getElementById("LeaveEndDate").value='';
			return false;
		}
		
		
		else
		{
			//Subtracting one to get out range of 1 or 2 or 3 days leave
			var days_to_add=days_to_add-1;
			//alert(days_to_add);
			
			//Getting Leave start date
			var leavestart_date = document.getElementById('LeaveStartDate').value;			
			var dt = leavestart_date;
			//alert(dt);
			//Adding the days to LeaveStartDate to get the LeaveEndDate
			var resulted_date = moment(dt).add('days', days_to_add);
			//alert(resulted_date); 
			resulted_date = moment(resulted_date).format('MM/DD/YYYY');
			//alert(resulted_date);	
			document.getElementById('LeaveEndDate').value = resulted_date;
			var LS_date = Date.parse(leavestart_date);
			var LE_date = Date.parse(resulted_date);
			//if(LS_date < LE_date)
			//{
			//	alert('In Milliseconds-got true' + resulted_date + leavestart_date);	
			//}
			if(LS_date > LE_date)
			{
				
				document.getElementById("LeaveStartDate").value='';
				document.getElementById("LeaveEndDate").value='';				
				alert('Error selecting dates' + resulted_date + leavestart_date);
				return false;
			}
			return true;
		}
	}
	////////////////////////////////////////////////////////////////////
	
	
	function timeLeave_timeRejoin_MUST() {
		var timeLeave = document.getElementById('timeLeave').value;
		var timeRejoin = document.getElementById('timeRejoin').value;
		var leaveDuration = document.getElementById('leaveDuration').value;		
		if (timeLeave == "" || timeLeave == 0) {
            alert('Time of Leaving must be selected');
            return false;
        }
		if (timeRejoin == "" || timeRejoin == 0) {
            alert('Time of Rejoin must be selected');
            return false;
        }
		if (leaveDuration == "" || leaveDuration == 0) {
            alert('LEAVE DURATION must be selected');
            return false;
        }
	}
	
	
//>>>>>>>>>>>>>>>>>>>>>>>>>>FOLLOWING is NOT WORKING PROPERLY-USE IT LATER<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<//
////////////////////////// SHORT LEAVE APPLICATION /////////////////////////// NEWLY ADDED //30-12-2015
	function timeLeave_timeRejoin(days_to_add) {		
		//var req = ajaxhttp_func();
		var leaveDurationValue=document.getElementById('leaveDuration').value;
		//var strURL="include/getCurrencyValueFromDB.php?currency_id="+currency_id;
		
		var leaveDuration = document.getElementById('leaveDuration');
		var leaveDurationText = leaveDuration.options[leaveDuration.selectedIndex].innerHTML;
		
		var timeLeave = document.getElementById('timeLeave');
		var timeLeaveText = timeLeave.options[timeLeave.selectedIndex].innerHTML;
		var timeRejoin = document.getElementById('timeRejoin');
		var timeRejoinText = timeRejoin.options[timeRejoin.selectedIndex].innerHTML;
		
		//var timediff=timeRejoinText - timeLeaveText;	//this calculation is wrong as it return NaN
		
		//////////////////////////////////////////////////////////////////////////
		//BEST LINK to calculate difference between HOURS
		//http://stackoverflow.com/questions/18441698/getting-time-difference-between-two-times-in-javascript
		var start_time = timeLeaveText;
		var end_time = timeRejoinText;
		/* var startHour = new Date("01/01/2007 " + start_time).getHours();
		var endHour = new Date("01/01/2007 " + end_time).getHours();
		var startMins = new Date("01/01/2007 " + start_time).getMinutes();
		var endMins = new Date("01/01/2007 " + end_time).getMinutes();
		var startSecs = new Date("01/01/2007 " + start_time).getSeconds();
		var endSecs = new Date("01/01/2007 " + end_time).getSeconds();
		 */
		var current_date = document.getElementById('current_date').innerHTML;
		var ccms_date = document.getElementById('ccms_date').innerHTML;
		var startHour = new Date(ccms_date + start_time).getHours();
		var endHour = new Date(current_date  + end_time).getHours();
		var startMins = new Date(ccms_date + start_time).getMinutes();
		var endMins = new Date(current_date + end_time).getMinutes();
		var startSecs = new Date("2007-01-01 " + start_time).getSeconds();
		var endSecs = new Date("2007-01-01 " + end_time).getSeconds();
		var secDiff = endSecs - startSecs;
		var minDiff = endMins - startMins;
		var hrDiff = endHour - startHour;
		//alert(hrDiff+":"+minDiff+":"+secDiff);
		////////////////////////////////////////////////////////////////////////
		if(hrDiff>=1 && hrDiff<=4)
		{
			if(minDiff<30)
			{
				alert("Short Leave Duration is "+hrDiff+":"+minDiff+ " Hours");
				return true;
			}
			else if(minDiff>=30)
			{
				alert("Short Leave Duration is "+hrDiff+":"+minDiff+ " Hours");
				if(hrDiff==1){ var element = document.getElementById('leaveDuration'); element.value = 2; return true;}
				if(hrDiff==2){ var element = document.getElementById('leaveDuration'); element.value = 4; return true;}
				if(hrDiff==3){ var element = document.getElementById('leaveDuration'); element.value = 6; return true;}
			}
			else
			{
				alert("Hours OR Minutes cannot be NEGATIVE - ERROR");				
				return false;
			}
		}
		else
		{
			alert("Short leave must be within 1 and 4 hours - ERROR")
			return false;
		}
		
		//alert(leaveDurationText+"*****"+timeLeaveText+"*"+timeRejoinText+">>>>>"+timediff+"????"+hrDiff+":"+minDiff);
		//return false;
		
	}
	////////////////////////////////////////////////////////////////////



	
	
	//////////////*************		***************\\\\\\\\\\\\\\\\\\\
	function showemailphone() {		
		var req = ajaxhttp_func();
		var student_id=document.getElementById('search-student-id2').value;
		var strURL="include/getEmailPhone.php?student_id="+student_id;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("EmailPhonediv").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	////////////////////////////////////////////////////
	
	//////////////*************		***************\\\\\\\\\\\\\\\\\\\
	function show_teacher_info_leave_app_new() {		
		var req = ajaxhttp_func();
		var teacher_id=document.getElementById('teacher_id').value;
		var strURL="include/get_teacher_info.php?teacher_id="+teacher_id;
		alert(teacher_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("table_teacher_info_leave_app_new_TEST").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
	////////////////////////////////////////////////////
	
	

	
	function changetextfunction()
	{
		document.getElementById("startDate").value='';
		document.getElementById("slotDuration").selectedIndex=0;
		document.getElementById("courseID").selectedIndex=1;
		document.getElementById("classType").selectedIndex=1;
		document.getElementById("teacherID").selectedIndex=0;
		//document.getElementById("laptoplist2").value='Unsuccessful';
		
	}
	
	function calculate_discount()
	{
            var signup_amount = document.getElementById("amount_default").value;
            var entered_amount = document.getElementById("amount").value;
            var discount = document.getElementById("discount").value;
			if(entered_amount <= signup_amount)
			{
				alert("Successful");
				document.getElementById("discount").value = signup_amount - entered_amount;
				return true;
			}
			if(entered_amount > signup_amount)
			{
				document.getElementById("discount").value = signup_amount - entered_amount;
				if(document.getElementById("discount").value < 0)
				{
				alert("Successful- But the discount is negative");
				}
			}
    }
	
	function calculate_currency_conversion() //FOR MAKE REGULAR
	{
            var value_of_currency = document.getElementsByName("value_of_currency")[0].value;
			document.getElementById("amount_original").value = document.getElementById("amountOriginalNew").value;

            var amount_original = document.getElementById("amount_original").value;
			var cad_amount = document.getElementById("value_of_cad").value;
			var GBP = amount_original*value_of_currency;
			var converted_amount=GBP/cad_amount;
			converted_amount = converted_amount.toFixed(2);
			//Newly added //23-11-16
			var simple_convert = document.getElementById("simple_convert").value;
			var amount_usd_simple = simple_convert*amount_original;
			amount_usd_simple = amount_usd_simple.toFixed(2);
			
			
			//************************************** NEW PART		START
			//NEW
			//Getting all values
			var amount_default = document.getElementById("amountDefaultNew").value;
			var amount_original = document.getElementById("amountOriginalNew").value;
			var simple_convert = document.getElementById("simple_convert").value;
			//var fee_deduct = document.getElementById("feeDeductNew").value;
			var received_amt = document.getElementById("totalReceivedNew").value;
			
			//Calculate received 
			var fee_deduct = amount_original - received_amt;
			document.getElementById("feeDeductNew").value=fee_deduct;
			//Calculate discount
			var discountNew = amount_default - amount_original;
			//USD Conversions
			//Converting Total received Amount to USD
			var amountUsdSimpleNew = simple_convert*received_amt;
			amountUsdSimpleNew = amountUsdSimpleNew.toFixed(2);
			//Converting all calculated values[amount_default,amount_original,simple_convert,fee_deduct] to USD 
			
			amountDefaultNew_Usd = amount_default * simple_convert;
			amountOriginalNew_Usd = amount_original * simple_convert;
			feeDeductNew_Usd = fee_deduct * simple_convert;
			//amountUsdSimpleNew Done above
			discountNew_Usd = discountNew * simple_convert;
			
			//************************************** NEW PART		END		

			if(amount_original!=0)
			{
				//alert("Successful");
				document.getElementById("amount_gbp").value = GBP.toFixed(2);
				document.getElementById("amount").value = converted_amount;
				//Newly added //23-11-16
				//document.getElementById("amount_usd_simple").value = amount_usd_simple;
				document.getElementById("amount_usd_simple").value = amountUsdSimpleNew;

				//NEW
				//alert("Successful");
				document.getElementById("totalReceivedNew").value = received_amt;
				document.getElementById("discountNew").value = discountNew.toFixed(2);
				//Assigning values to the id of USD elements
				document.getElementById("amountDefaultNew_Usd").value = amountDefaultNew_Usd.toFixed(2);
				document.getElementById("amountOriginalNew_Usd").value = amountOriginalNew_Usd.toFixed(2);
				document.getElementById("feeDeductNew_Usd").value = feeDeductNew_Usd.toFixed(2);
				document.getElementById("discountNew_Usd").value = discountNew_Usd.toFixed(2);
				document.getElementById("amountUsdSimpleNew").value = amountUsdSimpleNew;
				
				return true;
			}
			if(amount_original==0)
			{
				alert("Un - Successful ");
				return false;
			}
    }
	
	
	function calculate_currency_conversion_with_discount()
	{
            var value_of_currency = document.getElementsByName("value_of_currency")[0].value;
            var amount_original = document.getElementById("amount_original").value;
			var cad_amount = document.getElementById("value_of_cad").value;
			var GBP = amount_original*value_of_currency;
			var converted_amount=GBP/cad_amount;
			converted_amount = converted_amount.toFixed(2);
			//Newly added //23-11-16
			var simple_convert = document.getElementById("simple_convert").value;
			var amount_usd_simple = simple_convert*amount_original;
			amount_usd_simple = amount_usd_simple.toFixed(2);

			if(value_of_currency!=0 || amount_original!=0)
			{
				//alert("Successful");
				document.getElementById("amount_gbp").value = GBP.toFixed(2);
				document.getElementById("amount").value = converted_amount;
				var discount = document.getElementById("amount_default").value - document.getElementById("amount").value; 
				document.getElementById("discount").value = discount.toFixed(2);
				
				//Newly added //23-11-16
				document.getElementById("amount_usd_simple").value = amount_usd_simple;
				return true;
			}
			if(value_of_currency==0)
			{
				alert("Un - Successful ");
				return false;
			}
    }
	
	function calculate_received_discount_amount()//FOR TRANSACTION NEW VER 2
	{
			//OLD
            var value_of_currency = document.getElementsByName("value_of_currency")[0].value;
			document.getElementById("amount_original").value = document.getElementById("amountOriginalNew").value;
            var amount_original = document.getElementById("amount_original").value;
			var cad_amount = document.getElementById("value_of_cad").value;
			var GBP = amount_original*value_of_currency;
			var converted_amount=GBP/cad_amount;
			converted_amount = converted_amount.toFixed(2);
			//Newly added //23-11-16
			var simple_convert = document.getElementById("simple_convert").value;
			var amount_usd_simple = simple_convert*amount_original;
			amount_usd_simple = amount_usd_simple.toFixed(2);
			
			//************************************** NEW PART		START
			//NEW
			//Getting all values
			var amount_default = document.getElementById("amountDefaultNew").value;
			var amount_original = document.getElementById("amountOriginalNew").value;
			var simple_convert = document.getElementById("simple_convert").value;
			var received_amt = document.getElementById("totalReceivedNew").value;
			//Calculate received 
			var fee_deduct = amount_original - received_amt;
			document.getElementById("feeDeductNew").value=fee_deduct;
			//Calculate discount
			var discountNew = amount_default - amount_original;
						
			
			
			
			//USD Conversions
			//Converting Total received Amount to USD
			var amountUsdSimpleNew = simple_convert * received_amt;
			amountUsdSimpleNew = amountUsdSimpleNew.toFixed(2);
			//Converting all calculated values[amount_default,amount_original,simple_convert,fee_deduct] to USD 
			
			amountDefaultNew_Usd = amount_default * simple_convert;
			amountOriginalNew_Usd = amount_original * simple_convert;
			feeDeductNew_Usd = fee_deduct * simple_convert;
			//amountUsdSimpleNew Done above
			discountNew_Usd = discountNew * simple_convert;
			
			//************************************** NEW PART		END			
			
			if(amount_original!=0)
			{
				//OLD
				document.getElementById("amount_gbp").value = GBP.toFixed(2);
				document.getElementById("amount").value = converted_amount;
				var discount = document.getElementById("amount_default").value - document.getElementById("amount").value; 
				document.getElementById("discount").value = discount.toFixed(2);
				//Newly added //23-11-16
				//document.getElementById("amount_usd_simple").value = amount_usd_simple;
				document.getElementById("amount_usd_simple").value = amountUsdSimpleNew;				
				//NEW
				if(amount_default!=amount_original){
					document.getElementById("comments").required = true;
				}
				else{
					document.getElementById("comments").required = false;
				}
				
				//alert("Successful");
				document.getElementById("totalReceivedNew").value = received_amt;
				document.getElementById("discountNew").value = discountNew.toFixed(2);
				//Assigning values to the id of USD elements
				document.getElementById("amountDefaultNew_Usd").value = amountDefaultNew_Usd.toFixed(2);
				document.getElementById("amountOriginalNew_Usd").value = amountOriginalNew_Usd.toFixed(2);
				document.getElementById("feeDeductNew_Usd").value = feeDeductNew_Usd.toFixed(2);
				document.getElementById("discountNew_Usd").value = discountNew_Usd.toFixed(2);
				document.getElementById("amountUsdSimpleNew").value = amountUsdSimpleNew;
				
				return true;
			}
			if(amount_original==0)
			{
				alert("Un - Successful ");
				return false;
			}
    }
	
	
	function reset_values()
	{
		document.getElementById("totalReceivedNew").value = '';
		document.getElementById("discountNew").value = '';
		document.getElementById("feeDeductNew").value = '';
		
		document.getElementById("amountDefaultNew_Usd").value = '';
		document.getElementById("amountOriginalNew_Usd").value = '';
		document.getElementById("feeDeductNew_Usd").value = '';
		document.getElementById("discountNew_Usd").value = '';
		document.getElementById("amountUsdSimpleNew").value = '';
		
    }
	
	//This function works when agent is changed from agent dropdownlist and enables/disables the
	//Management dropdownlist under book_scheduler_edit.php
	function enable_disable_management_dropdown(value)
	{
			
			var agent_Id = value;
            //alert(agent_Id);
			
			//document.getElementById("management_comm_Id").disabled = true;
			
			if(agent_Id==192)
			{
				alert("Enabling Management list");
				document.getElementById("management_comm_Id").disabled = false;
				//alert(agentId);
				return true;
			}
			if(agent_Id!=192)
			{
				alert("DISABLING Management list");
				document.getElementById("management_comm_Id").value = ''
				document.getElementById("management_comm_Id").disabled = true;;
				return false;
			}
    }
	
	
	function check_discount()
	{
		if(document.getElementById("discount").value < 0) 
		{
			alert("Unsuccessful - Invalid discount value");
			return false;
		} 
		else 
		{
			alert("Successful - Discount value is valid");
			return true;
		}
	}
	
	function calculate_salary_gross_pay_after_deduction()
	{
            var basic_pay = document.getElementById("basic_pay").value;
			var working_days = document.getElementById("working_days").value;
			var days_worked = document.getElementById("days_worked").value;
			//var one_day_pay = document.getElementById("days_worked").value;
			
			var one_day_pay = basic_pay / working_days;
			var gpad = one_day_pay * days_worked;
			var gpad = Math.round(gpad);
			document.getElementById("g_pay_after_deduction").value = gpad;

			
	}
	
	function calculate_salary_net_payable_month()	//Currently NOT IN USE
	{
            //var increament = document.getElementById("increament").value;
			var gpad = document.getElementById("g_pay_after_deduction").value
			var increament = document.getElementById("increament").value;
			var arrears = document.getElementById("arrears").value;
			var incentive_bonus = document.getElementById("incentive_bonus").value;
			var commision_unpaid = document.getElementById("commision_unpaid").value;
			var travelling_allowance = document.getElementById("travelling_allowance").value;
			
			var staff_advance = document.getElementById("staff_advance").value;
			var fine = document.getElementById("fine").value;
			var other_deduction = document.getElementById("other_deduction").value;
			var tea_deduction = document.getElementById("tea_deduction").value;

			
			increament = parseFloat(increament);
			arrears = parseFloat(arrears);
			incentive_bonus = parseFloat(incentive_bonus);
			commision_unpaid = parseFloat(commision_unpaid);
			travelling_allowance = parseFloat(travelling_allowance);
			
			staff_advance = parseFloat(staff_advance);
			fine = parseFloat(fine);
			other_deduction = parseFloat(other_deduction);
			tea_deduction = parseFloat(tea_deduction);
			
			var gross_pay_ad = document.getElementById("g_pay_after_deduction").value;
			gross_pay_ad = parseFloat(gross_pay_ad);
			net_payable = document.getElementById("net_payable").value =  (gross_pay_ad+increament+arrears+incentive_bonus+commision_unpaid+travelling_allowance)-(staff_advance+fine+other_deduction+tea_deduction);
			document.getElementById("salaries_paid").value = net_payable;
			
			total_earn = gross_pay_ad+increament+arrears+incentive_bonus+commision_unpaid+travelling_allowance;
			total_deduct = staff_advance+fine+other_deduction+tea_deduction;
			document.getElementById("total_earn").value = total_earn;
			document.getElementById("total_deduct").value = total_deduct;
	}
	    

		
//********************************************* EARNING FOR EMPLOYEE - emp_payroll_new.php******************************			
		//FOLLOWING is for all addition values - EARNING
		$(document).ready(function(){
		
		$(".txt").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=47) ||
			(event.which >= 58 && event.which<=254)) {
				event.preventDefault();
				}
			});
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {
 
            $(this).keyup(function(){
                calculateSum();
            });
        });
 
    });
 
    function calculateSum() {
 
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum_add").html(sum);
		$("#sum_add_text").val(sum);
		$("#total_earn").val($("#sum_add_text").val());
		
		$("#net_payable").val($("#total_earn").val() - $("#total_deduct").val());
		$("#salaries_paid").val($("#total_earn").val() - $("#total_deduct").val());
		
    }
	
	
	
	
//********************************************* DEDUCTION FOR EMPLOYEE - emp_payroll_new.php******************************	
	//FOLLOWING is for all subtracted values - DEDUCTION
	$(document).ready(function(){
	
	$(".txt_sub").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=47) ||
			(event.which >= 58 && event.which<=254)) {
				event.preventDefault();
				}
			});
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt_sub").each(function() {
 
            $(this).keyup(function(){
                calculateSum_for_sub();
            });
        });
 
    });
 
    function calculateSum_for_sub() {
 
        var sum_sub = 0;
        //iterate through each textboxes and add the values
        $(".txt_sub").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum_sub += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum_sub").html(sum_sub);
		$("#sum_sub_text").val(sum_sub);
		
		$("#total_deduct").val($("#sum_sub_text").val());

		//$("#net_payable").val($("#sum_add_text").val() - $("#sum_sub_text").val());
		//$("#salaries_paid").val($("#sum_add_text").val() - $("#sum_sub_text").val());
		$("#net_payable").val($("#total_earn").val() - $("#total_deduct").val());
		$("#salaries_paid").val($("#total_earn").val() - $("#total_deduct").val());
    }
	
	
	
	//********************  BLINKING HYPERLINK *******************************//
	
	$(document).ready(function () {

    //call the blink function on the element you want to blink
    blink(".myDiv", -1, 1000); //blink a div with the ID of myDiv
    //blink("input[type='submit']", 3, 1000); //blink a submit button
    //blink("ol > li:first", -1, 100); //blink the first element in an ordered list (infinite times)
    //blink(".myClass", 25, 5000); //blink anything that has a myClass on it
});

/**
 * Purpose: blink a page element
 * Preconditions: the element you want to apply the blink to, the number of times to blink the element (or -1 for infinite times), the speed of the blink
 **/
function blink(elem, times, speed) {
    if (times > 0 || times < 0) {
        if ($(elem).hasClass("blink")) $(elem).removeClass("blink");
        else $(elem).addClass("blink");
    }

    clearTimeout(function () {
        blink(elem, times, speed);
    });

    if (times > 0 || times < 0) {
        setTimeout(function () {
            blink(elem, times, speed);
        }, speed);
        times -= .5;
    }
}


//********************  BLINKING HYPERLINK - PURPLE *******************************//
	
	$(document).ready(function () {

    //call the blink function on the element you want to blink
    blink_blue(".myDivblue", -1, 1000); //blink a div with the ID of myDiv
    //blink("input[type='submit']", 3, 1000); //blink a submit button
    //blink("ol > li:first", -1, 100); //blink the first element in an ordered list (infinite times)
    //blink(".myClass", 25, 5000); //blink anything that has a myClass on it
});

/**
 * Purpose: blink a page element
 * Preconditions: the element you want to apply the blink to, the number of times to blink the element (or -1 for infinite times), the speed of the blink
 **/
function blink_blue(elem, times, speed) {
    if (times > 0 || times < 0) {
        if ($(elem).hasClass("blink_blue")) $(elem).removeClass("blink_blue");
        else $(elem).addClass("blink_blue");
    }

    clearTimeout(function () {
        blink_blue(elem, times, speed);
    });

    if (times > 0 || times < 0) {
        setTimeout(function () {
            blink_blue(elem, times, speed);
        }, speed);
        times -= .5;
    }
}



//*****MANGE SCHEDULE - To enter only numbers for Amt Start and End Range in book_scheduler_manage.php******			
		$(document).ready(function(){
		//Amt Start Range
		$(".amt_start_range").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=47) ||
			(event.which >= 58 && event.which<=254)) {
				event.preventDefault();
				}
			});
		//Amt End Range
		$(".amt_end_range").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=47) ||
			(event.which >= 58 && event.which<=254)) {
				event.preventDefault();
				}
			});
 
    });

//*****STUDENT ATTENDANCE - TO enter only ALPHABETS in the comments and lesson details*****
$(document).ready(function(){
		//Amt Start Range
		//(event.which >=33 && event.which <=47)||
		//(event.which >=58 && event.which <=64) || 
		//(event.which >=91 && event.which <=96) || (event.which >= 123 && event.which<=126) ||
		$(".lessonDetails_sa").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=31) ||  
			(event.which >= 128 && event.which<=254)) {
				event.preventDefault();
				}
			});
			//(event.which >=33 && event.which <=47)|| 
			//(event.which >=58 && event.which <=64) || 
			//(event.which >=91 && event.which <=96) || (event.which >= 123 && event.which<=126) ||
		$(".comments_sa").keypress(function(event) {
			if ((event.which >=1 && event.which <=7) || (event.which >=14 && event.which <=31) ||
			(event.which >= 128 && event.which<=254)) {
				event.preventDefault();
				}
			});
    });	

	
//*****CAMPUS SCHEDULE - TO enter only ALPHABETS in the comments_reschedule*****
$(document).ready(function(){
		//Amt Start Range
		$(".comments_reschedule").keypress(function(event) {
			if ((event.which >=1 && event.which <=31) || (event.which >=33 && event.which <=64)|| 
			(event.which >=91 && event.which <=96) || (event.which >= 123 && event.which<=126) || 
			(event.which >= 128 && event.which<=254)) {
				event.preventDefault();
				}
			});
    });
	
	


//*****PAYMENT RECORD REPORT CURRENCY CONVERSION - TO enter only DECIMAL VALUES in the GBP,USD,CAD,AUD textboxes*****
$(document).ready(function(){
$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
	});
	

//*******  Countdown timer for FREEZE students(book_scheduler_freeze.php) ************//
var sTime = new Date().getTime();
var countDown = 5;

function UpdateTime() {
    var cTime = new Date().getTime();
    var diff = cTime - sTime;
    var seconds = countDown - Math.floor(diff / 1000);
    if (seconds >= 0) {
        var minutes = Math.floor(seconds / 60);
        seconds -= minutes * 60;
        $("#minutes").text(minutes < 10 ? "0" + minutes : minutes);
        $("#seconds").text(seconds < 10 ? "0" + seconds : seconds);
    } else {
        $("#countdown").hide();
        $("#aftercount").show();
        clearInterval(counter);
		window.location.href = 'index.php';
    }
}
//FOLLOWING COMMENTED because called in PHP file
//UpdateTime();
//var counter = setInterval(UpdateTime, 500);

	
	
	
/*	function calculate_salary_gross_pay()
	{
            //var increament = document.getElementById("increament").value;
			var increament = document.getElementById("increament").value;
			var arrears = document.getElementById("arrears").value;
			var overtime = document.getElementById("overtime").value;
			var commision = document.getElementById("commision").value;
			var travelling_allowence = document.getElementById("travelling_allowence").value;
			increament = parseFloat(increament);
			arrears = parseFloat(arrears);
			overtime = parseFloat(overtime);
			commision = parseFloat(commision);
			travelling_allowence = parseFloat(travelling_allowence);
			
			var gross_pay_ad = document.getElementById("g_pay_after_deduction").value;
			gross_pay_ad = parseFloat(gross_pay_ad);
			document.getElementById("gross_pay").value =  gross_pay_ad+increament+arrears+overtime+commision+travelling_allowence;
	}
	
	function calculate_salary_net_payable()
	{
            var staff_adv = document.getElementById("staff_adv").value;
			var staff_loan = document.getElementById("staff_loan").value;
			var fine = document.getElementById("fine").value;
			var other_deduction = document.getElementById("other_deduction").value;
			var tea_deduction = document.getElementById("tea_deduction").value;
			var income_tax = document.getElementById("income_tax").value;
			staff_adv = parseFloat(staff_adv);
			staff_loan = parseFloat(staff_loan);
			fine = parseFloat(fine);
			other_deduction = parseFloat(other_deduction);
			tea_deduction = parseFloat(tea_deduction);
			income_tax = parseFloat(income_tax);
			
			var gross_pay = document.getElementById("gross_pay").value;
			gross_pay = parseFloat(gross_pay);
			
			all_decreaments = staff_adv+staff_loan+fine+other_deduction+tea_deduction+income_tax;
			document.getElementById("net_payable").value =  gross_pay-all_decreaments;			
	}*/
	
		function values_for_excel() //Currently NOT IN USE
	{
		var emp_name = document.getElementById("emp_name").value;
		var emp_designation = document.getElementById("emp_designation").value;
		var emp_shift = document.getElementById("emp_shift").value;
		var emp_app_date = document.getElementById("emp_app_date").value;
		
		var basic_pay = document.getElementById("basic_pay").value;
		var working_days = document.getElementById("working_days").value;
		var days_worked = document.getElementById("days_worked").value;
		
		var gross_pay_ad = document.getElementById("g_pay_after_deduction").value;
		
		var increament = document.getElementById("increament").value;
		var arrears = document.getElementById("arrears").value;
		var overtime = document.getElementById("overtime").value;
		var commision = document.getElementById("commision").value;
		var travelling_allowence = document.getElementById("travelling_allowence").value;
		
		var gross_pay = document.getElementById("gross_pay").value;
		
		var staff_adv = document.getElementById("staff_adv").value;
		var staff_loan = document.getElementById("staff_loan").value;
		var fine = document.getElementById("fine").value;
		var other_deduction = document.getElementById("other_deduction").value;
		var tea_deduction = document.getElementById("tea_deduction").value;
		var income_tax = document.getElementById("income_tax").value;
		
		var net_payable = document.getElementById("net_payable").value;
		
		var payment_month = document.getElementById("payment_month");
		var payment_month_text = payment_month.options[payment_month.selectedIndex].text;
		
		var all_values=gross_pay_ad+increament+arrears+overtime+commision+travelling_allowence+gross_pay+staff_adv+staff_loan+fine+other_deduction+tea_deduction+income_tax+net_payable;
		
		window.open('excel.php?basic_pay='+basic_pay + '&emp_name='+emp_name + '&emp_designation='+emp_designation + '&emp_shift='+emp_shift + '&emp_app_date='+emp_app_date 
		+ '&working_days='+working_days + '&days_worked='+days_worked + '&gross_pay_ad='+gross_pay_ad 
		+ '&increament='+increament + '&arrears='+arrears + '&overtime='+overtime + '&commision='+commision +'&trvl_allow='+travelling_allowence 
		+ '&gross_pay='+gross_pay 
		+ '&staff_adv='+staff_adv + '&staff_loan='+staff_loan + '&fine='+fine + '&other_deduction='+other_deduction + '&tea_deduction='+tea_deduction 
		+ '&income_tax='+income_tax    +     '&net_payable='+net_payable + '&payment_month='+payment_month_text,'','','');
		//window.location = "excel.php?basic_pay=" + basic_pay;
		

	}
	
/*	//Might be used later  - VALUES FOR emp_payroll_new_slip_generator.php
	function values_for_excel()
	{
		var emp_name = document.getElementById("emp_name").value;
		var emp_designation = document.getElementById("emp_designation").value;
		var emp_shift = document.getElementById("emp_shift").value;
		var emp_app_date = document.getElementById("emp_app_date").value;
		
		var basic_pay = document.getElementById("basic_pay").value;
		var working_days = document.getElementById("working_days").value;
		var days_worked = document.getElementById("days_worked").value;
		
		var gross_pay_ad = document.getElementById("g_pay_after_deduction").value;
		
		var increament = document.getElementById("increament").value;
		var arrears = document.getElementById("arrears").value;
		var overtime = document.getElementById("overtime").value;
		var commision = document.getElementById("commision").value;
		var travelling_allowence = document.getElementById("travelling_allowence").value;
		
		var gross_pay = document.getElementById("gross_pay").value;
		
		var staff_adv = document.getElementById("staff_adv").value;
		var staff_loan = document.getElementById("staff_loan").value;
		var fine = document.getElementById("fine").value;
		var other_deduction = document.getElementById("other_deduction").value;
		var tea_deduction = document.getElementById("tea_deduction").value;
		var income_tax = document.getElementById("income_tax").value;
		
		var net_payable = document.getElementById("net_payable").value;
		
		var payment_month = document.getElementById("payment_month");
		var payment_month_text = payment_month.options[payment_month.selectedIndex].text;
		
		var all_values=gross_pay_ad+increament+arrears+overtime+commision+travelling_allowence+gross_pay+staff_adv+staff_loan+fine+other_deduction+tea_deduction+income_tax+net_payable;
		
		window.open('excel.php?basic_pay='+basic_pay + '&emp_name='+emp_name + '&emp_designation='+emp_designation + '&emp_shift='+emp_shift + '&emp_app_date='+emp_app_date 
		+ '&working_days='+working_days + '&days_worked='+days_worked + '&gross_pay_ad='+gross_pay_ad 
		+ '&increament='+increament + '&arrears='+arrears + '&overtime='+overtime + '&commision='+commision +'&trvl_allow='+travelling_allowence 
		+ '&gross_pay='+gross_pay 
		+ '&staff_adv='+staff_adv + '&staff_loan='+staff_loan + '&fine='+fine + '&other_deduction='+other_deduction + '&tea_deduction='+tea_deduction 
		+ '&income_tax='+income_tax    +     '&net_payable='+net_payable + '&payment_month='+payment_month_text,'','','');
		//window.location = "excel.php?basic_pay=" + basic_pay;
		

	}	*/
	
//FUNCTION TO CHECK THE LENGTH OF THE TEXTAREA DURING DEAD CONFIRMATION REQUEST-CHECKING MINLENGTH TO 25 CHARACTER
function checkLength(form)
{
	if(document.getElementById('comments_dead').value.length < 25) 
	{
		alert("Error: Please check that you've entered 25 character length");
		return false;
    } 
	else 
	{
		alert("Characters are of 25 length-Successful");
		return true;
    }
}

//FUNCTION TO CHECK THE LENGTH OF THE TEXTAREA DURING student attendance in (student_attendance.php) file-CHECKING MINLENGTH TO 20 CHARACTER
function checkLength_student_attendance(form)
{
	if(document.getElementById('lessonDetails').value.length < 20) 
	{
		alert("Error: Please check that you've entered min 20 character length");
		return false;
    } 
	else 
	{
		//alert("Added Row - Click O.K to Redirect to Main Page");
		
		alert("Characters are of min 20 length-Successful");
		return true;
	
		//return true;
    }
}

//FUNCTION TO CHECK THE LENGTH OF THE TransactionID while selecting CARD SAVE - CHECKING MINLENGTH TO 24 CHARACTER
function check_cardsave_transactionID_length(form)
{
	if(document.getElementById('method_new').value==6 && document.getElementById('transactionID').value.length < 24) 
	{
		alert("Error: TransactionID for CARD SAVE - Must be 24 digits");
		return false;
    } 
	else if(document.getElementById('method_new').value==6 && document.getElementById('transactionID').value.length == 24)
	{
		alert("Successful - 24 digits");
		//var cardSave_ccv_code_LENGTH = document.getElementById('cardSave_ccv_code');
		var cardSave_ccv_code_LENGTH = document.getElementById("cardSave_ccv_code").value.length;
		if(cardSave_ccv_code.style.visibility=='visible')
		{
			if(cardSave_ccv_code_LENGTH==3){
			alert("All o.k");
			return true;
			}
			else{
			alert("CCV code must be 3 Digits");
			return false;				
			}
		}
    }
	else
	{
		var transactionID;
		//Making separate variables for currency INDEX and VALUE
		var currency_id_index;
		var currency_id_value;
		///////////////////////////////////////////////////////
		var amount_original;
		var sender_name;
		var email;
		//Bank payment variable
		var bank_payment_image;
		///////////////////////
		transactionID=document.getElementById('transactionID').value;
		currency_id_index = document.getElementById('currency_id');
		currency_id_value = currency_id_index.options[currency_id_index.selectedIndex].text;
		amount_original=document.getElementById('amount_original').value;
		sender_name=document.getElementById('sender_name').value;
		email=document.getElementById('email').value;
		//WU/BANK/PHY payment
		WU_BANK_PHY_payment_image_visible = inputID=document.getElementById('bank_payment_image');
		WU_BANK_PHY_payment_image=document.getElementById('bank_payment_image').value;
		// validation code here ...
		if(transactionID=='' || currency_id_value=='' || amount_original=='' || sender_name=='' || email=='') {
			alert('Please fill all the required fields in the form!');
			return false;
		}
		//Bank payment upload validation
		else if(WU_BANK_PHY_payment_image_visible.style.visibility=='visible' && WU_BANK_PHY_payment_image==''){
			alert('Upload the image if WU/BANK/PHY Payment is selected!!!');
			return false;
		}
		else {
			alert("REVIEW ENTERED INFORMATION \n\n TRANSATION ID: "+transactionID+" \n CURRENCY: "+currency_id_value+" \n ORIGINAL AMOUNT: "+amount_original+" \n SENDER NAME: "+sender_name+" \n EMAIL: "+email);
			return confirm('Do you really want to submit the form?');
		}
	}
}

//Function to change DATE RECEIVED with SIGNIN DATE in make_regular.php
function date_rec_date_signin()
{
	var signInDate = document.getElementById('signInDate').value;
	document.getElementById('date').value = signInDate;
	document.getElementById('paydate').value = signInDate;
	if(signInDate = document.getElementById('date').value)
	{
		alert("SignIn Date MATCHES Date Received & Recurring/Paying Date");
	}
	else
	{
		alert("SignIn Date DOESN'T MATCH Date Received");
	}
}

//Function for mandatory fields of SELECT ZONE,Pakistan Time and END TIME // NOT IN USE since 22-08-15
function mandatory_fields_edit_schedule()
{
	var zone = document.getElementById('zoneID').selectedIndex;
	var startTime = document.getElementById('startTime').selectedIndex;
	if((zone<=1 || zone=='') && (startTime<=1 || startTime==''))
	{
		alert("Select Values PROPERLY - UNSUCCESSFUL - " + zone + " " + startTime);
		return false;
	}
	else if((zone>1 || zone=='') && (startTime<=1))
	{
		alert("Select Values PROPERLY - UNSUCCESSFUL - " + zone + " " + startTime);
		return false;
	}
	else if((zone<=1 || zone=='') && (startTime>1))
	{
		alert("Select Values PROPERLY - UNSUCCESSFUL - " + zone + " " + startTime);
		return false;
	}
	else if(document.getElementById('comments_reschedule').value.length < 10) 
	{
		alert("Error: Please check that you've entered min 10 characters length under COMMENTS FOR RESCHEDULE");
		return false;
    } 
	else
	{
		alert("Values Properly Selected - Successful - " + zone + " " + startTime);
		return true;
	}
}

//Function for mandatory fields of SELECT ZONE,Pakistan Time and END TIME  //NEWLY ADDED 23-08-15
// IN USE since 23-08-15 
function mandatory_fields_edit_schedule_no_pacific_time()
{
	var pakTime = document.getElementById('paktime').selectedIndex;
	
	if(pakTime<=1 || pakTime=='')
	{
		alert("Select Values PROPERLY - UNSUCCESSFUL - " + pakTime);
		return false;
	}
	else if(document.getElementById('comments_reschedule').value.length < 10) 
	{
		alert("Error: Please check that you've entered min 10 characters length under COMMENTS FOR RESCHEDULE");
		return false;
    } 
	else
	{
		alert("Values Properly Selected - Successful - " + pakTime);
		return true;
	}
}

//Function to update METHOD in the transaction_new.php
function update_payment_method()
{
	var pay_method_new_value = document.getElementById('method_new');
	var pay_method_new_text = pay_method_new_value.options[pay_method_new_value.selectedIndex].text;
	document.getElementById('method').value = pay_method_new_text;
	if(pay_method_new_text = document.getElementById('method').value)
	{
		//alert("Method READONLY populated");
	}
	else
	{
		//alert("Method READONLY NOT populated");
	}
	var ccv_code_value = document.getElementById('method_new');
	var ccv_code_text = ccv_code_value.options[ccv_code_value.selectedIndex].text;
	//alert(ccv_code_text);
	cardSave_ccv_code = inputID=document.getElementById('cardSave_ccv_code');
	
	//Virtual termincal fields alomg with card save NEWLY ADDED // 28-11-16
	VirtualTerminal_name = inputID=document.getElementById('VirtualTerminal_name');
	VirtualTerminal_number = inputID=document.getElementById('VirtualTerminal_number');
	VirtualTerminal_date = inputID=document.getElementById('VirtualTerminal_date');
	//Bank payment image upload field along with CARDSAVE and VIRTUAL TERMINAL //17-01-17
	WU_BANK_PHY_payment_image = inputID=document.getElementById('bank_payment_image');
	//Bank Selection //27-07-18
	BANK_NAME = inputID=document.getElementById('bankName');
	if(ccv_code_text=="Card Save")
	{
		//alert("You have selected "+ccv_code_text+" - Enabling CCV Code Textbox");
		cardSave_ccv_code.style.visibility='visible';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';
	}
	else if(ccv_code_text=="Virtual Terminal")
	{
		cardSave_ccv_code.style.visibility='visible';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='visible';
		VirtualTerminal_number.style.visibility='visible';
		VirtualTerminal_date.style.visibility='visible';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';
	}
	else if(ccv_code_text=="Western Union" || ccv_code_text=="Bank" || ccv_code_text=="Physical payment") //Newly added for bank payment //17-01-17
	{
		
		cardSave_ccv_code.style.visibility='hidden';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='visible';
		//Bank Selection
		BANK_NAME.style.visibility='visible';
	}
	else
	{
		cardSave_ccv_code.style.visibility='hidden';
		//Virtual terminal- Name,Number,Expiry
		VirtualTerminal_name.style.visibility='hidden';
		VirtualTerminal_number.style.visibility='hidden';
		VirtualTerminal_date.style.visibility='hidden';
		//Bank payment image upload field making visible
		WU_BANK_PHY_payment_image.style.visibility='hidden';
		//Bank Selection
		BANK_NAME.style.visibility='hidden';		
	}
}


//RELATED TO student_attendance.php for page redirection to index page
function delaylogin()
	{
		//alert("Page will be redirected within 3 seconds...");
		//window.location.href='index.php';
		//return true;
		
	}
  
	
	function open_win()
	{
		//myWindow=window.open('emp_payroll_slip.php','','width=500,height=500')
		//myWindow.focus();
	}
	
	function send_recurring_email()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_amount").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_amount").innerHTML='Email sent-rc amount';
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var amount = document.getElementById('recurring_amount').value;
		var queryString = "amount=" + amount ;
		//initiating ajax POST request
		ajaxhttp_obj.open("POST","sendmail/tosend.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function send_teacher_teamlead_summary()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary").innerHTML='Email sent';
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var teamlead_summary = document.getElementById('teamlead_summary').value;
		var queryString = "teamlead_summary=" + teamlead_summary;
		//initiating ajax POST request
		alert(queryString);
		ajaxhttp_obj.open("POST","sendmail/tosend.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}

	function send_email_to_student()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary").innerHTML='Email sent';
					alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('letter_format').value;
		var customer_email = document.getElementById('customer_email').value;
		var queryString = "letter_format=" + letter_format +"&customer_email=" + customer_email ;
		//initiating ajax POST request
		alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail-teacher-absent.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function send_email_to_aaqib_for_extid()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_student").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_student").innerHTML='Email sent';
					alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_format_to_send_after_post').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function send_email_to_management()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_business_sheet").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_business_sheet").innerHTML='Email sent';
					alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('business_sheet_email_to_send').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master-bus-sheet/send-mail.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	
	function forecast_report_send_email_to_management()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_business_sheet_forecast").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_business_sheet_forecast").innerHTML='Email sent';
					alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('business_sheet_forecast_email_to_send').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master-bus-sheet/send-mail_forecast_report.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_on_CONFIRM_DEAD()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_confirm_dead").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_confirm_dead").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_on_CONFIRM_DEAD').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail-confirm-dead.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function send_email_to_StudentParent_ycc()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_format_to_send_StudentParent_ycc').value;
		var student_email = document.getElementById('student_email').value;
		var queryString = "letter_format=" + letter_format +"&student_email=" + student_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_send_email_to_StudentParent_ycc.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function send_email_paypal_invoice()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var paypal_email_text = document.getElementById('email_paypal_invoice_text').value;
		var customer_email = document.getElementById('customer_invoice_email_last').value;
		var ccms_user_email = document.getElementById('ccms_user_email').value;
		var queryString = "paypal_email_text=" + paypal_email_text +"&customer_email=" + customer_email +"&ccms_user_email=" + ccms_user_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_send_email_paypal_invoice.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	
	
	function email_to_send_on_GENERATE_TICKET()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_on_GENERATE_TICKET').value;
		var ttl_ticket_email = document.getElementById('ttl_ticket_email').value;
		var mttl_ticket_email = document.getElementById('mttl_ticket_email').value;
		
		var queryString = "letter_format=" + letter_format +"&ttl_ticket_email=" + ttl_ticket_email +"&mttl_ticket_email=" + mttl_ticket_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_GENERATE_TICKET.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_TICKET_TO_STUDENT()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_TICKET_TO_STUDENT').value;
		var student_ticket_email = document.getElementById('student_ticket_email').value;
		
		var queryString = "letter_format=" + letter_format +"&student_ticket_email=" + student_ticket_email;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_TICKET_TO_STUDENT.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_TICKET_CLOSED_TO_STUDENT()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_TICKET_CLOSED_TO_STUDENT').value;
		var ttl_ticket_email = document.getElementById('ttl_ticket_email').value;
		var mttl_ticket_email = document.getElementById('mttl_ticket_email').value;
		var student_ticket_email = document.getElementById('student_ticket_email').value;
		
		var queryString = "letter_format=" + letter_format +"&student_ticket_email=" + student_ticket_email +"&ttl_ticket_email=" + ttl_ticket_email +"&mttl_ticket_email=" + mttl_ticket_email;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_TICKET_CLOSED_TO_STUDENT.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_on_REPLY_TICKET()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_on_REPLY_TICKET').value;
		var get_student_email = document.getElementById('get_student_email').value;
		
		var queryString = "letter_format=" + letter_format +"&student_email=" + get_student_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_REPLY_TICKET.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_on_MONTH_START_REPORT(id)
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var index = id;
		//alert(index);
		var letter_format = document.getElementById('email_to_send_on_MONTH_START_REPORT'+index).value;
		var student_email = document.getElementById('email_id'+index).value;
		var ttl_email = document.getElementById('ttl_email'+index).value;
		var mttl_email = document.getElementById('mttl_email'+index).value;
		//alert(index+student_email+ttl_email+mttl_email);
		var queryString = "letter_format=" + letter_format +"&student_email=" + student_email +"&ttl_email=" + ttl_email +"&mttl_email=" + mttl_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_MONTH_START_REPORT.php",true);
		alert("Email Sent");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_on_MENU_ORDER()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_confirm_menu").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_confirm_menu").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_on_MENU_ORDER').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_MENU_ORDER.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	function email_to_send_on_FREEZE()
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					document.getElementById("ajaxdiv_summary_freeze").innerHTML='Email Not Sent';
				}
				else
				{
					document.getElementById("ajaxdiv_summary_freeze").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var letter_format = document.getElementById('email_to_send_on_FREEZE').value;
		var queryString = "letter_format=" + letter_format ;
		//initiating ajax POST request
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_FREEZE.php",true);
		//alert("Sending POST request");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
	}
	
	

	function email_to_send_test_REPORT(id)
	{
		//Making variable for ajax object
		var ajaxhttp_obj;
		if(window.XMLHttpRequest)
		{
			//Making new ajax object for chrome, firefox, safari, opera using window
			ajaxhttp_obj=new XMLHttpRequest();
		}
		else if(window.ActiveXObject)
		{
			//OR Making new ajax object for IE 6, 7 using window
			ajaxhttp_obj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else
		{
			alert("Your Browser Broke");
			return false;
		}
		//Function for onreadystatechange and displaying the data after being processed by the php file
		ajaxhttp_obj.onreadystatechange = function()
		{
			if(ajaxhttp_obj.readyState == 4)
			{
				if(ajaxhttp_obj.responseText==0)
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email Not Sent';
				}
				else
				{
					//document.getElementById("ajaxdiv_summary_StudentParent").innerHTML='Email sent';
					//alert('Email sending Successful');
					//setTimeout("delaylogin();",1000);
				}
			}
		
		}
		var index = id;
		//alert(index);
		var letter_format = document.getElementById('email_to_send_on_MONTH_START_REPORT'+index).value;
		var student_email = document.getElementById('email_id'+index).value;
		var ttl_email = document.getElementById('ttl_email'+index).value;
		var mttl_email = document.getElementById('mttl_email'+index).value;
		//alert(index+student_email+ttl_email+mttl_email);
		if(student_email==''){
			alert('Email field is empty');
		}
		else{
		var queryString = "letter_format=" + letter_format +"&student_email=" + student_email +"&ttl_email=" + ttl_email +"&mttl_email=" + mttl_email ;
		//initiating ajax POST request
		//alert(queryString);
		ajaxhttp_obj.open("POST","PHPMailer-master/send-mail_email_to_send_on_MONTH_START_REPORT.php",true);
		alert("Email Sent");
		//This function indicate what type of content we are including, it sends a header to tell the server to recognize the sent data as if they were sent with POST (like data from Forms).
		ajaxhttp_obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajaxhttp_obj.send(queryString);
		//window.location.href="user.php";
		}
	}
	

	
	
	
	/*
	
	/* if the page has been fully loaded we add two click handlers to the button */
$(document).ready(function () {
    /* Get the checkboxes values based on the class attached to each check box */
    $("#buttonClass").click(function() {
        getValueUsingClass();
    });
     
    /* Get the checkboxes values based on the parent div id */
    $("#buttonParent").click(function() {
        getValueUsingParentTag();
    });
});

function getValueUsingClass(){
    /* declare an checkbox array */
    var chkArray = [];
     
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
    });
     
    /* we join the array separated by the comma */
    var selected;
    selected = chkArray.join(',');
     
    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
    if(selected.length > 1){	
		
		alert("You have selected " + selected); 
		var req = ajaxhttp_func();
		var queryString = "include/getEmail_for_sending.php?ids_for_email="+selected;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("customer_email").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}	
    }else{
        alert("Please at least one of the checkbox");   
    }
}






	/*>>>>>>>>>>>>>>>>>>> FOR HR RECOMMENDATION for Leave App Form Approval<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	/* if the page has been fully loaded we add two click handlers to the button */
$(document).ready(function () {
    /* Get the checkboxes values based on the class attached to each check box */
    $("#buttonClass_recommend_hr").click(function() {
        getValueUsingClass_recommend_hr();
    });
     
    /* Get the checkboxes values based on the parent div id */
    $("#buttonParent").click(function() {
        getValueUsingParentTag();
    });
});

function getValueUsingClass_recommend_hr(){
    /* declare an checkbox array */
    var chkArray = [];
     
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
		var index = $(this).val();
	var HRReceive = document.getElementById('HRReceive'+index );
	HRReceiveValue = HRReceive.value;
	var HRComments = document.getElementById('HRComments'+index).value;
	//alert("You have selected " + index + "-" + HRReceiveValue + HRComments); 
		var req = ajaxhttp_func();
		var queryString = "include/getANDupdate_hr_approval.php?id="+index+"&HRReceive="+HRReceiveValue+"&HRComments="+HRComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("result_div").innerHTML=req.responseText;
						alert("ALL UPDATED ---" + chkArray);
						window.location.href = 'leave_application_list_hr.php';
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}
	
    });
     
    /* we join the array separated by the comma */
	var selected;
    selected = chkArray.join(',');
	
    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
    if(selected.length > 0){	
		
		//alert("You have selected " + selected + HRReceive); 
		//var req = ajaxhttp_func();
		//var queryString = "include/getANDupdate_hr_approval.php?id="+index+"&HRReceive="+HRReceiveValue+"&HRComments="+HRComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("customer_email").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}	
    }else{
        alert("Please Select at least one of the checkbox");   
    }
}


	/*>>>>>>>>>>>>>>>>>>> FOR GM RECOMMENDATION for Leave App Form Approval<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	/* if the page has been fully loaded we add two click handlers to the button */
$(document).ready(function () {
    /* Get the checkboxes values based on the class attached to each check box */
    $("#buttonClass_recommend_gm").click(function() {
        getValueUsingClass_recommend_gm();
    });
     
    /* Get the checkboxes values based on the parent div id */
    $("#buttonParent").click(function() {
        getValueUsingParentTag();
    });
});

function getValueUsingClass_recommend_gm(){
    /* declare an checkbox array */
    var chkArray = [];
     
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
		var index = $(this).val();
	var GMApprove = document.getElementById('GMApprove'+index );
	GMApproveValue = GMApprove.value;
	var GMComments = document.getElementById('GMComments'+index).value;
	//alert("You have selected " + index + "-" + HRReceiveValue + GMComments); 
		var req = ajaxhttp_func();
		var queryString = "include/getANDupdate_GM_approve.php?id="+index+"&GMApprove="+GMApproveValue+"&GMComments="+GMComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("result_div").innerHTML=req.responseText;
						alert("ALL UPDATED GM ---" + chkArray);
						window.location.href = 'leave_application_list_gm.php';
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}
	
    });
     
    /* we join the array separated by the comma */
	var selected;
    selected = chkArray.join(',');
	
    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
    if(selected.length > 0){	
		
		//alert("You have selected " + selected + HRReceive); 
		//var req = ajaxhttp_func();
		//var queryString = "include/getANDupdate_hr_approval.php?id="+index+"&HRReceive="+HRReceiveValue+"&HRComments="+HRComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("customer_email").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}	
    }else{
        alert("Please Select at least one of the checkbox");   
    }
}





	/*>>>>>>>>>>>>>>>>>>> FOR TEAMLEAD RECOMMENDATION for Leave App Form Approval<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	/* if the page has been fully loaded we add two click handlers to the button */
$(document).ready(function () {
    /* Get the checkboxes values based on the class attached to each check box */
    $("#buttonClass_recommend_teamlead").click(function() {
        getValueUsingClass_recommend_teamlead();
    });
     
    /* Get the checkboxes values based on the parent div id */
    $("#buttonParent").click(function() {
        getValueUsingParentTag();
    });
});

function getValueUsingClass_recommend_teamlead(){
    /* declare an checkbox array */
    var chkArray = [];
     
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
		var index = $(this).val();
	var TLRecommend = document.getElementById('TLRecommend'+index );
	TLRecommendValue = TLRecommend.value;
	var TLComments = document.getElementById('TLComments'+index).value;
	//alert("You have selected " + index + "-" + HRReceiveValue + TLComments); 
		var req = ajaxhttp_func();
		var queryString = "include/getANDupdate_TL_recommend.php?id="+index+"&TLRecommend="+TLRecommendValue+"&TLComments="+TLComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("result_div").innerHTML=req.responseText;
						alert("ALL UPDATED TEAMLEAD ---" + chkArray);
						window.location.href = 'leave_application_list_teamlead.php';
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}
	
    });
     
    /* we join the array separated by the comma */
	var selected;
    selected = chkArray.join(',');
	
    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
    if(selected.length > 0){	
		
		//alert("You have selected " + selected + HRReceive); 
		//var req = ajaxhttp_func();
		//var queryString = "include/getANDupdate_hr_approval.php?id="+index+"&HRReceive="+HRReceiveValue+"&HRComments="+HRComments;
		//alert(student_id);
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("customer_email").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", queryString, true);
			req.send(null);
			//alert("SENT");
		}	
    }else{
        alert("Please Select at least one of the checkbox");   
    }
}
	
	
</script>











<script type="text/javascript">

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll=2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
var marqueespeed=2 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var actualheight=''

function scrollmarquee(){
if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) //if scroller hasn't reached the end of its height
cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px" //move scroller upwards
else //else, reset to original position
cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
}

function initializemarquee(){
cross_marquee=document.getElementById("vmarquee")
cross_marquee.style.top=0
marqueeheight=document.getElementById("marqueecontainer").offsetHeight
actualheight=cross_marquee.offsetHeight //height of marquee content (much of which is hidden from view)
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee.style.height=marqueeheight+"px"
cross_marquee.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee)
else if (document.getElementById)
window.onload=initializemarquee





//<<<<<<<<<<**********	Assigning parent to the student	**********>>>>>>>>>> //NEWLY ADDED //07-12-16
function availableStudent(usertype_student) {		
		var req = ajaxhttp_func();
		var usertype_student=document.getElementById('usertype_student').value;
		var strURL="include/getavailableStudentParent.php?usertype_student="+usertype_student;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statediv").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
function availableParent_of_Student(usertype_student,parent_id) {		
		var req = ajaxhttp_func();
		var parent_id=document.getElementById('state').value;
		var strURL="include/getavailableParent_of_Student.php?usertype_student="+usertype_student+"&parent_id="+parent_id;
		
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById("statedivunder").innerHTML=req.responseText;						
					} 
					else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
			//alert("SENT");
		}	
	}
//<<<<<<<<<<**********									**********>>>>>>>>>>


</script>
