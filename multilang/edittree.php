<?php 

session_start();
       if (!isset($_SESSION['userid']))
        {
            header("Location: index.php");
        }
include 'includes/Login.php';
include 'includes/Tree.php';
$dbc = Dbconn::getdblink();
$dbc->Connecttodb();

$userid=$_SESSION['userid'];

$j=Login::sanitize($_GET['j']);
//if (isset($_GET['edittree']))
//{
    
echo $j." ".$_REQUEST["selspecies_id$j"];    //Santize data
    $treeid=($_POST["seltreeid".$j]);
    $speciesId=($_POST["selspecies_id".$j]);
    //$tree_nickname=sanitize($_POST['eselspecies_name']);
    
    $sql1 = "UPDATE trees SET  
                 species_id =".$speciesId."                 
                   WHERE tree_id = ".$treeid.";";  
           
    echo $sql1." ";
    //mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
$dbc->updatetable($sql1);
    
    /*$sql2 = "UPDATE user_tree_table SET  
             `tree_nickname`='".addslashes($tree_nickname)."'
              WHERE tree_id = '$treeid' AND user_id = '$_SESSION[userid]'";
    //echo "$sql2"; 
    mysql_query($sql2,$link) or die("Insertion Failed: user_tree_table" .mysql_error()); 
*/
    //   mysql_close($link);
   $msg="Your tree species has been Edited successfully.";   
   
// echo "<script>window.location = 'indivedittreeinfo.php?user_id=$userid&msg=$msg&treeid=$treeid&speciesid=$speciesId'</script>";
//}

//else if(isset($_GET['editloc'])){
	
	$treeid=Login::sanitize($_POST['seltreeid']);
	$speciesId=Login::sanitize($_POST['selspecies_id']);
	$locationid=Login::sanitize($_POST['locationid']);
	$loc_name=Login::sanitize($_POST['loc_name']);
	$location_type=$_POST['location_type']; //$_POST['location_type'];
	$city=Login::sanitize($_POST['city']);
	$state_id=Login::sanitize($_POST['state_id']);
	$lat=Login::sanitize($_POST['lat']);
	$lng=Login::sanitize($_POST['lng']);
	$zoom=Login::sanitize($_POST['zoom']);
	
	if ($locationid>0)
	{
		$Treelocquery = "UPDATE location_master SET
		state_id='$state_id',city='$city ',longitude='$lng',latitude='$lat',location_name='$loc_name',
		zoom_factor= '$zoom' where tree_location_id='$locationid'";
	
		//$treelocresult= mysql_query($Treelocquery) or die("Insertion Failed:" .mysql_error()." ".$Treelocquery);
	
		echo $Treelocquery." ";
		$treelocresult = $dbc->readtabledata($Treelocquery);
		
		$sql1 = "UPDATE trees SET
		location_type ='$location_type'
		WHERE tree_id = '$treeid'";
	
		// `tree_location_id` ='$_SESSION[treelocID]',
		//mysql_query($sql1,$link) or die("Insertion Failed:" .mysql_error()." ".$sql1);
	
		$dbc->updatetable($sql1);
		
	}
	else
	{
		$Treelocquery = "INSERT INTO location_master
		(state_id,city,longitude,latitude,location_name,zoom_factor)
		VALUES
		('$state_id',
		'$city ',
		'$lng','$lat',
		'$locname ',
		'$zoom')";
	
		//$treelocresult= mysql_query($Treelocquery,$link)or die("Insertion Failed:" .mysql_error());
		echo $Treelocquery." ";
		
		$treelocresult=$dbc->readtabledata($Treelocquery);
		if($treelocresult)
		{
		$tree_location_id = mysql_insert_id(); //get treelocation id
		$locationid=$tree_location_id;
	}
		$sql1 = "UPDATE trees SET
		location_type ='$location_type' , tree_location_id=$locationid WHERE tree_id = '$treeid'";
	
		// echo "asds";
		echo $sql1." ";
		// `tree_location_id` ='$_SESSION[treelocID]',
		//mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()." ".$sql1);
	
		$dbc->updatetable($sql1);
		
	}
	
	
	$msg="Your tree location has been Edited successfully.";
	 
//	echo "<script>window.location = 'editindivlocation.php?user_id=$userid&msg=$msg&treeid=$treeid&speciesid=$speciesId'</script>";
	
