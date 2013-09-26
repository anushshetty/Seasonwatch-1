<?php
include 'includes/dbc.php';
$tree_names[25]={'PLAVU ',
'ELENGI ',
'KATAMPU ',
'NJAVAL ',
'ATTI ',
'AAVAL ',
'MANIMARUTHU ',
'NELLI ',
'ARAYAL ',
'MAAVU ',
'KUMBIL ',
'VATTA/UPPILA ',
'PAALA ',
'ILIPPA ',
'THEKKU ',
'MANDARAM ',
'MULLUMURIKKU ',
'KOOVALAM ',
'KANIKONNA ',
'UNGU ',
'ASHOKAM ',
'PULI ',
'GULMOHUR ',
'RAIN TREE ',
'MULILAVU'};


$q = strtolower($_GET["q"]);
if (!$q) return;


for $i=1;$i<=25;$i++) {
	if (stripos(strtolower($tree_names[$i]),$q))
	{
		echo "$tree_names[$i]\n";
	}
}
?>
