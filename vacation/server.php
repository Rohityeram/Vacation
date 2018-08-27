<?php 
	session_start();

	// variable declaration
	$vacation_date1 = "";
        $vacation_date2 = "";
	$paper_correction_date1 = "";
        $paper_correction_date2 = "";
	$exam_duty_date1 = "";
        $exam_duty_date2 = "";
	$username = "";          
	$id    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'registration');
               
        //============================================
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$id = mysqli_real_escape_string($db, $_POST['id']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($id)) { array_push($errors, "id is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, id, password) 
					  VALUES('$username', '$id', '$password')";
			mysqli_query($db, $query);

			header('location: update.php');
		}

	}
// =======================================================
// update date of vacation, eaxm and paper 
    elseif (isset($_POST['up_user'])) 
	{
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
				$vacation_date1 =$_POST['vacation_date1'];
                $vacation_date2 = $_POST['vacation_date2'];                
                $paper_correction_date1 = mysqli_real_escape_string($db, $_POST['paper_correction_date1']);
                $paper_correction_date2 = mysqli_real_escape_string($db, $_POST['paper_correction_date2']);
                $exam_duty_date1 = mysqli_real_escape_string($db, $_POST['exam_duty_date1']);
                $exam_duty_date2 = mysqli_real_escape_string($db, $_POST['exam_duty_date2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
               
                if (count($errors) == 0) 
		{                                      
                    $sdate = new DateTime($vacation_date1);
                    $edate = new DateTime($vacation_date2);                                             
                    $period = new DatePeriod($sdate,New DateInterval('P1D'),$edate);
                    foreach($period as $date)
                         {
                            $fdate=$date->format('Y-m-d');
                            $query_v = "INSERT INTO vacation (username, vacation_date) 
                                         VALUES('$username', '$fdate')";   
                                         mysqli_query($db, $query_v); 
                            }$query = "INSERT INTO vacation (username, vacation_date) 
                                         VALUES('$username', '$vacation_date2')";   
                                         mysqli_query($db, $query);
                             
                        $query_p = "INSERT INTO paper (username, paper_correction_date) 
					  VALUES('$username', '$paper_correction_date1'),('$username', '$paper_correction_date2')";
                        $query_e = "INSERT INTO exam (username, exam_duty_date) 
					  VALUES('$username', '$exam_duty_date1'),('$username', '$exam_duty_date2')";
			
                        mysqli_query($db, $query_p);
                        mysqli_query($db, $query_e);

			header('location: search.php');
		}

	}
//================================================
        // LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				header('location: update.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

//=====================================================        

	// Search USER
	if (isset($_POST['search_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$cdate = mysqli_real_escape_string($db, $_POST['cdate']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($cdate)) {
			array_push($errors, "Current Date is required");
		}

		if (count($errors) == 0) {
			
			$query_v = "SELECT * FROM vacation WHERE username='$username' AND vacation_date ='$cdate'";
			$results_v = mysqli_query($db, $query_v);
			$query_p = "SELECT * FROM paper WHERE username='$username' AND paper_correction_date ='$cdate'";
			$results_p = mysqli_query($db, $query_p);
			$query_e = "SELECT * FROM exam WHERE username='$username' AND exam_duty_date ='$cdate'";
			$results_e = mysqli_query($db, $query_e);

			if (mysqli_num_rows($results_v) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "User on Vacation";
				header('location: index.php');
			}
                        else if(mysqli_num_rows($results_p) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "User Doing paper correction";
				header('location: index.php');
			}
                        
                        else if(mysqli_num_rows($results_e) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "User on exam_duty";
				header('location: index.php');
			}
                        else  {
				array_push($errors, "No info found for this User\Date or user is free");
			}
		}
	}
?>



