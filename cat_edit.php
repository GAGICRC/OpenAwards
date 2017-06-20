<?php
session_start();

	include_once("connect.php");
	if (isset($_REQUEST['id']) && isset($_REQUEST['desc']) && isset($_REQUEST['prize']))
	{
		$desc = $_REQUEST['desc'];
		$prize = $_REQUEST['prize'];
		
		$id  = $_REQUEST['id'];
		
		// altera os dados desta categoria com os novos dados vindos da request
		$sql = "UPDATE categories SET description='$desc', prize='$prize' WHERE id = $id";	
		$conn->query($sql);

		$result = array ('user_id'=>$id);		
	}
	else
	{		
		$result = array ('error'=>"args missing");
	}
	
    echo json_encode($result); 
?>