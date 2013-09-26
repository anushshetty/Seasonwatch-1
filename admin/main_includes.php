<?php
	$file = $_SERVER["SCRIPT_NAME"];
	$break = Explode('/', $file);
	$pfile = $break[count($break) - 1]; 
if(  $_SESSION['user_admin']=='' && ($pfile == "admin.php" || $pfile == "listusers.php" || $pfile == "listspecies.php" || $pfile == "addedittree.php" || $pfile == "listtree.php" || $pfile == "data.php" || $pfile == "userprofiles.php") ) {
			header("Location: index.php");
	}
	//echo $pfile;
	//echo $_SESSION['user_id'] . 'x' . $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="description" content="SeasonWatch" /> 
   <meta name="keywords" content="Seasonwatch climate change, india, citizen science" /> 
   <link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />
   <title><? echo $page_title; ?></title>
   <link href="combine_css.php?version=<?php require('combine_css.php'); ?>" rel="stylesheet" type='text/css'>
   <link type="text/css" href="js/jquery-ui/themes/base/ui.all.css" rel="stylesheet" />
   <link type="text/css" href="js/jquery-ui/demos/demos.css" rel="stylesheet" />
   <script src="js/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
   <script src="combine_js.php?version=<?php require('combine_js.php'); ?>" type="text/javascript"></script>


