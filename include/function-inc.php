<?	
  global $_LIST,$_LISTTEAM_A,$_LISTTEAM_NA,$_TEAMLEAD_IDs,$_AUTO_PRINT_PDF_ARRAY;
  $_LIST['gender']=array('Gender','Male','Female');
  $_LIST['systemdate']=systemDate();
  $_LIST['systemdatetime']=systemDateTime();
  $_LIST['paymentMode']=array('Payment Mode','Paypal','Western Union','Bank','Physical payment','Cash','Card Save','Others','Virtual Terminal');
  $_LIST['bankName']=array('Select Bank','HBL','ABL','ALFALAH','UBL','MCB','Soneri','Other');
  $_LIST['currency']=array('Select Currency','GBP','USD','CAD','AUD','NZD','SGD');
  
  //LEAVE APPLICATION ARRAYS
  $_LIST['number_of_days']=array('Select No of Days','1','2','3','4','5','6');	//NOT IN USE
  $_LIST['LeaveType'] = array('','Sick','Casual','Other');
  $_LIST['TL'] = array('Select from list','Recommended','Not Recommended');
  $_LIST['GM'] = array('Select from list','Approved','Not Approved');
  $_LIST['HR'] = array('Select from list','Received','Not Received');
  
  //////////////////////////////
  
  $_LIST['relative']=array('Select Relative','Father','Mother','Brother','Sister','Uncle','Aunt');
  $_LIST['status']=array('Select Status','Active','Deactive');
  $_LIST['stdStatus']=array('Student Status','Trial','Regular','Dead','Freez');
  $_LIST['stdStatusmo-list']=array('Student Status','Trial','Regular','Dead','Freez','Make Over','Test','Transfer to YCC LHR');//FOR book_scheduler_manage.php and class_details.php
  $_LIST['stdStatus_BPS']=array('Student Status','Booking','Regular','Dead','Freez');
  $_LIST['dead_reason']=array('Select Reason','Busy schedule','Course complete','Exam preparation','Freeze','Going to vacation','No show no call','Not comfortable in online teaching','Not improving in results','Not interested','Not following proper syllabus','Not satisfied with services','Payment issue','Teacher Changed','Others');
  $_LIST['menuAry']=array('Select Menu','Meal1','Meal2','Meal3','Meal4','Meal5');
  
  $_LISTTEAM_A[]=array();
  $_LISTTEAM_NA[]=array();
  $_COURSE_ARRAY[]=array();
  
  $_TEAMLEAD_IDs[]=array();
  
  $_AUTO_PRINT_PDF_ARRAY[]=array();
  
  $_LIST['log_schedule']=array('Select Schedule Type','ADD_SCHEDULE','EDIT_SCHEDULE','EDIT_SCHEDULE_VER2','CONFIRM_SCHEDULE','MAKE_REG_SCHEDULE','CONFIRM_DEAD_SCHEDULE',
  'DEAD_SCHEDULE','DELETE_SCHEDULE','ADD_STUDENT','EDIT_STUDENT','DELETE_STUDENT','ADD_TRANSACTION','ADD_USER','EDIT_USER','ADD_TEACHER_SCHEDULE',
  'EDIT_TEACHER_SCHEDULE','HR_ADD_USER','HR_EDIT_USER','MAKEOVER_AUTO_DEAD','ADD_TRANSACTION_OLD_DUE','ADD_TRANSACTION_NEXT_DUE',
  'ADD_SCHEDULE_GROUP','EDIT_SCHEDULE_GROUP','FREEZE_SCHEDULE','UNFREEZE_SCHEDULE');
  
  
  
  $_LIST['skype_status']=array('Select Status','Assigned','Available','Free');
  $_LIST['ext_status']=array('Select Status','Assigned','Available');
  $_LIST['class_status']=array('Absent','Present',5 => 'Make Over',6 => 'Others');
  //$_LIST['department']=array('Department','Teaching','HR','IT','Sales','Accounts');
  //$_LIST['designation']=array('Designation','TSR','Teacher','Team Lead','Manager','Teaching Assistant');
  $_LIST['country']=array('Select Country','USA','Canada','Pakistan','Australia','UK',"Afghanistan","Albania","Algeria","Andorra","Angola","Antigua & Deps","Argentina","Armenia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina","Burundi","Cambodia","Cameroon","Cape Verde","Central African Rep","Chad","Chile","China","Colombia","Comoros","Congo","Congo {Democratic Rep}","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland {Republic}","Israel","Italy","Ivory Coast","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea North","Korea South","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar, {Burma}","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russian Federation","Rwanda","St Kitts & Nevis","St Lucia","Saint Vincent & the Grenadines","Samoa","San Marino","Sao Tome & Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
  $_LIST['employeeType']=array('Select Employee Type','Trainee','Regular');
  $_LIST['shift']=array('Select Shift','Morning','Night','Evening');
  $_LIST['plan']=array('Select Plan','Monday,Tuesday,Wednesday','Thursday,Friday,Saturday','Monday-Friday','Monday-Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
  $_LIST['planDays']=array('Select Plan','Monday,Tuesday,Wednesday','Thursday,Friday,Saturday','Monday,Tuesday,Wednesday,Thursday,Friday','Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
  $_LIST['userType']=array('Select User Type','Super Admin','Admin','Teacher','Student','Agent','Accounts','Floor Assistant','Teacher TeamLead','Agent TeamLead','Day Admin-Read Only','HR','PA to CEO(Temporary)','Quran-Read only','New','Main Teacher TL','Main Agent TL','IT','QC',10001 => 'MakeOver AutoDead');
  
  $_LIST['zones']=array('Select Zone','Pacific','Mountain','Centeral','Eastern','UK','Western','Eastern[Aus]');
  
  ///PAYMENT DUE DROPDOWN LISTS///
  $_LIST['paymentdue']=array('Select Option','paymentdue1','paymentdue2','paymentdue3');
  $_LIST['mailaction']=array('Select Option','TO','CC','BCC');
  
  
  //////Pakistan Time Zone/////////////
  $_LIST['time']=array('Select [label] ','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
  
  ////////US And Canada Time ZONE/////////////////////
   
  $_LIST['zone1']=array('Select [label] ','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30');
  $_LIST['zone2']=array('Select [label] ','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30');
  $_LIST['zone3']=array('Select [label] ','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30');
  $_LIST['zone4']=array('Select [label] ','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30');
  
  
  
  
  ///////////////////UK Zone/////////////////////
  
  $_LIST['zone5']=array('Select [label] ','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30');
  
  //// Australia Zone//////////////////////
  
  $_LIST['zone6']=array('Select [label] ','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30');
  $_LIST['zone7']=array('Select [label] ','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30');
  
  //////////////////////////////////
  
  $_LIST['course']=array('Select Course','MS Office','Graphics Designinig','Web Designing','Web Development-PHP','AutoCad','Bundle','Design and Development','Basic Networking','English','CCNA','Quran Pak','Web Development-.Net','Physics','Chemistry','Biology','Math-Minor','Urdu','French','C++','ACCA','Accounts','Economics','Science','Calculus','Statistics','Math-Major','Assignments','QURAN WITH TAJWEED','HIFZ QURAN','TRANSLATION OF QURAN','ISLAMIC EDUACTION','SMM');
  $_LIST['courseDuration']=array('Select Course duration','+3','+3','+3','+3','+3','+8','+6','+1','+3','+3','+36','+6','+12','+12','+12','+12','+12','+6','+3','+12','+12','+12','+4','+8','+6','+6','+1');
  
  ////////////////////////////////// NEWLY ADDED
  $_LIST['months']=array('Select Option','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
  
  ////////////////////////////////// NEWLY ADDED //Added for department
		$_LIST['department']=array('Select Department','Management','HR','Teaching','Finance','Sales','IT','Reporting','General Services');
  ////////////////////////////////// NEWLY ADDED //Added for designation
		$_LIST['designation_insert_edit']=array('Select Designation',
									'-Management','--Chairman','--CEO','--Director','--GM','--AGM','--PA to CEO',
									'-HR','--Manager','--Officer','--Admin Officer',
									'-Teaching','--TeamLeads','--Coordinator/Customer Support','--Sr.Teacher','--Jr.Teacher','--Head Of Department',
									'-Finance','--Officer','--Collection Officer',
									'-Sales','--TeamLeads','--Sr.Agent','--Jr.Agent','--Trainee',
									'-IT','--Manager','--Officer',
									'-Reporting','--Reporting Manager','--Developer',
									'-General Services','--Office Boy','--Sweeper','--Receptionist','--Coordinator','--Security Officer','--Electrician');
		$_LIST['designation']=array('Select Designation',
									'Management','Chairman','CEO','Director','GM','AGM','PA to CEO',
									'HR','Manager','Officer','Admin Officer',
									'Teaching','TeamLeads','Coordinator/Customer Support','Sr.Teacher','Jr.Teacher','Head Of Department',
									'Finance','Officer','Collection Officer',
									'Sales','TeamLeads','Sr.Agent','Jr.Agent','Trainee',
									'IT','Manager','Officer',
									'Reporting','Reporting Manager','Developer',
									'General Services','Office Boy','Sweeper','Receptionist','Coordinator','Security Officer','Electrician');
  $_LIST['campus']=array('Select Campus','Campus-Rawalpindi','Campus-Lahore');
  $_LIST['year']=array('Select Year','2015','2016','2017','2018','2019','2020');
  $_LIST['month']=array('Select Month','01','02','03','04','05','06','07','08','09','10','11','12');
  $_LIST['recurr_signup']=array('Select Recurr/Signup','Recurring','Signup');
  //Newly added //28-11-2016
  $_LIST['verse']=array('Select Verse','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65','66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102','103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126','127','128','129','130','131','132','133','134','135','136','137','138','139','140','141','142','143','144','145','146','147','148','149','150','151','152','153','154','155','156','157','158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','196','197','198','199','200','201','202','203','204','205','206','207','208','209','210','211','212','213','214','215','216','217','218','219','220','221','222','223','224','225','226','227','228','229','230','231','232','233','234','235','236','237','238','239','240','241','242','243','244','245','246','247','248','249','250','251','252','253','254','255','256','257','258','259','260','261','262','263','264','265','266','267','268','269','270','271','272','273','274','275','276','277','278','279','280','281','282','283','284','285','286');
  //////Leave Duration/////////////
  $_LIST['leaveDuration']=array('Select Leave Duration:','01:00','01:30','02:00','02:30','03:00','03:30','04:00');
  // timeZoneArea and timeDifference for campus_parent
  $_LIST['timeZoneArea']=array('Select Area','Pacific','Mountain','Centeral','Eastern','Eastern[Aus]','Western[AUS]');
  $_LIST['timeDifference']=array('Select Hours Difference','-6','-5','-4','-3','-2','-1','0','1','2','3','4','5','6');
  $_LIST['city']=array('Select City','Karachi','Lahore','Faisalabad','Rawalpindi','Multan','Gujranwala','Hyderabad','Peshawar','Islamabad','Quetta','Sargodha','Sialkot','Bahawalpur','Sukkur','Kandhkot','Shekhupura','Mardan','Gujrat','Larkana','Kasur','Rahim Yar Khan','Sahiwal','Okara','Wah Cantonment','Dera Ghazi Khan','Mingora','Mirpur Khas','Chiniot','Nawabshah','Kamoke','Burewala','Jhelum','Sadiqabad','Khanewal','Hafizabad','Kohat','Jacobabad','Shikarpur','Muzaffargarh','Khanpur','Gojra','Bahawalnagar','Abbottabad','Muridke','Pakpattan','Khuzdar','Jaranwala','Chishtian','Daska','Mandi Bahauddin','Ahmadpur East','Kamalia','Tando Adam','Khairpur','Dera Ismail Khan','Vehari','Nowshera','Dadu','Wazirabad','Khushab','Charsada','Swabi','Chakwal','Mianwali','Tando Allahyar','Kot Adu','Turbat');
  $_LIST['open_close']=array('Select Ticket Status','Open','Close');
  $_LIST['grade']=array('Select Grade','01','02','03','04','05','06','07','08','09','10','11','12');
  
  function buildOption($value='',$id='',$_values,$_label,$_function,$_resultDiv,$addEmpty){
	  
  if(!empty($_function) && !empty($_resultDiv)){
	  $return="<select id='$id' name='$id' onchange='".$_function."(this.value,\"".$_resultDiv."\")'>";
  }
  else{
	  $return="<select name='$id' id='$id'>";
  }
  if($addEmpty){
	  $return.="<option value=''>".$_label."</option>";
	  }
  foreach( $_values as $key => $label){
  $return.="<option value='$key'";if($value==$key){ $return.= " selected='selected'"; }$return.=">".str_replace('[label]',$_label,$label)."</option>";}
  $return.="</select>";
  return $return;
  
  } 

  //////ADDED for payment_method during transactions 04-09-2013
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function buildOption_payment_method($value='',$id='',$_values,$_label,$_function,$_resultDiv,$addEmpty){
	  
  if(!empty($_function) || !empty($_resultDiv)){//Somewhat removing $_resultDiv
	  $return="<select id='$id' name='$id' onchange='".$_function."()'>";
  }
  else{
	  $return="<select name='$id' id='$id'>";
  }
  if($addEmpty){
	  $return.="<option value=''>".$_label."</option>";
	  }
  foreach( $_values as $key => $label){
  $return.="<option value='$key'";if($value==$key){ $return.= " selected='selected'"; }$return.=">".str_replace('[label]',$_label,$label)."</option>";}
  $return.="</select>";
  return $return;
  
  } 
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function buildOption_LISTTEAM($value='',$id='',$_values,$_label,$_function,$_resultDiv,$addEmpty){
	  
  if(!empty($_function) && !empty($_resultDiv)){
	  $return="<select id='$id' name='$id' multiple onchange='".$_function."(this.value,\"".$_resultDiv."\")'>";
  }
  else{
	  $return="<select name='$id' multiple id='$id'>";
  }
  if($addEmpty){
	  $return.="<option value=''>".$_label."</option>";
	  }
  foreach( $_values as $key => $label){
  $return.="<option value='$key'";if($value==$key){ $return.= " selected='selected'"; }$return.=">".str_replace('[label]',$_label,$label)."</option>";}
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  function buildCheckboxOption($value='',$id='',$_values,$_label){
  
  foreach( $_values as $key => $label){
  if($key>0){
  $return.="<input type=\"checkbox\" name=$id value='$key'";if($value==$key){ $return.= " checked='checked'"; }$return.=" />".str_replace('[label]',$_label,$label)."<br />";}}
  
  return $return;
  }
  
  
  
  function getUserTypeList($value='',$id='',$_list=''){
  $sql="Select * from campus_usertype";
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>Select User Type</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['typeName']."</option>";
  
  }
  $return.="</select>";
  return $return;
  
  }
  function getDataList($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  ///////////////// DATA LIST for ACTIVE and DEACTIVE STUDENTS  //NEWLY ADDED 04-02-2014
    function getDataList_active_deactive_teachers($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  
  
  
  //////\\\\\\\\\---------- FOR EDIT using this - use getReferenceFilter_new_student();
  //////////////////////////////////////////getDataList for students_new.php/////////////////////////////////	NEWLY ADDED 
  function getDataList_reference($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where status=1";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////\\\\\\\\
  
  
  //////////////////////////////////////////getDataList for daily_scheduler_ver2.php - (TEAM LEAD)/////////////////////////////////	NEWLY ADDED 
  function getDataList_teamlead_dailyschedule($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  
  //////////////////////////////////////////getDataList for transaction_new.php - disabled/////////////////////////////////	NEWLY ADDED - ** CURRENTLY NOT USING
  function getDataList_transaction_new($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////////////////////////////////getDataList for transaction_new.php - LABEL//////////////////////////////////	NEWLY ADDED - ** CURRENTLY NOT USING
  function getDataList_transaction_new2($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where id=$value";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1";
   
   
   }
  $result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return=$rows['firstName'].'  '.$rows['lastName'];
  }
  return $return;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  //////////////getDataList for management staff under book_scheduler_edit.php////////////	NEWLY ADDED //12-09-14
  function getDataList_agent_onchange($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   echo $sql="Select * from capmus_users where user_type=$_type and status=1";
   
   
   }
  $result=mysql_query($sql);
  $return="<select name='$id' onChange='enable_disable_management_dropdown(this.value)'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  function getDataList_management_commision($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  /*if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{*/
   $sql="Select * from capmus_users where user_type IN (".$_type.") and status=1";
   
   
   //}
  $result=mysql_query($sql);
  $return="<select name='$id' id='$id'>";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////getDataList leave_application_new_teamlead_version.php////////////	NEWLY ADDED //12-12-15
  function getDataList_leave_application_new_teamlead_version($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1 and LeadId=$_user";
   
   
   }
   //onChange='show_teacher_info_leave_app_new(this.value)'  // this onChange is working and gets the USER info 
   //from get_teacher_info.php file 
  $result=mysql_query($sql);
  $return="<select name='$id' id='$id' >";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  /////getDataList leave_application_new_pa_version.php//////	NEWLY ADDED //13-01-17
  function getDataList_leave_application_new_pa_version($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1 and departmentId=8";
   
   
   }
   //onChange='show_teacher_info_leave_app_new(this.value)'  // this onChange is working and gets the USER info 
   //from get_teacher_info.php file 
  $result=mysql_query($sql);
  $return="<select name='$id' id='$id' >";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  /////getDataList leave_application_new_IT_version.php//////	NEWLY ADDED //13-01-17
  function getDataList_leave_application_new_IT_version($value='',$id='',$_type='',$_user=''){
  global $_LIST;
  if(!empty($_type) && $_type==4){
   $sql="Select * from campus_students where (std_status=1 or std_status=2)";
   if(!empty($_user) && ($_SESSION['userType']==3 || $_SESSION['userType']==5)){
   $sql.=" and agent_id=$_user";
   }
  }else{
   $sql="Select * from capmus_users where user_type=$_type and status=1 and departmentId=6 ";
   
   
   }
   //onChange='show_teacher_info_leave_app_new(this.value)'  // this onChange is working and gets the USER info 
   //from get_teacher_info.php file 
  $result=mysql_query($sql);
  $return="<select name='$id' id='$id' >";
  $return.="<option value=''>". $_LIST['userType'][$_type]."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'";if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['firstName'].'  '.$rows['lastName']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  
  
  function getTableList($value='',$id='',$_table='',$_label=''){
  global $_LIST;
  
  $skid=showStudents($value,'skypeid');
  if(!empty($skid)){
	$sql="Select * from $_table where status=2 or id=$skid";
   }else{
  $sql="Select * from $_table where status=2";
  }
   
   
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>Select ". $_label."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'"; if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['skype']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  ///////////	Added for skype list editing in book_scheduler_new AND book_scheduler_edit	//NEWLY ADDED 04-02-2014
  function getTableList_skype($value='',$id='',$_table='',$_label=''){
  global $_LIST;
  


  $sql="Select * from $_table where status=2 or id=$value";

   
   
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value='0'>Select ". $_label."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'"; if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['skype']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  ///////////	Added for extId	//NEWLY ADDED 18-06-2015
  function getTableList_ext($value='',$id='',$_table='',$_label=''){
  global $_LIST;
  
  $skid=showStudents($value,'extId');
  if(!empty($skid)){
	$sql="Select * from $_table where status=2 or id=$skid";
   }else{
  $sql="Select * from $_table where status=2";
  }
   
   
  $result=mysql_query($sql);
  $return="<select name='$id'>";
  $return.="<option value=''>Select ". $_label."</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  $return.="<option value='".$rows['id']."'"; if($value==$rows['id']){ $return.= "selected='selected'"; }$return.=">".$rows['extId']."</option>";
  }
  $return.="</select>";
  return $return;
  
  }
  
  
  function getList($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv='',$_addEmpty='false'){
  global $_LIST;
  return $return=buildOption($value,$id,$_LIST[$_list],$_label,$_function,$_resultDiv,$_addEmpty);
  }
  
  ////ADDED for payment_method during transactions 04-09-2013
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function getList_payment_method($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv='',$_addEmpty='false'){
  global $_LIST;
  return $return=buildOption_payment_method($value,$id,$_LIST[$_list],$_label,$_function,$_resultDiv,$_addEmpty);
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function getList_LISTTEAM($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv='',$_addEmpty='false'){
  global $_LIST;
  return $return=buildOption_LISTTEAM($value,$id,$_list,$_label,$_function,$_resultDiv,$_addEmpty);
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  function getCheckboxList($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv=''){
  global $_LIST;
  return $return=buildCheckboxOption($value,$id,$_LIST[$_list],$_label);
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function getCheckboxList_LISTTEAM($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv=''){
  global $_LISTTEAM;
  return $return=buildCheckboxOption($value,$id,$_list,$_label);
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  function getCheckbox($value='',$id=''){
  $return="<input type='checkbox' value='1' name='$id'";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  
  
  ////////////////////////////////////////// NEWLY ADDED FOR EMAIL SENDING UNDER Manage Schedule-TL webpage
  function getCheckbox_email_select($value='',$id='',$name=''){
  $return="<input type='checkbox' value='$id' name='$name' class='chk'";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////////// NEWLY ADDED FOR 2nd last dead confirmation UNDER book_scheduler_dead_confirmation.php webpage
  function getCheckbox_2nd_last_dead_confirmation($value='',$id='',$name=''){
  $return="<input type='checkbox' value='$id' id='$id' name='$name' class='chk'";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////////// NEWLY ADDED Leave Application for webpage
  function getCheckbox_leave($value='',$id=''){
  $return="<input type='checkbox' value='1' name='$id' id='$id' ";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////////// NEWLY ADDED FOR recommendation/approval UNDER leave_application_list_teamlead.php webpage
  function getCheckbox_id($value='',$id='',$name=''){
  $return="<input type='checkbox' value='$id' id='$id' name='$name' class='chk'";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  function getInput($value='',$id='',$_class=''){
  $return="<input type='text' $_class value='$value' name='$id' id='$id'  />";
  return $return;
  }
  
  function getInput_number($value='',$id='',$_class='',$place_holder=''){
  $return="<input type=number class='$_class' value='$value' name='$id' id='$id' placeholder='$place_holder' />";
  return $return;
  }
  
  
  function getMessages($type='',$page='',$_message=''){
  switch($type){
  case 'add':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Listing</a>"; 
					  }
					  echo "<div class='message success'><p><strong>Added row.</strong> Everything fine...</p></div><br />".$pageInfo;
					  break;
				  }
  case 'delete':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Row deleted.</strong> </p></div><br /><a href='$page' class=\"button\">Back To Listing</a> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
					  break;
				  }
  case 'dead':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedules marked as dead.</strong> </p></div><br /><a href='$page' class=\"button\">Back To Listing</a> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
					  break;
				  }
  case 'confirming_dead':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedules moved to Dead Confirmation list for SuperAdmin to make it dead.</strong> </p></div><br /><a href='$page' class=\"button\">Back To Listing</a> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
					  break;
				  }
  case 'freeze_schedule':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedule moved to FREEZE LIST.</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
					  break;
				  }
  case 'transfertolhr_schedule':
  {
	  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedule moved to TRANSFER TO LHR LIST.</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
	  break;
  }
  case 'unfreeze_schedule':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedule UNFREEZE - Moved to MANAGE SCHEDULE.</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
					  break;
				  }
  case 'from_transfertolhr_schedule':
  {
	  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Schedule From TransferToLHR - Redirectiong to EDIT SCHEDULE.</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing deleted.</strong></p></div><br /> <a href='$page' class=\"button\">Back To Listing</a>";
	  break;
  }
  case 'comments_general':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Comments Successfully submitted against this schedule</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing Happened.</strong></p></div><br />";
					  break;
				  }
	case 'chat_msg':
				  {
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Message sent</strong> </p></div><br /> " : "<div class='message warning'><p><strong>Nothing Happened.</strong></p></div><br />";
					  break;
				  }
				  
  case 'edit':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Listing</a>"; 
					  }
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Edited row.</strong> Everything fine...</p></div><br />".$pageInfo : "<div class='message warning'><p><strong>Nothing changed. </strong></p></div><br />".$pageInfo; 
					  break;
				  }
	  case 'edit_assessment':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Listing</a>"; 
					  }
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>File Successfully Uploaded.</strong> Everything fine...</p></div><br />".$pageInfo : "<div class='message warning'><p><strong>Nothing changed. </strong></p></div><br />".$pageInfo; 
					  break;
				  }
  case 'acl':
				  {
					  echo "<div class='message error'><p><strong>Permission Denied.</strong> You don't have sufficient privilages to access this page .Please contact your system administrator.</p></div><br />"; 
					  break;
				  }
  case 'noresult':
				  {
					  echo "<div class='message error'><p><strong>No Result.</strong>Either your query returns no result or you are trying to access Invalid data resourse.</p></div><br />"; 
					  break;
				  }
  case 'error':
				  {
					  echo "<div class='message error'><p><strong>Error in processing your data.Try again.</strong></p></div><br />"; 
					  break;
				  }
	  case 'error_check_student':
				  {
					  echo "<div class='message error'><p><strong>Same student with same startTime and with same classtype cannot be rescheduled to any teacher</strong></p></div><br />"; 
					  break;
				  }
	  case 'error_check_freeze_15_days':
				  {
					  echo "<div class='message error'><p><strong>15 days Freeze - Not allowed</strong></p></div><br />"; 
					  break;
				  }
  case 'duplicate':
				  {
					  if(empty($_message))
						  {
							  $_message="Course already assigned to teacher.Try again.";
						  }
					  echo "<div class='message error'><p><strong>Duplication Error.</strong> ".$_message."</p></div><br />"; 
					  break;
				  }
	  case 'second_last_dead_confirmation_edit':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Dead List</a>"; 
					  }
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Dead Confirmed Successful </strong> - Everything fine...</p></div><br />".$pageInfo : "<div class='message warning'><p><strong>Nothing changed. </strong></p></div><br />".$pageInfo; 
					  break;
				  }
	case 'leave_comments':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Leave Application List</a>"; 
					  }
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Successful </strong> - Everything fine...</p></div><br />".$pageInfo : "<div class='message warning'><p><strong>Nothing changed. </strong></p></div><br />".$pageInfo; 
					  break;
				  }
	case 'error_short_leave':
				  {
					  echo "<div class='message error'><p><strong>Error in processing your data.2 DAYS ONLY FOR BACK DATE RANGE.</strong></p></div><br />"; 
					  break;
				  }
	case 'samemonth_dual_tran_not_allowed_error':
				  {
					  echo "<div class='message error'><p><strong>Error in processing your data.Same month DUAL TRANSACTION NOT ALLOWED.</strong></p></div><br />"; 
					  break;
				  }
	case 'transaction_with_zero_error':
				  {
					  echo "<div class='message error'><p><strong>Error in processing your data.Transaction with 0 amount not allowed.</strong></p></div><br />"; 
					  break;
				  }
	case 'file_uploaded':
				  {
					  echo "<div class='message success'><p><strong>File Uploaded Successfully</strong></p></div><br />"; 
					  break;
				  }
	case 'generate_ticket':
				  {
					  echo "<div class='message success'><p><strong>Ticket Generated Successfully - Your Enquiry will be solved within 24 Hours</strong></p></div><br />"; 
					  break;
				  }
	case 'error_one_ticket_only':
				  {
					  echo "<div class='message error'><p><strong>Error in processing your data.One ticket is allowed per day.</strong></p></div><br />"; 
					  break;
				  }	
  case 'error_meal':
				  {
					  if(empty($_message))
						  {
							  $_message="Processing NOT DONE";
						  }
					  echo "<div class='message error'><p><strong>Menu Error.</strong> ".$_message."</p></div><br />"; 
					  break;
				  }

  }
  
  }
  
  function prepareDateTime($_date){
  
  $date=date('Y-m-d h:m:s',strtotime($_date));
  return $date;
  
  }
  
  function prepareDate($_date){
  
  $date=date('Y-m-d',strtotime($_date));
  return $date;
  
  }
  
  
  function showUser($_id){
  if(!empty($_id)){
  $sql="Select * from capmus_users where id=$_id";
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  $return=$rows['firstName'].' '.$rows['lastName'];
  
  return $return;
  }
  else
  {
  return "";}
  
  
  }
  
  //DELETE THIS LATER as it is for emp_payroll pdf file
  function showUser_emp_payroll($_id){
  if(!empty($_id)){
  $sql="Select * from capmus_users where id=$_id";
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  $return=$rows['firstName'].'_'.$rows['lastName'];
  
  return $return;
  }
  else
  {
  return "";}
  
  
  }
  
  function showStudents($_id,$_field=''){
  if($_field==''){
  $sql="Select * from campus_students where id=$_id";
  }
  else{
  $sql="Select * from campus_students where $_field=$_id";
  }
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  if($_field==''){
  $return=$rows['firstName'].'  '.$rows['lastName'];}
  else{
  $return=$rows[$_field];
  }
  
  return $return;
  
  }	
  
  //NEWLY ADDED for book_scheduler_manage.php and SKYPE ID's output in LSI SKYPE ID's 28-01-2014
  function showStudents_from_manageschedule($_id,$_field=''){
  if($_field==''){
  $sql="Select * from campus_students where id=$_id";
  }
  else{
  $sql="Select * from campus_students where $_field=$_id";
  }
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  if($_field==''){
  $return=$rows['firstName'].'  '.$rows['lastName'];}
  else{
  $return=$rows[$_field];
  }
  
  return $return;
  
  }	
  
  
  
  
  
  //NEWLY ADDED for book_scheduler_manage_class_details.php
  function showStudents_class_details($_id,$_field=''){
  $_id = mysql_real_escape_string($_id);
  $_field = mysql_real_escape_string($_field);
  if($_field=='' && $_id!=''){
  $sql="Select * from campus_students where id=$_id";
  }
  else{
  //$sql="Select * from campus_students where $_field=$_id";
  }
  if($_field=='' && $_id!=''){
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  }
  
  if($_field=='' && $_id!=''){
  $return=$rows['firstName'].'  '.$rows['lastName'];}
  else{
  $return=$rows[$_field];
  }
  
  return $return;
  
  }	
  
  function showCourse($_id){
  
  global $_LIST;
  return $_LIST['course'][$_id];
  
  }
  
  function getData($_id,$_index){
  
  global $_LIST;
  return $_LIST[$_index][$_id];
  
  }
  
  function removeSchedule($_id=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=3 where `studentID`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  function changeSchedule($_id='',$status='',$status_old=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=$status,std_status_old=$status_old where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
    function confirming_dead_schedule($_id='',$status='',$commentsdead,$record_link_dead){
  $systemdate = systemDate();
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set status_dead=$status,comments_dead='$commentsdead',dead_date='".$systemdate."',dead_reason='".$_POST['dead_reason']."',`record_link_dead` ='$record_link_dead' where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  //////******* FOLLOWING is for FREEZE SCHEDULES ********\\\\\\\\\\\ //NEWLY ADDED		29-11-2013
    function freeze_schedule($_id='',$status='',$status_old=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=$status,std_status_old=$status_old,status_freeze=1 where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
//////******* FOLLOWING is for UN-FREEZE SCHEDULES ********\\\\\\\\\\\ //NEWLY ADDED		29-11-2013
    function unfreeze_schedule($_id='',$status='',$status_old=''){
	//IMPORTANT
	//unfreeze_schedule actual code shifted to [book_scheduler_edit.php]
	//In following code - only PRE and CURR TRANSACTIONS are transacted
	//
  //<<<<<<<<<<<<<<<<<<<< Adding code for AUTO UNFREEZE TRANSACTIONS
	$sql_sch_details = mysql_fetch_array (mysql_query("SELECT * FROM campus_schedule WHERE id=$_id ")) or die(mysql_error());
	$schedule=$sql_sch_details['id'];
	$crs=$sql_sch_details['courseID'];
	$classType=$sql_sch_details['classType'];
	$due_date=$sql_sch_details['duedate'];
	$pay_date=$sql_sch_details['paydate'];
	$startTime=$sql_sch_details['startTime'];
	$teacherID=$sql_sch_details['teacherID'];
	$dues=$sql_sch_details['dues'];
	
	//Pay date for CURRENT MONTH TRANSACTION		//CURRENT MONTH
	$pay_date = $sql_sch_details['paydate'];
	$paydate_date_for_recurr_date = date('d', strtotime( nl2br($pay_date)));	
	$current_month_for_recurr_date = date('m');									
	$current_year_for_recurr_date = date('Y');
	$dateRecieved = $current_year_for_recurr_date."-".$current_month_for_recurr_date."-".$paydate_date_for_recurr_date;
	////////////////////////////////////////
	//Pay date for PREVIOUS MONTH TRANSACTION		//PREVIOUS MONTH	
	$paydate_date_for_recurr_date_OLD = date('d', strtotime( nl2br($pay_date)));	
	$current_month_for_recurr_date_OLD = date('m');									
	$current_month_for_recurr_date_OLD = date('m') - 1;
	$current_year_for_recurr_date_OLD = date('Y');									
	$complete_recurr_date_OLD = date('Y-m-d', strtotime( $current_year_for_recurr_date_OLD."-".$current_month_for_recurr_date_OLD."-".$paydate_date_for_recurr_date_OLD));
	$dateRecieved_OLD = $complete_recurr_date_OLD;
	/////////////////////////////////////////
	//date will be system date
	$systemdate = systemDate();
	$date = $systemdate;
	//////////////////////////
	//Getting LeadId and main_LeadId
	$sql_get_LEAD_and_MAINLEAD = mysql_fetch_array (mysql_query("SELECT * FROM capmus_users WHERE id='$teacherID'")) or die(mysql_error());
	$LeadId = $sql_get_LEAD_and_MAINLEAD['LeadId'];
	$main_LeadId = $sql_get_LEAD_and_MAINLEAD['main_LeadId'];
	////////////////////////////////
	
	//Query for PREVIOUS MONTH TRANSACTION
	$sql_tran_previous = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , 
	`schedule_id` ,  `courseID` ,  `method` , `method_array` , `currency_array` , `amount_original` , `amount_gbp` , 
	`amount` , `discount_tran` ,`comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , `LeadId` , 
	`main_LeadId` , `sender_name` , `email` , `cardSave_ccv_code` ) VALUES(  '0' ,  
	'".$date."' , '".$sql_sch_details['studentID']."' , '".$teacherID."' , '".$schedule."'  , 
	'".$crs."' ,  'Others' , '7' , '3' , 
	'0' , '0' , '0' , '".$dues."' , 
	'UNFREEZE-AUTO ZERO PAID-PREVIOUS' , '159', '".$classType."' , '".$startTime."' , 
	'".$dateRecieved_OLD."' , '".$LeadId."' , '".$main_LeadId."' , '' , 
	'' , '0' ) "; 
	//exit();
	mysql_query($sql_tran_previous) or die(mysql_error());
	
	//Query for CURRENT MONTH TRANSACTION
	$sql_tran_current = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , 
	`schedule_id` ,  `courseID` ,  `method` , `method_array` , `currency_array` , `amount_original` , `amount_gbp` , 
	`amount` , `discount_tran` ,`comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , `LeadId` , 
	`main_LeadId` , `sender_name` , `email` , `cardSave_ccv_code` ) VALUES(  '0' ,  
	'".$date."' , '".$sql_sch_details['studentID']."' , '".$teacherID."' , '".$schedule."'  , 
	'".$crs."' ,  'Others' , '7' , '3' , 
	'0' , '0' , '0' , '".$dues."' , 
	'UNFREEZE-AUTO ZERO PAID-CURRENT' , '159', '".$classType."' , '".$startTime."' , 
	'".$dateRecieved."' , '".$LeadId."' , '".$main_LeadId."' , '' , 
	'' , '0' ) "; 
	//exit();
	mysql_query($sql_tran_current) or die(mysql_error());
	
  //<<<<<<<<<<<<<<<<<<<<
  
  
  
  
  
  return true;
  
  }
  
  //////******* FOLLOWING is for Transfer to LHR SCHEDULES ********\\\\\\\\\\\ //NEWLY ADDED	18-11-2014
    function transfertolhr_schedule($_id='',$status='',$status_old=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=$status,std_status_old=$status_old,status_transfertolhr=1 where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
//////******* FOLLOWING is for FROM Transfer to LHR SCHEDULES ********\\\\\\\\\\\ //NEWLY ADDED	18-11-2014
    function from_transfertolhr_schedule($_id='',$status='',$status_old=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=$status,std_status_old=$status_old,status_transfertolhr=0 where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  function skypeStatus($_id='',$_status=''){
	  /*$sql="update campus_students set skypeid='' where skypeid=$_id";
	  mysql_query($sql) or die(mysql_error());*/
  $skype=showStudents($_id,'skypeid');
   $sql="update campus_skype set status=$_status where id=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  //For EXTID //NEWLY ADDED 18-06-2015
  function extStatus($_id='',$_status=''){
	  /*$sql="update campus_students set skypeid='' where skypeid=$_id";
	  mysql_query($sql) or die(mysql_error());*/
  $ext=showStudents($_id,'extId');
   $sql="update campus_voice_ext set status=$_status where id=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  
  function checkDuplication($_course,$_teacher){
  
   $sql="select * from capmus_teacher_course where `teacherID`=$_teacher and `courseID`=$_course";
  
  $_result=mysql_query($sql) or die(mysql_error());
  
  return mysql_num_rows($_result);
  
  }
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   NEWLY ADDED
  
  function checkDuplication_LISTTEAM($_teacher_agent_id,$_leadid){
  
   $sql="select * from capmus_users where `id`=$_teacher_agent_id and `LeadId`!=0 and LeadId='$_leadid'";
  
  $_result=mysql_query($sql) or die(mysql_error());
  
  return mysql_num_rows($_result);
  
  }
  
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  ////////////////////////////////////MAIN TEAMLEAD (AGENT - TEACHER)//////////////////////   NEWLY ADDED
  
  function checkDuplication_LISTTEAM_main($_teacher_agent_id,$_leadid){
  
   $sql="select * from capmus_users where `id`=$_teacher_agent_id and `main_LeadId`!=0 and main_LeadId='$_leadid'";
  
  $_result=mysql_query($sql) or die(mysql_error());
  
  return mysql_num_rows($_result);
  
  }
  
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  //////////////////////////////////////////////////////////////  NEWLY ADDED	//07-12-16
  
  function checkDuplication_LISTTEAM_PARENT($_student_id,$_parentid){
  
   $sql="select * from campus_students where `id`=$_student_id and `parentId`!=0 and parentId='$_parentid'";
  
  $_result=mysql_query($sql) or die(mysql_error());
  
  return mysql_num_rows($_result);
  
  }
  
  
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  function getUserType($_id){
  
  $sql="Select * from capmus_users where id=$_id";
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  $return=$rows['user_type'];
  
  return $return;
  
  }
  
  function removeCourse($_id=''){
  
   $sql="delete from capmus_teacher_course where `teacherID`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  function removeTimings($_id=''){
  
   $sql="delete from campus_timing where `teacherID`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  return true;
  
  }
  
  function getPlan($_day=''){
  
  global $_LIST,$_return;
  foreach($_LIST['planDays'] as $_key => $_plan){
  $_array=explode(',',$_plan);
  $_return=in_array($_day,$_array);
  if($_return)
  $_keys.="'".$_key."',";
  }
  
  return trim($_keys,',');
  }


/////////////////////////////////////////////////////////////////////PAYMENT DUE FUNCTION////////////////////////////////////////////////	//NEWLY ADDED  
function paymentdue($tdd,$tdm,$dddayz,$ddmonth,$ddyear,$drday,$drmonth,$dryear)
{
	//PAYMENT PROBLEM
	//////////////////////////////////
	//echo $td=date("Y-m-d")."<br>";
	//echo $tdm=date("n")."<br>";

	$ddm=$ddmonth; //echo " due date month<br>";
	$ddm=intval($ddm); //echo" due date month-int<br>";

	//$dr=
	$drm=$drmonth;//echo "<br>";
	//$months_payment_left=$tdm-$ddm;echo "<br>";					//NOT IN USE
	//$month_payment_done=$tdm-$months_payment_left;echo "<br>";	//NOT IN USE

	$drd=$drday;//echo "<br>";
	$ddd=$dddayz;//echo "<br>";
	
	$tdm;//echo "<br>";
	$drm;//echo "<br>";
	
	$months_pay_left_r=$tdm-$drm;//echo "<br>";
	$months_pay_left_d=$tdm-$ddm;
	
if(date('Y')>$ddyear)// CODE FOR ENTERING FROM LAST YEAR TO NEXT YEAR e.g from 2012 to 2013
{
	$months_pay_left_r=($tdm+12)-$drm;
	//$months_pay_left_d=($tdm+12)-$ddm;
	
	if($months_pay_left_r>=12)
	{
			if($months_pay_left_r==12)
			{
				$months_pay_left_r=$months_pay_left_r-12;
				return $months_pay_left_r;
			}
			else
			{
				$months_pay_left_r=$months_pay_left_r-12-(1);
				return $months_pay_left_r;
			}
	}
	else if($months_pay_left_r==0)
	{
		return $months_pay_left_r;
	}
	else
	{
		if($tdd>=$ddd)
		{
			return $months_pay_left_r;
		}
		//else if($ddm>=$drm || $ddd>$drd)
		//{
		//	return "Wrong calculation";
		//}
		else
		{
			return $months_pay_left_r-1;
		}
	}

}
else
{	
	if($months_pay_left_r==0)
	{
		return $months_pay_left_r;
	}
	else
	{
		if($tdd>=$ddd)
		{
			return $months_pay_left_r;
		}
		//else if($ddm>=$drm || $ddd>$drd)
		//{
		//	return "Wrong calculation";
		//}
		else
		{
			return $months_pay_left_r-1;
		}
	}
}
	// if($tdm >= $ddm)
	// {

		// if($tdd>=$ddd/*&& $drd>=$ddd && $drd<=$tdd*/)
		// {
			
			// $months_payment_left=$tdm-$ddm;
			// $month_payment_done=$tdm-$months_payment_left;
			// if($months_payment_left>0)
			// {
				// //echo $months_payment_left." month's payment left <br>";
				// //echo $month_payment_done." th month payment done <br>";
				// return $months_payment_left;
			// }
			// else
			// {
				// //echo $months_payment_left." month's payment left <br>";
				// return $months_payment_left;
			// }
		// }
		// else
		// {
			// return $months_payment_left=$tdm-($ddm+1);
			// //echo $months_payment_left." month's payment left <br>";
			// //$month_payment_done=$tdm-$months_payment_left;
		// }
	// }
	// else
	// {
	// echo "NO PAYMENT DUE <br>";
	// }
	// echo "<hr>";
	//////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////PAYMENT DUE FUNCTION - TEST TEST TEST////////////////////////////////////////////////	//NEWLY ADDED  
function paymentdue_done($tdd,$tdm,$dddayz,$ddmonth,$ddyear,$drday,$drmonth,$dryear)
{
	//PAYMENT PROBLEM
	//////////////////////////////////
	//echo $td=date("Y-m-d")."<br>";
	//echo $tdm=date("n")."<br>";

	$ddm=$ddmonth; //echo " due date month<br>";
	$ddm=intval($ddm); //echo" due date month-int<br>";

	//$dr=
	$drm=$drmonth;//echo "<br>";
	//$months_payment_left=$tdm-$ddm;echo "<br>";					//NOT IN USE
	//$month_payment_done=$tdm-$months_payment_left;echo "<br>";	//NOT IN USE

	$drd=$drday;//echo "<br>";
	$ddd=$dddayz;//echo "<br>";
	
	$tdm;//echo "<br>";
	$drm;//echo "<br>";
	
	$months_pay_left_r=$tdm-$drm;//echo "<br>";
	$months_pay_left_d=$tdm-$ddm;
	
if(date('Y')>$ddyear)
{
	$months_pay_left_r=($tdm+12)-$drm;
	if($months_pay_left_r==0)
	{
		return $months_pay_left_d_done=$tdm - $months_pay_left_r;
	}
	else
	{
		if($tdd>=$ddd)
		{
			return $months_pay_left_d_done=$tdm - $months_pay_left_r;
		}
		//else if($ddm>=$drm || $ddd>$drd)
		//{
		//	return "Wrong calculation";
		//}
		else
		{
			
			return $months_pay_left_d_done=($tdm - $months_pay_left_r);
		}
	}

}
else
{	
	if($months_pay_left_r==0)
	{
		return $months_pay_left_d_done=($tdm - $months_pay_left_r);
	}
	else
	{
		if($tdd>=$ddd)
		{
			return $months_pay_left_d_done=$tdm - $months_pay_left_r;
		}
		//else if($ddm>=$drm || $ddd>$drd)
		//{
		//	return "Wrong calculation";
		//}
		else
		{
			return $months_pay_left_d_done=($tdm - $months_pay_left_r);
		}
	}
}
	// if($tdm >= $ddm)
	// {

		// if($tdd>=$ddd/*&& $drd>=$ddd && $drd<=$tdd*/)
		// {
			
			// $months_payment_left=$tdm-$ddm;
			// $month_payment_done=$tdm-$months_payment_left;
			// if($months_payment_left>0)
			// {
				// //echo $months_payment_left." month's payment left <br>";
				// //echo $month_payment_done." th month payment done <br>";
				// return $months_payment_left;
			// }
			// else
			// {
				// //echo $months_payment_left." month's payment left <br>";
				// return $months_payment_left;
			// }
		// }
		// else
		// {
			// return $months_payment_left=$tdm-($ddm+1);
			// //echo $months_payment_left." month's payment left <br>";
			// //$month_payment_done=$tdm-$months_payment_left;
		// }
	// }
	// else
	// {
	// echo "NO PAYMENT DUE <br>";
	// }
	// echo "<hr>";
	//////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






/////////////////////////////TEAMLEAD TEACHER COLLECTIVE COUNT SUMMARY FUNCTION////////////////5 Times call to this func /////////////////////	//NEWLY ADDED  
 function teamlead_teacher_collective_count_summary($teamlead_ids,$main)
 {
	//COUNT QUERY
	$main;
	$system_date_teacher=systemDate();
	
	if($main==1)
	{
		$result_count_oneday_trial="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status=1";
	
		$result_count_oneday_trial.=" and campus_schedule.dateBooked='".$system_date_teacher."'";
	
		$result_count_oneday_trial.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_oneday_trial=mysql_query($result_count_oneday_trial);
		$string_array_oneday_trial=array();
		if($main==1)
		{
			while($row_count_oneday_trial = mysql_fetch_array($result_count_oneday_trial))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_oneday_trial[]=getData(nl2br( $row_count_oneday_trial['std_status']),'stdStatusmo-list') . " : " . $row_count_oneday_trial['cnt'];

			}
		return implode(" , ",$string_array_oneday_trial);	
		}
	}
	
	if($main==5)
	{
		$result_count_oneday_regular="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status=2";
	
		$result_count_oneday_regular.=" and campus_schedule.duedate='".$system_date_teacher."'";
	
		$result_count_oneday_regular.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_oneday_regular=mysql_query($result_count_oneday_regular);
		$string_array_oneday_regular=array();
		if($main==5)
		{
			while($row_count_oneday_regular = mysql_fetch_array($result_count_oneday_regular))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_oneday_regular[]=getData(nl2br( $row_count_oneday_regular['std_status']),'stdStatusmo-list') . " : " . $row_count_oneday_regular['cnt'];

			}
		return implode(" , ",$string_array_oneday_regular);	
		}
	}
	
	
	
	if($main==2 && $_POST['fromDate_TTL_datebook']!="" && $_POST['toDate_TTL_datebook']!="")
	{
		$result_count_10day_datebook="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status=1 ";
		if($_POST['fromDate_TTL_datebook']!="" && $_POST['toDate_TTL_datebook']!="")
		{
			$result_count_10day_datebook.=" and (campus_schedule.dateBooked >= '".prepareDate($_POST['fromDate_TTL_datebook'])."' and campus_schedule.dateBooked <= '".prepareDate($_POST['toDate_TTL_datebook'])."') ";
		}
		
		$result_count_10day_datebook.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		$result_count_10day_datebook=mysql_query($result_count_10day_datebook);
		$string_array_10day_datebook=array();
		if($main==2)
		{
			while($row_count_10day_datebook = mysql_fetch_array($result_count_10day_datebook))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_10day_datebook[]=getData(nl2br( $row_count_10day_datebook['std_status']),'stdStatusmo-list') . " : " . $row_count_10day_datebook['cnt'];

			}
		return implode(" , ",$string_array_10day_datebook);	
		}
	}
	
	if($main==4 && $_POST['fromDate_TTL_duedate']!="" && $_POST['toDate_TTL_duedate']!="")
	{
		$result_count_10day_duedate="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status=2 ";
		if($_POST['fromDate_TTL_duedate']!="" && $_POST['toDate_TTL_duedate']!="")
		{
			$result_count_10day_duedate.=" and (campus_schedule.duedate >= '".prepareDate($_POST['fromDate_TTL_duedate'])."' and campus_schedule.duedate <= '".prepareDate($_POST['toDate_TTL_duedate'])."') ";
		}
		
		$result_count_10day_duedate.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		$result_count_10day_duedate=mysql_query($result_count_10day_duedate);
		$string_array_10day_duedate=array();
		if($main==4)
		{
			while($row_count_10day_duedate = mysql_fetch_array($result_count_10day_duedate))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_10day_duedate[]=getData(nl2br( $row_count_10day_duedate['std_status']),'stdStatusmo-list') . " : " . $row_count_10day_duedate['cnt'];

			}
		return implode(" , ",$string_array_10day_duedate);	
		}
	}
	
	
	if($main==3)
	{
		$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 ");
		
		//if($_POST['fromDate']!="" && $_POST['toDate']!="")
		//{
		//	$result_count.=" and (campus_schedule.dateBooked >= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked <= '".prepareDate($_POST['toDate'])."') 
		//	and (campus_schedule.duedate >= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate <= '".prepareDate($_POST['toDate'])."') ";
		//}
		
		$result_count.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count=mysql_query($result_count);
		$string_array_allday=array();
		
		if($main==3)
		{
			while($row_count = mysql_fetch_array($result_count))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_allday[]=getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt'];
			
			}
		return implode(" , ",$string_array_allday);	
		}
	}
	
}
	

/////////////////////////////TEAMLEAD TEACHER OVERALL COUNT SUMMARY FUNCTION////////////////5 Times call to this func /////////////////////	//NEWLY ADDED  
 function teamlead_teacher_overall_count_summary()
 {
	//COUNT QUERY

	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	
	while($row_count = mysql_fetch_array($result_count))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
	}	
	echo "<hr>";
 }


 
 /////////////////////////////TEAMLEAD AGENT COLLECTIVE COUNT SUMMARY FUNCTION////////////////5 Times call to this func /////////////////////	//NEWLY ADDED  
 function teamlead_agent_collective_count_summary($teamlead_ids,$main)
 {
	//COUNT QUERY
	
	$main;
	$system_date_agent=systemDate();
	
	if($main==1)
	{
	$result_count_oneday_trial="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 and campus_schedule.std_status=1";
	
		$result_count_oneday_trial.=" and campus_schedule.dateBooked='".$system_date_agent."'";
	
		$result_count_oneday_trial.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_oneday_trial=mysql_query($result_count_oneday_trial);
		$string_array_oneday_trial=array();
		if($main==1)
		{
			while($row_count_oneday_trial = mysql_fetch_array($result_count_oneday_trial))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_oneday_trial[]=getData(nl2br( $row_count_oneday_trial['std_status']),'stdStatusmo-list') . " : " . $row_count_oneday_trial['cnt'];

			}
		return implode(" , ",$string_array_oneday_trial);	
		}
	}
	
	if($main==5)
	{
	$result_count_oneday_regular="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 and campus_schedule.std_status=2";
	
		$result_count_oneday_regular.=" and campus_schedule.duedate='".$system_date_agent."'";
	
		$result_count_oneday_regular.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_oneday_regular=mysql_query($result_count_oneday_regular);
		$string_array_oneday_regular=array();
		if($main==5)
		{
			while($row_count_oneday_regular = mysql_fetch_array($result_count_oneday_regular))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_oneday_regular[]=getData(nl2br( $row_count_oneday_regular['std_status']),'stdStatusmo-list') . " : " . $row_count_oneday_regular['cnt'];

			}
		return implode(" , ",$string_array_oneday_regular);	
		}
	}
	
	
	if($main==2 && $_POST['fromDate_ATL_datebook']!="" && $_POST['toDate_ATL_datebook']!="")
	{
	$result_count_10day_datebook="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 and campus_schedule.std_status=1";
	if($_POST['fromDate_ATL_datebook']!="" && $_POST['toDate_ATL_datebook']!="")
		{
			$result_count_10day_datebook.=" and (campus_schedule.dateBooked >= '".prepareDate($_POST['fromDate_ATL_datebook'])."' and campus_schedule.dateBooked <= '".prepareDate($_POST['toDate_ATL_datebook'])."')";
		}
	
		$result_count_10day_datebook.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_10day_datebook=mysql_query($result_count_10day_datebook);
		$string_array_10day_datebook=array();
		if($main==2)
		{
			while($row_count_10day_datebook = mysql_fetch_array($result_count_10day_datebook))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_10day_datebook[]=getData(nl2br( $row_count_10day_datebook['std_status']),'stdStatusmo-list') . " : " . $row_count_10day_datebook['cnt'];

			}
		return implode(" , ",$string_array_10day_datebook);	
		}
	}
	
	if($main==4 && $_POST['fromDate_ATL_duedate']!="" && $_POST['toDate_ATL_duedate']!="")
	{
	$result_count_10day_duedate="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 and campus_schedule.std_status=2";
	if($_POST['fromDate_ATL_duedate']!="" && $_POST['toDate_ATL_duedate']!="")
		{
			$result_count_10day_duedate.=" and (campus_schedule.duedate >= '".prepareDate($_POST['fromDate_ATL_duedate'])."' and campus_schedule.duedate <= '".prepareDate($_POST['toDate_ATL_duedate'])."')";
		}
	
		$result_count_10day_duedate.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_10day_duedate=mysql_query($result_count_10day_duedate);
		$string_array_10day_duedate=array();
		if($main==4)
		{
			while($row_count_10day_duedate = mysql_fetch_array($result_count_10day_duedate))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_10day_duedate[]=getData(nl2br( $row_count_10day_duedate['std_status']),'stdStatusmo-list') . " : " . $row_count_10day_duedate['cnt'];

			}
		return implode(" , ",$string_array_10day_duedate);	
		}
	}
	
	
	if($main==3)
	{
	$result_count_allday="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 ";
	
	$result_count_allday.=" GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status ASC";
		
		$result_count_allday=mysql_query($result_count_allday);
		$string_array_allday=array();
		if($main==3)
		{
			while($row_count_allday = mysql_fetch_array($result_count_allday))
			{ 
				//echo "<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				//$string_array[]="<div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."";
				$string_array_allday[]=getData(nl2br( $row_count_allday['std_status']),'stdStatusmo-list') . " : " . $row_count_allday['cnt'];

			}
		return implode(" , ",$string_array_allday);	
		}
	}
	
	/*$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='$teamlead_ids' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 GROUP BY campus_schedule.std_status ORDER BY campus_schedule.std_status DESC");

	$result_count=mysql_query($result_count);
	
	while($row_count = mysql_fetch_array($result_count))
	{ 
		echo "<br><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	echo "<hr>";*/
 }

/////////////////////////////TEAMLEAD AGENT OVERALL COUNT SUMMARY FUNCTION////////////////5 Times call to this func /////////////////////	//NEWLY ADDED  
 function teamlead_agent_overall_count_summary()
 {
	//COUNT QUERY

	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	
	while($row_count = mysql_fetch_array($result_count))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
	}	
	echo "<hr>";
 }
 
 
 






//////////////////////////////////////////////////////TEAM LEAD COUNT FUNCTION///////////////////////////////////////////	//NEWLY ADDED  
 function teamlead_count_teacher()
 {
	//COUNT QUERY
	if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0 && $_SESSION['userType']==1)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$result_count.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
	else
		{
			$result_count.=" GROUP BY campus_schedule.std_status";
		}
	$result_count=mysql_query($result_count);
	}
	
	else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0 && $_SESSION['userType']==8)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	//$result_count=mysql_query($result_count);
	}	
	
	else if($_SESSION['userType']==8 && isset($_SESSION['userId']))
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	}
	
	else if(isset($_POST['search-submit']) && $_POST['stdStatus']!=0)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON campus_schedule.std_status='".$_POST['stdStatus']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']!=2)
		{
			$result_count.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result_count.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else
		{
			$result_count.=" GROUP BY campus_schedule.std_status";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result_count=mysql_query($result_count);
	}
	
	else
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	}
	while($row_count = mysql_fetch_array($result_count))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
	}
 }
 
 
 
 function teamlead_count_agent()
 {
	//COUNT QUERY
	if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0 && $_SESSION['userType']==1)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-agent-id2']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0");
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$result_count.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else
		{
			$result_count.=" GROUP BY campus_schedule.std_status";
		}
	$result_count=mysql_query($result_count);
	}
	
	else if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0 && $_SESSION['userType']==9)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 GROUP BY campus_schedule.std_status");
	//$result_count=mysql_query($result_count);
	}
	
	else if($_SESSION['userType']==9 && isset($_SESSION['userId']))
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	}
	
	else if(isset($_POST['search-submit']) && $_POST['stdStatus']!=0)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON campus_schedule.std_status='".$_POST['stdStatus']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0");
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']!=2)
		{
			$result_count.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result_count.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else
		{
			$result_count.=" GROUP BY campus_schedule.std_status";
		}
	$result_count=mysql_query($result_count);
	}
	
	else
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count);
	}
	while($row_count = mysql_fetch_array($result_count))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
	}
 }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////// NEWLY ADDED - FOR teamlead_teacher_report.php for Teacher TeamLeads report

