<?php
/*
 *Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * seedaddtreeMay18.php. All the tree information will be read from seedtrees.xml file.

 * status : no problem Working fine.
 * and open the template in the editor.
 */

//list($species_name1,$especies_id1)=mysql_fetch_row(mysql_query("SELECT species_primary_common_name, species_id from species_master where species_id in (SELECT species_id from trees WHERE tree_Id='$treeIDAr[$j]')"));
$autofilldata = array("1234","1234");
$autofilldata[] = array( "0-1161"=>"Plavu",
 "1-1054"=>"Elengi",
 "2-1058"=>"Katampu",
 "3-1079"=>"Njaval",
 "4-1036"=>"Atti" ,
 "5-1041"=>"Aaval",
 "6-1045"=>"Manimaruthu","7-1063"=>"Nelli", "8-1037"=>"Arayal","9-1090"=>"Maavu", 
 "10-1040"=>"Kumbil",
 "11-1047"=>"Vatta",
 "12-1008"=>"Paala",
 "13-1048"=>"Ilippa",
 "14-1082"=>"Thekku",
 "15-1012","Mandaram",
 "16-1034"=>"Mullumurikku",
 "17-1002"=>"Koovalam", 
 "18-1020"=>"Kanikonna",
 "19-1066"=>"Ungu",
 "20-1074"=>"Ashokam",
 "21-1081"=>"Puli",
 "21-1030"=>"Gulmohur",
 "23-1162"=>"Rain tree",
 "24-1015"=>"Mulilavu"
		);

$j=$i;

?>

<?
$q1="SELECT tree_nickname, members_assigned,location_type, tree_height, tree_girth, tree_damage, 
                    is_fertilised, is_watered, distance_from_water, degree_of_slope, aspect, other_notes, species_id
                    FROM trees, tree_measurement, user_tree_table 
                    WHERE trees.tree_Id=tree_measurement.tree_Id AND tree_measurement.user_id='$_SESSION[userid]'
                    AND trees.tree_Id=user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]'
                    AND trees.tree_Id='$treeIDAr[$j]'";
                list($tree_nickname11, $members_assigned1,$location_type1, $tree_height1, $tree_girth1, $tree_damage1, $is_fertilised1, $is_watered1, $distance_from_water1, $degree_of_slope1, $aspect1, $other_notes1, $species_id1) =mysql_fetch_row($dbc->readtabledata($q1));
                list($species_name1,$especies_id1)=mysql_fetch_row($dbc->readtabledata("SELECT species_primary_common_name, species_id from species_master where species_id in (SELECT species_id from trees WHERE tree_Id='$treeIDAr[$j]')")); 
                                
                
                $gettreename="select user_tree_id ,tree_nickname from user_tree_table where tree_id ='$treeIDAr[$j]'";
                list($user_tree_id1,$tree_nickname1)=mysql_fetch_row($dbc->readtabledata($gettreename));
                //$tree_nickname
                
                list($file_name1,$path_name1)= mysql_fetch_row($dbc->readtabledata("SELECT file_name,path_name FROM species_images where species_id='$especies_id1'"));
                $imagesource1 = $path_name1.$file_name1;


                
                $treeindexsubindex = array('0'=>'1161',
 '1'=>'1054',
 '2'=>'1058',
 '3'=>'1079',
 '4'=>'1036',
 '5'=>'1041',
 '6'=>'1045',
 '7'=>'1063',
 '8'=>'1037',
 '9'=>'1090',
 '10'=>'1040',
 '11'=>'1047',
 '12'=>'1008',
 '13'=>'1048',
 '14'=>'1082',
 '15'=>'1012',
 '16'=>'1034',
 '17'=>'1002',
 '18'=>'1020',
 '19'=>'1066',
 '20'=>'1074',
 '21'=>'1081',
 '22'=>'1030',
 '23'=>'1162',
 '24'=>'1015');
                
                $indexsub = array_search($especies_id1, $treeindexsubindex);
                
              ?>

<script>
$(function() {
$('div.addTreeContainer<?php echo $j?>').hide();

var index=parseInt(<?echo $indexsub;?>);
//alert(index);
var speciesid=parseInt(<?echo $especies_id1;?>);

var selindex=  index+"-"+speciesid;

$("#autotag<?echo $j?>").val(selindex);

 var subindex;var mainIndex;
$('div.addTreeContainer<?php echo $j?>').hide();
$('ul.addtreeList<?php echo $j?> li ul').slideUp('fast');
$('ul.addtreeList<?php echo $j?> li ul li blockquote').removeClass('selected_2');
$('ul.addtreeList<?php echo $j?> li span').removeClass('selected');
if (index<=7)
{   subindex=0;
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
    $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+index+')').addClass('selected_2');
}

if(index>7 && (index<=14))
{   subindex=1;
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
    $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+index+')').addClass('selected_2');
}
if(index>14 && (index<=18))
{   subindex=2;
    mainIndex=parseInt(index)+1;
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
    $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
}

if(index>18 && (index<=23))
{ 
    subindex=3;
    mainIndex=parseInt(index)+6;
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
    $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
}

