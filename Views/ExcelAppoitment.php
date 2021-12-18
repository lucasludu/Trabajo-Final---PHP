<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=usuarios.xls');

	$conexion = mysqli_connect ("localhost", "root", " ");
	
	mysqli_select_db ($conexion, "worldWork");

	$sql ="SELECT * FROM appoitments";

	$resultado = mysqli_query ($conexion, $sql);

	$appoitmentsArray = array();

		while( $rows = mysqli_fetch_assoc($resultado) ) {

		$appoitmentsArray[] = $rows;

		}

	mysqli_close($conexion);
?>

<table border="1">
	<tr style="background-color:red;">
        <th>Empresa</th>
        <th>Puesto</th>
        <th>Email</th>
        <th>Mensaje</th>
        <th>CV</th>
	</tr>
	<?php
		 foreach($appoitmentsArray as $row) { ?>
			
				<tr>
					<td><?php echo $row['appoitmentId']; ?></td>
					<td><?php echo $row['jobOfferId']; ?></td>
					<td><?php echo $row['studentId']; ?></td>
					<td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['cv']; ?></td>
                </tr>	

			<?php
		}

	?>
</table>