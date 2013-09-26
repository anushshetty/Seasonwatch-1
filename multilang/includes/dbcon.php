<?php
date_default_timezone_set('Asia/Calcutta');
Class Dbconn{

private static $link;
//private $dbname='seasonwatch2';
private $dbname='seasonwatch';
private $con; 

private function __construct()
{
	
}


public static function getdblink()
{
	if(!self::$link)
		{
			self::$link = new self();
			
		}
		
		return self::$link;
		
}


public function Connecttodb()
{
	
$this->con=mysql_connect("mysql.seasonwatch.in","seasonwatch","sw1000");
if(!$this->con) die('Could not connect: ' . mysql_error());
@mysql_select_db($this->dbname,$this->con) or die( "Unable to select database");
}

public function updatetable($query)
{
mysql_query($query,$this->con) or die( mysql_error());;

}


public function readtabledata($query)
{

$result=mysql_query($query,$this->con);

return $result;
}

public function closedbconn()
{
mysql_close($this->con);
}

}


?>