if(index>23 && (index<=25))
{
    subindex=4;
    mainIndex=parseInt(index)+4;
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
    $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
}

$('.addTreeContainerHolder<?php echo $j?> > div:eq('+index+')').show();//working
document.getElementById('selspecies_id<?echo $j?>').value=<?php echo $especies_id1;?>;
document.getElementById('selspecies_name<?echo $j?>').value="<?php echo $species_name1;?>";
});


function seltreespecies<?echo $j?>(speciesvalue) 
{
    
    //alert(speciesvalue);
    $("#autotag<?echo $j?>").val( speciesvalue);
    var sp= jQuery('#autotag<?echo $j?> option:selected').text();
      var strvalue=speciesvalue;
    var dtCh= "-";
    var pos1=strvalue.indexOf(dtCh);
    var index=parseInt(strvalue.substring(0,pos1));//year
    var speciesid=parseInt(strvalue.substring(pos1+1,strvalue.length));
    //alert(speciesid);
    var subindex;var mainIndex;
    $('div.addTreeContainer<?php echo $j?>').hide();
    $('ul.addtreeList<?php echo $j?> li ul').slideUp('fast');
    $('ul.addtreeList<?php echo $j?> li ul li blockquote').removeClass('selected_2');
    $('ul.addtreeList<?php echo $j?> li span').removeClass('selected');
    
     if (index<=7)
    {   subindex=0;
        $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
        $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
        $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+index+')').addClass('selected_2');
    }

    if((index>7) && (index<=14))
    {   subindex=1;
         mainIndex=parseInt(index)+1;
        $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
        $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
        $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
    }
    if(index>14 && (index<=18))
    { 
        subindex=2;
        mainIndex=parseInt(index)+1;
        $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
        $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
        $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
    }

    if(index>18 && (index<=23))
    { 
        subindex=3;
        mainIndex=parseInt(index)+6;
        $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
        $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
        $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
    }

    if(index>23 && (index<=24))
    {
        subindex=4;
        mainIndex=parseInt(index)+8;
        $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
        $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
        $('ul.addtreeList<?php echo $j?> li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
    }


    $('.addTreeContainerHolder<?php echo $j?> > div:eq('+index+')').show();//working
    document.getElementById('selspecies_id<?echo $j?>').value=speciesid;
    document.getElementById('selspecies_name<?echo $j?>').value=sp;
    //document.getElementById('eindex<?echo $j?>').value=index;
}

