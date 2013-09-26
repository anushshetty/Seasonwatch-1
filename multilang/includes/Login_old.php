<?php
include_once("includes/dbcon.php");
include 'Tree.php';

Class login{
	
	public $Treeobj;
	
	function login(){
		//$Treeobj[]=new Tree();
	}

static function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));

	if (get_magic_quotes_gpc())
		$data = stripslashes($data);

	$data = mysql_real_escape_string($data);

	return $data;
}

static function sanitize($data)
{
	// remove whitespaces (not a must though)
	$data = trim($data);
	$data=strip_tags($data);
	// apply stripslashes if magic_quotes_gpc is enabled
	if(get_magic_quotes_gpc())
	{
		$data = stripslashes($data);
	}
	// a mySQL connection is required before using this function
	$data = mysql_real_escape_string($data);
	return $data;
}



static function EncodeURL($url)
{
	$new = strtolower(ereg_replace(' ','_',$url));
	return($new);
}

static function DecodeURL($url)
{
	$new = ucwords(ereg_replace('_',' ',$url));
	return($new);
}

static function ChopStr($str, $len)
{
	if (strlen($str) < $len)
		return $str;

	$str = substr($str,0,$len);
	if ($spc_pos = strrpos($str," "))
		$str = substr($str,0,$spc_pos);

	return $str . "...";
}

static function isEmail($email){
	return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

static function isUserID($username)
{
	if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
		return true;
	} else {
		return false;
	}
}

static function isURL($url)
{
	if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
		return true;
	} else {
		return false;
	}
}

static function checkPwd($x,$y)
{
	if(empty($x) || empty($y) ) { return false; }
	if (strlen($x) < 4 || strlen($y) < 4) { return false; }

	if (strcmp($x,$y) != 0) {
		return false;
	}
	return true;
}
//Number of Participants function
static function NoParticipants()
{
	$sql="SELECT user_id FROM users where approved='1' and NOT user_category ='school' and NOT user_category ='school-seed' and NOT user_category ='school-gsp'";
    $dbc=Dbconn::getdblink();	
	$users = $dbc->readtabledata($sql);
	$num_users = mysql_num_rows($users);
	return($num_users);

}

static function NoTrees()
{
	//$sql="SELECT ut.tree_id, ut.tree_nickname  FROM  user_tree_table as ut, trees as t where  t.tree_Id=ut.tree_id and t.deleted='0' and ut.user_id != 140";
	$sql="SELECT distinct ut.tree_id, ut.tree_nickname,ut.user_tree_id FROM  user_tree_table as ut, trees as t,user_tree_observations as uto where  t.tree_Id=ut.tree_id and t.deleted='0' and ut.user_id != 140 and uto.user_tree_id=ut.user_tree_id";
	//$trees = mysql_query($sql);
	$dbc=Dbconn::getdblink();
	$trees = $dbc->readtabledata($sql);
	$num_trees = mysql_num_rows($trees);
	return ($num_trees);
}

static function NoOfObservation()
{
	$sql4="select count(*) as num from user_tree_observations where deleted='0' and user_id != 140";
	//$result4=mysql_query($sql4);
	$dbc=Dbconn::getdblink();
	$result4 = $dbc->readtabledata($sql4);
	$data=mysql_fetch_assoc($result4);
	$num_obs = $data['num'];
	return ($num_obs);
}

/*function NoSchools()
 {
$sql1="SELECT user_id from users where approved='1' and (user_category ='school' OR user_category='school-seed'OR user_category='school-gsp')";
//echo $sql;
$schools = mysql_query($sql1);
$num_schools = mysql_num_rows($schools);
return($num_schools);

}*/
static function Onlyseedschools()
{
	$sql1="SELECT distinct users.user_id,user_groups.group_id,user_groups.group_name, users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups
					WHERE users.user_id=user_tree_table.user_id AND
					users.user_category='school-seed' AND
					user_groups.coord_id=users.user_id ";
	//$schools = mysql_query($sql1);
	$dbc=Dbconn::getdblink();
	$schools = $dbc->readtabledata($sql1);
	$num_schools = mysql_num_rows($schools);
	return($num_schools);
}

static function Nonseedschools()
{
	//$sql1="SELECT user_id from users where  (user_category='school-gsp' OR user_category ='school')";
	$sql1="SELECT distinct users.user_id,user_groups.group_id,user_groups.group_name, users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups
					WHERE users.user_id=user_tree_table.user_id AND
					(users.user_category='school-gsp' OR  users.user_category='school' )AND
					user_groups.coord_id=users.user_id ";
	//$schools = mysql_query($sql1);
	$dbc=Dbconn::getdblink();
	$schools = $dbc->readtabledata($sql1);
	$num_schools = mysql_num_rows($schools);
	return($num_schools);

}

static function NoSchools()
{
	$seedschool=self::Onlyseedschools();
	$nonseedschool=self::Nonseedschools();
	$num_schools = $seedschool+$nonseedschool;

	return($num_schools);

}
}


