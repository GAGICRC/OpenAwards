<?php
session_start();

	include_once("connect.php");
	if (isset($_REQUEST['id']) && isset($_REQUEST['email']) && isset($_REQUEST['pass']) && isset($_REQUEST['name']) && isset($_REQUEST['phone']))
	{
		$email = $_REQUEST['email'];
		$pass = $_REQUEST['pass'];
		$phone = $_REQUEST['phone'];
		$name = $_REQUEST['name'];
		
		$id  = $_REQUEST['id'];
		// altera os dados da base de dados relativos ao user selecionado
		$sql = "UPDATE users SET email='$email', password='$pass', name='$name', phone='$phone' WHERE id = $id";	
		$conn->query($sql);

		$result = array ('user_id'=>$id);		
	}
	else
	{		
		$result = array ('error'=>"args missing");
	}
	
    echo json_encode($result); 
?>