 </div><!--end content_block-->
                                
                                </div><!-- end jquery_tab --> </div><!--end content-->
                        
                    </div><!--end main-->
             
              <div id="sidebar">
                            <ul class="nav">
                                <li><a class="headitem item1" href="index.php" <?php if($_current=='Dashboard'){ echo "class='current'"; }?>>Dashboard</a>
                                    <ul class="opened"><!-- ul items without this class get hiddden by jquery-->
                                   <?php
									if(in_array('Trial Confirmation List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Trial Confirmation List'){ echo "class='current'"; }?>><a href="book_scheduler_confirmation.php" >Trial Confirmation List </a></li>
									<?php } if(in_array('Edit Profile',$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=='Edit Profile'){ echo "class='current'"; }?>><a href="profile_edit.php" >Edit Profile </a></li>
                                    <?php } if(in_array('List Teacher Timings',$_permission[$_SESSION['userType']])){ ?>
                                    <li <?php if($_current=='List Teacher Timings'){ echo "class='current'"; }?>><a href="scheduler_list.php" >List Timings</a></li>
                                   
                                    <?php }if(in_array('List User',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List User'){ echo "class='current'"; }?>><a href="user_list.php" >List User </a></li>
                                    
									<?php }if(in_array('List Employees',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List Employees'){ echo "class='current'"; }?>><a href="hr_user_list.php" >List Employees </a></li>
                                    
									<?php }if(in_array('Teacher Basic Info',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teacher Basic Info'){ echo "class='current'"; }?>><a href="teacher_info_by_teamlead.php" >Teacher Basic Info </a></li>
                                    
									<?php }if(in_array('List Message',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List Message'){ echo "class='current'"; }?>><a href="hr_display_message_list.php" >List Message</a></li>
                                    
									
                                    <?php } if(in_array("List Teacher's Course",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Teacher's Course"){ echo "class='current'"; }?>><a href="teacher_course_list.php" >List Teacher's Course </a></li>
                                    <? }  if(in_array("List Payments",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Payments"){ echo "class='current'"; }?>><a href="transaction_list.php" >List Payments </a></li>
                                    
									<? }  if(in_array("List Due Payments",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Due Payments"){ echo "class='current'"; }?>><a href="transaction_paymentdue_list.php" >List Due Payments </a></li>
                                    
									<? } if(in_array("List Callbacks",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Callbacks"){ echo "class='current'"; }?>><a href="callback_list.php" >List Callbacks </a></li>
                                    <? } 
									if(in_array("List Skype IDs",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Skype IDs"){ echo "class='current'"; }?>><a href="skype_list.php" >List Skype IDs</a></li>
                                    <? }
									if(in_array("List Logging",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Logging"){ echo "class='current'"; }?>><a href="logging_list.php" >List Logging</a></li>
                                    <? }
									if(in_array("Dead Confirmation List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Dead Confirmation List"){ echo "class='current'"; }?>><a href="book_scheduler_dead_confirmation.php" >Dead Confirmation List</a></li>
                                    <? }
									if(in_array("TL Confirm List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="TL Confirm List"){ echo "class='current'"; }?>><a href="book_scheduler_edit_TL_confirmation.php" >TL Confirm List</a></li>
                                    <? }
									if(in_array("Meeting Link List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Meeting Link List"){ echo "class='current'"; }?>><a href="meetinglink_list.php" >Meeting Link List</a></li>
                                    <? }
									if(in_array("Daily Schedule Student",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Daily Schedule Student"){ echo "class='current'"; }?>><a href="daily_scheduler_student.php" >Daily Schedule Student</a></li>
                                    <? }
									if(in_array("Ticket List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Ticket List"){ echo "class='current'"; }?>><a href="ticket_list.php" >Ticket List</a></li>
                                    <? }
									if(in_array("Order Meal List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Order Meal List"){ echo "class='current'"; }?>><a href="order_meal_list.php" >Order Meal List</a></li>
                                    <? }								
									
									?>
                                    </ul>
                                </li>
								
								
								<!--NEWLY ADDED TEAM LEAD MENU-->
								<li><a class="headitem item1" href="#">Team Lead</a>
                                    <ul>
									<?php if(in_array('Main Team Lead Selection',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Main Team Lead Selection'){ echo "class='current'"; }?>><a href="teamlead_new_main.php" >Main Team Lead Select</a></li>
                                    <?php }
                                     if(in_array('Team Lead Selection',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Team Lead Selection'){ echo "class='current'"; }?>><a href="teamlead_new.php" >Team Lead Select</a></li>
                                    <?php }
                                     if(in_array('Teacher TL Report',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teacher TL Report'){ echo "class='current'"; }?>><a href="teamlead_teacher_report.php" >Teacher TL Report </a></li>
                                    <?php  }
									if(in_array('Teacher TL Report VER2',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teacher TL Report VER2'){ echo "class='current'"; }?>><a href="teamlead_teacher_report_ver2.php" >Teacher TL Report Ver2 </a></li>
                                    <?php  }
									if(in_array('Agent TL Report',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Agent TL Report'){ echo "class='current'"; }?>><a href="teamlead_agent_report.php" >Agent TL Report </a></li>
                                    <?php }
									if(in_array('TeamLead Summary',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='TeamLead Summary'){ echo "class='current'"; }?>><a href="teamlead_teacher_agent_report_count.php" >TeamLead summary </a></li>
                                    <?php } 
									if(in_array('Teacher TL Report OLD',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teacher TL Report OLD'){ echo "class='current'"; }?>><a href="teamlead_teacher_report_old.php" >Teacher TL Report OLD </a></li>
                                    <?php } ?>
                                   
                                    </ul>                            
                                </li>
								
								
                                 <li><a class="headitem item1" href="#">Schedule</a>
                                    <ul>
                                     <?php if(in_array('Daily Schedule',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Daily Schedule'){ echo "class='current'"; }?>><a href="daily_scheduler.php" >Daily Schedule </a></li>
                                    <?php }
                                     if(in_array('Manage Schedule',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Manage Schedule'){ echo "class='current'"; }?>><a href="book_scheduler_manage.php" >Manage Schedule </a></li>
                                    
									<?php }
                                     if(in_array('MANAGE SCHEDULE PARENT',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='MANAGE SCHEDULE PARENT'){ echo "class='current'"; }?>><a href="book_scheduler_manage_PARENT.php" >MANAGE SCHEDULE PARENT</a></li>
                                    
									
									<?php }
                                     if(in_array('Manage Schedule-Group',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Manage Schedule-Group'){ echo "class='current'"; }?>><a href="book_scheduler_manage_group.php" >Manage Schedule-Grp </a></li>
									
									<?php  }
									if(in_array('Manage Schedule-TL',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Manage Schedule-TL'){ echo "class='current'"; }?>><a href="schedule_with_teamlead.php" >Manage Schedule-TL </a></li>
                                    <?php  }
									if(in_array('List Schedule',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List Schedule'){ echo "class='current'"; }?>><a href="book_scheduler_list.php" >List Schedule </a></li>
                                    <?php }	 if(in_array('New Schedule',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='New Schedule'){ echo "class='current'"; }?>><a href="book_scheduler_new.php" >New Schedule </a></li>
                                    
									<?php }	 if(in_array('New Schedule-Group',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='New Schedule-Group'){ echo "class='current'"; }?>><a href="book_scheduler_new_group.php" >New Schedule-Grp </a></li>
                                    
									<?php }	 if(in_array('Available Teacher',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Available Teacher'){ echo "class='current'"; }?>><a href="book_scheduler_new_teacher_available.php" >Available Teacher </a></li>
                                    
									
									<?php }	 if(in_array('Manage Schedule Ver2',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Manage Schedule Ver2'){ echo "class='current'"; }?>><a href="book_scheduler_manage_amounts_ver2.php" >Manage Schedule Ver2 </a></li>
									<?php }	 if(in_array('Transaction Ver2',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Transaction Ver2'){ echo "class='current'"; }?>><a href="transaction_list_ver2.php" >Transaction Ver2</a></li>
									<?php }	 if(in_array('Daily Schedule Ver2',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Daily Schedule Ver2'){ echo "class='current'"; }?>><a href="daily_scheduler_ver2.php" >Daily Schedule Ver2 </a></li>
									
									<?php }	 if(in_array('Freeze List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Freeze List'){ echo "class='current'"; }?>><a href="book_scheduler_freeze_list.php" >Freeze List</a></li>
                                   
									<?php }	 if(in_array('Assignments List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Assignments List'){ echo "class='current'"; }?>><a href="assign_list.php" >Assignments</a></li>
                                   
									<?php }	 if(in_array('TransferToLHR List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='TransferToLHR List'){ echo "class='current'"; }?>><a href="book_scheduler_transfertolhr_list.php" >TransferToLHR List</a></li>
									
									<?php }	 if(in_array('Incentive-Fee Raise',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Incentive-Fee Raise'){ echo "class='current'"; }?>><a href="book_scheduler_manage_amounts_ver2_list.php" >Incentive-Fee Raise</a></li>
                                   
								    <?php }	 if(in_array('Email Student List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Email Student List'){ echo "class='current'"; }?>><a href="book_scheduler_manage_emailStudent.php" >Email Student List</a></li>
									
									<?php }	 if(in_array('Parent List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Parent List'){ echo "class='current'"; }?>><a href="parent_list.php" >Parent List</a></li>
									
									<?php }	 if(in_array('Parent Assign',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Parent Assign'){ echo "class='current'"; }?>><a href="parent_assign.php" >Parent Assign</a></li>
                                    
									<?php }	 if(in_array('FileUpload',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='FileUpload'){ echo "class='current'"; }?>><a href="fileupload_list.php" >Uploaded files</a></li>
                                    
									<?php }	 if(in_array('Paypal invoice details',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Paypal invoice details'){ echo "class='current'"; }?>><a href="paypal_invoice_details.php" >Paypal invoice details</a></li>
                                                                      
									<?php } ?>
                                   
                                    </ul>                            
                                </li>
                                 <li><a class="headitem item1" href="#">Students</a>
                                    <ul>
                                     <?php if(in_array('List Students',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List Students'){ echo "class='current'"; }?>><a href="students_list.php" >List Students </a></li>
                                    <?php }
									if(in_array("Student Classes",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="List Skype IDs"){ echo "class='current'"; }?>><a href="class_details.php" >Student Classes</a></li>
                                    <? }
									if(in_array("Students UserPass List",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Students UserPass List"){ echo "class='current'"; }?>><a href="students_userpass_list.php" >Students UserPass</a></li>
                                    <? } ?>
                                   
                                    </ul>                            
                                </li>
                                 <li><a class="headitem item2" href="#">Reports</a>
                                    <ul>
                                    <?php if(in_array("Pend Rpt Ver4-overall",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Pend Rpt Ver4-overall"){ echo "class='current'"; }?>><a href="pending_amount_report_pre_curr_next_FORnextYEAR_2_ver4.php" >Pend Rpt Ver4-overall</a></li>
                                    <? }
										if(in_array("Main Reports",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Main Reports"){ echo "class='current'"; }?>><a href="report_links.php" >Main Reports</a></li>
                                    <? }
										if(in_array("Trial Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Trial Report"){ echo "class='current'"; }?>><a href="trial_report.php" >Trial Report</a></li>
                                    <? }
									  if(in_array("Total Payments",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Total Payments"){ echo "class='current'"; }?>><a href="transaction_report_FORnextYEAR.php" >Total Payments </a></li>
                                    <? }
									  if(in_array("Payment Record Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Payment Record Report"){ echo "class='current'"; }?>><a href="payment_record_report_test.php" >Payment Record Report</a></li>
									<? }
									if(in_array("Total Payments VER2",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Total Payments VER2"){ echo "class='current'"; }?>><a href="transaction_paymentdue_report.php" >Total Payments VER2</a></li>
                                    <? }
                                    if(in_array("Agent Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Agent Report"){ echo "class='current'"; }?>><a href="agent_report.php" >Agent Report </a></li>
                                    <? } 
                                    if(in_array("Signup Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Signup Report"){ echo "class='current'"; }?>><a href="signup_report.php" >Signup Report </a></li>
                                    <? }
                                    if(in_array("Present/Absent Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Present/Absent Report"){ echo "class='current'"; }?>><a href="present_absent_report.php" >Present/Absent Report </a></li>
                                    <? }
                                    if(in_array("Regular Class Stat",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Regular Class Stat"){ echo "class='current'"; }?>><a href="regular_class_stat.php" >Regular Class Stat </a></li>
									<? }
									if(in_array("Pending report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Pending report"){ echo "class='current'"; }?>><a href="pending_amount_report_current.php" >Pending report</a></li>
									<? }
									if(in_array("Pending report-overall",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Pending report-overall"){ echo "class='current'"; }?>><a href="pending_amount_report_pre_curr_next_FORnextYEAR_2_ver3.php" >Pending report-overall</a></li>
									<? }
									if(in_array("Daily Sch-Recurring",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Daily Sch-Recurring"){ echo "class='current'"; }?>><a href="daily_scheduler_paydate_recurr.php" >Daily Sch-Recurring</a></li>
									<? }
									if(in_array("Teacher Trial Status",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Teacher Trial Status"){ echo "class='current'"; }?>><a href="teacher_trial_status.php" >Teacher Trial Status</a></li>
									<? }
									if(in_array("Class Days Business",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Class Days Business"){ echo "class='current'"; }?>><a href="class_days_business.php" >Class Days Business</a></li>
									<? }
									if(in_array("Teacher's Recurring VER2",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Teacher's Recurring VER2"){ echo "class='current'"; }?>><a href="payment_record_report_test_teacher_month_business_ver2.php" >Teacher's Recurring</a></li>
									<? }
									if(in_array("Agent Dialing Report",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Agent Dialing Report"){ echo "class='current'"; }?>><a href="recording_log_report.php" >Agent Dialing Report</a></li>
									<? }
									if(in_array("Salary + Commision",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Salary + Commision"){ echo "class='current'"; }?>><a href="teacher_month_business_prr.php" >Salary + Commision</a></li>
									<? }
									
									if(in_array("Agent TRIAL SIGNUP",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Agent TRIAL SIGNUP"){ echo "class='current'"; }?>><a href="agent_trial_signup.php" >Agent TRIAL SIGNUP</a></li>
									<? }
									if(in_array("Salary + Commision MANAGEMENT",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Salary + Commision MANAGEMENT"){ echo "class='current'"; }?>><a href="teacher_month_business_prr_management_version.php" >Salary + Commision MANAGEMENT</a></li>
									<? }
									if(in_array("Pending DATE FILTER",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Pending DATE FILTER"){ echo "class='current'"; }?>><a href="pending_amount_report_pre_curr_next_FORnextYEAR_2_TL_date_filter.php" >Pending DATE FILTER</a></li>
									<? }
									if(in_array("Month Start End Report TTL",$_permission[$_SESSION['userType']])) { ?>
                                    <li <?php if($_current=="Month Start End Report TTL"){ echo "class='current'"; }?>><a href="daily_sch_ttl_month_start_end_report.php">Month Start/End Report</a></li>
									<? }
									
									?>
                                   
                                    </ul>                            
                                </li>
								<li><a class="headitem item1" href="#">Emp Salary</a>
                                    <ul>
                                     <?php if(in_array('List Emp Salary',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List Emp Salary'){ echo "class='current'"; }?>><a href="emp_payroll_list.php" >List Emp Salary</a></li>
                                    <?php } ?>
                                   
                                    </ul>                            
                                </li>
								
								<li><a class="headitem item1" href="#">HR Portal</a>
                                    <ul>
                                     <?php if(in_array('Policies',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Policies'){ echo "class='current'"; }?>><a href="policies.php" >Policies</a></li>
                                    <?php } ?>
									
									 <?php if(in_array('Notices',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Notices'){ echo "class='current'"; }?>><a href="notices.php" >Notice</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Memo',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Memo'){ echo "class='current'"; }?>><a href="memos.php" >Memo</a></li>
                                    <?php } ?>
									
									<?php if(in_array('SOP',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='SOP'){ echo "class='current'"; }?>><a href="sop.php" >SOP</a></li>
                                    <?php } ?>
									
									<!--Leave Application files permission -->
									<?php if(in_array('Leave App New',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Leave App New'){ echo "class='current'"; }?>><a href="leave_application_new.php" >Leave App New</a></li>
                                    <?php } ?>
									
									<?php if(in_array('List App-Teacher-Agent',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List App-Teacher-Agent'){ echo "class='current'"; }?>><a href="leave_application_list_teacher.php" >Leave App-Teacher-Agent</a></li>
                                    <?php } ?>
									
									<?php if(in_array('List App-TL',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List App-TL'){ echo "class='current'"; }?>><a href="leave_application_list_teamlead.php" >Leave App-TL</a></li>
                                    <?php } ?>
									
									<?php if(in_array('List App-GM',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List App-GM'){ echo "class='current'"; }?>><a href="leave_application_list_gm.php" >Leave App-GM</a></li>
                                    <?php } ?>
									
									<?php if(in_array('List App-HR',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='List App-HR'){ echo "class='current'"; }?>><a href="leave_application_list_hr.php" >Leave App-HR</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Leave Apply by TL',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Leave Apply by TL'){ echo "class='current'"; }?>><a href="leave_application_new_teamlead_version.php" >Leave Apply by TL</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Leave Apply by PA',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Leave Apply by PA'){ echo "class='current'"; }?>><a href="leave_application_new_pa_version.php" >Leave Apply by PA</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Leave Apply by IT',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Leave Apply by IT'){ echo "class='current'"; }?>><a href="leave_application_new_IT_version.php" >Leave Apply by IT</a></li>
                                    <?php } ?>
									
									<?php ?>
                                    <li <?php ?>><a href="#" >--------------------</a></li>
                                    <?php  ?>
                                   
								    <!--Short Leave Application files permission -->
									<?php if(in_array('Short Leave App New',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Short Leave App New'){ echo "class='current'"; }?>><a href="short_leave_application_new.php" >Short Leave App New</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Short List App-Teacher',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Short List App-Teacher'){ echo "class='current'"; }?>><a href="short_leave_application_list_teacher.php" >Short Leave App-Teacher</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Short List App-TL',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Short List App-TL'){ echo "class='current'"; }?>><a href="short_leave_application_list_teamlead.php" >Short Leave App-TL</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Short List App-HR',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Short List App-HR'){ echo "class='current'"; }?>><a href="short_leave_application_list_hr.php" >Short Leave App-HR</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Teacher Month Business and Biometric',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teacher Month Business and Biometric'){ echo "class='current'"; }?>><a href="teacher_month_business_prr_biometric_plus_ver2.php" >Teacher Month Business and Biometric</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Emp Arrears List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Emp Arrears List'){ echo "class='current'"; }?>><a href="emp_arrears_list.php" >Emp Arrears List</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Emp Gift Fine List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Emp Gift Fine List'){ echo "class='current'"; }?>><a href="emp_gift_fine_list.php" >Emp Gift Fine List</a></li>
                                    <?php } ?>
                                   
                                   
                                   
                                    </ul>                            
                                </li>
								
								
								
								<li><a class="headitem item1" href="#">Commision</a>
                                    <ul>
                                     <?php if(in_array('Commision Recurring',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Commision Recurring'){ echo "class='current'"; }?>><a href="commision_recurring.php" >Commision Recurring</a></li>
                                    <?php } ?>
									
									 <?php if(in_array('Commision Signup',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Commision Signup'){ echo "class='current'"; }?>><a href="commision_signup.php" >Commision Signup</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Commision Ref',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Commision Ref'){ echo "class='current'"; }?>><a href="commision_reference.php" >Commision Ref</a></li>
                                    <?php } ?>
									
									<?php if(in_array('Agent Commision',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Agent Commision'){ echo "class='current'"; }?>><a href="agent_commision_signup.php" >Agent Commision</a></li>
                                    <?php } ?>
                                   
                                   
                                    </ul>                            
                                </li>
								
								<li><a class="headitem item1" href="#">Attendance</a>
                                    <ul>
                                     <?php if(in_array('Biometric List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Biometric List'){ echo "class='current'"; }?>><a href="biometric_list.php">Attendance List</a></li>
                                    <?php } ?>
									
									 <?php if(in_array('Biometric Upload',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Biometric Upload'){ echo "class='current'"; }?>><a href="biometric_upload.php">Upload Attendance</a></li>
                                    <?php } ?>
                                    </ul>                            
                                </li>
								
								<!--NEWLY ADDED - ALL BUSINESS DASHBOARD -->
								<li><a class="headitem item1" href="#">Business</a>
                                    <ul>
									<?php if(in_array('Business Sheet Dashboard',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Business Sheet Dashboard'){ echo "class='current'"; }?>><a href="business_sheet_dashboard.php" >Biz Sheet Dashboard</a></li>
                                    <?php }
                                     if(in_array('Business Sheet Trial Upload',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Business Sheet Trial Upload'){ echo "class='current'"; }?>><a href="business_sheet_trial_upload.php" >Biz Sheet Trial Upload</a></li>
                                    <?php }
                                     if(in_array('Teamlead Target List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teamlead Target List'){ echo "class='current'"; }?>><a href="teamlead_target_list.php" >TL Target List </a></li>
                                    <?php  }
									if(in_array('Teamlead Target List Val',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Teamlead Target List Val'){ echo "class='current'"; }?>><a href="teamlead_target_list_values.php" >TL Target List Val </a></li>
                                    <?php }
									if(in_array('Paypal Output with PRR',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Paypal Output with PRR'){ echo "class='current'"; }?>><a href="paypal_output.php" >Paypal Outout with PRR </a></li>
                                    <?php }
									if(in_array('Paypal List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Paypal List'){ echo "class='current'"; }?>><a href="paypal_list.php" >Paypal List </a></li>
									<?php }
									if(in_array('Paypal Upload',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Paypal Upload'){ echo "class='current'"; }?>><a href="paypal_upload.php" >Paypal Upload </a></li>
									<?php } ?>
									
                                   
                                    </ul>                            
                                </li>
								
								<!--NEWLY ADDED- 05-07-2015 - Extension ID's -->
								<li><a class="headitem item1" href="#">Extension ID's</a>
                                    <ul>
                                     <?php if(in_array('Extension List',$_permission[$_SESSION['userType']])) {?>
                                    <li <?php if($_current=='Extension List'){ echo "class='current'"; }?>><a href="ext_list.php" >List Extensions</a></li>
                                    <?php } ?>   
                                    </ul>                            
                                </li>
								
								
								
								
                                <?php if(in_array('Setting',$_permission[$_SESSION['userType']])) {?>
                                <li><a class="headitem item2" href="#">Settings</a>
                                    <ul>
                                    <li><a href="#">Application settings</a></li>
                                    <li><a href="#">User settings</a></li>
                                   
                                    </ul>                            
                                </li>
                               
                                <li><a class="headitem item5" href="#">Reports</a>
                                    <ul>
                                    <li><a href="#">Basic Search</a></li>
                                    <li><a href="#">Advanced Search</a></li>
                                    <li><a href="#">Search Option</a></li>
                                    </ul>
                                </li> <? } ?>
                               <!-- <li><a class="headitem item6" href="#">Deleted Items</a>
                                    <ul>
                                    <li><a href="#">Content</a></li>
                                    <li><a href="#">Images</a></li>
                                    <li><a href="#">Audio</a></li>
                                    <li><a href="#">Video</a></li>
                                    <li><a href="#">PDF</a></li>
                                    <li><a href="#">Scripts</a></li>
                                    <li><a href="#">Other</a></li>
                                    </ul>
                                </li>-->
                            </ul><!--end subnav-->
                            
                          <div class="flexy_datepicker"></div>
                           
                          <!--/* <ul>
                           <li><a class="headitem item7" href="#">Task Manager</a>
                                    <ul>
                                    <li><a href="#">Write Blogpost</a></li>
                                    <li><a href="#">Script Pages</a></li>
                                    <li><a href="#">Meeting at 8.00</a></li>
                                    </ul>
                                </li>
                           </ul>  */-->   
                            
                        </div><!--end sidebar-->
                        
                     </div><!--end bg_wrapper-->
                     
                <div id="footer">
                
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>