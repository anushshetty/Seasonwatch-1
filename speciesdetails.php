<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php 
/*Initial Development :- This page will be displayed once user clicks on details link.*/
 //error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors',1);
//session_start();    
//include_once("includes/dbcon.php"); 
 include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SeasonWatch</title>

    <link href="css/global.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/popup.js"> </script>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
    <script type="text/javascript" src="js/custom-form-elements1.js"></script>
    <script type="text/javascript" src="js/initiate.js"></script>
   
    <style type="text/css"> 
       ul#display-inline-block-example,
	ul#display-inline-block-example li {
		/* Setting a common base */
		margin: 0;
		padding: 0;
	}

	ul#display-inline-block-example {
		/*width: 300px;
		//border: 1px solid #000;*/
	}

	ul#display-inline-block-example li {
		display: inline-block;
		width: 25%;
		//min-height: 170px;
		//border:solid 1px #333;		
		vertical-align: middle;
		margin-bottom:15px;
		text-align:center;
		font-size:14px;
		<strong>/* For IE 7 */
		zoom: 1;
		*display: inline;</strong>
	}
	
        ul#display-inline-block-example li img {
	       //vertical-align:middle;
	       //vertical-align: 50%;
	       text-align:center;
	       border: solid 4px #ddd;
	       margin-left:25px;
	       margin-right:30px;
	}
</style>
    <script type="text/javascript">
    $(document).ready(function()
{  
    $('a[name=itemModal]').click(function(e)
	{
		e.preventDefault();
		var toOpenModal = '#'+$(this).attr('href');
                $(toOpenModal).show();
		$('#fadeOne').show().height($('body').height());
		$(document).scrollTop(140);
                
                          
 	});
        $('a[name=openAddTreeModal]').click(function()
	{
        	$('#lightFour').show();
		$('#fadeOne').show().height($('body').height());
                var src=$(this).children('img').attr('src');
                alert(src);
                $('#lightFourin').val('src');
                window.scrollTo(0, 0);
                var toOpenModal = '#'+$(this).attr('href');
                $(toOpenModal).show();
                showDet(src);
		
	});
});

function getspeciesinfo($speciesid)
    {
     //alert($speciesid);
  
        $.post
        (
        'speciesinfo.php',
        {SpeciesID:$speciesid},
        function (data)
            { 
                alert(data);
               /* if(data!=0)
                {
                   
                    alert("Observation with this data already exits.");
                    document.getElementById("eobdate"+boxno).focus();
                    return false;
                }*/
                //document.getElementById("editrow"+boxno).value=1;
            }
        )
   /*? }
    else
    {
        document.getElementById("eobdate"+boxno).focus();
        return false;
    }*/
    }
