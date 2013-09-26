<?php 
/* This page is called when user addes observation from dashboard.
 * This page will update the database and updates the xml docuument
 * 
 * 
 * 
 */
session_start();
if (!isset($_SESSION['userid']))
        {
            header("Location: index.php");
        }
include 'includes/dbcon.php';
if (isset($_SESSION['userid']))
{
    
    $obdate     = sanitize($_POST['obdate']);
    $is_leaf_fresh=sanitize($_POST['is_leaf_fresh']); 
    $freshleaf_count=sanitize($_POST[freshleaf_count]);
    $is_leaf_mature=sanitize($_POST[is_leaf_mature]);
    $matureleaf_count=  sanitize($_POST[matureleaf_count]); 
    $is_flower_bud= sanitize($_POST[is_flower_bud]); 
    $bud_count= sanitize($_POST[bud_count]); 
    $is_flower_open =sanitize($_POST[is_flower_open]);
    $open_flower_count=sanitize($_POST[open_flower_count]);  
    $is_fruit_ripe = sanitize($_POST[is_fruit_ripe]);  
    $fruit_ripe_count = sanitize($_POST[fruit_ripe_count]);
    $is_fruit_unripe  = sanitize($_POST[is_fruit_unripe]);
    $fruit_unripe_count=sanitize($_POST[fruit_unripe_count]);
    $leaf_caterpillar=sanitize($_POST[leaf_caterpillar]);
    $flower_butterfly=sanitize($_POST[flower_butterfly]);
    $flower_bee= sanitize($_POST[flower_bee]);
    $fruit_bird=sanitize($_POST[fruit_bird]);
    $fruit_monkey= sanitize($_POST[fruit_monkey]);                   
             
                  
    $tree_id = mysql_query("SELECT tree_id FROM trees WHERE user_id='$_SESSION[userid]'");
    $usertreeid=trim($_POST['usertreeid']);
    $insertdate=date("Y-m-d",strtotime($obdate));
    //echo $insertdate; 
    //Check the BeforeInsert to make sure that only one data is entered for a tree for a day.
    $sqlBeforeupdate= "Select * from user_tree_observations where user_tree_id='$_POST[usertreeid]' and date='$_POST[obdate]'";
    //echo $sqlBeforeupdate;
    $result = mysql_query($sqlBeforeupdate) or die (mysql_error()); 
    $num = mysql_num_rows($result);
    //echo $num;
    if ($num ==0)
    {
        foreach($_POST as $key => $value)
        { 
            $data[$key] = strip_tags($value);
        } 
        $result = "INSERT INTO user_tree_observations    
         (date,
         is_leaf_fresh,
         freshleaf_count,
         is_leaf_mature,
         matureleaf_count,
         is_flower_bud,
         bud_count,
         is_flower_open,
         open_flower_count,
         is_fruit_ripe,
         fruit_ripe_count,
         is_fruit_unripe,
         fruit_unripe_count,user_tree_id,user_id,leaf_caterpillar,flower_butterfly,flower_bee,fruit_bird,fruit_monkey) 
         VALUES
                 ( '$insertdate',  
                   '$is_leaf_fresh', 
                   '$freshleaf_count', 
                   '$is_leaf_mature',
                   '$matureleaf_count', 
                   '$is_flower_bud', 
                   '$bud_count', 
                   '$is_flower_open',
                   '$open_flower_count',  
                   '$is_fruit_ripe',  
                   '$fruit_ripe_count',  
                   '$is_fruit_unripe',
                   '$fruit_unripe_count',
                   '$usertreeid','$_SESSION[userid]','$leaf_caterpillar','$flower_butterfly','$flower_bee','$fruit_bird','$fruit_monkey')";  

         //echo $result;
         // mysql_query($result,$link) or die("Insertion failed:" .mysql_error());
    mysql_query($result);
        $sql = mysql_query("UPDATE user_tree_table SET `last_observation_date`=GREATEST('$insertdate',`last_observation_date`) WHERE user_tree_id='$usertreeid';");
        //mysql_query($sql,$link) or die("Insertion failed:" .mysql_error());
		mysql_query($sql);
        //Write xml document with all the treename
        //include_once("writexmldoc.php");
        //add observation in 

       // $logmsg= "Observation added sucessfully.";
         $logmsg= "0";
        //mysql_close($link);
    }
    else
    {
          $logmsg= "1";
       //$logmsg= "Observation with this date for this tree is already exits.";
        mysql_close($link);
    }
    echo $logmsg;
}
?>