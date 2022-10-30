<?php

include_once('../lib/mysql_connect.php');

$sql_get_data=" SELECT IFNULL(count(emp.employee_id),0) as total_emp_count, comp.*
FROM tbl_companies as  comp
LEFT JOIN tbl_employees as emp
ON comp.company_id = emp.company_id 
GROUP BY comp.company_id 
ORDER BY comp.company_id ASC";
			
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