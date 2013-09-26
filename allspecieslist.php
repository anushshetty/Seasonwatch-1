<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('25focallist').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';
    window.scrollTo(0,0);"><img src="images/closeone.png" alt="close" style="float:right"/></a>

<form>
<div class="contentspecies">
    <h4>25 Focal Species of SeasonWatch: </h4>
    <table >
        <tr>
            <th>No</th>    
            <th style="width:300px;nowrap">English Name</th>
            <th style="width:300px;nowrap">Scientific Name</th>
            <th style="width:300px;nowrap">Hindi Name</th>
            <!-- <th style="width:300px;nowrap">Mal Name</th>-->
           
        </tr>
        <? $start =0;
             $page_limit=25;   
             $page ="1";
        //3-hindi
        //  8-Malayalam
    /*   $query="SELECT species_id,language_id, alternative_name as hindiname  FROM `species_alternate_name` 
           where language_id='3'UNION SELECT species_id,language_id,alternative_name as malname FROM 
           `species_alternate_name` where language_id='8' ";*/
           $query = "SELECT m.species_id, m.species_primary_common_name,
                  m.species_scientific_name,i.alternative_name,i.language_id FROM species_master as m,
                  species_alternate_name as i WHERE m.species_id=i.species_id  group by species_id 
                  order by m.species_scientific_name desc limit $start,$page_limit ";
          // 
           //echo $query;   
            $query_result=$dbc->readtabledata($query);
             //  $num = mysql_num_rows($query_result);
              // echo $num;
             
            $i=0; 
            while($data = mysql_fetch_assoc($query_result)) {
      
        $i++;?>
        <tr>
        <td><?echo $i;?></td>
                <td nowrap><?echo  $data['species_primary_common_name']; ?></td>
                <td style="width:300px;nowrap"><? echo $data['species_scientific_name']; ?></td>
                <td style="width:300px;nowrap"><?if ($data['language_id']=="3"){
                    echo $data['alternative_name'];}?></td>
             <!--   <td style="width:300px;nowrap"><?if ($data['language_id']=="8"){
                    echo $data['alternative_name'];}?></td>-->
               
                    
        </tr>           
    <?}?>
    </table>
   <div class="button_area_ok"><a href="#" onclick = "document.getElementById('allspecieslist').style.display='block';
                                    document.getElementById('fade').style.display='block';document.getElementById('page').value='2';window.scrollTop(0,0)" >)">OK</a></div>
    <script>
        function getnextvalues(page)
        {
            alert(page);
        }
        </script>
        
      
</div>
</form>
</div>
                            <!-- CSS goes in the document HEAD or added to your external stylesheet -->

