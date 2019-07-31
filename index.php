<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Simple CRUD inTable</title>
	<link rel="stylesheet" href="assets/bootstrap.4.3.1.min.css">
	<link rel="stylesheet" href="assets/style.css">
	</head>
	<body>
		<?php require_once 'process.php'; ?>
		
		<!-- Session data -->
		<?php if (isset($_SESSION['message'])) {?>
			<div class="alert alert-<?=$_SESSION['msg_type'];?>">
				<?php 
					echo $_SESSION['message'];
					unset($_SESSION['message']);
					
					session_destroy();
				 ?>
			</div>
		<?php } ?>


		<div class="container">
			<h2 class="text-center">PHP Simple CRUD inTable</h2>
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<h2>User Data</h2>
					<hr>
					<form action="process.php" method="POST">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>Name</th>
								<th>Location</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>	
		<?php 
			$result = $mysqli->query("SELECT * FROM users");
		 ?>
		 <tr>
		 	<td>
				 <div class="form-group">
				 	<input type="text" class="form-control" name="name"  placeholder="Enter your name">
				 </div>
			 </td>
		 	<td>
				 <div class="form-group">
				 	<input type="text" class="form-control" name="location"  placeholder="Enter your location">
				 </div>
			 </td>
			 <td >
				<button type="submit" class="btn btn-primary btn-full" name="save">Create Data</button>			 	
			 </td>
		 </tr>
		<?php if (mysqli_num_rows($result) > 0): 
				while ($row = $result->fetch_assoc()):?>
							<tr>
								<td><?php

									if (isset($edit_mode) && $id == $row['id']) {
										?>
										<input type="hidden" name="id" value="<?php if(isset($id)) echo $id ;?>">
									<div class="form-group">
										<input type="text" class="form-control" name="name_update" value="<?php if(isset($name)) echo $name;?>">
									</div>
									<?php 
									}else{
										echo $row['name']; 
									}

								 ?></td>
								<td><?php 
									
									if (isset($edit_mode) && $id == $row['id']) {
										?>
									<div class="form-group">
										<input type="text" class="form-control" name="location_update" value="<?php if(isset($location)) echo $location;?>">
									</div>
									<?php 
									}else{
										echo $row['location']; 
									}


									?>
									
								</td>
								<td>
									
								<?php if (isset($submit_btn) && $id == $row['id']): ?>
									<button type="submit" class="btn btn-info" name="update">Update</button>
								<?php else: ?>
									<a class="btn btn-info" href="index.php?edit=<?= $row['id']; ?>">Edit</a>
								<?php endif; ?>

									<a class="btn btn-danger" href="process.php?delete=<?= $row['id']; ?>">Delete</a>
								</td>
							</tr>
		<?php endwhile;
			else:?>
							<tr>
								<td colspan="3" class="text-center bg-light"><h3 class="text-muted">Not Data To Show!</h3></td>
							</tr>
		<?php
			endif;?>
						</tbody>
					</table>
					</form> 
				</div>
			</div>
		</div>
	</body>
	</html>