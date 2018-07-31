<?php 
include('config.php'); 
include('include/header.php');

//echo "<td valign='top'><a class=button target='_blank' href=chat_panel.php?id=159>Chat with Junaid Abbas</a></td>";


//NOTE on index page
//echo "<label style='color:BLUE; font-weight:bold; font-size:16px; margin-bottom:5px;'>NOTE: Notice - Student Reference Offer-Valid till 31st Mar,15 (28-03-2015)</label>";

if($_SESSION['userType']!='3' && $_SESSION['userType']!='5' && $_SESSION['userType']!='6' && $_SESSION['userType']!='9' && $_SESSION['userType']!='11' && $_SESSION['userType']!='18' && $_SESSION['userType']!='4'){
?>
                        
                           
                                    
                                    <a class="dashboard_button button1" href="#">
                                        <span class="dashboard_button_heading">Dashboard</span>
                                        <span>Edit various basic settings and Options</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button2" href="#">
                                        <span class="dashboard_button_heading">Settings</span>
                                        <span>Edit various advanced settings and Options</span>
                                    </a><!--end dashboard_button-->
                                    
                                   
                                    
                                    <a class="dashboard_button button5" href="#">
                                        <span class="dashboard_button_heading">Search</span>
                                        <span>Basic and advanced search area</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button6" href="#">
                                        <span class="dashboard_button_heading">Trash</span>
                                        <span>Deleted items and database entries</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button7" href="#">
                                        <span class="dashboard_button_heading two_lines">Content Manager</span>
                                        <span>Add new static and dynamic content</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button8" href="#">
                                        <span class="dashboard_button_heading">Files</span>
                                        <span>File and download manager</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button9" href="#">
                                        <span class="dashboard_button_heading two_lines">Newsletter Manager</span>
                                        <span>Add and manage newsletter subscriptions</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button10" href="#">
                                        <span class="dashboard_button_heading two_lines">User Manager</span>
                                        <span>Add and edit user settings</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button11" href="#">
                                        <span class="dashboard_button_heading">Gallery</span>
                                        <span>Manage your image gallery</span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button12" href="#">
                                        <span class="dashboard_button_heading">Help</span>
                                        <span>Tutorial on how to use out scripts</span>
                                    </a><!--end dashboard_button-->
									
									   

                                    <!--notice documents -->
                                    <!--Student Reference, 28-03-2015 -->
                                    <!--<a id="" class="dashboard_button_blink button15 myDiv" href="notice_student_reference.php">
                                        <span class="dashboard_button_heading_blink">NOTICE</span>
                                        <span style="color:red"><b>Student Reference Offer</b>  - (28-03-2015)</span>
                                    </a><!--end dashboard_button-->

									
									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										$msg_endDate = nl2br( $row_hr_message['endDate']) ;
										$systemdate = systemDate();
										
										//Checking whether system date is equal to endDate of the HR MESSAGE
										if($systemdate==$msg_endDate)
										{
											$sql_auto_deactive = "UPDATE `campus_hr_messages` SET `active_deactive` =  0 , `endDate` =  '0000-00-00'   WHERE `id` = '$msg_id' "; 
											mysql_query($sql_auto_deactive) or die(mysql_error()); 
										}
										
										if($row['active_deactive']==1 && $systemdate!=$msg_endDate)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
									
									
									
                                    
                                    <h2>Today's Payment dues</h2>
                                    <div class="content-box box-grey">
                                    <?php 
										
										$systemdate = systemDate();
										$systemdatetime = systemDateTime();
										$timenow = time();
										$current_date_time=date('Y-m-d H:i:s');
										//echo date('d', strtotime( nl2br($systemdate)));
										//echo "<div><strong>Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
										echo "<div><strong>Payment dues today : ".$systemdate."(YYYY-MM-DD)</strong></div>";
										echo "<div><strong>Sys date time : ".$systemdatetime."(HH-MM-SS)</strong></div>";
										echo "<div><strong>Time now : ".$timenow ."(Time)</strong></div>";
										echo "<div><strong>Date/time now : ".$current_date_time ."(Time)</strong></div>";
										echo "<div><strong>Date/time now : ".date('H:i:s')."(Time)</strong></div>";
										echo "<div><strong>Date/time now : ".$todayDate = date("Y-m-d g:i a")."(Time)</strong></div>";
										echo "<div><strong>Date/time now : ".$sql="NOW()" ." (Time)</strong></div>";
										
										
										

										
										echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
											echo "<tr>"; 
											//echo "<th class='specalt'>Date</th>";
											echo "<th class='specalt'>TL Name</th>"; 
											echo "<th class='specalt'>Name</th>"; 
											echo "<th class='specalt'>Amount</th>"; 
											echo "<th class='specalt'><b>Actions</b></th>"; 
											echo "</tr>"; 
											if($_SESSION['userType']==8)
											{
												$query_cam_sch = "SELECT capmus_users.id as users_id,capmus_users.LeadId,
												campus_schedule.id,
												campus_schedule.duedate,
												campus_schedule.paydate,
												day(campus_schedule.duedate) AS dddayz,
												month(campus_schedule.duedate) AS ddmonth,
												year(campus_schedule.duedate) AS ddyear,
												day(campus_schedule.paydate) AS pddayz,
												month(campus_schedule.paydate) AS pdmonth,
												year(campus_schedule.paydate) AS pdyear,
												campus_schedule.dues as amount,
												campus_schedule.studentID,
												campus_schedule.courseID,
												campus_schedule.teacherID,
												campus_schedule.status 
												FROM capmus_users 
												INNER JOIN campus_schedule 
												ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.`status` =1 and std_status!=4 and std_status!=3 and std_status!=1 and day(campus_schedule.paydate)=".date('d', strtotime( nl2br($systemdate)))." ";
												
												//$result_query_cam_sch = mysql_query($query_cam_sch) or trigger_error(mysql_error()); //or trigger_error(mysql_error()); 
												if(mysql_num_rows($result_query_cam_sch))
												{
													while($rows1 = mysql_fetch_array($result_query_cam_sch))
													{
													//foreach($rows1 AS $key => $value) { $rows1[$key] = stripslashes($value); } 
													$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec FROM campus_transaction where studentID=".$rows1['studentID']." ";
													//$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec,
														//				day(campus_transaction.dateRecieved) AS drday,
															//			month(campus_transaction.dateRecieved) AS drmonth,
																//		year(campus_transaction.dateRecieved) AS dryear FROM campus_transaction where studentID=".$rows1['studentID']." ";
													
													$rows2=mysql_query($query_cam_tran) or trigger_error(mysql_error());
													$rows2=mysql_fetch_array($rows2);
													//PAYMENT PROBLEM
	//////////////////////////////////
	$td=date("Y-m-d")."<br>";
	$tdd=date("d");//echo " todays date month<br>";
	$tdm=date("m");//echo " todays date month<br>";
	$tdd=intval($tdd);//echo " todays date month-int<br>";
	$tdm=intval($tdm);//echo " todays date month-int<br>";

	//echo "<br><br>";
	//////////////////////////////////

														$mon_pay_left = paymentdue($tdd,$tdm,nl2br($rows1['pddayz']),nl2br($rows1['pdmonth']),nl2br($rows1['pdyear']),date('d', strtotime( nl2br($rows2['maxdate_rec']))),date('m', strtotime( nl2br($rows2['maxdate_rec']))),date('Y', strtotime( nl2br($rows2['maxdate_rec']))));
														if($mon_pay_left>=1)
														{
															//echo "<div><strong>Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															//echo "<td valign='top'>";

															//echo "</td>";  
															//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>"; 
															echo "<td valign='top'>" . showUser( nl2br( $rows1['LeadId'])) . "</td>";
															echo "<td valign='top'>" . showStudents(nl2br( $rows1['studentID'])) . "</td>";
															echo "<td valign='top'>" . nl2br( $rows1['amount']) . "</td>";  
															echo "<td ><a class=button href=class_details.php?id={$rows1['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$rows1['studentID']}>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>"; 
														}
														else
														{
															/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															echo "<td valign='top'>Empty</td>";
															echo "<td valign='top'>Empty</td>";  
															echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>";*/
														}
													//echo "</table>";
													}
													echo "</table>";
												
												}
												else
												{
													/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
													echo "<tr>";  
													//echo "<td valign='top'>";

													//echo "</td>";  
													//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>";  
													echo "<td valign='top'>Empty</td>";
													echo "<td valign='top'>Empty</td>";  
													echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
													echo "</tr>"; */
												} 
													echo "</table>";
											}
											else if($_SESSION['userType']==15)
											{
												$query_cam_sch = "SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
												campus_schedule.id,
												campus_schedule.duedate,
												campus_schedule.paydate,
												day(campus_schedule.duedate) AS dddayz,
												month(campus_schedule.duedate) AS ddmonth,
												year(campus_schedule.duedate) AS ddyear,
												day(campus_schedule.paydate) AS pddayz,
												month(campus_schedule.paydate) AS pdmonth,
												year(campus_schedule.paydate) AS pdyear,
												campus_schedule.dues as amount,
												campus_schedule.studentID,
												campus_schedule.courseID,
												campus_schedule.teacherID,
												campus_schedule.status 
												FROM capmus_users 
												INNER JOIN campus_schedule 
												ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.`status` =1 and std_status!=4 and std_status!=3 and std_status!=1 and day(campus_schedule.paydate)=".date('d', strtotime( nl2br($systemdate)))." ";
												
												//$result_query_cam_sch = mysql_query($query_cam_sch) or trigger_error(mysql_error()); //or trigger_error(mysql_error()); 
												if(mysql_num_rows($result_query_cam_sch))
												{
													while($rows1 = mysql_fetch_array($result_query_cam_sch))
													{
													//foreach($rows1 AS $key => $value) { $rows1[$key] = stripslashes($value); } 
													$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec FROM campus_transaction where studentID=".$rows1['studentID']." ";
													//$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec,
														//				day(campus_transaction.dateRecieved) AS drday,
															//			month(campus_transaction.dateRecieved) AS drmonth,
																//		year(campus_transaction.dateRecieved) AS dryear FROM campus_transaction where studentID=".$rows1['studentID']." ";
													
													$rows2=mysql_query($query_cam_tran) or trigger_error(mysql_error());
													$rows2=mysql_fetch_array($rows2);
													//PAYMENT PROBLEM
	//////////////////////////////////
	$td=date("Y-m-d")."<br>";
	$tdd=date("d");//echo " todays date month<br>";
	$tdm=date("m");//echo " todays date month<br>";
	$tdd=intval($tdd);//echo " todays date month-int<br>";
	$tdm=intval($tdm);//echo " todays date month-int<br>";

	//echo "<br><br>";
	//////////////////////////////////

														$mon_pay_left = paymentdue($tdd,$tdm,nl2br($rows1['pddayz']),nl2br($rows1['pdmonth']),nl2br($rows1['pdyear']),date('d', strtotime( nl2br($rows2['maxdate_rec']))),date('m', strtotime( nl2br($rows2['maxdate_rec']))),date('Y', strtotime( nl2br($rows2['maxdate_rec']))));
														if($mon_pay_left>=1)
														{
															//echo "<div><strong>Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															//echo "<td valign='top'>";

															//echo "</td>";  
															//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>"; 
															echo "<td valign='top'>" . showUser( nl2br( $rows1['LeadId'])) . "</td>";
															echo "<td valign='top'>" . showStudents(nl2br( $rows1['studentID'])) . "</td>";
															echo "<td valign='top'>" . nl2br( $rows1['amount']) . "</td>";  
															echo "<td ><a class=button href=class_details.php?id={$rows1['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$rows1['studentID']}>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>"; 
														}
														else
														{
															/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															echo "<td valign='top'>Empty</td>";
															echo "<td valign='top'>Empty</td>";  
															echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>";*/
														}
													//echo "</table>";
													}
													echo "</table>";
												
												}
												else
												{
													/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
													echo "<tr>";  
													//echo "<td valign='top'>";

													//echo "</td>";  
													//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>";  
													echo "<td valign='top'>Empty</td>";
													echo "<td valign='top'>Empty</td>";  
													echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
													echo "</tr>"; */
												} 
													echo "</table>";
											}
											else
											{
												//In Following query , condition was on DUEDATE, Now it is on PAYDATE(05-07-2013)
												$query_cam_sch=" SELECT capmus_users.id as users_id,
																capmus_users.LeadId,
																campus_schedule.id,
																day(campus_schedule.duedate) AS dddayz,
																month(campus_schedule.duedate) AS ddmonth,
																year(campus_schedule.duedate) AS ddyear,
																day(campus_schedule.paydate) AS pddayz,
																month(campus_schedule.paydate) AS pdmonth,
																year(campus_schedule.paydate) AS pdyear,
																campus_schedule.dues as amount,
																campus_schedule.studentID,
																campus_schedule.courseID,
																campus_schedule.teacherID,
																

																campus_schedule.`status`
																FROM 
																campus_schedule 
																INNER JOIN 
																capmus_users ON
																capmus_users.id=campus_schedule.teacherID and 
																campus_schedule.`status` =1 and std_status!=4 and std_status!=3 and std_status!=1 and day(campus_schedule.paydate)=".date('d', strtotime( nl2br($systemdate)))." ";
												//$result_query_cam_sch = mysql_query($query_cam_sch) or trigger_error(mysql_error()); //or trigger_error(mysql_error()); 
												if(mysql_num_rows($result_query_cam_sch))
												{
													while($rows1 = mysql_fetch_array($result_query_cam_sch))
													{
													//foreach($rows1 AS $key => $value) { $rows1[$key] = stripslashes($value); } 
													$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec FROM campus_transaction where studentID=".$rows1['studentID']." ";
													//$query_cam_tran="SELECT MAX(dateRecieved) as maxdate_rec,
														//				day(campus_transaction.dateRecieved) AS drday,
															//			month(campus_transaction.dateRecieved) AS drmonth,
																//		year(campus_transaction.dateRecieved) AS dryear FROM campus_transaction where studentID=".$rows1['studentID']." ";
													
													$rows2=mysql_query($query_cam_tran) or trigger_error(mysql_error());
													$rows2=mysql_fetch_array($rows2);
													//PAYMENT PROBLEM
	//////////////////////////////////
	$td=date("Y-m-d")."<br>";
	$tdd=date("d");//echo " todays date month<br>";
	$tdm=date("m");//echo " todays date month<br>";
	$tdd=intval($tdd);//echo " todays date month-int<br>";
	$tdm=intval($tdm);//echo " todays date month-int<br>";

	//echo "<br><br>";
	//////////////////////////////////

														$mon_pay_left = paymentdue($tdd,$tdm,nl2br($rows1['pddayz']),nl2br($rows1['pdmonth']),nl2br($rows1['pdyear']),date('d', strtotime( nl2br($rows2['maxdate_rec']))),date('m', strtotime( nl2br($rows2['maxdate_rec']))),date('Y', strtotime( nl2br($rows2['maxdate_rec']))));
														if($mon_pay_left>=1)
														{
															//echo "<div><strong>Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															//echo "<td valign='top'>";

															//echo "</td>";  
															//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>";  
															echo "<td valign='top'>" . showUser( nl2br( $rows1['LeadId'])) . "</td>";
															echo "<td valign='top'>" . showStudents(nl2br( $rows1['studentID'])) . "</td>";
															echo "<td valign='top'>" . nl2br( $rows1['amount']) . "</td>";  
															echo "<td ><a class=button href=class_details.php?id={$rows1['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$rows1['studentID']}>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>"; 
														}
														else
														{
															/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
															echo "<tr>";  
															echo "<td valign='top'>Empty</td>";
															echo "<td valign='top'>Empty</td>";  
															echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
															echo "</tr>";*/
														}
													//echo "</table>";
													}
													echo "</table>";
												}
													
											
												else
												{
													/*echo "<div><strong>No Payment dues today : ".date("Y-m-d")."(YYYY-MM-DD)</strong></div>";
													echo "<tr>";  
													//echo "<td valign='top'>";

													//echo "</td>";  
													//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>";  
													echo "<td valign='top'>Empty</td>";
													echo "<td valign='top'>Empty</td>";  
													echo "<td ><a class=button href=class_details.php?id=>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id=>Pay</a>&nbsp;&nbsp"; 
													echo "</tr>"; */
												} 
													echo "</table>";
											}
									 ?>
                                    </div>
                                    
                                    <div class="content-box box2">
                                    	<h4>Consectetur adipisicing</h4>
                                    	<p>Elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                    </div>
									
                                    
                                    
                                    
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                            
                        <?php }
						if($_SESSION['userType']=='5'){
                        ?>
                        
                           
                                    
                                    <a class="dashboard_button button2" href="book_scheduler_new.php">
                                        <span class="dashboard_button_heading">New Schedule</span>
                                        <span>Reserve Schedule For student </span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button2" href="profile_edit.php">
                                        <span class="dashboard_button_heading">Edit Profile</span>
                                        <span>Edit Your Profile</span>
                                    </a><!--end dashboard_button-->
                                    <a class="dashboard_button button2" href="profile_edit.php">
                                        <span class="dashboard_button_heading">List Students</span>
                                        <span>View All Your Students</span>
                                    </a><!--end dashboard_button-->
                                                              
                                    
                                    <a class="dashboard_button button2" href="changepassword.php">
                                        <span class="dashboard_button_heading">Edit Password</span>
                                        <span>Change Your Password</span>
                                    </a><!--end dashboard_button-->
                                    
                                    
									<!--notice documents -->
                                    <!--Student Reference, 28-03-2015 -->
                                    <!--<a id="" class="dashboard_button_blink button15 myDiv" href="notice_student_reference.php">
                                        <span class="dashboard_button_heading_blink">NOTICE</span>
                                        <span style="color:red"><b>Student Reference Offer</b>  - (28-03-2015)</span>
                                    </a><!--end dashboard_button-->

									
									
									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										if($row['active_deactive']==1)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
                                    
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                            
                        <?php } 
						if($_SESSION['userType']=='3'){
                        ?>
                                    <label style="color:RED; font-weight:bold; font-size:11px; margin-bottom:5px;">Click on DAILY SCHEDULE Below- It will auto load your current daily Schedule</label>
                                    <a class="dashboard_button button2" href="daily_scheduler.php">
                                        <span class="dashboard_button_heading">Daily Schedule</span>
                                        <span>Shows Class Schedule of Teacher </span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button2" href="profile_edit.php">
                                        <span class="dashboard_button_heading">Edit Profile</span>
                                        <span>Edit Your Profile</span>
                                    </a><!--end dashboard_button-->
                                                              
                                    
                                    <a class="dashboard_button button2" href="changepassword.php">
                                        <span class="dashboard_button_heading">Edit Password</span>
                                        <span>Change Your Password</span>
                                    </a><!--end dashboard_button-->
									
									<!--Policy-->
                                    <!--Student Reference, 01-02-17 -->
									<div> 
                                    <a id="" class="dashboard_button_blink button15 myDiv" href="policies_late_coming.php">
                                        <span class="dashboard_button_heading_blink">Late Coming </span>
                                        <span>Click here for further details</span>
                                    </a><!--end dashboard_button-->
									</div>
									
									<? if($_SESSION['designationID']==17){ ?>
									<a class="dashboard_button button2" href="class_details_specific_teacher.php">
                                        <span class="dashboard_button_heading">Class Details</span>
                                        <span>Student Classes Details</span>
                                    </a><!--end dashboard_button-->
									<a class="dashboard_button button2" href="biometric_list.php">
                                        <span class="dashboard_button_heading">Attendance</span>
                                        <span>Teacher Attendance details</span>
                                    </a><!--end dashboard_button-->
									
									<? } ?>
									

									
									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										if($row['active_deactive']==1)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                        
						<?php } 
						
						
						if($_SESSION['userType']=='9'){
                        ?>
                        
                           
                                    
                                    <a class="dashboard_button button2" href="book_scheduler_manage.php">
                                        <span class="dashboard_button_heading">Manage Schedule</span>
                                        <span>Shows Class Schedules </span>
                                    </a><!--end dashboard_button-->

                                    
									
									
									<!--notice documents -->
                                    <!--Student Reference, 28-03-2015 -->
                                    <!--<a id="" class="dashboard_button_blink button15 myDiv" href="notice_student_reference.php">
                                        <span class="dashboard_button_heading_blink">NOTICE</span>
                                        <span style="color:red"><b>Student Reference Offer</b>  - (28-03-2015)</span>
                                    </a><!--end dashboard_button-->

									
									
									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										if($row['active_deactive']==1)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
									
									<!--end dashboard_button-->
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                        
						<?php } 
						
						
						if($_SESSION['userType']=='11'){
                        ?>
                        
                           
                                    
                                    <a class="dashboard_button button2" href="hr_user_list.php">
                                        <span class="dashboard_button_heading">List Employee</span>
                                        <span>List Employee </span>
                                    </a><!--end dashboard_button-->
                                    
									
									<!--notice documents -->
                                    <!--Student Reference, 28-03-2015 -->
                                    <!--<a id="" class="dashboard_button_blink button15 myDiv" href="notice_student_reference.php">
                                        <span class="dashboard_button_heading_blink">NOTICE</span>
                                        <span style="color:red"><b>Student Reference Offer</b>  - (28-03-2015)</span>
                                    </a><!--end dashboard_button-->

									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										if($row['active_deactive']==1)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                        
						
						
						<?php } 
						
						
						if($_SESSION['userType']=='4'){
						echo "<script>window.location.href = 'daily_scheduler_student.php'</script>";
                        ?>
                        
                           
									<a class="dashboard_button button2" href="daily_scheduler_student.php">
                                        <span class="dashboard_button_heading">Daily Schedule Student</span>
                                        <span>Daily Schedule Student</span>
                                    </a><!--end dashboard_button-->
                                   
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                        
						
						
						
						<?php }		
						if($_SESSION['userType']=='18'){
                        ?>
                                    
                                    <label style="color:RED; font-weight:bold; font-size:11px; margin-bottom:5px;">Click on DAILY SCHEDULE Below- It will auto load your current daily Schedule</label>
                                    <a class="dashboard_button button2" href="daily_scheduler.php">
                                        <span class="dashboard_button_heading">Daily Schedule</span>
                                        <span>Shows Class Schedule of Teacher </span>
                                    </a><!--end dashboard_button-->
                                    
                                    <a class="dashboard_button button2" href="profile_edit.php">
                                        <span class="dashboard_button_heading">Edit Profile</span>
                                        <span>Edit Your Profile</span>
                                    </a><!--end dashboard_button-->
                                                              
                                    
                                    <a class="dashboard_button button2" href="changepassword.php">
                                        <span class="dashboard_button_heading">Edit Password</span>
                                        <span>Change Your Password</span>
                                    </a><!--end dashboard_button-->
									<?php //if($_SESSION['userId']==911) {?>
									<a class="dashboard_button button2" href="class_details_specific_teacher.php">
                                        <span class="dashboard_button_heading">Class details</span>
                                        <span>Change Your Password</span>
                                    </a><!--end dashboard_button-->
									<?php //} ?>
									
									
									
									<!--notice documents -->
                                    <!--Student Reference, 28-03-2015 -->
                                    <!--<a id="" class="dashboard_button_blink button15 myDiv" href="notice_student_reference.php">
                                        <span class="dashboard_button_heading_blink">NOTICE</span>
                                        <span style="color:red"><b>Student Reference Offer</b>  - (28-03-2015)</span>
                                    </a><!--end dashboard_button-->

									
									<br>
									<?
									//FOLLOWING ARE THE HR MESSAGES DISPLAYED UNDER EACH USER TYPE
									//HR MESSAGES START
                                    $result_hr_message = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
									while($row_hr_message = mysql_fetch_array($result_hr_message))
									{ 
										foreach($row_hr_message as $key => $value) { $row[$key] = stripslashes($value); } 
										$msg_id = nl2br( $row_hr_message['id']) ;
										$msg_heading = nl2br( $row_hr_message['heading']) ;
										$msg_message = nl2br( $row_hr_message['message']) ;
										$msg_status = getData(nl2br( $row_hr_message['active_deactive']),'status') ;
										if($row['active_deactive']==1)
										{
											$h1 = nl2br( $row['heading']);
											$m1 = nl2br( $row['message']);
											$m1 = stripslashes($m1);
											$m1 = str_replace("rn","<br>",$m1);
										}
										else
										{
											$h2 = "No Updates";
											$m2 = "";
										}
									} 
									?>
									<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
									<div id="vmarquee" style="position: absolute; width: 98%;">
										<!--YOUR SCROLL CONTENT HERE-->
										<?
										if($h1!="" && $m1!="")
										{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
											echo "<p>" . $m1 . "</p>";
										}
										else
										{
											if($h1=="" && $m1=="")
											{
											echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
											echo "<hr>";
											echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
											echo "<p>" . $m2 . "</p>";
											}
										}
										?>
										<!--YOUR SCROLL CONTENT HERE-->
									</div>
									</div>
									<!--HR MESSAGES END -->
                               
                                <!--end jquery tab-->
                            
                            <!--end jquery tab-->
                            
                            
                            <!--end jquery tab--> 
                        
						<?php }		include('include/footer.php');?>
<!--Reload for the chat -->		
<script type="text/javascript">
  setTimeout(function () { location.reload(true); }, 30000);
</script>