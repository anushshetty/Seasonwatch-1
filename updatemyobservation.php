<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<img src='images/ajax-loader1.gif'> ";

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
session_start();
   include 'includes/Login.php';
   include 'includes/Tree.php';
   include 'includes/Observation.php';
     $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();

    
    
if (isset($_SESSION['userid']))
{
   $i=$_POST['treeno'];  
  
    $observationdata    = array();
     $observationdata[0]  = Login::sanitize($_POST['obdate'.$i]);
    $observationdata[1]  = Login::sanitize($_POST['usertreeid'.$i]);
    //$observationdata[2]  = Login::sanitize($_POST['is_leaf_fresh'.$i]); 
    //$observationdata[3]  = Login::sanitize($_POST['freshleaf_count'.$i]);
    
    $newobservation= new Observation();
    
    $chkobservstatus=$newobservation->IsObservationExists($dbc,$observationdata[0],$observationdata[1]);
    
    $msg="";
    if ((int)$chkobservstatus!="0")
    {
    	
    	$msg="Observation for the date ".$observationdata[0]."already exits";
    	
    	$_SESSION['msg']['addobserr']="Observation for this date already exists,".$_POST['treeno'];
    	echo "<script type='text/javascript'>
		
        //if (($.browser.msie && $.browser.version == '7.0') || ($.browser.mozilla)) {
			if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    // Inside firefox
    	
			var hrefVal = 'http://www.seasonwatch.in/testseasonwatch/dashboard.php';
		
           /* $.get(hrefVal, function (data) {*/
              loctored=hrefVal.replace(/\/$/, '');
			//alert(loctored);
                window.location = loctored;
		
            //});
    	
        }
        else {
    	
            window.location = 'dashboard.php';
        }
		
			</script>";
    }
    else
    {
    
    $observationdata[3]  = Login::sanitize($_POST['l1'.$i]);
    
    if ($observationdata[3]==0)
    {
    	$observationdata[2]=0;
    } else if ($observationdata[3]==1) {
    	$observationdata[2]=1;
    } else if ($observationdata[3]==2) {
    	$observationdata[2]=2;
    } else if ($observationdata[3]==-1) {
    	$observationdata[2]=-1;
    }
    
     
    //$observationdata[4]  = Login::sanitize($_POST['is_leaf_mature'.$i]);
    //$observationdata[5]  = Login::sanitize($_POST['matureleaf_count'.$i]);
    $observationdata[5]  = Login::sanitize($_POST['l2'.$i]);
    
    if ($observationdata[5]==0)
    {
    	$observationdata[4]=0;
    } else if ($observationdata[5]==1) {
    	$observationdata[4]=1;
    } else if ($observationdata[5]==2) {
    	$observationdata[4]=2;
    } else if ($observationdata[5]==-1) {
    	$observationdata[4]=-1;
    }
    
    //$observationdata[6]  = Login::sanitize($_POST['is_flower_bud'.$i]); 
    //$observationdata[7]  = Login::sanitize($_POST['bud_count']); 
    $observationdata[7]  = Login::sanitize($_POST['f1'.$i]);
    
    if ($observationdata[7]==0)
    {
    	$observationdata[6]=0;
    } else if ($observationdata[7]==1) {
    	$observationdata[6]=1;
    } else if ($observationdata[7]==2) {
    	$observationdata[6]=2;
    } else if ($observationdata[7]==-1) {
    	$observationdata[6]=-1;
    }
    
    //$observationdata[8]  = Login::sanitize($_POST['is_flower_open']);
    //$observationdata[9]  = Login::sanitize($_POST['open_flower_count']);
    $observationdata[9]  = Login::sanitize($_POST['f2'.$i]);
    
    if ($observationdata[9]==0)
    {
    	$observationdata[8]=0;
    } else if ($observationdata[9]==1) {
    	$observationdata[8]=1;
    } else if ($observationdata[9]==2) {
    	$observationdata[8]=2;
    } else if ($observationdata[9]==-1) {
    	$observationdata[8]=-1;
    }
    
    //$observationdata[10] = Login::sanitize($_POST['is_fruit_ripe']);  
    //$observationdata[11] = Login::sanitize($_POST['fruit_ripe_count']);
    $observationdata[11] = Login::sanitize($_POST['fr1'.$i]);
    
    if ($observationdata[11]==0)
    {
    	$observationdata[10]=0;
    } else if ($observationdata[11]==1) {
    	$observationdata[10]=1;
    } else if ($observationdata[11]==2) {
    	$observationdata[10]=2;
    } else if ($observationdata[11]==-1) {
    	$observationdata[10]=-1;
    }
    
    
    //$observationdata[12] = Login::sanitize($_POST['is_fruit_unripe']);
    //$observationdata[13] = Login::sanitize($_POST['fruit_unripe_count']);
    $observationdata[13] = Login::sanitize($_POST['fr2'.$i]);
    
    if ($observationdata[13]==0)
    {
    	$observationdata[12]=0;
    } else if ($observationdata[13]==1) {
    	$observationdata[12]=1;
    } else if ($observationdata[13]==2) {
    	$observationdata[12]=2;
    } else if ($observationdata[13]==-1) {
    	$observationdata[12]=-1;
    }
    
    if(isset($_POST['leaf_caterpillar'.$i]))
    	$observationdata[14]=1;
    else $observationdata[14]=0;    
       
       
       if(isset($_POST['flower_butterfly'.$i]))
       	$observationdata[15]=1;
       else $observationdata[15]="";
       
       if(isset($_POST['flower_bee'.$i]))
       	$observationdata[16]=1;
       else $observationdata[16]="";
       
       if(isset($_POST['fruit_bird'.$i]))
       	$observationdata[17]=1;
       else $observationdata[17]="";
       
       if(isset($_POST['fruit_monkey'.$i]))
       	$observationdata[18]=1;
       else $observationdata[18]="";
       
       //$observationdata[14] = Login::sanitize($_POST['leaf_caterpillar'.$i]);
   // $observationdata[15] = Login::sanitize($_POST['flower_butterfly'.$i]);
   // $observationdata[16] = Login::sanitize($_POST['flower_bee'.$i]);
   // $observationdata[17] = Login::sanitize($_POST['fruit_bird'.$i]);
    //$observationdata[18] = Login::sanitize($_POST['fruit_monkey'.$i]);
    $observationdata[19] = Login::sanitize($_SESSION['userid']);
    //create
    
    //print_r($observationdata);
    
   // $newobservation= new Observation();
    
    //$chkobservstatus=$newobservation->IsObservationExists($dbc,$observationdata[0],$observationdata[1]);
    
    //$msg="";
    //if ((int)$chkobservstatus=="0")
    //{
       $addobstatus=$newobservation->AddObservation($dbc,$observationdata);
           $msg="sucess";
    /*}
    else
    {
       $msg="Observation for this date already exits"; 
    }
      
}
if($msg=="sucess"){ */
echo "<script type='text/javascript'>
		if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    // Inside firefox

			var hrefVal = 'http://www.seasonwatch.in/testseasonwatch/dashboard.php';
			
           /* $.get(hrefVal, function (data) {*/
              loctored=hrefVal.replace(/\/$/, '');
			alert(loctored);
                window.location = loctored;
			
            //});

        }
        else {
              
		window.location = 'dashboard.php';
		}
		</script>";
//}
//else {
	//	echo $msg;
	
}
}
?>
