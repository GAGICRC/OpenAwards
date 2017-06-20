<?php
echo '<table class="table">
    <thead>
      <tr>
        <th>Nome</th>
		<th>Categoria</th>
      </tr>
    </thead>
    <tbody>';

		//obtem lista de todos os candidatos e respectivas categorias
		$sql = "SELECT * FROM candidates, categories where candidates.id_category = categories.id group by candidates.id";
		$result = $conn->query($sql);

		$count = $result->num_rows;
		if ($count > 0) {
			$i = 0;
			while($row = $result->fetch_assoc()) {
	echo '
	  <tr>
        <td>'.$row['name'].'</td>
		<td>'.$row['description'].'</td>
	  ';
				
			}
		}

echo '</tbody>
  </table>';
?>