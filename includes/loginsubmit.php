<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
include 'includes/Tree.php';

function checkLogin($login_name, $login_pass,$no_md5_password, $rememberme)
{
    $validlogin=FALSE;
    if ( filter_var($login_name, FILTER_VALIDATE_EMAIL)  == TRUE){
            // echo " Yes validation passed ";
            $validlogin=TRUE;

    }
    else
    {
            if(!ctype_alnum($login_name))
            {$logmsg="Please check user name.";
             $validlogin=FALSE;}
            else{$validlogin=TRUE;}
    }
    if ($validlogin == TRUE)
	{
		//echo $login_name;
		$chk_num =0;
		/*$sql = "SELECT `user_id`,`full_name`,`user_category`,`group_id`,`group_role`,`user_name`,`pwd`   FROM users  WHERE
		(user_email='$login_name' OR  user_name='$login_name') AND `pwd` = '$login_pass'";*/
                // to get approved status.
                $sql = "SELECT * FROM users  WHERE (user_email='$login_name' OR  user_name='$login_name') AND `pwd` = '$login_pass'";
		//echo $sql;
		$dbc=Dbconn::getdblink();
		//$rs_rec=mysql_query($sql)or die (mysql_error());
		$rs_rec=$dbc->readtabledata($sql);
		$chk_num=mysql_num_rows($rs_rec);

		if($chk_num > 0)
		{
                    $result = mysql_fetch_array($rs_rec);
                   // if ($result['approved']>0) // if the approved status is one then only allow user to login
                   // { 
                    $trees = "SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id as species_id, members_assigned, trees.tree_Id as tid, user_tree_id
                    FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$result[user_id]')
                    ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC";
                    $tree_data=$dbc->readtabledata($trees);
                    $tree_no=mysql_num_rows($tree_data);
                    $logmsg = "success";
                    $userDetailsInfo = new UserInfo();
                    $userDetailsObj=$userDetailsInfo->getUserDetails($dbc,$result['user_id']);
                    $_SESSION['encoded_userobject'] = serialize($userDetailsObj); 
		    $browsertype= Login::getBrowser();
                    $_SESSION['browser']=$browsertype['name'];
                    //***************************//
                    $_SESSION['log_status'] = 'Y';
                    $_SESSION['userid'] = htmlspecialchars($result['user_id']);
                    $_SESSION['fullname'] = htmlspecialchars($result['full_name']);
                    $_SESSION['usercategory'] = htmlspecialchars($result['user_category']);
                    $_SESSION['NoTrees']=$tree_no;
                    $logmsg =$logmsg.",".htmlspecialchars($result['user_category']);
                    for($i=0;$i<$tree_no;$i++)
                    {
                        $Treeobj[$i]=new Tree();
                        $onetreedata=mysql_fetch_array($tree_data);
                        $Treeobj[$i]->Tree_id =$onetreedata['tid'];
                        $Treeobj[$i]->Addedby_userid=$result['user_id'];
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
                            //$species_pic1 = str_replace(".jpg",".png",$species_pic1);
                            //echo $species_pic1;
                            //$th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
                            //$Treeobj[$i]->species_image=$th_picname;
			    $Treeobj[$i]->species_image=$species_pic1;
                            $Treeobj[$i]->Loc_id=$onetreedata['tid'];
                            $Treeobj[$i]->Loc_name=$onetreedata['tid'];
                            $Treeobj[$i]->Loc_city=$onetreedata['tid'];
                            $Treeobj[$i]->Loc_state=$onetreedata['tid'];
                            $Treeobj[$i]->Loc_zoom=$onetreedata['tid'];
                        }
                        $_SESSION['tob'] = serialize($Treeobj);
                        if ($result['user_category']=="individual")
                        {
                            $_SESSION['coordusername'] = "";
                            $_SESSION['groupid']="0";
                            $_SESSION['grouprole'] ="";
                        }
                        else
                        {
                            $sql3 = "SELECT `user_name`  FROM users WHERE
                            `group_id` = '$result[group_id]' AND `group_role`='coord' ";
                            $result3=$dbc->readtabledata($sql3);
                            list($coord_user_name) = mysql_fetch_row($result3);
                            $_SESSION['coordusername'] = htmlspecialchars($result3['coord_user_name']);
                            $_SESSION['grouprole'] = htmlspecialchars(stripslashes($result['group_role']));
                            $_SESSION['groupid']=htmlspecialchars(stripslashes($result['group_id']));
                        }
                       // if ($result['pwd']==md5("12345")) {$_SESSION['pwd_change_required']=1;} else {$_SESSION['pwd_change_required']=0;};
                        //set a cookie without expiry until 60 days
                    }
                   
                     if(isset($rememberme))
                     {
                         if ($rememberme=='1')
                        {
                         setcookie("loginname", $login_name, time()+60*60*24*1, "/");
                        }
                        else
                        {
                            $past = time() - 10;
                            setcookie("loginname","", $past);
                        }
                     }  
                    } //end of chk_num loop
                else{$logmsg="Invalid username/password. Please retry.";}
              }
        else
        {$logmsg="Please check user name.";}
        return $logmsg;
        }
?>