<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */?>

<?php

include 'includes/Login.php';
    include 'includes/loginsubmit.php';
      $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
//error_reporting(E_ALL ^ E_NOTICE);
require_once 'Excel/excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("example.xls");

?>
<html>
<head>
</head>

<body>
    <?//echo "\n";
     $newuserobject = new UserInfo();
   
    for ($i = 2; $i < $data->sheets[0]['numRows']; $i++) {
	for ($j = 1; $j < $data->sheets[0]['numCols']; $j++) {
		//echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
            
	}
          $hashcode = mysql_escape_string(md5(rand(0,1000) ));
             // echo $hashcode;
              $ip= getIP();
             
              $fullName=$data->sheets[0]['cells'][$i][4];
             
             $username=$data->sheets[0]['cells'][$i][6];
            
              $useremail =$fullName."@seasonwatch.in";
            
              $pwd=md5('12345');
              $mobile=$data->sheets[0]['cells'][$i][5];
               $address1=$data->sheets[0]['cells'][$i][3];
          
               
              $city=$data->sheets[0]['cells'][$i][8];
              
              $ed=$data->sheets[0]['cells'][$i][7];
           $groupname=$data->sheets[0]['cells'][$i][2];
          // echo $groupname;
              
               $sql1="INSERT INTO users (full_name,user_name,user_email,pwd,
          mobile,date,user_category,country,date_of_addition,hashkey,users_ip,address1,city,state_id,group_role,approved,educational_district)
          VALUES 
          ('$fullName','$username','$useremail','$pwd',
          '$mobile',now(),'school-seed','India',now(),'$hashcode','$ip','$address1','$city','18',
               'coord','1','$ed')";
               
               
        // echo $sql1;
           $schooldetails = $dbc->readtabledata($sql1);
        
         $schooluserid=mysql_insert_id();
         
        //add to user_groups
          $sql2 = "INSERT INTO user_groups (coord_id,group_name) VALUES 
               ('$schooluserid','$groupname')";

          $schoolgroup= $dbc->readtabledata($sql2);
          $schoolgroupid= mysql_insert_id();
           
           //update into users table
            $sql3= "UPDATE users SET group_id= '$schoolgroupid' where user_id='$schooluserid'";
            $updateschoolInfo= $dbc->readtabledata($sql3);
           //    echo"<br>";
         //echo"<br>";
	//echo "\n";

}
 function  getIP()  
    {
        $ip; 
        if (getenv("HTTP_CLIENT_IP")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
        else if(getenv("HTTP_X_FORWARDED_FOR")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if(getenv("REMOTE_ADDR")) 
        $ip = getenv("REMOTE_ADDR"); 
        else 
        $ip = "UNKNOWN";
        return ($ip); 
    }
/*$hashcode = self::gethashcode();
	$ipaddress = self::getIP(); 
        $sql1="INSERT INTO users (full_name,user_name,user_email,pwd,
          mobile,date,user_category,country,date_of_addition,hashkey,users_ip,address1,city,state_id,landline_num,group_role,approved)
          VALUES 
          ('$schooldata[2]','$schooldata[0]','$schooldata[1]','$schooldata[4]',
          '$schooldata[3]',now(),'$schooldata[5]','India',now(),'$hashcode','$ipaddress','$schooldata[7]','$schooldata[8]','$schooldata[9]','$schooldata[10]','coord','0')";
        // echo $sql1;
        $schooldetails = $dbc->readtabledata($sql1);
        
         $schooluserid=mysql_insert_id();
         
        //add to user_groups
          $sql2 = "INSERT INTO user_groups (coord_id,group_name) VALUES 
               ('$schooluserid','$schooldata[6]')";

          $schoolgroup= $dbc->readtabledata($sql2);
          $schoolgroupid= mysql_insert_id();
           
           //update into users table
            $sql3= "UPDATE users SET group_id= '$schoolgroupid' where user_id='$schooluserid'";
            $updateschoolInfo= $dbc->readtabledata($sql3);
            
            
            
           
       // $sendmailresult= self::sendemailhashcode($hashcode,$data[1],$data[2]);
        $sendmailresult= self::sendemailhashcode($hashcode,$schooldata[2],$schooldata[1]);
         return ($sendmailresult); */
    ?>


</body>
</html>
