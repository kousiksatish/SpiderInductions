		
<?php
	session_start();
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pw = 'kousiksatish';

	
	$first = $_POST['first'];
	$last = $_POST['last'];
	$user = $_POST['user'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$passwd = $_POST['passwd'];
	$repasswd = $_POST['repasswd'];
	$github = $_POST['github'];
	$dept = $_POST['dept'];
	$pic = $_POST['pic'];
	$interests = $_POST['interests'];
	
	
	function passwdmatch($passwd, $repasswd)
	{
		if ($passwd == $repasswd)
			return true;
		else
			return false;
	}
	
	function uppercase($first, $last)
	{
		if(ctype_upper($first{0}) && ctype_upper($last{0}))
			return true;
		else
			return false;
	}
	
	function dept($dept)
	{
		if ($dept == 'select')
			return false;
		else
			return true;
	}

	function filled($first, $user, $email, $dob, $passwd, $repasswd, $dept)
	{
		if($first!=""&&$user!=""&&$email!=""&&$dob!=""&&$passwd!=""&&$repasswd)
			return true;
		else
			return false;
	}
	$flag = uppercase($first, $last) && dept($dept) && passwdmatch($passwd, $repasswd)
			&& filled($first, $user, $email, $dob, $passwd, $repasswd, $dept);
	
	$fileName = $_FILES['pic']['name'];
	$tmpName  = $_FILES['pic']['tmp_name'];
	$fileSize = $_FILES['pic']['size'];
	$fileType = $_FILES['pic']['type'];
	
	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);
	if($flag)
	{
		$_SESSION['registererror'] = false;
		$dbc = mysqli_connect($db_host, $db_user, $db_pw, 'spider')
				or die ('Error connecting to the database server');
		$query = "INSERT INTO register (first, last, username, email, dob, gender, passwd, github, dept, interests, pic) 
				VALUES ('$first', '$last', '$user', '$email', '$dob', '$gender', '$passwd', '$github', '$dept', '$interests', '$content' )";

		  $result = mysqli_query($dbc, $query)
			or die ('Error querying database');
		  echo 'Successfully registered!!';
		  echo ' <br><a href="index.php">Click here</a> to goback to home page';
		  

		  mysqli_close($dbc);
	}
	else
	{
		$_SESSION['registererror'] = true;
		header("location:register.php");
		
	}
		
		
?>
