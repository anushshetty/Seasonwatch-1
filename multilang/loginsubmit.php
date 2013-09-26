<?php
include 'includes/Login.php';
$username=Login::sanitize($_REQUEST['login_name']);
$password= md5(Login::sanitize($_REQUEST['login_pass']));
$rememberme=0;
if(isset($_REQUEST['remember'])) $rememberme=1;
$no_md5_password = Login::sanitize($_REQUEST['login_pass']);

$res_text=Login::checkLogin($username, $password,$no_md5_password, $rememberme);
//echo $res_text;
$pos = strpos($res_text, "success");
if ($pos === false) {
	//echo "The string '$findme' was not found in the string '$mystring'";

	$_SESSION['msg']['login-err'] = $res_text; 
	header("Location: index.php");           //implode("<br />",$res_text);
} else {

	$string_array = explode(",",$res_text);
	$category=$string_array[1];
	echo "category=".$category;
	switch($category)
	{
		case "school-seed":
			//window.location.href('seeddash.php');
			header("Location: school-seed.php");
			break;
		case "school-gsp":
			//window.location.href('gspdash.php');
			header("Location: gspdash.php");
			break;
		case "school":

			//window.location.href ('schooldash.php');
			header("Location: schooldash.php");
			break;
		case "individual":
			//window.location.href('indivdash.php');
			header("Location: indivdash.php");
			break;
		case "":
			//window.location.href('indivdash.php');
			header("Location: indivdash.php");
			break;
	}
}
 ?>