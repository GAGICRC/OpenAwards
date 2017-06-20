<?php
   
		$sql = "SELECT count(*) as total, id_category, description FROM votes, categories where id_category = categories.id group by id_category";
		$result = $conn->query($sql);
		
		$styles = array("progress-bar-info", "progress-bar-danger", "progress-bar-success", "progress-bar-warning");

		$count = $result->num_rows;
		if ($count > 0) {
			while($row = $result->fetch_assoc()) {
				echo '				<div class=" agileinfo_services_grid">
				  <h5>Votação: '.$row['description'].'</h5><br>
				  ';
					
					$total = (int)$row['total'];
				
					$sql2 = "SELECT * FROM candidates where id_category = ".$row['id_category'];
					$result2 = $conn->query($sql2);

					$j = 0;
					while($row2 = $result2->fetch_assoc()) {
						$sql3 = "SELECT count(*) as total FROM votes where id_candidate = ".$row2['id'];
						$result3 = $conn->query($sql3);
						$temp = $result3->fetch_assoc();
						
						$votes = (int)$temp['total'];
						
						$percent = (int)(($votes * 100) / $total);
					
						echo '			 
					  <strong>'.$row2['name'].'</strong><span class="pull-right">'.$votes.' ('.$percent.'%)</span>
					  <div class="progress active">
								<div class="progress-bar '.$styles[$j % 4].'" style="width: '.$percent.'%"></div>
					  </div>';
					  $j++;
					}
					
					echo '
				</div>	  
				<br><br>';
				
			}
		}

?>