</script>
</head>
<body>
    <?php include ("includes/header.php"); ?> <!--  start header_place_holder  -->
     <!--  end header_place_holder  -->
     
   
      
       <div class="body_content"> <!--  start body_content  -->
        <!--  start body_top  -->
    	<div class="body_top">
        <!--  start main  -->
        	<div class="main">
               	<h3 class="Rhythm_TEXT">SeasonWatch Species</h3>
                 <div class="container"> 
                   <div class='section'>
    	<ul class='gal_pics' id='display-inline-block-example'>
        <?
             $query = "SELECT m.species_id, m.species_primary_common_name,
                  m.species_scientific_name, m.family,m.size_description,m.flower_description,m.bark_description,
                  m.fruit_description,m.spine_thorn_description,m.flowering_time,m.fruiting_time,m.time_of_leaf_flush,
                  m.special_notes_on_phenology,m.similar_species,m.known_pollinators,m.known_seed_dispersers,
                  m.uses_by_humans,m.list_of_references,m.special_notes_on_the_species,
                  i.path_name, i.file_name FROM species_master as m,species_images as i WHERE m.species_id=i.species_id  group by species_id order by m.species_scientific_name";
             // $query = "SELECT * FROM species_master as m,species_images as i WHERE m.species_id=i.species_id  group by species_id order by m.species_scientific_name";
         
                //$query_result = mysql_query($query);   
            $query_result=$dbc->readtabledata($query);
            $i=0; 
            while($data = mysql_fetch_assoc($query_result)) {
                 $species_pic1 = $data['path_name'].$data['file_name'];
                 
                 $i++;
                 ?>
            
               
                    <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightFour<?echo $i?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="<?echo $species_pic1?>"   style='max-width:150px' alt=""  title="Add Observation" /></a></li>
                    <div id="lightFour<?echo $i?>" class="white_contentspecies">
                        <a href="javascript:void(0)" onclick="document.getElementById('lightFour<?echo $i?>').style.display='none';document.getElementById('fadeOne').style.display='none';"><img src="images/closeone.png" alt="close" style="float:right"/></a>
                        <h5>
                           Species: <? echo $data['species_primary_common_name']; ?></h5>
                        <div class="speciesBoardcontainer">
                            <div class="speciesBoardcontainer_both">
                            
                             <table >
                            <tr style="width:100%;">
                                <td style="width:70px;"> Scientific Name </td>
                                <td style="width:30px;"> :</td>
                                <td style="width:250px;"><? echo htmlspecialchars($data['species_scientific_name']); ?></td>
                                
                                <td style="width:50px;"></td>
                                <td style="width:70px;"> Family </td>
                                <td style="width:30px;">:</td>
                                <td style="width:100px;"><? if (!empty( $data['family']))
                                {
                                   echo htmlspecialchars($data['family']); 
                                } else
                                {"-";}?></td>
                            </tr>
                              <tr style="width:100%;">
                                <td style="width:70px;"> Leaf Size Description</td>
                                  <td style="width:30px;"> :</td>
                                <td><?if(!empty($data['size_description']))
                                {
                                    echo htmlspecialchars($data['size_description']);
                                }
                            else {echo "-";} ?></td>
                                  <!-- <td style="width:50px;"></td>
                                   <td style="width:70px;"> <img src="<?echo $species_pic1?>" align="top"></td>-->

                            </tr>
                            <tr>
                                <td> flower_description</td>
                                 <td>:</td>
                                <td><?if(!empty($data['flower_description']))
                                {
                                echo htmlspecialchars($data['flower_description']); }else{echo "-";}?></td>

                            </tr>
                            <tr>
                                <td style="width:70px;"> bark_description</td>
                                 <td>:</td>
                                <td><?if(!empty($data['bark_description'])) {echo htmlspecialchars($data['bark_description']); }else{echo"-";}?></td>

                            </tr>
                            <tr>
                                <td style="width:70px;">fruit_description</td>
                                 <td>:</td>
                                <td><?if(!empty($data['bark_description'])){ echo htmlspecialchars($data['size_description']);}else{echo"-";} ?></td>

                            </tr>
                            <tr>
                                <td style="width:70px;"> fruit_description</td>
                                 <td>:</td>
                                <td><? echo $data['fruit_description']; ?></td>

                            </tr>
                            <tr>
                                <td style="width:70px;">spine_thorn_description</td>
                                 <td>:</td>
                                <td><? echo $data['spine_thorn_description']; ?></td>

                            </tr>
                            <tr>
                               <td style="width:70px;"> flowering_time</td>
                                 <td>:</td>
                                <td><? echo $data['size_description']; ?></td>

                            </tr>
                            <tr>
                                <td style="width:70px;"> fruiting_time</td>
                                 <td>:</td>
                                <td><? echo $data['size_description']; ?></td>

                            </tr>
                            <tr>
                                <td> time_of_leaf_flush</td>
                                 <td>:</td>
                               <!-- <td><? echo $data['size_description']; ?></td>-->

                            </tr>
                             <tr>
                                <td style="width:70px;">known_pollinators</td>
                                 <td>:</td>
                                <!--<td><? echo $data['size_description']; ?></td>-->

                            </tr>
                             <tr>
                                <td style="width:70px;">known_seed_dispersers</td>
                                 <td>:</td>
                               <!-- <td><? echo $data['size_description']; ?></td>-->

                            </tr>
                           
                             <tr>
                                <td style="width:70px;"> uses_by_humans</td>
                                 <td>:</td>
                               <!-- <td><? echo $data['size_description']; ?></td>-->

                            </tr>
                             <tr>
                                <td style="width:90px;"> special_notes_on_the_species</td>
                                 <td>:</td>
                               <!-- <td><? echo $data['size_description']; ?></td>-->

                            </tr>
                             <tr>
                                <td style="width:70px;"> list_of_references</td>
                                 <td>:</td>
                               <!-- <td><? echo $data['size_description']; ?></td>-->

                            </tr>
                          
                            
                        </table>
                            </div>

                            
                         </div>
                     <div class="clearBoth"></div>    
                    </div>
                   
                    
                    
               
            
            
                
              

          <?  }
	?>
	</ul>
    </div> 	
                        
                </div>  
                <div id="fadeOne" class="black_overlayOne"></div>
                
            </div><!--  end main  -->
         </div><!--  end body_top  -->
    </div>
 
    <!--  end body_content  -->
   
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->
    
</body>
</html>

