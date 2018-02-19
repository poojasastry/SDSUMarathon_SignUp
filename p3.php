<?php 

//function to validate state entered is correct
function isValidState($state) 
{     
	$st=strtoupper($state);	
    $stateList = array("AK","AL","AR","AZ","CA","CO","CT","DC",
        "DE","FL","GA","GU","HI","IA","ID","IL","IN","KS","KY","LA","MA",
        "MD","ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ",
        "NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX",
        "UT","VA","VT","WA","WI","WV","WY");
		
	if(in_array($st,$stateList))
	{
		return true;
	}
	else
	{
		return false;
	}
} 

//function to validate date
function isValidDate($dt)
{
	$dat=explode('/',$dt);
	$yr=$dat[2];
	$monthh=$dat[0];
	$dayy=$dat[1];
	if(checkdate($monthh,$dayy,$yr))
	{
		return true;
	}
	else
	{
		return false;
	}
} 
//function to validate minimum age
function isValidDateMin($dt)
{
	$dat=explode('/',$dt);
	$yr=$dat[2];
	$monthh=$dat[0];
	$dayy=$dat[1];
	if($yr>2005)
	{
		return false;
	}
	else
	{
		return true;
	}
	if(checkdate($monthh,$dayy,$yr))
	{
		return true;
	}
	else
	{
		return false;
	}
} 
//function to validate maximum age
function isValidDateMax($dt)
{
	$dat=explode('/',$dt);
	$yr=$dat[2];
	$monthh=$dat[0];
	$dayy=$dat[1];
	if($yr<1916)
	{
		return false;
	}
	else
	{
		return true;
	}
	if(checkdate($monthh,$dayy,$yr))
	{
		return true;
	}
	else
	{
		return false;
	}
} 

//function to validate parameters entered by users
function validate_data($params) 
{
    $msg = "";
    if(strlen($params[0]) == 0)
        $msg .= "Please enter your First Name.<br />"; 
	if(strlen($params[2]) == 0)
        $msg .= "Please enter your Last Name.<br />";  
    if(strlen($params[3]) == 0)
        $msg .= "Please enter your address.<br />"; 
    if(strlen($params[5]) == 0)
        $msg .= "Please enter the city you live in.<br />"; 
    if(strlen($params[6]) == 0)
        $msg .= "Please enter your state.<br />";
	//isValidState($params[6]);
	elseif(!(isValidState($params[6])))
        $msg .= "The state appears to be invalid, please use the two letter state abbreviation.<br />";
    if(strlen($params[7]) == 0)
        $msg .= "Please enter your zip code.<br />";
    elseif(!is_numeric($params[7])) 
        $msg .= "Zip code may contain only numeric digits.<br />";
	if(empty($params[8]))
        $msg .= "Please select your gender.<br />"; 
	if(strlen($params[9]) == 0)
        $msg .= "Please enter your area code.<br />";
	elseif(!is_numeric($params[9])) 
        $msg .= "Area code may contain only numeric digits.<br />";
	if(strlen($params[10]) == 0)
        $msg .= "Please enter your phone number prefix.<br />";
	elseif(!is_numeric($params[10])) 
        $msg .= "Phone number prefix may contain only numeric digits.<br />";
	if(strlen($params[11]) == 0)
        $msg .= "Please enter your phone number.<br />";
	elseif(!is_numeric($params[11])) 
        $msg .= "Phone number may contain only numeric digits.<br />";
    if(strlen($params[12]) == 0)
        $msg .= "Please enter your email<br />";
    elseif(!filter_var($params[12], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid. Please enter in pattern 'xyz@abc.com'.<br/>"; 
	if(strlen($params[13]) == 0)
        $msg .= "Please enter your Date of Birth.<br />";
	elseif(!isValidDate($params[13]))
        $msg .= "Please enter a valid Date Of Birth.<br />"; 
	elseif(!isValidDateMin($params[13]))
		$msg .= "Sorry! You should be above 12 years of age to participate.<br />";
	elseif(!isValidDateMax($params[13]))
		$msg .= "Sorry! You should be below 100 years of age to participate.<br />";
	if(empty($params[14]))
        $msg .= "Please select your experience level.<br />"; 
	if(empty($_FILES["file"]["name"]))
        $msg .= "Please upload your photo.<br />"; 
	if(empty($params[16]))
        $msg .= "Please select a relevant category.<br />"; 
    if($msg) 
	{
		write_form_error_page($msg);
        exit;
    }
}

//function to add user's photo
function addimage(){
    $cd = __DIR__;
    $target_dir =  $cd .'/_uploadPICS_/';
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
	if($_FILES['file']['size'] >= 2097152) 
	{
		$msg .= "The file was too big to upload, the limit is 2MB.<br />";
        write_form_error_page($msg);
		exit;
	} 
	elseif($_FILES["file"]["name"])
	{
		if(exif_imagetype($_FILES['file']['tmp_name']) != IMAGETYPE_JPEG) 
		{
			$msg .= "Please upload photos of type JPEG/JPG.<br />";
			write_form_error_page($msg);
			exit;
		}
	}
		$save_fileas= '_uploadPICS_/'. basename($_FILES["file"]["name"]);
		move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
		return $save_fileas;
}

//function to process parameters entered by user
function process_parameters($params) 
{
    global $bad_chars;
    $x=addimage();
    $params = array();
    $params[] = trim(str_replace($bad_chars, "",$_POST['firstname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['middlename']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['lastname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['address1']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['address2']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['city']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['state']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['zip']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['gender']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['areaphone'].$_POST['prefixphone'].$_POST['phone']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['prefixphone']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['phone']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['email']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['dob']));
	$params[] = trim(str_replace($bad_chars, "",$_POST['experience']));
    $params[] = $x;
	$params[] = trim(str_replace($bad_chars, "",$_POST['category']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['medical']));
    return $params;
}

//function to store parameters in DB	
function store_data_in_db($params) 
{
    # get a database connection
    $db = get_db_handle();  ## method in helpers.php
    ##############################################################
	/*$sql1 = "SELECT * FROM person WHERE ".
    "name='$params[0]' AND ".
    "address = '$params[1]' AND ".
    "city = '$params[2]' AND ".
    "state = '$params[3]' AND ".
    "zip = '$params[4]' AND ".
    "email = '$params[5]';";
	##echo "The SQL statement is ",$sql;    
    $result1 = mysqli_query($db, $sql1);
    if(mysqli_num_rows($result1) > 0) {
        write_form_error_page('This record appears to be a duplicate');
        exit;
        }*/
	##OK, duplicate check passed, now insert

	$sql = "INSERT INTO person(firstname,middlename,lastname,address1,address2,city,state,zip,gender,telephone,email,dob,experience,imagepath,category,medical) ".
    "VALUES('$params[0]','$params[1]','$params[2]','$params[3]','$params[4]','$params[5]','$params[6]','$params[7]','$params[8]','$params[9]','$params[12]','$params[13]','$params[14]','$params[15]','$params[16]','$params[17]');";
	//echo "The SQL statement is ",$sql;    
    $result=mysqli_query($db,$sql);
	if(!$result){
		echo "Error in query".mysqli_error($db);
	}
    $how_many = mysqli_affected_rows($db);   
    //echo("There were $how_many rows affected");
    close_connector($db);
    }

?>