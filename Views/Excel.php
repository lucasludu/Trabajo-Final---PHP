<?php
	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=usuarios.xls');

	$conexion = mysqli_connect ("localhost", "root", " ");
	
	mysqli_select_db ($conexion, "worldWork");

	$sql ="SELECT * FROM joboffers";

	$resultado = mysqli_query ($conexion, $sql);

	$jobOffersArray = array();

		while( $rows = mysqli_fetch_assoc($resultado) ) {

		$jobOffersArray[] = $rows;

		}

	mysqli_close($conexion);
?>

<table border="1">
	<tr style="background-color:red;">
    <th>Job Offer Id</th>
        <th>Publish Date</th>
        <th>Finish Date</th>
        <th>Task</th>
        <th>Skills</th>
        <th>Salary</th>
        <th>Job Position</th>
        <th>Company Id</th>
        <th>Career Id</th>
	</tr>
	<?php
		 foreach($jobOffersArray as $row) { ?>
			
				<tr>
					<td><?php echo $row['jobOfferId']; ?></td>
					<td><?php echo $row['publishedDate']; ?></td>
					<td><?php echo $row['finishDate']; ?></td>
					<td><?php echo $row['task']; ?></td>
                    <td><?php echo $row['skills']; ?></td>
					<td><?php echo $row['salary']; ?></td>
					<td><?php echo $row['jobPositionId']; ?></td>
					<td><?php echo $row['companyId']; ?></td>
					<td><?php echo $row['careerId']; ?></td>
                </tr>	

			<?php
		}

	?>
</table>