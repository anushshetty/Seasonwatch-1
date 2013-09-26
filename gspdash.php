<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php /*
Initial Developmet:- This page is called when a dashboard is clicked on in the header.
It loads all tree details on the left block and the assigned members on the right.
It also has links to load the dialog boxes for
	Add Tree
        Edit Tree
	Add Observations
	Edit Observations
 */?>
<?php 
	session_start();
    if (!isset($_SESSION['userid']))
	{
		header("Location: index.php");
	}
	$treeno=  $_SESSION['NoTrees']; 
       include 'includes/dbcon.php';
	
	
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seasonwatch /GSP</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/popup.js"> </script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="js/initiate.js"></script>
<script type="text/javascript">

$(document).ready(function()
{  
	$('ul.addtreeList li:first ul, .addTreeContainerHolder div.addTreeContainer:first').show();
	$('ul.addtreeList li:first span').addClass('selected');
	$('ul.addtreeList li:first ul li:first blockquote').addClass('selected_2');
        $('div.add_tree_icon ul li.close img').hide();
	$('ul.addtreeList > li > a').click(function(e)
	{
		e.preventDefault();
		$('ul.addtreeList li ul').slideUp('fast');
		$('ul.addtreeList li span').removeClass('selected');
		$(this).siblings('ul').slideDown('fast');
		$(this).siblings('span').addClass('selected');
		
	});
	$('ul.addtreeList li ul li a').click(function(e)
	{
		e.preventDefault();
		$('div.addTreeContainer').hide();
		$('div#'+$(this).attr('href')).fadeIn(1000);
		$('ul.addtreeList li ul li blockquote').removeClass('selected_2');
		$(this).siblings('blockquote').addClass('selected_2');
	});
	$('.popup a').click(function(e)
	{
		e.preventDefault();
		$('div.add_tree_icon ul li.popup img').hide();
                $('div.add_tree_icon ul li.close img').show();
		$(this).closest('div.body_top').find('.container_2_bottom_area').slideDown('fast');
		$(this).closest('div.body_top').css('background-color', '#fff');
	});
	

	$('.close a').click(function(e)
	{
                e.preventDefault();
		$('div.add_tree_icon ul li.popup img').show();
                $('div.add_tree_icon ul li.close img').hide();
                $(this).closest('div.body_top').find('.container_2_bottom_area').slideUp('fast');
		$(this).closest('div.body_top').css('background-color', '#EDEDED');
	});
        $('a[name=openAddTreeModal]').click(function()
	{
        	
            $('#lightFour').show();
            $('#fadeOne').show().height($('body').height());
            //initialize();
            $(document).scrollTop(0);
		
	});
	$('a[name=itemModal]').click(function(e)
	{
		e.preventDefault();
		var toOpenModal = '#'+$(this).attr('href');
                $(toOpenModal).show();
		$('#fadeOne').show().height($('body').height());
		$(document).scrollTop(140);
                
                          
 	});
        $('a[name=openEditTreeModal]').click(function(e)
	{
		e.preventDefault();
		var toOpenModal = '#'+$(this).attr('href');
               
                $(toOpenModal).show();
		$('#fadeOne').show().height($('body').height());
		$(document).scrollTop(140);
                window.scrollTo(0, 0);
	});
        var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();
        var noofDays=DateDiff(d1, d2);
        
        var treenums = <?echo $treeno?>;
        for (i=0;i<=treenums;i++)
        {
        
            $("#obdate"+i).datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
        }
 });
function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
         return parseInt((t2-t1)/(24*3600*1000));
    }
</script>
<!-- This function loads the name & value of the species selected from selection selction & pass to add tree dialog-->
<script>
   function setspeciesname(speciesID,name,index)
    {
        document.getElementById('selspecies_id').value=speciesID;
        document.getElementById('selspecies_name').value=name;
        document.getElementById('tags').value=index;
        return true;
    }
 </script>
<!-- Google Analytics code starts-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5355447-9']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>

<!-- Google Analytics code ends--> 
<!--
On submitting the form for Add Tree this code is executed.
It validates the data in the form and then submits the values
to tracktrees.php for adding the new tree.

-->
<script type="text/javascript" >
function ltrim(str) { 
	for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
	return str.substring(k, str.length);
}
function rtrim(str) {
	for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ;
	return str.substring(0,j+1);
}
function trim(str) {
	return ltrim(rtrim(str));
}
function isWhitespace(charToCheck) {
	var whitespaceChars = " \t\n\r\f";
	return (whitespaceChars.indexOf(charToCheck) != -1);
}

