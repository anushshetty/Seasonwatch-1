<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
include 'includes/Login.php';
    include 'includes/loginsubmit.php';
$dbc = Dbconn::getdblink();
$dbc->Connecttodb();
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  echo "<br>";
  //read the file and updat in database
   /* $file_handle = fopen("location_master.csv", "r");
    while (!feof($file_handle) ) {
    $line_of_text = fgetcsv($file_handle, 1024);
    print $line_of_text[0] . $line_of_text[1]. $line_of_text[2] . "<BR>";
    }
    fclose($file_handle);*/
    
    $fp = fopen('testloc12.csv','r') or die("can't open file");

while($csv_line = fgetcsv($fp,1024)) {
   // print $csv_line;
    print $csv_line[0] . $csv_line[1]. $csv_line[2] .$csv_line[3] .$csv_line[4] .$csv_line[5] .$csv_line[6] . "<BR>";
    /*for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
        //print $csv_line[$i]."<br>";
      //format state_id	city	lat	longitude	location_name	zoom_factor	tree_id
        print $csv_line[1];
           
    }*/
    // add to location_master 
$Treelocquery = "INSERT INTO location_master  
(state_id,city,longitude,latitude,location_name,zoom_factor)  
VALUES ('$csv_line[0]', '$csv_line[1] ','$csv_line[3]','$csv_line[2]','$csv_line[4] ', '$csv_line[5]')";  
$treeloc_rec=$dbc->readtabledata($Treelocquery);
if($treeloc_rec){$tree_location_id = mysql_insert_id(); }//get treelocation id


// update in trees table
 $updatequery="UPDATE trees SET tree_location_id='$tree_location_id'
     WHERE tree_Id='$csv_line[6]'";
           
            $userdetails = $dbc->readtabledata($updatequery);

    
}

fclose($fp) or die("can't close file");
  }
?>
