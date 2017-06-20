<?php
echo '<table class="table">
    <thead>
      <tr>
        <th>Descrição</th>
        <th>Prémio</th>
		<th>Data Inicio</th>
        <th>Data Fim</th>
		<th>Vencedor</th>';
		
		if ($isAdmin) {
			echo '<th></th>';
		}
	echo '
      </tr>
    </thead>
    <tbody>';

		// script que vai listar todas as categorias
		$sql = "SELECT * FROM categories";
		$result = $conn->query($sql);

		$count = $result->num_rows;
		if ($count > 0) {
			$i = 0;
			while($row = $result->fetch_assoc()) {
	echo '
	  <tr>
        <td>'.$row['description'].'</td>
        <td>'.$row['prize'].'</td>
		<td>'.date("m/d/Y", strtotime($row['start_date'])).'</td>
        <td>'.date("m/d/Y", strtotime($row['end_date'])).'</td>
		<td>';
		if ((int)$row['id_winner']>0) {
			$sql2 = "SELECT * FROM candidates where id=".$row['id_winner'];
			$result2 = $conn->query($sql2);
			$row2 = $result2->fetch_assoc();		
				echo $row2['name']; 
		}else echo '-';
		echo 
			'</td>';
			
		if ($isAdmin) {
			// se for admin, mostra butoes de ediçao
			echo '<td><button type="button" class="btn btn-primary" onclick="editCategory('.$row['id'].', \''.$row['description'].'\', \''.$row['prize'].'\')">Editar</button>  &nbsp;';
			echo '<button type="button" class="btn btn-primary" onclick="deleteCategory('.$row['id'].')">Apagar</button></td>';
		}
			
			echo '
      </tr>
	  ';
				
			}
		}

echo '</tbody>
  </table>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCatModal">Criar Categoria</button>
  
  ';
  
  
?>