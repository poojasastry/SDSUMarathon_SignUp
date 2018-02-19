<!DOCTYPE html>
<!--	report.php
		Required: report.css
		Pooja Sastry, CS545, Fall 2016
-->
<html>
<head>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
		
	<link rel="stylesheet" type="text/css" href="report.css">
</head>
<body>
<?php
	//function to calculate age from DOB
	function age($dob)
	{
		if(!empty($dob))
		{
			$birthdate = new DateTime($dob);
			$today   = new DateTime('today');
			$age = $birthdate->diff($today)->y;
			return $age;
		}
		else
		{
			return 0;
		}
	}

	$server = 'opatija.sdsu.edu:3306';
	$user = 'jadrn042';
	$password = 'cupholder';
	$database = 'jadrn042';
	if(!($db = mysqli_connect($server,$user,$password,$database)))
	{
		echo "ERROR in connection ".mysqli_error($db);
	}
	
	//Retrieve report by teen category
	$sql1="select firstname,lastname,imagepath,dob,experience from person where category='Teen' order by lastname ASC";
	$result1=mysqli_query($db,$sql1);
	if(!$result1)
	{
		echo "Error in query".mysqli_error($db);
	}
	echo "<table>\n";
		echo "<h3><u>Teen Category</u></h3>";
		echo "<tr><td><b>Runner's Photo</b></td><td><b>Full Name</td><td><b>Age</b></td><td><b>Experience</b></td></tr>";
		while($row=mysqli_fetch_assoc($result1))
		{
			$age=age($row['dob']);
			echo "<tr><td>";
				echo '<img id="pic" src="'.$row['imagepath'].'"/>';
				echo "</td><td>";
				echo $row["firstname"]." ".$row["lastname"];
				echo "</td><td>";
				echo $age;
				echo "</td><td>";
				echo $row["experience"];
			echo "</td></tr>";
		}
	echo "</table>\n";
	
	//Retrieve report by adult category
	$sql2="select firstname,lastname,imagepath,dob,experience from person where category='Adult' order by lastname ASC";
	$result2=mysqli_query($db,$sql2);
	if(!$result2)
	{
		echo "Error in query".mysqli_error($db);
	}
	echo "<table>\n";
		echo "<h3><u>Adult Category</u></h3>";
		echo "<tr><td><b>Runner's Photo</b></td><td><b>Full Name</td><td><b>Age</b></td><td><b>Experience</b></td></tr>";
		while($row=mysqli_fetch_assoc($result2))
		{
			$age=age($row['dob']);
			echo "<tr><td>";
				echo '<img id="pic" src="'.$row['imagepath'].'"/>';
				echo "</td><td>";
				echo $row["firstname"]." ".$row["lastname"];
				echo "</td><td>";
				echo $age;
				echo "</td><td>";
				echo $row["experience"];
			echo "</td></tr>";
		}
	echo "</table>\n";
	
	//Retrieve report by senior category
	$sql3="select firstname,lastname,imagepath,dob,experience from person where category='Senior' order by lastname ASC";
	$result3=mysqli_query($db,$sql3);
	if(!$result3)
	{
		echo "Error in query".mysqli_error($db);
	}
	echo "<table>\n";
		echo "<h3><u>Senior Category</u></h3>";
		echo "<tr><td><b>Runner's Photo</b></td><td><b>Full Name</td><td><b>Age</b></td><td><b>Experience</b></td></tr>";
		while($row=mysqli_fetch_assoc($result3))
		{
			$age=age($row['dob']);
			echo "<tr><td>";
				echo '<img id="pic" src="'.$row['imagepath'].'" />';
				echo "</td><td>";
				echo $row["firstname"]." ".$row["lastname"];
				echo "</td><td>";
				echo $age;
				echo "</td><td>";
				echo $row["experience"];
			echo "</td></tr>";
		}
	mysqli_close($db);
?>
</table>
</body>
</html>   