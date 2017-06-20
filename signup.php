<?php
session_start();

	include_once("connect.php");
	if (isset($_REQUEST['email']) && isset($_REQUEST['pass']) && isset($_REQUEST['name']) && isset($_REQUEST['phone']))
	{
		$email = $_REQUEST['email'];
		$pass = $_REQUEST['pass'];
		$phone = $_REQUEST['phone'];
		$name = $_REQUEST['name'];
		
		$sql = "INSERT INTO users (email, password, name, phone, signup_date) VALUES ('$email', '$pass', '$name','$phone', now()) ";	
		$result = $conn->query($sql);

		$user_id = $conn->insert_id;
		if ($user_id>0) {
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_name'] = $name;
			$_SESSION['is_admin'] = false;
			
			$to      = $email;
			$subject = 'Bemvindo ao site de votos';
			$message = 'Agora já podes votar!';
			mail($to, $subject, $message);
			
			$result = array ('user_id'=>$user_id);					
		} else {
				$result = array ('error'=>"query failed");
		}		
		
	}
	else
	{		
		$result = array ('error'=>"args missing");
	}
	
    echo json_encode($result); 
?>