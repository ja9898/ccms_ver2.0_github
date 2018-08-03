<?php 
foreach($_POST AS $key => $value) { if(!is_array($_POST[$key])){$_POST[$key] = mysql_real_escape_string($value); }} 

//Unsetting HR Sessions		- Never unset $_SESSION variables of one APP in another APP
//unset($_SESSION["loggedIn_hr"]);
//unset($_SESSION["userType_hr"]);
//unset($_SESSION['userName_hr']);
//unset($_SESSION['userId_hr']);
//unset($_SESSION['userip_hr']);

if(!isset($_SESSION["loggedIn"]) && !isset($_SESSION["ccms"])){
		header('Location:login.php');exit;
}
$_current="Dashboard";
$_title=array();
$_title['user_list.php']="List User";
$_title['user_new.php']="New User";
$_title['user_edit.php']="Edit User";
$_title['profile_edit.php']="Edit Profile";
$_title['changepassword.php']="Change Password";
$_title['404.php']="Error 404";
//$_title['make_regular.php']="Transaction Details";
$_title['make_regular_ver2.php']="Transaction Details";	//MAKE REGULAR ver2 // 02-08-18
$_title['user_delete.php']="Delete User";
$_title['user_type_list.php']="List User Type";
$_title['user_type_new.php']="New User Type";
$_title['user_type_edit.php']="Edit User Type";
$_title['user_type_delete.php']="Delete User Type";
$_title['scheduler_list.php']="List Teacher Timings";
$_title['scheduler_new.php']="New Teacher Timings";
$_title['scheduler_edit.php']="Edit Teacher Timings";
$_title['scheduler_delete.php']="Delete Teacher Timings";
$_title['book_scheduler_confirmation.php']="Trial Confirmation List";
$_title['daily_scheduler.php']="Daily Schedule";
$_title['book_scheduler_list.php']="List Schedule";
$_title['book_scheduler_confirm.php']="Confirm Schedule";
$_title['book_scheduler_new.php']="New Schedule";
$_title['book_scheduler_edit.php']="Edit Schedule";
$_title['book_scheduler_delete.php']="Delete Schedule";
$_title['book_scheduler_manage.php']="Manage Schedule";
$_title['students_list.php']="List Students";
$_title['students_new.php']="New Students";
$_title['students_edit.php']="Edit Students";
$_title['students_delete.php']="Delete Students";
$_title['teacher_course_list.php']="List Teacher's Course";
$_title['teacher_course_new.php']="New Teacher's Course";
$_title['teacher_course_edit.php']="Edit Teacher's Course";
$_title['teacher_course_delete.php']="Delete Teacher's Course";
$_title['student_attandance.php']="Class Attendance";
$_title['transaction_list.php']="List Payments";
//$_title['transaction_new.php']="New Payments";
$_title['transaction_new_ver2.php']="New Payments";	//Transaction NEW ver2 // 02-08-18
$_title['transaction_new_ver2_approve.php']="Transaction Approve";// 02-08-18
$_title['transaction_new_ver2_reject.php']="Transaction Reject";// 02-08-18
$_title['transaction_report_FORnextYEAR.php']="Total Payments";
$_title['transaction_edit.php']="Edit Payments";
$_title['callback_list.php']="List Callbacks";
$_title['callback_new.php']="New Callback";
$_title['callback_edit.php']="Edit Callbacks";
$_title['callback_delete.php']="Delete Callbacks";
$_title['trial_report.php']="Trial Report";
$_title['skype_list.php']="List Skype IDs";
$_title['skype_new.php']="New Skype IDs";
$_title['skype_edit.php']="Edit Skype IDs";
$_title['skype_delete.php']="Delete Skype IDs";
$_title['class_details.php']="Student Classes";
$_title['class_details_specific_teacher.php']="Student Classes Specific Teacher";

$_title['agent_report.php']="Agent Report";
$_title['signup_report.php']="Signup Report";
$_title['transaction_paymentdue_list.php']="List Due Payments";
$_title['transaction_paymentdue_month_new.php']="Transaction List Due Payments";
$_title['transaction_paymentdue_month_per_student_report.php']="Transaction Student Report Detailed";

$_title['teamlead_new.php']="Team Lead Selection";
$_title['teamlead_teacher_report.php']="Teacher TL Report";
$_title['teamlead_teacher_report_ver2.php']="Teacher TL Report VER2";
$_title['teamlead_agent_report.php']="Agent TL Report";
$_title['teamlead_teacher_agent_report_count.php']="TeamLead Summary";
$_title['teamlead_new_main.php']="Main Team Lead Selection";
$_title['teamlead_teacher_report_old.php']="Teacher TL Report OLD";




$_title['transaction_paymentdue_report.php']="Total Payments VER2";
$_title['book_scheduler_manage_amounts_ver2.php']="Manage Schedule Ver2";
$_title['daily_scheduler_ver2.php']="Daily Schedule Ver2";
$_title['book_scheduler_dead.php']="Dead Schedule";
$_title['logging_list.php']="List Logging";
$_title['book_scheduler_dead_confirmation.php']="Dead Confirmation List";
$_title['book_scheduler_dead_message.php']="Dead Confirmation Message";
$_title['present_absent_report.php']="Present/Absent Report";
$_title['schedule_with_teamlead.php']="Manage Schedule-TL";
$_title['book_scheduler_manage_amounts_ver2_list.php']="Incentive-Fee Raise";
$_title['book_scheduler_manage_amounts_ver2_delete.php']="Incentive-Fee Raise Delete";