function changeindex<?echo $j?>(subindex)
{
   
    $('ul.addtreeList<?php echo $j?> li ul').slideUp('fast');
    $('ul.addtreeList<?php echo $j?> li span').removeClass('selected');
    $('ul.addtreeList<?php echo $j?> li ul li blockquote').removeClass('selected_2');
    $('div.addTreeContainer<?php echo $j?>').hide();
    $('ul.addtreeList<?php echo $j?> li ul:eq('+subindex+')').slideDown('fast'); //main green strap
    $('ul.addtreeList<?php echo $j?> > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
      
}		
</script>

<style type="text/css">

ul.addtreeList<?php echo $j?> {
	float:left;
	width:140px;
	position:relative;
}
ul.addtreeList<?php echo $j?> li {
	float:left;
	width:140px;
}
ul.addtreeList<?php echo $j?> li a {
	float:left;
	width:140px;  /*103px;*/
	/*background:transparent url(../images/add_tree_nav_bg.jpg) 0 0 repeat-x;*/
	border-bottom:solid 1px #cccccc;
	border-right:solid 1px #cccccc;
	text-align:right;
}
ul.addtreeList<?php echo $j?> li a img {
	float:none;
	margin:0 0 0 0;
	position: relative;
}
ul.addtreeList<?php echo $j?> li span {
	position:absolute;
	float:left;
	width:34px;
	height:73px;
	z-index:999;
	margin-left:-42px;
}
ul.addtreeList<?php echo $j?> li span.selected {
	/*background:transparent url(../images/add_tree_nav_hover_bg.png) right -1px no-repeat;*/
	 border-right: 7px solid #ae4f36;
}
ul.addtreeList<?php echo $j?> li ul {
	position:absolute;
	left:104px;
	top:0px;
	width:117px;
	height:103%;
	background-color:#fff;
	border-right:1px solid #b8b5b5;
	z-index:998;
	padding:0px 0 0 20px;
	display:none;
}
ul.addtreeList<?php echo $j?> li ul li {
	float:left;
	width:130px;
	padding:0 0 0px 0;
	text-transform:lowercase;
	margin:0px 0 0 -10px;
	line-height:41px;
}
ul.addtreeList<?php echo $j?> li ul li a:first-letter{
	text-transform: uppercase;
}
ul.addtreeList<?php echo $j?> li ul li a {
	background:none;
	border-bottom:none;
	border-right:none;
	padding:0 12px 3px 10px;
	margin:0px;
	text-align:left;
	width:78px !important;
}

ul.addtreeList<?php echo $j?> li ul li:hover {
	background:#ededed;
	display:block;
	width:125px;
}


ul.addtreeList<?php echo $j?> li ul li blockquote{
	margin:0px;
	padding:0px;
	position:absolute;
	left:0px;
	float:left;
	width:131px;
	height:44px;
	z-index:-999;
	
}
ul.addtreeList<?php echo $j?> li ul li blockquote.selected_2 {
	/*background:transparent url(../images/add_tree_subnav_hover_bg.png) right -1px no-repeat;*/
	border-right:7px solid #ae4f36;
	background-color:#ededed;
}

.addTreeContainerHolder<?php echo $j?> {
	float:left;
	width:500px;
	margin-left:120px;
}
.addTreeContainerHolder<?php echo $j?> div.addTreeContainer {
	float:left;
	color:#000;
	/*width:650px;*/
	display:none;
}

.addTreeContainer<?php echo $j?> p{
	margin:0px 10px 0 0;
	padding:0px;
	font-size:12px;
	line-height:18px;
}

.addTreeContainer<?php echo $j?> h2{
	margin:10px 0 0 0 !important;
	padding:0px;
	font-size:18px;
	font-weight:bold;
}

.addTreeContainer<?php echo $j?> h3{
	margin:10px 0 30px 0 !important;
	padding:0px;
	font-size:13px;
	font-family:Georgia, "Times New Roman", Times, serif;
	font-style:italic;
	font-weight:normal;
}

.addTreeContainer<?php echo $j?> blockquote{
	margin:0px 10px 45px 0;
	padding:0px;
	float:left;
}

.addTreeContainer_bottom_area{
	margin:18px 0px 0px 0px;
	padding:0px;
	float:left;
}

.nav li a{

width:120px;
text-align:center;
}

</style>

    <a href = "javascript:void(0)" onclick = "document.getElementById('lightSix<?php echo $j?>').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeone.png" alt="close" id="treeclose1"/></a> 
    <form name="edit_tree" id="edit_tree<?echo $i;?>" method="POST" action="edittree.php" onSubmit="return EditTree(<?echo $j?>);">
    <div class="DashBosrdcontainer_add_tree_lightbox">
    <div class="container_nav">
    <h2>Edit Tree <?echo ucfirst(strtolower(htmlspecialchars($tree_nickname11))); ?></h2>
    <div class="nav_bg">
        <ul class="nav">
        <li ><a href="javascript:void(0)" onclick="EnableChoosetreeed<?echo $j?>()" class="cur" id="edtreesel<?echo $j?>">Edit Tree<div class=""></div></a></li>
        <li ><a href="javascript:void(0)"  onclick="EnableLocationed<?echo $j?>()" id="edlocation<?echo $j?>">Edit Location<div class=""></div></a></li>
        <li ><a href="javascript:void(0)" onclick="EnableDetailsed<?echo $j?>()"  class="last" id="eddetails<?echo $j?>">Edit Details</a></li>
        </ul>
    </div>
       
        <script type="text/javascript">
        function EnableChoosetreeed<?echo $j?>()
        {
            $('.nav li a').removeClass('cur'); 
            document.getElementById('edtreesel<?echo $j?>').className='cur';
            document.getElementById('edlocation<?echo $j?>').className='';
            document.getElementById('eddetails<?echo $j?>').className='';
            document.getElementById('TBOX<?echo $j?>').style.display='block';
            document.getElementById('autotag<?echo $j?>').style.display='block';
            document.getElementById('boxDO<?echo $j?>').style.display='none';
            document.getElementById('mapBox<?echo $j?>').style.display='none';
            document.getElementById('pick<?echo $j?>').style.display='block';
            document.getElementById('button_area_ok<?echo $j?>').style.display='none';
            document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
            document.getElementById('button_area_details<?echo $j?>').style.display='none';

            document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
            document.getElementById('button_area_next<?echo $j?>').style.display='none';
            document.getElementById('button_details_prev<?echo $j?>').style.display='none';
            document.getElementById('button_loc_next<?echo $j?>').style.display='block';
        }
        function EnableLocationed<?echo $j?>()
        {
            //var selTree = $("#selspecies_id").val();
            var selTree = $("#autotag<?echo $j?>").val();
            if (selTree=='')
            {
                alert("Please select the Tree species from choose Tree.");
                $('.nav li a').removeClass('cur');
                document.getElementById('edtreesel<?echo $j?>').className='cur';
                document.getElementById('edlocation<?echo $j?>').className='';
                document.getElementById('eddetails<?echo $j?>').className='';
                document.getElementById('TBOX<?echo $j?>').style.display='block';
                document.getElementById('autotag<?echo $j?>').style.display='block';
                document.getElementById('boxDO<?echo $j?>').style.display='none';
                document.getElementById('mapBox<?echo $j?>').style.display='none';
                document.getElementById('pick<?echo $j?>').style.display='block';
                //document.getElementById('pickone').style.display='block';
                document.getElementById('button_area_ok<?echo $j?>').style.display='none';
                document.getElementById('button_area_loc<?echo $j?>').style.display='none';
                document.getElementById('button_area_details<?echo $j?>').style.display='none';
                document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
                document.getElementById('button_area_next<?echo $j?>').style.display='none';
                document.getElementById('button_details_prev<?echo $j?>').style.display='none';
                document.getElementById('button_loc_next<?echo $j?>').style.display='block';
                return false;
            }
            else
            {
                $('.nav li a').removeClass('cur');  
                document.getElementById('edlocation<?echo $j?>').className='cur';
                document.getElementById('edtreesel<?echo $j?>').className='';
                document.getElementById('eddetails<?echo $j?>').className='';             
                document.getElementById('TBOX<?echo $j?>').style.display='none';
                document.getElementById('autotag<?echo $j?>').style.display='none';
                document.getElementById('boxDO<?echo $j?>').style.display='none';
                document.getElementById('mapBox<?echo $j?>').style.display='block';
                document.getElementById('pick<?echo $j?>').style.display='none';
                //  document.getElementById('pickone').style.display='none';
                document.getElementById('button_area_ok<?echo $j?>').style.display='none'; 
                document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
                document.getElementById('button_area_details<?echo $j?>').style.display='none';
                document.getElementById('button_loc_prev<?echo $j?>').style.display='block';
                document.getElementById('button_area_next<?echo $j?>').style.display='block';
                document.getElementById('button_details_prev<?echo $j?>').style.display='none';
                document.getElementById('button_loc_next<?echo $j?>').style.display='none';
            }
        }
         function EnableDetailsed<?echo $j?>()
        {
             //var selTree = $("#selspecies_id").val();
             var selTree = $("#autotag<?echo $j?>").val();
             if (selTree=='')
             {  
            	 alert("Please select the Tree species from choose Tree.");
                 EnableChoosetree<?echo $j?>();
                 return false;
             }
            else
            {

         	   //	AddLocation();
                var locname = $("#loc_name<?echo $j?>").val();
                var loctype = $("#location_type<?echo $j?>").val(); 
                var locstate =  $("#state<?echo $j?>").val();
                var loccity =$("#city<?echo $j?>").val();
                var loclat =$("#lat<?echo $j?>").val();
                var loclong =$("#lng<?echo $j?>").val();
                var loctype=$("#location_type<?echo $j?>").val();
            
                if (loclat!='')
                 {
                     if (locstate==''|loccity=='' |locname=='' |loctype=='')
                     {
                         alert("Please select the state and other valuess.");
                         return false;
                     }

                     
                     var zoom_get = $('#zoom<?echo $j?>').val();
                     
                    if(zoom_get < 15 ) 
                    {
                        alert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
                      //  return false;
                    }
                 }
                 
                    document.getElementById('locid<?echo $j?>').value=$("#locationid<?php echo $j?>").val();          
                     document.getElementById('loclat<?echo $j?>').value=loclat;
                     document.getElementById('loclon<?echo $j?>').value=loclong;
                     document.getElementById('loccity<?echo $j?>').value=loccity;
                     document.getElementById('locname<?echo $j?>').value=locname;
                     document.getElementById('zoomval<?echo $j?>').value=zoom_get;
                     document.getElementById('elocation_type<?echo $j?>').value=loctype;    

                    $('.nav li a').removeClass('cur');
                    document.getElementById('edlocation<?echo $j?>').className='';
                    document.getElementById('edtreesel<?echo $j?>').className='';
                    document.getElementById('eddetails<?echo $j?>').className='cur';
                    document.getElementById('TBOX<?echo $j?>').style.display='none';
                    document.getElementById('autotag<?echo $j?>').style.display='none';
                    document.getElementById('boxDO<?echo $j?>').style.display='block';
                    document.getElementById('mapBox<?echo $j?>').style.display='none';
                    document.getElementById('pick<?echo $j?>').style.display='none';
                    //          document.getElementById('pickone').style.display='none';
                    document.getElementById('boxDO<?echo $j?>').style.border='none';
                    document.getElementById('button_area_ok<?echo $j?>').style.display='block';
                    document.getElementById('button_area_details<?echo $j?>').style.display='none';
                    document.getElementById('button_area_loc<?echo $j?>').style.display='none'; 
                    document.getElementById('button_details_prev<?echo $j?>').style.display='block';
                    document.getElementById('button_loc_prev<?echo $j?>').style.display='none';
                    document.getElementById('button_area_next<?echo $j?>').style.display='none';
                    document.getElementById('button_loc_next<?echo $j?>').style.display='none'; 
              }
        }
        </script>
    </div>
    
    <h3 id="pick<?echo $j?>">Name of tree:<br />
              <select  id="autotag<?echo $j?>" name="autotag<?echo $j?>"  onChange='seltreespecies<?echo $j?>(this.value)' class="cmnameField">
                <option  value="0" >Select species type</option>
                <option value="0-1161" >Jackfruit</option>
                <option value="1-1054" >Elengi </option>
                <option value="2-1058" >Katampu</option>
                <option value="3-1079" >Njaval</option>
                <option value="4-1036" >Atti</option>
                <option value="5-1041" >Aaval</option>
                <option value="6-1045" >Manimaruthu</option>
                <option value="7-1063" >Nelli</option>
                <option value="8-1037" >Arayal</option>
                <option value="9-1090" >Maavu</option>
                <option value="10-1040" >Kumbil</option>
                <option value="11-1047" >Vatta</option>
                <option value="12-1008" >Paala</option>
                <option value="13-1048" >Ilippa</option>
                <option value="14-1082" >Thekku</option>
                <option value="15-1012" >Mandaram</option>
                <option value="16-1034" >Mullumurikku</option>
                <option value="17-1002" >Koovalam</option>
                <option value="18-1020" >Kanikonna</option>
                <option value="19-1066" >Ungu</option>
                <option value="20-1074" >Ashokam</option>
                <option value="21-1081" >Puli</option>
                <option value="22-1030" >Gulmohur</option>
                <option value="23-1162" >Rain tree</option>
                 <option value="24-1015" >MULILAVU</option>
              </select>
    </h3>
    <input type="hidden" id="seltreeid<?php echo $j;?>" value="<? echo $treeIDAr[$j]; ?>" />
    <div class="clearBoth"></div>
<!-- start Tree_box-->
    <div id="TBOX<?echo $j?>" class="tree_box">
        <div style="float:left" > <!--This is the first division of left-->
        <div id="firstpane" class="firstpane"> <!--Code for menu starts here-->
        <ul class="addtreeList<?php echo $j?>" id="addtreeList<?php echo $j?>">
         <li id="sub1<?echo $j?>" class="sub1"><a href="#" class="selected" onmouseover="simmid.src='images/Simple-middle-selected.png'" onmouseout="simmid.src='images/Simple-middle.png'" onclick= "changeindex<?echo $j?>(0)"><img src="images/Simple-middle.png" alt=" " name="simmid" width="103" height="73" /></a><span ></span>
                    <ul >
                        <li value="1161" class="selected_2 slected"><a href="#" id="sub_1_1<?echo $j?>" onClick="seltreespecies<?echo $j?>('0-1161')">JACKFRUIT</a> <blockquote></blockquote></li>
                        <li value="1054"><a href="#" id="sub_1_2<?echo $j?>" onClick="seltreespecies<?echo $j?>('1-1054')">Elengi</a> <blockquote></blockquote></li>
                        <li value="1058"><a href="#" id="sub_1_3<?echo $j?>" onClick="seltreespecies<?echo $j?>('2-1058')">Katampu</a> <blockquote></blockquote></li>
                        <li value="1079"><a href="#" id="sub_1_4<?echo $j?>" onClick="seltreespecies<?echo $j?>('3-1079')">Njaval</a> <blockquote></blockquote></li>
                        <li value="1036"><a href="#" id="sub_1_5<?echo $j?>" onClick="seltreespecies<?echo $j?>('4-1036')">Atti</a> <blockquote></blockquote></li>
                        <li value="1041"><a href="#" id="sub_1_6<?echo $j?>" onClick="seltreespecies<?echo $j?>('5-1041')">Aaval</a> <blockquote></blockquote></li>
                        <li value="1045"><a href="#" id="sub_1_7<?echo $j?>" onClick="seltreespecies<?echo $j?>('6-1045')">Manimaruthu</a> <blockquote></blockquote></li>
                        <li value="1063"><a href="#" id="sub_1_8<?echo $j?>" onClick="seltreespecies<?echo $j?>('7-1063')">Nelli</a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub2<?echo $j?>" class="sub2"><a href="#" class="selected"onmouseover="simba.src='images/Simple-base-apex-selected.png'" onmouseout="simba.src='images/Simple-base-apex.png'" onclick= "changeindex<?echo $j?>(1)"><img src="images/Simple-base-apex.png" alt=" " name="simba" width="103" height="73" /></a><span></span>
                    <ul >
                        <li value="1037"><a href="#" id="sub_2_1<?echo $j?>" onClick="seltreespecies<?echo $j?>('8-1037')">Arayal</a> <blockquote></blockquote></li>
                        <li value="1090"><a href="#" id="sub_2_2<?echo $j?>" onClick="seltreespecies<?echo $j?>('9-1090')">Maavu</a> <blockquote></blockquote></li>
                        <li value="1040"><a href="#" id="sub_2_3<?echo $j?>" onClick="seltreespecies<?echo $j?>('10-1040')">Kumbil</a> <blockquote></blockquote></li>
                        <li value="1047"><a href="#" id="sub_2_4<?echo $j?>" onClick="seltreespecies<?echo $j?>('11-1047')">Vatta</a> <blockquote></blockquote></li>
                        <li value="1008"><a href="#" id="sub_2_5<?echo $j?>" onClick="seltreespecies<?echo $j?>('12-1008')" >Paala</a> <blockquote></blockquote></li>
                        <li value="1048"><a href="#" id="sub_2_6<?echo $j?>" onClick="seltreespecies<?echo $j?>('13-1048')">Ilippa</a> <blockquote></blockquote></li>
                        <li value="1082"><a href="#" id="sub_2_7<?echo $j?>" onClick="seltreespecies<?echo $j?>('14-1082')">Thekku</a> <blockquote></blockquote></li>
                        <li><a href="tree_2_8<?echo $j?>"></a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub3<?echo $j?>"><a href="#" onmouseover="comp23.src='images/Compound-2or3leaflets-selected.png'" onmouseout="comp23.src='images/Compound-2or3leaflets.png'" onclick= "changeindex<?echo $j?>(2)"><img src="images/Compound-2or3leaflets.png" alt=" " name="comp23" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1012"><a href="#" id="sub_3_1<?echo $j?>" onClick="seltreespecies<?echo $j?>('15-1012')">Mandaram</a><blockquote></blockquote></li>
                        <li value="1034"><a href="#"  id="sub_3_2<?echo $j?>" onClick="seltreespecies<?echo $j?>('16-1034')">Mullumurikku</a><blockquote></blockquote></li>
                        <li value="1002"><a href="#"  id="sub_3_3<?echo $j?>" onClick="seltreespecies<?echo $j?>('17-1002')">Koovalam</a><blockquote></blockquote></li>
                        <li><a href="tree_3_4<?echo $j?>" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_5<?echo $j?>" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_6<?echo $j?>" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_7<?echo $j?>" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_8<?echo $j?>" ></a><blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub4<?echo $j?>"> <a href="#" onmouseover="comppinn.src='images/Compound-pinnate-selected.png'" onmouseout="comppinn.src='images/Compound-pinnate.png'" onclick= "changeindex<?echo $j?>(3)"><img src="images/Compound-pinnate.png" alt=" " name="comppinn" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1020"><a href="#" id="sub_4_1<?echo $j?>" onClick="seltreespecies<?echo $j?>('18-1020')" class="selected">Kanikonna</a><blockquote></blockquote></li>
                        <li value="1066"><a href="#" id="sub_4_2<?echo $j?>" onClick="seltreespecies<?echo $j?>('19-1066')">Ungu</a><blockquote></blockquote><li>
                        <li value="1074"><a href="#" id="sub_4_3<?echo $j?>" onClick="seltreespecies<?echo $j?>('20-1074')">Ashokam</a><blockquote></blockquote></li>
                        <li value="1081"><a href="#" id="sub_4_4<?echo $j?>" onClick="seltreespecies<?echo $j?>('21-1081')">Puli</a><blockquote></blockquote></li>
                        <li value="1030"><a href="#" id="sub_4_5<?echo $j?>" onClick="seltreespecies<?echo $j?>('22-1030')">GULMOHUR</a><blockquote></blockquote></li>
                        <li value="1162"><a href="#" id="sub_4_6<?echo $j?>" onClick="seltreespecies<?echo $j?>('23-1162')">Rain tree</a><blockquote></blockquote></li>
                        <li ><a href="#" id="sub_4_7<?echo $j?>"> </a></li>
                        <li><a href="#" id="sub_4_8<?echo $j?>" ></a></li>
                    </ul>
                </li>
                <li id="sub5<?echo $j?>"> <a href="#" onmouseover="comppalm.src='images/Compound-palmate-selected.png'" onmouseout="comppalm.src='images/Compound-palmate.png'" onclick= "changeindex<?echo $j?>(4)"><img src="images/Compound-palmate.png" alt=" " name="comppalm" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1015"><a href="#" id="sub_5_1<?echo $j?>" onClick="seltreespecies<?echo $j?>('24-1015')" class="selected">Mulilavu</a></li>
                        <li><a href="tree_5_2<?echo $j?>" id="sub_5_2<?echo $j?>"></a></li>
                        <li><a href="tree_5_3<?echo $j?>" id="sub_5_3<?echo $j?>"></a></li>
                        <li><a href="tree_5_4<?echo $j?>" id="sub_5_4<?echo $j?>"></a></li>
                        <li><a href="tree_5_5<?echo $j?>" id="sub_5_5<?echo $j?>"></a></li>
                        <li><a href="tree_5_6<?echo $j?>" id="sub_5_6<?echo $j?>"></a></li>
                        <li><a href="tree_5_7<?echo $j?>" id="sub_5_7<?echo $j?>"></a></li>
                        <li><a href="tree_5_8<?echo $j?>" id="sub_5_8<?echo $j?>"></a></li>
                    </ul>
                </li>
        </ul>      
        
        <div class="addTreeContainerHolder<?php echo $j?>">
          <?// read xml file and update the all tree info-->
            $xml = simplexml_load_file("seedtrees.xml")  or die("Error: Cannot create object");
            foreach($xml->children() as $Trees){
             ?>
           
            <div id="<?echo $Trees->attributes();?><?echo $j?>" class="addTreeContainer<?php echo $j?>">
                <blockquote><img src="<?echo $Trees->Imagename?>" alt="<?echo $Trees->sciencename;?>" title="<?echo $Trees->sciencename;?>"  width="179" height="221" /></blockquote>
                <br>
                    <h2><?echo $Trees->sciencename;?></h2>
                    <br>
                    <h3>M: <?echo $Trees->malayamname;?>, E: <?echo $Trees->englishname;?>, Ta: <?echo $Trees->tamilname?>, H: <?echo $Trees->hindiname?></h3>
                        <p><?echo $Trees->Info;?></p>
                        <div class="clearBoth"></div>
                        <div class="addTreeContainer_bottom_area">
                            <div class="leaf_box">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="70"><b>Leaf</b></td><td></td>
                                    </tr>
                                    <tr>
                                        <td>Fresh</td>
                                        <td><?echo $Trees->Fresh;?></td>
                                     </tr>
                                    <tr>
                                    <td>Mature</td>
                                    <td><?echo $Trees->Mature;?></td>
                                    </tr>
                                    <tr>
                                    <td>Size</td>
                                    <td><?echo $Trees->Size;?></td>
                                    </tr>
                                    <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    </tr>
                                </table>
                        </div>
                        <div class="flower_box">
                            <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                            <td width="60"><b>Flower</b></td>
                            <td></td>
                            </tr>

                            <tr>
                            <td>Bud</td>
                            <td><?echo $Trees->Bud;?></td>
                            </tr>
                            <tr>
                            <td>Open</td>
                            <td><?echo $Trees->Open;?></td>
                            </tr>
                            <tr>
                            <td>Size</td>
                            <td><?echo $Trees->Size;?></td>
                            </tr>

                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            </tr>
                            </table>
                        </div>

                        <div class="fruit_box">
                                <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                <td width="60"><b>Fruit</b></td>
                                <td></td>
                                </tr>

                                <tr>
                                <td>Unripe</td>
                                <td><?echo $Trees->Unripe;?></td>
                                </tr>
                                <tr>
                                <td>Ripe</td>
                                <td><?echo $Trees->Ripe;?></td>
                                </tr>
                                <tr>
                                <td>Shape</td>
                                <td><?echo $Trees->Shape;?></td>
                                </tr>

                                <tr>
                                <td>Size</td>
                                <td><?echo $Trees->Size;?></td>
                                </tr>

                            </table>
                        </div>

                </div>
        </div> <!-- Tree1_1 ending-->
         <?}?>

</div>  <!--Code for menu ends here-->
                                        </div>
                                    </div>
                                    
                                    </div>
        </div>
                            	
 <div class="clearBoth"></div>

<div style="border:0px solid #000;display:none;" id="mapBox<?echo $j?>">
    <?include("edittree_step.php"); ?>  
</div>

<div class="clearBoth"></div>
   
<div id="boxDO<?echo $j?>" style="border:0px solid #000; display:none;">
   <div class="DashBosrdcontainer_add_tree_lightbox">
      <div class="leftBox_ONE">
             Fields marked with * are compulsory. <br />
            <p>
                <label>Species Type* </label>
  
            <input name="selspecies_name<?echo $j?>" type="text" value="<?php echo $species_name1;?>" id="selspecies_name<?echo $j?>" readonly="readonly" title="select the species type from choose tree."/></p>
            <input type="hidden" id="selspecies_id<?echo $j?>" name="selspecies_id<?echo $j?>" value="<? echo htmlspecialchars($species_id1); ?>" /> 
            <p><label>Latitude</label><input type=text id="loclat<?echo $j?>"  name="loclat<?echo $j?>" value=""  DISABLED style="background-color:#fff;"/></p>
            <p><label>Longitude</label><input type=text id="loclon<?echo $j?>"  name="loclon<?echo $j?>" value="" DISABLED/></p>
            <p><label>City</label><input type=text id="loccity<?echo $j?>"  name="loccity<?echo $j?>" value="" DISABLED/></p>
            <p><label>Location name</label><input type=text id="locname<?echo $j?>"  name="locname<?echo $j?>" value="" DISABLED/></p>
            <input type="hidden" id="zoomval<?php echo $j?>" name="zoomval<?php echo $j?>" value=""/>
            <input type="hidden" name="locid<?echo $j?>"  id ="locid<?echo $j?>" value="" />
           <p>
           <p>
            <label title="Please give all your trees a unique nickname. This will help you distinguish your individual trees">Nickname*</label>
            <input name="" type="text" value="<?echo htmlspecialchars($tree_nickname1)?>" id="etree_nickname<?echo $j?>" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" />
            </p>
            <?php
                    $sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                    echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
                    while($row=mysql_fetch_array($sql))
                    {
                    echo "<option>".$row['tree_nickname']."</option>";
                    }
                    echo "</select>";
                    ?>
           
                       <p>
            <label title="Please select the location">Location Type</label>
             <input name="elocation_type<?echo $j?>" type="text" id="elocation_type<?echo $j?>" value="" disabled title="select the location type from Addlocation."/>
             </p>        
                       
            <p>
            <label title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">Height (in m)</label>
            <input id="etree_height<?echo $j?>" type="text" value="<? echo htmlspecialchars($tree_height1); ?>" title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)."/>
            </p>
            <p>
            <label title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">
	     Girth (in cm)</label><input id="etree_girth<?echo $j?>" type="text" value="<?echo htmlspecialchars($tree_girth1)?>" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4 m or 4.5 ft from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." />
            </p>
            <p>
            <label title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">Aspect</label>
             <?php
			switch ($aspect1)
			{
			case "":
			$Dont_know="selected";
			break;
			case "North":
			$North="selected";
			break;
			case "NorthEast":
			$NorthEast="selected";
			break;
			case "East":
			$East="selected";
			break;
			case "SouthEast":
			$SouthEast="selected";
			break;
			case "South":
			$South="selected";
			break;
			case "SouthWest":
			$SouthWest="selected";
			break;
			case "West":
			$West="selected";
			break;
			case "NorthWest":
			$NorthWest="selected";
			break;
			}
			?>
             <select id="easpect<?echo $j?>" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">
                                 <option id="Dont know" value="" <? echo $Dont_know; ?>>Choose one</option>
				<option id="North" value="North"<? echo $North; ?>>North</option>
				<option id="NorthEast" value="NorthEast"<? echo $NorthEast; ?>>North-East</option>
				<option id="East" value="East"<? echo $East; ?>>East</option>
				<option id="SouthEast" value="SouthEast"<? echo $SouthEast; ?>>South-East</option>
				<option id="South" value="South"<? echo $South; ?>>South</option>
				<option id="SouthWest" value="SouthWest"<? echo $SouthWest; ?>>South-West</option>
				<option id="West" value="West"<? echo $West; ?>>West</option>
				<option id="NorthWest" value="NorthWest"<? echo $NorthWest; ?>>North-West</option>
					
                            </select>
          
            </p>
 
            <input type='hidden' name='cmd' value='edit_tree'>
        <br />
    </div>

    <div class="Right_BOX">
    <p></p>
    <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest water source(in m)</label>
             <input id="edistance_from_water<?echo $j?>" type="text" value="<?echo htmlspecialchars($distance_from_water1);?>" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
            <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Slope</label>
             <input id="edegree_of_slope<?echo $j?>" type="text" value="<?echo htmlspecialchars($degree_of_slope1);?>" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
    <p>           
            
         <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">Damaged</label>&nbsp;
         <!-- input name="tree_damage" type="radio" value="0" checked="checked" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
         <!-- input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/> Yes-->
         <? if ($tree_damage1=='0'){ ?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" />Yes
                <?}elseif ($tree_damage1=='1'){?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" checked="checked"/>Yes
                <?}else{?>
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="0" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="etree_damage<?echo $j?>" id="etree_damage<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p>
             <p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;
		<!-- input name="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/> Yes-->
		<? if ($is_fertilised1=='0'){ ?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" />Yes
                <?} elseif($is_fertilised1=='1'){?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" checked="checked" />Yes
                <?} else {?>
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_fertilised<?echo $j?>" id="eis_fertilised<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;
		<!-- input name="is_watered" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/> Yes-->
		<? if ($is_watered1=='0'){ ?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0" checked="checked" />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" />Yes
                <?} elseif($is_watered1=='1'){?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" checked="checked" />Yes
                <?} else {?>
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="0"  />No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="eis_watered<?echo $j?>" id="eis_watered<?echo $j?>" type="radio" value="1" />Yes
                <?}?>
            </p><p>
    Notes</p>
    <textarea class="text_box_textarea" id="eother_notes<?echo $j?>"><?php echo $other_notes1;?></textarea><br/>
    <? if ($_SESSION['usercategory']!='individual'){?>
    Assign to students
    <textarea class="text_box_textarea_one" id="studentname<?echo $j?>" title="eg. John,Bala,Seetha"><?php echo $members_assigned1?></textarea><?}?>
    </div>
    </div>
    <div class="clearBoth"></div>
        
        </div>

<div  class="button_area_indiv">
        <div class="button_area" >
        <div class="right_side_button">
        <div class="button_area_ok"  id="button_area_ok<?echo $j?>" style="display:none;">
                 <a href="#" onClick="EditTree(<?php echo $j?>)">Edit Tree</a>
            </div>
            <div class="right_button"  id="button_area_loc<?echo $j?>"style="display:none;" >
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Location</a>
            </div>
            <div class="right_button"  id="button_area_details<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableDetailsed<?echo $j?>()">Details</a>
            </div>
            <div class="right_button"  id="button_loc_next<?echo $j?>" >
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Next</a>
            </div>
                <div class="right_button"  id="button_area_next<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableDetailsed<?echo $j?>()">Next</a>
            </div>
            </div>
            <div class="left_button" id="button_loc_prev<?echo $j?>" style="display:none;" >
                 <a href="#" OnClick="EnableChoosetreeed<?echo $j?>()">Back</a>
            </div>
            <div class="left_button"  id="button_details_prev<?echo $j?>"  style="display:none;">
                 <a href="#" OnClick="EnableLocationed<?echo $j?>()">Back</a>
            </div>
        <div class="button_area_cancel"><a href ="javascript:void(0)" style="display:none;" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none'" id="addtreecancel<?echo $j?>">CANCEL</a></div>
        </div>
        </div>
        </form>



     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->
