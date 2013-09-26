<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php 
 session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();

if(isset($_POST['LOGIN']))
 {
 
 	$username=Login::sanitize($_REQUEST['login_name']);
	
 	$password= md5(Login::sanitize($_REQUEST['login_pass']));
 	$rememberme=0;
 	if(isset($_REQUEST['remember'])) $rememberme=1;
 	$no_md5_password = Login::sanitize($_REQUEST['login_pass']);
 
 	$res_text=checkLogin($username, $password,$no_md5_password, $rememberme);
 	//echo $res_text;
 	$pos = strpos($res_text, "success");
 	if ($pos === false) {
 		//echo "The string '$findme' was not found in the string '$mystring'";
 
 		$_SESSION['msg']['login-err'] = $res_text;
 		//header("Location: index.php?user=".$username);
 		
 		if($_REQUEST['path'] == '/index.php'){
 			//echo "we are in index";
 		   header("Location: index.php?user=".rawurlencode($username));
 		}else{
 			//echo "we are in details";
 			header("Location: details.php?user=".rawurlencode($username));
 		}
 		
 		 
 	} else {
 		
 		$_SESSION['log_status'] == 'Y';
 
 		$string_array = explode(",",$res_text);
 		$category=$string_array[1];
 		//echo "category=".$category;
 		header("Location: dashboard.php");
 		 		
 		
 		
 	}
 }
 
 else if(isset($_POST['INDIVREG']))
 {
        $newusername=Login::sanitize($_POST["Indivnametext"]);
        $newusermail=Login::sanitize($_POST["Indivmailidtext"]);
        $newuserfullname=Login::sanitize($_POST["Indivfullnametext"]);
        $newusermobno=Login::sanitize($_POST["Indivmobnotext"]);
        $newuserpwd=md5(Login::sanitize($_POST["Indivpassword"]));
        $newusercat="individual";
        $newuserobject = new UserInfo();
        $usercheck="";
        $usercheck =$newuserobject->userexits($dbc,$newusermail);
	// to test why this part is not working.
	//echo $usercheck ;
        //if ((int)$usercheck == "1")
 	if ($usercheck >'0')
        {
        	$userdata=rawurlencode($newusername.",".$newusermail.",".$newuserfullname.",".$newusermobno);
        	       	
             $usercheck="0";
             $_SESSION['msg']['indivreg-err'] = "email already registered!";
             //header("Location: index.php?userdata=".$userdata);
             
         
 		if($_REQUEST['path'] == '/index.php'){
 		   header("Location: index.php?userdata=".$userdata);
 		}else{
 			header("Location: details.php?userdata=".$userdata);
 		}
                       
        }  
        else
        {
        	
            $resultIndivadd="";
            $resultIndivadd= $newuserobject->addIndivuser($dbc,$newusername,$newuserfullname,$newusermail,$newusermobno,$newuserpwd);  
	    //echo $resultIndivadd;
            if ((int)$resultIndivadd=="1")
            {
            	 $_SESSION['msg']['indivreg-err'] = "success";
            	// header("Location: index.php");
            	
            if($_REQUEST['path'] == '/index.php'){
 		   header("Location: index.php");
 		}else{
 			header("Location: details.php");
 		}
                 $resultIndivadd="";
            }
            	 
            	 
                      
    
          }
            
    
 }
 else if(isset($_POST['SCHOOLREG']))
 {
		$schooldata=array(); 
		$newusermail=Login::sanitize($_POST["schcordmailid"]);
		$schooldata[0] = Login::sanitize($_POST["schcordname"]);
		$schooldata[1] = Login::sanitize($_POST["schcordmailid"]);
		$schooldata[2] = Login::sanitize($_POST["schcordfullname"]);
		$schooldata[3] = Login::sanitize($_POST["schcordmob"]);
		$schooldata[4] = md5(Login::sanitize($_POST["schcordpwd"]));
		$schooldata[5] = Login::sanitize($_POST["schcat"]);
		$schooldata[6] = Login::sanitize($_POST["schnametext"]); 
		$schooldata[7] = Login::sanitize($_POST["schaddtext"]);
		$schooldata[8] = Login::sanitize($_POST["schcitytext"]);
		$schooldata[9] = Login::sanitize($_POST["schstatetext"]);
		$schooldata[10]= Login::sanitize($_POST["schphtext"]);
		$cat =$_POST["schcat"];
		$newschoolobject = new UserInfo();
		$schoolcheck="";
		$schoolcheck =$newschoolobject->userexits($dbc,$newusermail);
        //if ((int)$schoolcheck == "1")
	  if ($schoolcheck >'0')
        {
             $schoolcheck="0";
            $_SESSION['msg']['schoolreg-err'] = "email already registered!";
            $schooldt=rawurlencode($schooldata[0].",".$schooldata[1].",".$schooldata[2].",".$schooldata[3].",".$schooldata[4].",".$schooldata[5].",".$schooldata[5].",".$schooldata[6].",".$schooldata[7].",".$schooldata[8].",".$cat);
            
            
            //header("Location: index.php?schooldata=".$schooldt);
            
        if($_REQUEST['path'] == '/index.php'){
 		   header("Location: index.php?schooldata=".$schooldt);
 		}else{
 			header("Location: details.php?schooldata=".$schooldt);
 		}
             
          unset($schooldata); 
        }  
        else
        {
            $resultIndivadd="";
            $resultIndivadd= $newschoolobject->addSchooluser($dbc,$schooldata);  
            if ((int)$resultIndivadd=="1")
            {
            	$_SESSION['msg']['schoolreg-err'] = "success";
            	// header("Location: index.php");
            	
            if($_REQUEST['path'] == '/index.php'){
 		   header("Location: index.php");
 		}else{
 			header("Location: details.php");
 		}
                 $resultIndivadd="";
            }
                 
                      
           
        }
 }
 	?>