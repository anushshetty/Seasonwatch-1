<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
/*
 * Initial Development :- To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/main_includes.php';
?> 
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<!--<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>-->
<script type="text/javascript">
 $(document).ready(function(){
  $("#form1").validate({
         debug: false,
   rules: {
        editemailId: {
         required: true,
         email: true
        },
        editfullname: {required: true}
        //editusermob:{required: true,number: true,minlength: 10}
        
   	
    },
   messages: {
    editemailId: "Please enter your valid email address.",
    editfullname : "Please enter your full name."
   // editusermob:"Please enter mobile number with 10 digits."
   
   }
   
  });
 });
</script>

<!--
This code is executed on submitting the edit user form.
It does form validation and then passes on the values to
schoolupdatemember.php for updating user details.
-->
<script type="text/javascript" >
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "All Tree";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = " Only 10 Tree.";
	}
       
} 

function numbersonly(myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event)
       key = window.event.keyCode;
    else if (e)
       key = e.which;
    else
       return true;
    keychar = String.fromCharCode(key);

    // control keys
    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) )
       return true;

    // numbers
    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    // decimal point jump
    else if (dec && (keychar == "."))
       {
       myfield.form.elements[dec].focus();
       return false;
       }
    else
       return false;
}
</script>

</head>

<body>
    <!--  start header  -->
    <?php 
    //$treeno=  $_SESSION['NoTrees'];  
    include ("includes/header.php"); 
    ?>
    <!--  start body_content  -->
<div class="wrapper">
<div class="body_content_2">
    
    <div class="body_top">
        <div class="main">
            <div class="container">
                <?php
                 $userDetailsObj = unserialize ( $_SESSION['encoded_userobject'] );               
                ?>
                <div class="mytree">Edit Profile : &nbsp;<? echo htmlspecialchars($userDetailsObj->fullname); ?></div>
                
                   
            </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading-->
<div class="container">
    <form name="form1" id="form1" action="updatememberprofile.php" method="POST">
 
    <br>
<section id="left">
    <div id="userStats" class="clearfix">
        <div class="data">
            <span class="success1" style="display:none">Your Information has been updated successfully.</span>
            <input type="hidden" name="edituserid" id="edituserid" value="<? echo htmlspecialchars($userDetailsObj->userid); ?>"/>
            <input type="hidden" name="editgroupid" id="editgroupid" value="<? echo htmlspecialchars($userDetailsObj->group_id); ?>"/>
              <input type="hidden" name="usercategory" id="usercategory" value="<? echo htmlspecialchars($userDetailsObj->category); ?>"/>
            
            <h2>Member Information  </h2>
            <table id="profiletable">
                 <tr >
                <td >Email</td>
                     <? $email= "";if(empty($userDetailsObj->email)) {$email="-";}else{$email=$userDetailsObj->email;} ?>
                        <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo htmlspecialchars($email); ?></td>
                       <input  id="editemailId" name="editemailId" type="hidden" value="<? echo htmlspecialchars($email); ?>" autocomplete="off"  class="pronameField"/>
                </tr>
                <!-- <tr>
                 <td>User Name </td>
                     <? $username="";
                     if(empty($userDetailsObj->username)) { $username="-";}
                     else{$username= "$userDetailsObj->username";} ?>
                      <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo htmlspecialchars($username); ?></td>-->
                       <input id="editusername" name="editusername" type="hidden" value="<? echo htmlspecialchars($username); ?>" autocomplete="off"  class="pronameField" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/>
               <!-- </tr>-->
                <tr >
                <td >Full Name</td>
                <? $fullname="";if(empty($userDetailsObj->fullname)) {$fullname= "-";}else{$fullname="$userDetailsObj->fullname";} ?>
                     <td>:&nbsp;&nbsp; <input  id="editfullname" name="editfullname" type="text" value="<? echo htmlspecialchars($fullname); ?>" autocomplete="off"  class="pronameField"/></td>
                 </tr>
               
                 <tr >
                 <td >Address</td>
                     <?$address=""; if(empty($userDetailsObj->address)) {$address= "-";}else{ $address="$userDetailsObj->address";} ?>
                   <td>:&nbsp;&nbsp; <input  id="editaddress" name="editaddress" type="text" value="<? echo htmlspecialchars($address); ?>" autocomplete="off"  class="pronameField"/></td>
                </tr>
                <tr>
                <td>Member since </td>
                  <? $userdate="";if(empty($userDetailsObj->date)) {$userdate= "-";}else{$userdate="$userDetailsObj->date";} ?>
                    
                    <td>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <? echo htmlspecialchars($userdate); ?></td>
                </tr>
               
                 <tr>
                <td>Mobile </td>
               
                     <? $usermobile="";if(empty($userDetailsObj->mobile)) { $usermobile="-";}else{$usermobile="$userDetailsObj->mobile";} ?>
                    <td>:&nbsp;&nbsp; <input  id="editusermob" name="editusermob" type="text" value="<? echo htmlspecialchars($usermobile); ?>" autocomplete="off"  title="Please enter numbers only" class="pronameField" onKeyPress="return numbersonly(this, event)"/></td>
                   
                </tr>
		
            <?  //echo $userDetailsObj->category;
            if ($userDetailsObj->category == "individual")
            {?>
                 <td >State </td>
                 <td>:&nbsp;&nbsp;
                
                    <select  title="Select one" id="editschoolstate" name="editschoolstate" class="selectField">
                        <option value="0" <?php if((int)($userDetailsObj->state_id) == '0') { ?> selected="selected"<? } ?> >None</option>
                            <option value="1" <?php if((int)($userDetailsObj->state_id) == '1') { ?> selected="selected"<? } ?> >Andaman and Nicobar Islands</option>
                            <option value="2" <?php if((int)($userDetailsObj->state_id) == '2') { ?> selected="selected"<? } ?>>Andhra Pradesh</option>
                            <option value="3" <?php if((int)($userDetailsObj->state_id) == '3') { ?> selected="selected"<? } ?>>Arunachal Pradesh</option>
                            <option value="4" <?php if((int)($userDetailsObj->state_id) == '4') { ?> selected="selected"<? } ?>>Assam</option>
                            <option value="5" <?php if((int)($userDetailsObj->state_id) == '5') { ?> selected="selected"<? } ?>>Bihar</option>
                            <option value="6" <?php if((int)($userDetailsObj->state_id) == '6') { ?> selected="selected"<? } ?>>Chandigarh</option>
                            <option value="7" <?php if((int)($userDetailsObj->state_id) == '7') { ?> selected="selected"<? } ?>>Chhattisgarh</option>
                            <option value="8" <?php if((int)($userDetailsObj->state_id) == '8') { ?> selected="selected"<? } ?>>Dadra and Nagar Haveli</option>
                            <option value="9" <?php if((int)($userDetailsObj->state_id) == '9') { ?> selected="selected"<? } ?>>Daman and Diu</option>
                            <option value="10" <?php if((int)($userDetailsObj->state_id) == '10') { ?> selected="selected"<? } ?>>Delhi</option>
                            <option value="11"  <?php if((int)($userDetailsObj->state_id) == '11') { ?> selected="selected"<? }?>>Goa</option>
                            <option value="12" <?php if((int)($userDetailsObj->state_id) == '12') { ?> selected="selected"<? }?>> Gujarat</option>
                            <option value="13" <?php if((int)($userDetailsObj->state_id) == '13') { ?> selected="selected"<? }?>>Haryana</option>
                            <option value="14" <?php if((int)($userDetailsObj->state_id) == '14') { ?> selected="selected"<? }?>>Himachal Pradesh</option>
                            <option value="15" <?php if((int)($userDetailsObj->state_id) == '15') { ?> selected="selected"<? }?>>Jammu and Kashmir</option>
                            <option value="16" <?php if((int)($userDetailsObj->state_id) == '16') { ?> selected="selected"<? }?>>Jharkhand</option>
                            <option value="17" <?php if((int)($userDetailsObj->state_id) == '17') { ?> selected="selected"<? } ?>>Karnataka</option>
                            <option value="18" <?php if((int)($userDetailsObj->state_id) == '18') { ?> selected="selected"<? } ?>>Kerala</option>
                            <option value="19" <?php if((int)($userDetailsObj->state_id) == '19') { ?> selected="selected"<? }?>>Lakshadweep</option>
                            <option value="20" <?php if((int)($userDetailsObj->state_id) == '20') { ?> selected="selected"<? }?>>Madhya Pradesh</option>
                            <option value="21" <?php if((int)($userDetailsObj->state_id) == '21') { ?> selected="selected"<? }?>>Maharashtra</option>
                            <option value="22" <?php if((int)($userDetailsObj->state_id) == '22') { ?> selected="selected"<? }?>>Manipur</option>
                            <option value="23" <?php if((int)($userDetailsObj->state_id) == '23') { ?> selected="selected"<? }?>>Meghalaya</option>
                            <option value="24" <?php if((int)($userDetailsObj->state_id) == '24') { ?> selected="selected"<? }?>>Mizoram</option>
                            <option value="25" <?php if((int)($userDetailsObj->state_id) == '25') { ?> selected="selected"<? }?>>Nagaland</option>
                            <option value="26" <?php if((int)($userDetailsObj->state_id) == '26') { ?> selected="selected"<? }?>>Orissa</option>
                            <option value="27" <?php if((int)($userDetailsObj->state_id) == '27') { ?> selected="selected"<? }?>>Pondicherry</option>
                            <option value="28" <?php if((int)($userDetailsObj->state_id) == '28') { ?> selected="selected"<? }?>>Punjab</option>
                            <option value="29" <?php if((int)($userDetailsObj->state_id) == '29') { ?> selected="selected"<? }?>>Rajasthan</option>
                            <option value="30" <?php if((int)($userDetailsObj->state_id) == '30') { ?> selected="selected"<? }?>>Sikkim</option>
                            <option value="31" <?php if((int)($userDetailsObj->state_id) == '31') { ?> selected="selected"<? }?>>Tamil Nadu</option>
                            <option value="32" <?php if((int)($userDetailsObj->state_id) == '32') { ?> selected="selected"<? }?>>Tripura</option>
                            <option value="33" <?php if((int)($userDetailsObj->state_id) == '33') { ?> selected="selected"<? }?> >Uttaranchal</option>
                            <option value="34" <?php if((int)($userDetailsObj->state_id) == '34') { ?> selected="selected"<? }?>>Uttar Pradesh</option>
                            <option value="35" <?php if((int)($userDetailsObj->state_id) == '35') { ?> selected="selected"<? }?>>West Bengal</option>
                        </select>
                
                    </td>
               
                </tr>
                  <tr >
                <td >City </td>
               
                     <? $city="";if(empty($userDetailsObj->city)) {$city= "-";}else{ $city="$userDetailsObj->city";} ?>
                       <td>:&nbsp;&nbsp; <input  id="editschoolcity" name="editschoolcity" type="text" value="<? echo htmlspecialchars($city); ?>" autocomplete="off"  class="pronameField" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/></td>   
                </tr>
                 <tr >
                <td >Pincode </td>
                     <? $pin="";if(empty($userDetailsObj->zip)) {$pin= "-";}else{echo $pin="$userDetailsObj->zip";} ?>
                     <td>:&nbsp;&nbsp; <input  id="editschoolpin" name="editschoolpin" type="text" value="<? echo htmlspecialchars($pin); ?>" autocomplete="off"  title="Enter numbers only." class="pronameField" onKeyPress="return numbersonly(this, event)"/></td>    
                </tr>
                
            <?}else{?>
            <th >School Information</th>
             <tr>
                    <?//get school name
                    $q2="select group_name from user_groups where (group_id='$userDetailsObj->group_id'and coord_id='$userDetailsObj->userid')";
                    $result = mysql_query($q2); 
                    list($groupname) = mysql_fetch_row($result);
                    
                    ?>
                <td >School Name</td>
                <td> :&nbsp;&nbsp;
                     <? $schoolname="";if(empty($groupname)) {$schoolname= "-";}else{$schoolname="$groupname";} ?>
                     <input  id="editschoolname" name ="editschoolname" type="text" value="<? echo htmlspecialchars($schoolname); ?>" autocomplete="off"  class="pronameField"/></td>             
                </tr>
                <tr >
                <td >School Address</td>
                  <? $schooladdress="";if(empty($userDetailsObj->schooladdress)) {$schooladdress= "-";}else{ $schooladdress="$userDetailsObj->schooladdress";} ?>
                
                 <td>:&nbsp;&nbsp; <input  id="editschooladd" name ="editschooladd" type="text" value="<? echo htmlspecialchars($schooladdress); ?>" autocomplete="off"  class="pronameField"/></td>        
                </tr>
                <tr >
                <td >School Phone</td>
                     <? $schoolph="";if(empty($userDetailsObj->landline)) {$schoolph= "-";}else{ $schoolph="$userDetailsObj->landline";} ?>
               <td>:&nbsp;&nbsp; <input  id="editschoolphone" name="editschoolphone" type="text" value="<? echo htmlspecialchars($schoolph); ?>" autocomplete="off"  class="pronameField" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/></td>         
                </tr >
                 <tr >
                <td >School State </td>
               <td>:&nbsp;&nbsp;
                  <select  title="Select one" id="editschoolstate" name="editschoolstate" class="selectField">
                        <option value="0" <?php if((int)($userDetailsObj->state_id)== '0') { ?> selected="selected"<? } ?> >None</option>
                            <option value="1" <?php if((int)($userDetailsObj->state_id) == '1') { ?> selected="selected"<? } ?> >Andaman and Nicobar Islands</option>
                            <option value="2" <?php if((int)($userDetailsObj->state_id) == '2') { ?> selected="selected"<? } ?>>Andhra Pradesh</option>
                            <option value="3" <?php if((int)($userDetailsObj->state_id) == '3') { ?> selected="selected"<? } ?>>Arunachal Pradesh</option>
                            <option value="4" <?php if((int)($userDetailsObj->state_id) == '4') { ?> selected="selected"<? } ?>>Assam</option>
                            <option value="5" <?php if((int)($userDetailsObj->state_id) == '5') { ?> selected="selected"<? } ?>>Bihar</option>
                            <option value="6" <?php if((int)($userDetailsObj->state_id) == '6') { ?> selected="selected"<? } ?>>Chandigarh</option>
                            <option value="7" <?php if((int)($userDetailsObj->state_id) == '7') { ?> selected="selected"<? } ?>>Chhattisgarh</option>
                            <option value="8" <?php if((int)($userDetailsObj->state_id) == '8') { ?> selected="selected"<? } ?>>Dadra and Nagar Haveli</option>
                            <option value="9" <?php if((int)($userDetailsObj->state_id) == '9') { ?> selected="selected"<? } ?>>Daman and Diu</option>
                            <option value="10" <?php if((int)($userDetailsObj->state_id) == '10') { ?> selected="selected"<? } ?>>Delhi</option>
                            <option value="11"  <?php if((int)($userDetailsObj->state_id) == '11') { ?> selected="selected"<? }?>>Goa</option>
                            <option value="12" <?php if((int)($userDetailsObj->state_id) == '12') { ?> selected="selected"<? }?>> Gujarat</option>
                            <option value="13" <?php if((int)($userDetailsObj->state_id) == '13') { ?> selected="selected"<? }?>>Haryana</option>
                            <option value="14" <?php if((int)($userDetailsObj->state_id) == '14') { ?> selected="selected"<? }?>>Himachal Pradesh</option>
                            <option value="15" <?php if((int)($userDetailsObj->state_id) == '15') { ?> selected="selected"<? }?>>Jammu and Kashmir</option>
                            <option value="16" <?php if((int)($userDetailsObj->state_id) == '16') { ?> selected="selected"<? }?>>Jharkhand</option>
                            <option value="17" <?php if((int)($userDetailsObj->state_id) == '17') { ?> selected="selected"<? } ?>>Karnataka</option>
                            <option value="18" <?php if((int)($userDetailsObj->state_id) == '18') { ?> selected="selected"<? } ?>>Kerala</option>
                            <option value="19" <?php if((int)($userDetailsObj->state_id) == '19') { ?> selected="selected"<? }?>>Lakshadweep</option>
                            <option value="20" <?php if((int)($userDetailsObj->state_id) == '20') { ?> selected="selected"<? }?>>Madhya Pradesh</option>
                            <option value="21" <?php if((int)($userDetailsObj->state_id) == '21') { ?> selected="selected"<? }?>>Maharashtra</option>
                            <option value="22" <?php if((int)($userDetailsObj->state_id) == '22') { ?> selected="selected"<? }?>>Manipur</option>
                            <option value="23" <?php if((int)($userDetailsObj->state_id) == '23') { ?> selected="selected"<? }?>>Meghalaya</option>
                            <option value="24" <?php if((int)($userDetailsObj->state_id) == '24') { ?> selected="selected"<? }?>>Mizoram</option>
                            <option value="25" <?php if((int)($userDetailsObj->state_id) == '25') { ?> selected="selected"<? }?>>Nagaland</option>
                            <option value="26" <?php if((int)($userDetailsObj->state_id) == '26') { ?> selected="selected"<? }?>>Orissa</option>
                            <option value="27" <?php if((int)($userDetailsObj->state_id) == '27') { ?> selected="selected"<? }?>>Pondicherry</option>
                            <option value="28" <?php if((int)($userDetailsObj->state_id) == '28') { ?> selected="selected"<? }?>>Punjab</option>
                            <option value="29" <?php if((int)($userDetailsObj->state_id) == '29') { ?> selected="selected"<? }?>>Rajasthan</option>
                            <option value="30" <?php if((int)($userDetailsObj->state_id) == '30') { ?> selected="selected"<? }?>>Sikkim</option>
                            <option value="31" <?php if((int)($userDetailsObj->state_id) == '31') { ?> selected="selected"<? }?>>Tamil Nadu</option>
                            <option value="32" <?php if((int)($userDetailsObj->state_id) == '32') { ?> selected="selected"<? }?>>Tripura</option>
                            <option value="33" <?php if((int)($userDetailsObj->state_id) == '33') { ?> selected="selected"<? }?> >Uttarakhand</option>
                            <option value="34" <?php if((int)($userDetailsObj->state_id) == '34') { ?> selected="selected"<? }?>>Uttar Pradesh</option>
                            <option value="35" <?php if((int)($userDetailsObj->state_id) == '35') { ?> selected="selected"<? }?>>West Bengal</option>
                        </select></td>
                </tr>
               
                  <tr >
                <td >School City </td>
                     <? $city="";if(empty($userDetailsObj->city)) {$city= "-";}else{ $city="$userDetailsObj->city";} ?>
                       <td>:&nbsp;&nbsp; <input  id="editschoolcity" name="editschoolcity" type="text" value="<? echo htmlspecialchars($city); ?>" autocomplete="off"  class="pronameField" onKeyPress="return lettersonly(this, event)" title="Please enter alphanumeric keys only."/></td>   
             
                </tr>
                 <tr >
                <td >Pincode </td>
                    <? $pin="";if(empty($userDetailsObj->zip)) {$pin= "-";}else{ $pin="$userDetailsObj->zip";} ?>
                     <td>:&nbsp;&nbsp; <input  id="editschoolpin" name="editschoolpin"" type="text" value="<? echo htmlspecialchars($pin); ?>" autocomplete="off"  title="Enter numbers only." class="pronameField" onKeyPress="return numbersonly(this, event)"/></td>    
                </tr>
            <?}?>
               
            </table>
           
            
           
        </div>
    </div>
</section>
        <section id="right">
    <div class="gcontent">
        <div class="head"><h1>Tree List</h1></div>
              <div class="boxy">
                <?php
                $trees_assigned_school = mysql_query("SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id, members_assigned, trees.tree_Id as tid, user_tree_id 
        FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]') 
        ON species_master.species_id = trees.species_id and trees.deleted='0'ORDER BY species_master.species_id ASC");
                $i=0;
                $totaltree = mysql_num_rows($trees_assigned_school);
                //echo $totaltree;?>
                <h1>Total Trees - <?echo $totaltree;?></h1>
                <?$data= array(); //to store all the data 
                $tree_nickname="";?>
                <div class="treelist clearfix">
                <?
                $counttree=0;
                while ($trees_assigned_school_row=mysql_fetch_array($trees_assigned_school)) 
                { 
                $data[$counttree]= $trees_assigned_school_row['tree_nickname'];
                $counttree++;
                } 
               ?>
                   
                <div class="tree">
                <?if   ($totaltree <=10){?> 
                       <? for($i=0;$i<$totaltree;$i++){?>
                <span class="treely"><?echo $data[$i];?> </span>
                        <?}}?>
                </div>
                
                 <br>
                    <?if ($totaltree >10){
                    	for($i=0;$i<10;$i++){?>
                    	                <span class="treely"><?echo $data[$i];?> </span>
                    	                        <?}?>
                <span style="display: inline;"><a id="displayText" href="javascript:toggle();">All Tree</a></span>
                <div id="toggleText" style="display: none;">
                    <?for($j=10;$j<$totaltree;$j++){?>
                    <span class="treely"><?echo $data[$j];?> </span>
                        <?}?>
                </div>
                <?}?>
               
            </div>
            </div>
    </div>
</section>

<div class="clearBoth"></div>
</div> <!-- Div of container body-->
<div class="clearBoth"></div>
</p>
</br>
  <!-- p><input  class="cancel" value="Cancel" /><input name="sub" type="submit" class="register" value="Save"  onClick="EditUser()"/></p-->
  <p><input name="sub" type="submit" class="register" value="Save" onclick='return (EditUser());'/>
      <input name="cancel" type="button" class="register" value="Cancel" onclick="javascript: window.location='memprofile.php'"></p>
</br>
</br>
</br>
</div> <!-- Div of Main body -->

   <!--</form>-->
   </form>
</div>





<!--  start footer  -->
<?php include ("includes/footer.php"); ?>
<!--  end footer  -->   
 </body>
</html>