//Comments page in MANAGE SCHEDULE
$_title['book_scheduler_comments_general.php']="Comments General";

//HR RELATED WEB PAGES//
$_title['hr_user_list.php']="List Employees";
$_title['hr_user_new.php']="New Employees";
$_title['hr_user_edit.php']="Edit Employees";
$_title['hr_user_delete.php']="Delete Employees";

$_title['hr_display_message_list.php']="List Message";
$_title['hr_display_message_new.php']="New Message";
$_title['hr_display_message_edit.php']="Edit Message";
$_title['teacher_month_business_prr_biometric_plus_ver2.php']="Teacher Month Business and Biometric";
$_title['biometric_edit_HR_ver1.php']="Biometric Edit Teacher Month Business";
////////////////////////

$_title['teacher_info_by_teamlead.php']="Teacher Basic Info";


//BUSINESS RELATED WEBPAGES
//$_title['payment_record_report.php']="Payment Record Report"; //Temporarily Commented on 21-10-2014
$_title['payment_record_report_test.php']="Payment Record Report";	//Activated on 21-10-2014
$_title['payment_record_report_delete.php']="Payment Record Report Delete";
$_title['payment_record_report_test_edit.php']="Payment Record Report Edit";	//Activated on 21-10-2014


$_title['regular_class_stat.php']="Regular Class Stat";
$_title['pending_amount_report_current.php']="Pending report";
//NOTE: Changing pending report-overall link from [_2.php] to [_2_ver3.php]
//$_title['pending_amount_report_pre_curr_next_FORnextYEAR_2.php']="Pending report-overall";
//Following _2_ver3.php 	//NEWLY ADDED	//01-05-17
$_title['pending_amount_report_pre_curr_next_FORnextYEAR_2_ver3.php']="Pending report-overall";
$_title['pending_amount_report_pre_curr_next_FORnextYEAR_2_ver4.php']="Pend Rpt Ver4-overall";
$_title['pending_amount_report_pre_curr_next_FORnextYEAR_2_TL_date_filter.php']="Pending DATE FILTER";	//newly added 15-02-17
$_title['book_scheduler_manage_PARENT_pending_report_OVERALL.php']="MANAGE SCHEDULE AND PR OVERALL LINK";	//newly added 18-05-17

$_title['transaction_list_ver2.php']="Transaction Ver2";
$_title['transaction_edit_ver2.php']="Transaction Edit VER2";
$_title['transaction_new_next_month.php']="Transaction new next month";
$_title['transaction_new_next_next_month.php']="Transaction new next next month";


//GROUP SCHEDULES
$_title['book_scheduler_new_group.php']="New Schedule-Group";
$_title['book_scheduler_manage_group.php']="Manage Schedule-Group";
$_title['book_scheduler_edit_group.php']="Edit Schedule-Group";

//EMP PAYROLL/SALARY RRLATED WEBPAGES
$_title['emp_payroll_new.php']="New Emp Salary";
$_title['emp_payroll_list.php']="List Emp Salary";
$_title['emp_payroll_edit.php']="Edit Emp Salary";
$_title['emp_payroll_list_result.php']="List Emp Salary RESULT";
$_title['emp_payroll_delete.php']="Delete Emp Salary";

//SALARY with Biometric
$_title['emp_arrears_list.php']="Emp Arrears List";
$_title['emp_gift_fine_list.php']="Emp Gift Fine List";


//Teacher Availibility
$_title['book_scheduler_new_teacher_available.php']="Available Teacher";

//HR Portal
//policies
$_title['policies.php']="Policies";
$_title['leave_policy.php']="Leave Policy";
//Notices
$_title['notices.php']="Notices";
$_title['notice_documents.php']="Notice documents";
$_title['notice_ceo_meeting_time.php']="Notice ceo meeting time";
$_title['notice_teacher_manual.php']="Notice Teachers Manual";

//Memo
$_title['memos.php']="Memo";
$_title['memo_present_absent.php']="Memo Present absent";
$_title['memo_referral_commision.php']="Memo referral/commision";

//SOP
$_title['sop.php']="SOP";
$_title['sop_discipline.php']="SOP discipline";


//Commision sub part
$_title['daily_scheduler_paydate_recurr.php']="Daily Sch-Recurring";
$_title['teacher_trial_status.php']="Teacher Trial Status";

//Class days business
$_title['class_days_business.php']="Class Days Business";

//Freeze list
$_title['book_scheduler_freeze.php']="Freeze schedule";
$_title['book_scheduler_unfreeze.php']="Unfreeze Schedule";
$_title['book_scheduler_freeze_list.php']="Freeze List";

//TransferToLHR list
$_title['book_scheduler_transfertolhr.php']="TransferToLHR schedule";
$_title['book_scheduler_from_transfertolhr.php']="From TransferToLHR Schedule";
$_title['book_scheduler_transfertolhr_list.php']="TransferToLHR List";


