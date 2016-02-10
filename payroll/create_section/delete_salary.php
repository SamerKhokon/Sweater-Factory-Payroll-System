<?php
session_start();
include '../includes/db.php';
$company_id	=$_SESSION["company_id"];
$id			=trim($_POST['id']);
$yesEmp=0;
$msg="";
$sql="select SECTION_ID,GRADE from TBL_PAY_SALARY_SETTING where ID=$id";
$stid	= mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($stid)) 
	{
		$section_id=$row[0];
		$grade=$row[1];
		$sql="select count(ID) from TBL_PAY_EMP_PROFILE where 
		GRADE='$grade' and SECTION_ID=$section_id and COMPANY_ID=$company_id";
		$stid2	= mysqli_query($conn,$sql);
		
		if($row = mysqli_fetch_array($stid2)) 
		{
			//$yesEmp=$row[0];
		}
		$yesEmp==0;
		if($yesEmp==0)
		{
			$sql="delete from TBL_PAY_SALARY_SETTING where ID=$id";
			$stid2	= mysqli_query($conn, $sql);
			
			$msg='Salary Delete Successfully';
		}
		else
			$msg='This Salary Uses Employee';
	}
echo $msg;
echo '!@#$';
echo $section_id;
?>