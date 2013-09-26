<?php
/*
 * Initial Development :- To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'includes/main_includes.php';?>

<!--
This code is executed on submitting the edit user form.
It does form validation and then passes on the values to
indivupdatememberprofile.php for updating user details.
-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<!--<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>-->
<script type="text/javascript">
 $(document).ready(function(){
  $("#form1").validate({
         debug: false,
   rules: {
    password: "required",
    cpassword:{	equalTo: "#password" }		
    },
   messages: {
    password: "Enter Password",
    cpassword: "Enter Confirm Password Same as Password",
   
   }
   
  });
 });
</script>
<style>
 label.error { width: 250px; display: inline; color: red;}
</style>
</head>
<body>
    <!--  start header  -->
    <?php 
     include ("includes/header.php"); ?>
    <!--  start body_content  -->
<div class="wrapper">
<div class="body_content_2">
    
    <div class="body_top">
        <div class="main">
            <div class="container">
                <?php
                 $userDetailsObj = unserialize ( $_SESSION['encoded_userobject'] );?>
                   <div class="mytree">Edit Profile Password:&nbsp;<? echo htmlspecialchars($userDetailsObj->fullname); ?></div>
               
        </div>
    </div> <!-- end div of body_top which includes Add tree heading-->
    </div>
<div class="container">
    <form name="form1" id="form1" action="updatepassword.php" method="POST">
  <!--<form name='form1' action='updatepassword.php?user_id=<?php echo $user_details_row['user_id'];?>' method='post'/>-->
    <br>

    <section id="left">
         <span class="success1" style="display:none">Your Information has been updated successfully.</span>
    <div id="userStats" class="clearfix">
        <div class="data">
           
            <input type="hidden" id="userid" name="userid" value="<? echo htmlspecialchars($userDetailsObj->userid); ?>"/>
            <input type="hidden" id="editgroupid" name="groupid" value="<? echo htmlspecialchars($userDetailsObj->group_id); ?>"/>
            <input type="hidden" id="chpwd" name="chpwd" value="true"/>
            <!--<h2>Member Information  </h2>-->
            <table width="100%" cellpadding="10" cellspacing="10" border="1" >
                <tr>
                <td width ="25%">Password</td>
                <td> <input id="password" name="password" type="password" value="" autocomplete="off"  class="pronameField"/></td>
                </tr>
                <tr>
                <td width ="25%">Confirm Password</td>
                <td> <input  id="cpassword" name="cpassword" type="password" value="" autocomplete="off"  class="pronameField"/></td>
                </tr>
                
            </table>
            
           
        </div>
    </div>
    <br>
    <p><input name="sub" type="submit" class="register"  id="sub" value="Save" />
    <p><input name="cancel" type="button" class="register" value="cancel" onclick="javascript: window.location='memprofile.php'"></p> 
      
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
</div> <!-- Div of container body-->
</p>

</div> <!-- Div of Main body -->

   <!--</form>-->
   </form> <!-- farheen -->
</div>
<div class="clearBoth"></div>



<!--  start footer  -->
<?php include ("includes/footer.php"); ?>
<!--  end footer  -->   
 </body>
</html>