//Assignment development webpages
$_title['assign_list.php']="Assignments List";
$_title['assign_new.php']="Assignments New";
$_title['assign_edit.php']="Assignments Edit";
$_title['assign_delete.php']="Assignments Delete";

//Assessmenta nd file upload for TEACHERS
//$_title['daily_scheduler_assessment_report_dialog.php']="Assessment List";
//$_title['daily_scheduler_assessment_success.php']="Assessment Success Submit";

//COMMISION-Recurring,Signup,Reference
$_title['commision_recurring.php']="Commision Recurring";
$_title['commision_signup.php']="Commision Signup";
$_title['commision_reference.php']="Commision Ref";
//AGENT COMMISION
$_title['agent_commision_signup.php']="Agent Commision";
$_title['agent_trial_signup.php']="Agent TRIAL SIGNUP";	//newly added 15-02-17




//Leave Application files
$_title['leave_application_new.php']="Leave App New";
$_title['leave_application_list_teacher.php']="List App-Teacher-Agent";
$_title['leave_application_list_teacher_delete.php']="List App-Teacher Delete";
$_title['leave_application_list_teamlead.php']="List App-TL";
$_title['leave_application_list_gm.php']="List App-GM";
$_title['leave_application_list_hr.php']="List App-HR";
$_title['leave_application_new_teamlead_version.php']="Leave Apply by TL";
$_title['leave_application_new_pa_version.php']="Leave Apply by PA";
$_title['leave_application_new_IT_version.php']="Leave Apply by IT";

//Short Leave Application files
$_title['short_leave_application_new.php']="Short Leave App New";
$_title['short_leave_application_list_teacher.php']="Short List App-Teacher";
$_title['short_leave_application_list_teacher_delete.php']="Short List App-Teacher Delete";
$_title['short_leave_application_list_teamlead.php']="Short List App-TL";
$_title['short_leave_application_list_hr.php']="Short List App-HR";

//TeamLead EDIT Confirmation List
$_title['book_scheduler_edit_TL_confirmation.php']="TL Confirm List";

//CHAT FILES
$_title['chat_panel.php']="Chat Panel";
$_title['chat_panel_to_chat.php']="Chat Panel to chat";

//Biometric files
$_title['biometric_import.php']="Biometric Import";
$_title['biometric_upload.php']="Biometric Upload";
$_title['biometric_list.php']="Biometric List";
$_title['biometric_delete.php']="Biometric Delete";

//************************************ DASHOBOARD *************************************
//Business Dashboard 12-04-2015
$_title['business_sheet_dashboard.php']="Business Sheet Dashboard";
$_title['business_sheet_dashboard_cronjob.php']="Business Sheet Dashboard-CronJob";
$_title['business_sheet_trial_import.php']="Business Sheet Trial Import";//for Separate CSV of Trials
$_title['business_sheet_trial_upload.php']="Business Sheet Trial Upload";//for Separate CSV of Trials
// Payment Record Report DASHBOARD - As we have already Payment Record Report,
// So named the php files as [teamlead_target_list.php] etc
$_title['teamlead_target_list.php']="Teamlead Target List";
$_title['teamlead_target_list_values.php']="Teamlead Target List Val";
$_title['teamlead_target_edit_values.php']="Teamlead Target Edit Val";
$_title['teamlead_target_new.php']="Teamlead Target New";
// Paypal CSV uplaod
$_title['paypal_import.php']="Paypal Import";
$_title['paypal_list.php']="Paypal List";
$_title['paypal_output.php']="Paypal Output with PRR";
$_title['paypal_upload.php']="Paypal Upload";
//************************************ DASHOBOARD *************************************

//Extension/voice ID's files
$_title['ext_list.php']="Extension List";
$_title['ext_new.php']="Extension New";
$_title['ext_edit.php']="Extension Edit";
$_title['ext_delete.php']="Extension Delete";

//Email to Student on class START/END files
$_title['book_scheduler_manage_emailStudent.php']="Email Student List";
$_title['book_scheduler_edit_emailStudent.php']="Email Student Edit";

//Meeting Link for TEACHER AND STUDENT	//Newly added //01-11-2016
$_title['meetinglink_list.php']="Meeting Link List";
$_title['meetinglink_new.php']="Meeting Link New";
$_title['meetinglink_edit.php']="Meeting Link Edit";
$_title['meetinglink_delete.php']="Meeting Link Delete";
$_title['meetinglink_edit_teacher.php']="Meeting Link Edit Teacher";

//change student password	//Newly added //22-11-2016
$_title['students_userpass_list.php']="Students UserPass List";
$_title['students_userpass_edit.php']="Students UserPass Edit";

$_title['daily_scheduler_student.php']="Daily Schedule Student";

//change student password	//Newly added //09-12-2016
$_title['parent_list.php']="Parent List";
$_title['parent_new.php']="Parent New";
$_title['parent_edit.php']="Parent Edit";
$_title['parent_delete.php']="Parent Delete";
$_title['parent_assign.php']="Parent Assign";
$_title['book_scheduler_manage_PARENT.php']="MANAGE SCHEDULE PARENT";

//Garde and Syllabus	//Newly added //05-02-2018
$_title['book_scheduler_edit_grade_syllabus.php']="Grade-Syllabus";

