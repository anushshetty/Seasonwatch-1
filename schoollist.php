<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?
   ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('display_errors','On'); /* to display the errors*/
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    $page_title="school Info";
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SeasonWatch :<?echo $page_title?></title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/initiate.js"></script>
<style>
.highlight
{
background-color:yellow;
}
</style>
<script type="text/javascript">


$(function() {
	
    $( "#autotag" ).autocomplete({source: 'suggestschools.php',
        selectFirst: 'true',
          focus: function(event, ui) {
            $('#autotag').val(ui.item.value);
        return false; }
    });
       
        
        
    });
    function search()
    {
        var string= $('#autotag').attr('value');
        highlight(string);
  
    }
    function highlight(text)
{
    var inputText = document.getElementById("Schoolinfo")
      $('.highlight').removeClass('highlight');
    
    var innerHTML = inputText.innerHTML
    var index = innerHTML.indexOf(text);
    if ( index >= 0 )
    { 
        innerHTML = innerHTML.substring(0,index) + "<span class='highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
        inputText.innerHTML = innerHTML 
    }
    else
        {
            alert("Not Found"); 
        }
   $(window).scrollTop($('.highlight').position().top-10);  
    
    
}

    </script>

</script>
</head>

<body>
      <div class="header_place_holder">
        <div class="main"><!--  start main  -->
             <div class="header"><!--  start header  -->
                <div class="logo"><img src="images/seasonwatchlogo.png" alt="" width="180" height="82" /></div>
                <div class="top_right">
                    <ul>
                     <li><span class="tree"><?echo Login::NoTrees();?></span><p>Trees</p></li>
                    <li><span class="observation"><?echo Login::NoOfObservation();?></span><p>Observations</p></li>
                    <!--<li><span class="observation"><?echo number_format(Login::NoOfObservation());?></span><p>Observations</p></li>-->
                    <li><span class="participant"><?echo Login::NoParticipants();?></span><p>Participants</p></li>
                    <li><span class="school"><? echo Login::NoSchools();?></span><p class="schools">Schools</p></li>
                    </ul>
                </div>

                </div><!--  end header  -->
            </div><!--  end main  -->
        <div class="clearBoth"></div>
    </div>    
    <div class="wrapper">
        <div class="body_content_2">
        <div class="body_top">
        <div class="main">
            <div id="Search" style="float:right;margin-right:30px; ">
            <input type="text" name="autotag" id="autotag" value="Enter school name" onfocus="if(this.value=='Enter school name')this.value='';"  class="serachnameField"/>
            <input type="image" src="images/search_t.gif" alt="Search" title="search by school name" class="button_search"  onclick="search();">
            </div>
            <div class="container">
                <div class="mytree"> <h2>School list </h2></div>
              </div>
          </div>
        </div> <!-- end div of body_top which includes Add tree heading--> 
     <div class="clearBoth"></div>
     <?
      
   
$query="SELECT distinct users.user_id,users.user_category,users.city,user_groups.group_id,user_groups.group_name, users.mobile,users.full_name, users.user_name
					FROM `users`,user_groups
					WHERE 
					(users.user_category='school-seed'OR users.user_category='school-gsp' OR  users.user_category='school')AND
					user_groups.coord_id=users.user_id and approved='1'  ORDER BY  user_id";   



     $result4 = $dbc->readtabledata($query);
 if(!$result4)
{
	die("query no executed:".mysql_errno());

}

?>
    
        
     <div id="Schoolinfo" name="Schoolinfo" >     
<table>
         <tr>
             <td class="addleavesSection_boxOne"><h5> sl no</h5> </td>
             <td style='width:500px;color:#333;'>
                     <h5>School name</h5>
             </td>
              <td style='width:150px;'>
                  <h5>City</h5>
             </td>
             <td style='width:150px;'>
                 <h5>User Category</h5>
             </td>
             <td style='width:150px;'>
                 <h5> No of trees</h5>
             </td>
             
             <!--<td style='width:300px;'>No of observations</td>-->
         </tr>
         
<?
$i=0;
while($row=mysql_fetch_assoc($result4))
{?>
         
        <?$query2=" SELECT  COUNT( * ) AS num 
        FROM  user_tree_table,users,trees
        where user_tree_table.user_id=users.user_id
        and users.user_id='$row[user_id]' and trees.deleted='0' and user_tree_table.tree_id=trees.tree_id";
        $result = $dbc->readtabledata($query2);
        $data=mysql_fetch_assoc($result);
        $tree_num = $data['num'];
       
       /* $query3=" SELECT  COUNT( * ) AS num 
        FROM  user_tree_observations,users
        where user_tree_observations.user_id=users.user_id
        and users.user_id='$row[user_id]' and deleted=0";
        $result1 = $dbc->readtabledata($query3);
        $data1=mysql_fetch_assoc($result1);
        $ob_num = $data1['num'];*/
       if ($tree_num >0)
        {
         $i++;?>
          <tr>
             <td><?echo $i;?></td>
        <td> <? if (!(empty($row['group_name'])))
        {echo $row['group_name'];
        } else
        {echo "-";}
        ?></td>
        
        <td> <?if(!(empty($row['city']))) {echo $row['city'];}else {echo "-";}?></td>
         <td> <?echo $row['user_category']?></td>
        <td><?echo $tree_num?></td>
        <td><?///echo $ob_num
                ?></td>
         </tr>
            
       <? }?>
       
       
<?}?>
     </table>
     </div>
    <br>
      <div class="clearBoth"></div>
        </div>
    </div>
     <div id="mask"></div>
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->

</body>
</html>
    