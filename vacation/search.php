<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Search</h2>
	</div>
	
	<form method="post" action="search.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Current Date</label>
                        <input type="date" name="cdate">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="search_user">Search</button>
		</div>
		
	</form>
</body>
</html>