//TICKET	//Newly added //31-03-2018
$_title['ticket_generate.php']="Ticket Generate";
$_title['ticket_list.php']="Ticket List";
$_title['ticket_conversation.php']="Ticket Conversation";
$_title['ticket_close.php']="Ticket Close";

//MONTH START END REPORT	//Newly added //20-04-2018
$_title['daily_sch_month_start_end_report.php']="Month Start End Report";
$_title['daily_sch_ttl_month_start_end_report.php']="Month Start End Report TTL";
$_title['daily_sch_ttl_month_start_end_edit.php']="Month Start End Report TTL Edit";
$_title['daily_sch_ttl_month_start_end_delete.php']="Month Start End Report TTL Delete";

//FILE UPLOAD
$_title['fileupload_list.php']="FileUpload";

//Paypal invoice details
$_title['paypal_invoice_details.php']="Paypal invoice details";

//Meal Order 
$_title['order_meal_list.php']="Order Meal List";
$_title['order_meal_new.php']="Order Meal New";

//MAIN REPORTS LINK
$_title['report_links.php']="Main Reports";

$_title['student_attandance_manual_absent.php']="Class Attendance Manual";

//MakeOver class duplication
$_title['book_scheduler_makeover_class.php']="MakeOver Class Duplication";
//Payment Record report  - TEACHER MONTH BUSINESS
$_title['payment_record_report_test_teacher_month_business.php']="Teacher's Recurring";
$_title['payment_record_report_test_teacher_month_business_ver2.php']="Teacher's Recurring VER2";
$_title['teacher_month_business_prr.php']="Salary + Commision";
$_title['teacher_month_business_prr_management_version.php']="Salary + Commision MANAGEMENT";	//newly added 15-02-17
//Agent Dialing Report 		//Activated on 13-04-2016
$_title['recording_log_report.php']="Agent Dialing Report";

$_title['index.php']="Dashboard";

// Group Permissions/////////
$_permission=array();

/////////////////////////////////STUDENT Permissions////////////////////// //NEWLY ADDED 01-11-2016

$_permission[4]=array("Error 404","Dashboard","Ticket Conversation","Ticket Generate","Daily Schedule Student","Chat Panel","Chat Panel to chat");

/////////////////////////////////Teacher Permissions//////////////////////

$_permission[3]=array("Error 404","Month Start End Report","Teacher Month Business and Biometric","Salary + Commision","FileUpload","Student Classes Specific Teacher","Short Leave App New","Short List App-Teacher","Biometric List","Chat Panel","Chat Panel to chat","List App-Teacher-Agent","Leave App New","Notice Teachers Manual","Assignments List","SOP discipline","SOP","Memo referral/commision","Memo Present absent","Daily Sch-Recurring","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Dashboard","Daily Schedule","List Schedule","Change Password","Class Attendance");

/////////////////////////////////Accounts Permissions//////////////////////////
$_permission[6]=array("Error 404","Student Classes","Teacher's Recurring VER2","Freeze List","Teacher Month Business and Biometric","Salary + Commision MANAGEMENT","Salary + Commision","Leave App New","Short Leave App New","Dashboard","List User","List Emp Salary RESULT","List Emp Salary","New Emp Salary","Total Payments","Payment Record Report","Pending report-overall","Change Password","Manage Schedule","Teacher TL Report","Teacher TL Report VER2","Regular Class Stat");

/////////////////////////////////Floor Assistant Permissions//////////////////////////
$_permission[7]=array("Error 404","Manage Schedule");

/////////////////////////////////Teacher Team Lead Permissions//////////////////////////   ///NEWLY ADDED
$_permission[8]=array("Error 404","Pend Rpt Ver4-overall","Email Student Edit","Email Student List","Month Start End Report TTL Edit","Month Start End Report TTL","Month Start End Report","Ticket Conversation","Ticket List","Transaction Student Report Detailed","Grade-Syllabus","Emp Gift Fine List","MANAGE SCHEDULE AND PR OVERALL LINK","List App-Teacher-Agent","MANAGE SCHEDULE PARENT","Salary + Commision MANAGEMENT","Leave App New","Short Leave App New","Parent List","Parent New","Parent Edit","Parent Assign","Meeting Link List","Meeting Link New","Meeting Link Edit","Short List App-TL","Leave Apply by TL","Teacher TL Report OLD","Biometric List","Chat Panel","Chat Panel to chat","Class Attendance Manual","List App-TL","Transaction new next next month","Transaction List Due Payments","Notice Teachers Manual","SOP discipline","SOP","Memo referral/commision","Memo Present absent","Comments General","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Pending report-overall","Transaction new next month","Pending report",/*"Teacher Basic Info",*/"Payment Record Report","List Due Payments","New Payments","Total Payments","Dead Confirmation Message","Present/Absent Report","Daily Schedule Ver2","Teacher TL Report","Dashboard","Daily Schedule","List Schedule","Change Password","Class Attendance","Manage Schedule","List Students","Student Classes","Edit Schedule","New Schedule","List Teacher Timings","Edit Teacher Timings","List Teacher's Course","Trial Report","Trial Confirmation List","Confirm Schedule"/*,"Transaction Details"*/);

