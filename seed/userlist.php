<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 include 'includes/dbcon.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch </title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/initiate.js"></script>
<script>
	$(function() {
            var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();
        var noofDays=DateDiff(d1, d2);
        $( "#fromdatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
        $( "#todatepicker" ).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
	});
	
    function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
         return parseInt((t2-t1)/(24*3600*1000));
    }
    function filteration(userfilter,fromdate,todate,page_limit,page)
    {
         //var dataString = "usertreeid="+$("#usertreeid"+ID).attr('value');
        //alert(userfilter);
	url = 'userlist.php?userfilter='+userfilter+'&fromdate='+fromdate+'&todate='+todate+'&pagelimit='+page_limit+'&page='+page; 
        // url = 'participants.php?state_id='+state_id+'&user-category='+usercat;
	window.location = url;
    }
</script>


<body>
    <?$fromdate_raw = mktime(0, 0, 0, date("m")-12, date("d"), date("y"));
$userfilter = 0;
//$fromdate = date("m-d-Y");
$fromdate = date("Y-m-d");
//$todate = date('m-d-Y');
$todate = date("Y-m-d");
//echo $_REQUEST['userfilter'];
if(isset($_REQUEST['userfilter'])){
	$userfilter = $_REQUEST['userfilter'];
        //echo $userfilter;
	$fromdate = $_REQUEST['fromdatepicker'];
	$todate = $_REQUEST['todatepicker'];
        $page_limit =$_REQUEST['todatepicker'];
}
$page_limit = 10; 
if (!isset($_GET['page']) )
{ $start=0; } else
{ $start = ($_GET['page'] - 1) * $page_limit;

$userfilter = $_GET['userfilter'];
       // echo $userfilter;
	$fromdate = $_GET['fromdate'];
	$todate = $_GET['todate'];

}
//echo $_GET['page'];
//echo $fromdate;
    // how many rows to show per page
$rowsPerPage = 10;

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
//echo $page_num;
  ?>

    <div class="wrapper">
<div class="body_content_2">
    
    <div class="body_top">
        <div class="main">
            <div class="container">
                <div class="mytree"> <h2> Seasonwatch Report </h2></div>
              </div>
        </div>
    </div> <!-- end div of body_top which includes Add tree heading-->
    <div class="clearBoth"></div>
    <div class="container">
        <div class="clearBoth"></div>
        <form action="userlist.php" name="listFilter" id="listFilter" method="post" style="margin:0;">
        <table style="width: 100%;margin-top:10px;margin-bottom: 10px;">
        <tr>
        <td> Select User type
        <select id="userfilter" name="userfilter" style="width:208px;border:1px solid #cccccc;" onChange="filteration(this.value,<?echo $fromdate?>,<?echo $todate?>,<?echo $page_limit?>,<?echo $page?>)">
        <option value="0">All users</option>
        <option value="1" <?php if($userfilter == '1') { ?> selected="selected" <? } ?>>Users have not added any tree</option>
        <option value="2" <?php if($userfilter == '2') { ?> selected="selected" <? } ?>>Users have not reported observation on tree</option>
         <option value="3" <?php if($userfilter == '3') { ?> selected="selected" <? } ?>>Users with observations</option>
        </select>
        </td>
        
        <td>
        From: <input type="text"  name="fromdatepicker" id="fromdatepicker" value="<?=$fromdate;?>" class="commonfield">
        </td>
        <td>
        To: <input type="text"  name="todatepicker" id="todatepicker" value="<?=$todate;?>" class="commonfield" >
        </td>
        <td>
        <input type="submit" name="btnFilter" id="btnFilte" value="Filter" style='padding:5px;color:#red;'/>
        </td>
        </tr>
        </table>
        </form>
    </div>

  

    
    <table id="table1" class="tablesorter">
	<thead>
		<tr>
			<th style='width:80px;'>User ID</th>
			<th style='width:120px'>Join Date</th>           
			<th style='width:120px'>User Name</th>
			<th style='width:100px'>Email</th>                        
			<th style='width:200px'>Location</th>
			
		</tr>
	</thead>
	<tbody>    
		 
	<?php  
	if($userfilter == '1')
	{ 
                $quest1="SELECT DISTINCT * FROM users WHERE user_id NOT IN (SELECT distinct user_id FROM user_tree_table) and date between '$fromdate' and '$todate' 
                    and  banned='0' order by user_id desc limit $start,$rowsPerPage";
		$rs_pending = mysql_query($quest1) or die(mysql_error());
	}
	else if ($userfilter == '2')
	{	
            $quest1="SELECT DISTINCT * FROM users u, user_tree_observations uto WHERE uto.user_id=u.user_id 
                and u.date between '$fromdate' and '$todate'order by u.user_id desc limit $start,$rowsPerPage ";
           	$rs_pending = mysql_query($quest1) or die(mysql_error());
	
                
        }
        else if ($userfilter == '3')
	{	
            $quest1="SELECT DISTINCT * FROM users u, user_tree_observations uto WHERE uto.user_id=u.user_id 
                and u.date between '$fromdate' and '$todate'order by u.user_id desc limit $start,$rowsPerPage ";
           	$rs_pending = mysql_query($quest1) or die(mysql_error());
	
                
        }
	else
	{
           
            $quest1="select * from users where date between '$fromdate' and '$todate'  order by user_id desc limit $start,$rowsPerPage";
		$rs_pending = mysql_query($quest1) or die(mysql_error());
		
	}
            //echo $quest1;
         $rows = mysql_num_rows($rs_pending);
	//$nos_pending = mysql_num_rows($rs_pending);
	while ($prows = mysql_fetch_array($rs_pending)) {?>
		<tr> 
			<td style='width:80px;'><? echo $prows['user_id']?></td>
			<td style='width:120px'><? echo date("Y-m-d", strtotime($prows['date_of_addition']));?></td>
			<td style='width:120px'><? echo $prows['full_name']?></td>
			<td style='width:100px'><? echo $prows['user_email']?></td>
			<td style='width:200px'>
				<?php  
				$query=mysql_query("SELECT state FROM seswatch_states WHERE state_id='$prows[state_id]'");

				while($query1 = mysql_fetch_array($query))
				{
				echo $query1['state'];
				}
				?>
			</td>
			
		</tr>

			
			
	<? } ?>
	</tbody>
