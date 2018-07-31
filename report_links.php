<? 
include('config.php'); 
include('include/header.php');



?>


<? 
//RECURRING REPORTS
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th colspan=2 class='specalt' style='text-align:center'>RECURRING/PENDING REPORTS</th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>Description</th>"; 
echo "<th class='specalt'>Main Link</th>";
echo "</tr>"; 
//Pending report overall
echo "<tr>";   
echo "<td>Pending report-Overall</td>";
echo "<td><a class=button target=_blank href=pending_amount_report_pre_curr_next.php>Pending Report - Click Here</a>";
echo "</tr>"; 

//Payment record report
echo "<tr>";   
echo "<td>Payment record report for RECEIVED AMOUNT-TEACHER TL and MAIN TEACHER TL WISE</td>";
echo "<td><a class=button target=_blank href=payment_record_report.php>Payment record report - Click Here</a>";
echo "</tr>"; 

//Teacher TL Report
echo "<tr>";   
echo "<td>DEAD and REGULAR-TEACHER TL and MAIN TEACHER TL WISE</td>";
echo "<td><a class=button target=_blank href=teamlead_teacher_report.php>Teacher TL Report - Click Here</a>";
echo "</tr>";

echo "</table>";

//////////////////////////////////////////////////////////////////

//SALES REPORTS
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th colspan=2 class='specalt' style='text-align:center'>SALES REPORTS</th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>Description</th>"; 
echo "<th class='specalt'>Main Link</th>";
echo "</tr>"; 
//Agent TL Report
echo "<tr>";   
echo "<td>AGENT TL WISE</td>";
echo "<td><a class=button target=_blank href=teamlead_agent_report.php>AGENT TL Report - Click Here</a>";
echo "</tr>";
echo "</table>";

echo "<a href=transaction_paymentdue_new.php class=button>New Row</a>"; 
include('include/footer.php');?>