function AddTreeInfo() {

var selTree=document.getElementById("selspecies_id").value;
if (selTree=='')
    {
        alert("Please select the Tree species from choose Tree.");
        $('#lightSix').hide();
        $('#lightFour').show();
        return false;
     }
var height;
height = document.getElementById("tree_height").value;
var girth;
girth = document.getElementById("tree_girth").value;
var distance;
distance = document.getElementById("distance_from_water").value;
var slope;
slope = document.getElementById("degree_of_slope").value;
var nick_name;
nick_name = trim(document.getElementById("tree_nickname").value);

if (height != '' )
{
//alert("The value is "+height);
var numericExpression = /^\d+(\.\d{1,2})?$/;
	if(height.match(numericExpression) && (height>0 && height<=50)){
//	return true;
}
else{
		alert("tree height value should be Numeric & between 1 to 50");
		document.getElementById("tree_height").focus();
		return false;
}
} 

if(girth != '' )
{
var numericnew= /^\d+(\.\d{1,2})?$/;
	if(girth.match(numericnew) && (girth>4 && girth<=10000)){
	//return true;
}
else{
		alert("tree girth value should be Numeric & between 5 to 10000");
		document.getElementById("tree_girth").focus();
		return false;
}
} 

if(distance != '' )
{
var numericdistance= /^[0-9]+$/;
	if(distance.match(numericdistance)){
	//return true;
}
else{
		alert("Distance value should be Numeric");
		document.getElementById("distance_from_water").focus();
		return false;
}
} 

if(slope != '' )
{
var numericslope= /^[0-9]+$/;
	if(distance.match(numericslope) && (slope>=0 && slope<=90))
{
}
else
{
alert("Slope value should be Numeric & between 0 to 90");
document.getElementById("degree_of_slope").focus();
return false;
}
} 


for (i=0; i <= document.getElementById('nicknames').length - 1;i++)
{
if(nick_name == document.getElementById('nicknames')[i].text )
{
	alert("Nickname should be unique. Please change the nick name.");
	document.getElementById("tree_nickname").focus();
	return false;
}
}

if(nick_name == '' )
{
	alert("Please enter a nickname");
	document.getElementById("tree_nickname").focus();
	return false;
}

/*if($('#tree_code_sms').attr('value')=='')
{
	alert("Please choose the tree sequence number");
	document.getElementById("tree_code_sms").focus();
	return false;
}*/

	//var dataString = $("form").serialize();
	var dataString = "tree_nickname="+$('#tree_nickname').attr('value');
	dataString += "&location_type="+$('#location_type').attr('value');
	dataString += "&tree_height="+$('#tree_height').attr('value');
	dataString += "&tree_girth="+$('#tree_girth').attr('value');
	
	temp=$('input:radio[name=tree_damage]:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&tree_damage="+temp;
	
	temp=$('input:radio[name=is_fertilised]:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&is_fertilised="+temp;
	
	temp=$('input:radio[name=is_watered]:checked').val();
	if (temp == undefined ) { temp='-1'; }	
	dataString += "&is_watered="+temp;
	
	dataString += "&distance_from_water="+$('#distance_from_water').attr('value');
	dataString += "&degree_of_slope="+$('#degree_of_slope').attr('value');
	dataString += "&aspect="+$('#aspect').attr('value');
	dataString += "&other_notes="+$('#other_notes').attr('value');
	dataString += "&user_id=<?php echo $_SESSION[userid]?>";
	dataString += "&species_id="+document.getElementById('selspecies_id').value;
	dataString += "&tree_code_sms="+$('#tree_code_sms').attr('value');
	dataString += "&members_assigned="+$('#studentname').attr('value');
     
	dataString += "&latitude="+$("#lat").val();
        dataString += "&longitude="+$("#lng").val();
        dataString += "&locationname="+$("#loc_name").val();
        dataString += "&stateid="+$("#state").val();
        dataString += "&locationcity="+$("#city").val();
        dataString += "&zoomval="+$('#zoom').val();
        alert(dataString);
	$.ajax({
	type: "POST",
	url: "tracktreestest.php",
	data: dataString,
	success: function(data){
        alert(data);
	//$('.success1').html(data);
	$('.success1').fadeIn(200).show();
	$('.error1').fadeOut(200).hide();
	window.setTimeout("$('#dialog_add_tree').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
	}
	});

return false;
};

</script>
<!--
Called on submitting Edit Tree details dialog box.
It validates tree details and then passes on the values by AJAX to
updatetree.php for updating this tree's details on the DB.
-->

<script type="text/javascript" >
    
function EditTree(id) {
var nick_name;
nick_name = document.getElementById("etree_nickname"+id).value;

var height;
height = document.getElementById("etree_height"+id).value;
var girth;
girth = document.getElementById("etree_girth"+id).value;
var distance;
distance = document.getElementById("edistance_from_water"+id).value;
var slope;
slope = document.getElementById("edegree_of_slope"+id).value;
var locationtype;
locationtype = document.getElementById("elocation_type"+id).value;
if (height != '' )
{
    var numericExpression = /^\d+(\.\d{1,2})?$/;
    if(height.match(numericExpression) && (height>0 && height<=50)){
    //	return true;
    }
    else{
    alert("tree height value should be Numeric & between 1 to 50");
    document.getElementById("etree_height"+id).focus();
    return false;
    }
} 
if(girth != '' )
{
    var numericnew= /^\d+(\.\d{1,2})?$/;
    if(girth.match(numericnew) && (girth>4 && girth<=10000)){
    //return true;
    }
    else{
        alert("tree girth value should be Numeric & between 5 to 10000");
        document.getElementById("etree_girth"+id).focus();
        return false;
    }
} 
if(distance != '' )
{
    var numericdistance= /^[0-9]+$/;
    if(distance.match(numericdistance)){
    //return true;
    }
    else{
    alert("Distance value should be Numeric");
    document.getElementById("edistance_from_water"+id).focus();
    return false;
    }
} 
if(slope != '' )
{
    var numericslope= /^[0-9]+$/;
    if(distance.match(numericslope) && (slope>=0 && slope<=90))
    {
    }
    else
    {
    alert("Slope value should be Numeric & between 0 to 90");
    document.getElementById("edegree_of_slope"+id).focus();
    return false;
    }
} 

for (i=0; i <= document.getElementById('nicknames').length - 1;i++)
{
    if(nick_name == document.getElementById('nicknames')[i].text )
    {
            //alert("Nickname should be unique. Please change the nick name.");
           // document.getElementById("tree_nickname").focus();
            //return false;
    }
}
if(nick_name == '' )
{
	alert("Please enter a nickname");
	document.getElementById("etree_nickname"+id).focus();
	return false;
}
   //var dataString = $("form").serialize();
    var dataString = "tree_nickname="+$('#etree_nickname'+id).attr('value');
    dataString += "&location_type="+$('#elocation_type'+id).attr('value');
    dataString += "&tree_height="+$('#etree_height'+id).attr('value');
    dataString += "&tree_girth="+$('#etree_girth'+id).attr('value');
    var temp = $('#etree_damage' + id +':checked').val();
    if (temp == undefined ) { temp='-1'; }
    dataString += "&tree_damage="+temp;
    temp = $('#eis_fertilised' + id +':checked').val();
    if (temp == undefined ) { temp='-1'; }
    dataString += "&is_fertilised="+temp;
    temp = $('#eis_watered' + id +':checked').val();
    if (temp == undefined ) { temp='-1'; }	
    dataString += "&is_watered="+temp;
    dataString += "&distance_from_water="+$('#edistance_from_water'+id).attr('value');
    dataString += "&degree_of_slope="+$('#edegree_of_slope'+id).attr('value');
    dataString += "&aspect="+$('#easpect'+id).attr('value');
    dataString += "&other_notes="+$('#eother_notes'+id).attr('value');
    dataString += "&user_id=<?php echo $_SESSION[userid]?>";
    dataString += "&species_id="+document.getElementById("especies_id"+id).value;
    dataString += "&tree_id="+document.getElementById("selectedtreeid"+id).value;
    dataString += "&members_assigned="+document.getElementById("studentname"+id).value;;
    /*alert(dataString);
    /*dataString += "&members_assigned=";
    var np=document.getElementById("emember_num"+id).value;

    j=0;
    for (i=0;i<=document.getElementById("emember_num"+id).value;i++)
    {

    if (document.getElementById('emembers_assigned'+id +i).checked)
    {
    if (j==0)
    {
    dataString += document.getElementById('emembers_assigned'+id+i).value;
    }
    else
    {
    dataString += ", "+document.getElementById('emembers_assigned'+id+i).value;			
    }
    j++;			
    }
    }
    if (j == 0)
    {
    alert("Please assign at least one user.");
    document.getElementById("emembers_assigned"+id).focus();
    return false;
    }*/
    var dialogID = '#dialog_tree_edit' + id;
    $.ajax({
    type: "POST",
    url: "updatetree.php",
    data: dataString,
    success: function(data){
    //alert(data);
    $('.success1').html(data);
    $('.success1').fadeIn(200).show();
    $('.error1').fadeOut(200).hide();

    window.setTimeout("$('dialogID').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
    }
    });
return false;
};
</script>

<!--
This is executed on submitting the Add Observations form.
It validates the data and then passes on values to trackobservations.php in AJAX mode
for adding the observation to the DB.
-->
<script type="text/javascript" >
function Add_obs_submit(ID) {
   
    //$("input:radio").attr("checked", false);

    var dialogID = '#dialog_add_obs' + ID;
    var dataString = "usertreeid="+$("#usertreeid"+ID).attr('value');
    dataString += "&obdate="+$("#obdate"+ID).attr('value');
    
    
    if(document.getElementById("leaf_caterpillar"+String(ID)).checked == true)
    {
        dataString += "&leaf_caterpillar=1";
    }
    else {
        dataString += "&leaf_caterpillar=";
    }
      //  alert(dataString);
    if(document.getElementById("flower_butterfly"+String(ID)).checked == true)
    {
    dataString += "&flower_butterfly=1";
    }
    else {
    dataString += "&flower_butterfly=";
    }
    //alert(dataString);
    if(document.getElementById('flower_bee'+String(ID)).checked == true)
    {
            dataString += "&flower_bee=1";
    }
    else {
            dataString += "&flower_bee=";
    }
    //alert(dataString);
    if(document.getElementById('fruit_bird'+String(ID)).checked == true)
    {
            dataString += "&fruit_bird=1";
    }
    else {
            dataString += "&fruit_bird=";
    }
    //alert(dataString);
    if(document.getElementById('fruit_monkey'+String(ID)).checked == true)
    {
            dataString += "&fruit_monkey=1";
    }
    else {
            dataString += "&fruit_monkey=";
    }
	var chkobdate= document.getElementById("obdate"+ID).value;
    //Check the observation date entry
    if(chkobdate == '' )
    {
        alert("Please enter observation date");
        document.getElementById("obdate"+ID).focus();
        return false;
   }
    
    var freshleave = $('#l1' + ID +':checked').val();
    if (freshleave == undefined ) 
    {   alert("Please select the Leaves Fresh option.");
         return false;
    }
    if (freshleave==0)
    {
        dataString += "&is_leaf_fresh=0&freshleaf_count=0";
    } else if (freshleave==1) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=1";
    } else if (freshleave==2) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=2";
    } else if (freshleave==-1) {
        dataString += "&is_leaf_fresh=-1&freshleaf_count=-1";
    }
    var matureleave = $('#l2' + ID +':checked').val();
    if (matureleave == undefined ) 
    {   alert("Please select the Leaves Mature option.");
         return false;
    }
    //alert(matureleave);
    if (matureleave==0)
    {
        dataString += "&is_leaf_mature=0&matureleaf_count=0";
    } else if (matureleave==1) {
        dataString += "&is_leaf_mature=1&matureleaf_count=1";
    } else if (matureleave==2) {
        dataString += "&is_leaf_mature=1&matureleaf_count=2";
    } else if (matureleave==-1) {
        dataString += "&is_leaf_mature=-1&matureleaf_count=-1";
    }
    var Bud = $('#f1' + ID +':checked').val();
    if (Bud == undefined ) 
    {   alert("Please select the Flower Bud option");
         return false;
    }
    if (Bud==0)
    {
        dataString +="&is_flower_bud=0&bud_count=0";
    } else if (Bud==1) {
        dataString += "&is_flower_bud=1&bud_count=1";
    } else if (Bud==2) {
        dataString += "&is_flower_bud=1&bud_count=2";
    } else if (Bud==-1) {
        dataString += "&is_flower_bud=-1&bud_count=-1";
    }
    var open = $('#f2' + ID +':checked').val();
   if (open == undefined ) 
    {   alert("Please select the Flower Open option");
         return false;
    }
    if (open==0)
    {
        dataString += "&is_flower_open=0&open_flower_count=0";
    } else if (open==1) {
        dataString += "&is_flower_open=1&open_flower_count=1";
    } else if (open==2) {
        dataString += "&is_flower_open=1&open_flower_count=2";
    } else if (open==-1) {
        dataString += "&is_flower_open=-1&open_flower_count=-1";
    }
    var unripe = $('#fr1' + ID +':checked').val();
    if (unripe == undefined ) 
    {   alert("Please select the Fruits Unripe option");
         return false;
    }
    if (unripe==0)
    {
        dataString += "&is_fruit_unripe=0&fruit_unripe_count=0";
    } else if (unripe==1) {
        dataString += "&is_fruit_unripe=1&fruit_unripe_count=1";
    } else if (unripe==2) {
        dataString += "&is_fruit_unripe=1&fruit_unripe_count=2";
    } else if (unripe==-1) {
        dataString += "&is_fruit_unripe=-1&fruit_unripe_count=-1";
    }
    var ripe = $('#fr2' + ID +':checked').val();
   if (ripe == undefined ) 
    {   alert("Please select the Fruits Ripe option");
         return false;
    }
    if (ripe==0)
    {
        dataString += "&is_fruit_ripe=0&fruit_ripe_count=0";
    } else if (ripe==1) {
        dataString +="&is_fruit_ripe=1&fruit_ripe_count=1";
    } else if (ripe==2) {
        dataString += "&is_fruit_ripe=1&fruit_ripe_count=2";
    } else if (ripe==-1) {
        dataString += "&is_fruit_ripe=-1&fruit_ripe_count=-1";
    }
    //alert(dataString);
$.ajax({
type: "POST",
url: "trackobservations.php",
data: dataString,
success: function(data){
 if(data =="Observation with this date for this tree is already exits.")
    {
        alert("Observation with this date already exits.Please change the date and try.");
        document.getElementById("obdate"+ID).focus();
        return false;
    }
    else
    {
        alert("Observation added sucessfully.");
        $('.success1').fadeIn(200).show();
        $('.error1').fadeOut(200).hide();
        window.setTimeout("$('dialogID').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
    }
    /*alert(data);
    var cmpword="Observation added sucessfully.";
    var matchPos = data.search(trim(cmpword));
    //alert(matchPos);
	//alert(dialogID);
    if (matchPos!=-1)
    {
    alert("Observation added sucessfully.");
    $('.success1').fadeIn(200).show();
    $('.error1').fadeOut(200).hide();
    window.setTimeout("$('dialogID').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
    }
    else
    {
        alert("Observation with this date already exits.Please change the date and try.");
        document.getElementById("obdate"+ID).focus();
        return false;
    }*/
    /*if(trim(data)=="Observation added sucessfully.");
    {
        alert("Observation added sucessfully.");
        $('.success1').fadeIn(200).show();
        $('.error1').fadeOut(200).hide();
        window.setTimeout("$('dialogID').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
    }*/

}
});
}
</script>
<!--
This is executed on when user clicks on edit observation link from dashboard or from add observation link.
This will load the edit observation innerhtml
-->
    <script>
    function edit_obs_load(clkloc,id,dialogid,pageno,obserno,totalob) 
    {
        var dataString = "tree_id="+id;
        if(clkloc=="dash")
            {
                var startIndex,endIndex;
                if (pageno==0)
                    {
                       if(obserno==0)
                           {
                            dataString += "&mypageval=1";
                            dataString += "&datano="+obserno;;
                            dataString += "&Totalob="+totalob; 
                           }
                            startIndex=1;
                            endIndex=startIndex+4;
                    }
                   else
                { 
                    dataString += "&mypageval="+pageno;
                    dataString += "&datano="+obserno;
                    dataString += "&Totalob="+totalob; 
                    startIndex= pageno*4;
                    endIndex=startIndex+4;
                 if (endIndex>totalob)
                     {
                         endIndex=totalob;
                     }
                      dataString += "&startindex="+startIndex;
                      dataString += "&endindex="+endIndex;
                }
              }
         else
             {
        dataString += "&mypageval="+document.getElementById('mypageval').value;
        dataString += "&datano="+document.getElementById('datano').value;
        dataString += "&Totalob="+document.getElementById('Totalob').value;
             }
        //alert(dataString);
        $.ajax({
        type: "POST",
        url: "gspeditobservation.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
        document.getElementById('dialog_add_obs'+dialogid).innerHTML="";
        window.parent.tb_remove();
        window.setTimeout("$('#dialog_edit_tree_filter').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
        }
        });
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
        //transition effect		
        $('#mask').fadeIn(1000);	
        $('#mask').fadeTo("slow",0.8);	
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        //Set the popup window to center
        //$('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
        $('#dialog_edit_obs').css('top',  160);
		$('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
        //transition effect
        $('#dialog_edit_obs').fadeIn(2000); 
};	

</script>

<script type="text/javascript" >
function daysInFebruary (year){
    // February has 29 days in any year evenly divisible by four,
// EXCEPT for centurial years which are not also divisible by 400.
return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
    for (var i = 1; i <= n; i++) {
            this[i] = 31;
            if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
            if (i==2) {this[i] = 29};
} 
return this;
}
//edit observation on dateedited event
function dataedited(Editdatetxtbxno,treeid)
{
    //alert("dataedited");
   document.getElementById('editstatus').value=1; 
   var boxno=Editdatetxtbxno;
   var Observeddate=document.getElementById("eobdate"+Editdatetxtbxno).value;
   var iret=validateDateFormat(Editdatetxtbxno);
   
   if(iret==0)
    {
        $.post
        (
        'checkdate.php',
        {observationno:treeid,obdate:Observeddate},
        function (data)
            { 
                if(data!=0)
                {
                   
                    alert("Observation with this data already exits.");
                    document.getElementById("eobdate"+boxno).focus();
                    return false;
                }
            }
        )
    }
    else
    {
        document.getElementById("eobdate"+boxno).focus();
        return false;
    }
 }
function validateDateFormat(Editdatetxtbxno)
{ 
     var dtCh= "-";
        re = /^\d{4}\-\d{2}\-\d{2}$/;
     if(!$('#eobdate'+Editdatetxtbxno).attr('value').match(re) ) 
        {
            alert("Invalid date format.Enter the date in yyyy-mm-dd format.");
           // document.getElementById("eobdate"+Editdatetxtbxno).value="";
            //document.getElementById("eobdate"+Editdatetxtbxno).focus();
            //return false;
            return 1;
        }
        else
        {
   
// This validation is done assuming yyyy-mm-dd
       
        var CurrentDate = new Date();
        var iCurmonth= parseInt(CurrentDate.getMonth())+1;
        var iCurDay=parseInt(CurrentDate.getDate());
        var iCurYear=parseInt(CurrentDate.getFullYear());
        var daysInMonth = DaysArray(12);
        var sdate = document.getElementById("eobdate"+Editdatetxtbxno).value //user entered date 
        var pos1=sdate.indexOf(dtCh);
        var strYear=sdate.substring(0,pos1);//year
        sdate= sdate.substring((pos1+1),(sdate.length));
        var pos2=sdate.indexOf(dtCh)
        var strMonth= sdate.substring(0,pos2);//month
        if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
        var strDate= sdate.substring((pos2+1),(sdate.length));// date
        if (strDate.charAt(0)=="0" && strDate.length>1) strDate=strDate.substring(1);
        var imonth=parseInt(strMonth);
        var iday=parseInt(strDate);
        var iyear=parseInt(strYear);
        var iConCurrentdate= iCurYear*10000+iCurmonth*100+iCurDay;
        var iUserdate= iyear*10000+imonth*100+iday;
        if (iUserdate > iConCurrentdate)
        {
            alert("Observation dates in the future are not allowed. Please enter an observation date between 1 Jan 2010 and today.");
           // document.getElementById("eobdate"+Editdatetxtbxno).focus();
            //document.getElementById("eobdate"+Editdatetxtbxno).focus();
            //return false;
            return 1;
        }
        if (iUserdate < 20100101)
        {
            alert("Please enter an observation date between 1 Jan 2010 and today.");
           // document.getElementById("eobdate"+Editdatetxtbxno).focus();
           // return false
            return 1;
        }
        //check month
        if (strMonth.length<1 || imonth<1 || imonth>12 )
        {
            alert("Please check the entered month.Enter an observation date between 2010-01-01 and today.");
           // document.getElementById("eobdate"+Editdatetxtbxno).focus();
           // return false;
             return 1;
        }
        //check dates
         if (strDate.length<1 || iday<1 || iday>31 || (imonth==2 && iday>daysInFebruary(iyear)) || iday > daysInMonth[imonth] )
         {
            alert("Please check the date with valid month.Enter an observation date between 2010-01-01 and today. ");
            //document.getElementById("eobdate"+Editdatetxtbxno).focus();
            //return false;
             return 1;
         }
        }
        return 0;
        

}
function UpdateObservation(id)
{
   
    var dtCh= "-";
    re = /^\d{4}\-\d{2}\-\d{2}$/;
    var dataString = "tree_id="+id;
    dataString += "&update=true";
    var Next=document.getElementById('emypageval').value;
    dataString += "&mypageval="+Next;
    dataString += "&datano="+document.getElementById('edatano').value;
    dataString += "&Totalob="+document.getElementById('eTotalob').value;
    var startIndex= document.getElementById('startIndex').value;
    var endIndex= document.getElementById('endIndex').value;
    dataString += "&startindex="+startIndex;
    dataString += "&endindex="+endIndex;
      for (i=startIndex;i<=endIndex;i++)
     {
         
       //ObID
         dataString +="&";
         dataString += document.getElementById("ObserID"+i).name;
         dataString +="=";
         dataString += document.getElementById("ObserID"+i).value;
         //date.
         dataString +="&";
         dataString += document.getElementById("eobdate"+i).name;
         dataString +="=";
         dataString += document.getElementById("eobdate"+i).value;
         
       if(!$('#eobdate'+i).attr('value').match(re) ) 
        {
            alert("Invalid date format.Enter the date in yyyy-mm-dd format.");
            document.getElementById("obdate1").focus();
            return false;
        }
        else
        {
            // This validation is done assuming yyyy-mm-dd
            var CurrentDate = new Date();
            var iCurmonth= parseInt(CurrentDate.getMonth())+1;
            var iCurDay=parseInt(CurrentDate.getDate());
            var iCurYear=parseInt(CurrentDate.getFullYear());
            var daysInMonth = DaysArray(12);
            var sdate = document.getElementById("eobdate"+i).value //user entered date 
            var pos1=sdate.indexOf(dtCh);
            var strYear=sdate.substring(0,pos1);//year
            sdate= sdate.substring((pos1+1),(sdate.length));
            var pos2=sdate.indexOf(dtCh)
            var strMonth= sdate.substring(0,pos2);//month
            if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
            var strDate= sdate.substring((pos2+1),(sdate.length));// date
            if (strDate.charAt(0)=="0" && strDate.length>1) strDate=strDate.substring(1);
            var imonth=parseInt(strMonth);
            var iday=parseInt(strDate);
            var iyear=parseInt(strYear);
            var iConCurrentdate= iCurYear*10000+iCurmonth*100+iCurDay;
            var iUserdate= iyear*10000+imonth*100+iday;
            if (iUserdate > iConCurrentdate)
            {
                alert("Observation dates in the future are not allowed. Please enter an observation date between 1 Jan 2010 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            if (iUserdate < 20100101)
            {
                alert("Please enter an observation date between 1 Jan 2010 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            //check month
            if (strMonth.length<1 || imonth<1 || imonth>12 )
            {
                alert("Please check the entered month.Enter an observation date between 2010-01-01 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            //check dates
             if (strDate.length<1 || iday<1 || iday>31 || (imonth==2 && iday>daysInFebruary(iyear)) || iday > daysInMonth[imonth] )
             {
                alert("Please check the date with valid month.Enter an observation date between 2010-01-01 and today. ");
                document.getElementById("eobdate"+i).focus();
                return false;
             }
        }
         //check for radio button values
         dataString +="&";
         dataString +="efreshleave" +i +"=";
         dataString += $('#efreshleave' + i +':checked').val();
         dataString +="&";
         dataString +="ematureleave" +i +"=";
         dataString += $('#ematureleave' + i +':checked').val();
         dataString +="&";
         dataString +="cbud" +i +"=";
         dataString += $('#cbud' + i +':checked').val();
         dataString +="&";
         dataString +="obud" +i +"=";
         dataString += $('#obud' + i +':checked').val();
         dataString +="&";
         dataString +="unripe" +i +"=";
         dataString += $('#unripe' + i +':checked').val();
         dataString +="&";
         dataString +="ripe" +i +"=";
         dataString += $('#ripe' + i +':checked').val();
        if(document.getElementById("cat"+i).checked)
        {
            dataString += "&leaf_caterpillar";
            dataString += +i;
            dataString += "=1";
        }
        else {
            dataString += "&leaf_caterpillar";
            dataString += +i;
            dataString += "=";
        }
        if(document.getElementById("but"+i).checked)
        {
        //dataString += "&flower_butterfly=1";
        dataString += "&flower_butterfly";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&flower_butterfly=";
        dataString += "&flower_butterfly";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("bee"+i).checked)
        {
        //dataString += "&flower_bee=1";
        dataString += "&flower_bee";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString +="&flower_bee=";
        dataString += "&flower_bee";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("monkey"+i).checked)
        {
        //dataString += "&fruit_monkey=1";
        dataString += "&fruit_monkey";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&fruit_monkey=";
        dataString += "&fruit_monkey";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("bird"+i).checked)
        {
        //dataString +="&fruit_bird=1";
        dataString += "&fruit_bird";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&fruit_bird=";
        dataString += "&fruit_bird";
        dataString += +i;
        dataString += "=";
        }
        //alert(dataString);
     //}
    }
       
        dataString += "&update=true";
        dataString += "&refresh=1";
		 var editstatus=document.getElementById('editstatus').value;
        dataString +="&editstatus="+editstatus;
       if (document.getElementById('editstatus').value=="1")
        {
            $.ajax({
            type: "POST",
            url: "gspeditobservation.php",
            data: dataString,
            success: function(data){
            $('.edit_success').fadeIn(200).show();
            $('.error1').fadeOut(200).hide();
            window.setTimeout("$('dialog_edit_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.edit_success').css('display','inline');window.location.reload(true);", 2000);

                //document.getElementById('dialog_edit_obs').innerHTML=data;
            }
             });
        }
 }

function NextObserv(id)
{
    
    var dtCh= "-";
    re = /^\d{4}\-\d{2}\-\d{2}$/;
    var dataString = "tree_id="+id;
    dataString += "&update=true";
    var Next=document.getElementById('emypageval').value;
    //alert(Next);
    Next++;
    dataString += "&mypageval="+Next;
    dataString += "&datano="+document.getElementById('edatano').value;
    dataString += "&Totalob="+document.getElementById('eTotalob').value;
    var startIndex= document.getElementById('startIndex').value;
    var endIndex= document.getElementById('endIndex').value;
    dataString += "&startindex="+startIndex;
    dataString += "&endindex="+endIndex;
    //alert(dataString);
     for (i=startIndex;i<=endIndex;i++)
     {
       //ObID
         dataString +="&";
         dataString += document.getElementById("ObserID"+i).name;
         dataString +="=";
         dataString += document.getElementById("ObserID"+i).value;
         //date.
         dataString +="&";
         dataString += document.getElementById("eobdate"+i).name;
         dataString +="=";
         dataString += document.getElementById("eobdate"+i).value;
         
        if(!$('#eobdate'+i).attr('value').match(re) ) 
        {
            alert("Invalid date format.Enter the date in yyyy-mm-dd format.");
            document.getElementById("obdate1").focus();
            return false;
        }
        else
        {
            // This validation is done assuming yyyy-mm-dd
            var CurrentDate = new Date();
            var iCurmonth= parseInt(CurrentDate.getMonth())+1;
            var iCurDay=parseInt(CurrentDate.getDate());
            var iCurYear=parseInt(CurrentDate.getFullYear());
            var daysInMonth = DaysArray(12);
            var sdate = document.getElementById("eobdate"+i).value //user entered date 
            var pos1=sdate.indexOf(dtCh);
            var strYear=sdate.substring(0,pos1);//year
            sdate= sdate.substring((pos1+1),(sdate.length));
            var pos2=sdate.indexOf(dtCh)
            var strMonth= sdate.substring(0,pos2);//month
            if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
            var strDate= sdate.substring((pos2+1),(sdate.length));// date
            if (strDate.charAt(0)=="0" && strDate.length>1) strDate=strDate.substring(1);
            var imonth=parseInt(strMonth);
            var iday=parseInt(strDate);
            var iyear=parseInt(strYear);
            var iConCurrentdate= iCurYear*10000+iCurmonth*100+iCurDay;
            var iUserdate= iyear*10000+imonth*100+iday;
            if (iUserdate > iConCurrentdate)
            {
                alert("Observation dates in the future are not allowed. Please enter an observation date between 1 Jan 2010 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            if (iUserdate < 20100101)
            {
                alert("Please enter an observation date between 1 Jan 2010 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            //check month
            if (strMonth.length<1 || imonth<1 || imonth>12 )
            {
                alert("Please check the entered month.Enter an observation date between 2010-01-01 and today.");
                document.getElementById("eobdate"+i).focus();
                return false;
            }
            //check dates
             if (strDate.length<1 || iday<1 || iday>31 || (imonth==2 && iday>daysInFebruary(iyear)) || iday > daysInMonth[imonth] )
             {
                alert("Please check the date with valid month.Enter an observation date between 2010-01-01 and today. ");
                document.getElementById("eobdate"+i).focus();
                return false;
             }
        }
         //check for radio button values
         dataString +="&";
         dataString +="efreshleave" +i +"=";
         dataString += $('#efreshleave' + i +':checked').val();
         dataString +="&";
         dataString +="ematureleave" +i +"=";
         dataString += $('#ematureleave' + i +':checked').val();
         dataString +="&";
         dataString +="cbud" +i +"=";
         dataString += $('#cbud' + i +':checked').val();
         dataString +="&";
         dataString +="obud" +i +"=";
         dataString += $('#obud' + i +':checked').val();
         dataString +="&";
         dataString +="unripe" +i +"=";
         dataString += $('#unripe' + i +':checked').val();
         dataString +="&";
         dataString +="ripe" +i +"=";
         dataString += $('#ripe' + i +':checked').val();
        if(document.getElementById("cat"+i).checked)
        {
            dataString += "&leaf_caterpillar";
            dataString += +i;
            dataString += "=1";
        }
        else {
            dataString += "&leaf_caterpillar";
            dataString += +i;
            dataString += "=";
        }
        if(document.getElementById("but"+i).checked)
        {
        //dataString += "&flower_butterfly=1";
        dataString += "&flower_butterfly";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&flower_butterfly=";
        dataString += "&flower_butterfly";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("bee"+i).checked)
        {
        //dataString += "&flower_bee=1";
        dataString += "&flower_bee";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString +="&flower_bee=";
        dataString += "&flower_bee";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("monkey"+i).checked)
        {
        //dataString += "&fruit_monkey=1";
        dataString += "&fruit_monkey";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&fruit_monkey=";
        dataString += "&fruit_monkey";
        dataString += +i;
        dataString += "=";
        }
         if(document.getElementById("bird"+i).checked)
        {
        //dataString +="&fruit_bird=1";
        dataString += "&fruit_bird";
        dataString += +i;
        dataString += "=1";
        }
        else {
        //dataString += "&fruit_bird=";
        dataString += "&fruit_bird";
        dataString += +i;
        dataString += "=";
        }
     }
    //alert(dataString);
	var editstatus=document.getElementById('editstatus').value;
        dataString +="&editstatus="+editstatus;
    $.ajax({
    type: "POST",
    url: "gspeditobservation.php",
    data: dataString,
    success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
        document.getElementById('editstaus').value=0;
    }
    });

        //$("#obdate1").datepicker({minDate: -180, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
        //alert($("#obdate1").attr('value'));
        var maskHeight = $(document).height();

        var maskWidth = $(window).width();

        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});

        //transition effect		
        $('#mask').fadeIn(1000);	
        $('#mask').fadeTo("slow",0.8);	

        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        $('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
        $('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);

        //transition effect
        $('#dialog_edit_obs').fadeIn(2000); 
};

</script>
<script type="text/javascript" >

function PrevObserv(id) {
		var dataString = "tree_id="+id;
                var Prev=document.getElementById('emypageval').value;
                
                Prev--;
                dataString += "&mypageval="+Prev;;
                dataString += "&datano="+document.getElementById('edatano').value;
                 dataString += "&Totalob="+document.getElementById('eTotalob').value;
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "gspeditobservation.php",
		data: dataString,
		success: function(data){
		document.getElementById('dialog_edit_obs').innerHTML=data;
                document.getElementById('editstaus').value=0;
           	}
		});

		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
		$('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
	
		//transition effect
		$('#dialog_edit_obs').fadeIn(2000); 
};	

</script>


</head>

    <!-- main body of the dashseed-->
<body>
    <!--  start header  -->
    <?php include ("includes/header.php"); ?>
    
    <!--  start body_content  -->
    <div class="wrapper">
    <div class="body_content_2">
        <div class="body_top">
            <div class="main">
                <div class="container">
                    <!-- MyTrees and Add a Tree section-->
                    <div class="mytree">My Trees</div>
                    <div id="lightTwo" class="white_contentTwo">
                        <a href = "javascript:void(0)" onclick = "document.getElementById('lightTwo').style.display='none';document.getElementById('fadeOne').style.display='none'"><img src="images/closeone.png" alt="close" /></a>
                    </div>
                        <div class="addtree"><a href = "javascript:void(0)" name="openAddTreeModal">Add a tree</a></div>
                  </div>
             </div>
        </div> <!-- end div of body_top which includes Add tree heading-->
        <!--Add Tree modal ends-->
         <input type="hidden" name="user_id" id="user_id" value="<? echo $_SESSION['userid']; ?>"  />
           <!-- List out all the trees by the user-->
       <?
        //to get no trees for logged in user
        $group_trees = mysql_query("SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id, members_assigned, trees.tree_Id as tid, user_tree_id 
        FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[userid]' and trees.deleted='0') 
        ON species_master.species_id = trees.species_id ORDER BY species_master.species_id ASC");
        $i=0;
        $num_trees = mysql_num_rows($group_trees);       
        
        if ($num_trees>0)
        {
        while ($group_trees_row = mysql_fetch_array($group_trees)) 
        { ?>
                <input type="hidden" id="species_id" value="<? echo $group_trees_row[species_id]; ?>" />
                <? $result = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$group_trees_row[species_id]'");
                $image_names = mysql_fetch_array($result);
                $treeIDAr[$i]=$group_trees_row['tid'];
                if ($image_names !='')
                {
                    $species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
                    // replace .jpg into .png
                    $species_pic1 = str_replace(".jpg",".png",$species_pic1);
                    //echo $species_pic1;
                    $th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
                    ?>
                    <!--  start body_content  -->
                    <div class="body_top">
                        <div class="main">
                            <div class="container">
                            <!-- Get the list of trees from the database-->
                                    <div class="flowerleftbox">
                                        <!-- Tree Image & Tree Name-->
                                        <?if (file_exists($th_picname)) {?>
                                         <blockquote><img src="<? echo $th_picname; ?>" alt="<?echo $image_names['file_name'] ?>" title=""/></blockquote>
                                         <?}
                                         else
                                         {?><blockquote><img src="images/noimage.jpg" width="60" height="60" alt="No Image" title=""/></blockquote>
                                         <?}?>
                                    </br>
                                    <div title="<?echo ucfirst(strtolower($group_trees_row['tree_nickname']))?>" ><strong>
                                    <? $pattern="..";
                                    $alttreenickname="";
                                    if  (strlen($group_trees_row['tree_nickname']) > 15)
                                    //echo $_SESSION['fullname'];
                                    $alttreenickname=  rtrim(substr($group_trees_row['tree_nickname'], 0, 15)) . $pattern; 
                                    else 
                                    $alttreenickname=$group_trees_row['tree_nickname'];
                                    echo ucfirst(strtolower($alttreenickname));?></strong></div>
                                    <div title="<?echo $group_trees_row['species_primary_common_name']?>"><h5>
                                    <?$malayamname = $group_trees_row['species_primary_common_name'];
                                    if  (strlen($malayamname) > 15)
                                    { $altcmnname=  rtrim(substr($malayamname, 0, 15)) . $pattern;} 
                                    else 
                                    {$altcmnname=$malayamname;}
                                    echo ucfirst(strtolower($altcmnname));?></h5></div>
                                    <div title="<?echo ucfirst(strtolower($group_trees_row['species_scientific_name']))?>"><h5><i>
                                    <?echo ucfirst(strtolower($group_trees_row['species_scientific_name']));?></strong>
                                    </i></h5></div>
                                    </div>
									 <? $qObcnt="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='$group_trees_row[user_tree_id]' and user_id='$_SESSION[userid]' and deleted='0'";
                                    $observationscnt=mysql_query($qObcnt) or die (mysql_error());
                                    $noofobservationscnt=mysql_num_rows($observationscnt);
                                    //echo $noofobservations;
                                     ?>
                                   <!-- start Graph Section-->
                                    <div class="middlebox">
									<? if ($noofobservationscnt>0){?> 
                                    <table width="673" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td>
                                    <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                                    <tr>
                                    <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">LEAVES</blockquote></td>
                                    <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><blockquote style="width:60px;">Fresh</blockquote></td>
                                    </tr>
                                    <tr>
                                    <td><blockquote style="width:60px;">Mature</blockquote></td>
                                    </tr>
                                    </table>
                                    </td>
                                     <!-- Leaves-->
                                    <?for ($k =0; $k <count($mondays); $k++) 
                                    {
                                        $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                        if ($k==0)
                                        {
                                        $start_date=strtotime('last monday', $end_date);
                                        }
                                        else
                                        {
                                        $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                        }
                                        /* to get the observation between the dates*/
                                        $qOb="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='$group_trees_row[user_tree_id]' and user_id='$_SESSION[userid]' and deleted='0' and date>'".$start_date . "' AND date<='" . $end_date . "'ORDER BY date DESC";
                                        //echo $qOb;
                                        $observations=mysql_query($qOb) or die (mysql_error());;
                                        $noofrowcol=mysql_num_rows($observations);
                                        //echo $noofrowcol;
                                        
                                         if($noofrowcol > 0 )
                                        {  list($observation_id,$date,$freshleaf_count,$matureleaf_count,$bud_count,$open_flower_count,$fruit_ripe_count,$fruit_unripe_count) = mysql_fetch_row($observations);
                                            ?>
                                            <td style="width:71px;height:51px;vertical-align:middle;">
                                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                <td>
                                                <?  switch ($freshleaf_count)
                                                {
                                                    case "0":
                                                    ?>
                                                    <img src="images/icon_none.png" title="None">
                                                    <? break;
                                                    case "1":?>
                                                    <img src="images/icon_fresh_few.png" title="Few">
                                                    <?break;
                                                    case "2":?>
                                                    <img src="images/icon_fresh_many.png" title="Many">
                                                    <?break;
                                                    case "-1":?>
                                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                                    <?break;
                                                }    ?>    
                                                </td>
                                                </tr>
                                                <tr>
                                                <td>
                                                <?   switch ($matureleaf_count)
                                                {
                                                    case "0":
                                                    ?>
                                                    <img src="images/icon_none.png" title="None">
                                                    <? break;
                                                    case "1":?>
                                                    <img src="images/icon_mature_few.png" title="Few">
                                                    <?break;
                                                    case "2":?>
                                                    <img src="images/icon_mature_many.png" title="Many">
                                                    <?break;
                                                    case "-1":?>
                                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                                    <?break;
                                                } ?> 
                                                </td>
                                                </tr>
                                            </table>
                                            </td>
                                            <?}
                                            else
                                        {?>
                                            <td style="width:71px;height:51px;vertical-align:middle;">
                                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                            <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                            </tr>
                                            <tr>
                                            <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                            </tr>
                                            </table>
                                            </td>
                                        <?}
                                    }
                                    ?>
                            <!-- Flowers-->
                            <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                            <tr>
                            <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">FLOWERS</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                            <td><blockquote style="width:60px;">Bud</blockquote></td>
                            </tr>
                            <tr>
                            <td><blockquote style="width:60px;">Open</blockquote></td>
                            </tr>
                            </table>
                            </td>
                            <?for ($k =0; $k <count($mondays); $k++) 
                            {
                                $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                if ($k==0)
                                {
                                $start_date=strtotime('last monday', $end_date);
                                }
                                else
                                {
                                $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                }
                                $qOb="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                user_tree_id ='$group_trees_row[user_tree_id]' and user_id='$_SESSION[userid]' and deleted='0' and date>'".$start_date . "' AND date<='" . $end_date . "'ORDER BY date DESC";
                                //echo $qOb;
                                $observations=mysql_query($qOb) or die (mysql_error());;
                                $noofrowcol=mysql_num_rows($observations);
                                //echo $noofrowcol;
                               
                                if($noofrowcol > 0)
                                {  list($observation_id,$date,$freshleaf_count,$matureleaf_count,$bud_count,$open_flower_count,$fruit_ripe_count,$fruit_unripe_count) = mysql_fetch_row($observations);
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <?  switch ($bud_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_flower_bud_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_flower_bud_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                <?} ?>    
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?   switch ($open_flower_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_flower_open_few.png" title="Few"> 
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_flower_open_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                    <?break;
                                } ?> 
                                </td>
                                </tr>
                                </table>
                                </td>
                            <? }
                            else 
                                {?>
                                    <td style="width:71px;height:51px;vertical-align:middle;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                            }?>
                            </tr>
                            </tr>
                            </table> 
                            <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">
                            <tr>
                            <td style="width:92px;height:51px;vertical-align:middle;text-align:center;color:#000080;font-size:18px;"><blockquote style="width:92px;">FRUIT</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px; font-size:15px;  text-align:right;">
                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                            <td><blockquote style="width:60px;">Unripe</blockquote></td>
                            </tr>
                            <tr>
                            <td><blockquote style="width:60px;">Ripe</blockquote></td>
                            </tr>
                            </table>
                            </td>
                            <?for ($k =0; $k <count($mondays); $k++) 
                            {
                                $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                if ($k==0)
                                {
                                    $start_date=strtotime('last monday', $end_date);
                                }
                                else
                                {
                                    $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                }
                                $qOb="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                user_tree_id ='$group_trees_row[user_tree_id]' and user_id='$_SESSION[userid]' and deleted='0' and date>'".$start_date . "' AND date<='" . $end_date . "'ORDER BY date DESC";
                                //echo $qOb;
                                $observations=mysql_query($qOb) or die (mysql_error());;
                                $noofrowcol=mysql_num_rows($observations);
                                // echo $noofrowcol;
                                
                                 if($noofrowcol > 0)
                                {  list($observation_id,$date,$freshleaf_count,$matureleaf_count,$bud_count,$open_flower_count,$fruit_ripe_count,$fruit_unripe_count) = mysql_fetch_row($observations);
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <?//unripe  
                                switch ($fruit_unripe_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_fruit_unripe_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_fruit_unripe_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                    <?break;
                                }?>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?
                                switch ($fruit_ripe_count)
                                {
                                    case "0":
                                    ?>
                                    <img src="images/icon_none.png" title="None">
                                    <? break;
                                    case "1":?>
                                    <img src="images/icon_fruit_ripe_few.png" title="Few">
                                    <?break;
                                    case "2":?>
                                    <img src="images/icon_fruit_ripe_many.png" title="Many">
                                    <?break;
                                    case "-1":?>
                                    <img src="images/icon_dontknow.png" title="Don't know.">
                                    <?break;
                                    ?>                                  
                                <? }?>
                                </td>
                                </tr>
                                </table>
                                </td>
                                <?}
                                else
                                {?>
                                    <td style="width:71px;height:51px;vertical-align:middle;">
                                    <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                                }?>
                            </tr>
                            </tr>
                            </table>  
                            <!-- Date display-->
							<table width="673" border="0" cellspacing="0" cellpadding="0" >
                           <!-- <table width="673" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #d1d1d1;">-->
                            <tr>
                            <td style="height:51px;vertical-align:middle;text-align:center;color:#666666;font-size:14px;"><blockquote style="width:92px;">Week starting</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px;"><blockquote style="width:60px;">&nbsp;</blockquote></td>
                                <?for ($k =0; $k <count($mondays); $k++) 
                                {
                                $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                
                                if ($k==0)
                                {
                                   $start_date=strtotime('last monday', $end_date);
                                   
                                  //$start=strtotime('last monday', $end_date);
                                   // echo $start_date;
                                    // $nxtmonday= date('Y-m-d', strtotime('last monday'));
                                    //$start_date=date('Y-m-d',strtotime($mondays[$k-1]));
                                    //echo 'last monday :  '.date("Y-m-d",strtotime($day." last monday "));
                                }
                                else
                                {
                                    $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                }
								$monthdateformat = date('j-M',strtotime($mondays[$k]));
                               ?>
								<td style="width:71px;height:51px;vertical-align:middle;"><blockquote style="width:71px;text-align:center;color:#666666; font-size:13px;"><?echo $monthdateformat;?></<blockquote></td>
                                <?}?>   
                                </tr>
                                </table>
                                </td>
                                </tr>
                                </table>
								<?}else{?>
                                        <div class="link">You don't have any observations yet. Please <a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);">Add Observation.</a></div>
                                        <?}?>
                                </div>                                 
                                    <!-- end Graph Section-->
                                     <div class="add_tree_icon">
                                        <ul>
                                           <!-- <li><a href="#dialog_add_obs<?echo $i;?>" name="modal" title="Add/Edit Observation" onclick="window.scrollTo(0, 0);"><img src="images/add_observation.png" alt=""  title="Add/Edit Observation." /></a></li>-->
                                                <li class="popup"><a href="<?echo $treeIDAr[$i],$th_picname?>" title="Tree information"><img src="images/expand.png" alt="" /></a></li>
                                               
                                                <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/add_observation.png" alt=""  title="Add Observation." /></a></li>
                                               <?if ($noofobservationscnt>'0'){?>
											    <li><a href="javascript:void(0)" title="Edit Observations" onclick="document.getElementById('lightOne<?echo $i;?>').style.display='none';edit_obs_load('addobser',<?echo $treeIDAr[$i]?>,<?echo $i?>,0,0)"/><img src="images/pencil.png" alt="no"></img></a></li>
                                                
                                               <!-- <li><a href="javascript:void(0)" title="Edit Observations" onclick="edit_obs_load('addobser',<?echo $treeIDAr[$i]?>,<?echo $i?>,0,0); window.scrollTo(0, 0);"/><img src="images/pencil.png"  title="Edit Observation."></img></a></li>-->
                                               <?}?>
                                                
                                        </ul>
                                    </div>
                                <?php include ("gsptreeinfo.php"); ?>
                                    
                                </div> <!-- Div of container body-->
                        </div> <!-- Div of Main body -->
                    </div>  <!-- Div of Body top-->
                    <?
                    $i++;
                 }			
            }}
            else
            {?>
            <div class="Notreemsg">Welcome to SeaonWatch-GSP Programme. You don't have any trees yet.<br>
			  Please <a href = "javascript:void(0)" name="openAddTreeModal">Add a Tree</a>.</div>
            <? }?>                   
 </div>
</div>
</div>
</div>
       

    <div id="fadeOne" class="black_overlayOne"></div>
    
    
     <!-- Add Observation Modal-->
        <?  for ($j=0;$j<=count($treeIDAr);$j++) {?>
        <div id="lightOne<?echo $j;?>" class="white_contentOne">      
        <?php 
        include ("addobservation.php"); 
        ?>
        </div>
        <?}?>
        <!--MODAL TREE INFO STARTS-->
        <div id="lightFour" class="white_contentThree">
        <?php include ("gsptreesadd.php");
		?>
        </div>
        
        
    <!--/Edit observation modal ends-->
    <div id="dialog_edit_obs" class="window treeModal">
        
</div>
    <div id="mask"></div>
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->

</body>
</html>
