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
getTeacherFilterLead_main();
getTeacherFilterLead();
}
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 
//PREVIOUS MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the PREVIOUS MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
echo "<div align='center' style='color:red; font-size:16px'>PREVIOUS MONTH PENDINGS</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>EXT ID</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Class Details</th>";
echo "<th class='specalt'>Teacher Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount-CAD</th>"; 
echo "<th class='specalt'>Pending Amount-USD</th>"; 
echo "<th class='specalt' style='color:blue; font-weight:bold'>Original Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Discount</th>";
//echo "<th class='specalt'>SignUp Date</th>";
//echo "<th class='specalt'>Paying Date</th>";
//echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Current Month Due date</th>"; 
//echo "<th class='specalt'>Pending month</th>"; 
echo "</tr>";
$amount_pre=array();
$recieved_pre=array();
$pending_pre =array();

$pending_pre_2nd_array =array();

$signups_pre =array();
$discount_pre =array();

$pending_usd_convert_pre=array();

if(isset($_POST['submit']))
{
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
	$countmonthsql_pre="select amount as amounttran, discount_tran FROM campus_transaction where month(dateRecieved)='".$date_subtracted."' and year(dateRecieved)='".$year_subtracted."' and studentID=".$row_pre['studentID']." and schedule_id=".$row_pre['id'].""; 
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
				echo "<tr>";  
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
				//echo "<td valign='top'>$" . nl2br( $amount_pre[$row_pre['id']])  . "</td>";  
				//echo "<td valign='top'>$" . nl2br( $recieved_pre[$row_pre['id']]) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert_pre[$row_pre['id']] =  round($pending_pre_2nd_array[$row_pre['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result_pre['amount_original']  . "</td>";
				//echo "<td valign='top'>$" . nl2br( $signups_pre[$row_pre['id']]) . "</td>";
				//echo "<td valign='top'>$" . nl2br( $discount_pre[$row_pre['id']]) . "</td>";
				//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row_pre['due_date']) . "</td>";
				//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row_pre['pay_date']) . "</td>";
				//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['date_rec_cam_tran']). "</td>"; 
				//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['maxdate_rec']). "</td>"; 
				//echo "<td valign='top'>" . $date_subtracted . "</td>"; 
				echo "</tr>";
			}
			else
			{
				$pending_pre_2nd_array[$row_pre['id']]=$pending_pre[$row_pre['id']];
				echo "<tr>";  
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
				//echo "<td valign='top'>$" . nl2br( $amount_pre[$row_pre['id']])  . "</td>";  
				//echo "<td valign='top'>$" . nl2br( $recieved_pre[$row_pre['id']]) . "</td>";  
				echo "<td valign='top'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				echo "<td valign='top'>$" . $pending_usd_convert_pre[$row_pre['id']] =  round($pending_pre_2nd_array[$row_pre['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result_pre['amount_original']  . "</td>";
				//echo "<td valign='top'>$" . nl2br( $signups_pre[$row_pre['id']]) . "</td>";
				//echo "<td valign='top'>$" . nl2br( $discount_pre[$row_pre['id']]) . "</td>";
				//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row_pre['due_date']) . "</td>";
				//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row_pre['pay_date']) . "</td>";
				//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['date_rec_cam_tran']). "</td>"; 
				//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['maxdate_rec']). "</td>"; 
				//echo "<td valign='top'>" . $date_subtracted . "</td>"; 
				echo "</tr>"; 
			}
		}
	}
}//END of if($_POST['submit'])PRE PENDING

echo "<tr>";  
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'>Sum </td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount_pre))  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved_pre)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending_pre_2nd_array)) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert_pre)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups_pre)) . "</td>";   
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount_pre)) . "</td>";  
echo "</tr>";
echo "</table>";




//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";

echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>EXT ID</th>";
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Class details</th>";
echo "<th class='specalt'>Class details-PD to PD</th>";
echo "<th class='specalt'>Teacher Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount-CAD</th>"; 
echo "<th class='specalt'>Pending Amount-USD</th>";  
echo "<th class='specalt' style='color:blue; font-weight:bold'>Original Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Discount</th>";
//echo "<th class='specalt'>SignUp Date</th>";
//echo "<th class='specalt'>Paying Date</th>";
//echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Current Month Due date</th>"; 
echo "</tr>";

$amount=array();
$recieved=array();
$pending =array();
$signups =array();
$discount =array();
$pending_usd_convert=array();

if(isset($_POST['submit']))
{
	$unique_array_id=1;
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


	$countresult=$row['amount'];
	//echo "<br>";
	$amount[$row['id']]=$countresult;

	//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



		$countmonthsql="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
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
			if($paydate_strtotime>$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n'))
			{
				$pending[$unique_array_id]=0;
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
				/* echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; */
			}
			else
			{
				echo "<tr>";  
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
// Following Code highlights the student as RED or GREEN depending on the CLASS DETAILS, 	// NEWLY ADDED 29-04-16
// And it counts the number of classes that have been DONE & that WILL BE DONE(Coming classes) from PRE PAYDATE
// to CURR PAYDATE depending upon the CLASSTYPE i.e according to MON,TUE,WED or THUR,FRI,SAT
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> *********************** <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	//CURRENT MONTH PAYDATE
	if($row['paydayz']!="" && isset($row['paydayz']))
	{
		//echo "<br>";
		//echo "1st DATE RANGE";echo "<br>";
		
		$fromDate_NEW=date('Y')."-".date('m')."-".$row['paydayz'];
		$fromDate_NEW=date_create($fromDate_NEW);
		$timestamp_fromDate= strtotime($fromDate_NEW);
		$fromDate_NEW_day = date("d", $timestamp_fromDate);
		if($row['paydayz']>=date('d'))
		{
			//echo "1st:";echo "<br>";
			$fromDate_NEW = date('Y')."-".(date('m')-1)."-".$row['paydayz'];
		}
		if($row['paydayz']<date('d'))
		{
			//echo "2nd:";echo "<br>";
			//Making the fromDate format by using PAYDATE from pending report overall
			$fromDate_NEW = date('Y')."-".(date('m'))."-".$row['paydayz'];
			//echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		}
		//Making the toDate format till CURRENT DATE to check how many REGULAR classes have been PRESENT
		$toDate_NEW=date('Y-m-d');
		//echo "<br>";echo "<br>";
		
		//echo "2nd DATE RANGE";echo "<br>";
		//Adding 1 in the current DATE, And then will make a range from CURR DATE to NEXT PAYDATE
		$toDate_NEW_plus_1 = date('Y-m-d', strtotime($toDate_NEW . ' +1 day'));
		$timestamp = strtotime($toDate_NEW_plus_1);
		$toDate_NEW_plus_1_day = date("d", $timestamp);
		//Checking if CURR DATE +1 DAY is greater than paydate - then we will stop at NEXT MONTH paydate
		if($toDate_NEW_plus_1_day>$row['paydayz'])
		{
			//echo $paydate_curr_month_plus_one = date('Y')."-0".(date('m')+1)."-".$paydate;echo "<br>";
			$paydate_curr_month_plus_one = date('Y')."-".date('m')."-".$row['paydayz'];
		}
		if($toDate_NEW_plus_1_day<=$row['paydayz'])
		{
			$paydate_curr_month_plus_one = date('Y')."-".date('m')."-".$row['paydayz'];
		} 
	}
	
	$_POST['search-student-id']=$row['studentID'];
	
	$sql_paydate_to_curr_date_present_cnt="
		SELECT 
		campus_attendance_student.id,campus_attendance_student.schedule_id,
		count(campus_attendance_student.status) as sa_status,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,
		campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,
		campus_attendance_student.lessonDetails,campus_attendance_student.std_status,campus_attendance_student.status,
		campus_attendance_student.date,campus_attendance_student.lecture_image_filepath,campus_attendance_student.studentID  
		FROM  campus_attendance_student WHERE  
		campus_attendance_student.status=1  and  
		campus_attendance_student.courseID='".$row['courseID']."' and 
		campus_attendance_student.date>= '".$fromDate_NEW."' and campus_attendance_student.date<= '".$toDate_NEW."'
		";		
		if($_POST['search-teacher-id']!=0)
		{
			//$sql_paydate_to_curr_date_present_cnt.="  and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
		}
		if($_POST['search-student-id']!=0)
		{
			$sql_paydate_to_curr_date_present_cnt.=" and campus_attendance_student.studentID='".$_POST['search-student-id']."' ";
		}
		/* if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_paydate_to_curr_date_present_cnt.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
		} */
		if(isset($_POST['classType']) && !empty($_POST['classType']))
		{
			$sql_paydate_to_curr_date_present_cnt.=" and  ".getClassTypeSchedule($_POST['classType']);
		}
		//	ADD LATE TOMORROW	$sql_paydate_to_curr_date_present_cnt.="  GROUP BY campus_attendance_student.teacherID,campus_attendance_student.studentID,campus_attendance_student.status,campus_attendance_student.classType";

		$sql_paydate_to_curr_date_present_cnt.="  GROUP BY campus_attendance_student.status";
		//echo $sql_paydate_to_curr_date_present_cnt;
		$result_paydate_to_curr_date_present_cnt = mysql_query($sql_paydate_to_curr_date_present_cnt);
		
			/////////////////////////////////////////////////////// PAYDATE CURRENT RANGE ****************<<<<<<<<<<<<<<<	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
	$date1 = $_POST['fromDate']; 
	$date2 = $_POST['toDate']; 
	}
	else
	{
	$date1 = $fromDate_NEW; 
	$date2 = $toDate_NEW;
	}
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1);
	$time2 = strtotime($date2);

	$days_mtw = 0; 
	$days_tfs = 0; 
			while($time1 <= $time2) { 
			   $chk_mtw = date('D', $time1); # Actual date conversion 
			   $chk_tfs = date('D', $time1);
			   $chk_mtwtf = date('D', $time1);
			   if($chk_mtw != 'Sun' && $chk_mtw != 'Thu' && $chk_mtw != 'Fri' && $chk_mtw != 'Sat')
				  $days_mtw++;
			   if($chk_tfs != 'Sun' && $chk_tfs != 'Mon' && $chk_tfs != 'Tue' && $chk_tfs != 'Wed')
				  $days_tfs++;
			   if($chk_mtwtf != 'Sun' && $chk_mtwtf != 'Sat')
				  $days_mtwtf++;
				  
			   $time1 += 86400; # Add a day 
			}
	/* 	}
	} */
	$days_mtw;
	$days_tfs;
	$days_mtwtf;
	
	/////////////////////////////////////////////////////// PAYDATE NEXT RANGE ****************<<<<<<<<<<<<<<<
	$date1_next_range = $toDate_NEW_plus_1; 
	$date2_next_range = $paydate_curr_month_plus_one;
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1_next_range = strtotime($date1_next_range); 
	$time2_next_range = strtotime($date2_next_range); 

	$days_mtw_next_range = 0; 
	$days_tfs_next_range = 0; 
			while($time1_next_range <= $time2_next_range) { 
			   $chk_mtw_next_range = date('D', $time1_next_range); # Actual date conversion 
			   $chk_tfs_next_range = date('D', $time1_next_range);
			   $chk_mtwtf_next_range = date('D', $time1_next_range);
			   if($chk_mtw_next_range != 'Sun' && $chk_mtw_next_range != 'Thu' && $chk_mtw_next_range != 'Fri' && $chk_mtw_next_range != 'Sat')
				  $days_mtw_next_range++;
			   if($chk_tfs_next_range != 'Sun' && $chk_tfs_next_range != 'Mon' && $chk_tfs_next_range != 'Tue' && $chk_tfs_next_range != 'Wed')
				  $days_tfs_next_range++;
			   if($chk_mtwtf_next_range != 'Sun' && $chk_mtwtf_next_range != 'Sat')
				  $days_mtwtf_next_range++;
				  
			   $time1_next_range += 86400; # Add a day 
			}
	/* 	}
	} */
	$days_mtw_next_range;
	$days_tfs_next_range;
	$days_mtwtf_next_range;
	//Adding PAYDATE CURRENT RANGE and PAYDATE NEXT RANGE
	$total_RANGE_mtw = $days_mtw + $days_mtw_next_range;
	$total_RANGE_tfs = $days_tfs + $days_tfs_next_range;

		
		$row_paydate_to_curr_date_present_cnt = mysql_fetch_assoc($result_paydate_to_curr_date_present_cnt);
		
		if($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_mtw_next_range < 12 && $row_paydate_to_curr_date_present_cnt['classType']==1) 
		{echo "<td valign='top' style='background-color:red; font-size:10px;'>1- <a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' font-weight:bold'>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";}
		else if($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_tfs_next_range < 12 && $row_paydate_to_curr_date_present_cnt['classType']==2)
		{echo "<td valign='top' style='background-color:red; font-size:10px;'>2- <a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' font-weight:bold'>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";}
		else if($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_mtwtf_next_range < 21 && $row_paydate_to_curr_date_present_cnt['classType']==3)
		{echo "<td valign='top' style='background-color:red; font-size:10px;'>3- <a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' font-weight:bold'>" . showStudents(nl2br( $row_paydate_to_curr_date_present_cnt['studentID'])) . "</a></td>";}
		else{
		echo "<td valign='top' style='background-color:green; font-size:16px;'>O.K.- <a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' font-weight:bold'>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
		//echo "<td valign='top'>" . getData(nl2br( $row_paydate_to_curr_date_present_cnt['status']),'class_status') . "</td>";
		//echo "<td valign='top'>" . getData(nl2br( $row_paydate_to_curr_date_present_cnt['std_status']),'stdStatusmo-list') . "</td>"; 
		//echo "<td valign='top'>" . getData(nl2br( $row_paydate_to_curr_date_present_cnt['classType']),'plan') . "</td>";
		}
		if($row_paydate_to_curr_date_present_cnt['classType']==1 || $row_paydate_to_curr_date_present_cnt['classType']==5 || $row_paydate_to_curr_date_present_cnt['classType']==6 || $row_paydate_to_curr_date_present_cnt['classType']==7)
		{
		/* 	echo "<td valign='top'>" . ($row_paydate_to_curr_date_present_cnt['sa_status']) . "</td>";
			echo "<td valign='top'>" . ($days_mtw_next_range) . "</td>";
			echo "<td valign='top' style='color:blue;'>" . ($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_mtw_next_range) . "</td>";
			echo "<td valign='top'>" . ($days_mtw + $days_mtw_next_range) . "</td>"; */
		}
		if($row_paydate_to_curr_date_present_cnt['classType']==2 || $row_paydate_to_curr_date_present_cnt['classType']==8 || $row_paydate_to_curr_date_present_cnt['classType']==9 || $row_paydate_to_curr_date_present_cnt['classType']==10)
		{
		/* 	echo "<td valign='top'>" . ($row_paydate_to_curr_date_present_cnt['sa_status']) . "</td>";
			echo "<td valign='top'>" . ($days_tfs_next_range) . "</td>";
			echo "<td valign='top' style='color:blue;'>" . ($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_tfs_next_range) . "</td>";
			echo "<td valign='top'>" . ($days_tfs + $days_tfs_next_range) . "</td>"; */
		}
		if($row['classType']==3)
		{
		/* 	echo "<td valign='top'>" . ($row_paydate_to_curr_date_present_cnt['sa_status']) . "</td>";
			echo "<td valign='top'>" . ($days_mtwtf_next_range) . "</td>";
			echo "<td valign='top' style='color:blue;'>" . ($row_paydate_to_curr_date_present_cnt['sa_status'] + $days_mtwtf_next_range) . "</td>";
			echo "<td valign='top'>" . ($days_mtwtf + $days_mtwtf_next_range) . "</td>"; */
		}
		
//				echo "<td valign='top'>" . "<a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' style='color:blue; font-weight:bold'>Class Details-PayDate TO PayDate</a></td>";				
				//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> *********************** <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
				
				echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				echo "<td valign='top'>$" . $pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; 
			}		
		}
		$unique_array_id = $unique_array_id + 1;
	}
}//END of if($_POST['submit'])CURRENT PENDING

