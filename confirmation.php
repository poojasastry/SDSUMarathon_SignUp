<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--	confirmation.php
		Required: main.css
		Pooja Sastry, CS545, Fall 2016
-->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>Sample Form Processing with PHP</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
	<?php
		echo '<img id="photo" src="'.$params[15].'"/>';
echo <<<ENDBLOCK
    <h2>$params[0] $params[2], we thank you for registering for the SDSU Marathon!</h2>
	<h3> Please verify your mandatory details listed below. In case of any discrepancies, e-mail us at marathon@sdsu.com </h3>
    <table>
        <tr>
			<td><b>Full Name</b></td>
			<td>$params[0] $params[1] $params[2]</td>
		</tr>
		<tr>
            <td><b>Full Address</b></td>
            <td>$params[3] $params[4],$params[5],$params[6],$params[7]</td>
        </tr>
        <tr>
            <td><b>Gender</b></td>
            <td>$params[8]</td>
        </tr>
        <tr>
            <td><b>Phone</b></td>
            <td>$params[9]</td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td>$params[12]</td>
        </tr>
        <tr>
            <td><b>Date of Birth</b></td>
            <td>$params[13]</td>
        </tr>
		<tr>
            <td><b>Experience</b></td>
            <td>$params[14]</td>
        </tr>
    </table>                          
ENDBLOCK;
?>
</body>
</html>