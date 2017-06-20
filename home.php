<?php
echo '<h2 class="w3ls_head">Votações Abertas</h2>';

		// obtem lista de todas as categorias activas
		$sql = "SELECT *, DATEDIFF(end_date, CURDATE()) as diff FROM categories WHERE id_winner = 0";
		$result = $conn->query($sql);

		$count = $result->num_rows;
			$i = 0;
			$inc = 0;
		if ($count > 0) {
			while($row = $result->fetch_assoc()) {
				
				$diff = (int)$row['diff'];
				// verifica se esta votacao já terminou, se sim, é necessario escolher o vencedor
				if ($diff<0) {
					// conta quantos votos há nesta cateogria
					$sqlx = "SELECT count(*) as total FROM votes where id_category = ".$row['id'];
					$resultx = $conn->query($sqlx);
					$temp = $resultx->fetch_assoc();						
					$total = (int)$temp['total'];
					
					// obtem todos os candaditatos desta categoria
					$sql2 = "SELECT * FROM candidates where id_category = ".$row['id'];
					$result2 = $conn->query($sql2);
					
					$maxPercent = -1;
					while($row2 = $result2->fetch_assoc()) {
						if ($total<=0) {
							$winner = $row2['id'];
							break;
						}						

						// obtem o numero de votos neste candidato
						$sql3 = "SELECT count(*) as total FROM votes where id_candidate = ".$row2['id'];
						$result3 = $conn->query($sql3);
						$temp = $result3->fetch_assoc();
						
						$votes = (int)$temp['total'];
						
						$percent = ($votes * 100) / $total;

						// verifica se é o candidato com mais votos
						if ($percent > $maxPercent) {
							$winner = $row2['id'];
						}
					}
					
					$sql5 = 'UPDATE categories SET id_winner = '.$winner.' WHERE id='.$row['id'];
					$conn->query($sql5);
					continue;
				}
				
				// se estamos logados, é nececessario ver se ja votamos nisto
				if ($hasLogin) {
					$sql2 = 'SELECT * from votes where id_category = '.$row['id'].' and id_voter='.$userID;
					$result2 = $conn->query($sql2);
					if ($result2->num_rows >0) {
						continue;
					}
				}
								
				// a cada 3 votacoes passa pra linha seguinte
				if ($i % 3 == 0) {				
					echo '<div class="agileinfo_services_grids">';
				}
			
				$inc++;
					echo '
				<div class="col-md-4 agileinfo_services_grid" id="poll_'.$row['id'].'">
					<div class="agileinfo_services_grid1">
						<h4>'.$row['description'].'</h4>
						<p>Prémio: '.$row['prize'].'</p>
						<p>Acaba em  '.$row['end_date'].'</p>
						';

					// obtem lista de candidatos para esta categoria
					$sql2 = "SELECT * FROM candidates WHERE id_category = " . $row['id'];
					$result2 = $conn->query($sql2);
					if ($result2) {						
						$j = 0;
						while($row2 = $result2->fetch_assoc()) {
							// mostra radiobutton para o voto
							echo '<div class="radio"><label><input type="radio" value="" id="candidate_'.$row['id'].'_'.$j.'" name="vote_'.$row['id'].'">'.$row2['name'].'</label>
							 <input type="hidden" id="vote_'.$row['id'].'_'.$j.'" value="'.$row2['id'].'">
							 <input type="hidden" id="name_'.$row['id'].'_'.$j.'" value="'.$row2['name'].'">
							 </div>';							 
							$j++;
						}
					}
						
						if ($hasLogin) {
							echo '<button type="button" class="btn btn-primary" onclick="submitVote('.$row['id'].', '.$result2->num_rows.')">Votar</button>';	
						}
						else {
							echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Entra para votar</button>';
						}
						
						
				echo '
					</div>
				</div>';					
	
				if ($i % 3 == 2 || $i ==  $count-1) {					
					echo '<div class="clearfix"> </div>';
					echo '</div>	';
				}
			}
				
				$i++;
		}
	
	if ($inc==0) {
		echo '<p class="text-center">Não há votações abertas</p>';
	}

		
echo '
			<div class="latest">			
				<h3 class="w3ls_head">Ultimos Vencedores</h3>';

		// seleciona todas as votacoes que ja encerraram
		$sql = "SELECT * FROM categories, candidates WHERE id_winner > 0 && categories.id = candidates.id_category and candidates.id = id_winner";
		$result = $conn->query($sql);

		$count = $result->num_rows;
		while($row = $result->fetch_assoc()) {
				echo '<div class="col-md-4 latest-w3l-left">
					<h4>'.$row['description'].'</h4>					
					<p>Vencedor: '.$row['name'].'</p>
					<p>Prémio: '.$row['prize'].'</p>
				</div>
			';			
		}	
						

				
echo'				 
<div class="clearfix"></div>
</div>
			</div>';
?>