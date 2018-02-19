<?php
	/*	check_dup.php
		Pooja Sastry, CS545, Fall 2016
	*/
	$server = 'opatija.sdsu.edu:3306';
	$user = 'jadrn042';
	$password = 'cupholder';
	$database = 'jadrn042';
	if(!($db = mysqli_connect($server,$user,$password,$database)))
	{
		echo "ERROR in connection ".mysqli_error($db);
	}
	$email =$_GET['email'];
	$sql = "select * from person where email='$email';";
	mysqli_query($db, $sql);
	$how_many = mysqli_affected_rows($db);
	mysqli_close($db);
	if($how_many > 0)
	{
		echo "dup";
	}
	else if($how_many == 0)
	{
		echo "OK";
	}
	else
	{
		echo "ERROR, failure ".$how_many;
	}
?>