/////////////////////////////////Agent Team Lead Permissions//////////////////////////     ///NEWLY ADDED
$_permission[9]=array("Error 404","List App-Teacher-Agent","List App-TL","Parent New","Parent List","Leave App New","Notice Teachers Manual","SOP discipline","SOP","Comments General","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Payment Record Report","Agent TL Report","List Students","New Students","Error 404","Dashboard","List Schedule","Manage Schedule","New Schedule","Change Password","List Callbacks","New Callback","Edit Callbacks","Trial Confirmation List","Confirm Schedule","Edit Schedule","Dead Confirmation Message"/*,"Dead Schedule"*/,"Transaction Details","Edit Skype IDs","New Skype IDs",
"New Schedule-Group","Manage Schedule-Group","Short Leave App New","Short List App-TL");

 
/////////////////////////////////DAY ADMIN READ ONLY//////////////////////////     ///NEWLY ADDED //20-01-2014
$_permission[10]=array("Error 404","Dashboard","List Students","Change Password",
"Manage Schedule-TL","MANAGE SCHEDULE PARENT","Student Classes","Payment Record Report",
"Teacher TL Report","Freeze List","Signup Report","List App-Teacher-Agent","Leave App New",
"Short Leave App New","Short List App-Teacher","Manage Schedule");

/////////////////////////////////Agent Permissions//////////////////////////
$_permission[5]=array("Error 404","Short Leave App New","Short List App-Teacher","List App-Teacher-Agent","Leave App New","Student Classes","Chat Panel","Chat Panel to chat","Notice Teachers Manual","SOP discipline","SOP","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","List Students","New Students","Error 404","Dashboard","List Schedule","Manage Schedule","New Schedule","Change Password","List Callbacks","New Callback","Edit Callbacks");

///////////////////////////////// Super Admin Permissions/////////////////////////////////////
$_permission[1]=array("Error 404","Transaction Approve","Transaction Reject","Order Meal List","Order Meal New","Pend Rpt Ver4-overall","Month Start End Report TTL Delete","Month Start End Report TTL Edit","Month Start End Report TTL","Month Start End Report","Ticket Close","Ticket Conversation","Ticket List","Transaction Student Report Detailed","Grade-Syllabus","Emp Arrears List","Emp Gift Fine List","Biometric Edit Teacher Month Business","Teacher Month Business and Biometric","Parent Delete","MANAGE SCHEDULE AND PR OVERALL LINK","Agent TRIAL SIGNUP","Salary + Commision MANAGEMENT","Pending DATE FILTER","Paypal invoice details","FileUpload","Salary + Commision","Leave Apply by IT","Leave Apply by PA","MANAGE SCHEDULE PARENT","Parent List","Parent New","Parent Edit","Parent Assign","Students UserPass Edit","Students UserPass List","Daily Schedule Student","Meeting Link List","Meeting Link New","Meeting Link Edit","Meeting Link Delete","Email Student List","Email Student Edit","Agent Dialing Report","Incentive-Fee Raise Delete","Incentive-Fee Raise","Short Leave App New","Short List App-Teacher","Short List App-Teacher Delete","Short List App-TL","Short List App-HR","Leave Apply by TL","Teacher's Recurring VER2","MakeOver Class Duplication","Teacher TL Report OLD","Extension Delete","Extension Edit","Extension New","Extension List","Paypal Upload","Paypal Output with PRR","Paypal List","Paypal Import","Teamlead Target New","Teamlead Target Edit Val","Teamlead Target List Val","Teamlead Target List","Business Sheet Trial Upload","Business Sheet Trial Import","Business Sheet Dashboard-CronJob","Business Sheet Dashboard","Teacher TL Report VER2","Payment Record Report Edit","Class Attendance Manual","Biometric Delete","Biometric List","Biometric Upload","Biometric Import","Chat Panel","Chat Panel to chat","List App-Teacher Delete","TransferToLHR schedule","From TransferToLHR Schedule","TransferToLHR List","TL Confirm List","Agent Commision","Payment Record Report Delete","List App-HR","List App-GM","List App-TL","List App-Teacher-Agent","Leave App New","Transaction new next next month","Commision Recurring","Commision Signup","Commision Ref","List Message","New Message","Edit Message","Transaction List Due Payments"/*,"Assessment Success Submit","Assessment List"*/,"Notice Teachers Manual","Assignments List","Assignments New","Assignments Edit","Assignments Delete","Main Reports","Unfreeze Schedule","Freeze schedule","Freeze List","SOP discipline","SOP","Memo referral/commision","Memo Present absent","Class Days Business","Main Team Lead Selection","Comments General","Teacher Trial Status","Daily Sch-Recurring","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Available Teacher","List Emp Salary","New Emp Salary","List Emp Salary RESULT","Pending report-overall","Transaction new next month","Pending report","Manage Schedule-Group","New Schedule-Group","Edit Schedule-Group","Transaction Ver2","Transaction Edit VER2","Regular Class Stat","Teacher Basic Info","List Employees","New Employees","Edit Employees","Payment Record Report","Manage Schedule-TL","TeamLead Summary","Dead Confirmation Message","Present/Absent Report","Dead Confirmation List","List Logging","Daily Schedule Ver2","Manage Schedule Ver2","Total Payments VER2","Team Lead Selection","Teacher TL Report","Agent TL Report","List Due Payments","Signup Report","Agent Report","Student Classes","New Payments","Delete Skype IDs","Edit Skype IDs","New Skype IDs","List Skype IDs","Trial Report","List Callbacks","New Callback","Edit Callbacks","Delete Callbacks","Edit Payments","Total Payments","List Payments","Class Attendance","Transaction Details","Change Password","Daily Schedule","Trial Confirmation List","Confirm Schedule","Dashboard","List User","New User","Edit User","Delete User","List User Type","New User Type","Edit User Type","Delete User Type","List Teacher Timings","New Teacher Timings","Edit Teacher Timings","Delete Teacher Timings","List Schedule","New Schedule","Edit Schedule","Manage Schedule","Delete Schedule","Dead Schedule","List Students","New Students","Edit Students","Delete Students","List Teacher's Course","New Teacher's Course","Edit Teacher's Course","Delete Teacher's Course");

