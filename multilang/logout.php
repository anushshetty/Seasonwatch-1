<?
  
	session_unset($_SESSION['log_status']);
	session_unset($_SESSION['fullname']);
	session_unset($_SESSION['userid']);
        session_unset($_SESSION['usercategory'] );
        session_unset($_SESSION['encoded_userobject']);
        session_unset( $_SESSION['NoTrees']);
	session_destroy();
	header("Location: index.php");
?>		