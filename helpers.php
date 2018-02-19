<?php
	/*	helpers.php
		Required:err.css
		Pooja Sastry, CS545, Fall 2016
	*/
	$bad_chars = array('$','%','?','<','>','php');
	//function to check if form submitted by Post method
	function check_post_only() 
	{
		if(!$_POST) 
		{
			write_error_page("This script can only be called from a form.");
			exit;
		}
	}
	
	//generic function to write error page
	function write_form_error_page($msg) 
	{
		write_header();
		echo "<h2>Sorry! The below error(s) occurred.</h2><br /><h3><br />",$msg,"</h3><br />";
		echo "<h2>Please try again.Click <a href='register.html'>here</a> to go back to the Registration page.</h2>";
		write_footer();
    } 
    
	//function to write header of error page
	function write_header() {
print <<<ENDBLOCK
<!DOCTYPE html>
<html>
<head>

	<title>
			SDSU Marathon Sign Up! 
	</title>
	
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
		
	<link rel="stylesheet" type="text/css" href="err.css">
	
</head>
<body>    
ENDBLOCK;
}

	//function to write footer of error page
	function write_footer() 
	{
		echo "</body></html>";
    }
    
	//function for db connection
	function get_db_handle() 
	{
		$server = 'opatija.sdsu.edu:3306';
		$user = 'jadrn042';
		$password = 'cupholder';
		$database = 'jadrn042';           
		if(!($db = mysqli_connect($server, $user, $password, $database))) 
		{
			write_error_page('SQL ERROR: Connection failed: '.mysqli_error($db));
        }
		return $db;
    }        
       
	//function to close db connection
	function close_connector($db) 
	{
		mysqli_close($db);
    }
?>