</table>
    
    <br>
    <!-- PageLimit 
      <select id="page_limit" name="page_limit" style="width:50px;border:1px solid #cccccc;" 
              
          onchange="this.form.submit();">
        <option value="10" <?php if($page_limit == '10') { ?> selected="selected" <? } ?>>10</option>
        <option value="20" <?php if($page_limit == '20') { ?> selected="selected" <? } ?>>20</option>
        <option value="30" <?php if($page_limit == '30') { ?> selected="selected" <? } ?>>30</option>
        </select>-->
  <?php
	  // generate paging here
       
        if(isset($page_num))
        {
                if($userfilter == '1')
                { 
                $rs_pending = mysql_query("SELECT DISTINCT * FROM users WHERE user_id NOT IN (SELECT distinct user_id FROM user_tree_table) and date between '$fromdate' and '$todate' and  banned='0' order by user_id desc ") or die(mysql_error());
                }
                else if ($userfilter == '2')
                {		
                $rs_pending = mysql_query("SELECT DISTINCT * FROM users u INNER JOIN user_tree_table utt ON utt.user_id = u.user_id inner JOIN user_tree_observations uto ON uto.user_id != utt.user_id WHERE u.date between '$fromdate' and '$todate'  order by u.user_id desc ") or die(mysql_error());
                }
                 else if ($userfilter == '3')
                {		
                $rs_pending = mysql_query("SELECT DISTINCT * FROM users u INNER JOIN user_tree_table utt ON utt.user_id = u.user_id inner JOIN user_tree_observations uto ON uto.user_id != utt.user_id WHERE u.date between '$fromdate' and '$todate'  order by u.user_id desc ") or die(mysql_error());
                }
                else
                {
                $rs_pending = mysql_query("select * from users where date between '$fromdate' and '$todate'  order by user_id desc") or die(mysql_error());

                }
                
              
              // echo $sql1;
                $rs_total_pending=mysql_query($rs_pending);
                $totalrows = mysql_num_rows($rs_pending);
                //echo $totalrows;

            }
           
           // how many pages we have when using paging?
$numofpages = ceil($totalrows/$page_limit);
//echo $numofpages;
//$fromdate = $_REQUEST['fromdatepicker'];
	//$todate = $_REQUEST['todatepicker'];
// print the link to access each page
$self = "userlist.php?userfilter=$userfilter&fromdate=$fromdate&todate=$todate&pagelimit=$page_limit&";   

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
            
            $page['PAGINATION'] ='<p id="pagination">'.$page_pagination.'</p>';
        }//end if more than 1 page ?>
           

            <br>
            
            <br>
                <?if ($rows>0){?>
                <hr>
                    <?}?>
            <div align="center" class="page_links"><?echo $page_pagination?></div>
              <?if ($rows>0){?>
                <hr>
                    <?}?>
                     <?if ($rows>0){?>
<?echo 'Total number of users- '.$totalrows ;
}
   
	  ?>
                
                
            </div>
    </div>
      </div>
    </form>
</body>

        