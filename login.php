<?php
session_start();

	include_once("connect.php");
	if (isset($_REQUEST['email']) && isset($_REQUEST['pass']))
	{
		$email = $_REQUEST['email'];
		$pass = $_REQUEST['pass'];

		// condicao especial para admin
		if ($email == 'admin' && $pass=='admin') {
					$_SESSION['user_id'] = 0;
					$_SESSION['user_name'] = "Admin";
					$_SESSION['is_admin'] = true;
					
					$result = array ('user_id'=>"0");			
		} else 
		{			
			// verifica se o user existe na base de dados
			$sql = "SELECT * FROM users WHERE email='$email'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				// comparar email e user
				if ($email == $row['email'] && $pass == $row['password']) { 
					$user_id = $row['id'];
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_name'] = $row['name'];
					$_SESSION['is_admin'] = $row['admin'] == '1';
					
					$result = array ('user_id'=>$user_id);
				}
				else {
					$result = array ('error'=>"invalid login details");
				}
				
			} else {
					$result = array ('error'=>"query failed");
			}		
		}
		
	}
	else
	{		
		$result = array ('error'=>"args missing");
	}
	
    echo json_encode($result); 
?>