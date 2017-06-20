<?php
echo '<table class="table">
    <thead>
      <tr>
        <th>Email</th>
        <th>Nome</th>
		<th>Contacto</th>
        <th>Data registo</th>
		<th>Permissões</th>';
		
		if ($isAdmin) {
			echo '<th></th>';
		}
	echo '
      </tr>
    </thead>
    <tbody>';
    
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);

		$count = $result->num_rows;
		if ($count > 0) {
			$i = 0;
			while($row = $result->fetch_assoc()) {
	echo '
	  <tr>
        <td>'.$row['email'].'</td>
        <td>'.$row['name'].'</td>
		<td>'.$row['phone'].'</td>
        <td>'.$row['signup_date'].'</td>
		<td>';
		if ($row['admin']=='1') echo 'Admin'; else echo '-';
		echo 
			'</td>';
			
		if ($isAdmin) {
			echo '<td><button type="button" class="btn btn-primary" onclick="editUser('.$row['id'].', \''.$row['email'].'\', \''.$row['password'].'\', \''.$row['name'].'\', \''.$row['phone'].'\')">Editar</button>  &nbsp;';
			echo '<button type="button" class="btn btn-primary" onclick="deleteUser('.$row['id'].')">Apagar</button></td>';
		}
			
			echo '
      </tr>
	  ';
				
			}
		}

echo '</tbody>
  </table>';
?>