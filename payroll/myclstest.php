<?php
session_start();
include('includes/db.php');

class mycls
{
	
	var $myvar1;
	var $myvar2;
	var $conn;
	var $company_id;
	function __construct()
	{
		$this->myvar1=165;	
		$this->myvar2=166;
		global $conn;
    	$this->conn = $conn;
		global $company_id;
		$this->company_id = $company_id;

	}
	
	function fn_house_rent($sec_id,$basic)
	{
		//$company_id =1;
		return $sql	="select ALLOWENCE_AMOUNT,ALLOWENCE_AFFECT from TBL_PAY_SECTION_ALLOWENCE_INFO where ALLOWENCE_HEAD_ID= ".$this->myvar2." and COMPANY_ID=".$this->company_id." and SECTION_ID=$sec_id";
		$qstr  = oci_parse($this->conn,$sql);
		oci_execute($qstr);
		if($row = oci_fetch_array($qstr, OCI_BOTH))
		{
			return $row[0];
		}
	
	}
	
}
$mytest =new mycls();
echo $mytest->fn_house_rent(1807,5200);



$valuel=11;
$valuek=22;
$valuem=33;

class test {
    var $code1,$code2,$code3;

    function __construct() {
            global $valuel;
			global $valuek;
			global $valuem;
            $this->code1 = $valuel;
            $this->code2 = $valuek;
            $this->code3 = $valuem;
			//echo $this->code2;

        }

}

$obj = new test();
?>