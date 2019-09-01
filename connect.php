<?php

$connection = new mysqli("localhost","root","","crud") OR die("Error".mysqli_error($connection));

session_start();

if (isset($_POST['submit'])) {
	# code...
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		# code...
		$email = $_POST['email'];
		$password = $_POST['password'];

		$query = "INSERT INTO users(email, password) values(?, ?)";

		$result = $connection->prepare($query);
		$result->bind_param('ss', $email, $password);

		if ($result->execute()) {
			# Alert message
			$_SESSION['message'] = "New Users successfully inserted.";
			$_SESSION['alert'] = "alert alert-success";
		}
		$result->close();
		$connection->close();
	}
	else{
		# alert message
		$_SESSION['message'] = "Email and Password should not be empty.";
		$_SESSION['alert'] = "alert alert-warning";
	}
	header("location: index.php");
}
# code for Delete
if (isset($_POST['delete'])) {
	# code...
	$id = $_POST['delete'];

	$query = "DELETE FROM users WHERE id = ?;";

	$result = $connection->prepare($query);

	$result->bind_param('i', $id);
	if ($result->execute()) {
		# code...
		$_SESSION['message'] = "Selected User successfully deleted.";
		$_SESSION['alert'] = "alert alert-danger";
	}
	$result->close();
	$connection->close();

	header("location: index.php");

}
# Update Users data
if (isset($_POST['update'])) {
		# code...
		if (!empty($_POST['email']) && !empty($_POST['password'])){
			# code...
			$email = $_POST['email'];
			$password = $_POST['password'];
			$id  = $_POST['update'];

			$query = "UPDATE users SET email= ?, password = ? WHERE id = ?";

			$result = $connection->prepare($query);
			$result->bind_param('ssi', $email, $password, $id);

		if ($result->execute()) {
			# Alert message
			$_SESSION['message'] = "Selected Users successfully updated.";
			$_SESSION['alert'] = "alert alert-success";
		}

		$result->close();
		$connection->close();
	}
	header("location: index.php");
}

?>