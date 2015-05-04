<?php 
	// API untuk menampilkan list lagu

	include "connection.php";

	$id = $_GET['id'];

	$returnData       	= array();
    $response         	= "OK";
    $statusCode       	= 200;
    $result           	= null;
    $message          	= "Get schedule data success.";

	$qry 				= mysql_query("SELECT id_song, song_title FROM table_song WHERE id_artist='".$id."'");
	$count 				= mysql_num_rows($qry);

	if($count!=0){
		
		$returnData['response']=$response;
		$returnData['status_code']=$statusCode;
		$returnData['message']=$message;

		while ($data = mysql_fetch_object($qry)) {
			$result['id_song']		=$data->id_song;
			$result['song_title']	=$data->song_title;
			
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