//}
//else if(isset($_GET['editdet'])){
	
	//$treeid=Login::sanitize($_POST['selectedtreeid']);
	//$speciesId=Login::sanitize($_POST['especies_id']);	
	
	$is_fertilised=Login::sanitize($_POST['eis_fertilised']);
	$is_watered=Login::sanitize($_POST['eis_watered']);
	$aspect=Login::sanitize($_POST['easpect']);
	$tree_nickname=Login::sanitize($_POST['etree_nickname']);
	$members_assigned=Login::sanitize($_POST['studentname']);
	$distance_from_water=Login::sanitize($_POST['edistance_from_water']);
	$degree_of_slope=Login::sanitize($_POST['edegree_of_slope']);
	$theight_value=Login::sanitize($_POST['etree_height']);
	$tgirth_value=Login::sanitize($_POST['etree_girth']);
	$other_notes=Login::sanitize($_POST['eother_notes']);
	$tree_damage=Login::sanitize($_POST['etree_damage']);

	//echo "tree_damage=".$tree_damage;
	
	$sql1 = "UPDATE trees SET
	`is_fertilised` ='$is_fertilised',
	`is_watered` ='$is_watered',
	`distance_from_water`='$distance_from_water',
	`degree_of_slope`='$degree_of_slope',
	`aspect` ='$aspect'
	WHERE tree_id = '$treeid'";

	//`tree_desc`='".addslashes($tree_desc)."',
	
	//mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error().$sql1);
	$dbc->updatetable($sql1);
	
	
	$sql2 = "UPDATE user_tree_table SET
	`tree_nickname`='$tree_nickname',
	`members_assigned`='$members_assigned'
	WHERE tree_id = '$treeid' AND user_id = '$_SESSION[userid]'";
	
	//mysql_query($sql2,$link) or die("Insertion Failed: user_tree_table" .mysql_error());
	
	$dbc->updatetable($sql2);
	
	$gettreename="select user_tree_id ,tree_nickname from user_tree_table where tree_id ='$treeid'";
	list($user_tree_id,$tree_nickname)=mysql_fetch_row(mysql_query($gettreename));
	
	$sql3 = "UPDATE tree_measurement SET
	`tree_height`='$theight_value',
	`tree_girth`='$tgirth_value',
			`tree_damage`='$tree_damage',
			`other_notes`='".addslashes($other_notes)."' 
	  		WHERE tree_id = '$treeid' AND user_id = '$_SESSION[userid]'";
			//echo "$sql3";//`date_of_measurement`=now(),
			//mysql_query($sql3,$link) or die("Insertion in tree_measurement Failed:" .mysql_error().$sql3);
			
	$dbc->updatetable($sql3);
	
			$msg="Your tree details have been Edited successfully.";
			
			
			$tob = unserialize($_SESSION['tob']);
			$trees = "SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id as species_id, members_assigned, trees.tree_Id as tid, user_tree_id
			FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]')
			ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC";
			$tree_data=$dbc->readtabledata($trees);
			$tree_no=mysql_num_rows($tree_data);
			$_SESSION['NoTrees']=$tree_no;
					for($i=0;$i<$tree_no;$i++)
					{
			
					$Treeobj[$i]=new Tree();
						$onetreedata=mysql_fetch_array($tree_data);
						$Treeobj[$i]->Tree_id =$onetreedata['tid'];
						$Treeobj[$i]->Addedby_userid=$_SESSION['userid'];
						$Treeobj[$i]->Tree_nickname=$onetreedata['tree_nickname'];
						$Treeobj[$i]->members_assigned=$onetreedata['members_assigned'];
						$Treeobj[$i]->user_tree_id=$onetreedata['user_tree_id'];
			
						$Treeobj[$i]->Species_id=$onetreedata['species_id'];
						$Treeobj[$i]->Species_common_name=$onetreedata['species_primary_common_name'];
			
						$Treeobj[$i]->Tree_desc=$onetreedata['tid'];
								$Treeobj[$i]->Tree_loc_type=$onetreedata['tid'];
								$Treeobj[$i]->species_scientific_name=$onetreedata['species_scientific_name'];
								$Treeobj[$i]->species_family=$onetreedata['tid'];
			
        $result = $dbc->readtabledata("SELECT path_name,file_name FROM species_images WHERE species_id='".$onetreedata['species_id']."'");
        $image_names = mysql_fetch_array($result);
			        if ($image_names !='')
			        {
			        $species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
			        	// replace .jpg into .png
			        			$species_pic1 = str_replace(".jpg",".png",$species_pic1);
			        	//echo $species_pic1;
			        	$th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
			        	$Treeobj[$i]->species_image=$th_picname;
			        	$Treeobj[$i]->Loc_id=$onetreedata['tid'];
			        	$Treeobj[$i]->Loc_name=$onetreedata['tid'];
			        	$Treeobj[$i]->Loc_city=$onetreedata['tid'];
			        	$Treeobj[$i]->Loc_state=$onetreedata['tid'];
			        	$Treeobj[$i]->Loc_zoom=$onetreedata['tid'];
			        }
			        $_SESSION['tob'] = serialize($Treeobj);
			
					}
			
						
			
			echo "<script>window.location = 'dashboard.php?msg=$msg&treeid=$treeid&speciesid=$speciesId'</script>";
			
	
//}

?>