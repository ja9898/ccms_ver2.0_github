<? 
include('config.php'); 
include('include/header.php');

if(isset($_POST['submit']))
{
	
	echo $fromDate=date('d',strtotime($_POST['fromDate']));
	echo "<br>";
	echo $fromMonth=date('n',strtotime($_POST['fromDate']));
	echo "<br>";
	echo $fromYear=date('Y',strtotime($_POST['fromDate']));
	echo "<br>";
	
	echo $fromdaysss=date('t',strtotime($_POST['fromDate']));
	echo "<br>";
	echo "<br>";
	
	echo $toDate=date('d',strtotime($_POST['toDate']));
	echo "<br>";
	echo $toMonth=date('n',strtotime($_POST['toDate']));
	echo "<br>";
	//Added for FEB dates of 30th and 31st/////////////////////////////
	/* if($toMonth==02 && $fromMonth==02 && $fromDate>=01 && $toDate<=29) //USE IT LATER
	{
		echo "F1**".$fromDate=date('d',strtotime($_POST['fromDate']));
		echo "F2**".$toDate=31;
		echo "F3**".$toMonth=02;
	} */
	echo $toYear=date('Y',strtotime($_POST['toDate']));
	echo "<br>";
	echo "<br>";
	
	//Current year and the current month is NOT JAN
	echo "pre mon";
	echo $curr_mon_sub_one = date('n')-1;
	echo "<br>";
	//Current year and the current month is JAN
	echo "if curr month is JAN and pre mon will be DEC(12) not 0-with pre year ***";
	if($curr_mon_sub_one==0)
	{
		echo $curr_mon_sub_one=12;
		echo "<br>";
	}

	echo "curr mon";
	echo $curr_mon = date('n');
	echo "<br>";
	
	//Current year and the current month is NOT DEC
	echo "next mon-without next year condition";
	echo $curr_mon_add_one = date('n')+1;
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	echo $curr_year_minus_one = date('Y')-1;
	echo "<br>";
	//Current year and the current month is DEC
	echo "if curr month is DEC and next mon will be JAN(1) not 13-with next year ***";
	if($curr_mon_add_one==13)
	{
		echo $curr_mon_add_one=1;
		echo "<br>";
	}
	echo "<br>";
	
//Pre month + curr month && curr month + next month
if($toMonth > $fromMonth && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	    
		
		//TEAMLEAD FILTERS
		if($_SESSION['userType']==8)
		{
			
			if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				echo "loop-loop111-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
				

			}
			//curr month + next month
			if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				echo "loop-loop222-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//Pre month + curr month
			if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//curr month + next month
			if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			
			
		}
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			
			if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				echo "MAIN TTL";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
				
			}
			//curr month + next month
			if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				echo "MAIN TTL - loop-loop222-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//Pre month + curr month
			if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//curr month + next month
			if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			
			
		}
		else
		{
			if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0)
			{
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1XX";
					echo "<br>";
					echo $sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					echo $sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate." 
					order by paydayz DESC";
					
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			//MAIN TEACHER TEAMLEAD
			else if(!empty($_POST['search-teacher-main']) && $_POST['search-teacher-main']!=0)
			{
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1XX";
					echo "<br>";
					echo $sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					echo $sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate." 
					order by paydayz DESC";
					
					/*$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";*/
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			else
			{
				//Pre month + curr month
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
					
					/*$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";*/
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
		}
 
}

//*******************************************************************************************
//Pre month + curr month && curr month + next month - IN CASE OF YEAR CHANGE e.g from 2013 to 2014
else if($toMonth < $fromMonth && $toYear>$fromYear && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	    
		
		//TEAMLEAD FILTERS
		if($_SESSION['userType']==8)
		{
			
			if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				echo "loop-loop111-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
				

			}
			//curr month + next month
			if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				echo "loop-loop222-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//Pre month + curr month
			if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//curr month + next month
			if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			
			
		}
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			
			if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				echo "MAIN TTL";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
				
			}
			//curr month + next month
			if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				echo "MAIN TTL - loop-loop222-1";
				echo "<br>";
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//Pre month + curr month
			if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			//curr month + next month
			if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one && empty($_POST['search-teacher-id2']))
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) <=31 
				order by paydayz DESC";
				
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
				$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
				order by paydayz DESC";
			}
			
			
		}
		
		
		//*** for PUT ELSE IF HERE LATER for MAIN TEACHER TEAMLEAD //NOT NOW
		
		else
		{
			if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0)
			{
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1XX";
					echo "<br>";
					echo $sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					echo $sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate." 
					order by paydayz DESC";
					
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "curr_month=12 AND next_month=1(NOTE THE YEAR CHANGE)";
					echo "<br>";
					echo $sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			else
			{
				//Pre month + curr month
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
					
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
		}
 
}
//************************************************************************************************





