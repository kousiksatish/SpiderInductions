

<html>
<head>
<title>Registration Form!!!</title>
<h1>Registration</h1>
Note: Best viewed in chrome!!!<br><br>
<style>
#half1
{
	width : 20%;
	float:left;
	min-height : 90%;
	//background : red;
	//border : 10px solid gray;
	text-align : right;
	line-height : 40px;
}

.ss
{
	
	line-height : 31px;
}

#half2
{
	width : 40%;
	float:left;
	line-height : 40px !important;
	min-height : 87%;
	//border : 10px solid gray;
	//padding-top : 20px;
	padding-left : 10px;
	
}
form
{
	line-height : 40px;
}
.error
{
	color : red;
}
</style>

<script src="register.js">
	
</script>


</head>

<body>
	
<?php
	if(isset($_POST['submit']))
	{

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
		$outputform=true;
		
		function passwd($passwd, $repasswd)
		{
			if(strlen($passwd)<6) 
			{
				echo '<br>Password too short!';
				return 0;
			}	
			else if (!($passwd == $repasswd))
			{
				echo '<br>Passwords do not match!!!';
				$flag = false;
			}
			else
				$flag = true;
			return $flag;
		}
		
		function uppercase($first)
		{
			if(!(ctype_upper($first{0})))
			{
				echo '<br>First letter of Names must be capitalized!!!';
				$flag = false;
			}
			else
				$flag = true;
			return $flag;
		}
		
		function dept($dept)
		{
			if ($dept == 'select')
			{
				echo '<br>Select department!!!';
				$flag = false;
			}
			else
				$flag = true;
			return $flag;
		}

		function filled($first, $user, $email, $dob, $passwd, $repasswd)
		{
			if(!($first!=""&&$user!=""&&$email!=""&&$dob!=""&&$passwd!=""&&$repasswd!=""))
			{
				echo '<br>All required fields not filled!!!';
				$flag = false;
			}
			else
				$flag = true;
			return $flag;
		}
		function precedence_username($user,$db_host,$db_user,$db_pw)
		{
			$dbc = mysqli_connect($db_host, $db_user, $db_pw, 'spider')
					or die ('Error connecting to the database server');
			$query="SELECT username FROM register;";
			$result=mysqli_query($dbc,$query);
			$flag=true;
			while($row=mysqli_fetch_array($result))
			{
				
				 if($row['username']==$user)
				 {
					echo "</br>".'Username already registered!!!';
					$flag=false;
					break;
				 }
			}
			return $flag;
		}
		function checkemail($email)
		{
			if($email!="")
			{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					echo "<br>Email id not valid!!!";
					$flag = false;
				}
				else
					$flag = true;
			}
			else
				$flag = false;
			return $flag;
		}
		function gitcheck($github)
		{
			$flag = true;
			if(strlen($github)!=0)
			{
				$git1 = substr($git,0,18);
				$git2 = substr($git,0,19);
				if($git1!="http://github.com/"&&$git2!="https://github.com/")
				{
					echo '<br>Invalid github link!!!';
					$flag = false;
				}
				else
					$flag = true;
			}
			
		}
		
		$u = uppercase($first, $last);
		$d = dept($dept);
		$p = passwd($passwd, $repasswd);
		$f = filled($first, $user, $email, $dob, $passwd, $repasswd);
		$pre = precedence_username($user,$db_host,$db_user,$db_pw);
		$e = checkemail($email);
		$g = gitcheck($github);
		$corr = $u && $d && $p && $f && $pre && $e && $g;
		
		$fileName = $_FILES['pic']['name'];
		$tmpName  = $_FILES['pic']['tmp_name'];
		$fileSize = $_FILES['pic']['size'];
		$fileType = $_FILES['pic']['type'];
		
		$fp      = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);
		if($corr)
		{
			$dbc = mysqli_connect($db_host, $db_user, $db_pw, 'spider')
					or die ('Error connecting to the database server');
			$query = "INSERT INTO register (first, last, username, email, dob, gender, passwd, github, dept, interests, pic) 
					VALUES ('$first', '$last', '$user', '$email', '$dob', '$gender', '$passwd', '$github', '$dept', '$interests', '$content' )";
			
			  $result = mysqli_query($dbc, $query)
				or die ('Error querying database');
			  echo 'Successfully registered!!';
			  echo ' <br><a href="index.php">Click here</a> to goback to home page';
			  mysqli_close($dbc);
			  $outputform = false;
		}
		else
		{
			echo '<br>Please try again!!!';
			$outputform = true;
		}

	}
	else
	{
			$outputform = true;
	}

if($outputform)
{
	?>
	<div id="half1">
		
	First Name* : <br>
	Last Name : <br>
	Username* : <br>
	Email* : <br>
	Date of Birth* : <br>
	Gender* : <br>
	Password* : <br>
	Retype Password* : <br>
	Github Link : <br>
	Department* : <br>
	Profile Picture : <br>
	Interests : <br>
	</div>

	<div id="half2">
<form method="post" action = "<?php echo $_SERVER['PHP SELF']; ?>"  enctype="multipart/form-data">

<input type = "text" name="first" id="s" placeholder = "First Name" onblur="checkCap(this,0)" value="<?php echo $first; ?>"><span class="error"></span>
<br>
<input type = "text" name="last" placeholder = "Last Name" onfocus="ch()"onblur="checkCap(this,1)" value="<?php echo $last; ?>"><span class="error"></span>
<br>
<input type = "text" name="user"placeholder = "Username" onblur="username(this)" value="<?php echo $user; ?>"><span class="error"></span>
<br>
<input type = "email" name="email" placeholder = "Email" onblur="emailCheck(this)" value="<?php echo $email; ?>"><span class="error"></span>
<br>
<input type = "date" name="dob" placeholder = "DOB (MM/DD/YYYY)" onblur="dat(this)" value="<?php echo $dob; ?>"><span class="error"></span>
<br>
<input type="radio" name="gender" value="M">Male
<input type="radio" name="gender" value="F">Female<span class="error"></span>
<br>
<input type = "password" name="passwd" placeholder = "Password" onblur="passlen(this)"><span class="error"></span>
<br>
<input type = "password" name="repasswd" placeholder = "Retype password" onblur="recheck()"><span class="error"></span>
<br>
<input type = "type" name="github" placeholder = "Github profile link" value="<?php echo $github; ?>">
<br>
<select name="dept" value="chem">
  <option value="select">--DEPT--</option>
  <option value="chem">CHEM</option>
  <option value="civ">CIV</option>
  <option value="ice">ICE</option>
  <option value="meta">META</option>
  <option value="cse">CSE</option>
  <option value="ece">ECE</option>
  <option value="eee">EEE</option>
  <option value="mech">MECH</option>
  <option value="prod">PROD</option>
</select>
<br>
<input type="file" name="pic" accept="image/*">
<br>
<textarea rows="4" name="interests" placeholder = "Interests" value="<?php echo $interests; ?>"></textarea>
<br>
<input type = "submit" name="submit">

</form>
</div>
<?
}
?>
</body>

</html>

