<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php
/* Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * The information about the tree wiil be dislayed.
 * Select location 
 * Add details.
 */

?>
<script type="text/javascript">
$(function() {
    var availableTags = [
        {value: '0-1161',label: 'Plavu, Artocarpus heterophyllus'},
        {value: '1-1054',label: 'Elengi, Mimusops elengi'},
        {value: '2-1058',label: 'Katampu, Neolamarckia cadamba'},
        {value: '3-1079',label: 'Njaval, Syzygium cumini'},
        {value: '4-1036',label: 'Atti, Ficus racemosa'},
        {value: '5-1041',label: 'Aaval, Holoptelea integrifolia'},
        {value: '6-1045',label: 'Manimaruthu, Lagerstroemia speciosa'},
        {value: '7-1063',label: 'Nelli, Phyllanthus emblica'},
        {value: '8-1037',label: 'Arayal, Ficus religiosa'},
        {value: '9-1090',label: 'Maavu, Mangifera indica'},
        {value: '10-1040',label: 'Kumbil, Gmelina arborea'},
        {value: '11-1047',label: 'Vatta, Macaranga peltata'},
        {value: '12-1008',label: 'Paala, Alstonia scholaris'},
        {value: '13-1048',label: 'Ilippa, Madhuca longifolia'},
        {value: '14-1082',label: 'Thekku, Tectona grandis'},
        {value: '15-1012',label: 'Mandaram, Bauhinia purpurea'},
        {value: '16-1034',label: 'Mullumurikku, Erythrina indica'},
        {value: '17-1002',label: 'Koovalam, Aegle marmelos'},
        {value: '18-1020',label: 'Kanikonna, Cassia fistula'},
        {value: '19-1066',label: 'Ungu, Pongamia pinnata'},
        {value: '20-1074',label: 'Ashokam, Saraca asoca'},
        {value: '21-1081',label: 'Puli, Tamarindus indica'},
        {value: '22-1030',label: 'Gulmohur, Delonix regia'},
        {value: '23-1162',label: 'Rain tree, Samanea saman'},
        {value: '24-1015',label: 'Mulilavu, Bombax ceiba'}];
    $( "#tags" ).autocomplete({
        source: availableTags,
        focus: function(event, ui) {
            $('#tags').val(ui.item.label);
        return false; },
        select: function(event, ui) {
            $('#tags').val(ui.item.label);
            $('#speciesname_value').val(ui.item.value);
            //split the id into treeid & index;
            var strvalue=ui.item.value;
            var dtCh= "-";
            var pos1=strvalue.indexOf(dtCh);
            var index=parseInt(strvalue.substring(0,pos1));//year
            var speciesid=parseInt(strvalue.substring(pos1+1,strvalue.length));
            var subindex;var mainIndex;
            $('div.addTreeContainer').hide();
            $('ul.addtreeList li ul').slideUp('fast');
            $('ul.addtreeList li ul li blockquote').removeClass('selected_2');
            $('ul.addtreeList li span').removeClass('selected');
            if (index<=7)
            {   subindex=0;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }

            if(index>7 && (index<=14))
            {   subindex=1;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }
            if(index>14 && (index<=17))
            {   
                subindex=2;
                mainIndex=parseInt(index)+1;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>17 && (index<=23))
            { 
               
                subindex=3;
                mainIndex=parseInt(index)+6;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>23 && (index<=25))
            {
                alert(index);    
                subindex=4;
                mainIndex=parseInt(index)+6;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            $('.addTreeContainerHolder > div:eq('+index+')').show();//working
            document.getElementById('selspecies_id').value=speciesid;
            document.getElementById('selspecies_name').value=ui.item.label;
            //var msgaddtree="Is this tree you want to add?"
           // $("#pickmsg").text(msgaddtree);
            return false;
            }
    });
});
</script>
 <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
        $(".nav li a").click(function (){
         $('.nav li a').removeClass('cur');
            $(this).addClass('cur');
          }); 
        function EnableChoosetree()
        {
        document.getElementById('TBOX').style.display='block';
        document.getElementById('tags').style.display='block';
        document.getElementById('boxDO').style.display='none';
        document.getElementById('mapBox').style.display='none';
        document.getElementById('pick').style.display='block';
        document.getElementById('pickone').style.display='block';
        document.getElementById('button_area_ok').style.display='none';
        document.getElementById('button_area_loc').style.display='none'; 
        document.getElementById('button_area_details').style.display='none';
        document.getElementById('button_loc_prev').style.display='none';
        document.getElementById('button_area_next').style.display='none';
        document.getElementById('button_details_prev').style.display='none';
        document.getElementById('button_loc_next').style.display='block';
        document.getElementById('treesel').className='cur';
        document.getElementById('addlocation').className='';
        document.getElementById('adddetails').className='';
        document.getElementById('pickmsg').style.display='none'; 
        $("#pickmsg").text('');
            
            
             
             
        }
        function EnableLocation()
        {
          // alert("Enableloca");
            var selTree = $("#selspecies_id").val();
            if (selTree=='')
            {
           // alert("Please select the Tree species from choose Species.");
            alert("Please choose a tree species first");
            document.getElementById('TBOX').style.display='block';
            document.getElementById('tags').style.display='block';
            document.getElementById('boxDO').style.display='none';
            document.getElementById('mapBox').style.display='none';
            document.getElementById('pick').style.display='block';
            document.getElementById('pickone').style.display='block';
            document.getElementById('button_area_ok').style.display='none';
            document.getElementById('button_area_loc').style.display='none';
            document.getElementById('button_area_details').style.display='none';
            document.getElementById('button_loc_prev').style.display='none';
            document.getElementById('button_area_next').style.display='none';
            document.getElementById('button_details_prev').style.display='none';
            document.getElementById('button_loc_next').style.display='block';
            $('.nav li a').removeClass('cur');
            document.getElementById('treesel').className='cur';
            document.getElementById('addlocation').className='';
            document.getElementById('adddetails').className='';
            document.getElementById('pickmsg').style.display='none'; 
           $("#pickmsg").text('');
           
            return false;
            }
            else
            {
            $('.nav li a').removeClass('cur');
            document.getElementById('addlocation').className='cur';
            document.getElementById('treesel').className='';
            document.getElementById('adddetails').className='';
            document.getElementById('TBOX').style.display='none';
            document.getElementById('tags').style.display='none';
            document.getElementById('boxDO').style.display='none';
            document.getElementById('pick').style.display='none';
            document.getElementById('pickone').style.display='none';
            document.getElementById('button_area_ok').style.display='none'; 
            document.getElementById('button_area_loc').style.display='none'; 
            document.getElementById('button_area_details').style.display='none';
            document.getElementById('mapBox').style.display='block';
            document.getElementById('button_loc_prev').style.display='block';
            document.getElementById('button_area_next').style.display='block';
            document.getElementById('button_details_prev').style.display='none';
            document.getElementById('button_loc_next').style.display='none';
            document.getElementById('pickmsg').style.display='none'; 
           $("#pickmsg").text('');
           

            }
        }
        
         function EnableDetails()
        {
             var selTree = $("#selspecies_id").val();
             if (selTree=='')
             {
                 //alert("Please select the Tree species from choose Species.");
                 alert("Please choose a tree species first");
                 EnableChoosetree();
                 return false;
             }
           else
               {
                  
                 var locname = $("#loc_name").val();
                var loctype = $("#location_type").val(); 
                var locstate =  $("#state").val();
                var loccity =$("#city").val();
                var loclat =$("#lat").val();
                var loclon =$("#lng").val();
                var stateval = $("#state").val();
                 if (loclat=='')
                 {
                     alert("Please complete the location information from 'Add Location' before Adding the details.");
                     EnableLocation();
                     return false;
                     
                 }
                if (loclat!='')
                 {
                    if (locstate==''|loccity=='' |locname=='' |loctype=='')
                    {
                        alert("Please complete the location information from 'Add Location' before Adding the details.");
                        return false;
                    }
                     var zoom_get = $('#zoom').val();
                     
                    if(zoom_get < 15 ) 
                    {
                        alert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
                        return false;
                    }
                 }   
                  
                                 
                 $('.nav li a').removeClass('cur');
                document.getElementById('addlocation').className='';
                document.getElementById('treesel').className='';
                document.getElementById('adddetails').className='cur';
                
                document.getElementById('loclat').value=loclat;
                document.getElementById('loclon').value=loclon;
                document.getElementById('loccity').value=loccity;
                document.getElementById('locname').value=locname;
                document.getElementById('loctype').value=loctype;  
                
                document.getElementById('TBOX').style.display='none';
                document.getElementById('tags').style.display='none';
                document.getElementById('boxDO').style.display='block';
                document.getElementById('mapBox').style.display='none';
                document.getElementById('pick').style.display='none';
                document.getElementById('pickone').style.display='none';
                document.getElementById('boxDO').style.border='none';
                document.getElementById('button_area_ok').style.display='block';
                document.getElementById('button_area_details').style.display='none';
                document.getElementById('button_area_loc').style.display='none'; 
                document.getElementById('button_details_prev').style.display='block';
                document.getElementById('button_loc_prev').style.display='none';
                document.getElementById('button_area_next').style.display='none';
                document.getElementById('button_loc_next').style.display='none';
                document.getElementById('pickmsg').style.display='none'; 
                $("#pickmsg").text('');
                }
        }
       function setspeciesname(speciesID,speciesvalue,cmdid)
        {
         
           document.getElementById('selspecies_id').value=speciesID;
           document.getElementById('selspecies_name').value=speciesvalue;
           document.getElementById('tags').value=speciesvalue;
            var strvalue=cmdid;
            var dtCh= "-";
            var pos1=strvalue.indexOf(dtCh);
            var index=parseInt(cmdid.substring(0,pos1));//year
           
            var speciesid=parseInt(strvalue.substring(pos1+1,strvalue.length));
            var subindex;var mainIndex;
            $('div.addTreeContainer').hide();
            $('ul.addtreeList li ul').slideUp('fast');
            $('ul.addtreeList li ul li blockquote').removeClass('selected_2');
            $('ul.addtreeList li span').removeClass('selected');
            if (index<=7)
            {   subindex=0;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }

            if(index>7 && (index<=14))
            {   subindex=1;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }
            if(index>14 && (index<=17))
            {   
                subindex=2;
                mainIndex=parseInt(index)+1;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>17 && (index<=23))
            { 
               
                subindex=3;
                mainIndex=parseInt(index)+6;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>23 && (index<=25))
            {
                alert(index);    
                subindex=4;
                mainIndex=parseInt(index)+6;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            $('.addTreeContainerHolder > div:eq('+index+')').show();//working
            document.getElementById('selspecies_id').value=speciesID;
            document.getElementById('selspecies_name').value=speciesvalue;
            //document.getElementById('pickmsg').style.display='block';
           // var msgaddtree="Is this tree you want to add?"
           // $("#pickmsg").text(msgaddtree);
           
        }
</script>		
<a href = "javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none';clearseedaddtree();"><img src="images/closeone.png" alt="close" id="seedaddtreeclose"/></a> 
    <div class="DashBosrdcontainer_add_tree_lightbox">
            <div class="container_nav">
    <h2>Add a Tree </h2>
    	<div class="nav_bg">
        <ul class="nav">
        <li ><a href="javascript:void(0)" onclick="EnableChoosetree()" class="cur" id="treesel">Choose Species<div class=""></div></a></li>
        <li ><a href="javascript:void(0)"  onclick="EnableLocation()" id="addlocation" class="mid">Add Location<div class=""></div></a></li>
        <li ><a href="javascript:void(0)" onclick="EnableDetails()"  class="last" id="adddetails">Add Details</a></li>
        </ul>
		</div>
       
    </div>
   <h3 id="pick">Type the Name of the Species you want to add : Eg: Jackfruit <br />
         <input type="text" name="tags" id="tags" value="" onfocus="if(this.value=='')this.value='';"  class="cmnameField"/>
      </h3>
    <div id="pickone">Or pick the leaf type from below:</div>
    <div id="pickmsg" ></div>
<!-- start Tree_box-->
<div id="TBOX" class="tree_box">
    <div style="float:left" > <!--This is the first division of left-->
      <div id="firstpane" class="firstpane"> <!--Code for menu starts here-->
           <ul class="addtreeList">
                <li id="sub1" class="sub1"><a href="#" class="selected" onmouseover="simmid.src='images/Simple-middle-selected.png'" onmouseout="simmid.src='images/Simple-middle.png'"><img src="images/Simple-middle.png" alt=" " name="simmid" width="103" height="73" /></a><span ></span>
                    <ul >
                        <li value="1161" class="selected_2 slected"><a href="tree_1_1" id="sub_1_1" onClick="setspeciesname('1161','Plavu,Artocarpus heterophyllus','0-1161')">Plavu</a> <blockquote></blockquote></li>
                        <li value="1054"><a href="tree_1_2" id="sub_1_2" onClick="setspeciesname('1054','Elengi, Mimusops elengi','1-1054')">Elengi</a> <blockquote></blockquote></li>
                        <li value="1058"><a href="tree_1_3" id="sub_1_3" onClick="setspeciesname('1058','Katampu, Neolamarckia cadamba','2-1058')">Katampu</a> <blockquote></blockquote></li>
                        <li value="1079"><a href="tree_1_4" id="sub_1_4" onClick="setspeciesname('1079','Njaval, Syzygium cumini','3-1079')">Njaval</a> <blockquote></blockquote></li>
                        <li value="1036"><a href="tree_1_5" id="sub_1_5" onClick="setspeciesname('1036','Atti, Ficus racemosa','4-1036')">Atti</a> <blockquote></blockquote></li>
                        <li value="1041"><a href="tree_1_6" id="sub_1_6" onClick="setspeciesname('1041','Aaval, Holoptelea integrifolia','5-1041')">Aaval</a> <blockquote></blockquote></li>
                        <li value="1045"><a href="tree_1_7" id="sub_1_7" onClick="setspeciesname('1045','Manimaruthu, Lagerstroemia speciosa','6-1045')">Manimaruthu</a> <blockquote></blockquote></li>
                        <li value="1063"><a href="tree_1_8" id="sub_1_8" onClick="setspeciesname('1063','Nelli, Phyllanthus emblica','7-1063')">Nelli</a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub2" class="sub2"><a href="#" class="selected"onmouseover="simba.src='images/Simple-base-apex-selected.png'" onmouseout="simba.src='images/Simple-base-apex.png'"><img src="images/Simple-base-apex.png" alt=" " name="simba" width="103" height="73" /></a><span></span>
                    <ul >
                        <li value="1037"><a href="tree_2_1"  id="sub_2_1" onClick="setspeciesname('1037','Arayal, Ficus religiosa','8-1037')">Arayal</a> <blockquote></blockquote></li>
                        <li value="1090"><a href="tree_2_2" id="sub_2_2" onClick="setspeciesname('1090','Maavu, Mangifera indica','9-1090')">Maavu</a> <blockquote></blockquote></li>
                        <li value="1040"><a href="tree_2_3" id="sub_2_3" onClick="setspeciesname('1040','Kumbil, Gmelina arborea','10-1040')">Kumbil</a> <blockquote></blockquote></li>
                        <li value="1047"><a href="tree_2_4" id="sub_2_4" onClick="setspeciesname('1047','Vatta, Macaranga peltata','11-1047')">Vatta/Uppila</a> <blockquote></blockquote></li>
                        <li value="1008"><a href="tree_2_5" id="sub_3_5" onClick="setspeciesname('1008','Paala, Alstonia scholaris','12-1008')" >Paala</a> <blockquote></blockquote></li>
                        <li value="1048"><a href="tree_2_6" id="sub_3_1" onClick="setspeciesname('1048','Ilippa, Madhuca longifolia','13-1048')">Ilippa</a> <blockquote></blockquote></li>
                        <li value="1082"><a href="tree_2_7" id="sub_3_1" onClick="setspeciesname('1082','Thekku, Tectona grandis','14-1082')">Thekku</a> <blockquote></blockquote></li>
                        <li><a href="tree_2_8"></a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub3"><a href="#" onmouseover="comp23.src='images/Compound-2or3leaflets-selected.png'" onmouseout="comp23.src='images/Compound-2or3leaflets.png'"><img src="images/Compound-2or3leaflets.png" alt=" " name="comp23" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1012"><a href="tree_3_1"  id="sub_3_1" onClick="setspeciesname('1012','Mandaram, Bauhinia purpurea','15-1012')">Mandaram</a><blockquote></blockquote></li>
                        <li value="1034"><a href="tree_3_2"  id="sub_3_2" onClick="setspeciesname('1034','Mullumurikku, Erythrina indica','16-1034')">Mullumurikku</a><blockquote></blockquote></li>
                        <li value="1002"><a href="tree_3_3"  id="sub_3_3" onClick="setspeciesname('1002','Koovalam, Aegle marmelos','17-1002')">Koovalam</a><blockquote></blockquote></li>
                        <li><a href="tree_3_4" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_5" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_6" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_7" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_8" ></a><blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub4"> <a href="#" onmouseover="comppinn.src='images/Compound-pinnate-selected.png'" onmouseout="comppinn.src='images/Compound-pinnate.png'"><img src="images/Compound-pinnate.png" alt=" " name="comppinn" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1020"><a href="tree_4_1" id="sub_4_1" onClick="setspeciesname('1020','Kanikonna, Cassia fistula','18-1020')" class="selected">Kanikonna</a><blockquote></blockquote></li>
                        <li value="1066"><a href="tree_4_2" id="sub_4_2" onClick="setspeciesname('1066','Ungu, Pongamia pinnata','19-1066')">Ungu</a><blockquote></blockquote><li>
                        <li value="1074"><a href="tree_4_3" id="sub_4_3" onClick="setspeciesname('1074','Ashokam, Saraca asoca','20-1074')">Ashokam</a><blockquote></blockquote></li>
                        <li value="1081"><a href="tree_4_4" id="sub_4_4" onClick="setspeciesname('1081','Puli, Tamarindus indica','21-1081')">Puli</a><blockquote></blockquote></li>
                        <li value="1030"><a href="tree_4_5" id="sub_4_5" onClick="setspeciesname('1030','Gulmohur, Delonix regia','22-1030')">Gulmohur</a><blockquote></blockquote></li>
                        <li value="1162"><a href="tree_4_6" id="sub_4_6" onClick="setspeciesname('1162','Rain tree,Samanea saman','23-1162')">Rain tree</a><blockquote></blockquote></li>
                        <li><a href="tree_4_7" id="sub_4_7"></a></li>
                        <li><a href="tree_4_8" id="sub_4_8"></a></li>
                    </ul>
                </li>
                <li id="sub5"> <a href="#" onmouseover="comppalm.src='images/Compound-palmate-selected.png'" onmouseout="comppalm.src='images/Compound-palmate.png'"><img src="images/Compound-palmate.png" alt=" " name="comppalm" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1015"><a href="tree_5_1" id="sub_5_1" onClick="setspeciesname('1015','Mulilavu, Bombax ceiba','24-1015')" class="selected">Mullivau</a></li>
                        <li><a href="tree_5_2" id="sub_5_2"></a></li>
                        <li><a href="tree_5_3" id="sub_5_3"></a></li>
                        <li><a href="tree_5_4" id="sub_5_4"></a></li>
                        <li><a href="tree_5_5" id="sub_5_5"></a></li>
                        <li><a href="tree_5_6" id="sub_5_6"></a></li>
                        <li><a href="tree_5_7" id="sub_5_7"></a></li>
                        <li><a href="tree_5_8" id="sub_5_8"></a></li>
                    </ul>
                </li>
            </ul>
            
        <div class="addTreeContainerHolder">
           <?// read xml file and update the all tree info-->
            $xml = simplexml_load_file("seedtrees.xml")  or die("Error: Cannot create object");
            foreach($xml->children() as $Trees){
             ?>
           
            <div id="<?echo $Trees->attributes();?>" class="addTreeContainer">
                <blockquote><img src="<?echo $Trees->Imagename?>" alt="<?echo $Trees->sciencename;?>" title="<?echo $Trees->sciencename;?>"  width="179" height="221" /></blockquote>
                    <h2><?echo $Trees->sciencename;?></h2>
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
                                    <!-- end tree_box -->
                                    
                                    
                                  
         </div>
<div style="border:0px solid #000;display:none;"  id="mapBox">
    <?include("addtree_step.php"); ?>  
</div>
 <div class="clearBoth"></div>     
  <div class="clearBoth"></div>   
<div id="boxDO" style="display:none;">
      <div class="leftBox_ONE">
            Fields marked with * are compulsory. <br />
           <?php
                    $sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                    echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
                    while($row=mysql_fetch_array($sql))
                    {
                    echo "<option>".$row['tree_nickname']."</option>";
                    }
                    echo "</select>";
                    ?>
           
           
             <input type="hidden" id="selspecies_id" value="" />
            <p> <label>Species* </label> <input name="" type="text" value="" id="selspecies_name" readonly="true" title="select the species type from choose tree." DISABLED style="color:#888;background-color:#DADADA;"/></p>
            <p><label>Latitude</label><input type=text id="loclat"  name="loclat" value=""  DISABLED style="color:#888;background-color:#DADADA;"></input></p>
            <p><label>Longitude</label><input type=text id="loclon"  name="loclon" value="" DISABLED style="color:#888;background-color:#DADADA;"></input></p>
            <p><label>City</label><input type=text id="loccity"  name="loccity" value="" DISABLED style="color:#888;background-color:#DADADA;"></input></p>
            <p><label>Location name</label><input type=text id="locname"  name="locname" value="" DISABLED style="color:#888;background-color:#DADADA;"></input></p>
            <p><label>Location type</label><input type=text id="loctype" name="loctype" value="" DISABLED style="color:#888;background-color:#DADADA;"/></input></P>
	    <p><label>Nickname*</label><input name="" type="text" value="" id="tree_nickname"  name="tree_nickname" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" /></p>
            <p>
            <label title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">Height (in m)</label>
            <input id="tree_height" type="text"  title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)."/>
            </p>
            <p>
            <label title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">
	     Girth (in cm)</label><input id="tree_girth" type="text" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4 m or 4.5 ft from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." />
            </p>
            <p>
            <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">Damaged</label>
            &nbsp;&nbsp;&nbsp;<input name="tree_damage" type="radio" value="0"  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/>&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/>&nbsp;Yes
            </p>
             <p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;&nbsp;&nbsp;<input name="is_fertilised" type="radio" value="0"  title="Many trees in parks, gardens and campuses are regularly fertilized? this affects the phenology of the tree and therefore must be noted."/>&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/>&nbsp;Yes
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;&nbsp;&nbsp;<input name="is_watered" type="radio" value="0"  title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/>&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/>&nbsp;Yes
            </p>
            
           
            <input type='hidden' name='cmd' value='add_tree'>
        <br />
    </div>

    <div class="Right_BOX">
        <br>
        <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest water source(in m)</label>
             <input id="distance_from_water" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
            <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Slope (in deg)</label>
             <input id="degree_of_slope" type="text" title="If your plant is on a hill, please try and note the degree of the hill slope."/>
            </p>
            <div class="clearBoth"></div>
            <p>
            <label title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">Aspect</label>
             <select id="aspect" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">
                                <option value="">Choose one</option>
				<option id="North" value="North">North</option>
				<option id="NorthEast" value="NorthEast">North-East</option>
				<option id="East" value="East">East</option>
				<option id="SouthEast" value="SouthEast">South-East</option>
				<option id="South" value="South">South</option>
				<option id="SouthWest" value="SouthWest">South-West</option>
				<option id="West" value="West">West</option>
				<option id="NorthWest" value="NorthWest">North-West</option>
			
                            </select>
          
            </p>
            <p>
            <label title="" style="padding-top:75px;width:110px">
		Notes</label>&nbsp;
    <textarea class="text_box_textarea" style="width:190px;height:150px" id="other_notes"></textarea><br/>
    <? if ($_SESSION['usercategory']!='individual'){?>
    <label title="" style="padding-top:75px;width:110px">
		Assign to students</label>&nbsp;
    
    <textarea class="text_box_textarea_one" style="width:190px;height:150px" id="studentname" >eg. John,Bala,Seetha</textarea><?}?>
    </p>
           <div class="clearBoth"></div>
 
    <!--<p> <label>Notes</label>
    <textarea class="text_box_textarea" id="other_notes"></textarea><p>
        <div class="clearBoth"></div>
   Assign to students
    <textarea class="text_box_textarea_one" id="studentname" >eg. John,Bala,Seetha</textarea></p>-->
    </div>
</div>
                                
<div class="clearBoth"></div>
        <div class="addtreebutton_area">
            <div class="right_side_button">
            <div class="button_area_ok"  id="button_area_ok" style="display:none;">
                 <a href="#" onClick="AddTreeInfo()">Add Tree</a>
            </div>
            <div class="right_button"  id="button_area_loc"style="display:none;" >
                 <a href="#" OnClick="EnableLocation()">Location</a>
            </div>
            <div class="right_button"  id="button_area_details" style="display:none;" >
                 <a href="#" OnClick="EnableDetails()">Details</a>
            </div>
            <div class="right_button"  id="button_loc_next" name="button_loc_next" >
                 <a href="#" OnClick="EnableLocation()">Next</a>
            </div>
                <div class="right_button"  id="button_area_next" name="button_loc_next" style="display:none;" >
                 <a href="#" OnClick="EnableDetails()">Next</a>
            </div>
            </div>
            <div class="left_button" id="button_loc_prev" name="button_loc_prev" style="display:none;" >
                 <a href="#" OnClick="EnableChoosetree()">Back</a>
            </div>
            <div class="left_button"  id="button_details_prev"  name="button_details_prev" style="display:none;">
                 <a href="#" OnClick="EnableLocation()">Back</a>
            </div>
            <div class="button_area_cancel" style="display:none;"><a href ="javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none'">CANCEL</a></div>
            </div>
        </div>
       
                                  
            </div>
     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->