echo "<tr>";  
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'>Sum </td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "</tr>";
echo "</table>";




//NEXT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the NEXT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:red; font-size:16px'>NEXT MONTH PENDINGS</div>";
//**********************************YEAR CHANGE e.g from 2013 to 2014********************************
if($toYear>=$fromYear)
{
//1st condition for curr month+next month
if($toMonth>$fromMonth)
{
echo "1st";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>EXT ID</th>";
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>Teacher Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount-CAD</th>"; 
	echo "<th class='specalt'>Pending Amount-USD</th>";
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();
		$pending_usd_convert2 =array();

	if(isset($_POST['submit']))
	{
		$unique_array_id=1;
		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>'".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$unique_array_id]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];
			if($pending2[$unique_array_id]<0)
			{
			$pending2[$unique_array_id]=0;
			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n') && $row2['year']==date('Y'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$unique_array_id] >= 10 )
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row2['studentID']))."' target=_blank >" . getextID(nl2br( $row2['studentID'])) . "</a></td>";
		echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser(nl2br( $row2['teacherID'])) . "</td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  				
		echo "<td valign='top'>$" . nl2br( $pending2[$unique_array_id]) . "</td>";  
		//from CAD to USD Conversion/////////////////////////////////////////////////////////////
		echo "<td valign='top'>$" . $pending_usd_convert2[$unique_array_id] =  round($pending2[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
		$unique_array_id = $unique_array_id + 1;
	}
	}//END of if($_POST['submit'])NEXT PENDING 1st

		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";

}

//2nd condition for NEXT month+NEXT month
else if($toMonth>=$fromMonth && $fromMonth==$curr_mon_add_one && $toMonth==$curr_mon_add_one)
{
echo "2nd-one";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>EXT ID</th>"; 
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>Teacher Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount-CAD</th>"; 
	echo "<th class='specalt'>Pending Amount-USD</th>"; 
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();
		$pending_usd_convert2 =array();

	if(isset($_POST['submit']))
	{
		$unique_array_id=1;
		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses

			$month_added=date('n')+1;
			if($month_added==13)
			{
				$month_added=1;
			}
			$year_added=date('Y')+1;
			if($year_added==$fromYear && $year_added==$toYear)
			{
				$year_added=$year_added;
			}
			else
			{
				$year_added=date('Y');
			}

			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".$month_added."' and year(dateRecieved)='".$year_added."' and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$unique_array_id]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];

			if($pending2[$unique_array_id]<0)
			{
			$pending2[$unique_array_id]=0;

			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$unique_array_id] >= 10 )
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row2['studentID']))."' target=_blank >" . getextID(nl2br( $row2['studentID'])) . "</a></td>";
		echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser(nl2br( $row2['teacherID'])) . "</td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  
		echo "<td valign='top'>$" . nl2br( $pending2[$unique_array_id]) . "</td>";  
		//from CAD to USD Conversion/////////////////////////////////////////////////////////////
		echo "<td valign='top'>$" . $pending_usd_convert2[$unique_array_id] =  round($pending2[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
		$unique_array_id = $unique_array_id + 1;
	}
	}//END of if($_POST['submit'])NEXT PENDING 2nd

		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";
}

