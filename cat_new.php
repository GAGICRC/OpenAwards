<?php
session_start();

	include_once("connect.php");
	
	if (isset($_REQUEST['desc']) && isset($_REQUEST['prize']) && isset($_REQUEST['duration']) && isset($_REQUEST['cands']))
	{
		$desc = $_REQUEST['desc'];
		$prize = $_REQUEST['prize'];
		$duration = $_REQUEST['duration'];
		$cands = explode("|", $_REQUEST['cands']);

		// insere uma nova categoria na base de dados com dados vindos da dba_close
		// a data final é calculada somando a data atual a duraçao em dias
		$sql = "INSERT INTO categories (description, prize, start_date, end_date) VALUES ('$desc', '$prize', now(), now() + INTERVAL $duration DAY) ";	
		$result = $conn->query($sql);

		// obter o id da nova categoria
		$cat_id = $conn->insert_id;
		if ($cat_id>0) {
			
			// inserir todos os candidatos desta nova categoria
			foreach ($cands as $candidate) {
				$sql = "INSERT INTO candidates (name, id_category) VALUES ('$candidate', '$cat_id') ";	
				$conn->query($sql);				
			}
			$result = array ('cat_id'=>$cat_id);
			
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