<?php 
	// APi untuk menampilkan list schedule

	include "connection.php";

	$stage 	= $_GET['stage'];

	$returnData       	= array();
    $response         	= "OK";
    $statusCode       	= 200;
    $result           	= null;
    $message          	= "Get schedule data success.";

	$qry 				= mysql_query("SELECT s.id, s.urutan, s.name, s.time, s.stage, i.file
									FROM table_schedule s, table_icon i
									WHERE s.icon = i.id 
									AND s.stage = '".$stage."'");
	$count 				= mysql_num_rows($qry);

	if($count!=0){
		
		$returnData['response']=$response;
		$returnData['status_code']=$statusCode;
		$returnData['message']=$message;

		while ($data = mysql_fetch_object($qry)) {
			$result['id']		=$data->id;
			$result['urutan']	=$data->urutan;
			$result['name']		=$data->name;
			$result['time']		=$data->time;
			$result['stage']	=$data->stage;
			$result['icon']		=$data->file;
			
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