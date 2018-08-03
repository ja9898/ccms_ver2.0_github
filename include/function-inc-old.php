<?php
  global $_LIST;
  $_LIST['gender']=array('Gender','Male','Female');
  $_LIST['paymentMode']=array('Payment Mode','Paypal','Westrn Union','Bank');
  $_LIST['status']=array('Select Status','Active','Deactive');
  $_LIST['stdStatus']=array('Student Status','Trial','Regular','Dead','Freez');
  $_LIST['skype_status']=array('Select Status','Assigned','Available','Free');
  $_LIST['class_status']=array('Absent','Present');
  $_LIST['department']=array('Department','Teaching','HR','IT','Sales','Accounts');
  $_LIST['designation']=array('Designation','TSR','Teacher','Team Lead','Manager','Teaching Assistant');
  $_LIST['country']=array('Select Country','USA','Canada','Pakistan','Australia','UK',"Afghanistan","Albania","Algeria","Andorra","Angola","Antigua & Deps","Argentina","Armenia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina","Burundi","Cambodia","Cameroon","Cape Verde","Central African Rep","Chad","Chile","China","Colombia","Comoros","Congo","Congo {Democratic Rep}","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland {Republic}","Israel","Italy","Ivory Coast","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea North","Korea South","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar, {Burma}","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russian Federation","Rwanda","St Kitts & Nevis","St Lucia","Saint Vincent & the Grenadines","Samoa","San Marino","Sao Tome & Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
  $_LIST['employeeType']=array('Select Employee Type','Trainee','Regular');
  $_LIST['shift']=array('Select Shift','Day','Night');
  $_LIST['plan']=array('Select Plan','Monday,Tuesday,Wednesday','Thursday,Friday,Saturday','Monday-Friday','Monday-Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $_LIST['planDays']=array('Select Plan','Monday,Tuesday,Wednesday','Thursday,Friday,Saturday','Monday,Tuesday,Wednesday,Thursday,Friday','Monday,Tuesday,Wednesday,Thursday,Friday,Saturday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  $_LIST['userType']=array('Select User Type','Super Admin','Admin','Teacher','Student','Agent','Accounts','Floor Assistant');
  
  $_LIST['zones']=array('Select Zone','Pacific','Mountain','Centeral','Eastern','UK','Western','Eastern[Aus]');
  
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
  
  $_LIST['course']=array('Select Course','MS Office','Graphics Designinig','Web Designing','Web Development-PHP','AutoCad','Bundle','Design and Development','Basic Networking','English','CCNA','Quran Pak','Web Development-.Net','Physics','Chemistry','Biology','Mathematics','Urdu','French','C++');
  $_LIST['courseDuration']=array('Select Course duration','+3','+3','+3','+3','+3','+8','+6','+1','+3', '+3','+36','+6','+12','+12','+12','+12','+12','+6','+3');
  
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
  
  
  function getList($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv='',$_addEmpty='false'){
  global $_LIST;
  return $return=buildOption($value,$id,$_LIST[$_list],$_label,$_function,$_resultDiv,$_addEmpty);
  }
  
  function getCheckboxList($value='',$id='',$_list='',$_label='',$_function='',$_resultDiv=''){
  global $_LIST;
  return $return=buildCheckboxOption($value,$id,$_LIST[$_list],$_label);
  }
  
  function getCheckbox($value='',$id=''){
  $return="<input type='checkbox' value='1' name='$id'";if($value){ $return.= "checked='checked'"; }$return.=" />";
  return $return;
  }
  
  function getInput($value='',$id='',$_class=''){
  $return="<input type='text' $_class value='$value' name='$id' id='$id' />";
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
  case 'edit':
				  {
					  if(!empty($page)){
					  $pageInfo="<br /><a href='$page' class=\"button\">Back To Listing</a>"; 
					  }
					  echo (mysql_affected_rows()) ? "<div class='message success'><p><strong>Edited row.</strong> Everything fine...</p></div><br />".$pageInfo : "<div class='message warning'><p><strong>Nothing changed. </strong></p></div><br />".$pageInfo; 
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
  case 'duplicate':
				  {
					  if(empty($_message))
						  {
							  $_message="Course already assigned to teacher.Try again.";
						  }
					  echo "<div class='message error'><p><strong>Duplication Error.</strong> ".$_message."</p></div><br />"; 
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
  $return=$rows['firstName'].'  '.$rows['lastName'];
  
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
  
  function changeSchedule($_id='',$status=''){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set std_status=$status where `id`=$_id";
  
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
  
  
  function checkDuplication($_course,$_teacher){
  
   $sql="select * from capmus_teacher_course where `teacherID`=$_teacher and `courseID`=$_course";
  
  $_result=mysql_query($sql) or die(mysql_error());
  
  return mysql_num_rows($_result);
  
  }
  
  
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
  
  if(isset($_post['search-teacher-id']) && !empty($_post['search-teacher-id']))
  {
		  if(!empty($_query)){
			  $_query.=" and  teacherID= ".$_post['search-teacher-id'];
		  }else{
			  $_query=" teacherID = ".$_post['search-teacher-id'];
			  }
  
		  
  }
  
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
  //if(!empty($_query)){$_query.=" and  std_status= '".$_post['stdStatus']."'";}else{$_query=" std_status= '".$_post['stdStatus']."'";}
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
		  
		  case "campus_schedule":
	  {
		  $query=str_replace('SELECT campus_schedule.*','SELECT count(campus_schedule.id) as count,std_status ',$_query);
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
		  echo "<br><b><div style='float:left'>Total : ".$data['sum']." &nbsp;&nbsp;&nbsp;Trial : ".$data['1']."&nbsp;&nbsp;&nbsp; Regular : ".$data['2']." &nbsp;&nbsp;&nbsp;Dead : ".$data['3']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br><br></b>";
		  break;
		  }
	  case "campus_students":
	  {
		  $query=str_replace('SELECT campus_students.*','SELECT count(campus_students.id) as count,std_status ',$_query);
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
  
  function getStudentFilter(){
  
  $data='<div id="student" style="position:relative"><input name="search-student" id="search-student" type="text" value="Select Student" onkeyup="javascript:autoStudent()" onfocus="javascript:clearAll(this)" onblur="javascript:resetStudent(this)"/>
  <input name="search-student-id" id="search-student-id" type="hidden" />
  <div id="studentResults"></div>
  </div>';
  echo $data;
  
  }
  function getTeacherFilter(){
  
  $data='<div id="teacher" style="position:relative">
  <input name="search-teacher" id="search-teacher" type="text" value="Select Teacher" onkeyup="javascript:autoTeacher()" onfocus="javascript:clearAll(this)" onblur="javascript:resetTeacher(this)"/>
  <input name="search-teacher-id" id="search-teacher-id" type="hidden" />
  <div id="teacherResults"></div>
  </div>';
  echo $data;
  
  }
  
  function getAgentFilter(){
  
  $data='<div id="agent" style="position:relative">
  <input name="search-agent" id="search-agent" type="text" value="Select Agent" onkeyup="javascript:autoAgent()" onfocus="javascript:clearAll(this)" onblur="javascript:resetAgent(this)"/>
  <input name="search-agent-id" id="search-agent-id" type="hidden" />
  <div id="agentResults"></div>
  </div>';
  echo $data;
  
  }
  
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
  function getClassStatusFilter(){
  
  $data='<div id="time" style="position:relative">'.getList('','class_status','class_status','All',$_addEmpty='true').'</div>';
  echo $data;
  
  }
  
  function getClassStatus($_id,$_date=""){
  
  $_row=getSchedule($_id);
  if(prepareDate($_date)!=date('Y-m-d')){ return "0"; }
   $sql = "select * from `campus_attendance_student` where `studentID` = '".$_row['studentID']."' and  `teacherID` ='".$_row['teacherID']."' and  `startTime` ='".$_row['startTime']."' and date='".date('Y-m-d')."'"; 
  $_result=mysql_query($sql) or die(mysql_error()); 
  if(!mysql_num_rows($_result)){
	  return '2';
  }else{
	  $_row=mysql_fetch_assoc($_result);
	  
	 
		  return $_row['status'];
	  
	  }
  }
  
  function getClassId($_id,$_date=""){
  
  $_row=getSchedule($_id);
  if(prepareDate($_date)!=date('Y-m-d')){ return "-1"; }
   $sql = "select * from `campus_attendance_student` where `studentID` = '".$_row['studentID']."' and  `teacherID` ='".$_row['teacherID']."' and  `startTime` ='".$_row['startTime']."' and date='".date('Y-m-d')."'"; 
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
  $newtime = $timenow+32400;
  
  $sql = "INSERT INTO `campus_attendance_student` ( `studentID` ,  `teacherID` ,  `startTime` ,  `classStartTime` ,  `date` ,status ) VALUES(  '".$_row['studentID']."' ,  '".$_row['teacherID']."' ,  '".$_row['startTime']."' ,  '".date('H:i:s' , $newtime)."' ,  '".date('Y-m-d')."' ,'-1' ) "; 
  mysql_query($sql) or die(mysql_error()); 
  $_eid=mysql_insert_id();
  return $_eid;
  
  }
  
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
   $sql="SELECT campus_schedule.id,campus_schedule.startTime FROM campus_schedule WHERE campus_schedule.teacherID = '".$_post['teacherID']."' AND ".getClassTypeSchedule($_post['classType'])." AND campus_schedule.startTime = '".$_post['startTime']."' and std_status!=3 and   id!='".$_post['scheduleEdit']."'";
  
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

  ?>