function checkLogin($login_name, $login_pass,$no_md5_password, $rememberme)
{

	$validlogin=FALSE;

	if ( filter_var($login_name, FILTER_VALIDATE_EMAIL)  == TRUE){
		// echo " Yes validation passed ";
		$validlogin=TRUE;
		 
	}else{
		if(!ctype_alnum($login_name))
		{
			$logmsg="Please check user name.";
			$validlogin=FALSE;

		}
		else
		{
			$validlogin=TRUE;
		}
		 
	}

	if ($validlogin == TRUE)
	{

		//echo $login_name;

		$chk_num =0;
		$sql = "SELECT `user_id`,`full_name`,`user_category`,`group_id`,`group_role`,`user_name`,`pwd`   FROM users  WHERE
		(user_email='$login_name' OR  user_name='$login_name') AND `pwd` = '$login_pass'";
		//echo $sql;
		$dbc=Dbconn::getdblink();
		//$rs_rec=mysql_query($sql)or die (mysql_error());
		$rs_rec=$dbc->readtabledata($sql);
		$chk_num=mysql_num_rows($rs_rec);

		if($chk_num > 0)
		{
			$result = mysql_fetch_array($rs_rec);
			$trees = mysql_query("SELECT tree_nickname, species_primary_common_name,species_master.species_id as species_id, members_assigned, trees.tree_Id as tid, user_tree_id
					FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$result[user_id]')
					ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC");
					$tree_data=$dbc->readtabledata($trees);
					$tree_no=$dbc->readtabledata("select count(*) FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$result[user_id]')
					ON species_master.species_id = trees.species_id");
					$logmsg = "success";
							session_start();
							$_SESSION['log_status'] = 'Y';
							$_SESSION['userid'] = htmlspecialchars($result['user_id']);
									$_SESSION['fullname'] = htmlspecialchars($result['full_name']);
											$_SESSION['usercategory'] = htmlspecialchars($result['user_category']);
											$_SESSION['NoTrees']=$tree_no;
											$logmsg =$logmsg.",".htmlspecialchars($result['user_category']);

											$user=new login();
											for($i=0;$i<$tree_no;$i++){
												$user->Treeobj[$i]=new Tree();
											$onetreedata=mysql_fetch_array($tree_data);
											$user->Treeobj[$i]->Tree_id =$onetreedata['tid'];
											$user->Treeobj[$i]->Addedby_userid=$result[user_id];
											$user->Treeobj[$i]->Tree_nickname=$onetreedata['tree_nickname'];
											$user->Treeobj[$i]->members_assigned=$onetreedata['members_assigned'];

											$user->Treeobj[$i]->Species_id=$onetreedata['species_id'];
											$user->Treeobj[$i]->Species_common_name=$onetreedata['species_primary_common_name'];

											$user->Treeobj[$i]->Tree_desc=$onetreedata['tid'];
											$user->Treeobj[$i]->Tree_loc_type=$onetreedata['tid'];
											$user->Treeobj[$i]->species_scientific_name=$onetreedata['tid'];
											$user->Treeobj[$i]->species_family=$onetreedata['tid'];
											$user->Treeobj[$i]->species_image=$onetreedata['tid'];

											$user->Treeobj[$i]->Loc_id=$onetreedata['tid'];
											$user->Treeobj[$i]->Loc_name=$onetreedata['tid'];
											$user->Treeobj[$i]->Loc_city=$onetreedata['tid'];
											$user->Treeobj[$i]->Loc_state=$onetreedata['tid'];
											$user->Treeobj[$i]->Loc_zoom=$onetreedata['tid'];


		}
		if ($result['user_category']=="individual")
		{
		$_SESSION['coordusername'] = "";
		$_SESSION['groupid']="0";
		$_SESSION['grouprole'] ="";
		}
		else {

			$sql3 = "SELECT `user_name`  FROM users WHERE
			`group_id` = '$group_id' AND `group_role`='coord' ";
													//$result3 = mysql_query($sql3) or die (mysql_error());
													$result3=$dbc->readtabledata($sql3);
													list($coord_user_name) = mysql_fetch_row($result3);
													//added htmlentities for session
													$_SESSION['coordusername'] = htmlspecialchars($result3['coord_user_name']);
													$_SESSION['grouprole'] = htmlspecialchars(stripslashes($result['group_role']));
													$_SESSION['groupid']=htmlspecialchars(stripslashes($result['group_id']));
    		}
    		if ($result['pwd']==md5("12345")) {$_SESSION['pwd_change_required']=1;} else {$_SESSION['pwd_change_required']=0;};
    		//set a cookie witout expiry until 60 days
    			if(isset($rememberme) == '1')
    			{
    			//setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*60, "/");
											//setcookie("full_name", $_SESSION['full_name'], time()+60*60*24*60, "/");
											setcookie("username", $result['user_name'], time()+60*60*24*1, "/");
											setcookie("password", $no_md5_password, time()+60*60*24*1, "/");
		}

			if(isset($rememberme) == '0')
    		{
    			setcookie("username", $result['user_name'], time()-60);
    			setcookie("password", $no_md5_password,  time()-60);
	}

    			}
    			else
    		{
    		$logmsg="Invalid username/password.Please retry.";
}
}
else
    				{
    				//$logmsg="Please check user name.";
}
return $logmsg;
    		}

?>