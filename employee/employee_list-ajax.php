<?php

include_once('../lib/mysql_connect.php');

$sql_get_data=" SELECT emp.*,  comp.company_name  
		FROM tbl_employees as emp 
		INNER JOIN tbl_companies as comp
		ON emp.company_id = comp.company_id";

$sql_get_data=$sql_get_data." ORDER BY emp.employee_id ASC";
			
$result_get_data=mysqli_query($conn,$sql_get_data) or die(mysqli_error($conn));

$response = new stdClass();

$i=0;
while($row_get_data=mysqli_fetch_assoc($result_get_data)){
	
	foreach($row_get_data as $fieldname=>$value ){
		$response->rows[$i][$fieldname]=$value;
		
	}
	$i++;	
}


echo json_encode($response);


?>