///////////////////////// Admin Permissions//////////////////////////////
$_permission[2]=array("Error 404","Freeze List","Biometric List","List App-HR","Student Classes",
"Teacher TL Report VER2","Teamlead Target List","Business Sheet Dashboard","SOP discipline",
"SOP","Memo referral/commision","Memo Present absent","Notice ceo meeting time",
"Daily Schedule Ver2","Memo","Notice documents","Notices","List Teacher Timings",
"Leave Policy","Policies","Agent TL Report","Regular Class Stat","Pending report-overall",
"Payment Record Report","Manage Schedule-TL","Teacher TL Report","New Schedule",
"Manage Schedule Ver2","Signup Report","Agent Report","Student Classes",
"Trial Report","Total Payments",
"Present/Absent Report"/*,"Edit Skype IDs","New Skype IDs","List Skype IDs","Trial Report",
"List Callbacks","New Callback","Edit Callbacks","Delete Callbacks","Edit Payments"*/,
"List Payments"/*,"Total Payments","Transaction Details"*/,"Daily Schedule",
/*"Class Attendance",*/"Dashboard"/*,"Confirm Schedule","Trial Confirmation List","List User",
"New User","List User Type","New User Type","Edit User Type","Delete User Type",
"List Teacher Timings","New Teacher Timings","Edit Teacher Timings",
"Delete Teacher Timings","List Schedule","New Schedule"*/,
"Manage Schedule","List Students","Change Password"/*,"New Students",
"Edit Students","List Teacher's Course","New Teacher's Course","Edit Teacher's Course"*/,
"Daily Sch-Recurring","Teacher Trial Status","Class Days Business","Teacher's Recurring VER2",
"Salary + Commision","Agent TRIAL SIGNUP","Pending DATE FILTER",);

/////////////////////////////////HR Permissions//////////////////////////				///NEWLY ADDED
$_permission[11]=array("Error 404","Teacher Month Business and Biometric","Payment Record Report","Biometric Edit Teacher Month Business","Leave App New","Short Leave App New","Pending report-overall","Short List App-HR","Biometric Delete","Biometric List","Biometric Upload","Biometric Import","Chat Panel","Chat Panel to chat","List App-HR","List Message","New Message","Edit Message","SOP discipline","SOP","Memo referral/commision","Memo Present absent","Notice ceo meeting time","Memo","Notice documents","Notices","List Teacher Timings","Edit Teacher Timings","Teacher Basic Info","Leave Policy","Policies","List Employees","New Employees","Edit Employees","Change Password","Dashboard");


/////////////////////////////////PA to CEO Permissions//////////////////////////				///NEWLY ADDED	//30-07-2013
$_permission[12]=array("Error 404","Salary + Commision MANAGEMENT","Teacher TL Report","Emp Arrears List","Teacher TL Report OLD","Meeting Link List","Manage Schedule-TL","Pending report-overall","Freeze List","Leave App New","Short Leave App New","List App-HR","Leave Apply by PA","Payment Record Report","Teacher TL Report VER2","Manage Schedule","Regular Class Stat","Student Classes","Biometric List","Dashboard");

/////////////////////////////////Quran - Read Only//////////////////////////				///NEWLY ADDED	//30-07-2013
$_permission[13]=array("Error 404","SOP discipline","SOP","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Manage Schedule","Dashboard");

/////////////////////////////////NEW//////////////////////////				///NEWLY ADDED	//17-08-2013
$_permission[14]=array("Error 404");

///////////////MAIN Teacher Team Lead Permissions/////////////////	///NEWLY ADDED	//06-11-2013
$_permission[15]=array("Error 404","Extension List","Pend Rpt Ver4-overall","Email Student List","Month Start End Report TTL Edit","Month Start End Report TTL","Month Start End Report","Ticket Close","Ticket List","Payment Record Report Delete","Transaction Student Report Detailed","MANAGE SCHEDULE PARENT","Edit Students","Dead Confirmation Message","Dead Schedule","List App-GM","TL Confirm List","Unfreeze Schedule","Freeze schedule","Freeze List","Leave App New","Short Leave App New","Dead Confirmation List","Parent List","Parent New","Parent Edit","Parent Assign","Meeting Link List","Meeting Link New","Meeting Link Edit","Short List App-TL","Teacher TL Report OLD","Chat Panel","Chat Panel to chat","List App-TL","Transaction new next next month","New Students","Regular Class Stat","Notice Teachers Manual","SOP discipline","SOP","Memo referral/commision","Comments General","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Pending report-overall","Transaction new next month","Transaction List Due Payments","Pending report","Payment Record Report","List Due Payments","New Payments","Total Payments","Dead Confirmation Message","Present/Absent Report","Daily Schedule Ver2","Teacher TL Report","Dashboard","Daily Schedule","List Schedule","Change Password","Class Attendance","Manage Schedule","List Students","Student Classes","Edit Schedule","New Schedule","List Teacher Timings","Edit Teacher Timings","List Teacher's Course","Trial Report","Trial Confirmation List","Confirm Schedule","Transaction Details");

