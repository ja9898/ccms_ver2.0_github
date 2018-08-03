function clearAll(id){id.value='';}
function resetStudent(id){if(id.value==''){id.value='Select Student';}}

function resetStudent2(id){if(id.value==''){id.value='Select Student';}}

function resetTeacherLead_main(id){if(id.value==''){id.value='Select MAIN Teacher TeamLead';}}

function resetTeacherLead(id){if(id.value==''){id.value='Select Teacher TeamLead';}}
function resetAgentLead(id){if(id.value==''){id.value='Select Agent TeamLead';}}


function resetTeacher(id){if(id.value==''){id.value='Select Teacher';}}
function resetAgent(id){if(id.value==''){id.value='Select Agent';}}
function resetTime(id){if(id.value==''){id.value='Start Time';}}

function resetAdmin(id){if(id.value==''){id.value='Select Admin';}}
function resetSuperAdmin(id){if(id.value==''){id.value='Select Super Admin';}}


function resetEmployeePayroll(id){if(id.value==''){id.value='Select Employee';}}

function resetReference(id){if(id.value==''){id.value='Select Reference';}}

function resetParent(id){if(id.value==''){id.value='Select Parent';}}


/* ---------------------------- */
/* XMLHTTPRequest Enable 		*/
/* ---------------------------- */
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
		return request_type;
}

var http = createObject();

/* -------------------------- */
/* SEARCH Teacher					 */
/* -------------------------- */
function autoTeacher() {
q = document.getElementById('search-teacher').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoTeacher.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoTeacherReply;
http.send(null);
}
function autoTeacherReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('teacherResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueTeacher(id,value){
	
	e = document.getElementById('search-teacher-id');
	e.value=id;
	e = document.getElementById('search-teacher');
	e.value=value;
	e = document.getElementById('teacherResults');
	e.style.display="none";
	}

	/* -------------------------- */
/* SEARCH Teacher TEAM LEAD					 */
/* -------------------------- */
function autoTeacherLead() {
q = document.getElementById('search-teacher2').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoTeamleadteacher.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoTeacherReply2;
http.send(null);
}
function autoTeacherReply2() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('teacherResults2');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueTeacher2(id,value){
	
	e = document.getElementById('search-teacher-id2');
	e.value=id;
	e = document.getElementById('search-teacher2');
	e.value=value;
	e = document.getElementById('teacherResults2');
	e.style.display="none";
	}


	/* -------------------------- */
/* SEARCH MAIN Teacher TEAM LEAD		10-12-2013			 */
/* -------------------------- */
function autoTeacherLead_main() {
q = document.getElementById('search-teachermain').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoTeamleadteacher_main.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoTeacherReplymain;
http.send(null);
}
function autoTeacherReplymain() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('teacherResults_main');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueTeachermain(id,value){
	
	e = document.getElementById('search-teacher-main');
	e.value=id;
	e = document.getElementById('search-teachermain');
	e.value=value;
	e = document.getElementById('teacherResults_main');
	e.style.display="none";
	}
	
	

/* -------------------------- */
/* SEARCH Student					 */
/* -------------------------- */
function autoStudent() {
q = document.getElementById('search-student').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoStudent.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoStudentReply;
http.send(null);
}
function autoStudentReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('studentResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueStudent(id,value){
	
	e = document.getElementById('search-student-id');
	e.value=id;
	e = document.getElementById('search-student');
	e.value=value;
	e = document.getElementById('studentResults');
	e.style.display="none";
	}

	
	
	
	
	
	
/* -------------------------- */
/* SEARCH REFERENCE- STUDENTS_NEW.PHP				 */
/* -------------------------- */
function autoReference() {
q = document.getElementById('search-reference').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoReference.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoReferenceReply;
http.send(null);
}
function autoReferenceReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('referenceResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueReference(id,value){
	
	e = document.getElementById('search-reference-id');
	e.value=id;
	e = document.getElementById('search-reference');
	e.value=value;
	e = document.getElementById('referenceResults');
	e.style.display="none";
	}

	
	
	
	
	
	
	
	
	
