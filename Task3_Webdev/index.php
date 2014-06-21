<?php
	//session_destroy();
	session_start();
	if($_COOKIE['spideruser'])
	{
		$_SESSION['user']=$_COOKIE['spideruser'];
	
	}
	
	//Database details
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pw = 'kousiksatish';
	
?>


<html>
	<head>
		
		<title>Welcome</title>
		
			
	</head>

	<body>
		
		<center>
			
			<?php
			if($_SESSION['wrong'])
				echo 'Authentication failed! Try again';
			if(!isset($_SESSION['user']))
			{
				?>
				
				<h1>Login!!!</h1>
			<form action="checklogin.php" method = "post">
				
				<input type = "text" name = "username" placeholder = "Enter your Username">
				<br>
				<input type = "password" name = "password" placeholder = "Enter your Password">
				<br>
				<input type = "checkbox" name = 'remember'>Remember me on this computer<br>
				<input type = "submit">
				
			</form>
			<a href="register.php">New user? Register</a>
			<?php
			}
			else
			{
				
				$db_host = 'localhost';
				$db_user = 'root';
				$db_pw = 'kousiksatish';	
				$dbc = mysqli_connect($db_host, $db_user,$db_pw , 'spider')
							or die ('Error connecting to the database server');		
				$query="SELECT * FROM register;"
					or die('Error querying');
				$result=mysqli_query($dbc,$query);
				while($row=mysqli_fetch_array($result))
				{					
					if($row['username'] == $_SESSION['user'])
					{
						if($row['pic'])
							echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'" height="100" width="100"/>';
						else
						{
							if($row['gender'] == 'M')
								echo '<img src="img/nodp_male.jpg" height="100" width="100">';
							else
								echo '<img src="img/nodp_female.jpg" height="100" width="100">';
						}
						echo '<br>Hello ' . $row['first'] . ' ' . $row['last'] . '!!!';
					}
				
				}   
				echo '<br>You are logged in as ' . $_SESSION['user'] . '<br>';
				
				echo '<a href="logout.php">Logout</a>';
			}
				?>
		</center>
	
	</body>
