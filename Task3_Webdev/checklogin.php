
<?php
	session_start();
	
	//Database details
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pw = 'kousiksatish';
	
	// Define $username and $password 
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$rem=$_POST['remember'];

	// To protect MySQL injection (more detail about MySQL injection)
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	//Connect to database
	$dbc = mysqli_connect($db_host, $db_user,$db_pw , 'spider')
			or die ('Error connecting to the database server');		
	//$sql="SELECT * FROM reg_login WHERE rollno='$username' and password='$password';"
	//loc		or die ('Error qurying');
	
	$query="SELECT * FROM register;"
		or die('Error querying');
	$result=mysqli_query($dbc,$query);
//	while($row=mysqli_fetch_array($result))
	//	echo $row['password'];
	
//	$_SESSION['username']=$username;
//	echo $_SESSION['username'];
	//header("location:session_home.php");
	$check=false;
	echo $password . $username;
	while($row=mysqli_fetch_array($result))
	{
		echo $row['username'] . $row['passwd'];
		if($row['passwd']==$password&&$row['username']==$username)
		{
			$check=true;
			break;

		//$_SESSION['username']=$username;
		//header("location:session_home.php");

		}
		//else 
		//{
		//$_SESSION['wrong']=true;
		//$_SESSION['username']=$username;
		//header("location:session_home.php");
				
		//}
	}   
	if($check)
	{
		$_SESSION['user']=$username;
		$_SESSION['wrong']=false;
		if($rem)
		{
			setcookie("spideruser", "$username" , time()+360000, "/summer/backend","fr.localhost.com", 0);
		}
		header("location:index.php");
		echo "Success";
	}
	else
	{
		$_SESSION['wrong']=true;
		header("location:index.php");
		echo "Failure";
	}
/*
	
	
	$result=mysqli_query($sql);
	$row=mysqli_fetch_array($result, MYSQLI_BOTH);
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);//MYSQL_NUMROWS($result);
	echo $count;
	// If result matched $username and $password, table row must be 1 row
	if($row)
	{
	// Register $username and redirect to file "login_success.php"
	$_SESSION['username']=$username;
	header("location:session_home.php");
	}
	else 
	{
	$_SESSION['username']=$row;
	$_SESSION['wrong']=false;
	header("location:session_home.php");
	
	}
*/	
	mysqli_close($dbc);
	
?>
	


