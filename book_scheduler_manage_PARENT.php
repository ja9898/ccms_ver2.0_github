<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
//getStartTimeFilter();
if($_SESSION['userType']==1 || $_SESSION['userType']==8)
{
// class amt_start_range is used NOT to enter the CHARACTERS in the textbox using jquery
//echo getInput_number('','start_range','amt_start_range','Amt Start Range');
?>&nbsp;&nbsp;&nbsp;<?
// class amt_end_range is used NOT to enter the CHARACTERS in the textbox using jquery
//echo getInput_number('','end_range','amt_end_range','Amt End Range');
} ?></div>
<div style="float:left">
<?php
//getCourseFilter();
getParentFilter();
getFilterSubmit();
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?></div>
<br>
</form>
</div>
<?
if($_POST['search-submit']){
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
//echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Ext ID OLD</b></th>";
echo "<th class='specalt'><b>Extension ID</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Dues - USD</b></th>"; 
echo "<th class='specalt'><b>Dues - Original</b></th>"; 
echo "<th class='specalt'><b>Pay Date</b></th>";
echo "<th class='specalt'><b>Currency</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>"; 
echo "<th class='specalt'><b>USERNAME</b></th>"; 
echo "<th class='specalt'><b>PASSWORD</b></th>"; 
echo "<th class='specalt' colspan=8><b>Actions</b></th>";  
echo "</tr>";
/* }  */
if($_SESSION['userType']==5 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ) )
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and campus_schedule.std_status!='4'  and campus_schedule.std_status!='7' and status_freeze=0 and status_dead=0 and status_transfertolhr=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main_PARENT();
}

else if($_SESSION['userType']==9 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent();
}

else if($_SESSION['userType']==13)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_quran_readonly();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 || $_POST['search-parent-id']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main_PARENT();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==16 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent_main();
}

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else if(   ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 || $_POST['search-parent-id']!=0 )  ){
	$result = getResultResource_superadmin_PARENT();
	}
else
{
	echo "<br>";echo "<br>";echo "<br>";echo "<br>";
	echo "<div  style='color:red; font-size:16px; position:relative;'>Apply proper filters</div>";
}

