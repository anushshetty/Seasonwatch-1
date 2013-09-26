<?php
/*
 *Initial Development:- this page will be displayed when user clicks on Add tree from seedDashboard page.
 * This will display all the trees and its information . on selection of the species it will be moved to 
 * seedaddtreeMay18.php.
 * status : no problem Working fine.
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
$(function() {
    
    var availableTags = [
    {value: '0-1161',label: 'Jackfruit'},{value: '0-1161',label: 'Katthal'},{value: '1-1079',label: 'Jamun'},{value: '1-1079',label: 'Black plum'},
    {value: '2-1045',label: 'Jarul'},{value: '2-1045',label: 'Pride of India'},{value: '2-1045',label: 'Queens flower'},
    {value: '3-1063',label: 'Amla'},{value: '3-1063',label: 'Indian Gooseberry'},{value: '4-1163',label: 'Lalchampa'},{value: '5-1164',label: 'Kaphal'},
    {value: '5-1164',label: 'Box Myrtle'},{value: '6-1071',label: 'Burans'},{value: '6-1071',label: 'Rhododendron'},
    {value: '7-1165',label: 'Kainju'},{value: '7-1165',label: 'Himalayan Maple'},
    {value: '8-1090',label: 'Aam'},{value: '8-1090',label: 'Mango'},{value: '9-1035',label: 'Bargad'},{value: '9-1035',label: 'Banyan'},
    {value: '10-1065',label: 'Ashok'},{value: '10-1065',label: 'True Ashok'},
    {value: '11-1008',label: 'Saptrani'},{value: '11-1008',label: 'Devils tree'},
    {value: '12-1166',label: 'Padam'},{value: '12-1166',label: 'Himalayan Cherry'},
    {value: '13-1012',label: 'Kaniar'},
    {value: '14-1034',label: 'Pangra'},{value: '14-1034',label: 'Indian coral tree'},
    {value: '15-1017',label: 'Dhak'},{value: '15-1017',label: 'Flame of the Forest'},
    {value: '16-1020',label: 'Amaltas'}, {value: '16-1020',label: 'Indian laburnum'},
    {value: '17-1066',label: 'Karanju'},{value: '17-1066',label: 'Indian beech'},
    {value: '18-1081',label: 'Imli'}, {value: '18-1081',label: 'Tamarind'},
    {value: '19-1167',label: 'Akhrot'},{value: '19-1167',label: 'Walnut'},
    {value: '20-1030',label: 'Gulmohur'},{value: '20-1030',label: 'Flame tree'},
    {value: '21-1001',label: 'Babool'},{value: '21-1001',label: 'Egyptian Mimosa,'},
    {value: '22-1011',label: 'Neem'},{value: '22-1011',label: 'Margosa'},
    {value: '23-1006',label: 'Siris'},{value: '23-1006',label: 'East Indian Walnut'},
    {value: '24-1015',label: 'Semul'},{value: '24-1015',label: 'Red Silk Cotton'},
    {value: '0-1161',label: 'Artocarpus heterophyllus'},{value: '1-1079',label: 'Syzygium cumini'},{value: '2-1045',label: 'Lagerstroemia speciosa'},
    {value: '3-1063',label: 'Phyllanthus emblica'},{value: '4-1163',label: 'Magnolia campbellii'},{value: '5-1164',label: 'Kaphal'},
    {value: '6-1071',label: 'Himalayan Rhododendron'},{value: '7-1165',label: 'Himalayan Maple'},
    {value: '8-1090',label: 'Mangifera indica'},{value: '9-1035',label: 'Ficus bengalensis'},{value: '10-1065',label: 'Ficus bengalensis'},
    {value: '11-1008',label: 'Alstonia scholaris'},{value: '12-1166',label: 'Prunus cerasoides'},{value: '13-1012',label: 'Bauhinia purpurea'},
    {value: '14-1034',label: 'Bauhinia purpurea'},{value: '15-1017',label: 'Butea monosperma'},{value: '16-1020',label: 'Cassia fistula'},
    {value: '17-1066',label: 'Pongamia pinnata'},{value: '18-1081',label: 'Tamarindus indica'},{value: '19-1167',label: 'Juglans regia'},
    {value: '20-1030',label: 'Delonix regia'},{value: '21-1001',label: 'Acacia nilotica'},{value: '22-1011',label: 'Acacia nilotica'},
    {value: '23-1006',label: 'Albizia lebbeck'},{value: '24-1015',label: 'Bombax ceiba'},
    ];
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
            var subindex;var mainIndex;var chkindex;
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
            if(index>14 && (index<=18))
            {   subindex=2;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }

            if(index>18 && (index<=23))
            { 
                subindex=3;
                mainIndex=parseInt(index)+5;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>23)
            {
                subindex=4;
                chkindex=0;
                mainIndex=parseInt(index)+4;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }

            $('.addTreeContainerHolder > div:eq('+index+')').show();//working
            document.getElementById('selspecies_id').value=speciesid;
            document.getElementById('selspecies_name').value=ui.item.label;
            return false;
            }
    });
});
</script>
<a href = "javascript:void(0)" onclick = "document.getElementById('lightFour').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeone.png" alt="close" id="treeclose"/></a> 
    <div class="DashBosrdcontainer_add_tree_lightbox">
            <div class="container_nav">
    <h2>Add a Tree </h2>
    	<div class="nav_bg">
        <ul class="nav">
        <li ><a href="javascript:void(0)" onclick="EnableChoosetree()" class="cur" id="treesel">Choose a Tree<div class=""></div></a></li>
        <li ><a href="javascript:void(0)"  onclick="EnableLocation()" id="addlocation" class="mid">Add Location<div class=""></div></a></li>
        <li ><a href="javascript:void(0)" onclick="EnableDetails()"  class="last" id="adddetails">Add Details</a></li>
        </ul>
		</div>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
        $(".nav li a").click(function (){
         $('.nav li a').removeClass('cur');
            $(this).addClass('cur');
          }); 
        function EnableChoosetree()
        { $('.nav li a').removeClass('cur');
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
             
             
        }
        function EnableLocation()
        {
           // alert("Enableloca");
            var selTree = $("#selspecies_id").val();
            if (selTree=='')
            {
				alert("Please select the Tree species from choose Tree.");
				$('.nav li a').removeClass('cur');
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
				document.getElementById('mapBox').style.display='block';
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
            }
        }
         function EnableDetails()
        {
             var selTree = $("#selspecies_id").val();
             if (selTree=='')
             {
                 EnableChoosetree();
             }
           else
               {
                   
                var lat = $("#lat").val();
                
                if (lat!='')
                 {
                     var stateval = $("#state").val();
                     if (stateval=='')
                     {
                         alert("Please select the state.");
                         return false;
                     }
                     var zoom_get = $('#zoom').val();
                     
                    if(zoom_get < 15 ) 
                    {
                        alert("Current zoom level is " + zoom_get + ".  The min accepted zoom level is 15. Please zoom in more to select the location.");
                        return false;
                    }
                 }
                 var lon = $("#lng").val();
                 var locname=$("#loc_name").val();
                 var loccity=$("#city").val();
                               
                 document.getElementById('loclat').value=lat;
                 document.getElementById('loclon').value=lon;
                 document.getElementById('loccity').value=loccity;
                 document.getElementById('locname').value=locname;    
                   
                   
               
                $('.nav li a').removeClass('cur');
                document.getElementById('addlocation').className='';
                document.getElementById('treesel').className='';
                document.getElementById('adddetails').className='cur';
                document.getElementById('TBOX').style.display='none';
                document.getElementById('tags').style.display='none';
                document.getElementById('boxDO').style.display='block';
                document.getElementById('mapBox').style.display='none';
                document.getElementById('pick').style.display='none';
                document.getElementById('pickone').style.display='none';
                document.getElementById('boxDO').style.border='none';
                //document.getElementById('button_area_ok').style.display='block';
                document.getElementById('button_area_ok').style.display='block';
                document.getElementById('button_area_details').style.display='none';
                document.getElementById('button_area_loc').style.display='none'; 
                document.getElementById('button_details_prev').style.display='block';
                document.getElementById('button_loc_prev').style.display='none';
                document.getElementById('button_area_next').style.display='none';
                document.getElementById('button_loc_next').style.display='none';
                }
            
            
        }
        function seltreespecies(speciesvalue) 
        {
            var sp= jQuery('#tags option:selected').text();
            var strvalue=speciesvalue;
            var dtCh= "-";
            var pos1=strvalue.indexOf(dtCh);
            var index=parseInt(strvalue.substring(0,pos1));//year
            var speciesid=parseInt(strvalue.substring(pos1+1,strvalue.length));
            var subindex;var mainIndex;
            $('div.addTreeContainer').hide();
            $('ul.addtreeList li ul').slideUp('fast');
            $('ul.addtreeList li ul li blockquote').removeClass('selected_2');
            $('ul.addtreeList li span').removeClass('selected');
             if (index<=6)
            {   subindex=0;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+index+')').addClass('selected_2');
            }

            if((index>6) && (index<=12))
            {   subindex=1;
                 mainIndex=parseInt(index)+1;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }
            if(index>12 && (index<=15))
            { 
                subindex=2;
                mainIndex=parseInt(index)+2;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>15 && (index<=23))
            { 
                subindex=3;
                mainIndex=parseInt(index)+7;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            if(index>23 && (index<=24))
            {
                subindex=4;
                mainIndex=parseInt(index)+8;
                $('ul.addtreeList li ul:eq('+subindex+')').slideDown('fast'); //main green strap
                $('ul.addtreeList > li > span:eq('+subindex+')').addClass('selected'); //working //arrow
                $('ul.addtreeList li ul li blockquote:eq('+mainIndex+')').addClass('selected_2');
            }

            
            
            $('.addTreeContainerHolder > div:eq('+index+')').show();//working
            document.getElementById('selspecies_id').value=speciesid;
            document.getElementById('selspecies_name').value=sp;
        }
		</script>
    </div>
       <h3 id="pick">Name of Tree <br />
   <input tye="textbox" id="tags" value=""  class="cmnameField"></h3>
     <div class="clearBoth"></div>
    <h5 id="pickone">Or pick the leaf type from below:</h5>
    <div class="clearBoth"></div>
<!-- start Tree_box-->
<div id="TBOX" class="tree_box">
    <div style="float:left" > <!--This is the first division of left-->
      <div id="firstpane" class="firstpane"> <!--Code for menu starts here-->
          <ul class="addtreeList">
                <li id="sub1" class="sub1"><a href="#" class="selected" onmouseover="simmid.src='images/Simple-middle-selected.png'" onmouseout="simmid.src='images/Simple-middle.png'"><img src="images/Simple-middle.png" alt=" " name="simmid" width="103" height="73" /></a><span ></span>
                    <ul >
                        <li value="1161" class="selected_2 slected"><a href="tree_1_1" id="sub_1_1" onClick="setspeciesname('1161','JACKFRUIT','0-1161')">JACKFRUIT</a> <blockquote></blockquote></li>
                        <li value="1079"><a href="tree_1_2" id="sub_1_2" onClick="setspeciesname('1079','JAMUN','1-1079')">JAMUN</a> <blockquote></blockquote></li>
                        <li value="1045"><a href="tree_1_3" id="sub_1_3" onClick="setspeciesname('1045','JARUL','2-1045')">JARUL</a> <blockquote></blockquote></li>
                        <li value="1063"><a href="tree_1_4" id="sub_1_4" onClick="setspeciesname('1063','AMLA','3-1063')">AMLA</a> <blockquote></blockquote></li>
                        <li value="1163"><a href="tree_1_5" id="sub_1_5" onClick="setspeciesname('1163','LALCHAMPA','4-1163')">LALCHAMPA</a> <blockquote></blockquote></li>
                        <li value="1164"><a href="tree_1_6" id="sub_1_6" onClick="setspeciesname('1164','KAPHAL','5-1164')">KAPHAL</a> <blockquote></blockquote></li>
                        <li value="1071"><a href="tree_1_7" id="sub_1_7" onClick="setspeciesname('1071','BURANS','6-1071')">BURANS</a> <blockquote></blockquote></li>
                        <li ><a href="tree_1_8" ></a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub2" class="sub2"><a href="#" class="selected"onmouseover="simba.src='images/Simple-base-apex-selected.png'" onmouseout="simba.src='images/Simple-base-apex.png'"><img src="images/Simple-base-apex.png" alt=" " name="simba" width="103" height="73" /></a><span></span>
                    <ul >
                        <li value="1165"><a href="tree_2_1"  id="sub_2_1" onClick="setspeciesname('1165','KAINJU','7-1165')">KAINJU</a> <blockquote></blockquote></li>
                        <li value="1090"><a href="tree_2_2" id="sub_2_2" onClick="setspeciesname('1090','AAM','8-1090')">AAM</a> <blockquote></blockquote></li>
                        <li value="1035"><a href="tree_2_3" id="sub_2_3" onClick="setspeciesname('1035','BARGAD','9-1035')">BARGAD</a> <blockquote></blockquote></li>
                        <li value="1065"><a href="tree_2_4" id="sub_2_4" onClick="setspeciesname('1065','ASHOK','10-1065')">ASHOK</a> <blockquote></blockquote></li>
                        <li value="1008"><a href="tree_2_5" id="sub_2_5" onClick="setspeciesname('1008','SAPTARNI','11-1008')" >SAPTARNI</a> <blockquote></blockquote></li>
                        <li value="1166"><a href="tree_2_6" id="sub_2_6" onClick="setspeciesname('1166','PADAM','12-1166')">PADAM</a> <blockquote></blockquote></li>
                        <li ><a href="tree_2_7" ></a></li>
                        <li><a href="tree_2_8"></a> <blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub3"><a href="#" onmouseover="comp23.src='images/Compound-2or3leaflets-selected.png'" onmouseout="comp23.src='images/Compound-2or3leaflets.png'"><img src="images/Compound-2or3leaflets.png" alt=" " name="comp23" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1012"><a href="tree_3_1"  id="sub_3_1" onClick="setspeciesname('1012','KANIAR','13-1012')">KANIAR</a><blockquote></blockquote></li>
                        <li value="1034"><a href="tree_3_2"  id="sub_3_2" onClick="setspeciesname('1034','PANGRA','14-1034')">PANGRA</a><blockquote></blockquote></li>
                        <li value="1017"><a href="tree_3_3"  id="sub_3_3" onClick="setspeciesname('1017','DHAK','15-1017')">DHAK</a><blockquote></blockquote></li>
                        <li><a href="tree_3_4" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_5" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_6" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_7" ></a><blockquote></blockquote></li>
                        <li><a href="tree_3_8" ></a><blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub4"> <a href="#" onmouseover="comppinn.src='images/Compound-pinnate-selected.png'" onmouseout="comppinn.src='images/Compound-pinnate.png'"><img src="images/Compound-pinnate.png" alt=" " name="comppinn" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1020"><a href="tree_4_1" id="sub_4_1" onClick="setspeciesname('1020','AMALTAS','16-1020')" class="selected">AMALTAS</a><blockquote></blockquote></li>
                        <li value="1066"><a href="tree_4_2" id="sub_4_2" onClick="setspeciesname('1066','KARANJ','17-1066')">KARANJU</a><blockquote></blockquote><li>
                        <li value="1081"><a href="tree_4_3" id="sub_4_3" onClick="setspeciesname('1081','IMLI','18-1081')">IMLI</a><blockquote></blockquote></li>
                        <li value="1167"><a href="tree_4_4" id="sub_4_4" onClick="setspeciesname('1167','AKHROT','19-1167')">AKHROT</a><blockquote></blockquote></li>
                        <li value="1030"><a href="tree_4_5" id="sub_4_5" onClick="setspeciesname('1030','GULMOHUR','20-1030')">GULMOHUR</a><blockquote></blockquote></li>
                        <li value="1001"><a href="tree_4_6" id="sub_4_6" onClick="setspeciesname('1001','BABOOL','21-1001')">BABOOL</a><blockquote></blockquote></li>
                        <li value="1011"><a href="tree_4_7" id="sub_4_7" onClick="setspeciesname('1011','NEEM','22-1011')">NEEM</a><blockquote></blockquote></li>
                        <li value="1006"><a href="tree_4_8" id="sub_4_8" onClick="setspeciesname('1006','SIRIS','23-1006')">SIRIS</a><blockquote></blockquote></li>
                    </ul>
                </li>
                <li id="sub5"> <a href="#" onmouseover="comppalm.src='images/Compound-palmate-selected.png'" onmouseout="comppalm.src='images/Compound-palmate.png'"><img src="images/Compound-palmate.png" alt=" " name="comppalm" width="103" height="73" /></a><span></span>
                    <ul>
                        <li value="1015"><a href="tree_5_1" id="sub_5_1" onClick="setspeciesname('1015','SEMUL','24-1015')" class="selected">SEMUL</a></li>
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
            $xml = simplexml_load_file("gsptrees.xml")  or die("Error: Cannot create object");
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
 <div class="clearBoth"></div>                 
<div id="boxDO" style="display:none;">
      <div class="leftBox_ONE">
             Fields marked with * are compulsory. <br />
            <p>
                <label>Species Type* </label>
            <input name="" type="text" value="" id="selspecies_name" readonly="true" title="select the species type from choose tree."/></p>
            <input type="hidden" id="selspecies_id" value=""  name="selspecies_id"/>
             <p><label>Latitude</label><input type=text id="loclat"  name="loclat" value=""  style="background-color:#fff;"></p>
            <p><label>Longitude</label><input type=text id="loclon"  name="loclon" value="" DISABLED></p>
            <p><label>City</label><input type=text id="loccity"  name="loccity" value="" DISABLED></p>
            <p><label>Location name</label><input type=text id="locname"  name="locname" value="" DISABLED></p>
           <p>
            <label title="Please give all your trees a unique nickname. This will help you distinguish your individual trees">Nickname*</label>
            <input name="" type="text" value="" id="tree_nickname" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees" />
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
           <?php
                  /*  $tree_code_sms_data=mysql_query("SELECT tree_code_sms FROM user_tree_table WHERE user_id='$_SESSION[userid]'");
                    $tree_code_sms_values= array(
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0,
                    0,0,0,0,0,0,0,0,0,0
                    );
                    while(list($tree_code_sms_val)=mysql_fetch_row($tree_code_sms_data))
                    {
                    $tree_code_sms_values[intval($tree_code_sms_val)-1]=1;
                    }*/?>
           <!-- <p>
            <label title="Please give all your trees a unique sequence number  (e.g. 001, 002). This will help you identify the tree later while using SMS etc.">Tree Sequence No*</label>
           <select id="tree_code_sms" title="Please give all your trees a unique sequence number  (e.g. 001, 002). This will help you identify the tree later while using SMS etc.">
                                <option id="Choose" value="" >-- Choose --</option>
                                <?php
                               /* $i=1;
                                while($i<=50)
                                {
                                    if(!$tree_code_sms_values[$i-1])
                                    {
                                        if ($i<10)
                                        {
                                            $tree_code_sms="00".strval($i);
                                        }
                                        else if ($i<100)
                                        {
                                            $tree_code_sms="0".strval($i);
                                        }
                                        else
                                        {
                                            $tree_code_sms=strval($i);
                                        }
                                        echo "<option id=".$tree_code_sms." value=".$tree_code_sms.">" . $tree_code_sms . "</option>";
                                    }
                                    $i +=1;
                                }*/
                                ?>
                            </select>
            </p>-->
            <p>
            <label title="Please select the location">Location Type</label>
            <select id="location_type"  title="Please select the location">
                                <option id="Choose" value="Choose">-- Choose --</option>
				<option id="Garden/Park" value="Garden/Park">Garden/Park</option>
				<option id="Avenue" value="Avenue">Avenue</option>
				<option id="Forest" value="Forest">Forest</option>
				<option id="Campus" value="Campus">Campus</option>
				<option id="Marsh" value="Marsh">Marsh</option>
				<option id="Grassland" value="Grassland">Grassland</option>
				<option id="Plantation" value="Plantation">Plantation</option>
				<option id="Farmland" value="Farmland">Farmland</option>
				<option id="Other" value="Other">Other</option>
                            </select>
           
            </p>
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
            <!--<p>
            <label  title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">
                Damaged</label>&nbsp;<input name="tree_damage" type="radio" value="0" checked="checked" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="tree_damage" type="radio" value="1" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped."/>Yes
            </p>-->
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
             <!--<p>
            <label  title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted.">
		Fertilised</label>&nbsp;<input name="is_fertilised" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly fertilized? this affects the phenology of the tree and therefore must be noted."/>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="is_fertilised" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly fertilized this affects the phenology of the tree and therefore must be noted."/>Yes
            </p>
             <p>
            <label title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted.">
		Watered</label>&nbsp;<input name="is_watered" type="radio" value="0" checked="checked" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="is_watered" type="radio" value="1" title="Many trees in parks, gardens and campuses are regularly watered ? this affects the phenology of the tree and therefore must be noted."/>Yes
            </p>-->
            <!--<p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Nearest water source(in m)</label>
             <input id="distance_from_water" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
            <p>
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Slope</label>
             <input id="degree_of_slope" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
            </p>
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
          
            </p>-->
 
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
            <label title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">Slope</label>
             <input id="degree_of_slope" type="text" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc."/>
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
           <div class="clearBoth"></div>
 
    <p> <label>Notes</label>
    <textarea class="text_box_textarea" id="other_notes"></textarea><p>
        <div class="clearBoth"></div>
   Assign to students
    <textarea class="text_box_textarea_one" id="studentname" name="studentname" >eg. John,Bala,Seetha</textarea></p>
    </div>
</div>
                                
<div class="clearBoth"></div>

<div style="display:none;" id="mapBox">
    <?include("addtree_step.php"); ?>  
</div>

<div class="clearBoth"></div>
                                    
                                  </div>
         <div class="button_area">
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
     
    
<!--</div>-->
<!--MODAL Ends-->
<!-- On submitting the above dialog box, the one below is loaded for bringing up Stage 2 of Add Tree.-->