/* -------------------------- */
/* SEARCH Student 2 - NEW SCHEDULE				 */
/* -------------------------- */
function autoStudent2() {
q = document.getElementById('search-student2').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoStudentnew.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoStudentReply2;
http.send(null);
}
function autoStudentReply2() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('studentResults2');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueStudent2(id,value){
	
	e = document.getElementById('search-student-id2');
	e.value=id;
	e = document.getElementById('search-student2');
	e.value=value;
	e = document.getElementById('studentResults2');
	e.style.display="none";
	}



	
/* -------------------------- */
/* SEARCH Agent					 */
/* -------------------------- */
function autoAgent() {
q = document.getElementById('search-agent').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoAgent.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoAgentReply;
http.send(null);
}
function autoAgentReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('agentResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueAgent(id,value){
	
	e = document.getElementById('search-agent-id');
	e.value=id;
	e = document.getElementById('search-agent');
	e.value=value;
	e = document.getElementById('agentResults');
	e.style.display="none";
	}

	
	
	/* -------------------------- */
/* SEARCH Agent	TEAM LEAD		 */
/* -------------------------- */
function autoAgentLead() {
q = document.getElementById('search-agent2').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoTeamleadagent.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoAgentReply2;
http.send(null);
}
function autoAgentReply2() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('agentResults2');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueAgent2(id,value){
	
	e = document.getElementById('search-agent-id2');
	e.value=id;
	e = document.getElementById('search-agent2');
	e.value=value;
	e = document.getElementById('agentResults2');
	e.style.display="none";
	}


	
	/* -------------------------- */
/* SEARCH ADMIN					 */
/* -------------------------- */
function autoAdmin() {
q = document.getElementById('search-admin').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoAdmin.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoAdminReply;
http.send(null);
}
function autoAdminReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('adminResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueAdmin(id,value){
	
	e = document.getElementById('search-admin-id');
	e.value=id;
	e = document.getElementById('search-admin');
	e.value=value;
	e = document.getElementById('adminResults');
	e.style.display="none";
	}
	
		/* -------------------------- */
/* SEARCH SUPER ADMIN					 */
/* -------------------------- */
function autoSuperAdmin() {
q = document.getElementById('search-superadmin').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoSuperAdmin.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoSuperAdminReply;
http.send(null);
}
function autoSuperAdminReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('superadminResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueSuperAdmin(id,value){
	
	e = document.getElementById('search-superadmin-id');
	e.value=id;
	e = document.getElementById('search-superadmin');
	e.value=value;
	e = document.getElementById('superadminResults');
	e.style.display="none";
	}
	
	
/* -------------------------- */
/* SEARCH Users/Employees - emp_payroll_new.php				 */
/* -------------------------- */
function autoEmployeePayroll() {
q = document.getElementById('search-employee-payroll').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoEmployeePayroll.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoEmployeePayrollReply;
http.send(null);
}
function autoEmployeePayrollReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('employee-payroll-results');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueEmployeePayroll(id,value){
	
	e = document.getElementById('search-employee-payroll-id');
	e.value=id;
	e = document.getElementById('search-employee-payroll');
	e.value=value;
	e = document.getElementById('employee-payroll-results');
	e.style.display="none";
	}

	
	
	
	
	/* -------------------------- */
/* SEARCH Parent					 */
/* -------------------------- */
function autoParent() {
q = document.getElementById('search-parent').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'lib/autoParent.php?q='+q+'&nocache = '+nocache);
http.onreadystatechange = autoParentReply;
http.send(null);
}
function autoParentReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('parentResults');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
function setValueParent(id,value){
	
	e = document.getElementById('search-parent-id');
	e.value=id;
	e = document.getElementById('search-parent');
	e.value=value;
	e = document.getElementById('parentResults');
	e.style.display="none";
	}