else if($toMonth<$fromMonth)
{
//1st condition for curr month+next month

echo "1st-2nd part";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>EXT ID</th>"; 
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>Teacher Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount-CAD</th>"; 
	echo "<th class='specalt'>Pending Amount-USD</th>";
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();
		$pending_usd_convert2 =array();

		
		$unique_array_id=1;

		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses

			$month_added=date('n')+1;
			if($month_added==13)
			{
				$month_added=1;
			}
			$year_added=date('Y')+1;

			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".$month_added."' and year(dateRecieved)='".$year_added."' and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$unique_array_id]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];
			if($pending2[$unique_array_id]<0)
			{
			$pending2[$unique_array_id]=0;
			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n') && $row2['year']==date('Y'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$unique_array_id] >= 10 && ($signups2[$row2['id']]==''))
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row2['studentID']))."' target=_blank >" . getextID(nl2br( $row2['studentID'])) . "</a></td>";
		echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser(nl2br( $row2['teacherID'])) . "</td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  
		echo "<td valign='top'>$" . nl2br( $pending2[$unique_array_id]) . "</td>";  
		//from CAD to USD Conversion/////////////////////////////////////////////////////////////
		echo "<td valign='top'>$" . $pending_usd_convert2[$unique_array_id] =  round($pending2[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
		$unique_array_id = $unique_array_id + 1;
	}


		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";

}