//Pre month + Pre month
else if($toMonth == $fromMonth && $toMonth==$curr_mon_sub_one && $fromMonth==$curr_mon_sub_one)
{
		if($_SESSION['userType']==8)
		{
			if($fromDate <= $toDate)
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
				order by paydayz DESC";
				
			}
		}
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			if($fromDate <= $toDate)
			{
				$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
				order by paydayz DESC";
				
			}
		}
		
		else
		{
			if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0)
			{
				if($fromDate <= $toDate)
				{
					echo "loop-curr-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
				}
			}
			
			//MAIN TEACHER TEAMLEAD
			else if(!empty($_POST['search-teacher-main']) && $_POST['search-teacher-main']!=0)
			{
				if($fromDate <= $toDate)
				{
					echo "loop-curr-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
				}
			}
			else
			{
				if($fromDate <= $toDate)
				{
					echo "loop-curr-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
				}
			}
		}
 
}

//curr month + curr month
else if($toMonth == $fromMonth && $fromMonth==$curr_mon && $toMonth==$curr_mon && !empty($_POST['toDate'])){
	//Added for FEB dates of 30th and 31st/////////////////////////////
	/* if($toMonth==02 && $fromMonth==02 && $fromDate>=01 && $toDate<=29) USE IT LATER
	{
		echo "HA1".$fromDate=date('d',strtotime($_POST['fromDate']));
		echo "HA2".$toDate=31;
		echo "HA3".$fromdaysss=31;
		echo "HA4".$toMonth=02;
	}
	else
	{ */
		$toDate=date('d',strtotime($_POST['toDate']));
	/* } */
	//////////////////////////////////////////////////////////////////
		if($_SESSION['userType']==8)
		{
			$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			month(campus_schedule.paydate) AS paymonth,
			year(campus_schedule.paydate) AS payyear,
			
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			//NEWLY ADDED - Pre month pending after applying CURR MONTH FILTERS 16-05-2014
			$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,
				campus_schedule.teacherID,


				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
				day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
				order by paydayz DESC";
				
			$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			month(campus_schedule.paydate) AS paymonth,
			year(campus_schedule.paydate) AS payyear,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		else
		{
			if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0)
			{
				if($fromDate <= $toDate)
				{
					echo "loop-loop111-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					echo "loop-loop222-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
			//MAIN TEACHER TEAMLEAD
			else if(!empty($_POST['search-teacher-main']) && $_POST['search-teacher-main']!=0)
			{
				if($fromDate <= $toDate)
				{
					echo "loop-loop111-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					echo "loop-loop222-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
			else
			{
				if($fromDate <= $toDate)
				{
					echo "loop-loop111-2-elseonly";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=  31 ";
					if($fromMonth==1 && $toMonth==1)
					{
						//$sql_pre.=" and year(campus_schedule.paydate) = '".$curr_year_minus_one."' ";
					}
					$sql_pre.="order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
					
					
					
					
					
					
					
					
					
					
					
					foreach($_POST['stateunderID'] as $team_under_index){
					//echo $team_lead_id;echo "<br>";
					//echo $team_under_index."TLID-MIDDLE ONE<br>";
					//Following is Pre Month pending
					//echo "PENDING SEPARATE - NOW PRE MONTH - MIDDLE";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$team_under_index."' and 
					capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					//Following is CURR month pending
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$team_under_index."' and 
					capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN '1' AND '10' 
					order by paydayz DESC";
					
					
}					
					
					
					
					
					
					
					
					
					
					
				}
				//else if()
				else
				{
					echo "loop-loop222-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
		}
 
}


//NEXT month + NEXT month
else if($toMonth == $fromMonth && $fromMonth==$curr_mon_add_one && $toMonth==$curr_mon_add_one && !empty($_POST['toDate'])){
	//Added for FEB dates of 30th and 31st/////////////////////////////
	/* if($toMonth==02 && $fromMonth==02 && $fromDate>=01 && $toDate<=29) USE IT LATER
	{
		$fromDate=date('d',strtotime($_POST['fromDate']));
		$toDate=31;
		$fromdaysss=31;
		$toMonth=02;
	}
	else
	{ */
		$toDate=date('d',strtotime($_POST['toDate']));
	/* } */
	//////////////////////////////////////////////////////////////////
		if($_SESSION['userType']==8)
		{
			$sql2="SELECT capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			$sql2="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		else
		{
			if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0)
			{
				if($fromDate <= $toDate)
				{
					//echo "loop-NEXT-TL-Only-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					
					//echo "loop-NEXT-TL-Admin-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
			//MAIN TEACHER TEAMLEAD
			else if(!empty($_POST['search-teacher-main']) && $_POST['search-teacher-main']!=0)
			{
				if($fromDate <= $toDate)
				{
					
					//echo "loop-NEXT-TL-Only-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					
					//echo "loop-NEXT-TL-Admin-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			else
			{
				if($fromDate <= $toDate)
				{
					
					//echo "SA-all";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					
					//echo "SA-all-2";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
		}
 
}

else
{
	if($_SESSION['userType']==8)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.teacherID,
		campus_schedule.`status` 

		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
		order by paydayz DESC";
		
		$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.teacherID,


		campus_schedule.`status` 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
		order by paydayz DESC";
	}
	//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
	else if($_SESSION['userType']==15)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.teacherID,
		campus_schedule.`status` 

		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
		order by paydayz DESC";
		
		$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.teacherID,


		campus_schedule.`status` 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
		order by paydayz DESC";
	}

	else
	{
		if(!empty($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!=0 && empty($_POST['fromDate']) && empty($_POST['toDate']))
		{
			//echo "TL";
			$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
			order by paydayz DESC";
			
			
			//echo "TL";
			$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
			order by paydayz DESC";
		}
		
		//MAIN TEACHER TEAMLEAD
		else if(!empty($_POST['search-teacher-main']) && $_POST['search-teacher-main']!=0 && empty($_POST['fromDate']) && empty($_POST['toDate']))
		{
			//echo "TL";
			$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
			order by paydayz DESC";
			
			
			//echo "TL";
			$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
			order by paydayz DESC";
		}
		else
		{
			//echo "no TL";
			$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
			order by paydayz DESC";
			
			//echo "no TL";
			$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.teacherID,


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
			day(campus_schedule.paydate) <=  31 
			order by paydayz DESC";

		}
		
		
	}

}
//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
}



?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
if($_SESSION['userType']==1)
{
//getTeacherFilterLead_main();
//getTeacherFilterLead();
}







//TL DROPDOWN
$availableTeam_LeadUnder_query_A=("SELECT * FROM capmus_users WHERE user_type=8 and status=1 order by firstName ASC"); //Query for Available Teachers
$result_A=mysql_query($availableTeam_LeadUnder_query_A);
while ($row1 = mysql_fetch_array($result_A))
   {
    //echo "<tr><td>";
    //echo "<input type='checkbox' name='stateunder' value =''";
    //echo " />";
	//echo $row['id'];
	
    $_LISTTEAM_A[$row1['id']]=$row1['firstName']." ".$row1['lastName']."<br>";
    //echo "</td></tr><br/>";
	//$_LIST['team_members']=$row['firstName'];
	//echo $_LISTTEAM
   }
   
   
   
   
   
   
   
   
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter">

<br><br>
TEAMLEADS:
<br><hr>
<?php echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM_A);?><!-- Available Teachers/Agents -->

</form>
<br /><br />
</div>

<? 




//CURRENT MONTH		//1st till 10th
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS(1st till 10th)</div>";

echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt' colspan=12 align='center' style='font-size:18px; color:Blue'>".date('M')."</th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>TEAMLEAD NAME</th>"; 

echo "<th class='specalt'>TOTAL TARGET MANUAL</th>"; 

echo "<th class='specalt'>Pre Pending-USD</th>";  
echo "<th class='specalt'>Curr Pending-USD</th>";  
echo "<th class='specalt'>TOTAL Pending Sum-USD</th>";  
echo "<th class='specalt'>Received Amount-USD</th>"; 
/* echo "<th class='specalt' style='color:red; font-weight:bold'>Remaining Amount PEND SUB-USD</th>"; */
echo "<th class='specalt' style='color:green; font-weight:bold'>Remaining Amount TRGT SUB-USD</th>"; 
echo "<th class='specalt'>Per Day</th>";
echo "<th class='specalt'>Advance Received</th>";
echo "<th class='specalt'>Dead Amount</th>";
echo "<th class='specalt'>Dead %</th>";

echo "<th class='specalt'>Freeze Amount</th>";
echo "</tr>";

//TOTAL TARGET MANUAL
$total_target_sum_ary=array();

//PRE PENDING ARRAYS
$amount_pre=array();
$recieved_pre=array();
$pending_pre =array();
$pending_pre_2nd_array =array();
$signups_pre =array();
$discount_pre =array();
$pending_usd_convert_pre=array();
//Array for LOOP FOR TEAMLEADS
$sum_teamlead_each=array();
$total_sum_teamlead_each=array();
$sum_teamlead_each_USD=array();
$total_sum_teamlead_each_USD=array();

//CURR PENDING ARRAYS
$amount=array();
$recieved=array();
$pending =array();
$signups =array();
$discount =array();
$pending_usd_convert=array();
//Array for LOOP FOR TEAMLEADS
$sum_teamlead_each_curr_1to10=array();
$total_sum_teamlead_each_curr_1to10=array();
$sum_teamlead_each_curr_1to10_USD=array();
$total_sum_teamlead_each_curr_1to10_USD=array();

//TOTAL PENDING SUM,  PRE + CURR
$total_pre_curr_pending_SUM_ary=array();

//Total Received
$total_received_ary=array();

//Total Remaining = TOTAL TARGET[Total Pending] - TOTAL RECEIVED
$total_remaining_pend_ary=array();
$total_remaining_trgt_ary=array();

//Total Received - NEXT 3 MONTHS
$total_received_ary_next_3_months=array();

//DEAD AMOUNT
$total_dead_amount_ary=array();

//FREEZE AMOUNT
$total_freeze_amount_ary=array();

if(isset($_POST['submit']))
{

	/////////////****************** PER DAY CALCULATION CODE ********************///////////////////////
//DAYS CALCULATIONS WITHOUT SUNDAYS - WHOLE MONTH
	$fromDate_per_day_month_days = date('Y-m-01');
	$toDate_per_day_month_days = date('Y-m-t'); 
	$date1 = $fromDate_per_day_month_days;
	$date2 = $toDate_per_day_month_days;
	# Do some checks here for valid dates and to make sure date1 is less than date2 
	# Time strings 
	$time1 = strtotime($date1); 
	$time2 = strtotime($date2); 

	$total_month_days_without_SUNDAY = 1; 
	while($time1 < $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $total_month_days_without_SUNDAY++;

	   $time1 += 86400; # Add a day 
	} 
	$total_month_days_without_SUNDAY;
	//echo ' days between '.$date1.' and '.$date2;

//DAYS CALCULATIONS WITHOUT SUNDAYS - TILL DAY/DATE	
	$fromDate_per_day_passed_days = date('Y-m-01');
	$toDate_per_day_passed_days = date('Y-m-d'); 
	$date1 = $fromDate_per_day_passed_days;
	$date2 = $toDate_per_day_passed_days;
	# Do some checks here for valid dates and to make sure date1 is less than date2 
	# Time strings 
	$time1 = strtotime($date1);
	$time2 = strtotime($date2);

	$total_passed_days_without_SUNDAY = 1; 
	while($time1 < $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $total_passed_days_without_SUNDAY++;

	   $time1 += 86400; # Add a day 
	} 
	$total_passed_days_without_SUNDAY;
	//echo ' days between '.$date1.' and '.$date2;
	/////////////************************************ \********************///////////////////////

$counter_for_teamlead_sum = 1;
foreach($_POST['stateunderID'] as $team_under_index){		//LOOP FOR TEAMLEADS curr month		//START				
					/* echo "CURRENT 1 SEPARATE - NOW 1st to 10th";
					echo "<br>"; */
//TOTAL TARGET SUM 
	//Target Amount SUM - TEACHER TEAMLEADS
	$sql_target_amount_sum="SELECT id,user_type,fromDate,LeadId,amount as target_amount_sum FROM campus_target_table 
	WHERE LeadId!=0 AND user_type=8 AND LeadId='".$team_under_index."' and 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND '".date('m',strtotime($_POST['toDate']))."' = month(campus_target_table.fromDate)) and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."'AND '".date('Y',strtotime($_POST['toDate']))."' = year(campus_target_table.fromDate)) and campus_target_table.fromDate!='' ";
	$result_target_amount_sum=mysql_query($sql_target_amount_sum) or die(mysql_error());
	$target_amount_sum = array();
		while($row_target_amount_sum = mysql_fetch_array($result_target_amount_sum)){ 
		//$total_target_amount_array[$row_target_amount_sum['id']] = $row_target_amount_sum['amount'];
		$target_amount_sum[$row_target_amount_sum['id']] = $row_target_amount_sum['target_amount_sum'];
	}
	


	echo "<tr>";
	echo "<td valign='top' style='color:black; font-weight:bold'>".showUser( nl2br( $team_under_index))."</td>";

	//TOTAL TARGET SUM
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . $total_target_sum_ary[$team_under_index] = array_sum($target_amount_sum) . "</td>";
		
					
					
//PENDING , PRE MONTH				
$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,
					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$team_under_index."' and
					capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";

	$result_pre = mysql_query($sql_pre) or trigger_error(mysql_error()); 
	while($row_pre = mysql_fetch_array($result_pre)){ 
	foreach($row_pre AS $key => $value) { $row_pre[$key] = stripslashes($value); }

	//http://www.w3schools.com/sql/func_date_sub.asp	SUBTRACTING 1 MONTH from date in mysql query
	//http://www.plus2net.com/sql_tutorial/date-lastweek.php


	$countresult_pre=$row_pre['amount'];

	$date_subtracted = date('n') - 1;
	//For ORIGINAL AMOUNT[amount_original]
	$date_subtracted_amount_original = date('n') - 3;
	if($date_subtracted==0)
	{
		$date_subtracted=12;
		$year_subtracted=$curr_year_minus_one;
		//For ORIGINAL AMOUNT[amount_original]
		$date_subtracted_amount_original=12-3;
	}
	else
	{
		$year_subtracted=date('Y');
	}
	$countmonthsql_pre="select amount as amounttran, discount_tran 
	FROM campus_transaction 
	where month(dateRecieved)='".$date_subtracted."' and year(dateRecieved)='".$year_subtracted."' and 
	studentID=".$row_pre['studentID']." and schedule_id=".$row_pre['id'].""; 
	if($fromMonth==1 && $toMonth==1)	//NEWLY ADDED 10-01-2014
	{
		//$countmonthsql_pre.= " and year(dateRecieved)='".$curr_year_minus_one."' ";
	}
	
	
	$countmonthesult_pre=mysql_query($countmonthsql_pre) or die(mysql_error());
	$countmonthesult_pre=mysql_fetch_assoc($countmonthesult_pre);


	$maxdate_rec_pre="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_pre['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_pre['id'].""; 
	$maxdate_rec_result_pre=mysql_query($maxdate_rec_pre) or die(mysql_error());
	$maxdate_rec_result_pre=mysql_fetch_assoc($maxdate_rec_result_pre);

	//if the student pays his fee late more than 5 days he should be red in the coming month pending
	$five_days_red = strtotime($maxdate_rec_result_pre['date_rec_cam_tran']) - strtotime($maxdate_rec_result_pre['maxdate_rec']);
	$five_days_red = floor($five_days_red/(60*60*24));

	$amount_pre[$row_pre['id']]=$countresult_pre;
	$recieved_pre[$row_pre['id']]=$countmonthesult_pre['amounttran'];
	$pending_pre[$row_pre['id']]=$countresult_pre-$countmonthesult_pre['amounttran']-$countmonthesult_pre['discount_tran'];
	//echo "<br>";
	if(($pending_pre[$row_pre['id']]<0) || ($pending_pre[$row_pre['id']]>0 && $pending_pre[$row_pre['id']]<=9))
	{
		$pending_pre[$row_pre['id']]=0;
	}
	else
	{
		$pending_pre[$row_pre['id']];
	}
	$discount_pre[$row_pre['id']] = $countmonthesult_pre['discount_tran'];


	/////////////GETTING COUNTRY//////////////// NEWLY ADDED
	$query_country_pre="SELECT countryID FROM campus_students where id=".$row_pre['studentID']." "; 
	$query_country_result_pre=mysql_query($query_country_pre) or die(mysql_error());
	$query_country_result_pre=mysql_fetch_assoc($query_country_result_pre);

	//For ORIGINAL AMOUNT[amount_original]
	$sql_amt_ori_pre="select amount_original FROM campus_transaction where (month(dateRecieved)>='".$date_subtracted_amount_original."' AND month(dateRecieved)<='".$date_subtracted."')  and year(dateRecieved)='".$year_subtracted."' and studentID=".$row_pre['studentID']." and schedule_id=".$row_pre['id'].""; 
	$sql_amt_ori_result_pre=mysql_query($sql_amt_ori_pre) or die(mysql_error());
	$sql_amt_ori_result_pre=mysql_fetch_assoc($sql_amt_ori_result_pre);

	//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
	//It must not be shown in current month pending				//ADDED ON 01-03-2016
	$paydate_strtotime_pre = strtotime($row_pre['pay_date']);
	$duedate_strtotime_pre = strtotime($row_pre['due_date']);
	$days_paydate_minus_duedate_secs_pre = strtotime($row_pre['pay_date']) - strtotime($row_pre['due_date']);
	$days_paydate_minus_duedate_days_pre = floor($days_paydate_minus_duedate_secs_pre/(60*60*24));
	//Subtracting 1 from PAYDATE MONTH for Pre month checking	//START
	$paydate_month_pre = date("m",strtotime($row_pre['pay_date']));
	$paydate_month_pre = $paydate_month_pre-1;
	//Subtracting 1 from PAYDATE MONTH for Pre month checking	//END
	$paydate_year_pre = date("Y",strtotime($row_pre['pay_date']));
										
	if($row_pre['month']==date('n') && $row_pre['year']==date('Y'))
		{
		$signups_pre[$row_pre['id']]=$countresult_pre;
		}
		if(($pending_pre[$row_pre['id']] >= 10) && ($signups_pre[$row_pre['id']]==''))
		{
			//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
			//It must not be shown in current month pending				//ADDED ON 01-03-2016
			//$paydate_month_pre==date('n')-2		// Pre to Pre MONTH i.e if PRE is FEB , Then PRE PRE is JAN
			//$paydate_year_pre==date('Y')			// For Current Year
			if($paydate_strtotime_pre>$duedate_strtotime_pre && $days_paydate_minus_duedate_days_pre<=10 && $paydate_month_pre==date('n')-2 && $paydate_year_pre==date('Y'))
			{
				$pending_pre_2nd_array[$row_pre['id']]=0;
				$pending_pre[$row_pre['id']] = 0;
				/* echo "<tr>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row_pre['paydayz'])  . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row_pre['studentID']))."' target=_blank >" . getextID(nl2br( $row_pre['studentID'])) . "</a></td>";
				if($five_days_red>5)
				{
					echo "<td valign='top' >" . "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" . "<a href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";
				}
				echo "<td valign='top' style='color:green; font-weight:bold'>" . "<a href=class_details_classes_count.php?id={$row_pre['studentID']}&paydate_pre={$row_pre['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row_pre['teacherID'])) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser( nl2br( $row_pre['LeadId'])) . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $query_country_result_pre['countryID']),'country'). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showCourse(nl2br( $row_pre['courseID'])). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
				 *///from CAD to USD Conversion/////////////////////////////////////////////////////////////
				$pending_usd_convert_pre[$row_pre['id']] =  round($pending_pre_2nd_array[$row_pre['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
				/* echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result_pre['amount_original']  . "</td>";
				echo "</tr>"; */
			}
			else
			{
				$pending_pre_2nd_array[$row_pre['id']]=$pending_pre[$row_pre['id']];
				/* echo "<tr>";  
				echo "<td valign='top'>" . nl2br( $row_pre['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row_pre['studentID']))."' target=_blank >" . getextID(nl2br( $row_pre['studentID'])) . "</a></td>";
				if($five_days_red>5)
				{
					echo "<td valign='top'>" . "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" . "<a href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";
				}
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row_pre['studentID']}&paydate_pre={$row_pre['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top'>" . showUser(nl2br( $row_pre['teacherID'])) . "</td>";  
				echo "<td valign='top'>" . showUser( nl2br( $row_pre['LeadId'])) . "</td>";
				echo "<td valign='top'>" . getData(nl2br( $query_country_result_pre['countryID']),'country'). "</td>"; 
				echo "<td valign='top'>" . showCourse(nl2br( $row_pre['courseID'])). "</td>"; 
				echo "<td valign='top'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
				 *///from CAD to USD Conversion/////////////////////////////////////////////////////////////
				$pending_usd_convert_pre[$row_pre['id']] =  round($pending_pre_2nd_array[$row_pre['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
				/* echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result_pre['amount_original']  . "</td>";
				echo "</tr>"; */ 
			}
		}
	}
	//echo "<td valign='top'>".$sum_teamlead_each[$counter_for_teamlead_sum] = array_sum($pending_pre_2nd_array)."</td>";
	echo "<td valign='top'>".$sum_teamlead_each_USD[$counter_for_teamlead_sum] = round(array_sum($pending_pre_2nd_array) * $row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>";
	$sum_teamlead_each[$counter_for_teamlead_sum] = array_sum($pending_pre_2nd_array);
	$total_sum_teamlead_each[$counter_for_teamlead_sum] = $sum_teamlead_each[$counter_for_teamlead_sum];
	$total_sum_teamlead_each_USD[$counter_for_teamlead_sum] = $sum_teamlead_each_USD[$counter_for_teamlead_sum];
	//echo "<br>";
	//$counter_for_teamlead_sum = $counter_for_teamlead_sum + 1;
	unset($sum_teamlead_each);
	unset($pending_pre_2nd_array);	
					
//PENDING , CURR MONTH
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,
					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.LeadId='".$team_under_index."' and 
					capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN '".$fromDate."' AND 
					'".$fromdaysss."' 
					order by paydayz DESC";
					
	$unique_array_id=1;
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


	$countresult=$row['amount'];
	//echo "<br>";
	$amount[$row['id']]=$countresult;

	//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



		$countmonthsql="select amount as amounttran,discount_tran 
		FROM campus_transaction 
		where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and 
		studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
		$countmonthesult=mysql_query($countmonthsql) or die(mysql_error());
		$countmonthesult=mysql_fetch_assoc($countmonthesult);

		$amount[$row['id']]=$countresult;
		$recieved[$row['id']]=$countmonthesult['amounttran'];
		$pending[$unique_array_id]=$countresult-$countmonthesult['amounttran']-$countmonthesult['discount_tran'];
		if($pending[$unique_array_id]<0 || $pending[$unique_array_id]<10)
		{
		$pending[$unique_array_id]=0;
		}
		$discount[$row['id']] = $countmonthesult['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


	/////////////GETTING COUNTRY//////////////// NEWLY ADDED
	$query_country="SELECT countryID FROM campus_students where id=".$row['studentID']." "; 
	$query_country_result=mysql_query($query_country) or die(mysql_error());
	$query_country_result=mysql_fetch_assoc($query_country_result);
	
	//For ORIGINAL AMOUNT[amount_original] - Also added 1 in var [$date_subtracted_amount_original] 
	//& [$date_subtracted] so that we must have current month(date('n')) and last 2 months(date('n')-2) in QUERY
	$sql_amt_ori="select amount_original FROM campus_transaction where (month(dateRecieved)>='".($date_subtracted_amount_original+1)."' AND month(dateRecieved)<='".($date_subtracted+1)."')  and year(dateRecieved)='".$year_subtracted."' and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
	$sql_amt_ori_result=mysql_query($sql_amt_ori) or die(mysql_error());
	$sql_amt_ori_result=mysql_fetch_assoc($sql_amt_ori_result);
	
	//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
	//It must not be shown in current month pending
	$paydate_strtotime = strtotime($row['pay_date']);
	$duedate_strtotime = strtotime($row['due_date']);
	$days_paydate_minus_duedate_secs = strtotime($row['pay_date']) - strtotime($row['due_date']);
	$days_paydate_minus_duedate_days = floor($days_paydate_minus_duedate_secs/(60*60*24));
	$paydate_month = date("m",strtotime($row['pay_date']));
	$duedate_month = date("m",strtotime($row['due_date']));
	$paydate_year = date("Y",strtotime($row['pay_date']));
	$duedate_year = date("Y",strtotime($row['due_date']));
	//USEE FOLLOWING for testing for PREVIOUS MONTH later >>>>>>>>>>>>>>>>>IMPORTANT<<<<<<<<<<<<<<<<<<<<
	/* if($paydate_strtotime>$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n'))
	{
	echo "GREEN-STUDENT:".showStudents($row['studentID'])."---DAYS:".$days_paydate_minus_duedate_days."month:".$paydate_month;
	}
	else
	{
	echo "RED-STUDENT:".showStudents($row['studentID'])."---".$days_paydate_minus_duedate_days;
	}
	echo "<br><br>"; */
		//echo $studentname = showStudents(nl2br( $row['studentID']));
		//echo $pending = nl2br( $pending[$unique_array_id]);echo "<br>";

		if($row['month']==date('n') && $row['year']==date('Y'))
		{
		$signups[$row['id']]=$countresult;
		}
		
		
		if($pending[$unique_array_id] >=10 && ($signups[$row['id']]==''))
		{
			//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
			//It must not be shown in current month pending
			if($paydate_strtotime>=$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n') && $paydate_month!=$duedate_month && $paydate_year==date('Y'))
			{
				//$pending[$unique_array_id]=0;
				/* echo "<tr>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['studentID']))."' target=_blank >" . getextID(nl2br( $row['studentID'])) . "</a></td>";			
				if($five_days_red>5)
				{
					echo "<td valign='top'>" .  "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
				}
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row['studentID']}&paydate={$row['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				 *///from CAD to USD Conversion/////////////////////////////////////////////////////////////
				$pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
				/* echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; */
			}
			else
			{
				/* echo "<tr>";  
				echo "<td valign='top'>" . nl2br( $row['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['studentID']))."' target=_blank >" . getextID(nl2br( $row['studentID'])) . "</a></td>";
				if($five_days_red>5)
				{
					echo "<td valign='top'>" .  "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
				}
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row['studentID']}&paydate={$row['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				 *///from CAD to USD Conversion/////////////////////////////////////////////////////////////
				$pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
				/* echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; */ 
			}		
		}
		$unique_array_id = $unique_array_id + 1;
	}

/*	echo "<tr>";  
 	echo "<td valign='top' style='color:black; font-weight:bold'>".showUser( nl2br( $team_under_index))."</td>";
	echo "<td valign='top'>".$sum_teamlead_each_curr_1to10[$counter_for_teamlead_sum] = array_sum($pending)."</td>";
	echo "<td valign='top'>".$sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum] = array_sum($pending_usd_convert) ."</td>";
 */	
	
	showUser( nl2br( $team_under_index));
	$sum_teamlead_each_curr_1to10[$counter_for_teamlead_sum] = array_sum($pending);
	$sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum] = array_sum($pending_usd_convert);
	
	$sum_teamlead_each_curr_1to10[$counter_for_teamlead_sum] = array_sum($pending);
	$total_sum_teamlead_each_curr_1to10[$counter_for_teamlead_sum] = $sum_teamlead_each_curr_1to10[$counter_for_teamlead_sum];
	$total_sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum] = $sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum];
	//$counter_for_teamlead_sum = $counter_for_teamlead_sum + 1;
	unset($sum_teamlead_each_curr_1to10);
	unset($pending);
	unset($sum_teamlead_each_curr_1to10_USD);
	unset($pending_usd_convert);
	
	
	
	//DISPLAYING / SHOWING TTL
	//echo "<td valign='top' style='color:black; font-weight:bold'>".showUser( nl2br( $team_under_index))."</td>";
	
	//USD sum [Curr]
	$total_pending_target_usd =	$total_sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum];
	echo "<td valign='top'>".$total_pending_target_usd."</td>";
	
	// Adding Pre Pending USD with Curr Pending USD, Pre Pending USD + Curr Pending USD
	echo "<td valign='top'>".$total_pre_curr_pending_SUM_ary[$team_under_index] = $total_sum_teamlead_each_USD[$counter_for_teamlead_sum] + 
	$total_sum_teamlead_each_curr_1to10_USD[$counter_for_teamlead_sum]."</td>";
	
	
	$counter_for_teamlead_sum = $counter_for_teamlead_sum + 1;
	
	
	//echo "</tr>";

	
	
	
	
//RECEIVED AMOUNT
 	$sql_received=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath,
	campus_transaction.discount_tran 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";
	if(isset($_POST['submit']) && $team_under_index!=0)
	{
		$sql_received.=" and campus_transaction.LeadId='".$team_under_index."' ";
	}

		$sql_received.=" and campus_transaction.campus IS NULL ";
	$recieved_usd_with_tran_id=array();

	$result = mysql_query($sql_received) or trigger_error(mysql_error()); 
	$row_count=mysql_num_rows($result);
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_received = mysql_fetch_array($result)){ 
	foreach($row_received AS $key => $value) { $row_received[$key] = stripslashes($value); }
		if(($row_received['method_array']==2 || $row_received['method_array']==3 || $row_received['method_array']==4 || $row_received['method_array']==5) && $row_received['accounts_chk']!=1)
		{
			$recieved_usd_with_tran_id[$row_received['tran_id']]=0;
		}
		else
		{
			$recieved_usd_with_tran_id[$row_received['tran_id']]=$row_received['amount_usd_simple'];
		}
		
	}
	
	//Total Received
	echo "<td valign='top'>" . $total_received_ary[$team_under_index] = round(array_sum($recieved_usd_with_tran_id)) . "</td>";
	
/* 	echo $total_remaining = $total_sum_teamlead_each_curr_1to10_USD - $total_received;
	echo "<td valign='top'>" . $total_remaining . "</td>"; */

	//Total Remaining PEND SUB = TOTAL TARGET[Total Pending] - TOTAL RECEIVED
	/* echo "<td valign='top' style='color:red; font-weight:bold'>" . $total_remaining_pend_ary[$team_under_index] = 
	$total_pre_curr_pending_SUM_ary[$team_under_index] - $total_received_ary[$team_under_index] . "</td>";
	 */
	//Total Remaining TRGT SUB = TOTAL TARGET[MANUAL] - TOTAL RECEIVED
	echo "<td valign='top' style='color:green; font-weight:bold'>" . $total_remaining_trgt_ary[$team_under_index] = 
	$total_target_sum_ary[$team_under_index] - $total_received_ary[$team_under_index] . "</td>";
	
	//PER DAY
	$remaining_days = $total_month_days_without_SUNDAY - $total_passed_days_without_SUNDAY;
	echo "<td valign='top'>" . $per_day_ary[$team_under_index] = round($total_remaining_trgt_ary[$team_under_index] / $remaining_days) . "</td>";
	
//Advance - Leave Curr month and get next 3 months
	$fromDate_next_3_months = date("Y-m-01", strtotime("+1 months"));echo "<br>";
	$toDate_next_3_months = date("Y-m-t", strtotime("+3 months"));echo "<br>";
//RECEIVED AMOUNT FOR NEXT 3 MONTHS
 	$sql_received_next_3_months=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath,
	campus_transaction.discount_tran 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".$fromDate_next_3_months."' AND '".$toDate_next_3_months."' and campus_transaction.date!='' ";
	if(isset($_POST['submit']) && $team_under_index!=0)
	{
		$sql_received_next_3_months.=" and campus_transaction.LeadId='".$team_under_index."' ";
	}

		$sql_received_next_3_months.=" and campus_transaction.campus IS NULL ";
	$recieved_usd_with_tran_id_next_3_months=array();

	$result_next_3_months = mysql_query($sql_received_next_3_months) or trigger_error(mysql_error()); 
	$row_count=mysql_num_rows($result_next_3_months);
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_received = mysql_fetch_array($result_next_3_months)){ 
	foreach($row_received AS $key => $value) { $row_received[$key] = stripslashes($value); }
	$recieved_usd_with_tran_id_next_3_months[$row_received['tran_id']]=$row_received['amount_usd_simple'];
	}
	
	//Total Received for next 3 months
	echo "<td valign='top'>" . $total_received_ary_next_3_months[$team_under_index] = round(array_sum($recieved_usd_with_tran_id_next_3_months)) . "</td>";
	
	
	
// DEAD AMOUNT - TEAMLEAD WISE
	$sql_dead_amount="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$team_under_index."' and campus_schedule.std_status='3' and 
	campus_schedule.std_status_old='2' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_dead_amount.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
	$dead_amount_ary=array();
	$result_dead_amount = mysql_query($sql_dead_amount) or trigger_error(mysql_error());
	$row_count=mysql_num_rows($result_dead_amount);
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_received = mysql_fetch_array($result_dead_amount)){
	$dead_amount_usd = round($row_received['dues'] * $row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
	$dead_amount_ary[$row_received['sch_id']]=$dead_amount_usd;
	}
	//DEAD AMOUNT
	echo "<td valign='top'>" . $total_dead_amount_ary[$team_under_index] = round(array_sum($dead_amount_ary)) . "</td>";
	
	//DEAD PERCENTAGE
	echo "<td valign='top'>" . round(($total_dead_amount_ary[$team_under_index] / $total_pre_curr_pending_SUM_ary[$team_under_index]) * 100 ,2) . " %</td>";
	
	

// FREEZE AMOUNT - TEAMLEAD WISE
	$sql_freeze_amount="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$team_under_index."' and campus_schedule.std_status='4' and 
	campus_schedule.std_status_old='2' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_freeze_amount.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
	$freeze_amount_ary=array();
	$result_freeze_amount = mysql_query($sql_freeze_amount) or trigger_error(mysql_error());
	$row_count=mysql_num_rows($result_freeze_amount);
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_received = mysql_fetch_array($result_freeze_amount)){
	$freeze_amount_usd = round($row_received['dues'] * $row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
	$freeze_amount_ary[$row_received['sch_id']]=$freeze_amount_usd;
	}
	//FREEZE AMOUNT
	echo "<td valign='top'>" . $total_freeze_amount_ary[$team_under_index] = round(array_sum($freeze_amount_ary)) . "</td>";
		
	
	
	}	//LOOP FOR TEAMLEADS curr month		//END


}//END of if($_POST['submit'])CURRENT PENDING






echo "<tr>";  
echo "<td valign='top'>Sum </td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_target_sum_ary) ) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_sum_teamlead_each_USD) ."**--**" . nl2br( array_sum($pending_usd_convert_pre))) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . array_sum($total_sum_teamlead_each_curr_1to10_USD) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_pre_curr_pending_SUM_ary)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_received_ary)) . "</td>"; 
/* echo "<td valign='top'><b>$" . nl2br( array_sum($total_remaining_pend_ary)) . "</td>";  */
echo "<td valign='top'><b>$" . nl2br( array_sum($total_remaining_trgt_ary)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($per_day_ary)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_received_ary_next_3_months)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($total_dead_amount_ary)) . "</td>"; 
echo "<td valign='top'><b></td>";
echo "<td valign='top'><b>$" . nl2br( array_sum($total_freeze_amount_ary)) . "</td>"; 
//echo "<td valign='top'><b></td>";
echo "</tr>";
echo "</table>";












include('include/footer.php');?>

<form action='' method='POST'> 
<input type='hidden' value='1' name='submitted' /></div> 
</form>