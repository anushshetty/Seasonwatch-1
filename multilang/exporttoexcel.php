<?php 
include 'includes/dbcon.php';


$dbc1=Dbconn::getdblink();
$dbc1->Connecttodb();
$qObcnt="SELECT  * FROM user_tree_observations";
//echo $qObcnt; 
$observations=$dbc1->readtabledata($qObcnt);
 $totalnoofobservationscnt=mysql_num_rows($observations);

 $num_fields = mysql_num_fields($observations);
 
 for($i = 0; $i < $num_fields; $i++ )
 {
 	$header .= mysql_field_name($observations,$i)."\\t";
 }
 
 $cnt=0;
   while($row = mysql_fetch_row($observations))
    {
    	$cnt++;
    	if($cnt>500) break;
        $line = '';
        //echo $row;
        foreach($row as $value)
        {                                           
            if((!isset($value)) || ($value == ""))
            {
                $value = "\\t";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . "\\t";
            }
            $line .= $value;
        }
        $data .= trim( $line ) . "\\n";
    }

    $data = str_replace("\\r" , "" , $data);

    if ($data == "")
    {
        $data = "\\n No Record Found!\n";                       
    }

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=reports.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\\n$data";
    //echo $header;

export_excel_csv();
 
echo "completed!";
 ?>
 <body></body>