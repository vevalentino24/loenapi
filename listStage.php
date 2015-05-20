<?php 
	// APi untuk menampilkan list schedule

	include "connection.php";

	$returnData       	= array();
    $response         	= "OK";
    $statusCode       	= 200;
    $result           	= null;
    $message          	= "Get schedule data success.";

	$qry 				= mysql_query("SELECT * FROM table_stage");
	$count 				= mysql_num_rows($qry);

	if($count!=0){
		
		$returnData['response']=$response;
		$returnData['status_code']=$statusCode;
		$returnData['message']=$message;

		while ($data = mysql_fetch_object($qry)) {
			$result['id']		=$data->id;
			$result['name']		=$data->name;
			
			$returnData['result'][]=$result;
		}	
	}else{
		$returnData['response'] = "FAILED";
		$returnData['status_code'] = 400;
		$returnData['message'] = "No Data";
	}
	

	header('access-control-allow-origin : *');
    echo json_encode($returnData, JSON_PRETTY_PRINT);
?>