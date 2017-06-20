<?php
session_start();

	include_once("connect.php");
	
	if (isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];

		// apage a categoria com o id recebido na request
		$sql = "DELETE FROM categories WHERE id = $id ";	
		$conn->query($sql);
	}
?>