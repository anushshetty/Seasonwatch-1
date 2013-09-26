<?php
include_once("includes/dbcon.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfo
 *
 * @author HP
 */
class UserInfo {
    //put your code here

var $userid;
var $pwd;
var $username;
var $fullname;
var $email;
var $address;
var $state_id;
var $pincode;
var $mobile;
var $landline;
var $ipaddress;
var $approved;
var $registered_date;
var $category;
var $group_id;
var $user_role;
var $group_role;
var $hashkey;
var $schooladdress;
//private $data = array();

    public function addIndivuser($dbc,$username,$fullname,$useremail,$usermob,$userpwd)
    {
        $hashcode = self::gethashcode();
	$ipaddress = self::getIP(); 
        $sql1="INSERT INTO users (full_name,user_name,user_email,pwd,
          mobile,date,user_category,country,date_of_addition,hashkey,users_ip,approved)
          VALUES 
          ('$fullname','$username','$useremail',md5('$userpwd'),
          '$usermob',now(),'individual','India',now(),'$hashcode','$ipaddress','0')";
        $userdetails = $dbc->readtabledata($sql1);
       
       // $sendmailresult= self::sendemailhashcode($hashcode,$data[1],$data[2]);
        $sendmailresult= self::sendemailhashcode($hashcode,$fullname,$useremail);
         return ($sendmailresult);
    }
    
    
   public function addSchooluser($dbc,$schooldata)
   {
        $hashcode = self::gethashcode();
	$ipaddress = self::getIP(); 
        $sql1="INSERT INTO users (full_name,user_name,user_email,pwd,
          mobile,date,user_category,country,date_of_addition,hashkey,users_ip,address1,city,state_id,landline_num,group_role,approved)
          VALUES 
          ('$schooldata[2]','$schooldata[0]','$schooldata[1]',md5('$schooldata[4]'),
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
         return ($sendmailresult); 
    
     }
    

    function edituser($dbc,$data){
 
        if ($data[8]=="individual")
        {
            $updatequery="UPDATE users SET full_name='$data[0]',
            user_name='$data[1]',user_email='$data[2]',
            address='$data[3]',mobile='$data[4]', city='$data[5]',state_id='$data[6]',zip='$data[7]'WHERE user_id='$data[9]'";
           
            $userdetails = $dbc->readtabledata($updatequery);
           
        }
        else
        {
                $updatequery="UPDATE users SET full_name='$data[0]',
                user_name='$data[1]',user_email='$data[2]',
                address='$data[3]',mobile='$data[4]',address1='$data[10]',
                landline_num='$data[11]',
                city='$data[5]',state_id='$data[6]',zip='$data[7]'WHERE user_id='$data[9]'";
		$userdetails = $dbc->readtabledata($updatequery);
                if($userdetails=="1")
                {
                    $sql2="UPDATE user_groups SET group_name='$data[12]' where coord_id='$data[9]'";
                    $userschooldetails = $dbc->readtabledata($sql2);
                }
              
        }
        $refreshdata = self::getUserDetails($dbc,$data[9]);
        return ($userdetails);
    }
    function deleteuser(){
          echo "delete user";
    }
      
    function getUserDetails($dbc,$userid)
    {
       // $dbc=Dbconn::getdblink();
        $sql1 = "SELECT user_id,full_name, user_name,user_email,
                        group_id,group_class, date,mobile,address,landline_num,
                        state_id,address1,city,zip,group_role,approved,user_category from users where user_id='$userid'";
        $userdetails = $dbc->readtabledata($sql1);
        $userInfo = mysql_fetch_array($userdetails);
        $this->userid= $userInfo[0];
        $this->fullname= $userInfo[1];
        $this->username= $userInfo[2];
        $this->email= $userInfo[3];
        $this->group_id= $userInfo[4];
        $this->group_class= $userInfo[4];
        $this->date= $userInfo[6];
        $this->mobile= $userInfo[7];
        $this->address= $userInfo[8];
        $this->landline= $userInfo[8];
        $this->state_id= $userInfo[10];
       
        $this->schooladdress = $userInfo[11];
        $this->city= $userInfo[12];
        $this->zip= $userInfo[13];
        $this->group_role= $userInfo[14];
        $this->approved= $userInfo[15];
        $this->category= $userInfo[16];
       return($this);
      
   }
   public function editpassword($dbc,$userid,$pwd)
   {
       $updatequery="UPDATE users SET pwd='$pwd' WHERE user_id='$userid'";
       $updatepwddetails = $dbc->readtabledata($updatequery);
       return $updatepwddetails;
       
   }
   
   public function userexits($dbc,$useremail)
   {
        //check whether user exits
        $sql="Select user_id from users where user_email='$useremail' ";
        $resultuserexits = $dbc->readtabledata($sql) ; 
        $numuser = mysql_num_rows($resultuserexits);
        return ($numuser);
    
     }
     
     
     public function gethashcode()
     {
         $hash = mysql_escape_string(md5(rand(0,1000) ));
         return ($hash);
     }
     
    public function  getIP()  
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
    
    public function sendemailhashcode($hashcode,$fullname,$usermailID)
    {
        $subject = "Seasonwatch: Confirm your registration";
       
$body = 
<<<MAILTXT
Dear $fullname,

Thank you for registering with Seasonwatch. Please confirm your email address by clicking on the link below.

http://seasonwatch.in/confirm.php?val=$hashcode

Thank you again for contributing your time and effort to
Seasonwatch. Do let us know if you have any questions about how to
collect or send in the information.


With best wishes,
The Seasonwatch Team.
http://www.seasonwatch.in
sw@seasonwatch.in

MAILTXT;
    $headers = "To: " . $fullname . "<" . $usermailID . "> \r\n";
    $headers .= "From: Seasonwatch Team <sw@seasonwatch.in>\r\n";
    //$headers .= "Cc: seasonwatch@ncbs.res.in \r\n";
	$headers .= "Cc: sw@seasonwatch.in\r\n";
    $headers .= "X-Mailer: php\r\n";
   // $sent = mail($usermailID, $subject, $body, $headers) ;
    $sent="1";
    return($sent);
   /*if($sent)
    {
       $logmsg="success";
    }
    else
    {
        $logmsg="Due to Technical Fault the mail could not be sent.";
        //$logmsg ="fail";
    }*/
    
    
     
    }
    
    
    public function forgotpwd($dbc,$usermailID)
    {
        $msg="";
        $userexistschk=self::userexits($dbc,$usermailID);
         if ($userexistschk>0)
         {
            $pwd  = self::gen_trivial_password();
            $pwdmd5 = md5($pwd);
            $sql="UPDATE users SET pwd='$pwdmd5' WHERE user_email ='$usermailID'";
            $resultuserexits = $dbc->readtabledata($sql) ; 
            $body =
<<<MAILTXT
Dear $usermailID,

Your password at SeasonWatch has been reset to $pwd .


http://seasonwatch.in

Thank you again for contributing your time and effort to
Seasonwatch. Do let us know if you have any questions about how to
collect or send in the information.


Happy tree watching,
The Seasonwatch Team.
http://www.seasonwatch.in
sw@seasonwatch.in

MAILTXT;

$subject = 'Password reset from SeasonWatch';
$from= "Seasonwatch Team <sw@seasonwatch.in>\r\n";
$headers = "From:" . $from;
$sent = mail($usermailID, $subject, $body, $headers) ; 
$msg="Sucessfully sent email.Please check your email and get the password.";
return ($msg);
         }
        else {
            $msg="Sorry ! Please check your Email ID";
            // $msg="-1";
            return ($msg);
        }
    }
    
    public function gen_trivial_password($len = 6)
    {
        $r = '';
        for($i=0; $i<$len; $i++)
        $r .= chr(rand(0, 25) + ord('a'));
        return $r;
    }
     
}

?>