function teacher_teamlead_report()	//userTyep==8
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.comments,campus_schedule.record_link_dead 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']==1)
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']!=1)
	{
		$sql.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////// NEWLY ADDED //14-08-2015 - FOR teamlead_teacher_report.php for Teacher TeamLeads report OLD

function teacher_teamlead_report_old()	//userTyep==8
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule_23sep2017_backup.id as sch_id,campus_schedule_23sep2017_backup.dead_date,campus_schedule_23sep2017_backup.std_status_old,campus_schedule_23sep2017_backup.std_status,campus_schedule_23sep2017_backup.studentID,campus_schedule_23sep2017_backup.status,campus_schedule_23sep2017_backup.dues as dues,campus_schedule_23sep2017_backup.dateBooked,campus_schedule_23sep2017_backup.duedate,campus_schedule_23sep2017_backup.comments_dead,campus_schedule_23sep2017_backup.courseID,campus_schedule_23sep2017_backup.teacherID,campus_schedule_23sep2017_backup.teacherID_old,campus_schedule_23sep2017_backup.confirm_dead_date,campus_schedule_23sep2017_backup.comments  
	FROM capmus_users 
	INNER JOIN campus_schedule_23sep2017_backup 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule_23sep2017_backup.teacherID and campus_schedule_23sep2017_backup.status=1 and campus_schedule_23sep2017_backup.teacherID!=0");
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule_23sep2017_backup.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule_23sep2017_backup.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule_23sep2017_backup.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule_23sep2017_backup.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule_23sep2017_backup.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']==1)
	{
		$sql.=" and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']!=1)
	{
		$sql.=" and DATE(campus_schedule_23sep2017_backup.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule_23sep2017_backup.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule_23sep2017_backup.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




////////////////////// NEWLY ADDED - FOR teamlead_teacher_report.php for MAIN Teacher TeamLeads report

function main_teacher_teamlead_report()	//userTyep==15
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.comments,campus_schedule.record_link_dead 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']==1)
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$sql.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////// NEWLY ADDED //14-08-2015 - FOR teamlead_teacher_report.php for MAIN Teacher TeamLeads report OLD

function main_teacher_teamlead_report_old()	//userTyep==15
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule_23sep2017_backup.id as sch_id,campus_schedule_23sep2017_backup.dead_date,campus_schedule_23sep2017_backup.std_status_old,campus_schedule_23sep2017_backup.std_status,campus_schedule_23sep2017_backup.studentID,campus_schedule_23sep2017_backup.status,campus_schedule_23sep2017_backup.dues as dues,campus_schedule_23sep2017_backup.dateBooked,campus_schedule_23sep2017_backup.duedate,campus_schedule_23sep2017_backup.comments_dead,campus_schedule_23sep2017_backup.courseID,campus_schedule_23sep2017_backup.teacherID,campus_schedule_23sep2017_backup.teacherID_old,campus_schedule_23sep2017_backup.confirm_dead_date,campus_schedule_23sep2017_backup.comments 
	FROM capmus_users 
	INNER JOIN campus_schedule_23sep2017_backup 
	ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule_23sep2017_backup.teacherID and campus_schedule_23sep2017_backup.status=1 and campus_schedule_23sep2017_backup.teacherID!=0");
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule_23sep2017_backup.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule_23sep2017_backup.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule_23sep2017_backup.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule_23sep2017_backup.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule_23sep2017_backup.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']==1)
	{
		$sql.=" and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$sql.=" and DATE(campus_schedule_23sep2017_backup.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule_23sep2017_backup.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule_23sep2017_backup.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////// NEWLY ADDED - FOR teamlead_teacher_report.php for CONFIRM DEAD checkbox that is applied 
//on confirm_dead_date COLUMN

function confirm_dead_teacher_teamlead_report()
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.paydate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.record_link_dead  
	FROM capmus_users 
	INNER JOIN campus_schedule ON 
	campus_schedule.std_status='3' and 
	capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
	if($_POST['search-teacher-main']!=0)
	{
		$sql.=" and capmus_users.main_LeadId='".$_POST['search-teacher-main']."'";
	}
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."'";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.confirm_dead_date ASC";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////// NEWLY ADDED //14-08-2015 - FOR teamlead_teacher_report.php for CONFIRM DEAD checkbox that is applied 
//on confirm_dead_date COLUMN

function confirm_dead_teacher_teamlead_report_old()
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule_23sep2017_backup.id as sch_id,campus_schedule_23sep2017_backup.dead_date,campus_schedule_23sep2017_backup.std_status_old,campus_schedule_23sep2017_backup.std_status,campus_schedule_23sep2017_backup.studentID,campus_schedule_23sep2017_backup.status,campus_schedule_23sep2017_backup.dues as dues,campus_schedule_23sep2017_backup.dateBooked,campus_schedule_23sep2017_backup.duedate,campus_schedule_23sep2017_backup.paydate,campus_schedule_23sep2017_backup.comments_dead,campus_schedule_23sep2017_backup.courseID,campus_schedule_23sep2017_backup.teacherID,campus_schedule_23sep2017_backup.teacherID_old,campus_schedule_23sep2017_backup.confirm_dead_date,campus_schedule_23sep2017_backup.comments,campus_schedule_23sep2017_backup.dead_reason  
	FROM capmus_users 
	INNER JOIN campus_schedule_23sep2017_backup ON 
	campus_schedule_23sep2017_backup.std_status='3' and 
	capmus_users.id=campus_schedule_23sep2017_backup.teacherID and campus_schedule_23sep2017_backup.status=1 and campus_schedule_23sep2017_backup.teacherID!=0");
	if($_POST['search-teacher-main']!=0)
	{
		$sql.=" and capmus_users.main_LeadId='".$_POST['search-teacher-main']."'";
	}
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule_23sep2017_backup.teacherID='".$_POST['search-teacher-id']."'";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule_23sep2017_backup.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule_23sep2017_backup.confirm_dead_date ASC";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   FOLLWOING IS NOT BEING USED   XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
////////////////////// NEWLY ADDED - FOR teamlead_teacher_report.php for DEAD-REGULAR, DEAD-TRIAL, DEAD-MAKEOVER

function teacher_teamlead_report_version_2()	//GENERALIZED
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.dead_reason 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
	
	//MAIN TEACHER TEAMLEAD
	if(isset($_POST['search-teacher-main']) && !empty($_POST['search-teacher-main']))
	{
		$sql.= " capmus_users.main_LeadId='".$_POST['search-teacher-main'];
	}
	//TEACHER TEAMLEAD(NOT MAIN)
	if($_POST['search-teacher-id2']!=0 && !empty($_POST['search-teacher-id2']))
	{
		$sql.= " capmus_users.LeadId='".$_POST['search-teacher-id2'];
	}
	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$sql.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX




//vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv   FOLLWOING IS BEING USED   vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
////////////////////// NEWLY ADDED - FOR teamlead_teacher_report.php for DEAD-REGULAR, DEAD-TRIAL, DEAD-MAKEOVER

function teacher_teamlead_report_DEAD_Reg_Trl_MO()	//GENERALIZED
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.dead_reason 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID ");
	
	//MAIN TEACHER TEAMLEAD
	if(isset($_POST['search-teacher-main']) && !empty($_POST['search-teacher-main']))
	{
		$sql.= " and capmus_users.main_LeadId=".$_POST['search-teacher-main'];
	}
	//TEACHER TEAMLEAD(NOT MAIN)
	if($_POST['search-teacher-id2']!=0 && !empty($_POST['search-teacher-id2']))
	{
		$sql.= " and capmus_users.LeadId=".$_POST['search-teacher-id2'];
	}
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_schedule.teacherID=".$_POST['search-teacher-id'];
	}
	
	
	//STUDENT STATUS - current(which will be dead)
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	//STUDENT STATUS - Applying condition on old
		if(isset($_POST['stdStatus_deadReg']) && !empty($_POST['stdStatus_deadReg']))
		{
			$sql.= " and campus_schedule.std_status_old = 2 ";
		}
		if(isset($_POST['stdStatus_deadTrl']) && !empty($_POST['stdStatus_deadTrl']))
		{
			$sql.= " and campus_schedule.std_status_old = 1 ";
		}
		if(isset($_POST['stdStatus_deadMO']) && !empty($_POST['stdStatus_deadMO']))
		{
			$sql.= " and campus_schedule.std_status_old = 5 ";
		}
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']==1)
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && $_POST['stdStatus_confirmdead']!=1)
	{
		$sql.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.="  and campus_schedule.status=1 and campus_schedule.teacherID!=0 ORDER BY campus_schedule.confirm_dead_date ASC";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

















//////////////////////////////////////////////////////////////// NEWLY ADDED - FOR teamlead_agent_report.php for Agent TeamLeads report

function agent_teamlead_report()
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0");
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
	{
		$sql.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
	{
		$sql.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.agentId";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver2 , FOR book_scheduler_manage.php for Teacher TeamLeads own members

function getResultResource_teamlead_teacher()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,campus_schedule.dues_original,
	campus_schedule.grade,campus_schedule.syllabus   
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=0 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver2 , FOR book_scheduler_manage.php for Agents TeamLeads own members

function getResultResource_teamlead_agent()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver3 , FOR book_scheduler_manage.php, QURAN READ ONLY SCHEDULES 

function getResultResource_teamlead_quran_readonly()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate 
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.courseID=11";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////// NEWLY ADDED -  FOR book_scheduler_manage.php for MAIN Teacher TeamLeads own members

function getResultResource_teamlead_teacher_main()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,campus_schedule.grade,campus_schedule.syllabus  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=0 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////// NEWLY ADDED -  FOR book_scheduler_manage.php for MAIN Teacher TeamLeads own members

function getResultResource_teamlead_agent_main()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//************************************************************** PRESENT ABSENT REPORT TEAMLEAD
///////////////////////// NEWLY ADDED - getResultResource_teamlead_present_absent, FOR present_absent_report.php for Teacher TeamLeads own members

function getResultResource_teamlead_present_absent()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,
	campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
	campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
	campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID 
	INNER JOIN campus_attendance_student ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 ";



	/*"SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType 
	FROM capmus_users,campus_schedule 
	WHERE capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID 
	and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3";
	
	"SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType
	campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,campus_attendance_student.startTime as sa_st,campus_attendance_student.date as sa_date 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_attendance_student ON campus_schedule.teacherID=campus_attendance_student.teacherID and campus_schedule.studentID=campus_attendance_student.studentID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	";*/
	/*campus_schedule.teacherID=campus_attendance_student.teacherID and campus_schedule.studentID=campus_attendance_student.studentID and campus_schedule.startTime=campus_attendance_student.startTime*/
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	/*if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}*/
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  campus_schedule.".getClassTypeSchedule($_POST['classType']);
	}
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_attendance_student.date>='".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<='".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////// NEWLY ADDED - , FOR book_scheduler_manage.php for QC

function getResultResource_qc()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,campus_schedule.dues_original,
	campus_schedule.grade,campus_schedule.syllabus   
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId IN (2117,347,834) and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=0 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//************************************************************** PRESENT ABSENT REPORT superadmin
///////////////////////// NEWLY ADDED - getResultResource_teamlead_present_absent, FOR present_absent_report.php for Teacher TeamLeads own members

function getResultResource_teamlead_present_absent_superadmin()
{
global $_LIST,$_return;

/*$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType 
	FROM capmus_users,campus_schedule 
	WHERE capmus_users.id=campus_schedule.teacherID 
	and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3";*/
	
	$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,
	campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
	campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
	campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id=campus_schedule.teacherID 
	INNER JOIN campus_attendance_student ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	";
	/*campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and*/ 
	/*campus_schedule.teacherID=campus_attendance_student.teacherID and campus_schedule.studentID=campus_attendance_student.studentID and campus_schedule.startTime=campus_attendance_student.startTime*/
	/*if($_LIST['systemdate']==date("Y-m-d"))
	{
		$sql.=" and campus_attendance_student.date=".$_LIST['systemdate'];
	}*/
	if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$sql.= " and capmus_users.LeadId = ".$_POST['search-teacher-id2'];
	}
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	/*if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}*/
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  campus_schedule.".getClassTypeSchedule($_POST['classType']);
	}
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_attendance_student.date>='".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<='".prepareDate($_POST['toDate'])."'";
	}
	$sql.=" ORDER BY campus_schedule.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////// NEWLY ADDED - , FOR logging_list.php

function logging_list($max)
{
global $_LIST,$_return;

	$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON capmus_users.status=1";
	//////SEARCH AGENT WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-agent-id']!=0)
	{
		$sql.=" and capmus_users.user_type=5 and campus_user_log.user_id='".$_POST['search-agent-id']."' and capmus_users.id='".$_POST['search-agent-id']."' ";
	}
	//////SEARCH TEACHER TEAMLEAD WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.user_type=8 and campus_user_log.user_id='".$_POST['search-teacher-id2']."' and capmus_users.id='".$_POST['search-teacher-id2']."' ";
	}
	//////SEARCH AGENT TEAMLEAD WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0)
	{
		$sql.=" and capmus_users.user_type=9 and campus_user_log.user_id='".$_POST['search-agent-id2']."' and capmus_users.id='".$_POST['search-agent-id2']."' ";
	}
	//////SEARCH ADMIN WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-admin-id']!=0)
	{
		$sql.=" and capmus_users.user_type=2 and campus_user_log.user_id='".$_POST['search-admin-id']."' and capmus_users.id='".$_POST['search-admin-id']."' ";
	}
	//////SEARCH SUPER-ADMIN WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-superadmin-id']!=0)
	{
		$sql.=" and capmus_users.user_type=1 and campus_user_log.user_id='".$_POST['search-superadmin-id']."' and capmus_users.id='".$_POST['search-superadmin-id']."' ";
	}
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}

		$sql.=" and capmus_users.id=campus_user_log.user_id ".$max." ";
	//echo $sql;
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////// NEWLY ADDED - , FOR logging_list_DEAD.php

function logging_list_DEAD()
{
global $_LIST,$_return;

	$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON capmus_users.status=1";
	/*
	//////SEARCH AGENT WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-agent-id']!=0)
	{
		$sql.=" and capmus_users.user_type=5 and campus_user_log.user_id='".$_POST['search-agent-id']."' and capmus_users.id='".$_POST['search-agent-id']."' ";
	}
	//////SEARCH TEACHER TEAMLEAD WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.user_type=8 and campus_user_log.user_id='".$_POST['search-teacher-id2']."' and capmus_users.id='".$_POST['search-teacher-id2']."' ";
	}
	//////SEARCH AGENT TEAMLEAD WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0)
	{
		$sql.=" and capmus_users.user_type=9 and campus_user_log.user_id='".$_POST['search-agent-id2']."' and capmus_users.id='".$_POST['search-agent-id2']."' ";
	}
	//////SEARCH ADMIN WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-admin-id']!=0)
	{
		$sql.=" and capmus_users.user_type=2 and campus_user_log.user_id='".$_POST['search-admin-id']."' and capmus_users.id='".$_POST['search-admin-id']."' ";
	}
	//////SEARCH SUPER-ADMIN WISE//////
	if(isset($_POST['search-submit']) && $_POST['search-superadmin-id']!=0)
	{
		$sql.=" and capmus_users.user_type=1 and campus_user_log.user_id='".$_POST['search-superadmin-id']."' and capmus_users.id='".$_POST['search-superadmin-id']."' ";
	}
	*/
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0 && $_POST['log_schedule']==5)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}
	
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0 && $_POST['log_schedule']==6)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}
	
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0 && $_POST['log_schedule']==12)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}
	
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0 && $_POST['log_schedule']==2)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}
	
	if(isset($_POST['search-submit']) && $_POST['log_schedule']!=0 && $_POST['log_schedule']==3)
	{
		$sql.=" and campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";
	}
	
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && ($_POST['log_schedule']==5 || $_POST['log_schedule']==6 || $_POST['log_schedule']==12 || $_POST['log_schedule']==2 || $_POST['log_schedule']==3))
	{
		$sql.=" and DATE(campus_user_log.datetime)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_user_log.datetime)<= '".prepareDate($_POST['toDate'])."'";
	}
	
	
	//WHOLE SEPARATE QUERY FOR MAKE OVER AUTO DEAD FILTERS under logging_list_DEAD.php
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && ($_POST['log_schedule']==19))
	{
		
	$sql="SELECT campus_user_log.* 
	FROM campus_user_log 
	WHERE campus_user_log.action='".getData(nl2br( $_POST['log_schedule']),'log_schedule')."' ";	
	$sql.=" and DATE(campus_user_log.datetime)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_user_log.datetime)<= '".prepareDate($_POST['toDate'])."'";
	}	
	//Following is for MAKE OVER AUTO DEAD under logging_list_DEAD and no condition for capmus_users to be
	//equal to campus_user_log ID
	if($_POST['log_schedule']==19)
	{
		//$sql.=" and capmus_users.id!=campus_user_log.user_id ";
	}
	else
	{
		$sql.=" and capmus_users.id=campus_user_log.user_id ";
	}
		//echo $sql;
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function getResultResource_campus_timing()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.status,
	campus_timing.id,campus_timing.mon,campus_timing.tue,campus_timing.wed,campus_timing.thu,campus_timing.fri,campus_timing.sat,
	campus_timing.startTime,campus_timing.endTime,campus_timing.teacherID 
	FROM capmus_users 
	INNER JOIN campus_timing 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_timing.teacherID and capmus_users.status=1";
	
	//$sql.=" ORDER BY campus_timing.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function schedule_with_teamlead()
{
global $_LIST,$_return;

/*$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,
	campus_students.id as s_id,campus_students.email as s_email,campus_students.mobile as s_mobile,campus_students.phone as s_phone,campus_students.landline as s_landline,campus_students.countryID as s_country 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_students ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	ORDER BY campus_schedule.teacherID";*/
	
	
	//if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	//{
		//$sql.= " and capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' ";
	//}
	//$sql.=" ORDER BY campus_schedule.teacherID";
	//$_return=mysql_query($sql) or trigger_error(mysql_error());
	//return $_return;
}

