<?php 
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
session_start();
    include 'includes/Login.php';
    include 'includes/Tree.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    if (!isset($_SESSION['userid']))
        {
            header("Location: index.php");
        }
         
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?$cat=  $_SESSION['usercategory'] ;
 $headtitle="SeasonWatch /";
 switch ($cat)
        {
        case "school-seed":
         $headtitle=$headtitle."Seed";  
             
        ?>
        <? break;
        case "school":
              $headtitle=$headtitle."School"; ?>
       
        <?break;
        case "school-gsp":
           $headtitle=$headtitle."GSP"; ?>
       
        <?break;
        case "individual":
             $headtitle=$headtitle."Individual"; ?>
       
        <?break;
        }    ?> 
<title><?echo $headtitle?></title>

<link href="css/global.css" rel="stylesheet" type="text/css" />
<!-- script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
<!-- link rel="stylesheet" type="text/css" href="css/form.css"/-->
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/initiate.js"></script>
<!-- script type="text/javascript" src="js/custom-form-elements1.js"></script-->