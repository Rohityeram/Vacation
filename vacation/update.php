<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Update</h2>

<a href="search.php">Search</a>


	</div>
	<form method="post" action=update.php>
		<?php include('errors.php'); ?>

                <div class="input-group">
			<label>User Name</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
            
            
		<div class="input-group">
			<label>Vacation Date From</label>
                        <input type="date" name="vacation_date1" value="<?php echo $vacation_date1; ?>">
		</div>
            <div class="input-group">
			<label>Vacation Date To</label>
                        <input type='Date' name="vacation_date2" value="<?php echo $vacation_date2; ?>">
		</div>
            
            
            
            <div class="input-group">
			<label>Paper Correction Date1</label>
			<input type="Date" name="paper_correction_date1" value="<?php echo $paper_correction_date1; ?>">
		</div>
            <div class="input-group">
			<label>Paper Correction Date2</label>
			<input type="date" name="paper_correction_date2" value="<?php echo $paper_correction_date2; ?>">
		</div>
            
            
            <div class="input-group">
			<label>Exam Duty Date1</label>
			<input type="date" name="exam_duty_date1" value="<?php echo $exam_duty_date1; ?>">
		</div>
            <div class="input-group">
			<label>Exam Duty Date2</label>
			<input type="date" name="exam_duty_date2" value="<?php echo $exam_duty_date2; ?>">
		</div>
            

		<div class="input-group">
			<button type="submit" class="btn" name="up_user">update</button>
		</div>
		
	</form>
</body>
</html>