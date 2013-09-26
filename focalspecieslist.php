<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<a href = "javascript:void(0)" onclick = "document.getElementById('25focallist').style.display='none';document.getElementById('lightReg').style.display='none';document.getElementById('fade').style.display='none';
  "><img src="images/closeone.png" alt="close" style="float:right"/></a>

<form>
<div class="contentspecies">
    <h4>25 Focal Species of SeasonWatch: </h4>
    <table class="gridtable">
        <tr>
            <th>No</th>    
            <th>English Name</th>
            <th>Scientific Name</th>
            <th>Hindi Name</th>
            <th>Malayalam Name</th>
        </tr>
        <?  $xml = simplexml_load_file("seedtrees.xml")  or die("Error: Cannot create object");
        $i=0;
        foreach($xml->children() as $Trees){
        $i++;?>
        <tr>
        <td><?echo $i;?></td>
                <td nowrap><?echo $Trees->englishname;?></td>
                <td nowrap><?echo $Trees->sciencename;?></td>
                <td nowrap><?echo $Trees->hindiname?></td>
                <td nowrap><?echo $Trees->malayamname;?></td>
        </tr>           
    <?}?>
    </table>
    </br>
</div>
</form>
</div>
                            <!-- CSS goes in the document HEAD or added to your external stylesheet -->
