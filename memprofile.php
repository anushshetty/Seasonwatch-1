<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
/*
 * Initial Development :- To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/main_includes.php';

   if(isset($_GET['msg'])){
       $msg=$_GET['msg'];}
       else {$msg="";}
       ?>



<script>
$(document).ready(function()
{	
  	$('.close a').click(function(e)
	{
		e.preventDefault();
		$(this).closest('div.body_top').find('.container_2_bottom_area').slideUp('fast');
		$(this).closest('div.body_top').css('background-color', '#EDEDED');
	});
        $('a[name=openAddstudent]').click(function()
	{
           
		$('#lightFour').show();
		$('#fadeOne').show().height($('body').height());
		
	});
        
});
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
</script>


</head>

<body>
    <!--  start header  -->
    <?php include ("includes/header.php");?>
    <!--  start body_content  -->
<div class="wrapper">
<div class="body_content_2">
    
    <div class="body_top">
        <div class="main">
            <div class="container">
                <?php
               $userDetailsObj = unserialize ( $_SESSION['encoded_userobject'] );?>
                <div class="mytree">View Profile :&nbsp;<? echo htmlspecialchars($userDetailsObj->fullname); ?></div>
                
                   
            </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading-->
<div class="container">
<form  name="edituser" action="memprofileedit.php"  method="post" > <!-- farheen -->
  <br>
    <span class="msg" ><?php echo $msg;?></span>
<section id="left">
    <div id="userStats" >
        <div class="data">
            <input type="hidden" id="edituserid" value="<? echo htmlspecialchars($userDetailsObj->userid); ?>"/>
            <input type="hidden" id="editgroupid" value="<? echo htmlspecialchars($userDetailsObj->group_id); ?>"/>
            <h2> Member Information  </h2>
            <table id="profiletable">
                <tr >
                <td >Email</td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->email)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->email);} ?>
                       
                </tr>
                <!--<tr>
                 <td>User Name </td>
                 <td>:&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->username)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->username);} ?>
                </tr>-->
                <tr >
                <td >Full Name</td>
                <td> :&nbsp;&nbsp; <? if(empty($userDetailsObj->fullname)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->fullname);} ?>
                 </tr>
                
                <tr>
                <td>Member since </td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->date)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->date);} ?>
                   
                </tr>
                <tr >
                 <td >Address</td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->address)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->address);} ?>
                   
                </tr>
                 <tr>
                <td>Mobile </td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->mobile)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->mobile);} ?>
                   
                </tr>
		
                
                
            <?  if ($_SESSION['usercategory']== "individual")
            {?>
                 <td >State </td>
                <?php $state="";
                              switch ((int)($userDetailsObj->state_id))
                {
                     case "0":
                         $state="None";
                         break;
                     case "1":
                         $state="Andaman and Nicobar Islands";
                         break;
                     case "2":
                         $state="Andhra Pradesh";
                         break;
                     case "3":
                         $state="Arunachal Pradesh";
                         break;
                     case "4":
                         $state="Assam";
                         break;
                     case "5":
                         $state="Bihar";
                         break;
                     case "6":
                         $s5ate="Chandigarh";
                         break;
                     case "7":
                         $state="Chhattisgarh";
                         break;
                     case "8":
                         $state="Dadra and Nagar Haveli";
                         break;
                     case "9":
                         $state="Daman and Diu";
                         break;
                     case "10":
                         $state="Delhi";
                         break;
                     case "11":
                         $state="Goa";
                         break;
                     case "12":
                         $state="Gujarat";
                         break;
                     case "13":
                         $state="Haryana";
                         break;
                     case "14":
                         $state="Himachal Pradesh";
                         break;
                     case "15":
                         $state="Jammu and Kashmir";
                         break;
                     case "16":
                         $state="Jharkhand";
                         break;
                     case "17":
                         $state="Karnataka";
                         break;
                     case "18":
                         $state="Kerala";
                         break;
                     case "19":
                         $state="Lakshadweep";
                         break;
                     case "20":
                         $state="Madhya Pradesh";
                         break;
                     case "21":
                         $state="Maharashtra";
                         break;
                     case "22":
                         $state="Manipur";
                         break;
                     case "23":
                         $state="Meghalaya";
                         break;
                     case "24":
                         $state="Mizoram";
                         break;
                     case "25":
                         $state="Nagaland";
                         break;
                     case "26":
                         $state="Orissa";
                         break;
                     case "27":
                         $state="Pondicherry";
                         break;
                     case "28":
                         $state="Punjab";
                         break;
                     case "29":
                         $state="Rajasthan";
                         break; 
                     case "30":
                         $state="Sikkim";
                         break;
                      case "31":
                         $state="Tamil Nadu";
                         break;
                      case "32":
                         $state="Tripura";
                         break;
                      case "33":
                         $state="Uttarakhand";
                         break;
                      case "34":
                         $state="Uttar Pradesh";
                         break;
                      case "35":
                         $state="West Bengal";
                         break;
                    
                }?>
                <td> :&nbsp;&nbsp;<? echo htmlspecialchars($state); ?>
                </tr>
               
                  <tr >
                <td >City </td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->city)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->city);} ?>
                         
                </tr>
                 <tr >
                <td >Pincode </td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->zip)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->zip);} ?>
                        
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
                     <? if(empty($groupname)) {echo "-";}else{echo htmlspecialchars($groupname);} ?>
                        
                </tr>
                <tr >
                <td class="alt">School Address</td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->schooladdress)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->schooladdress);} ?>
                        
                </tr>
                <tr >
                <td >School Phone</td>
                <td> :&nbsp;&nbsp;
                     <? if(empty($userDetailsObj->landline)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->landline);} ?>
                        
                </tr >
                 <tr >
                <td >School State </td>
                <?php $state="";
                
                switch ((int)($userDetailsObj->state_id))
                {
                     case "0":
                         $state="None";
                         break;
                     case "1":
                         $state="Andaman and Nicobar Islands";
                         break;
                     case "2":
                         $state="Andhra Pradesh";
                         break;
                     case "3":
                         $state="Arunachal Pradesh";
                         break;
                     case "4":
                         $state="Assam";
                         break;
                     case "5":
                         $state="Bihar";
                         break;
                     case "6":
                         $s5ate="Chandigarh";
                         break;
                     case "7":
                         $state="Chhattisgarh";
                         break;
                     case "8":
                         $state="Dadra and Nagar Haveli";
                         break;
                     case "9":
                         $state="Daman and Diu";
                         break;
                     case "10":
                         $state="Delhi";
                         break;
                     case "11":
                         $state="Goa";
                         break;
                     case "12":
                         $state="Gujarat";
                         break;
                     case "13":
                         $state="Haryana";
                         break;
                     case "14":
                         $state="Himachal Pradesh";
                         break;
                     case "15":
                         $state="Jammu and Kashmir";
                         break;
                     case "16":
                         $state="Jharkhand";
                         break;
                     case "17":
                         $state="Karnataka";
                         break;
                     case "18":
                         $state="Kerala";
                         break;
                     case "19":
                         $state="Lakshadweep";
                         break;
                     case "20":
                         $state="Madhya Pradesh";
                         break;
                     case "21":
                         $state="Maharashtra";
                         break;
                     case "22":
                         $state="Manipur";
                         break;
                     case "23":
                         $state="Meghalaya";
                         break;
                     case "24":
                         $state="Mizoram";
                         break;
                     case "25":
                         $state="Nagaland";
                         break;
                     case "26":
                         $state="Orissa";
                         break;
                     case "27":
                         $state="Pondicherry";
                         break;
                     case "28":
                         $state="Punjab";
                         break;
                     case "29":
                         $state="Rajasthan";
                         break; 
                     case "30":
                         $state="Sikkim";
                         break;
                      case "31":
                         $state="Tamil Nadu";
                         break;
                      case "32":
                         $state="Tripura";
                         break;
                      case "33":
                         $state="Uttaranchal";
                         break;
                      case "34":
                         $state="Uttar Pradesh";
                         break;
                      case "35":
                         $state="West Bengal";
                         break;
                    
                }?>
                <td> :&nbsp;&nbsp;
                                 <? if ($state=="None"){
                                     $state="-";
                                 } echo htmlspecialchars($state); ?>
                </tr>
               
                  <tr >
                <td >School City </td>
                <td> :&nbsp;&nbsp;
                    
                         <? if(empty($userDetailsObj->city)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->city);} ?>
                    
                </tr>
                 <tr >
                <td >Pincode </td>
                <td> :&nbsp;&nbsp;
                         <? if(empty($userDetailsObj->zip)) {echo "-";}else{echo htmlspecialchars($userDetailsObj->zip);} ?>
                            
                </tr>
            <?}?>
               
            </table>
        </div>
    </div>
    </br>
<div ><p><input name="sub" type="submit" class="register" value="Edit" onClick=/></p></div>
<div ><p> <input name="changepasswd" type="button" class="changepasswd" value="Change password" onclick="javascript: window.location='memprofilepasswdchange.php'"> </div>
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

</p>

</div> <!-- Div of Main body -->

   </form>
</div>

 <!-- Add  student dialog-->

<!-- end of Edit student-->     
<div id="mask"></div>

<!--  start footer  -->
<?php include ("includes/footer.php"); ?>
<!--  end footer  -->   
 </body>
</html>
