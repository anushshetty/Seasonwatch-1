<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
include_once("includes/dbcon.php");
include_once("includes/UserInfo.php");

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
	/*$sql="SELECT user_id FROM users where approved='1' and NOT user_category ='school' and NOT user_category ='school-seed' and NOT user_category ='school-gsp'";*/
 $sql="SELECT distinct users.user_id FROM users,user_tree_observations where approved='1' and NOT user_category ='school' and NOT user_category ='school-seed' 
       and NOT user_category ='school-gsp' and user_tree_observations.user_id=users.user_id and  users.user_id != 140";
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
static function nongspschools()
{
   // with atleast one observation
    $sql1="SELECT distinct users.user_id FROM users,user_tree_observations where  approved='1' and user_category ='school' and user_tree_observations.user_id=users.user_id";
$dbc=Dbconn::getdblink();
	$schools = $dbc->readtabledata($sql1);
   
    $num_schools = mysql_num_rows($schools);
    return($num_schools);
}
static function gspschools()
{
// with atleast one observation
    $sql1="SELECT distinct users.user_id FROM users,user_tree_observations   where approved='1' and user_category ='school-gsp' and user_tree_observations.user_id=users.user_id";
$dbc=Dbconn::getdblink();
	$schools = $dbc->readtabledata($sql1);
    $schools = mysql_query($sql1);
    $num_schools = mysql_num_rows($schools);
    return($num_schools);
}

static function NoSchools()
{
	/*$seedschool=self::Onlyseedschools();
	$nonseedschool=self::Nonseedschools();
	$num_schools = $seedschool+$nonseedschool;*/

	
$seedschool=self::Onlyseedschools();
    $gspschool=self::gspschools();
    $nongspschool=self::nongspschools();
   
    $num_schools = $seedschool+$nongspschool+$gspschool;
return($num_schools);

}
static function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
    
}
}



?>