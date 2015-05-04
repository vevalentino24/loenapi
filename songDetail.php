<?php 
	// API untuk menampilkan detail lagu 

	include "connection.php";

	$id = $_GET['id'];

	$returnData       	= array();
    $response         	= "OK";
    $statusCode       	= 200;
    $result           	= null;
    $message          	= "Detail song success.";

	$qry 				= mysql_query("SELECT table_artist.name, table_song.song_title, table_song.song_lyric
										FROM table_artist, table_song
										WHERE table_artist.id = table_song.id_song
										AND table_song.id_song = '".$id."'");
	$count 				= mysql_num_rows($qry);

	if($count!=0){
		
		$returnData['response']=$response;
		$returnData['status_code']=$statusCode;
		$returnData['message']=$message;

		while ($data = mysql_fetch_object($qry)) {
			$result['name']		=$data->name;
			$result['title']	=$data->song_title;
			$result['lyric']	=$data->song_lyric;
			
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