//////////////MAIN Agent Team Lead Permissions///////////////////	///NEWLY ADDED	//06-11-2013
$_permission[16]=array("Error 404","TL Confirm List","Unfreeze Schedule","Freeze List","Leave App New","Short Leave App New","Chat Panel","Chat Panel to chat","New Schedule-Group","Notice Teachers Manual","SOP discipline","SOP","Comments General","Notice ceo meeting time","Memo","Notice documents","Notices","Leave Policy","Policies","Payment Record Report","Agent TL Report","List Students","New Students","Error 404","Dashboard","List Schedule","Manage Schedule","New Schedule","Change Password","List Callbacks","New Callback","Edit Callbacks","Trial Confirmation List","Confirm Schedule","Edit Schedule","Dead Confirmation Message"/*,"Dead Schedule"*/,"Transaction Details","Edit Skype IDs","New Skype IDs"/*,"List Skype IDs"*/);

///////////////////////////////// IT Permissions///////////////////////////////////// //05-08-2015
$_permission[17]=array("Error 404","List App-TL","Short List App-Teacher","Leave App New","Short Leave App New","List App-HR","Leave Apply by IT","Extension Edit","Extension New","Extension List","Change Password","Dashboard");

///////////////////////////////// QC Permissions///////////////////////////////////// //16-02-2016
$_permission[18]=array("Error 404","Parent Edit","Parent New","Parent List","Confirm Schedule","List Students","New Students","New Schedule","Trial Confirmation List","Payment Record Report","Transaction Details","Manage Schedule","Leave App New","Short Leave App New","Dead Confirmation List","Regular Class Stat","Teacher TL Report","Biometric List","Student Classes","Change Password","Dashboard");