//One month range for ABSENT ALERT	
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);
$sub_date = mysql_real_escape_string(date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days')));	
//Adding this for PRIORITY
$systemdate = systemDate();
//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
//Arrays for the Amount sum
$cad_amt=array();
$usd_amt=array();
$org_amt=array();

$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.id as stu_id , `campus_students`.extId_old ,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline, `campus_students`.username , `campus_students`.password ,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
	$cad_amt[$row['id']] = $row['dues'];
	$usd_amt[$row['id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	$org_amt[$row['id']] = $row['dues_original'];
}
else
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
	$cad_amt[$row['id']] = $row['dues'];
	$usd_amt[$row['id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	$org_amt[$row['id']] = $row['dues_original'];
}

if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
{
	/*echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
	echo "</td>";*/
}
else
{
	//echo "<td valign='top'>N/A</td>";
}
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$rows['extId_old']."' target=_blank >" . $rows['extId_old'] . "</a></td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['stu_id']))."' target=_blank >" . getextID(nl2br( $rows['stu_id'])) . "</a></td>";
$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
//BEST EXAMPLE TO JOIN 2 TABLES FOR UPDATING THE RECORD IN THE OTHER TABLE WHICH HAS THE PRIMARY KEY
//http://stackoverflow.com/questions/9957171/how-to-join-two-tables-in-an-update-statement
//http://stackoverflow.com/questions/4840833/mysql-add-12-hours-to-a-time-field
//Following condition of startDate is added so that schedule with startDate less than systemDate must be shown
if($row['startDate']>$systemdate && $_SESSION['userType']==8)
{
	echo "<td valign='top' style='color:RED; font-weight:bold'>Schedule will be activated after the given date - " . nl2br( $row['startDate']) . "</td>";
}
else
{
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['statussch']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
if($days>=16)
{
	echo "<td valign='top'>Normal</td>";
}
else
{
	echo "<td valign='top' style='color:red; font-weight:bold'>Special</td>";
}  
echo "<td valign='top'>" . showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>"; 
$dues_usd = round($row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
echo "<td valign='top'>" . $dues_usd . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . $row['dues_original'] . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . date('d',strtotime($row['paydate'])) . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . getData(nl2br( $row['currency_array']),'currency') . "</td>";
echo "<td valign='top'>" . nl2br( $row['skypetext']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $rows['username']) . "</td>";
echo "<td valign='top'>" . nl2br( $rows['password']) . "</td>";

$get_pending_invoice = mysql_query("SELECT ti.paid_status,ti.invoice_id
								FROM tbl_invoices ti
								INNER JOIN `tbl_invoices_details` tid ON ti.invoice_id = tid.invoice_id
								WHERE ti.paid_status <>'2' AND tid.student_id ='".$row['studentIDPARENT']."'  ORDER BY ti.id DESC  LIMIT 0,1") ;
		
		$already_pending_count =mysql_num_rows($get_pending_invoice);
		$last_invoice_detail 	= 	mysql_fetch_array($get_pending_invoice);
			
		
		if($row['statussch']==1){
			$action ='create_inovice_trial';
		}
		else{
			$action ='create_inovice';
		}

	$schedule_id = $row['id'];

?>

<?php if($last_invoice_detail['paid_status']=='0')
{ ?>
<td valign='top'><a href="book_scheduler_manage_PARENT.php?pid=<?php echo base64_encode($row['parentId']);?>&schedule_id=<?php echo $schedule_id;?>&action=<?php echo $action;?>&cancel_id=<?php echo $last_invoice_detail['invoice_id']; ?>">Cancel and Create Invoice</a></td>
<?php }
else if($last_invoice_detail['paid_status']=='1' || $last_invoice_detail['paid_status']=='2'|| $last_invoice_detail['paid_status']=='' || $last_invoice_detail['paid_status']=='3'){?>
<td valign='top'><a href="book_scheduler_manage_PARENT.php?pid=<?php echo base64_encode($row['parentId']);?>&schedule_id=<?php echo $schedule_id;?>&action=<?php echo $action;?>"  >Create Invoice</a></td>
<?php } ?>

<?
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
}

else if($_SESSION['userType']==10 || $_SESSION['userType']==9 || $_SESSION['userType']==16)
{
}

else
{
	
}
echo "</tr>"; 
}
echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'>Sum </td>";  
	echo "<td valign='top'><b>$" . nl2br( array_sum($cad_amt)) . "</td>"; 
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" .  round(array_sum($usd_amt)) . "</td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" .  round(array_sum($org_amt)) . "</td>";	
echo "</tr>";
echo "</table>";
}
//define('EURL','https://vbasacademy.com/');
define('EURL','http://www.yourcloudcampus.com/pay/');
//define('EURL','http://bamboo.ga/ora8/');
/* define('EURL','http://bamboo.ga/ora11/'); */
//define('EURL','http://bamboo.ga/ora15/');
?>











<!-- SAVE PRVIEWED INVOICE  START-->
<?php 
if($_POST['action']=='save_invoice'){
$parent_id 		= $_POST['parent_id'];
$invoiceid 		= $_POST['invoice_id'];
$schedule_id = $_POST['schedule_id'];
//echo "<pre>";
//print_r($_POST);echo "<br>";echo "<br>";echo "<br>";
//print_r($_POST['child_list']);echo "<br>";echo "<br>";echo "<br>";
//print_r($_POST['schedule_id_list_4']);echo "<br>";echo "<br>";echo "<br>";
//exit;
$email_invoice ='<table align="center" width="100%" cellpadding="0" cellspacing="0" 
style="color:#000000;font-family:Arial, Helvetica, sans-serif; font-size:12px">
<tr>
<td align="center" height="10" colspan="2" style="border-top:#000000 3px solid;
color:#000000; font-weight:bold; font-size:24px;padding-top:20px;text-transform:uppercase;"><span style=" font-size:24px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">MONTHLY INVOICE</span> </td>
</tr>
<tr>
<td align="left" style="color:#000000; font-weight:bold; font-size:24px;
padding-top:20px;text-transform:uppercase;">
<img src="http://www.yourcloudcampus.com/images/nine-flat-logo.png" alt="" /><br>
YourCloudCampus<br />
<span style=" font-size:15px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, 
sans-serif;">YourCloudCampus</span>
</td>
<td align="right" valign="top" style="color:#000000; font-size:15px; font-weight:bold;
padding-top:20px;">INVOICE # '.$invoiceid.'<br />ISSUE DATE: '.date('d M,Y').'<br>
<font color="#FF0000">
'.$pay_date_final.'</font>
</td>
</tr>
<tr>
<td width="77%" align="left" style="color:#000000; font-weight:bold; font-size:24px;
padding-top:20px;text-transform:uppercase"><p><span style="color:#000000; font-size:15px; 
font-weight:bold; padding-top:20px;">Place,Level 24 ,Tower 1,<br />
United Kingdom <br />
Tel: 121-288-3093(UK) <br />
Tel: 215-764-6162(USA)<br />
</span></p></td>
<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; 
font-weight:bold;padding-top:20px; color:#F00"> <span style="border:#F00 3px solid;padding:10px;">Unpaid </span></td>
</tr>
<tr>
    <td width="50%" align="left" style="color:#000000; font-size:15px; font-weight:bold; 
	padding-top:20px;" colspan="2">TO<br />
'.ucfirst(getparentname($_POST['parent_id'])).' ['.$_POST['parent_id'].']<br></td></tr>
<tr><td colspan="2"></td></tr>
<tr style="height:30px;">
    <td colspan="2" align="center">
        <table align="center" width="100%" style="font-size:15px; color:#000000;" 
		cellpadding="0" cellspacing="0">
            <tr style="height:30px;">
                <td  align="center" style="font-weight:bold; border-top:#000000 2px solid;
				border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Student Name</td>';
			    if(send_invoice_usd($_POST['parent_id']) == "Yes"){
                $email_invoice .= '<td  align="center" style="font-weight:bold;
				border-top:#000000 2px solid;border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Monthly Fee(USD)</td>';
				}else{
				 $email_invoice .= '
				<td  align="center" style="font-weight:bold;border-top:#000000 2px solid;
				border-left:#000000 2px solid; border-bottom:#000000 2px solid;
				background-color:#F3F3F3;text-transform:uppercase ">
				Monthly Fee('.get_user_currency_from_SCH($schedule_id).')</td>';
				}
				
				/* if($_POST['reg_column']=='1'){//if trial flag is true
               $email_invoice .=  '<td  align="center" style="font-weight:bold;
			   border-top:#000000 2px solid;border-left:#000000 2px solid; 
			   border-bottom:#000000 2px solid;background-color:#F3F3F3;
			   text-transform:uppercase ">Reg Fee</td>';
				}
				else{
					 $email_invoice .=  '<td  align="center" style="font-weight:bold;
					 border-top:#000000 2px solid; border-bottom:#000000 2px solid;
					 background-color:#F3F3F3;text-transform:uppercase "></td>';
				} */				
              /* $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">No Of Months</td>'; */
			  
			  // DUEDATE GENERATION 		//START
			  $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">DUE DATE</td>';
			  // DUEDATE GENERATION 		//END
			  
			  // days and months 		//START
			  /* $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">NO OF MONTHS-org</td>'; */
			  // days and months 		//END
			  
			  /* if(check_sms_alert($_POST['parent_id']) == "Yes"){ 
			  	$email_invoice .=   '<td  align="center" style="font-weight:bold;
				border-top:#000000 2px solid;border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">SMS Charges</td>';
			  } */
			  if(send_invoice_usd($_POST['parent_id']) == "Yes"){ 
                $email_invoice .=   '<td  align="center" style="font-weight:bold; 
				border:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase" >Total (USD)</td>';
			  }else{
				  $email_invoice .=   '<td  align="center" style="font-weight:bold;
				  border-top:#000000 2px solid;border-bottom:#000000 2px solid;
				  border-right:#000000 2px solid;border-left:#000000 2px solid;
				  background-color:#F3F3F3;text-transform:uppercase ">
				  Total ('.get_user_currency_from_SCH($schedule_id).')</td>';
				 }
            	$email_invoice .=   '</tr>' ;
				$grand_total = 0 ;
                $registration_fee = 0 ;
                $currency_grand_total  				= 0	 ;
				foreach($_POST['child_list'] as $child_id){//childs foreach start  
              	$reg_fee 							= 		0;
                $sub_total							=  		0;
				$amount_to_send						=		0;
				$total_sms_charges					=		0;
				$months 							= 		$_POST['months_'.$child_id];
				$days 								= 		$_POST['days_'.$child_id];
			 	$amount_to_send						= 		$_POST['send_amount_'.$child_id];
				$amount_to_send_local_curreny		= 		$_POST['send_local_amount_'.$child_id];
				$reg_fee 							= 		$_POST['registration_fee_'.$child_id];
				$per_day_amount						= 		$_POST['per_day_amount_'.$child_id];
				$per_day_amount_local_curreny		= 		$_POST['local_per_day_amount_'.$child_id];
				$due_date							=		$_POST['curr_due_date_'.$child_id];
				//$invoice_duration 					=  		'1 month';
				//$months								=		1;
				$invoice_duration 					=  		'';
				//Calculating days and months
				if($days>0 || $months>0){
					$invoice_duration_original = $months.' month '.$days.' days ';				
				}
				 $find_children="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,campus_students.lastName,
	campus_students.parentId,campus_students.std_status,campus_students.email     	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and 
	campus_schedule.std_status=2 and campus_students.std_status=2 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.status_transfertolhr=0 and 
	campus_students.id=campus_schedule.studentID and 
	campus_schedule.id='".$child_id."' and 
	campus_students.parentId = ".$parent_id ;
				$query_children	=		mysql_query($find_children);
                $num			=		mysql_num_rows($query_children);
                $child_data 	=       mysql_fetch_array($query_children);	
				$query_email = $child_data['email'];
				$pay_date = $child_data['paydate'];
				$dues = $child_data['dues_original'];
				//$amount_to_send_local_curreny = $child_data['dues_original'];
				$currency = $child_data['currency_array'];
				$schedule_id_of_query = $child_data['id'];
				$teacherID = $child_data['teacherID'];
//*************************** NEXT DUEDATE GENERATION		//START 
//getting paydate DAY and checking the last transaction MAX DATE to check which month & year
//is paid so next DUEDATE must be generated
//<<<<<<<<<<<<<< Getting PAYDATE from campus_schedule
$sql_sch_date = "SELECT * FROM campus_schedule WHERE id='".$schedule_id_of_query."'";
$result_sch_date = mysql_query($sql_sch_date);
$row_sch_date = mysql_fetch_array($result_sch_date);
$pay_date = $row_sch_date['paydate'];
//<<<<<<<<<<<<<< Getting LAST TRANSACTION date from campus_transaction
$sql_chk_tran = "SELECT MAX(dateRecieved) as maxdate_rec 
FROM campus_transaction WHERE schedule_id='".$schedule_id_of_query."'";
$result_chk_tran = mysql_query($sql_chk_tran);
$row_chk_tran = mysql_fetch_array($result_chk_tran);
$max_pay_date_PRR = $row_chk_tran['maxdate_rec'];
//<<<<<<<<<<<<<< Generating the next PAY DATE/DUE DATE for invoice
$paydate_date_from_sch = date('d', strtotime( nl2br($pay_date)));
$paydate_month = date('m', strtotime( nl2br($max_pay_date_PRR)));
$paydate_year = date('Y', strtotime( nl2br($max_pay_date_PRR)));
if($paydate_month>=12)
{
	$paydate_month = 1;
	$paydate_year = $paydate_year + 1;
}
else
{
	$paydate_month = $paydate_month+1;
}
$pay_date_final = $paydate_year."-".$paydate_month."-".$paydate_date_from_sch;
//*DUE DATE: '.date('d M,Y',mktime(0, 0, 0, date('m'), date('d') + 5, date('Y'))).'</font></td>
//*************************** NEXT DUEDATE GENERATION		//END

// NEXT DUE DATE GENERATION after above duedate calculations
	$paydate_month = $paydate_month+1;
	$pay_date_final_NEXT_DUE_DATE = $paydate_year."-".$paydate_month."-".$paydate_date_from_sch;
///////////////////////////////////////////////////////////

//Code to get the TEAMLEAD ID
$sql_get_LEAD_and_MAINLEAD = mysql_fetch_array (mysql_query("SELECT * 
FROM capmus_users
WHERE id='$teacherID'")) or die(mysql_error());
$LeadId = $sql_get_LEAD_and_MAINLEAD['LeadId'];
$main_LeadId = $sql_get_LEAD_and_MAINLEAD['main_LeadId'];
/////////////////////////////
				//
				$original_curr = get_user_currency_from_SCH($schedule_id_of_query);
				//Get curr values from campus_currency
				$sql_curr_to_dollar_rate="SELECT * 
				FROM campus_currency 
				ORDER BY  id DESC 
				LIMIT 1";//WHERE id = 657"
				$row_curr_to_dollar_rate= mysql_fetch_array(mysql_query($sql_curr_to_dollar_rate));
				if($original_curr=='USD'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_usd_to_usd']); }
				if($original_curr=='GBP'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_gbp_to_usd']); }
				if($original_curr=='AUD'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_aud_to_usd']); }
				if($original_curr=='CAD'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_cad_to_usd_new']); }
				if($original_curr=='NZD'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_nzd_to_usd']); }
				if($original_curr=='SGD'){ echo $original_curr_converted = round($dues*$row_curr_to_dollar_rate['1_sgd_to_usd']); }				
				//
				$amount_to_send = $original_curr_converted;
				
				
				if( $child_data['std_status']==1){
					if($months==0){
						$next_due_date = strtotime(date("Y-m-d", strtotime($pay_date)) . 
						" -1 month");
					}
					else{
						$next_due_date = strtotime(date("Y-m-d", strtotime($pay_date)) . 
						" +".($months-1)." month");
					}
				}
				else{
					$next_pay_date = strtotime(date("Y-m-d", strtotime($pay_date)) . 
					" + 1 month");
					/* $next_due_date = strtotime(date("Y-m-d", $next_due_date) . 
					" +".$days." days"); */
					$next_pay_date = strtotime(date("Y-m-d", strtotime($pay_date)) . " +".$months." month");
					$next_pay_date = strtotime(date("Y-m-d", $next_pay_date) . " +".$days." days");
				}
				
					/* if(check_sms_alert($_POST['parent_id']) == "Yes"){  // For SMS Pricing
				
						$count_days = ($_POST['months_'.$child_id] * 30)+ $_POST['days_'.
						$child_id] ; 
						$sql_sms_charges = mysql_query("SELECT * from tbl_plan 
						where id = '".$child_data['planId']."'");
						$res_sms_charges = mysql_fetch_array($sql_sms_charges);
						$per_sms_charges = $res_sms_charges['sms_charges'] / 30 ;
						$total_sms_charges  = round(($per_sms_charges * $count_days)) ; 
						
						if(get_user_currency($_POST['parent_id']) != "USD" && 
						send_invoice_usd($_POST['parent_id']) == "No"){
							$total_sms_charges_local  = 
							round( currency_converter('USD',get_user_currency($_POST['parent_id']),$total_sms_charges));
						} // End IF
						
			   } // End of SMS charges. */
			   
			   /* if($child_data['dues'] == 0 ){ // For Free Students.
 				   $total_sms_charges = 0 ; 
			   } */
			   //SEND USD INVOICE OR IN USER CURRENCY INVOICE
			   if(send_invoice_usd($_POST['parent_id']) == "Yes"){
			   	$send_usd_invoice = 1 ;
			   }else{
			   	$send_usd_invoice = 0 ;
			   }
			    $voice_id = $child_data['voice_id'] ;
				
				/**************************Insertion in invoices detail table*****************************/		
					$insert_invoice_details = "INSERT INTO tbl_invoices_details SET 
					invoice_id = '".$invoiceid."',
					pid          		= '".$child_data['parentId']."',
					student_id   		= '".$child_data['studentIDPARENT']."',
					student_name 		= '".trim($child_data['firstName'].' '.$child_data['lastName'])."',
					due_date 	 	= '".$pay_date_final."',
					next_due_date 	 	= '".date('Y-m-d',$pay_date_final_NEXT_DUE_DATE)."',
					invoice_date 		= '".date('Y-m-d')."',
				   	monthly_fee	 	= '".$child_data['dues']."',
					months			= '".$months."',
					days			= '".$days ."',
					registration_fee	= '".$reg_fee."',
					payment 		= '".$amount_to_send."',
					payment_local 		= '".$amount_to_send_local_curreny."',
					currency 		= '".$currency."',
					send_usd_invoice	= '".$send_usd_invoice."',
					team_id 		= '".$LeadId."',
					voice_id		= '".$voice_id."',
					schedule_id		= '".$schedule_id_of_query."', 
					teacherID		= '".$teacherID."' " ;
					
					$exe_insert_invoice_details = mysql_query($insert_invoice_details) or die(mysql_error().$insert_invoice_details); 
          $email_invoice .= 	'<tr style="height:50px;">
                <td align="center" style="border-left:#000000 2px solid;
				border-bottom:#000000 1px solid;">
				'.ucfirst($child_data['firstName']).' '.$child_data['lastName'].'</td>';
				 if(send_invoice_usd($_POST['parent_id']) == "Yes"){  
                  $email_invoice .= '<td align="center" 
				  style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;
				  " >'.$child_data['dues'].' USD</td>';
				 }else{
				  $email_invoice .= '<td align="center" 
				  style="border-left:#000000 2px solid; border-bottom:#000000 1px solid;
				  " >'.$child_data['dues_original'].' '.get_user_currency_from_SCH($schedule_id_of_query).'</td>';
				 }
				/* if($_POST['reg_column']=='1'){
				 $email_invoice .= '<td align="center" 
				 style="border-left:#000000 2px solid;
				 border-bottom:#000000 1px solid;" >'.$reg_fee.' USD</td>';
				}
				else{
		 $email_invoice .= '<td align="center" style="border-bottom:#000000 1px solid;" >
		 </td>';
				} */
							   
         /* $email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		 border-bottom:#000000 1px solid;" >'.$invoice_duration.'</td>'; */
		 
		// DUEDATE GENERATION 		//START
		$email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		border-bottom:#000000 1px solid; color:red" >'.$pay_date_final.'</td>';
		// DUEDATE GENERATION 		//END
		
		// days and months 		//START
		/* $email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		border-bottom:#000000 1px solid; color:red" >'.$invoice_duration_original.'</td>'; */
		// days and months 		//END
               /*  if(check_sms_alert($_POST['parent_id']) == "Yes"){ 
		$email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		border-bottom:#000000 1px solid;" >'.$total_sms_charges.'</td>';			 
		 } */
		if(send_invoice_usd($_POST['parent_id']) == "Yes"){         
				$email_invoice  .='<td align="center" 
				style="border-left:#000000 2px solid; border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >
				'.($amount_to_send).'</td>';
		}else{
				$email_invoice  .='<td align="center" 
				style="border-left:#000000 2px solid; border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >
				'.($amount_to_send_local_curreny).'</td>';
			 }
            $email_invoice  .='</tr>';
            $currency_grand_total += (round($amount_to_send_local_curreny) ); 
            $grand_total += (round($amount_to_send) );
            
			}//end childs foreach loop
            /* $email_invoice .='<tr style="height:50px;">
            <td  align="right" style="font-weight:bold; font-size:15px; 
			color:#000000; padding-right:15px;">&nbsp;</td>'; */
           	/* if(check_sms_alert($_POST['parent_id']) == "Yes"){
		    	$email_invoice .='<td align="center"  >&nbsp;</td>';
			} */
			
			$email_invoice .='<td colspan="3" align="right" style="font-weight:bold; 
			font-size:15px; color:#000000; padding-right:15px;">GRAND TOTAL :</td>';
             if(send_invoice_usd($_POST['parent_id']) == "Yes"){    
				$email_invoice.='<td align="center">'.$grand_total.'USD</td>';
			 }else{
				$email_invoice.='<td align="center">'.$currency_grand_total.' '.get_user_currency_from_SCH($schedule_id_of_query).'</td>';
			 }
			$email_invoice .='</tr>
        </table>
    </td>
</tr>';
/* <tr style="line-height:20px;"><td colspan="2"><br><font color="#FF0000" 
style="font-weight:bold; font-size:11px">
* Important: Please note that a surcharge of $5 will be applied in case of late fee 
submission.<br>*Note: Customers those like to PAY in any other currency than USD, 
they can either reply to this email or contact our Customer Support. We will make 
sure that your request is entertained (upon request).<br> */
/* if(check_sms_alert($_POST['parent_id']) == "Yes" && 
send_invoice_usd($_POST['parent_id']) == "No" ){
 $email_invoice.='For SMS Conversion Rate : 1 USD = 
 '.round(currency_converter('USD',get_user_currency($_POST['parent_id']),1),2).' 
 '.get_user_currency($_POST['parent_id']);
} */
/* $email_invoice .='</font><br><br><br></td></tr>'; */
/* if($grand_total<=0){
$email_invoice.='<tr style="line-height:20px;">
<td colspan="2" style="font-weight:bold; background-color: #F3F3F3; 
font-size:15px;">As WE are offering you FREE CLASSES so please 
<a  href="'.EURL.'customer/makeinvoice-as-paid/
'.base64_encode($invoiceid).'/'.base64_encode('paid').'">
CLICK HERE</a> to mark the Invoice as PAID. Thank you.</td></tr>
'; }else{ */
$email_invoice.='<tr style="line-height:20px;"><td colspan="2" 
style="font-weight:bold; background-color: #F3F3F3; font-size:15px;">
<a  href="'.EURL.'customer/invoice-preview/
'.base64_encode($invoiceid).'/
'.base64_encode('paypal_payment').'//
'.base64_encode(get_user_currency_from_SCH($schedule_id_of_query)).'">
CLICK HERE</a> to pay with paypal. Thank you.</td></tr>';	
/* } */
$email_invoice.='<tr style="line-height:100px;"><td colspan="2"></td></tr>
<tr align="center" style="color:#000000;font-weight:bold; font-size:16px;">
<td colspan="2"><span style="font-size:12px;font-weight:normal;"><strong>
YourCloudCampus</strong></span></td></tr><tr>
<td colspan="2" align="center" style="font-size:11px;"><br><strong>
Beta Version v1.10</strong></td></tr><tr>
<td colspan="2" style="border-bottom:#000000 3px solid;"></td></tr></table>';
//echo $email_invoice;
			/**************************Insertion in invoice table*****************************/			
			//$next_due_date = strtotime("+".$months." months", strtotime($due_date));
			if($_POST['customer_invoice_email']!=''){
				$customer_invoice_email_last = 	$_POST['customer_invoice_email'];	
			}
			else{
				//$customer_invoice_email = 	get_customer_invoice_email_address($parent_id);	
				$customer_invoice_email_last = 	$query_email;	 
			}
			$insert_invoice = "INSERT INTO tbl_invoices SET invoice_id = '".$invoiceid."',
											pid 			= '".$parent_id."',
											parent_name 	= '".getparentname($parent_id)."',
											due_date		= '".date('Y-m-d',mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')))."',
											invoice_email  	= '".$customer_invoice_email_last."',
											paid_status 	= '0',
											login_user_id 	= '".$_SESSION['userId']."',
											invoice_date 	= NOW(),
											pdf_file 		= '' ";
$exe_insert_invoice = mysql_query($insert_invoice) or die(mysql_error().$insert_invoice); 
//$invoice_TESTEMAIL=1;
$email_invoice_final = $email_invoice;
$email_invoice_final = stripslashes($email_invoice_final);
//Getting email of person who is generating the invoice...	//START
$sql_email_to_TL = "SELECT * FROM capmus_users WHERE id='".$_SESSION['userId']."'";
$result_email_to_TL = mysql_query($sql_email_to_TL);
$row_email_to_TL = mysql_fetch_array($result_email_to_TL);
$ccms_user_email = $row_email_to_TL['email'];
//END
?>
<!--<input cols="200" rows="350" id='email_paypal_invoice' name='email_paypal_invoice' readonly="readonly" type='hidden' value="<?php //echo $email_invoice; ?>" />-->
<textarea id='email_paypal_invoice_text' name='email_paypal_invoice_text' readonly="readonly" type='hidden' cols="200" rows="350"><?php echo $email_invoice; ?></textarea>
<input id='customer_invoice_email_last' name='customer_invoice_email_last' readonly="readonly" type='hidden' value="<?php echo $customer_invoice_email_last; ?>"/>
<input id='ccms_user_email' name='ccms_user_email' type='hidden' value="<?php echo $ccms_user_email; ?>"/>
<?
//$invoice_TESTEMAIL==1
if($exe_insert_invoice)
{
	echo '<script> send_email_paypal_invoice(); </script>';
	getMessages('add');
	echo "<script>alert('EMAIL SENT')</script>";
	echo "<script>window.location.href = 'book_scheduler_manage_PARENT.php'</script>";
}
else
{
	echo "<script>alert('Email NOT Sent')</script>";
}

/* if($exe_insert_invoice) 
	{		
		if($_POST['cancel_invoice_id']!='')//if user is canceling a invoice delete previous cancel invoice
		{
			$query_del = mysql_query("UPDATE tbl_invoices  
			SET paid_status ='2' WHERE pid='".$parent_id."' 
			AND invoice_id='".$_POST['cancel_invoice_id']."' ");
			//cancel all invoices except current created invoice
		}
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: V BAS Academy (Taleem e Quran)<no-reply@taleemequran.com>
	' . "\r\n";
	// Mail it	
    //$customer_invoice_email ; 
	if($customer_invoice_email){
		$sendemail = mail($customer_invoice_email	,'Monthly Invoice From YourCloudCampus/Taleem e Quran', $email_invoice , $headers);			
		$msg		=		base64_encode("Invoice created and sent successfully.");
	}else{
		$msg		=		base64_encode("Invoice created and but not sent successfully. due to blank email address of customer");
	}
		//$msg		=		base64_encode("Invoice created and sent successfully.");
		header("Location:list_pending_invoices.php?msg=$msg");
		exit;
	}
else
	{
		$emsg		=		base64_encode("Some error occured try again later.");
		header("Location:list_pending_invoices.php?errmsg=$emsg");
		exit;
		
	} */?>
<?php //include('include/footer.php'); 
}?>
<!-- SAVE PRVIEWED INVOICE  END-->

























<script type="text/javascript">
function calculate_total(){
	var total =0;
	local_total = 0 ;
	var reg_fee =0;
	var chks = document.getElementsByName('child_list[]');	//having ids of child  chks[i].value
	for (var i = 0; i < chks.length; i++)
		{
		if(chks[i].checked==true)
		{	
			var months		=document.getElementById('months_'+chks[i].value).value;
			var days 		=document.getElementById('days_'+chks[i].value).value;
			var per_day 	=document.getElementById('per_day_amount_'+chks[i].value).value;
			var per_month 	=document.getElementById('orignal_'+chks[i].value).value;
			var perday = per_month/30;
			var days_amount =Math.round(perday* days);
			//alert(per_day+'*'+days+'='+Math.round(days_amount));
		document.getElementById('send_amount_'+chks[i].value).value = parseInt(months)*parseInt(document.getElementById('orignal_'+chks[i].value).value)+days_amount;
		total = parseInt(total)+parseInt(document.getElementById('send_amount_'+chks[i].value).value);
		//alert(total);
		
		
			var local_months		=	document.getElementById('months_'+chks[i].value).value;
			var local_days 			=	document.getElementById('days_'+chks[i].value).value;
			var local_per_day 		=	document.getElementById('local_per_day_amount_'+chks[i].value).value;
			var local_per_month 	=	document.getElementById('local_orignal_'+chks[i].value).value;
			var local_perday 		= 	local_per_month/30;
			var local_days_amount 	=	Math.round(local_perday * days);
			
			
		//	alert(local_perday+'*'+local_days+'='+Math.round(local_days_amount));
		// alert(Math.round(days_amount));
		//	return false ;
		document.getElementById('send_local_amount_'+chks[i].value).value = parseInt(months)* parseInt(document.getElementById('local_orignal_'+chks[i].value).value) + local_days_amount;
		local_total = parseInt(local_total)+parseInt(document.getElementById('send_local_amount_'+chks[i].value).value);
		//alert(parseInt(local_total)+ parseInt(reg_fee));
		//return false ;
		
		//reg_fee = parseInt(reg_fee)+parseInt(document.getElementById('registration_fee_'+chks[i].value).value);
		}
	}
	document.getElementById('grand_total').value =  parseInt(total)+ parseInt(reg_fee);
	//alert(parseInt(local_total)+ parseInt(reg_fee));
	//return false ;
	document.getElementById('grand_total_local_currency').value =  parseInt(local_total)+ parseInt(reg_fee);
}
	
function selectAll(main){
var chks = document.getElementsByName('child_list[]');	
if(main.checked == true){
		for (var i = 0; i < chks.length; i++)
		{
		chks[i].checked = true;
		}
}
if(main.checked == false){
		for (var i = 0; i < chks.length; i++)
		{
		chks[i].checked = false;
		}
}
	calculate_total();
}

function validate_create_invoice(){
	/*		if(document.getElementById('grand_total').value =='0')
		{
			alert('Grand total amount is zero.');
				return false;
		}*/
		
			var chks = document.getElementsByName('child_list[]');	
			for (var i = 0; i < chks.length; i++)
			{
				if(chks[i].checked == true)
					return true;
			}
	return false;		
}

function parseDate(str) {
    var mdy = str.split('-')
    return new Date(mdy[0], mdy[1]-1, mdy[2]);
}


function calculate_trial_amount(std_id){
var perday = (document.getElementById(std_id+'_due_amount').value)/30;
var today = new Date();
var d1 = parseDate(document.getElementById(std_id+'_due_date').value);
var oneday = 86400000;
var dayscount =  Math.round((d1-today) / oneday);
document.getElementById(std_id+'_days').value =dayscount+' days invoice';
document.getElementById(std_id+'_amount').value =Math.round(dayscount*perday);
	//	alert(perday+'*'+dayscount+'='+dayscount*perday);
}


function validate_trial(){
	var error=0;
	 $('.select_class').each(function() {
            if ($(this).val() == "0") {
				error=error+1;
               // return false;
            }
			
});
if(error>0){

	alert('Select Due Date for trials');
	return false;
}
}	
function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
}	
</script>









<!-- LISTING END CHILD SEARCH FORM-->
<!----STEP 3---->
<!-- CREATE INVOICE  FORM-->
<?php if($_REQUEST['action']=='create_inovice' && $_REQUEST['pid']!='' ){
//print_r($_REQUEST);
//exit;	
$parent_id = base64_decode($_REQUEST['pid']);echo "<br>";
$schedule_id = $_GET['schedule_id'];
/////////////// find children of that parent/////////////
$find_children	=		"select * from campus_students where parentId='".$parent_id ."' and std_status=2 ";
$query_children	=		mysql_query($find_children);
$num			=		mysql_num_rows($query_children);	
	?>
       <form id="form" name="form" method="post" action="book_scheduler_manage_PARENT.php"  onSubmit="return validate_create_invoice(this);">
    	<table style="border:1px solid #666; margin: 0 auto; padding:10px;" width="100%" cellspacing="5" cellpadding="5">
        <tr><td colspan="2"><h2>Create Invoice</h2></td></tr>
        <?php if($_GET['cancel_id']){?>
        <tr><td colspan="2"><div class="info">For cancel invoice # <a href="view_invoice_details.php?invoice_id=<?php echo $_GET['cancel_id'];?>"  target="_new"><?php echo $_GET['cancel_id']; ?></a> you have to create a new invoice.</div></td></tr>
        <?php }?>
          <tr>
            <!--< <td width="44%" class="tbHead" align="right">Number Of Months</td>
            <td width="56%">
              <span class="rowElem">
             select name="months" id="months" class="select-box" onchange="calculate_total()">
               <option value="1" selected="selected">1</option>
               <?php for($i=2;$i<=10;$i++){?>
               <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
               <?php }?>
              </select>
            </span></td>-->
          </tr>
          <tr><td colspan="2"><h3><?php echo ucfirst(getparentname($parent_id)).' ['.$parent_id.']';?></h3></td></tr>
          <tr>
          	<td colspan="2">
            <table width="100%" cellpadding="0" cellspacing="0" class="tblMain">
             <tr>
             	<td width="3%" height="39" align="center" bgcolor="#CCCCCC" class="tbHead"  style="font-size:12px;"><input type="checkbox"  checked="checked" name="select_all" id="select_all" onClick=" selectAll(this);" /></td>
                <td width="13%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Child Name</td>
                <td width="9%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Sign In Date</td>   
                <?php if(get_user_currency_from_SCH($schedule_id) != "USD"){ ?>
                <td width="8%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Per month Dues(<?php echo get_user_currency_from_SCH($schedule_id) ; ?>)</td> <?php } ?>
                <td width="7%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Per month Dues(USD)</td>
                <td width="7%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Pay Date</td>
                <td width="4%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Status</td>
				<td width="13%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Invoice Duration</td>
                <td width="9%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Invoice Amount (USD)</td>
               <?php if(get_user_currency_from_SCH($schedule_id) != 'USD') { ?>
                 <td width="7%" class="tbHead" bgcolor="#CCCCCC" align="center"  style="font-size:12px;">Invoice Amount (<?php echo get_user_currency_from_SCH($schedule_id) ; ?>)</td>
                 <?php } ?>
            </tr> 
			<?php 
			$grand_total_local_currency = 0 ; 
			$grand_total		=0;
			
			$find_children="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,campus_students.lastName,
	campus_students.std_status,
	campus_students.parentId    	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and 
	campus_schedule.std_status=2 and campus_students.std_status=2 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.status_transfertolhr=0 and 
	campus_students.id=campus_schedule.studentID and 
	campus_students.parentId = ".$parent_id ;
	$query_children	=		mysql_query($find_children);
	$num			=		mysql_num_rows($query_children);	
			while($row1	=	mysql_fetch_array($query_children)) { ?>
                <?php 
				$stdid	=		$row1['studentIDPARENT'];
				$schedule_id_of_query = $row1['id'];
				
				$per_day_amount = $row1['dues']/30;
				$per_day_amount_local_currency = $row1['dues_original']/30;
			    if($row1['statussch']==2){
						$status='Regular';
						$due_amount =$row1['dues'];
						$due_amount_local_currency = $row1['dues_original'];
						$curr_due_date = date('d M Y',strtotime($row1['paydate']));
                }
				
				//$grand_total =$grand_total +$due_amount;
				$grand_total_local_currency += $due_amount_local_currency;
				$original_curr = get_user_currency_from_SCH($schedule_id_of_query);
				
				//Get curr values from campus_currency
				//$sql_curr_to_dollar_rate="SELECT * FROM campus_currency WHERE id = 657";
				//$row_curr_to_dollar_rate= mysql_fetch_array(mysql_query($sql_curr_to_dollar_rate));
				$sql_curr_to_dollar_rate="SELECT * 
				FROM campus_currency 
				ORDER BY  id DESC 
				LIMIT 1";
				$row_curr_to_dollar_rate= mysql_fetch_array(mysql_query($sql_curr_to_dollar_rate));
				?>
                <tr>
                <td class="tbHead" align="center" bgcolor="#FFFFFF"> <input type="checkbox" name="child_list[]"  value="<?php echo  $schedule_id_of_query; ?>"  checked="checked"  onclick="calculate_total();"/></td>
                <input type="hidden" name="schedule_id_list[]"  value="<?php echo  $schedule_id_of_query; ?>"  /></td>
                
				<td class="tbHead" align="center" bgcolor="#FFFFFF"><?php echo ucfirst($row1['firstName']).' '.$row1['lastName']; ?><br />[ <?php echo $row1['studentIDPARENT']."-".$row1['id']; ?> ]</td>
                <td class="tbHead" align="center" bgcolor="#FFFFFF"><?php echo date('d M Y',strtotime($row1['duedate'])); ?></td>
                <?php if(get_user_currency_from_SCH($schedule_id_of_query) != "USD"){ ?>
                <td class="tbHead"  align="center" bgcolor="#FFFFFF"><?php echo $row1['dues_original']; ?>(<?php echo get_user_currency_from_SCH($schedule_id_of_query); ?>)</td> <?php } ?>
                <td class="tbHead"  align="center" bgcolor="#FFFFFF"><?php 
				if($original_curr=='USD'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_usd_to_usd']); }
				if($original_curr=='GBP'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_gbp_to_usd']); }
				if($original_curr=='AUD'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_aud_to_usd']); }
				if($original_curr=='CAD'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_cad_to_usd_new']); }
				if($original_curr=='NZD'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_nzd_to_usd']); }
				if($original_curr=='SGD'){ echo round($row1['dues_original']*$row_curr_to_dollar_rate['1_sgd_to_usd']); }
				?> (USD)</td>
				
                <td	class="tbHead"  align="center" bgcolor="#FFFFFF"><label name="curr_pay_date_<?php echo  $schedule_id_of_query; ?>"   class="readonly"  id="curr_pay_date_<?php echo  $schedule_id_of_query; ?>"  value="" size="10" maxlength="50" readonly="readonly"><?php echo $row1['paydate']."[".date('d',strtotime($row1['paydate']))."]"  ;?></label></td> 
                <td	class="tbHead"  align="center" bgcolor="#FFFFFF"><?php echo $status; ?></td>
				
				
			  <td align="center">  
                <?php  if($status=='Trial'){ ?>
               <select name="months_<?php echo $schedule_id_of_query; ?>" id="months_<?php echo $schedule_id_of_query; ?>"  onchange="calculate_total()">
               <?php for($i=0;$i<=10;$i++){ ?>
               <option value="<?php echo $i; ?>" <?php if($i == $trial_month) { ?> selected="selected" <?php } ?>><?php echo $i; ?> Months</option>              <?php }?>
              </select>    
               <select name="days_<?php echo $schedule_id_of_query; ?>" id="days_<?php echo $schedule_id_of_query; ?>"  onchange="calculate_total()">
               <?php for($i=0;$i<=30;$i++){?>
               <option value="<?php echo $i; ?>" <?php   if($trial_days==$i){?> selected="selected"<?php }?>><?php echo $i; ?> days</option>
               <?php }?>
              </select>
                     
                  <!--  <input type="hidden" name="days_< ?php echo $stdid; ?>" id="days_< ?php echo $stdid; ?>" value="< ?php echo $no_of_days; ?>"  />
                    <input type="hidden" name="months_< ?php echo $stdid; ?>" id="months_< ?php echo $stdid; ?>" value="0"  />-->
                <?php }else{
				?>
               <select name="months_<?php echo $schedule_id_of_query; ?>" id="months_<?php echo $schedule_id_of_query; ?>"  onchange="calculate_total()">
               <option value="0" <?php   if($row1['statussch']==1){?> selected="selected"<?php }?>>0 Month</option>
               <option value="1" <?php   if($row1['statussch']==2){?> selected="selected"<?php }?>>1 Month</option>
               <?php for($i=2;$i<=10;$i++){ ?>
               <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
               <?php }?>
              </select>    
               <select name="days_<?php echo $schedule_id_of_query; ?>" id="days_<?php echo $schedule_id_of_query; ?>"  onchange="calculate_total()">
               <?php for($i=0;$i<=30;$i++){?>
               <option value="<?php echo $i; ?>" <?php   if($cdays==$i){?> selected="selected"<?php }?>><?php echo $i; ?> days</option>
               <?php }?>
              </select>
                <?php } ?>
              </td>
			  
			  
			  
				
				<td width="9%" class="tbHead" align="center"  style="font-size:12px;" >$<input name="send_amount_<?php echo  $schedule_id_of_query; ?>"   type="text" id="send_amount_<?php echo  $schedule_id_of_query; ?>" value="<?php 
				if($original_curr=='USD'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_usd_to_usd']); }
				if($original_curr=='GBP'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_gbp_to_usd']); }
				if($original_curr=='AUD'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_aud_to_usd']); }
				if($original_curr=='CAD'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_cad_to_usd_new']); }
				if($original_curr=='NZD'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_nzd_to_usd']); }
				if($original_curr=='SGD'){ echo $original_curr_converted = round($row1['dues_original']*$row_curr_to_dollar_rate['1_sgd_to_usd']); }
				?>" size="6" maxlength="7" readonly="readonly"  />
                <input type="hidden" value="<?php echo $original_curr_converted; ?>" id="orignal_<?php echo  $schedule_id_of_query; ?>" name="orignal_<?php echo  $schedule_id_of_query; ?>" />
                <input type="hidden" value="<?php echo $per_day_amount; ?>" id="per_day_amount_<?php echo $schedule_id_of_query; ?>" name="per_day_amount_<?php echo  $schedule_id_of_query; ?>" />
              <!-- <input type="hidden" value="<?php echo $no_of_days ; ?>" id="days_<?php echo $schedule_id_of_query; ?>" name="days_<?php echo  $schedule_id_of_query; ?>" />-->
                 </td>
                 <?php  
				 //Original currency to USD conversion output<<<<<<<<<<<<<<<<<<<<<<
				 $original_curr_converted_output += $original_curr_converted;
				 //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
				 if($original_curr != 'USD') { ?>
                 <td width="7%" class="tbHead" align="center"  style="font-size:12px;" ><?php echo $original_curr; ?>
              <!-- <input type="hidden" value="<?php echo $no_of_days ; ?>" id="days_<?php echo $schedule_id_of_query; ?>" name="days_<?php echo  $schedule_id_of_query; ?>" />-->            <input name="send_local_amount_<?php echo  $schedule_id_of_query; ?>"   type="text" id="send_local_amount_<?php echo  $schedule_id_of_query; ?>" value="<?php echo $row1['dues_original']; ?>" size="6" maxlength="7" readonly="readonly"  />
                <input type="hidden" value="<?php echo $row1['dues_original']; ?>" id="local_orignal_<?php echo  $schedule_id_of_query; ?>" name="local_orignal_<?php echo  $schedule_id_of_query; ?>" />
                <input type="hidden" value="<?php echo $per_day_amount_local_currency; ?>" id="local_per_day_amount_<?php echo $schedule_id_of_query; ?>" name="local_per_day_amount_<?php echo  $schedule_id_of_query; ?>" />  
               </td>
                 <?php  }else{ ?>
					 
					 <input name="send_local_amount_<?php echo  $schedule_id_of_query; ?>"   type="hidden" id="send_local_amount_<?php echo  $schedule_id_of_query; ?>" value="<?php echo $due_amount_local_currency; ?>" size="6" maxlength="7" readonly="readonly"  />
                <input type="hidden" value="<?php echo $row1['dues_original']; ?>" id="local_orignal_<?php echo  $schedule_id_of_query; ?>" name="local_orignal_<?php echo  $schedule_id_of_query; ?>" />
                <input type="hidden" value="<?php echo $per_day_amount_local_currency; ?>" id="local_per_day_amount_<?php echo $schedule_id_of_query; ?>" name="local_per_day_amount_<?php echo  $schedule_id_of_query; ?>" />
					  <?php }?>
              </tr>
               <?php 

			   } ?>
               
               <tr bgcolor="#CCCCCC">
                <?php if(get_user_currency_from_SCH($schedule_id_of_query) != 'USD') { ?>
               	<td colspan="8" align="right">&nbsp;</td>
               <?php }else{ ?>
               	<td colspan="7" align="right">&nbsp;</td>
               <?php }?>
               <td width="7%" colspan="" align="left" bgcolor="#CCCCCC"><b>&nbsp;&nbsp;&nbsp;&nbsp;Grand Total: </b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<input name="grand_total"  type="text" id="grand_total" size="6" maxlength="7" readonly="readonly"  value="<?php echo 	$original_curr_converted_output;?>"/></td>
               <?php if(get_user_currency_from_SCH($schedule_id_of_query) != 'USD') { ?>
               <td width="7%" colspan="" align="left" bgcolor="#CCCCCC"><b>&nbsp;&nbsp;&nbsp;&nbsp;Grand Total:</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo get_user_currency_from_SCH($schedule_id_of_query); ?><input name="grand_total_local_currency"  type="text" id="grand_total_local_currency" size="6" maxlength="7" readonly="readonly"  value="<?php echo $grand_total_local_currency; ?>"/></td>
               <?php } ?>
               </tr>
            </table>
            </td>
          </tr>
		   <tr>
           <td>
           <input type="hidden"  name="reg_column" id="reg_column"  value="<?php if($trial_check=='1'){echo '1'; }else {echo '0';}?>"/>
		     <td  align="right">
             <span class="rowElem">
               <button type="submit" style="border:1px; background:blue;">
	           <img src="images/nextlabel.gif" width="80" height="30"  /></button>
                <input type="hidden" name="action" id="action" value="preview" />
                 <input type="hidden" name="cancel_invoice_id" id="cancel_invoice_id" value="<?php echo $_REQUEST['cancel_id'];?>" />
                 <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id;?>" />
				 <input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo $schedule_id;?>" />
             </span>
             </td>
	      </tr>
        </table>
	</form>         
 <?php

  }?>

  
  
  
  

<!----STEP 4---->
<!-- PREVIEW INVOICE FORM--> 
<?php if($_POST['action']=='preview'){
//echo "<pre>";print_r($_POST);
?>
<form id="previewform" name="previewform" method="post" action="book_scheduler_manage_PARENT.php"  >
<?php
//echo "<pre>";
//print_r($_POST);echo "<br>";echo "<br>";echo "<br>";
//print_r($_POST['child_list']);echo "<br>";echo "<br>";echo "<br>";
//print_r($_POST['schedule_id_list']);echo "<br>";echo "<br>";echo "<br>";
//exit;
$parent_id = $_POST['parent_id'];
$schedule_id = $_POST['schedule_id'];
//$months 	= $_POST['months'];
$months 	= $_POST['months'];
$invoiceid 	= date("YmdHis").$_POST['parent_id'] ;
                $email_invoice = ' <table align="center" width="100%" cellpadding="0" 
				cellspacing="0" style="color:#000000;font-family:Arial, Helvetica, sans-serif; 
				font-size:12px">
<tr>
<td align="center" height="10" colspan="2" style="border-top:#000000 3px solid;color:#000000; 
font-weight:bold; font-size:24px;padding-top:20px;text-transform:uppercase;"><span style=" 
font-size:24px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, sans-serif;">
MONTHLY INVOICE</span> </td>
</tr>
<tr>
<td align="left" style="color:#000000; font-weight:bold; 
font-size:24px;padding-top:20px;text-transform:uppercase;">
<img src="http://www.yourcloudcampus.com/images/nine-flat-logo.png" alt="" />
<br />
YourCloudCampus<br />
<span style=" font-size:15px; color:#000000; font-weight:bold;font-family:Arial, Helvetica, 
sans-serif;">YourCloudCampus</span>
</td>
<td align="right" valign="top" style="color:#000000; font-size:15px; 
font-weight:bold;padding-top:20px;">INVOICE #'.$invoiceid.'<br />
DATE: '.date('d M,Y').'<br><font color="#FF0000">
*DUE DATE: '.$pay_date_final.'</font></td>
</tr>
<tr>
<td width="35%" align="left" style="color:#000000; font-weight:bold; 
font-size:24px;padding-top:20px;text-transform:uppercase"><p><span style="color:#000000; 
font-size:15px; font-weight:bold; padding-top:20px;">Place,Level 24 ,Tower 1,<br />
United Kingdom <br />
Tel: 121-288-3093(UK) <br />
Tel: 215-764-6162(USA)<br />
</span></p></td>
<td width="23%" align="right" valign="top" style="color:#000000; font-size:24px; 
font-weight:bold;padding-top:20px; color:#F00"> 
<span style="border:#F00 3px solid;padding:10px;">Unpaid </span></td>
</tr>

<tr>
    <td width="50%" align="left" style="color:#000000; font-size:15px; font-weight:bold; 
	padding-top:20px;" colspan="2">TO<br />
'.ucfirst(getparentname($_POST['parent_id'])).' ['.$_POST['parent_id'].']<br /></td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr style="height:30px;">
    <td colspan="2" align="center">
        <table align="center" width="100%" style="font-size:15px; color:#000000;" 
		cellpadding="0" cellspacing="0">
            <tr style="height:30px;">
                <td  align="center" style="font-weight:bold; 
				border-top:#000000 2px solid;border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Student Name</td>';
			    if(send_invoice_usd($_POST['parent_id']) == "Yes"){
                $email_invoice .= '<td  align="center" style="font-weight:
				bold;border-top:#000000 2px solid;border-left:#000000 2px solid; 
				border-bottom:#000000 2px solid;background-color:#F3F3F3;
				text-transform:uppercase ">Monthly Fee(USD)</td>';
				}else{
				 $email_invoice .= '
				<td  align="center" style="font-weight:bold;border-top:#000000 2px solid;
				border-left:#000000 2px solid; border-bottom:#000000 2px solid;
				background-color:#F3F3F3;text-transform:uppercase ">
				Monthly Fee('.get_user_currency_from_SCH($schedule_id).')</td>';
				}
				
				/* if($_POST['reg_column']=='1'){//if trial flag is true
               $email_invoice .=  '<td  align="center" style="font-weight:bold;
			   border-top:#000000 2px solid;border-left:#000000 2px solid; 
			   border-bottom:#000000 2px solid;background-color:#F3F3F3;
			   text-transform:uppercase ">Reg Fee</td>';
				}
				else{
					 $email_invoice .=  '<td  align="center" style="font-weight:bold;
					 border-top:#000000 2px solid; border-bottom:#000000 2px solid;
					 background-color:#F3F3F3;text-transform:uppercase "></td>';
				} */				
/*               $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">No Of Months</td>'; */
			  
			  // DUEDATE GENERATION 		//START
			  $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">DUE DATE</td>';
			  // DUEDATE GENERATION 		//END
			  
			  // days and months 		//START
			  $email_invoice .=   '<td  align="center" style="font-weight:bold;
			  border-top:#000000 2px solid;border-left:#000000 2px solid; 
			  border-bottom:#000000 2px solid;background-color:#F3F3F3;
			  text-transform:uppercase ">NO OF MONTHS-org</td>';
			  // days and months 		//END

			  if(send_invoice_usd($_POST['parent_id']) == "Yes"){ 
                $email_invoice .=   '<td  align="center" style="font-weight:bold; 
				border:#000000 2px solid;background-color:#F3F3F3;text-transform:uppercase" >Total (USD)</td>';
			  }else{
				  $email_invoice .=   '<td  align="center" style="font-weight:bold;
				  border-top:#000000 2px solid;border-bottom:#000000 2px solid;
				  border-right:#000000 2px solid;border-left:#000000 2px solid;
				  background-color:#F3F3F3;text-transform:uppercase ">
				  Total ('.get_user_currency_from_SCH($schedule_id).')</td>';
				 }
            	
				$email_invoice .=   '</tr>' ;
                $grand_total = 0 ;
                foreach($_POST['child_list'] as $child_id){//childs foreach start
				$reg_fee 							= 		0;
                $sub_total							=  		0;
				$amount_to_send						=		0;
				$amount_to_send_local_curreny		=		0;
				$per_day_amount_local_curreny		= 		0;
				$total_sms_charges					=		0;
				
				$months 							= 		$_POST['months_'.$child_id];
				$days 								= 		$_POST['days_'.$child_id];
				$amount_to_send						= 		$_POST['send_amount_'.$child_id];
				$amount_to_send_local_curreny		= 		$_POST['send_local_amount_'.$child_id];
				$reg_fee 							= 		$_POST['registration_fee_'.$child_id];
				$per_day_amount						= 		$_POST['per_day_amount_'.$child_id];
				$per_day_amount_local_curreny		= 		$_POST['local_per_day_amount_'.$child_id];
				$due_date							=		$_POST['curr_due_date_'.$child_id];
				//$invoice_duration 					=  		'1 month';
				$invoice_duration 					=  		$months.' month';
				
            $find_children="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,campus_students.lastName,
	campus_students.parentId,campus_students.std_status,campus_students.email     	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and  
	campus_schedule.std_status=2 and campus_students.std_status=2 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.status_transfertolhr=0 and 
	campus_students.id=campus_schedule.studentID and 
	campus_schedule.id='".$child_id."' and 
	campus_students.parentId = ".$parent_id ;
				$query_children						=		mysql_query($find_children);
                $num								=		mysql_num_rows($query_children);
                $child_data 						=       mysql_fetch_array($query_children);		
				$schedule_id_of_query = $child_data['id'];
				$email = $child_data['email'];
				//$amount_to_send_local_curreny = $child_data['dues_original'];
//*************************** NEXT DUEDATE GENERATION		//START 
//getting paydate DAY and checking the last transaction MAX DATE to check which month & year
//is paid so next DUEDATE must be generated
//<<<<<<<<<<<<<< Getting PAYDATE from campus_schedule
$sql_sch_date = "SELECT * FROM campus_schedule WHERE id='".$schedule_id_of_query."'";
$result_sch_date = mysql_query($sql_sch_date);
$row_sch_date = mysql_fetch_array($result_sch_date);
$pay_date = $row_sch_date['paydate'];
//<<<<<<<<<<<<<< Getting LAST TRANSACTION date from campus_transaction
$sql_chk_tran = "SELECT MAX(dateRecieved) as maxdate_rec 
FROM campus_transaction WHERE schedule_id='".$schedule_id_of_query."'";
$result_chk_tran = mysql_query($sql_chk_tran);
$row_chk_tran = mysql_fetch_array($result_chk_tran);
$max_pay_date_PRR = $row_chk_tran['maxdate_rec'];
//<<<<<<<<<<<<<< Generating the next PAY DATE/DUE DATE for invoice
$paydate_date_from_sch = date('d', strtotime( nl2br($pay_date)));
$paydate_month = date('m', strtotime( nl2br($max_pay_date_PRR)));
$paydate_year = date('Y', strtotime( nl2br($max_pay_date_PRR)));
if($paydate_month>=12)
{
	$paydate_month = 1;
	$paydate_year = $paydate_year + 1;
}
else
{
	$paydate_month = $paydate_month+1;
}
$pay_date_final = $paydate_year."-".$paydate_month."-".$paydate_date_from_sch;
//*DUE DATE: '.date('d M,Y',mktime(0, 0, 0, date('m'), date('d') + 5, date('Y'))).'</font></td>
//*************************** NEXT DUEDATE GENERATION		//END

/* 				if(check_sms_alert($_POST['parent_id']) == "Yes"){  // For SMS Pricing
				$count_days = ($_POST['months_'.$child_id] * 30)+ $_POST['days_'.$child_id] ; 
				$sql_sms_charges = mysql_query("SELECT * from tbl_plan where id = '".$child_data['planId']."'");
				$res_sms_charges = mysql_fetch_array($sql_sms_charges);
				$per_sms_charges = $res_sms_charges['sms_charges'] / 30 ;
							
				
					$total_sms_charges  = round(($per_sms_charges * $count_days )) ; 
				
					if(get_user_currency($_POST['parent_id']) != "USD" && send_invoice_usd($_POST['parent_id']) == "No"){
					
					$total_sms_charges  = round( currency_converter('USD',get_user_currency($_POST['parent_id']),$total_sms_charges));
				
					} // End IF
				
			   } // End of SMS charges. */
			    /* if($child_data['dues'] == 0 ){ // For Free Students.
 				   $total_sms_charges = 0 ; 
			   }
				//sub total each child
				if($days>0){
					$invoice_duration = $months.' month '.$days.' days ';				
				} */
				
				//Calculating days and months
				if($days>0 || $months>0){
					$invoice_duration_original = $months.' month '.$days.' days ';				
				}
				
				$email_invoice 			.= '<tr style="height:50px;">
                <td align="center" style="border-left:#000000 2px solid;
				border-bottom:#000000 1px solid;">
				'.$child_data['firstName'].' '.$child_data['lastName'].'</td>';
				 if(send_invoice_usd($_POST['parent_id']) == "Yes"){  
                  $email_invoice .= '<td align="center" style="border-left:#000000 2px solid; 
				  border-bottom:#000000 1px solid;" >'.$child_data['dues'].' USD</td>';
				 }else{
				  $email_invoice .= '<td align="center" style="border-left:#000000 2px solid; 
				  border-bottom:#000000 1px solid;" >
				  '.$child_data['dues_original'].' '.get_user_currency_from_SCH($schedule_id_of_query).'</td>';
				 }
				 
				
				/* if($_POST['reg_column']=='1'){
				 $email_invoice .= '<td align="center" style="border-left:#000000 2px solid;
				 border-bottom:#000000 1px solid;" >'.$reg_fee.' USD</td>';
				}
				else{ */
				 /* $email_invoice .= '<td align="center" 
				 style="border-bottom:#000000 1px solid;" ></td>'; */
				/* } */
							   
/*          $email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		 border-bottom:#000000 1px solid;" >'.$invoice_duration.'</td>'; */

		 // DUEDATE GENERATION 		//START
         $email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		 border-bottom:#000000 1px solid; color:red" >'.$pay_date_final.'</td>';
		 // DUEDATE GENERATION 		//END
		 
		 // days and months 		//START
         $email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		 border-bottom:#000000 1px solid; color:red" >'.$invoice_duration_original.'</td>';
		 // days and months 		//END
		 
         /* if(check_sms_alert($_POST['parent_id']) == "Yes"){ 
		$email_invoice  .='<td align="center" style="border-left:#000000 2px solid;
		border-bottom:#000000 1px solid;" >'.$total_sms_charges.'</td>';			 
		 } */
		if(send_invoice_usd($_POST['parent_id']) == "Yes"){         
				$email_invoice  .='<td align="center" style="border-left:#000000 2px solid; 
				border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >'.($amount_to_send).'</td>';
		}else{
				$email_invoice  .='<td align="center" style="border-left:#000000 2px solid; 
				border-right:#000000 2px solid; 
				border-bottom:#000000 1px solid;" >'.($amount_to_send_local_curreny).'</td>';
			 }
            $email_invoice  .='</tr>';?>
            <input name="registration_fee_<?php echo  $child_data['id']; ?>" id="registration_fee_<?php echo  $child_data['id']; ?>"  type="hidden" value="<?php echo  $reg_fee	; ?>"  />
            <input type="hidden" value="<?php echo $due_date; ?>" id="curr_due_date_<?php echo   $child_data['id']; ?>" name="curr_due_date_<?php echo   $child_data['id']; ?>" />
            <input type="hidden" value="<?php echo $per_day_amount; ?>" id="per_day_amount_<?php echo  $child_data['id']; ?>" name="per_day_amount_<?php echo   $child_data['id']; ?>" />
            
            <input type="hidden" value="<?php echo $per_day_amount_local_curreny; ?>" id="local_per_day_amount_<?php echo  $child_data['id']; ?>" name="local_per_day_amount_<?php echo   $child_data['id']; ?>" />
            
            <input type="hidden" value="<?php echo $days; ?>" id="days_<?php echo  $child_data['id']; ?>" name="days_<?php echo   $child_data['id']; ?>" />
            <input type="hidden" value="<?php echo $months; ?>" id="months_<?php echo  $child_data['id']; ?>" name="months_<?php echo   $child_data['id']; ?>" />
             
            <input type="hidden" value="<?php echo $amount_to_send_local_curreny; ?>" id="send_local_amount_<?php echo  $child_data['id']; ?>" name="send_local_amount_<?php echo $child_data['id']; ?>" />
            <input type="hidden" value="<?php echo $amount_to_send; ?>" id="send_amount_<?php echo  $child_data['id']; ?>" name="send_amount_<?php echo $child_data['id']; ?>" />
            
            <input name="child_list[]"  type="hidden" id="child_<?php echo $schedule_id_of_query; ?>" value="<?php echo  $schedule_id_of_query; ?>"  />
            <input name="schedule_id_list_4[]"  type="hidden" id="schedule_id_list_4<?php echo  $schedule_id_of_query; ?>" value="<?php echo  $schedule_id_of_query; ?>"  />
            
			<?php 
			$currency_grand_total += (round($amount_to_send_local_curreny) ); 
            $grand_total += (round($amount_to_send) );
            }//end childs foreach loop
			//<td  align="right" style="font-weight:bold; font-size:15px; color:#000000; padding-right:15px;">&nbsp;</td>';
			$email_invoice .='<tr style="height:50px;">';
            
			$email_invoice .='<td colspan="4" align="right" style="font-weight:bold; font-size:15px; color:#000000; padding-right:15px;">GRAND TOTAL :</td>';
             if(send_invoice_usd($_POST['parent_id']) == "Yes"){    
				$email_invoice .='<td align="center"  >'.$grand_total.' USD</td>';
			 }else{
				$email_invoice .='<td align="center"  >'.$currency_grand_total.'&nbsp;'.get_user_currency_from_SCH($schedule_id_of_query).'</td>';
			 }
			$email_invoice .='</tr>
        </table>
    </td>
</tr>
';//<tr style="line-height:20px;"><td colspan="2"><br><font color="#FF0000" style="font-weight:bold; font-size:11px">* Important: Please note that a surcharge of $5 will be applied in case of late fee submission.<br>*Note: Customers those like to PAY in any other currency than USD, they can either reply to this email or contact our Customer Support. We will make sure that your request is entertained (upon request).<br>

$email_invoice .='</font><br><br><br></td></tr>';
/* if($grand_total<=0){
$email_invoice.='
<tr style="line-height:20px;"><td colspan="2" style="font-weight:bold; background-color: #F3F3F3; font-size:15px;">As WE are offering you FREE CLASSES so please <a href="#">CLICK HERE</a> to mark the Invoice as PAID. Thank you.</td></tr>
';	
} */
//<tr style="line-height:100px;"><td colspan="2">&nbsp;</td></tr>
 $email_invoice .='
<tr align="center" style="color:#000000;font-weight:bold; font-size:16px;"><td colspan="2"><span style="font-size:12px;font-weight:normal;"><strong>YourCloudCampus</strong></span></td></tr>
<tr><td colspan="2" align="center" style="font-size:11px;"><br><strong>Beta Version v1.10</strong></td></tr>
<tr><td colspan="2" style="border-bottom:#000000 3px solid;">&nbsp;</td></tr>
</table>';
echo $email_invoice ;?>
<br />
<br />
<table>
<tr><td><b>Send Invoice to email address: </b></td><td><input name="customer_invoice_email" id="customer_invoice_email" value="<?php echo $email;	
//get_customer_invoice_email_address($_POST['parent_id']);?>" /></td></tr>
</table>
<?php if($grand_total<=0){?>
<input type="hidden" name="free_invoice" id="free_invoice" value="1" />
<?php }?>
<input type="hidden" name="reg_column" id="reg_column" value="<?php echo $_POST['reg_column'];?>" />
<input type="hidden" name="cancel_invoice_id" id="cancel_invoice_id" value="<?php echo $_POST['cancel_invoice_id'];?>" />
<input type="hidden" name="action" id="action" value="save_invoice" />
<input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $invoiceid ;?>" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_POST['parent_id'];?>" />
<input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo $schedule_id;?>" />
<input type="submit" name="save_invoice" id="save_invoice" value="Send Invoice"/>
</form>
<?php } ?>
<!-- PREVIEW INVOICE FORM-->



  

<?
include('include/footer.php');
?>