//2nd condition for NEXT month+NEXT month
else if($toMonth<=$fromMonth && $fromMonth==$curr_mon_add_one && $toMonth==$curr_mon_add_one)
{
echo "2nd-two";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>EXT ID</th>"; 
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>Teacher Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount-CAD</th>"; 
	echo "<th class='specalt'>Pending Amount-USD</th>"; 
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();
		$pending_usd_convert2 =array();


		$unique_array_id=1;
		
		
		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>'".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$unique_array_id]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];
			if($pending2[$unique_array_id]<0)
			{
			$pending2[$unique_array_id]=0;
			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$unique_array_id] >= 10 && ($signups2[$row2['id']]==''))
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row2['studentID']))."' target=_blank >" . getextID(nl2br( $row2['studentID'])) . "</a></td>";
		echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser(nl2br( $row2['teacherID'])) . "</td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  
		echo "<td valign='top'>$" . nl2br( $pending2[$unique_array_id]) . "</td>";  
		//from CAD to USD Conversion/////////////////////////////////////////////////////////////
		echo "<td valign='top'>$" . $pending_usd_convert2[$unique_array_id] =  round($pending2[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
		$unique_array_id = $unique_array_id + 1;
	}


		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";
}

}
echo "</table>";




echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> TOTAL SUM <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:blue; font-size:16px'>TOTAL SUM</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>";
if(nl2br( array_sum($pending_pre))>0 || nl2br( array_sum($pending))>0 || nl2br( array_sum($pending2))>0)
{ 
	//$amount_total = nl2br( array_sum($amount_pre)) + nl2br( array_sum($amount)) + nl2br( array_sum($amount2));
	//$recieved_total = nl2br( array_sum($recieved_pre)) + nl2br( array_sum($recieved)) + nl2br( array_sum($recieved2));
	$pending_total = nl2br( array_sum($pending_pre_2nd_array)) + nl2br( array_sum($pending)) + nl2br( array_sum($pending2));
	//$signups_total = nl2br( array_sum($signups_pre)) + nl2br( array_sum($signups)) + nl2br( array_sum($signups2));
	//$discount_total = nl2br( array_sum($discount_pre)) + nl2br( array_sum($discount)) + nl2br( array_sum($discount2));
	$pending_usd_convert_total = nl2br( array_sum($pending_usd_convert_pre)) + nl2br( array_sum($pending_usd_convert)) + nl2br( array_sum($pending_usd_convert2));
}	
	
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'>Sum </td>";    
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $amount_total . "</td>";
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $recieved_total . "</td>";  
	echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $pending_total . "</td>"; 
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $signups_total . "</td>";
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $discount_total . "</td>";   
	echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert_total . "</td>";
echo "</tr>";
echo "</table>";

include('include/footer.php');?>

<form action='' method='POST'> 

<input type='hidden' value='1' name='submitted' /></div> 
</form>