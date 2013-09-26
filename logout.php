<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?
  
	session_unset($_SESSION['log_status']);
	session_unset($_SESSION['fullname']);
	session_unset($_SESSION['userid']);
        session_unset($_SESSION['usercategory'] );
        session_unset($_SESSION['encoded_userobject']);
        session_unset( $_SESSION['NoTrees']);
	session_unset($_SESSION['log_status']);
	session_destroy();
	header("Location: index.php?logoff=true");
?>		