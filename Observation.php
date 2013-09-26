<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

class Observation{
	var $exists;
	
	var	$bservation_id;
	var $date;
	var $freshleaf_count;
	var $matureleaf_count;
	var $bud_count;
	var $open_flower_count;
	var $fruit_ripe_count;
	var $fruit_unripe_count;
        function AddObservation($dbc,$observationdata)
        {
          
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
                 ( '$observationdata[0]',  
                   '$observationdata[2]', 
                   '$observationdata[3]', 
                   '$observationdata[4]',
                   '$observationdata[5]', 
                   '$observationdata[6]', 
                   '$observationdata[7]', 
                   '$observationdata[8]',
                   '$observationdata[9]',  
                   '$observationdata[10]',  
                   '$observationdata[11]',  
                   '$observationdata[12]',
                   '$observationdata[13]',
                   '$observationdata[1]','$observationdata[19]','$observationdata[14]','$observationdata[15]','$observationdata[16]','$observationdata[17]','$observationdata[18]')";  
                 $addobserv_rec=$dbc->readtabledata($result);
            
             $sql = mysql_query("UPDATE user_tree_table SET `last_observation_date`=GREATEST('$observationdata[0]',`last_observation_date`) WHERE user_tree_id='$observationdata[1]';");
             $addobserv_updatetreerec=$dbc->readtabledata($sql);
             return($addobserv_updatetreerec);
             
        
            
            
        }
        function EditObservation($dbc,$observationdate,$treeid)
        {
            
            
        }
        
        function IsObservationExists($dbc,$observationdate,$usertreeid)
        {
            $chkobser="Select * from user_tree_observations where user_tree_id='$usertreeid' and date='$observationdate'";
            $chkobser_rec=$dbc->readtabledata($chkobser);
           // $result = mysql_query($sqlBeforeupdate) or die (mysql_error()); 
            $Isexists = mysql_num_rows($chkobser_rec);
            return($Isexists);
            
        }
	
	
}
?>