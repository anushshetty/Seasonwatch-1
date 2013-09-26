<?php
$con=mysql_connect("localhost","root","root123");
if(!$con)
{
	die('could not connect :'.mysql_errno());
}
mysql_select_db("seasonwatch",$con);
$query="select 	family,species_primary_common_name as spec,count(*) as id_count from trees natural join species_master group by family,species_id order by id_count desc";
$q=mysql_query($query);
if(!$q)
{
	die("query no executed:".mysql_errno());

}

$json_object = array();
$data=array();
$families = array();
while($row=mysql_fetch_assoc($q))
{
	$family = $row['family'];
		$json_object[] = $row;
		if (!in_array($family, $families)) $families[] = $family;
		if (!isset($data[$family])) $data[$family] = array();
		$data[$family][]=array($row['spec'], intval($row['id_count']));
}

$jenc = json_encode(array("categories" => $families, "data" => $data));
echo $jenc;
/* 	
var topten = jenc.slice(0, 10);
var others = jenc.slice(10);

var totalOthers = _.reduce(others, function (a, b) {
	return {spec: "Others", id_count: Number(a.id_count) + Number(b.id_count)};
});
console.log(topten);
jenc = topten;
jenc[jenc.length] = totalOthers;
console.log($jenc, topten);

$jj=json_encode($jenc);
echo $jj;*/ 	