//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver3 , FOR book_scheduler_manage.php 
//for SUPERADMIN ALL FILTERING FUNCTIONS/DROPDOWNS

function getResultResource_superadmin()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.grade,campus_schedule.syllabus,campus_schedule.record_link  
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.std_status!=3 and
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	if(isset($_POST['start_range']) && !empty($_POST['start_range']) && isset($_POST['end_range']) && !empty($_POST['end_range']))
	{
		$sql.= " and campus_schedule.dues BETWEEN ".$_POST['start_range']." AND ".$_POST['end_range']."";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver2 , FOR employee_profile.php for Teacher TeamLeads own members

function getResultResource_emp_pro_teamlead()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.fatherName,capmus_users.phone,
	capmus_users.email,capmus_users.address,capmus_users.skypeId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3";
	/*if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}*/
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	/*if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}*/
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource - Ver3 , FOR employee_profile.php 
//for SUPERADMIN ALL FILTERING FUNCTIONS/DROPDOWNS

function getResultResource_emp_pro_superadmin()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType 
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.std_status!=3";
	/*if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}*/
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	/*if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}*/
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////TEAM LEAD+SUPERADMIN COUNT FUNCTION-EMPYOYEE PROFILE///////////////////////////////////////////	//NEWLY ADDED  
 function teamlead_count_teacher_emp_pro()
 {
 global $_LIST;
	//COUNT QUERY
	if(isset($_POST['search-submit']) && $_POST['search-teacher-id']!=0 && $_SESSION['userType']==1)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.dateBooked 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count) or trigger_error(mysql_error());
	}
	
	else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0 && $_SESSION['userType']==8)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	//$result_count=mysql_query($result_count);
	}	
	
	else if($_SESSION['userType']==8 && isset($_SESSION['userId']))
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count) or trigger_error(mysql_error());
	}
	
	else if(isset($_POST['search-submit']) && $_POST['stdStatus']!=0)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON campus_schedule.std_status='".$_POST['stdStatus']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0");
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']!=2)
		{
			$result_count.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result_count.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' GROUP BY campus_schedule.std_status";
		}
		else
		{
			$result_count.=" GROUP BY campus_schedule.std_status";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result_count=mysql_query($result_count) or trigger_error(mysql_error());
	}
	
	else
	{
	//$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
	//FROM capmus_users 
	//INNER JOIN campus_schedule 
	//ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	//$result_count=mysql_query($result_count);
	}
	//while($row_count = mysql_fetch_array($result_count))
	//{ 
		//echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
	//}
	return $result_count;
 }


 
 
