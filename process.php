<?php 
	session_start();

	$mysqli = new mysqli('localhost' , 'root' , '' , 'mycrud') or die(mysqli_error($mysqli));

	// Save Data
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$location = $_POST['location'];

		$mysqli->query("INSERT INTO users (name , location) VALUES('$name', '$location') ") or die($mysqli->error);

		$_SESSION['message'] = 'Record has been saved';
		$_SESSION['msg_type'] = 'success';


		header("location: index.php");
	};

	// Delete Data

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];

		$mysqli->query("DELETE FROM users WHERE id = $id") or die($mysqli->error());

		$_SESSION['message'] = "Record has been deleted";
		$_SESSION['msg_type'] = 'danger';


		header("location: index.php");
	};


	// Edit Button Trigger

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$submit_btn = true;
		$edit_mode = true;
		$result = $mysqli->query("SELECT * FROM users WHERE id = $id") or die($mysqli->error());
		// print_r($result);
		if ($result) {
			$row = $result->fetch_array();
			$name = $row['name'];
			$location = $row['location'];
		}


	}
	// Update Data

	if (isset($_POST['update']) ) {
		$id = $_POST['id'];
		$name_update = $_POST['name_update'];
		$location_update = $_POST['location_update'];

		$mysqli->query("UPDATE users SET name='$name_update', location='$location_update' WHERE id = $id ") or die($mysqli->error);

		$_SESSION['message'] = "Record has been updated";
		$_SESSION['msg_type'] = 'warning';


		header("location: index.php");
	}