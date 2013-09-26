<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*Initial Development :- This page will be displayed once user clicks on details link.*/

session_start();
include_once("../includes/dbcon.php");
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SeasonWatch</title>
    <link href="css/global.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/form.css">
     
      <script type="text/javascript" src="js/initiate.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" id="" media="print, projection, screen" />
    
    
    <script type="text/javascript" id="js">
        
        /*$(function() {
            var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();
        var noofDays=DateDiff(d1, d2);
        $( "#fromdatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
        $( "#todatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
	});*/
        $(document).ready(function() {
         var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();
        var noofDays=DateDiff(d1, d2);
        $( "#fromdatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
        $( "#todatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
	// call the tablesorter plugin
	$("table").tablesorter({
		// sort on the first column and third column, order asc
		sortList: [[0,0],[2,0]]
	});
       
        
});
 function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
         return parseInt((t2-t1)/(24*3600*1000));
    }

    function filteration(usercat, state_id,pagesize) {
      
 
	if(state_id == "0") {
		state_id = document.getElementById("state").value;
	}
        if(usercat == "0") {
		usercat = document.getElementById("user_category").value;
	}
        var pagesize = document.getElementById("pagesize").value;
       
       	//url = 'getaltreedetails.php?species_id='+speciesid+'&state='+stateID;
        url = 'participants.php?state_id='+state_id+'&user-category='+usercat+'&pagesize='+pagesize;
	window.location = url;
}


</script>
    <style>
page_links
 {
  font-family: arial, verdana;
  font-size: 12px;
  border:1px #000000 solid;
  padding: 6px;
  margin: 3px;
  background-color: #cccccc;
  text-decoration: none;
 }
 #num
 {
  font-family: arial, verdana;
  font-size: 12px;
  border:1px #000000 solid;
  color: #ff0000;
  background-color: #cccccc;
  padding: 6px;
  margin: 3px;
  text-decoration: none;
 }
 </style>
</head>
    <?
    // how many rows to show per page
$rowsPerPage = 10;
if(isset($_GET['pagesize'])){$rowsPerPage = $_GET['pagesize'];}

// by default we show first page
$page_num = 1;

// if $_GET['page'] defined, use it as page number, $_GET gets the page number out of the url
//set by the $page_pagination below
if(isset($_GET['page'])){$page_num = $_GET['page'];}

//the point to start for the limit query
$offset = $page_num; 

// Zero is an incorrect page, so switch the zero with 1, mainly because it will cause an error with the SQL
if($page_num == 0) {$page_num = 1;}

$calc = $rowsPerPage * $page_num;
$start = $calc - $rowsPerPage;

  ?>
    <?php
 include ("../includes/header.php");
?>
    
<body>
<div class="wrapper">
<div class="body_content_3">
<div class="body_top">
    <div class="main">
        <div class="container">
            <!-- MyTrees and Add a Tree section-->
            <div class="mytree">Participants List</div>
            <div id="lightTwo" class="white_contentTwo">
                <a href = "javascript:void(0)" onclick = "document.getElementById('lightTwo').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeone.png" alt="close" /></a>
            </div>

          </div>
     </div>


</div> <!-- end div of body_top which includes Add tree heading-->
</div>
<?
$state_id-"";
$usercat= "";

$usercat = $_REQUEST['user-category'];
$state_id = $_REQUEST['state_id']; 
//echo $state_id;

if($_REQUEST['state_id'] > 0 || ($_REQUEST['user-category']!="0"))
{
$resultFltr = "";
$state_id = $_REQUEST['state_id'];
$usercat = $_REQUEST['user-category'];
if((int)$state_id > 0)
	$resultFltr .= " (users.state_id = $state_id)  ";
//if($usercat!="0")
  //	$resultFltr .= " AND (users.user_category = $usercat) ";
}
?>
    

    
    <div class="body_content"> <!--  start body_content  -->
        <div class="body_content_3">
              <br>      
           <div id="main">
            <select  id="state"  name="state" style="width:200px;" onChange='filteration(0,this.value)'>
            <option  value="0" <?php if((int)$state_id == '0') { ?> selected="selected" <? } ?>>--Filter By state--</option>
            <option value="1" <?php if((int)$state_id == '1') { ?> selected="selected" <? } ?>>Andaman and Nicobar Islands</option>
            <option value="2" <?php if((int)$state_id == '2') { ?> selected="selected" <? } ?>>Andhra Pradesh</option>
            <option value="3" <?php if((int)$state_id == '3') { ?> selected="selected" <? } ?>>Arunachal Pradesh</option>
            <option value="4" <?php if((int)$state_id == '4') { ?> selected="selected" <? } ?>>Assam</option>
            <option value="5" <?php if((int)$state_id == '5') { ?> selected="selected" <? } ?>>Bihar</option>
            <option value="6" <?php if((int)$state_id == '6') { ?> selected="selected" <? } ?>>Chandigarh</option>
            <option value="7" <?php if((int)$state_id == '7') { ?> selected="selected" <? } ?>>Chhattisgarh</option>
            <option value="8" <?php if((int)$state_id == '8') { ?> selected="selected" <? } ?>>Dadra and Nagar Haveli</option>
            <option value="9" <?php if((int)$state_id == '9') { ?> selected="selected" <? } ?>>Daman and Diu</option>
            <option value="10" <?php if((int)$state_id == '10') { ?> selected="selected" <? } ?>>Delhi</option>
            <option value="11" <?php if((int)$state_id == '11') { ?> selected="selected" <? } ?>>Goa</option>
            <option value="12"  <?php if((int)$state_id == '12') { ?> selected="selected" <? } ?>>Gujarat</option>
            <option value="13" <?php if((int)$state_id == '13') { ?> selected="selected" <? } ?>>Haryana</option>
            <option value="14" <?php if((int)$state_id == '14') { ?> selected="selected" <? } ?>>Himachal Pradesh</option>
            <option value="15" <?php if((int)$state_id == '15') { ?> selected="selected" <? } ?>>Jammu and Kashmir</option>
            <option value="16"  <?php if((int)$state_id == '16') { ?> selected="selected" <? } ?>>Jharkhand</option>
            <option value="17" <?php if((int)$state_id == '17') { ?> selected="selected" <? } ?>>Karnataka</option>
            <option value="18" <?php if((int)$state_id == '18') { ?> selected="selected" <? } ?>>Kerala</option>
            <option value="19" <?php if((int)$state_id == '19') { ?> selected="selected" <? } ?>>Lakshadweep</option>
            <option value="20" <?php if((int)$state_id == '20') { ?> selected="selected" <? } ?>>Madhya Pradesh</option>
            <option value="21" <?php if((int)$state_id == '21') { ?> selected="selected" <? } ?>>Maharashtra</option>
            <option value="22" <?php if((int)$state_id == '22') { ?> selected="selected" <? } ?> >Manipur</option>
            <option value="23" <?php if((int)$state_id == '23') { ?> selected="selected" <? } ?>>Meghalaya</option>
            <option value="24" <?php if((int)$state_id == '24') { ?> selected="selected" <? } ?>>Mizoram</option>
            <option value="25" <?php if((int)$state_id == '25') { ?> selected="selected" <? } ?>>Nagaland</option>
            <option value="26" <?php if((int)$state_id == '26') { ?> selected="selected" <? } ?>>Orissa</option>
            <option value="27" <?php if((int)$state_id == '27') { ?> selected="selected" <? } ?>>Pondicherry</option>
            <option value="28" <?php if((int)$state_id == '28') { ?> selected="selected" <? } ?>>Punjab</option>
            <option value="29" <?php if((int)$state_id == '29') { ?> selected="selected" <? } ?>>Rajasthan</option>
            <option value="30" <?php if((int)$state_id == '30') { ?> selected="selected" <? } ?>>Sikkim</option>
            <option value="31" <?php if((int)$state_id == '31') { ?> selected="selected" <? } ?>>Tamil Nadu</option>
            <option value="32" <?php if((int)$state_id == '32') { ?> selected="selected" <? } ?>>Tripura</option>
            <option value="33" <?php if((int)$state_id == '33') { ?> selected="selected" <? } ?>>Uttaranchal</option>
            <option value="34" <?php if((int)$state_id == '34') { ?> selected="selected" <? } ?>>Uttar Pradesh</option>
            <option value="35"<?php if((int)$state_id == '35') { ?> selected="selected" <? } ?> >West Bengal</option>
            </select>
            <select  id="user_category"  name="user_category" style="width:200px;" onChange='filteration(this.value,0)'>
            <option  value="">--Filter By Category--</option>
            <option  value="individual" <?php if($usercat == "individual") { ?> selected="selected" <? } ?>>Individual</option>
            <option  value="school" <?php if($usercat == "school") { ?> selected="selected" <? } ?>>school</option>
            <option  value="school-seed" <?php if($usercat == "school-seed") { ?> selected="selected" <? } ?>>school-seed</option>
            <option  value="school-gsp" <?php if($usercat == "school-gsp") { ?> selected="selected" <? } ?>>school-gsp</option>
            </select>   
              
            <!--From: <input type="text"  name="fromdatepicker" id="fromdatepicker" value="">
            To: <input type="text"  name="todatepicker" id="todatepicker" value="" >-->


           </div>
            <? ///echo $state_id;
            //echo $state_id;
            
            if($_REQUEST['state_id'] > 0 || ($_REQUEST['user-category']!="0"))
            {
                if ($usercat=="individual")
                {
                    $sql1="SELECT distinct users.user_id,users.user_category,users.city,users.state_id,seswatch_states.state,users.mobile,users.full_name, users.user_name
                    FROM `users`,user_groups,seswatch_states
                    WHERE users.user_category='$usercat' and seswatch_states.state_id= users.state_id and  $resultFltr Limit $start, $rowsPerPage";
                }
                else
                {
                   
                     $sql1="SELECT distinct users.user_id,user_groups.group_id,users.user_category,user_groups.group_name, seswatch_states.state,users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups,seswatch_states 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='$usercat' AND 
					user_groups.coord_id=users.user_id  and seswatch_states.state_id= users.state_id and $resultFltr Limit $start, $rowsPerPage";
                    
                    }
                    
                    if ($_REQUEST['state_id'] =="0")
                    {
                    
                        $sql1="SELECT distinct users.user_id,user_groups.group_id,users.user_category,user_groups.group_name, users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='$usercat' AND 
					user_groups.coord_id=users.user_id Limit $start, $rowsPerPage";
                    
                    }
              
            
                $rs_total_pending=mysql_query($sql1);
                $rows = mysql_num_rows($rs_total_pending);
               

            }
            
            
            
            ?>
            <br>
                
	<div id="demo">
            <? if ($rows>0)
            {?>
		<table cellspacing="1" class="tablesorter">
		<thead>
				<tr>
                                     <?if ($usercat<>"individual"){?>
					<th align="left">School name</th>
                                        <?}?>
					<th align="left">Coordinator Name</th>
					<th align="left">user id</th>
					<th align="left">Category</th>
                                        <th align="left">State</th>
                                        <th align="left">City</th>
                                        <th align="left">no of observation</th>
					

				</tr>
			</thead>
			<tbody>
                            <?
                            if($rows)
                            {$i = 0;
                            while ($sql1_row=mysql_fetch_array($rs_total_pending))
	{?>
				<tr>
                                     <?if ($usercat<>"individual"){?>
                            <td><?echo $sql1_row['group_name']?></td>
                            <?}?>
                            <td><?echo $sql1_row['full_name'] ?></td>
                            <td><?echo $sql1_row['user_id'] ?></td>
                            <td><?echo $sql1_row['user_category'] ?></td>
                            <td><?echo $sql1_row['state'] ?></td>
                            <td><?echo $sql1_row['city'] ?></td>
                            <? $userid=$sql1_row['user_id'];
                            $sql4= "select count(*) as num from user_tree_observations where deleted='0' and user_id ='$userid'";
                            $result4=mysql_query($sql4);
                            $data=mysql_fetch_assoc($result4);
                            $num_obs = $data['num'];
                               ?>
                                <td><a href="observationreport.php?userid=<?echo $userid?>&coord=<?echo $sql1_row[full_name]?>&groupname=<?echo $sql1_row[group_name]?>"><?echo $num_obs ?></a></td>
				</tr>
				<? }
                                }?>
			</tbody>
		</table>
            <?}
            else
            {
                echo "No records found";
            }?>
	</div>


        <?php
	  // generate paging here
       
        if(isset($page_num))
        {
               if($_REQUEST['state_id'] > 0 || ($_REQUEST['user-category']!="0"))
            {
                if ($usercat=="individual")
                {
                    $sql1="SELECT distinct users.user_id,users.user_category,users.city,users.state_id,seswatch_states.state,users.mobile,users.full_name, users.user_name
                    FROM `users`,user_groups,seswatch_states
                    WHERE users.user_category='$usercat' and seswatch_states.state_id= users.state_id and  $resultFltr ";
                }
                else
                {
                     $sql1="SELECT distinct users.user_id,user_groups.group_id,user_groups.group_name, seswatch_states.state,users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups,seswatch_states 
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='$usercat' AND 
					user_groups.coord_id=users.user_id  and seswatch_states.state_id= users.state_id and $resultFltr";
                        
                    }
                    
                    if ($_REQUEST['state_id'] =="0")
                    {$sql1="SELECT distinct users.user_id,user_groups.group_id,user_groups.group_name, users.mobile,users.full_name, users.user_name
					FROM `users`,`user_tree_table`,user_groups
					WHERE users.user_id=user_tree_table.user_id AND 
					users.user_category='$usercat' AND 
					user_groups.coord_id=users.user_id ";
                    }
              
              // echo $sql1;
                $rs_total_pending=mysql_query($sql1);
                $totalrows = mysql_num_rows($rs_total_pending);
               // echo $rows;

            }
           
           // how many pages we have when using paging?
$numofpages = ceil($totalrows/$rowsPerPage);

// print the link to access each page
$self = "participants.php?state_id=$state_id&user-category=$usercat&pagesize=$rowsPerPage&";   

//echo $numofpages;
if ($numofpages > '1' ) {

            $range =10; //set this to what ever range you want to show in the pagination link
            //$range=$rowsPerPage ;
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $page_num- $range_min;
            $page_max = $page_num+ $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $numofpages) {
                $page_min = ($page_min > 1) ? $numofpages - $range + 1 : 1;
                $page_max = $numofpages;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            //$page_content .= '<p class="menuPage">';

            if ( ($page_num > ($range - $range_min)) && ($numofpages > $range) ) {
                $page_pagination .= '<a class="page_links"  title="First" href="'.$self.'page=1">&lt;</a> ';
                
            }

            if ($page_num != 1) {
                $page_pagination .= '<a class="num" href="'.$self.'page='.($page_num-1). '">Previous</a> ';
            }

            for ($i = $page_min;$i <= $page_max;$i++) {
                if ($i == $page_num)
                $page_pagination .= '<span class="num"><strong>' . $i . '</strong></span> ';
                else
                $page_pagination.= '<a class="num" href="'.$self.'page='.$i. '">'.$i.'</a> ';
            }

            if ($page_num < $numofpages) {
                
                $page_pagination.= '<span > <a class="num" href="'.$self.'page='.($page_num + 1) . '">Next</a></span>';
            }


            if (($page_num< ($numofpages - $range_max)) && ($numofpages > $range)) {
                $page_pagination .= ' <a class="num" title="Last" href="'.$self.'page='.$numofpages. '">&gt;</a> ';
            }
            
            //$page['PAGINATION'] ='<p id="pagination">'.$page_pagination.'</p>';
        }//end if more than 1 page ?>
           

            <br>
                <?if ($rows>0){?>
                <hr>
                    <?}?>
                    <script>
                    function sendpagesize()
                    {
                        //alert("page");
                        var pagesize = document.getElementById("pagesize").value;
                        //alert(pagesize);
                        state_id = document.getElementById("state").value;
                        usercat = document.getElementById("user_category").value;
                        url = 'participants.php?state_id='+state_id+'&user-category='+usercat+'&pagesize='+pagesize;
                        window.location = url;
                    }
                    </script>
            <div align="center" class="page_links"><?echo $page_pagination?></div>
            <select class='pagesize'  id="pagesize" onchange="sendpagesize()">
            <option <?php if((int)$rowsPerPage == '10') { ?> selected="selected" <? }?>  value='10'>10</option>
            <option value='20' <?php if((int)$rowsPerPage == '20') { ?> selected="selected" <? }?>>20</option>
            <option value='30' <?php if((int)$rowsPerPage == '30') { ?> selected="selected" <? }?>>30</option>
            <option  value='40' <?php if((int)$rowsPerPage == '40') { ?> selected="selected" <? }?>>40</option>
            </select>
              <?if ($rows>0){?>
                <hr>
                    <?}?>
                     <?if ($rows>0){?>
<?echo 'Total number of participants- '.$totalrows ;
}
//echo ' and Number of pages   - '.$numofpages.'<BR><BR>';


        }
	  ?>
                   
            </div>
        
        </div>
    </div>
</div>


<?php include ("includes/indivfooter.php"); ?>
</body>
</html>