/////////////////// End Group Permissions//////////////////////////
//print_r($_SERVER);
$_current=explode('/',$_SERVER['REQUEST_URI']);
$_current=explode('?',$_current[sizeof($_current)-1]);
$_current=$_title[$_current[0]];
if(empty($_current)){
$_current="Dashboard";
}
if(!in_array($_current,$_permission[$_SESSION['userType']])){
$_current="Error 404";
	header('Location:404.php');
	exit;
}
include('include/function-inc.php');


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title>CloudcCampus Managment System</title>
        <link rel="stylesheet" href="css/style_all.css" type="text/css" media="screen" />
        <script type="text/javascript" src="lib/ajax_framework.js"></script>
        
        
        <!-- to choose another color scheme uncomment one of the foloowing stylesheets and wrap styl1.css into a comment -->
        <!--<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen" />-->
		<link rel="stylesheet" href="css/style6.css" type="text/css" media="screen" />  
        
        
        <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="screen" />
        
        <!--Internet Explorer Trancparency fix-->
        <!--[if IE 6]>
        <script src="js/ie6pngfix.js"></script>
        <script>
          DD_belatedPNG.fix('#head, a, a span, img, .message p, .click_to_close, .ie6fix');
        </script>
        <![endif]--> 
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> PREVIOUSLY USED FROM ONLINE-->
		<script type='text/javascript' src='js/jquery.min.js'></script><!-- This is for jquery auto calculations in textboxes, emp_payroll_new.php-->
        <?php include('include/js-function-inc.php'); ?>
        <script type='text/javascript' src='js/jquery.js'></script>
        <script type='text/javascript' src='js/jquery-ui.js'></script>
        <script type='text/javascript' src='js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='js/custom.js'></script>
        <script type='text/javascript' src='js/jquery.maskedinput-1.3.js'></script>
		<!--<script type="text/javascript" src="http://cdn.dev.skype.com/uri/skype-uri.js"></script>-->
		<link rel="stylesheet" href="images/slimbox2.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/slimbox2.js"></script>
		<script type="text/javascript" src="js/moment.js"></script>
	</head>
    
    <body>
    	<!-- this is the content for the dialog that pops up on window start -->
    	<div id="dialog" title="Welcome to yourCloudCampus Admin">
       	<p>Hello admin! welcome back.<br/> You got <strong>1 new Message</strong> in your inbox</p>
        <p>This is a messagebox, you can fill it with content of your choice ;)</p>
        </div>
        
        <div id="top">
        
            <div id="head">
            	<!--<h1 class="">-->
				<div id="ccms">
                	<a href="index.php" >CCMS<span style="font-size:16px" ></span></a>
					<!--<a href="images/ycc_logo.jpg" id="header_note"  target="_blank" rel="lightbox[roadtrip]" title="<span style='color:black'> 1) Everyone will use this format for their names on Skype ID (Name/Designation/YCC). <br><br> 2) Everyone will use YCC logo image on their Display Images.(hope so you have the logo with you) <br><br> 3) Teachers will use the following quotation on their Skype Status. (What we want is to see the child in pursuit of knowledge, and not knowledge in pursuit of the child. -George Bernard Shaw). <br><br> 4) Agents will use the following quotation on their Skype Status. (Today is always the most productive day of your week. – Mark Hunter). <br><br> 5) For any assistance - Contact your TEAMLEAD">ALERT:Skype ID Images/Quotes-Fine as per policy, Click here</a>-->
					<!--<a href="images/restrictions_image.jpg" id="header_note"  target="_blank" rel="lightbox[roadtrip]" title="<span style='color:black'> 1) During END CLASS - Lecture Image Upload is Mandatory. <br><br> 2) Only ALPHABETS are allowed in LESSON DETAILS and COMMENTS, No character and digits are allowed. <br><br> 3) END CLASS button will remain DEACTIVATED until the class duration is 50 minutes or more. <br><br> 4) FOR ANY ASSISTANCE contact Mr.FAHEEM(AGM) OR Hafiz Ahmad(REPORTING OFFICER cum TEAMLEAD)">ALERT: New restrictions have been implemented in CCMS</a>-->
				</div>
				
				<div id="slider2" style="width: 250px; height: 210px; overflow: hidden;">
					<ul style="width: 3480px;">
					<li style="float: left; border-radius:15px 15px 15px 15px;">
					<a href="#">
					<!--<img alt="Css Template Preview" src="" width="250px" height="150px">-->
					</a>
					<p style="margin:5px"></p><br>
					
					</li>
					
					
					</li>
					</ul>
				</div>

					
				<!--</h1>-->
				
                
                <div class="head_memberinfo">
					<!--MEMO for Attendance - -->
                    <!--<a id="" class="dashboard_button_blink button15 myDivblue" href="ZF_policies.php">
						<span class="dashboard_button_heading_blink">ZF Policies And Notice</span>
						<span style="color:red"><b><br>Dated(17-05-2018)</b></span>
					</a>-->
					<!--end dashboard_button-->
					
                	<div class="head_memberinfo_logo">
                    	<span>1</span>
                    	<img src="images/unreadmail.png" alt=""/>
                    </div>
                    
                    <span class='memberinfo_span'>
                   		 Welcome <a href=""><?php echo $_SESSION['userName']."[".$_SESSION['voice_id']."]";?></a>
                    </span>
                   
                    <span class='memberinfo_span'>
                    	<a href="changepassword.php">Change Password</a>
                    </span>
                    
                    <span>
                    	<a href="logout.php">logout</a>
                    </span>
                    
                    <span class='memberinfo_span2'>
						<?php   
							$result_non_read_msgs = mysql_query("SELECT * FROM `chat` WHERE `toID` = '".$_SESSION['userId']."' and 
							`recd` = 0 "); 
							$row_count_non_read_msgs = mysql_num_rows($result_non_read_msgs);
						if($row_count_non_read_msgs!=0) {
						//echo "<EMBED SRC=\"musicw.wav\" HIDDEN=\"TRUE\" AUTOSTART=\"TRUE\"></EMBED>";
						?>
						<!-- Audio controls //START--> 
						<audio autoplay loop>
							<source src="PhoneRinging.mp3" type="audio/mp3">
						</audio>
						<!-- Audio controls //END-->
                    	<a href="#" class="dashboard_button_blink button15 myDivblue">
							<span class="dashboard_button_heading_blink"><b><?php echo $row_count_non_read_msgs;  ?></b> Private Message recieved</span>
						</a>
							<?php 
								$sql_receive_msg_count = "SELECT chat.*,fromID,count(fromID) as counter FROM `chat` WHERE toID='".$_SESSION['userId']."' and recd=0 GROUP BY fromID " or die(mysql_error()); 
								$result_receive_msg_count = mysql_query($sql_receive_msg_count) or die(mysql_error()); 
								// Print out result
								while($row_receive_msg_count = mysql_fetch_array($result_receive_msg_count)){
									echo "<a href='chat_panel_to_chat.php?id={$row_receive_msg_count['fromID']}' style='font-size:14px; color:#ff7802'>".$row_receive_msg_count['from']."-". $row_receive_msg_count['to']. " - ". $row_receive_msg_count['counter']." message</a>";
									echo "<br />";
								}
							
							} else{ ?>
						<a href="chat_panel_to_chat.php"><b> <? echo $row_count_non_read_msgs;  ?></b> Private Message recieved 
						</a> - <a href="chat_panel_to_chat.php">Chat Panel</a><? } ?>
						
					</span>
						
						<!--MEMO for Attendance - -->
						<!--<a id="" class="dashboard_button_blink button15 myDivblue" href="ZF_policies.php">
											<span class="dashboard_button_heading_blink">ZF Policies And Notice</span>
											<span style="color:red"><b><br>Dated(17-05-2018)</b></span>
						</a>--><!--end dashboard_button-->

                </div><!--end head_memberinfo-->
            
            </div><!--end head-->
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content" <? if($_current=='List Schedule') echo "class='overflow'"?>>
                        <div class="jquery_tab_container">
                                <a class="heading_tab advanced_link active tab1" href="/"><?php echo $_current;?></a>
                                
                        </div>
                         <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title"><?php echo $_current;?></h2>