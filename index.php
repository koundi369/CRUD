<!DOCTYPE html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>CRUD!</title>
  </head>
  <body>
  	<div class="container mt-2 mb-4 p-2 shadow bg-white">
  		<form action="connect.php" method="POST">
  			<div class="form-row justify-content-center">
  				<div class="col-auto">
  					<input type="email" name="email" class="form-control" placeholder="Enter Email" id="email">
  				</div>
  				<div class="col-auto">
  					<input type="password" name="password" class="form-control" placeholder="Enter password" id="password">
  				</div>
  				<div class="col-auto">
  					<button type="submit" class="btn btn-info"  name="submit">Submit</button>
  				</div>
  			</div>
  		</form>
  		

  	</div>

  	<?php require_once("connect.php") ?>

  	<div class="container">
  		<?php if(isset($_SESSION['message'])): ?>
  			<div class="<?= $_SESSION['alert']; ?>">
  				<?= $_SESSION['message'];
  				unset($_SESSION['message']); ?>
  			</div>
  		<?php endif; ?>
  		<table class="table">
  			<thead>
  				<tr>
  					<th>Id</th>
  					<th>Email</th>
  					<th>Password</th>
  					<th>Action</th>
  				</tr>
  			</thead>
  			<tbody>
  				<form action="connect.php" method="POST">
  				<?php #Display Users
  				$query = "SELECT * FROM users LIMIT 15";
  				$result = $connection->query($query);

  				$x = 1;

  				while ($row = $result->fetch_assoc()):?>
	  			<tr>
	  				<td><?= $row['id']; ?></td>
	  				<td><?= $row['email']; ?></td>
	  				<td><?= $row['password']; ?></td>
	  				<td>
	  					<button type="submit" name="delete" value="<?= $row['id']; ?>"class="btn btn-danger">Delete</button>
	  					<button type="submit" name="update" value="<?= $x; $x++; ?>" class="btn btn-primary">Update</button>
	  				</td>
				</tr> 
  						
  				<?php endwhile; ?>
  			</form>
  			</tbody>
  		</table>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
    	$(document).ready(function(){
    		setTimeout(function(){
    			$(".alert").remove();
    		}, 3000);

    		$(".btn-primary").click(function(){
    			$(".table").find('tr').eq(this.value).each(function(){
    				$("#email").val($(this).find('td').eq(1).text());
    				$("#password").val($(this).find('td').eq(2).text());
    				$(".btn-info").val($(this).find('td').eq(0).text());
    			});
    			$(".btn-info").attr("name","update");
    		});
    	});
    </script>

    </body>
</html>
