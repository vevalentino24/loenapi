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
			$isi = array();

			$qry_scedule 		= mysql_query("SELECT s.id, s.urutan, s.name, s.time, s.stage, i.file
									FROM table_schedule s, table_icon i
									WHERE s.icon = i.id 
									AND s.stage = '".$data->id."' ORDER BY s.urutan");
			
			$result['items'] = array();
			$i=0;
			while ($schedule = mysql_fetch_object($qry_scedule)) {
				
				$isi['id']		=$schedule->id;
				$isi['urutan']	=$schedule->urutan;
				$isi['name']	=$schedule->name;
				$isi['time']	=$schedule->time;
				$isi['stage']	=$schedule->stage;
				$isi['icon']	=$schedule->file;
				$result['items'][$i]	=$isi;
				$i++;
			}

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