//////////////////////////////////////////////////////////////// NEWLY ADDED - FOR teacher_info_by_teamlead.php for TeamLead's teacher info

function teacher_info_by_teamlead()
{
global $_LIST,$_return;

	$sql=("SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.skypeId,capmus_users.phone,
	campus_timing.id,campus_timing.startTime,campus_timing.endTime,campus_timing.teacherID 
	FROM capmus_users 
	INNER JOIN campus_timing 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_timing.teacherID");
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 
//NOTE: Following functions are used locally in makeover_cron_auto_dead.php FILE, So commenting here in function-inc.php file 
//////////////////////////////////////////////////////////////// NEWLY ADDED - getResultResource_superadmin_makeover_cron_auto_dead 
/*
function getResultResource_superadmin_makeover_cron_auto_dead()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.startTime,campus_schedule.startDate 
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.std_status=5";
	//$sql.=" ORDER BY campus_schedule.startTime";
	echo $sql; 
  
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;

}


function makeover_auto_dead_request_function($id)
{
	$row_sel = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
	echo $dead_schedule="Course:".getData( nl2br( $row_sel['courseID']),'course').",Teacher:".showUser( nl2br( $row_sel['teacherID'])).",Student:". showStudents(nl2br( $row_sel['studentID']));
	//			.",BKDATE:".nl2br( $row['dateBooked']).",START_DATE:".prepareDate($row['startDate']).",END_DATE:".prepareDate($row['endDate'])
	//			.",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list');
				echo "\n";
				echo "GETTING Student,Teacher and Course NAME-AND making AUTO DEAD";
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
	user_log_makeover_auto_dead( "makeover_cron_auto_dead.php" ,"MAKEOVER_AUTO_DEAD", "N/A" ,$dead_schedule, "Make Over Auto Dead Request");
/////////////////////////////////////////////////////// 

	confirming_dead_schedule($id,'1',"Make Over Auto Dead Request");
}



function user_log_makeover_auto_dead($page, $action, $preval, $newval, $comments_dead)
{

	
	if($action=="MAKEOVER_AUTO_DEAD")
	{
		$user_id=10001;$user_type=10001;
		$sql_insert_user_log=("INSERT INTO campus_user_log VALUES('','$user_id','$user_type',NOW(),'$page','$action','$preval','$newval','$comments_dead')");
		$result_user_log=mysql_query($sql_insert_user_log) or die(mysql_error());
		echo "\n";
		echo "VALUES INSERTED IN LOG";
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
		//echo "<script>alert('Data Entered in user_log, Becareful with manual editing')</script>";
		//echo "Successful";
	}
	
	else 
	{
		//echo "<script>alert('BUGGY')</script>";
		//echo "unsuccessful";
	}
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/






function getResultResource_teacher_commision_superadmin()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.std_status_old 
	FROM campus_schedule 
	WHERE campus_schedule.status=1";
	/*if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}*/
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	/*if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}*/
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//////////////////////////////////////////////////////TEAM LEAD+SUPERADMIN COUNT FUNCTION-TEACHER COMMISION///////////////////////////////////////////	//NEWLY ADDED  
 function teacher_commision()
 {
 global $_LIST;
	//COUNT QUERY
	if(isset($_POST['search-submit']) && $_POST['search-teacher-id']!=0 && $_SESSION['userType']==1)
	{
	$result_count=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,campus_schedule.dateBooked,SUM(campus_schedule.dues) as dues_cnt_regular 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and campus_schedule.std_status=2 and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
	$result_count=mysql_query($result_count) or trigger_error(mysql_error());
	}
	
	return $result_count;
 }
/////////////////////////////////////////////////////////////////////////////////////////////////////////










 
 
 


  
  function getResultResource($_table='',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',$joinselect="",$orderby="",$_fields=""){
  
  global $_LIST,$_return;
  
  if(isset($_post['search-submit'])){
  
  $_queryPost="SELECT ".$_table.".* ";
  if(!empty($_fields)){ $_queryPost.=" ,".$_fields; }
  $_queryPost.=" ".$joinFields." FROM ".$_table." ".$join." ".$joinselect." where ";
  
  if(isset($_post['search-student-id']) && !empty($_post['search-student-id']))
  {
  switch($_table){
  case "campus_students":{
		  if(!empty($_query)){$_query.=" and  campus_students.id= ".$_post['search-student-id'];}else{$_query=" campus_students.id= ".$_post['search-student-id'];}
		  break;}
  default:
  {if(!empty($_query)){$_query.=" and  studentID= ".$_post['search-student-id'];}else{$_query=" studentID= ".$_post['search-student-id'];}
  break;}
  }
  }
  
   if(isset($_post['countryID']) && !empty($_post['countryID']))
  {
  switch($_table){
  case "campus_students":{
		  if(!empty($_query)){$_query.=" and  campus_students.countryID= ".$_post['countryID'];}else{$_query=" campus_students.countryID= ".$_post['countryID'];}
		  break;}
  default:
  {if(!empty($_query)){$_query.=" and  countryID= ".$_post['countryID'];}else{$_query=" countryID= ".$_post['countryID'];}
  break;}
  }
  }
  
  if(isset($_post['search-teacher-id']) && !empty($_post['search-teacher-id']))
  {
		  if(!empty($_query)){
			  $_query.=" and  teacherID= ".$_post['search-teacher-id'];
		  }else{
			  $_query=" teacherID = ".$_post['search-teacher-id'];
			  }
  
		  
  }
  
  

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
/*  if(isset($_post['search-teacher-id2']) && !empty($_post['search-teacher-id2']))
  {
	
  switch($_table){
  case "capmus_users":{
		  if(!empty($_query)){
			  $_query.=" and  capmus_users.LeadId = ".$_post['search-teacher-id2'];
		  }
		  break;}
	  default:
		  {
			  if(empty($_query)){
			  $_query=" capmus_users.LeadId = ".$_post['search-teacher-id2'];
			  }
			  break;
		  }
  }
  
		  
  }*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  if(isset($_post['search-agent-id']) && !empty($_post['search-agent-id']))
  {
  
  switch($_table){
  case "campus_students":{
		  if(!empty($_query)){$_query.=" and  agent_id= ".$_post['search-agent-id'];}else{$_query=" agent_id= ".$_post['search-agent-id'];}
		  $agent_id='agent_id';
		  break;}
	  default:
		  {
			  if(!empty($_query)){$_query.=" and  agentId= ".$_post['search-agent-id'];}else{$_query=" agentId= ".$_post['search-agent-id'];}
		  $agent_id='agentId';
			  break;
		  }
  }
  
  
		  ///////////shift////////////
  if(isset($_post['shift']) && !empty($_post['shift']))
  {
		  if(!empty($_query)){
			  $_query.=" and  $agent_id in ".getShift($_post['shift'],'5');
		  }else{
			  $_query=" $agent_id = ".getShift($_post['shift'],'5');
			  }
  } 
		  ///////////End shift////////	getShift
  }
  
  if(isset($_post['startTime']) && $_post['startTime']!=0)
  {
  if(!empty($_query)){$_query.=" and  startTime= '".$_LIST['time'][$_post['startTime']]."'";}else{$_query=" startTime= '".$_LIST['time'][$_post['startTime']]."'";}
  }
  
  if(isset($_post['class_status']) && !empty($_post['class_status']) )
  {
  if(!empty($_query)){$_query.=" and  status= ".$_post['class_status']."";}else{$_query=" status= ".$_post['class_status']."";}
  }
  
  if(isset($_post['date']) && !empty($_post['date']) )
  {
  if(!empty($_query)){$_query.=" and  `date`= '".prepareDate($_post['date'])."'";}else{$_query=" `date`= '".prepareDate($_post['date'])."'";}
  }
  
  if(isset($_post['classType']) && $_post['classType']!=0)
  {
  if(!empty($_query)){$_query.=" and  ".getClassTypeSchedule($_post['classType']);}else{$_query=" ".getClassTypeSchedule($_post['classType']);}}
  
  /////////////* trila report */////////////////////
  
  if((isset($_post['fromDate']) && $_post['fromDate']!=0) && (isset($_post['toDate']) && $_post['toDate']!=0))
  {
  if(!empty($_query)){$_query.=" and  dateBooked>= '".prepareDate($_post['fromDate'])."' and dateBooked<= '".prepareDate($_post['toDate'])."'";}else{$_query=" dateBooked>= '".prepareDate($_post['fromDate'])."' and dateBooked<= '".prepareDate($_post['toDate'])."'";}
  }
  
  ////////////////////////////////////////////////////////////////* signup report *///////////////////////////////////////////////////////////-NEWLY ADDED
  
  if((isset($_post['fromDate-s']) && $_post['fromDate-s']!=0) && (isset($_post['toDate-s']) && $_post['toDate-s']!=0))
  {
  if(!empty($_query)){$_query.=" and  duedate>= '".prepareDate($_post['fromDate-s'])."' and duedate<= '".prepareDate($_post['toDate-s'])."'";}else{$_query=" duedate>= '".prepareDate($_post['fromDate-s'])."' and duedate<= '".prepareDate($_post['toDate-s'])."'";}
  }
  
  //////////////////////////////////////////////////////////
  
  ///////////////////// Shift  ///////////////
  /*
  if(isset($_post['shift']) && !empty($_post['shift']))
  {
		  if(!empty($_query)){
			  $_query.=" and  agent_id in ".getShift($_post['shift'],'5');
		  }else{
			  $_query=" agent_id in ".getShift($_post['shift'],'5');
			  }
  }
  */
		  ///////////shift////////////
  if(isset($_post['shift']) && !empty($_post['shift']))
  {
		  if(!empty($_query)){
			  $_query.=" and  teacherID in ".getShift($_post['shift'],'3');
		  }else{
			  $_query=" teacherID in ".getShift($_post['shift'],'3');
			  }
  }
		  ///////////End shift////////	getShift
  //////////////End Shift ////////////////////
  
  if(isset($_post['stdStatus']) && $_post['stdStatus']!=0)
  {
  if(!empty($_query)){$_query.=" and  std_status= '".$_post['stdStatus']."'";}else{$_query=" std_status= '".$_post['stdStatus']."'";}
  }
  
  if(isset($_where) && !empty($_where))
  {
  if(!empty($_query)){$_query.=" and  ".$_where;}else{$_query=" ".$_where;}
  }
   $_query=$_queryPost.$_query." ".$joinWhere;
  }
  else{
  $_query="SELECT ".$_table.".* ";
  if(!empty($_fields)){ $_query.=" ,".$_fields; }
  $_query.=" ".$joinFields." FROM ".$_table." ".$join ." ".$joinselect;
  if(isset($_where) && !empty($_where) )
  {
  $_query.=" where ".$_where." ".$joinWhere;
  }
  
  }
  
  /////// calculate Counter//////////////
  switch($_table)
  {
	  case "campus_attendance_student":
	  {
		  $query=str_replace('SELECT *','SELECT count(id) as count,status ',$_query);
		  $query=$query." group by status ";
		  $return=mysql_query($query) or trigger_error(mysql_error());
		  $data=array();
		  $data['sum']=0;
		  while($row=mysql_fetch_assoc($return)){
			  $data['sum']=$data['sum']+$row['count'];
			  
			  if(!isset($row['status']))
			  {
					  $data['null']=$row['count'];
			  }
			  else{
					  $data[$row['status']]=$row['count'];
				  }
			  
			  }
		  echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Present : ".$data['1']."&nbsp;&nbsp;&nbsp; Absent : ".$data['0']." &nbsp;&nbsp;&nbsp;Status Null : ".$data['null']."</div><br><br><br></b>";
		  break;
		  }
	case "campus_attendance_student_old":
	  {
		  $query=str_replace('SELECT *','SELECT count(id) as count,status ',$_query);
		  $query=$query." group by status ";
		  $return=mysql_query($query) or trigger_error(mysql_error());
		  $data=array();
		  $data['sum']=0;
		  while($row=mysql_fetch_assoc($return)){
			  $data['sum']=$data['sum']+$row['count'];
			  
			  if(!isset($row['status']))
			  {
					  $data['null']=$row['count'];
			  }
			  else{
					  $data[$row['status']]=$row['count'];
				  }
			  
			  }
		  echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Present : ".$data['1']."&nbsp;&nbsp;&nbsp; Absent : ".$data['0']." &nbsp;&nbsp;&nbsp;Status Null : ".$data['null']."</div><br><br><br></b>";
		  break;
		  }
		  
		  case "campus_schedule":
	  {
		  $query=str_replace('SELECT campus_schedule.*','SELECT count(campus_schedule.id) as count,campus_schedule.std_status ',$_query);
		  $query=$query." group by campus_schedule.std_status ";
		  $return=mysql_query($query) or trigger_error(mysql_error());
		  $data=array();
		  $data['sum']=0;
		  while($row=mysql_fetch_assoc($return)){
			  $data['sum']=$data['sum']+$row['count'];
			  
			  if(!isset($row['std_status']))
			  {
					  $data['null']=$row['count'];
			  }
			  else{
					  $data[$row['std_status']]=$row['count'];
				  }
			  
			  }
		  echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Trial : ".$data['1']."&nbsp;&nbsp;&nbsp; Regular : ".$data['2']." &nbsp;&nbsp;&nbsp;Dead : ".$data['3']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br><br></b>";
		  break;
		  }
	  case "campus_students":
	  {
		  $query=str_replace('SELECT campus_students.*','SELECT count(campus_students.id) as count,campus_students.std_status ',$_query);
		  $query=$query." group by std_status ";
		  $return=mysql_query($query) or trigger_error(mysql_error());
		  $data=array();
		  $data['sum']=0;
		  while($row=mysql_fetch_assoc($return)){
			  $data['sum']=$data['sum']+$row['count'];
			  
			  if(!isset($row['std_status']))
			  {
					  $data['null']=$row['count'];
			  }
			  else{
					  $data[$row['std_status']]=$row['count'];
				  }
			  
			  }
		 // echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Trial : ".$data['1']."&nbsp;&nbsp;&nbsp; Regular : ".$data['2']." &nbsp;&nbsp;&nbsp;Dead : ".$data['3']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br><br></b>";
		  break;
		  }
	  case "capmus_users":
	  {
		  $query=str_replace('SELECT *','SELECT count(capmus_users.id) as count,status ',$_query);
		  $query=$query." group by status ";
		  $return=mysql_query($query) or trigger_error(mysql_error());
		  $data=array();
		  $data['sum']=0;
		  while($row=mysql_fetch_assoc($return)){
			  $data['sum']=$data['sum']+$row['count'];
			  
			  if(!isset($row['status']))
			  {
					  $data['null']=$row['count'];
			  }
			  else{
					  $data[$row['status']]=$row['count'];
				  }
			  
			  }
		  echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Active : ".$data['1']."&nbsp;&nbsp;&nbsp; Deactive : ".$data['2']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br><br></b>";
		  
		  break;
		  }
	  case "campus_students":
	  {
		  break;
		  }
	  
  }
  
  
    if(isset($_post['course']) && $_post['course']!=0)
  {
  if(!empty($_query)){$_query.=" and  courseID='".$_post['course']."'";}else{$_query=" courseID='".$_post['course']."'";}
  }
  /////////////// Ends calculate counter//////////////
		 $_query.=" ".$orderby; 
  $_return=mysql_query($_query) or trigger_error(mysql_error());
  return $_return;
  }

  
  //ADDED 08-12-2016	//For PARENT filter
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED  
  function getParentFilter(){
  
  $data='<div id="parent" style="position:relative"><input name="search-parent" id="search-parent" type="text" value="Select Parent" onkeyup="javascript:autoParent()" onfocus="javascript:clearAll(this)" onblur="javascript:resetParent(this)"/>
  <input name="search-parent-id" id="search-parent-id" type="hidden" />
  <div id="parentResults"></div>
  </div>';
  echo $data;
  
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  
  //ADDED 26-09-2013	//For Commision task
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED  
  function getReferenceFilter_new_student(){
  
  $data='<div id="reference" style="position:relative"><input name="search-reference" id="search-reference" type="text" value="Select Reference" onkeyup="javascript:autoReference()" onfocus="javascript:clearAll(this)" onblur="javascript:resetReference(this)"/>
  <input name="search-reference-id" id="search-reference-id" type="hidden" />
  <div id="referenceResults"></div>
  </div>';
  echo $data;
  
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED  
  function getStudentFilter_new_schedule(){
  
  $data='<div id="student2" style="position:relative"><input name="search-student2" id="search-student2" type="text" value="Select Student" onkeyup="javascript:autoStudent2()" onfocus="javascript:clearAll(this)" onblur="javascript:resetStudent2(this)"  />
  <input name="search-student-id2" id="search-student-id2" type="hidden"  />
  <div id="studentResults2"></div>
  </div>';
  echo $data;
  
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  
  function getStudentFilter(){
  
  $data='<div id="student" style="position:relative"><input name="search-student" id="search-student" type="text" value="Select Student" onkeyup="javascript:autoStudent()" onfocus="javascript:clearAll(this)" onblur="javascript:resetStudent(this)"/>
  <input name="search-student-id" id="search-student-id" type="hidden" />
  <div id="studentResults"></div>
  </div>';
  echo $data;
  
  }

  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function getTeacherFilterLead(){
  
  $data='<div id="teacher" style="position:relative">
  <input name="search-teacher2" id="search-teacher2" type="text" value="Select Teacher TeamLead" onkeyup="javascript:autoTeacherLead()" onfocus="javascript:clearAll(this)" onblur="javascript:resetTeacherLead(this)"/>
  <input name="search-teacher-id2" id="search-teacher-id2" type="hidden" />
  <div id="teacherResults2"></div>
  </div>';
  echo $data;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  
  function getTeacherFilter(){
  
  $data='<div id="teacher" style="position:relative">
  <input name="search-teacher" id="search-teacher" type="text" value="Select Teacher" onkeyup="javascript:autoTeacher()" onfocus="javascript:clearAll(this)" onblur="javascript:resetTeacher(this)"/>
  <input name="search-teacher-id" id="search-teacher-id" type="hidden" />
  <div id="teacherResults"></div>
  </div>';
  echo $data;
  
  }

  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED
  function getAgentFilterLead(){
  
  $data='<div id="agent" style="position:relative">
  <input name="search-agent2" id="search-agent2" type="text" value="Select Agent TeamLead" onkeyup="javascript:autoAgentLead()" onfocus="javascript:clearAll(this)" onblur="javascript:resetAgentLead(this)"/>
  <input name="search-agent-id2" id="search-agent-id2" type="hidden" />
  <div id="agentResults2"></div>
  </div>';
  echo $data;
  
  }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  function getAgentFilter(){
  
  $data='<div id="agent" style="position:relative">
  <input name="search-agent" id="search-agent" type="text" value="Select Agent" onkeyup="javascript:autoAgent()" onfocus="javascript:clearAll(this)" onblur="javascript:resetAgent(this)"/>
  <input name="search-agent-id" id="search-agent-id" type="hidden" />
  <div id="agentResults"></div>
  </div>';
  echo $data;
  
  }


  
  ///////////////////////////////////////////////////////////////////////ADMIN FILTER///////////////////////////////////////// NEWLY ADDED
  function getAdminFilter(){
  
  $data='<div id="admin" style="position:relative">
  <input name="search-admin" id="search-admin" type="text" value="Select Admin" onkeyup="javascript:autoAdmin()" onfocus="javascript:clearAll(this)" onblur="javascript:resetAdmin(this)"/>
  <input name="search-admin-id" id="search-admin-id" type="hidden" />
  <div id="adminResults"></div>
  </div>';
  echo $data;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  ///////////////////////////////////////////////////////////////////////SUPER ADMIN FILTER///////////////////////////////////////// NEWLY ADDED
  function getSuperAdminFilter(){
  
  $data='<div id="superadmin" style="position:relative">
  <input name="search-superadmin" id="search-superadmin" type="text" value="Select Super Admin" onkeyup="javascript:autoSuperAdmin()" onfocus="javascript:clearAll(this)" onblur="javascript:resetSuperAdmin(this)"/>
  <input name="search-superadmin-id" id="search-superadmin-id" type="hidden" />
  <div id="superadminResults"></div>
  </div>';
  echo $data;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// NEWLY ADDED  
  function getemployee(){
  
  $data='<div id="employee-payroll" style="position:relative">
  <input name="search-employee-payroll" id="search-employee-payroll" type="text" value="Select Employee" onkeyup="javascript:autoEmployeePayroll()" onfocus="javascript:clearAll(this)" onblur="javascript:resetEmployeePayroll(this)"/>
  <input name="search-employee-payroll-id" id="search-employee-payroll-id" type="hidden" />
  <div id="employee-payroll-results"></div>
  </div>';
  echo $data;
  
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  
  /////////////////// FILTER FOR MAIN TEACHER TEAMLEAD/////////////////////// NEWLY ADDED //10-12-2013
  function getTeacherFilterLead_main(){
  
  $data='<div id="teacher" style="position:relative">
  <input name="search-teachermain" id="search-teachermain" type="text" value="Select MAIN Teacher TeamLead" onkeyup="javascript:autoTeacherLead_main()" onfocus="javascript:clearAll(this)" onblur="javascript:resetTeacherLead_main(this)"/>
  <input name="search-teacher-main" id="search-teacher-main" type="hidden" />
  <div id="teacherResults_main"></div>
  </div>';
  echo $data;
  
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  

  
  function getCourseFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','course','course').'</div>';
  echo $data;
  
  }
  
  function getPlanFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','classType','plan').'</div>';
  echo $data;
  
  }
  
  function getShiftFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','shift','shift').'</div>';
  echo $data;
  
  }
  
  function getStartTimeFilter(){
  
  $data='<div id="time" style="position:relative">'.getList(stripslashes($row['startTime']),'startTime','time','Start Time').'</div>';
  echo $data;
  
  }
  
  function getFilterSubmit(){
  
  $data='<div id="submit" style="position:relative">
  <input name="search-submit" class="button" id="search-submit" type="submit" value="Filter"  />
  
  </div>';
  echo $data;
  }
  
  function getStatusFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','stdStatus','stdStatus').'</div>';
  echo $data;
  //return $data;
  }
  
  //Function for student status list that has MAKE OVER-This function is called on book_scheduler_manage.php and class_details.php ////////////////NEWLY ADDED
  function getStatusFilter_with_makeover(){
  
  $data='<div id="time" style="position:relative">'.getList('','stdStatus','stdStatusmo-list').'</div>';
  echo $data;
  }
  
  function getlogscheduleFilter(){ /////////////NEWLY ADDED
  
  $data='<div id="time" style="position:relative">'.getList('','log_schedule','log_schedule').'</div>';
  echo $data;
  }

  //Function for DEPARTMENT for the EMP SALARY - DEPARTMENT FILTER  emp_payroll_lis.php ////////////////NEWLY ADDED
  function getDepartmentFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','department','department').'</div>';
  echo $data;
  }
  
  
  function getClassStatusFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','class_status','class_status','All',$_addEmpty='true').'</div>';
  echo $data;
  
  }
  
  //Function for ACTIVE/DEACTIVE dropdown list under user_list.php ////////////////NEWLY ADDED
  function getActiveDeactiveFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','status','status').'</div>';
  echo $data;
  }
  
  //Function for USERTYPE dropdown list under hr_user_list.php //NEWLY ADDED 25-01-17
  function getuserTypeFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','userType','userType').'</div>';
  echo $data;
  }
  
  
  function getClassStatus($_id,$_date=""){
  global $_LIST;

  $_row=getSchedule($_id);
  
  //echo prepareDate($_date);
  //echo $_LIST['systemdate'];
  //$pre_no_end_class=0;
  
  if(prepareDate($_date)!=$_LIST['systemdate']){ return "0"; }
  
   $sql = "select * from `campus_attendance_student` where `studentID` = '".$_row['studentID']."' and  `teacherID` ='".$_row['teacherID']."' and  `startTime` ='".$_row['startTime']."' and date='".$_LIST['systemdate']."' "; 
	
  $_result=mysql_query($sql) or die(mysql_error()); 
  if(!mysql_num_rows($_result)){
	  return '2';
  }else	{
			$_row=mysql_fetch_assoc($_result);
	  
	 
			return $_row['status'];
		}
  }
  
  function getClassId($_id,$_date=""){
  global $_LIST;
  $_row=getSchedule($_id);
  if(prepareDate($_date)!=$_LIST['systemdate']){ return "-1"; }
   $sql = "select * from `campus_attendance_student` where `studentID` = '".$_row['studentID']."' and  `teacherID` ='".$_row['teacherID']."' and  `startTime` ='".$_row['startTime']."' and date='".$_LIST['systemdate']."'"; 
  $_result=mysql_query($sql) or die(mysql_error()); 
  if(!mysql_num_rows($_result)){
	  return mysql_num_rows($_result);
  }else{
	  $_row=mysql_fetch_assoc($_result);
	  return $_row['id'];
	  
	  }
  }
  
  function getSchedule($_id){
  
  
 
  $result = mysql_query("SELECT * FROM `campus_schedule` where id=".$_id."") or trigger_error(mysql_error());
  
  $_row=mysql_fetch_array($result);
  return $_row;
  
  
  }
  
  function startClass($_id){
  //$_valid=getClassStatus($_id);
  $_row=getSchedule($_id);
  
  $timenow = time();
  //$newtime = $timenow+32400;
  $newtime = $timenow;
global $_LIST;
  $sql = "INSERT INTO `campus_attendance_student` ( `studentID` ,  `teacherID` , `courseID` , `classType` , `std_status` , `startTime` , `classStartTime` , `date` , status , `schedule_id` ) VALUES(  '".$_row['studentID']."' ,  '".$_row['teacherID']."' , '".$_row['courseID']."' , '".$_row['classType']."' , '".$_row['std_status']."' , '".$_row['startTime']."' ,  '".date('H:i:s' , $newtime)."' ,  '".$_LIST['systemdate']."' ,'-1' , '".$_row['id']."' ) "; 
  mysql_query($sql) or die(mysql_error()); 
  $_eid=mysql_insert_id();
  return $_eid;
  
  }
  
  //***** Manual absent from MANAGE SCHEDULE(book_scheduler_manage)	-	NEWLY ADDED*****//
    function startClass_manual_absent($_id){
  //$_valid=getClassStatus($_id);
  $_row=getSchedule($_id);
  
  $timenow = time();
  //$newtime = $timenow+32400;
  $newtime = $timenow;
global $_LIST;
$operator_name = showUser( nl2br( $_SESSION['userId']));
  $sql = "INSERT INTO `campus_attendance_student` ( `studentID` ,  `teacherID` , `courseID` , `classType` , `std_status` , `startTime` , `classStartTime` , `date` , status , `comments` , `lessonDetails` , `endTime` , `schedule_id` ) VALUES(  '".$_row['studentID']."' ,  '".$_row['teacherID']."' , '".$_row['courseID']."' , '".$_row['classType']."' , '".$_row['std_status']."' , '".$_row['startTime']."' ,  '".date('H:i:s' , $newtime)."' ,  '".$_LIST['systemdate']."' ,'0' , 'Teacher Absent:Done By - {$operator_name}', 'Teacher Absent' , '".date('H:i:s' , $newtime)."' , '".$_row['id']."' ) "; 
  mysql_query($sql) or die(mysql_error()); 
  $_eid=mysql_insert_id();
  return $_eid;
  
  }
  //***********************************************************************************//
  
  
  
  function getSkypeID($_id){
	  $result = mysql_query("SELECT campus_skype.skype FROM campus_skype INNER JOIN campus_students ON campus_students.skypeid = campus_skype.id
  WHERE campus_students.id=".$_id."") or trigger_error(mysql_error());
	  $_row=mysql_fetch_array($result);
	  if(mysql_num_rows($result))
	  {
		  return $_row['skype'];	
	  }
	  else
	  {
		  return '&nbsp;';
	  }
	  
  }
  
  //NEWLY ADDED , Now getting skype id from campus_skype	//28-01-2014
  function getSkypeID_of_manage_schedule($_id){
  if(empty($_id))
  {
	return "*";
  }
  if(!empty($_id))
  {
	  $result = mysql_query("SELECT * FROM campus_skype 
  WHERE campus_skype.id=".$_id."") or trigger_error(mysql_error());
	  $_row=mysql_fetch_array($result);
	  if(mysql_num_rows($result))
	  {
		  return $_row['skype'];	
	  }
	  else
	  {
		  return '&nbsp;';
	  }
	  
  }
  }
  
    function getextID($_id){
	//echo "SELECT campus_voice_ext.extId FROM campus_voice_ext INNER JOIN campus_students ON campus_students.extId = campus_voice_ext.id 
  //WHERE campus_students.id=".$_id."";
	  $result = mysql_query("SELECT campus_voice_ext.extId FROM campus_voice_ext INNER JOIN campus_students ON campus_students.extId = campus_voice_ext.id 
  WHERE campus_students.id=".$_id."") or trigger_error(mysql_error());
	  $_row=mysql_fetch_array($result);
	  if(mysql_num_rows($result))
	  {
		  return $_row['extId'];	
	  }
	  else
	  {
		  return '&nbsp;';
	  }
	  
  }
  
  function getClassTypeSchedule($_plan){
	  $_classType='';
	  if ($_plan=='1') {
	  
	  $_classType=" classType in ('".$_plan."','3','4','6','7','5')";
  } else if ($_plan=='2') {
	  
	  $_classType=" classType in ('".$_plan."','3','4','10','8','9')";
  
  }else if ($_plan=='3') {
	  
	  $_classType=" classType in ('".$_plan."','1','2','4','5','6','7','8','9')";
  }
  else if ($_plan=='4') {
	  
	  $_classType=" classType in ('".$_plan."','1','2','3','5','6','7','10','8','9')";
  }
  else if ($_plan=='5') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  }
  else if ($_plan=='6') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  } if ($_plan=='7') {
	  
	  $_classType=" classType in ('".$_plan."','1','3','4')";
  }else if ($_plan=='8') {
	 
	  $_classType=" classType in ('".$_plan."','2','3','4')";
  }else if ($_plan=='9') {
	 
	  $_classType=" classType in ('".$_plan."','2','3','4')";
  }
  else if ($_plan=='10') {
	  
	  $_classType=" classType in ('".$_plan."','2','4')";
  }
    else if ($_plan=='11') {
	  
	  $_classType=" classType in ('".$_plan."')";
  }
  return $_classType;
	  }
  
  
	  
  function getCondition($_plan){
	  $_condition='';
	  
  if ($_plan=='1') {
	  $_condition="mon='1' and tue='1' and wed='1'";
	  
  } else if ($_plan=='2') {
	  $_condition="thu='1' and fri='1' and sat='1'";
	  
  
  }else if ($_plan=='3') {
	  $_condition="mon='1' and tue='1' and wed='1' and thu='1' and fri='1'";
	  
  }
  else if ($_plan=='4') {
	  $_condition="mon='1' and tue='1' and wed='1' and thu='1' and fri='1' and sat='1'";
	  
  }
  else if ($_plan=='5') {
	  $_condition="mon='1'";
	  
  }
  else if ($_plan=='6') {
	  $_condition="tue='1'";
	  
  }else if ($_plan=='7') {
	  $_condition="wed='1'";
	  
  }else if ($_plan=='8') {
	  $_condition="thu='1'";
	  
  }
  else if ($_plan=='9') {
	  $_condition="fri='1'";
	  
  }else if ($_plan=='10') {
	  $_condition="sat='1'";
	  
  }
  else if ($_plan=='11') {
	  $_condition="sun='1'";
	  
  }
  return $_condition;
	  }
  /*function getCondition90($_plan){
  $_condition="";
	  if ($_plan=='1') {
	  $_condition="";
	  
  } else if ($_plan=='2') {
	  $_condition="";
	  
  }else if ($_plan=='3') {
	  $_condition="thu='1' and fri='1' and sat='0'";
	  
  }
  else if ($_plan=='4') {
	  $_condition="";
	  
  }
  else if ($_plan=='5') {
	  $_condition="";
	  
  }
  else if ($_plan=='6') {
	  $_condition="";
	  
  }else if ($_plan=='7') {
	  $_condition="thu='1' and sat='0'";
	  
  }else if ($_plan=='8') {
	  $_condition="fri='1' and sat='0'";
	  
  }
  else if ($_plan=='9') {
	  $_condition="";
	  
  }
  return $_condition;}*/
	  
	  
  function checkSchedule($_post,$edit_id=""){
  //print_r($_post);
   $sql="SELECT campus_schedule.id,campus_schedule.startTime FROM campus_schedule WHERE campus_schedule.teacherID = '".$_post['teacherID']."' AND ".getClassTypeSchedule($_post['classType'])." AND campus_schedule.startTime = '".$_post['startTime']."' and std_status!=3 and std_status!=4 and std_status!=7 and   id!='".$_post['scheduleEdit']."'";
  //echo $sql;
  $_result=mysql_query($sql) or die(mysql_error());
  if(mysql_num_rows($_result)>0){
  $row=mysql_fetch_assoc($_result);
  
  if(!empty($edit_id) && $edit_id!=$row['id']){
	  return false;
	  }
	  else{
		  return true;
		  }
  }
  return !mysql_num_rows($_result);
  
  }
  
  function getShift($shift='',$type=''){
	  
	  $sql="SELECT capmus_users.id FROM capmus_users WHERE capmus_users.empShift = $shift AND capmus_users.user_type = $type";
  
	  $_result=mysql_query($sql) or die(mysql_error());
	  $dataarray=array();
	  while($_row=mysql_fetch_assoc($_result))
	  {
		  $dataarray[]="'".$_row['id']."'";
	  
	  }
	  
	  $data=implode(',',$dataarray);
		  
	  return "(".$data.")";
   
	  }
  
  function makeTime($time,$duration){
	  global $_LIST;
	  
	  $key=array_keys($_LIST['time'],$time);
	  if($key[0]+$duration<count($_LIST['time'])){
		  return $_LIST['time'][$key[0]+$duration];
		  }
	  else{
		  return $_LIST['time'][($key[0]+$duration+1)-count($_LIST['time'])];
		  }
	  
	  }
	  
	  function makeSlot($id){
	  global $_LIST;
	  $data=getSchedule($id);
	  
	  $slot=getTimeDiff($data['startTime'],$data['endTime']);
	  switch($slot)
	  {
		  case '00:30:00':
		  	{ return '1'; break;}
		  case '01:00:00':
		  	{ return '2'; break;}
		  case '01:30:00':
		  	{ return '3'; break;}}
			return false;
	  }
	  
function getTimeDiff($dtime,$atime){
 
 $nextDay=$dtime>$atime?1:0;
 $dep=explode(':',$dtime);
 $arr=explode(':',$atime);
 $diff=abs(mktime($dep[0],$dep[1],0,date('n'),date('j'),date('y'))-mktime($arr[0],$arr[1],0,date('n'),date('j')+$nextDay,date('y')));
 $hours=floor($diff/(60*60));
 $mins=floor(($diff-($hours*60*60))/(60));
 $secs=floor(($diff-(($hours*60*60)+($mins*60))));
 if(strlen($hours)<2){$hours="0".$hours;}
 if(strlen($mins)<2){$mins="0".$mins;}
 if(strlen($secs)<2){$secs="0".$secs;}
 return $hours.':'.$mins.':'.$secs;
}
 
 
   function systemDate(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-8*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }

  function systemDateTime(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-8*60*60;

  return date("Y-m-d H:i:s",$timeAfterOneHour);
  //return date("Y-m-d",$timeAfterOneHour);
  
  }

	  
function getScheduleList($id,$name="courseID"){
 
 $sql="Select * from campus_schedule where studentID=$id";
  $result=mysql_query($sql);
  $return="<select name='$name'>";
  $return.="<option value=''>Select Course</option>";
  if(mysql_num_rows($result)>0)
  while($rows=mysql_fetch_assoc($result)){
  
  $return.="<option value='".$rows['id']."'";
  
  if($value==$rows['id']){ $return.= "selected='selected'"; }
  
  $return.=">".getData(stripslashes($rows['courseID']),'course')."</option>";
  
  }
  $return.="</select>";
  return $return;
}

//////////////////////////////////////////////////////////////////USER LOG/////////////////////////////////////////////////////////////////////// NEWLY ADDED
function user_log($page, $action, $preval, $newval, $comments_dead)
{
	if(!empty($_SESSION['userId']) && !empty($_SESSION['userType']) && $action!="EDIT_STUDENT" && $action!="MAKEOVER_AUTO_DEAD")
	{
		$sql_insert_user_log=("INSERT INTO campus_user_log VALUES('','".$_SESSION['userId']."','".$_SESSION['userType']."',NOW(),'$page','$action','$preval','$newval','$comments_dead')");
		$result_user_log=mysql_query($sql_insert_user_log) or die(mysql_error());
		//echo "<script>alert('Data Entered in user_log')</script>";
		//echo "Successful";
	}
	else if(!empty($_SESSION['userId']) && !empty($_SESSION['userType']) && $action="EDIT_STUDENT" && $action!="MAKEOVER_AUTO_DEAD")
	{
		$sql_insert_user_log=("INSERT INTO campus_user_log VALUES('','".$_SESSION['userId']."','".$_SESSION['userType']."',NOW(),'$page','EDIT_STUDENT','$preval','$newval','$comments_dead')");
		$result_user_log=mysql_query($sql_insert_user_log) or die(mysql_error());
		//echo "<script>alert('Data Entered in user_log, Becareful with manual editing')</script>";
		//echo "Successful";
	}
	
	else if(!empty($_SESSION['userId']) && !empty($_SESSION['userType']) && $action="MAKEOVER_AUTO_DEAD" && $action!="EDIT_STUDENT")
	{
		$sql_insert_user_log=("INSERT INTO campus_user_log VALUES('','".$_SESSION['userId']."','".$_SESSION['userType']."',NOW(),'$page','$action','$preval','$newval','$comments_dead')");
		$result_user_log=mysql_query($sql_insert_user_log) or die(mysql_error());
		echo "THIS IS MAKEOVER AUTO DEAD AFTER 4 DAYS";
		//echo "<script>alert('Data Entered in user_log, Becareful with manual editing')</script>";
		//echo "Successful";
	}
	
	else 
	{
		//echo "<script>alert('BUGGY')</script>";
		//echo "unsuccessful";
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////GETTING TEAM LEAD for daily scheduler VER2///////////////////////////////////////////////////////////// NEWLY ADDED
function getTeam($_id)
{
	echo $sql="SELECT * FROM capmus_users WHERE LeadId='$_id' ";
	$result=mysql_query($sql);
	$id=array();
	while($row=mysql_fetch_array($result))
	{
		$id[]=$row['id'];
		
	}
	//echo implode("','",$id);
	return implode("','",$id);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////GETTING TEAM LEAD ID for teamlead_teacher_report_count.php///////////////////////////////////////////////////////////// NEWLY ADDED
function getTeamLeadID()
{
	echo $sql="SELECT * FROM capmus_users WHERE user_type=8 ";
	$result=mysql_query($sql);
	$id=array();
	while($row=mysql_fetch_array($result))
	{
		$id[]=$row['id'];
		
	}
	//echo implode("','",$id);
	return implode("','",$id);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function user_login($user_id, $user_type, $loginTime, $logoutTime)
{
	if(!empty($_SESSION['userId']) && !empty($_SESSION['userType']))
	{
		$sql_insert_user_login=("INSERT INTO campus_user_loginlogout VALUES('','".$_SESSION['userId']."','".$_SESSION['userType']."',NOW(),'')");
		$result_login=mysql_query($sql_insert_user_login) or die(mysql_error());
		echo "<script>alert('Login time noted')</script>";
	}
	else
	{
		echo "<script>alert('Login time ERROR')</script>";
	}
}

function user_logout($user_id, $user_type, $loginTime, $logoutTime)
{
	if(!empty($_SESSION['userId']) && !empty($_SESSION['userType']))
	{
		$sql_insert_user_logout=("UPDATE campus_user_loginlogout SET logoutTime=NOW() where user_id='".$_SESSION['userId']."' ");
		$result_logout=mysql_query($sql_insert_user_logout) or die(mysql_error());
		echo "<script>alert('Logout time noted')</script>";
	}
	else
	{
		echo "<script>alert('Logout time ERROR')</script>";
	}
}
// COMMENTED FUNCTION - MIGHT USER LATER
/*function leave_CheckCasual($MONTH_START_DATE,$MONTH_END_DATE)
{
	$sql="SELECT * FROM campus_empleave WHERE LeaveType=2 AND LeaveApplied>='".$MONTH_START_DATE."' 
	AND LeaveApplied<='".$MONTH_END_DATE."' ";
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;	
}*/

function leave_CheckCasual($MONTH_START_DATE,$MONTH_END_DATE)
{
	$sql="SELECT * FROM campus_empleave WHERE EmpID = '".$_SESSION['userId']."' AND 
	LeaveType=2 AND LeaveApplied>='".$MONTH_START_DATE."' AND LeaveApplied<='".$MONTH_END_DATE."' ";
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;	
}

function leave_CheckSick($JANUARY,$DECEMBER)
{
	$sql="SELECT  EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , 
	SUM(NoOfDays) as NoOfDaysTotal , LeaveApplied 
	FROM campus_empleave WHERE EmpID = '".$_SESSION['userId']."' AND LeaveType=1 AND 
	LeaveApplied>='".$JANUARY."' AND LeaveApplied<='".$DECEMBER."'  ";
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;	
}



function leave_CheckCasual_teamlead_version($MONTH_START_DATE,$MONTH_END_DATE,$teacherID)
{
	$sql="SELECT * FROM campus_empleave WHERE EmpID = '".$teacherID."' AND 
	LeaveType=2 AND LeaveApplied>='".$MONTH_START_DATE."' AND LeaveApplied<='".$MONTH_END_DATE."' ";
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;	
}

function leave_CheckSick_teamlead_version($JANUARY,$DECEMBER,$teacherID)
{
	$sql="SELECT  EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , 
	SUM(NoOfDays) as NoOfDaysTotal , LeaveApplied 
	FROM campus_empleave WHERE EmpID = '".$teacherID."' AND LeaveType=1 AND 
	LeaveApplied>='".$JANUARY."' AND LeaveApplied<='".$DECEMBER."'  ";
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;	
}







////////////////////////////// NEWLY ADDED -FOR book_scheduler_edit_TL_confirmation.php for Teacher TeamLeads own members

function getResultResource_teamlead_teacher_edit_confirm()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm   
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=1";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////NEWLY ADDED -FOR book_scheduler_edit_TL_confirmation.php for MAIN Teacher TeamLeads own members

function getResultResource_teamlead_teacher_main_edit_confirm()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm    
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=1";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////////// NEWLY ADDED -FOR book_scheduler_edit_TL_confirmation.php
//for SUPERADMIN ALL FILTERING FUNCTIONS/DROPDOWNS

function getResultResource_superadmin_edit_confirm()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,campus_schedule.teacherID_old 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and 
	campus_schedule.std_status!=3 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.edit_sch_TL_confirm=1";
	/*"SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm 
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.std_status!=3 and 
	campus_schedule.edit_sch_TL_confirm=1";*/
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	if(isset($_POST['start_range']) && !empty($_POST['start_range']) && isset($_POST['end_range']) && !empty($_POST['end_range']))
	{
		$sql.= " and campus_schedule.dues BETWEEN ".$_POST['start_range']." AND ".$_POST['end_range']."";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////NEWLY ADDED - getResultResource , FOR students_list.php for AGENT TeamLeads own members

function getResultResource_teamlead_agent_list_students()
{
global $_LIST,$_return;

	$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_students.id,campus_students.reg_id,campus_students.agent_id,campus_students.countryID,
	campus_students.firstName,campus_students.lastName,campus_students.email,campus_students.phone,
	campus_students.mobile,campus_students.landline,campus_students.std_status   
	FROM capmus_users 
	INNER JOIN campus_students  ";
	if($_SESSION['userType']==9)
	{
		$sql.=" ON capmus_users.LeadId='".$_SESSION['userId']."' ";
	}
	if($_SESSION['userType']==16)
	{
		$sql.=" ON capmus_users.main_LeadId='".$_SESSION['userId']."' ";
	}
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_students.id = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_students.agent_id = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_students.std_status = ".$_POST['stdStatus'];
	}
	
	$sql.=" and capmus_users.id=campus_students.agent_id  ";
	/*if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; */
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////For class_details_classes_count.php/////////////////////	//NEWLY ADDED //15-08-2015 
 function count_present_absent_classes($student_id,$fromDate_NEW,$toDate_NEW)
 {
	//COUNT QUERY
	if($student_id!=0 /*&& $_SESSION['userType']==1*/)
	{
	
	$result_count="SELECT 
		campus_attendance_student.id,campus_attendance_student.schedule_id,count(campus_attendance_student.studentID) as sa_stu_id,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath 
		FROM campus_attendance_student WHERE 
		campus_attendance_student.studentID='".$student_id."' ";
		if($fromDate_NEW!="" && $toDate_NEW!="")
		{
			$result_count.=" and campus_attendance_student.date>= '".prepareDate($fromDate_NEW)."' and campus_attendance_student.date<= '".prepareDate($toDate_NEW)."' GROUP BY campus_attendance_student.status ";
		}
		//$sql.="  GROUP BY campus_attendance_student.status ORDER BY campus_attendance_student.status";
		//echo $result_count;
		$result_count = mysql_query($result_count);
		while($row_count = mysql_fetch_array($result_count))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['status']),'class_status') . " : " . $row_count['sa_stu_id']."</b>&nbsp;&nbsp;&nbsp;";
		}
	
	}
 }
 
 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*****XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 /////////For class_details_classes_count_days_cal.php/////////////// TEACHER WISE	//NEWLY ADDED //04-12-2015 
 // NOw using following function under class_details_classes_count_days_cal.php as a query
 // FOR now, Following function obsolete XXXXX
 function count_present_absent_classes_teacher_AND_student_wise($teacher_id,$student_id,$fromDate_NEW,$toDate_NEW)
 {
	//REALLY USEFUL stackoverflow link for multiple GROUP BY[GROUPING BY] columns
	//http://stackoverflow.com/questions/8544214/fetch-teacher-and-subject-wise-details-in-mysql-and-php
	//COUNT QUERY
	if($teacher_id!=0 /*&& $_SESSION['userType']==1*/)
	{
	$result_count="SELECT 
		campus_attendance_student.id,campus_attendance_student.schedule_id,count(campus_attendance_student.status) as sa_status,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath,campus_attendance_student.studentID  
		FROM campus_attendance_student WHERE campus_attendance_student.status=1  and  
		campus_attendance_student.teacherID='".$teacher_id."' ";
		if(isset($_POST['submit']) && $student_id!=0)
		{
			$result_count.=" and campus_attendance_student.studentID='".$student_id."' ";
		}
		if($fromDate_NEW!="" && $toDate_NEW!="")
		{
			$result_count.=" and campus_attendance_student.date>= '".prepareDate($fromDate_NEW)."' and campus_attendance_student.date<= '".prepareDate($toDate_NEW)."' ";
		}
		$result_count.="GROUP BY campus_attendance_student.teacherID,campus_attendance_student.studentID,campus_attendance_student.status";
		echo $result_count;
		$result_count = mysql_query($result_count);
		while($row_count = mysql_fetch_array($result_count))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['status']),'class_status') . " : " . $row_count['sa_status']." : ". showUser(nl2br( $row_count['teacherID'])) ." : ".showStudents(nl2br( $row_count['studentID']))."</b>&nbsp;&nbsp;&nbsp;";
		}
	
	}
 }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function getResultResource_campus_meetinglink()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.status,
	campus_meeting_link.id,campus_meeting_link.linkID,campus_meeting_link.teacherID 
	FROM capmus_users 
	INNER JOIN campus_meeting_link 
	ON capmus_users.id=campus_meeting_link.teacherID and capmus_users.status=1";
	if($_SESSION['userType']==8)
	{
		$sql.=" and capmus_users.LeadId='".$_SESSION['userId']."' ";
	}
	if($_SESSION['userType']==15)
	{
		$sql.=" and capmus_users.main_LeadId='".$_SESSION['userId']."' ";
	}
	//$sql.=" ORDER BY campus_timing.teacherID";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////		//NEWLY ADDED 07-12-16
// USE FOLLOWING LATER ------------- Currently not in use
function getResultResource_campus_parent()
{
global $_LIST,$_return;

$sql="SELECT campus_students.id as stu_id,campus_students.firstName,campus_students.lastName,
	campus_students.parentId,campus_students.status,
	campus_parent.id,campus_parent.firstName as parent_Fname,campus_parent.lastName as parent_Lname,
	campus_parent.timeZoneArea,
	campus_parent.timeDifference 
	FROM campus_students 
	INNER JOIN campus_parent  
	ON campus_parent.id=campus_students.parentId";
	
	//$sql.=" ORDER BY campus_timing.teacherID";
	echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

////////////////////////////////////////////////////////

///////////////////////////////////////////////////////		//NEWLY ADDED 08-12-16
function getResultResource_superadmin_PARENT()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,campus_students.lastName,
	campus_students.parentId    	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.std_status!=3 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0 and 
	campus_students.id=campus_schedule.studentID ";
	if(isset($_POST['search-parent-id']) && !empty($_POST['search-parent-id']))
	{
		$sql.= " and campus_students.parentId = ".$_POST['search-parent-id'];
	}
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	if(isset($_POST['start_range']) && !empty($_POST['start_range']) && isset($_POST['end_range']) && !empty($_POST['end_range']))
	{
		$sql.= " and campus_schedule.dues BETWEEN ".$_POST['start_range']." AND ".$_POST['end_range']."";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

////////////////////////////////////////////////////////

/////// NEWLY ADDED -  FOR book_scheduler_manage_PARENT.php for MAIN Teacher TeamLeads own members

function getResultResource_teamlead_teacher_main_PARENT()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,campus_students.lastName,
	campus_students.parentId    	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.std_status!=3 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0 and 
	campus_students.id=campus_schedule.studentID ";
	if(isset($_POST['search-parent-id']) && !empty($_POST['search-parent-id']))
	{
		$sql.= " and campus_students.parentId = ".$_POST['search-parent-id'];
	}
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	if(isset($_POST['search-agent-id']) && !empty($_POST['search-agent-id']))
	{
		$sql.= " and campus_schedule.agentId = ".$_POST['search-agent-id'];
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
	}	
	if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
	{
		$sql.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
	}
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$sql.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and campus_schedule.teacherID in ".getShift($_POST['shift'],'3')." ";
	}
	if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and campus_schedule.courseID= '".$_POST['course']."'";
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function getResultResource_teamlead_teacher_emailStudent()
{
global $_LIST,$_return;

$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,campus_schedule.dues_original,
	campus_schedule.grade,campus_schedule.syllabus,campus_schedule.emailStudent   
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.edit_sch_TL_confirm=0 and campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0";
	if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
	{
		$sql.= " and campus_schedule.studentID = ".$_POST['search-student-id'];
	}
	if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_schedule.teacherID = ".$_POST['search-teacher-id'];
	}
	$sql.=" ORDER BY campus_schedule.startTime";
	//echo $sql; 
  
$_return=mysql_query($sql) or trigger_error(mysql_error());
return $_return;

}








//-------------------------------------------------------------------------------------------
function send_invoice_usd($parentid)
	{
		$qrysql = "SELECT * from campus_parent WHERE campus_parent.Id = '".$parentid."'";
		$exe_sql = mysql_query($qrysql);
		$res_sql = mysql_fetch_array($exe_sql);
		if($res_sql['send_usd_invoice'] == '1'){
			$msg = 'Yes';
		}else{
			$msg = 'No';
		}
return $msg ; 		
	}
	
	
	//function Get User Currency.
function get_user_currency_from_SCH($schedule_id)
	{

		/*  $qrysql = "SELECT tbl_user.Id,tbl_user.countryId, tbl_country.country,tbl_country.currencyCode,tbl_user.dues,tbl_country.id FROM
tbl_user Inner Join tbl_country ON tbl_user.countryId = tbl_country.id WHERE tbl_user.Id = '".$parentid."'"; */
		$qrysql = "SELECT `currency_array` FROM `campus_schedule` WHERE `id` = '".$schedule_id."' AND std_status<>1 AND std_status<>3 AND std_status<>4";
 		$exe_sql = mysql_query($qrysql);
		$res_sql = mysql_fetch_array($exe_sql);
		$currency = getData(nl2br( $res_sql['currency_array']),'currency');
		return $currency;
	}
	
// Function getting the parentName . 
function getparentname($id){
	 $sql_user = mysql_query("SELECT * FROM campus_parent WHERE id = '".$id."'");                				
	 $res_user = mysql_fetch_array($sql_user);			
	 return $res_user['firstName']." ".$res_user['lastName'];			
 }
function get_customer_invoice_email_address($user_id){
//$sql_user = mysql_query("SELECT * FROM campus_students WHERE id = '".$user_id."'");   //get student email address             				

$sql_user = mysql_query("SELECT DISTINCT email 
FROM campus_students WHERE id = '".$user_id."'");   //get student email address             				


$res_user = mysql_fetch_array($sql_user);
return $res_user['email'];
}
//-------------------------------------------------------------------------------------------

  ?>
