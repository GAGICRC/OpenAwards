<?php
session_start();

	include_once("connect.php");
	if (isset($_REQUEST['id']) && isset($_REQUEST['candidate']))
	{
		$category = $_REQUEST['id'];
		$candidate = $_REQUEST['candidate'];
		
		$user_id = $_SESSION['user_id'];
		
		$sql = "INSERT INTO votes (id_voter, id_candidate, id_category, date) VALUES ('$user_id', '$candidate', '$category', now()) ";	
		$result = $conn->query($sql);

		$result = array ('vote'=>"ok");
	}
	else
	{		
		$result = array ('error'=>"args missing");
	}
	
    echo json_encode($result); 
?>