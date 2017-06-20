<?php
session_start();

	include_once("connect.php");

		// apaga o user selecionado na request
	if (isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
		
		$sql = "DELETE FROM users WHERE id = $id ";	
		$conn->query($sql);
	}
?>