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
	    
include 'includes/main_includes.php';
include 'includes/Observation.php';
include 'includes/dates.php';
$dbc=Dbconn::getdblink();
$tob = unserialize($_SESSION['tob']);

$treeno=  $_SESSION['NoTrees'];
$_SESSION['tno']=0; 
$userbrowser = $_SESSION['browser'];

if(isset($_SESSION['msg']['addobserr']))
{
	//alert("set!");
	$res_text=$_SESSION['msg']['addobserr'];
	$string_array = explode(",",$res_text);
	$i=$string_array[1];
	$_SESSION['msg']['addobserr']=$string_array[0];
	echo "<script type='text/javascript'>
		alert(".$string_array[0].");
    	    				$(document).ready(function(){
		                  document.getElementById('lightOne".$i."').style.display='block';
                          document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);
    	    				});
    	    				
                           </script>";
	
	unset($_SESSION['msg']['addobserr']);
}

?> 

<script type="text/javascript" >
function ApplyOverlayOverScreen(isApply) {
	 if (isApply) {
	$('#overlay').show();
	$('#box').show();
	$('#box').animate({ 'top': '45%' });
	}
	 else {
	$('#box').hide();
	$('#overlay').hide();
	}
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
nick_name = document.getElementById("tree_nickname").value;

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

//alert("in validate2xx"+"xx"+nick_name+"yy");


if(nick_name == '' )
{
	alert("Please enter a nickname");
	document.getElementById("tree_nickname").focus();
	return false;
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
/*
if($('#tree_code_sms').attr('value')=='')
{
	alert("Please choose the tree sequence number");
	document.getElementById("tree_code_sms").focus();
	return false;
}
*/
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
        dataString += "&members_assigned="+$('#studentname').attr('value');
        dataString += "&latitude="+$("#lat").val();
        dataString += "&longitude="+$("#lng").val();
        dataString += "&locationname="+$("#loc_name").val();
        dataString += "&stateid="+$("#state").val();
        dataString += "&locationcity="+$("#city").val();
        dataString += "&zoomval="+$('#zoom').val();
        dataString += "&species_id="+document.getElementById('selspecies_id').value;
       
       // selspecies_id
        //alert(dataString);
        $.ajax({
	type: "POST",
	url: "addnewtree.php",
	data: dataString,
	success: function(data){
        //alert(data);
	window.setTimeout("$('#dialog_add_tree').fadeOut(1000);$('#mask').fadeOut(500);window.location.reload(true);", 2000);
	}
	});
//document.getElementById("addtree").submit();
return true;
}
</script>





<script type="text/javascript">
    function validate_addobser()
    {
    alert("validate");   
    /*var freshleave = $('input:radio[name=l1]:checked').val();
    alert(freshleave);
    if (freshleave == undefined ) 
      {  
            document.getElementById('dateerrormsg').innerHTML="Please select the Leaves Fresh option.";
           return false;
       }*/
       var dataString = "obdate="+$('#obdate').attr('value');
      //  dataString += "&treeid="+$('#tree_id').attr('value');
        alert(dataString);
        if (dataString=="")
        {
            document.getElementById("dateerrormsg").value="please ";
            document.getElementById("obdate").focus();
            return false;
        }
        var freshleave = $('input:radio[name=l1]:checked').val();
        if (freshleave == undefined ) 
        {  
            //alert("Please select the Leaves Fresh option.");
             document.getElementById('dateerrormsg').innerHTML="Please select the Leaves Fresh option.";
            return false;
        }
        if ($('input:radio[name=l1]:checked').val()==0)
        {
        dataString += "&is_leaf_fresh=0&freshleaf_count=0";
        } else if ($('input:radio[name=l1]:checked').val()==1) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=1";
        } else if ($('input:radio[name=l1]:checked').val()==2) {
        dataString += "&is_leaf_fresh=1&freshleaf_count=2";
        } else if ($('input:radio[name=l1]:checked').val()==-1) {
        dataString += "&is_leaf_fresh=-1&freshleaf_count=-1";
        }
         alert(dataString);
        var matureleave = $('input:radio[name=l2]:checked').val();
        if (matureleave == undefined ) 
        {  
            //alert("Please select the Leaves Mature option.");
            document.getElementById('dateerrormsg').innerHTML="Please select the Leaves Mature option.";
            return false;
        }
    if ($('input:radio[name=l2]:checked').val()==0)
    {
    dataString += "&is_leaf_mature=0&matureleaf_count=0";
    } else if (matureleave==1) {
    dataString += "&is_leaf_mature=1&matureleaf_count=1";
    } else if (matureleave==2) {
    dataString += "&is_leaf_mature=1&matureleaf_count=2";
    } else if (matureleave==-1) {
    dataString += "&is_leaf_mature=-1&matureleaf_count=-1";
    }
       alert(dataString);  
        var flowerBud = $('input:radio[name=f1]:checked').val();
        if (flowerBud == undefined ) 
        {  
            //alert("Please select the Flower Bud option.");
             document.getElementById('dateerrormsg').innerHTML="Please select the Flower Bud option.";
            return false;
        }
        if ($('input:radio[name=f1]:checked').val()==0)
        {
        dataString += "&is_flower_bud=0&bud_count=0";
        } else if ($('input:radio[name=f1]:checked').val()==1) {
        dataString += "&is_flower_bud=1&bud_count=1";
        } else if ($('input:radio[name=f1]:checked').val()==2) {
        dataString += "&is_flower_bud=1&bud_count=2";
        } else if ($('input:radio[name=f1]:checked').val()==-1) {
        dataString += "&is_flower_bud=-1&bud_count=-1";
        }
         alert(dataString);
        var floweropen = $('input:radio[name=f2]:checked').val();
        if (floweropen == undefined ) 
        {  
            //alert("Please select the Leaves Mature option.");
             document.getElementById('dateerrormsg').innerHTML="Please select the Flower Open option.";
            return false;
        }
        if ($('input:radio[name=f2]:checked').val()==0)
        {
        dataString += "&is_flower_open=0&open_flower_count=0";
        } else if ($('input:radio[name=f2]:checked').val()==1) {
       dataString += "&is_flower_open=1&open_flower_count=1";
        } else if ($('input:radio[name=f2]:checked').val()==2) {
      dataString += "&is_flower_open=1&open_flower_count=2";
        } else if ($('input:radio[name=f2]:checked').val()==-1) {
       dataString += "&is_flower_open=-1&open_flower_count=-1";
        }
         alert(dataString);
        var fruitsunripe = $('input:radio[name=fr1]:checked').val();
        if (fruitsunripe == undefined ) 
        {  
            //alert("Please select the Fruits Unriped option.");
             document.getElementById('dateerrormsg').innerHTML="Please select the Fruits Unriped option.";
            return false;
        }
        if ($('input:radio[name=fr1]:checked').val()==0)
        {
        dataString += "&is_fruit_unripe=0&fruit_unripe_count=0";
        } else if ($('input:radio[name=fr1]:checked').val()==1) {
        dataString += "&is_fruit_unripe=1&fruit_unripe_count=1";
        } else if ($('input:radio[name=fr1]:checked').val()==2) {
       dataString += "&is_fruit_unripe=1&fruit_unripe_count=2";
        } else if ($('input:radio[name=fr1]:checked').val()==-1) {
        dataString += "&is_fruit_unripe=-1&fruit_unripe_count=-1";
        }
         alert(dataString);
        var fruitsripe = $('input:radio[name=fr2]:checked').val();
        if (fruitsripe == undefined ) 
        {  
            //alert("Please select the Fruits Unriped option.");
             document.getElementById('dateerrormsg').innerHTML="Please select the Fruits riped option.";
            return false;
        }
        if ($('input:radio[name=fr2]:checked').val()==0)
        {
        dataString += "&is_fruit_ripe=0&fruit_ripe_count=0";
        } else if ($('input:radio[name=fr2]:checked').val()==1) {
       dataString += "&is_fruit_ripe=1&fruit_ripe_count=1";
        } else if ($('input:radio[name=fr2]:checked').val()==2) {
        dataString += "&is_fruit_ripe=1&fruit_ripe_count=2";
        } else if ($('input:radio[name=fr2]:checked').val()==-1) {
       dataString += "&is_fruit_ripe=-1&fruit_ripe_count=-1";
        }
         alert(dataString);
        if(document.getElementById('leaf_caterpillar').checked)
{
	dataString += "&leaf_caterpillar=1";
}
else {
	dataString += "&leaf_caterpillar=";
}
if(document.getElementById('flower_butterfly').checked)
{
	dataString += "&flower_butterfly=1";
}
else {
	dataString += "&flower_butterfly=";
}
if(document.getElementById('flower_bee').checked)
{
	dataString += "&flower_bee=1";
}
else {
	dataString += "&flower_bee=";
}
if(document.getElementById('fruit_bird').checked)
{
	dataString += "&fruit_bird=1";
}
else {
	dataString += "&fruit_bird=";
}
if(document.getElementById('fruit_monkey').checked)
{
	dataString += "&fruit_monkey=1";
}
else {
	dataString += "&fruit_monkey=";
}

ApplyOverlayOverScreen(true);

  return true;      
        //alert(dataString);
      /*  $.ajax({
type: "POST",
url: "updatenewobservation.php",
data: dataString,
success: function(data){ 
    alert(data);
    if (data =='date exits')
    {
       $('#msg').val('date exist');
         $('.sucess').fadeIn(200).hide();
        $('.errormsg').fadeOut(200).show();
        //window.setTimeout("$('#dialog_add_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.error1').css('display','none');window.location.reload(true);", 2000);
        return false;

    }
    else
        {
         document.getElementById('lightseven').style.display='none';
         document.getElementById('fadeOne').style.display='none';   
        //$('.success').html(data);
        //$('.sucess').fadeIn(200).show();
        //$('.errormsg').fadeOut(200).hide();
        //window.setTimeout("$('#dialog_add_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
        }
   return true;    
}
});*/
    }     
function add_observation(treeno,treeid)
{
    alert(treeno);
    alert(treeid);
    
    var dataString = "tree_id="+treeid;
    dataString += "&tree_no="+treeno;
       $.ajax({
        type: "POST",
        url: "addnewobservation2.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_add_obs').innerHTML=data;
        }});
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
        //$('#dialog_add_obs').css('top',  100);
        $('#dialog_add_obs').css('left', winW/2-$('#dialog_add_obs').width()/2);
        //transition effect
        $('#dialog_add_obs').fadeIn(2000); 
        
    
}
function edit_observation(treeno,treeid)
{
    
       var dataString = "treeid="+treeid;
       dataString += "&tree_no="+treeno;
       $.ajax({
        type: "POST",
        url: "editobservation.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
        }});
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
       var ubrowser= '<?php echo $userbrowser; ?>';
      
        if (ubrowser== "Mozilla Firefox")
        {
	//alert( winH/2-$('#dialog_edit_obs').height()/2);	
        //$('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
        //$('#dialog_edit_obs').css('left', winW/6-$('#dialog_edit_obs').width()/2); 
 	$('#dialog_edit_obs').css('top',  winH/8-$('#dialog_edit_obs').height()/2);
        $('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);  
        }
        else if (ubrowser== "Google Chrome")
        {
          /*$('#dialog_edit_obs').css('top',  winH/6-$('#dialog_edit_obs').height()/2);
          $('#dialog_edit_obs').css('left', winW/6-$('#dialog_edit_obs').width()/2);*/
	 $('#dialog_edit_obs').css('top',  winH/8-$('#dialog_edit_obs').height()/2);
          $('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
        }
        else if ($userbrowser=="Internet Explorer")
            {
         $('#dialog_edit_obs').css('top',  100);
         $('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
            }
            else
                {
                    $('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
         $('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
                }
        
       // $('#dialog_edit_obs').css('top',  winH/2-$('#dialog_edit_obs').height()/2);
       // $('#dialog_edit_obs').css('top',  100);
        //$('#dialog_edit_obs').css('left', winW/2-$('#dialog_edit_obs').width()/2);
        //transition effect
        $('#dialog_edit_obs').fadeIn(2000); 
    
}
///
function NextObservations(pageno)
{
     var dataString = "page="+pageno;
     dataString += "&treename="+document.getElementById('treename').value;
     dataString += "&noObservations="+document.getElementById('noObservations').value;
     dataString += "&treeid="+document.getElementById('etreeid').value;
     dataString += "&usertreeid="+document.getElementById('usertreeid').value;
     dataString += "&total_pages="+document.getElementById('total_pages').value;
    
       $.ajax({
        type: "POST",
        url: "editobservation.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
        }});
    
    
}
function Changeddate(Editdatetxtbxno,treeid)
    {
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
            { //alert(data);
                if(data!=0)
                {
                   
                    alert("Observation with this data already exits.");
                    document.getElementById("eobdate"+boxno).focus();
                    return false;
                }
                document.getElementById("editrow"+boxno).value=1;
            }
        )
    }
    else
    {
        document.getElementById("eobdate"+boxno).focus();
        return false;
    }
    }
function UpdateObservation(pageno)
{
   
    var dtCh= "-";
    re = /^\d{4}\-\d{2}\-\d{2}$/;
     var dataString = "page="+pageno;
     dataString += "&treename="+document.getElementById('treename').value;
     dataString += "&noObservations="+document.getElementById('noObservations').value;
     dataString += "&treeid="+document.getElementById('etreeid').value;
     dataString += "&usertreeid="+document.getElementById('usertreeid').value;
     dataString += "&total_pages="+document.getElementById('total_pages').value;
     for (i=0;i<=3;i++)
     {
         dataString +="&";
         dataString += document.getElementById("editrow"+i).name;
         dataString +="=";
         dataString += document.getElementById("editrow"+i).value;
        if (document.getElementById("editrow"+i).value==1)
         {
       //ObIDdocument.getElementById('etreeid').value
         dataString +="&";
         dataString += document.getElementById("ObserID"+i).name;
         dataString +="=";
         dataString += document.getElementById("ObserID"+i).value;
         
         dataString +="&";
         dataString += document.getElementById("eobdate"+i).name;
         dataString +="=";
         dataString += document.getElementById("eobdate"+i).value;
                
       if(!$('#eobdate'+i).attr('value').match(re) ) 
        {
            alert("Invalid date format.Enter the date in yyyy-mm-dd format.");
            document.getElementById("ObserID"+i).focus();
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
     }
    dataString += "&save=1";
     $.ajax({
        type: "POST",
        url: "editobservation.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
        }});
}

 

function dataedited(rowno)
{
    if (rowno==0)
    {document.getElementById('editrow0').value=1;}
    else if (rowno==1)
    {document.getElementById('editrow1').value=1;}
    else if(rowno==2)
    {document.getElementById('editrow2').value=1;}
    else if (rowno==3)
    {document.getElementById('editrow3').value=1;}
} 

$(document).ready(function()
{  

	ApplyOverlayOverScreen(false);
	
	$('ul.addtreeList li:first ul, .addTreeContainerHolder div.addTreeContainer:first').show();
	$('ul.addtreeList li:first span').addClass('selected');
	$('ul.addtreeList li:first ul li:first blockquote').addClass('selected_2');
        $('div.add_tree_icon ul li.infoclose img').hide();
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
	/*$('.popup a').click(function(e)
	{
		e.preventDefault();
		$('div.add_tree_icon ul li.popup img').hide();
                $('div.add_tree_icon ul li.infoclose img').show();
		$(this).closest('div.body_top').find('.container_2_bottom_area').slideDown('fast');
		$(this).closest('div.body_top').css('background-color', '#fff');
	});*/
	$('.popup a').click(function(e)
	{
		e.preventDefault();
		var src=$(this).children('img').attr('src');
		if (src=="images/expand.png")
               {
		  $(this).children('img').attr("src","images/collapse.png");
		  $(this).closest('div.body_top').find('.container_2_bottom_area').slideDown('fast');
                  $(this).closest('div.body_top').css('background-color', '#fff');
	       }
 	       else if (src=="images/collapse.png") 
               {
                  // $('div.add_tree_icon ul li.popup img').attr("src","images/expand.png");
                   $(this).children('img').attr("src","images/expand.png");
                   $(this).closest('div.body_top').find('.container_2_bottom_area').slideUp('fast');
                   $(this).closest('div.body_top').css('background-color', '#EDEDED'); 
               }

		/*$('div.add_tree_icon ul li.popup img').hide();
                $('div.add_tree_icon ul li.infoclose img').show();
		$(this).closest('div.body_top').find('.container_2_bottom_area').slideDown('fast');
		$(this).closest('div.body_top').css('background-color', '#fff');*/
	});

	/*$('.close a').click(function(e)
	{
                e.preventDefault();
		$('div.add_tree_icon ul li.popup img').show();
                $('div.add_tree_icon ul li.infoclose img').hide();
                $(this).closest('div.body_top').find('.container_2_bottom_area').slideUp('fast');
		$(this).closest('div.body_top').css('background-color', '#EDEDED');
	});*/
        $('a[name=openAddTreeModal]').click(function()
	{
        	
            $('#lightFour').show();
            $('#fadeOne').show().height($('body').height());
            //initialize();
            $(document).scrollTop(0);
		
	});
	$('a[name=itemModal]').click(function(e)
	{
		/*e.preventDefault();
		var toOpenModal = '#'+$(this).attr('href');
                $(toOpenModal).show();
		$('#fadeOne').show().height($('body').height());
		$(document).scrollTop(140);*/
                 $('#lightseven').show();
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
    function setspeciesname(speciesID,name)
    {
        document.getElementById('selspecies_id').value=speciesID;
        document.getElementById('selspecies_name').value=name;
        document.getElementById('tags').value=name;
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
//$('#edit_tree'+id).submit();
 var dataString = "etree_nickname="+$('#etree_nickname'+id).attr('value');
	dataString += "&location_type="+$('#location_type'+id).attr('value');
	dataString += "&etree_height="+$('#etree_height'+id).attr('value');
	dataString += "&etree_girth="+$('#etree_girth'+id).attr('value');
	
	temp=$('input:radio[name=etree_damage'+id+']:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&etree_damage="+temp;
	
	temp=$('input:radio[name=eis_fertilised'+id+']:checked').val();
	if (temp == undefined ) { temp='-1'; }
	dataString += "&eis_fertilised="+temp;
	
	temp=$('input:radio[name=eis_watered'+id+']:checked').val();
	if (temp == undefined ) { temp='-1'; }	
	dataString += "&eis_watered="+temp;
	
	dataString += "&edistance_from_water="+$('#edistance_from_water'+id).attr('value');
	dataString += "&edegree_of_slope="+$('#edegree_of_slope'+id).attr('value');
	dataString += "&easpect="+$('#easpect'+id).attr('value');
	dataString += "&eother_notes="+$('#eother_notes'+id).attr('value');
        dataString += "&studentname="+$('#studentname'+id).attr('value');
        dataString += "&lat="+$("#lat"+id).val();
        dataString += "&lng="+$("#lng"+id).val();
        dataString += "&loc_name="+$("#loc_name"+id).val();
        dataString += "&state_id="+$("#state"+id).val();
        dataString += "&city="+$("#city"+id).val();
        dataString += "&zoom="+$('#zoomval'+id).val();
        dataString += "&selspecies_id="+document.getElementById('selspecies_id'+id).value;
        dataString += "&seltreeid="+document.getElementById('seltreeid'+id).value;

        $.ajax({
        	type: "POST",
        	url: "edittree.php",
        	data: dataString,
        	success: function(data){
        	    alert(data);
        	    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
        	    
        	    }
        	  });
 
//return true;
};
</script>

<!--
This is executed on submitting the Add Observations form.
It validates the data and then passes on values to trackobservations.php in AJAX mode
for adding the observation to the DB.
-->
<script type="text/javascript" >
function checkdateexists(ID,Isusertreeid){
var obsdates="";
var obsexists="false";
var chkobdate= $("#obdate"+ID).attr('value');

document.getElementById("spinner"+ID).style.display='block';

	if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
        obsdates = xmlhttp.responseText;
        //alert(obsdates);
       /* var arr=obsdates.split(","); 
        for (var i in arr) {
          //  alert(arr[i]);
        	  if(chkobdate ==arr[i]){
            	  obsexists="true";
            	  alert("Observation for this date already exists!");
        	  document.getElementById("obdate"+ID).focus();
              return false;
        	}
        }//for*/
   
   } 

}
xmlhttp.open("GET","getdates.php?q="+Isusertreeid,false);
xmlhttp.send();

obsdates = xmlhttp.responseText;
//alert(obsdates);
var arr=obsdates.split(","); 
for (var i in arr) {
//  alert(arr[i]);
	  if(chkobdate ==arr[i]){
  	  obsexists="true";
  	document.getElementById("spinner"+ID).style.display='none';
  	  alert("Observation for this date already exists!");
	  document.getElementById("obdate"+ID).focus();
    return false;
	}
}//for

document.getElementById("spinner"+ID).style.display='none';
}


function Add_obs_submit(ID) {
    
        var dataString = "usertreeid="+$("#usertreeid"+ID).attr('value');
        dataString += "&obdate="+$("#obdate"+ID).attr('value');
        var chkobdate= $("#obdate"+ID).attr('value');
        var Isusertreeid = $("#usertreeid"+ID).attr('value');
  
    //Check the observation date entry
    if(chkobdate == '' )
    {
        alert("Please enter observation date");
        //document.getElementById('dateerrormsg').innerHTML="Please enter observation date.";
       // document.getElementById('button_loc_next').style.display='block';
        document.getElementById("obdate"+ID).focus();
        return false;
   }
    else
    {
        var obsdates="";
        var obsexists="false";
        	if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
     /* xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
                obsdates = xmlhttp.responseText;
                //alert(obsdates);
                var arr=obsdates.split(","); 
                for (var i in arr) {
                  //  alert(arr[i]);
                	  if(chkobdate ==arr[i]){
                    	  obsexists="true";
                    	  alert("Observation for this date already exists!");
                	  document.getElementById("obdate"+ID).focus();
                      return false;
                	}
                }//for
           
           } 
        if(obsexists == "true")
        return false;
        }* /
      xmlhttp.open("GET","getdates.php?q="+Isusertreeid,false);
      xmlhttp.send();

      obsdates = xmlhttp.responseText;
      //alert(obsdates);
      var arr=obsdates.split(","); 
      for (var i in arr) {
        //  alert(arr[i]);
      	  if(chkobdate ==arr[i]){
          	  obsexists="true";
          	  alert("Observation for this date already exists!");
      	  document.getElementById("obdate"+ID).focus();
            return false;
      	}
      }//for
 
*/
      
    }
  
   
    
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
	/*var chkobdate= document.getElementById("obdate"+ID).value;
    //Check the observation date entry
    if(chkobdate == '' )
    {
        alert("Please enter observation date");
        document.getElementById("obdate"+ID).focus();
        return false;
   }*/
    
    var freshleave = $('#l1' + ID +':checked').val();
    if (freshleave == undefined ) 
    {   alert("Please select the Leaves Fresh option.");
        // document.getElementById('dateerrormsg').innerHTML="Please select the Leaves Fresh option.";
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
        // document.getElementById('dateerrormsg').innerHTML="Please select the Leaves Mature option.";
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
        // document.getElementById('dateerrormsg').innerHTML="Please select the Flower Bud option.";
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
         //document.getElementById('dateerrormsg').innerHTML="Please select the Flower Open option.";
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
        
       //document.getElementById('dateerrormsg').value="Please select the Fruits Ripe option.";
        // document.getElementById('dateerrormsg').innerHTML="Please select the Fruits Ripe option.";
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
   
    return true;
  //alert(dataString);
 /* $.ajax({
type: "POST",
url: "updatemyobservation.php",
data: dataString,
success: function(data){
    alert(data);
    window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>';
    
    }
  });*/
}



</script>
<!--
This is executed on when user clicks on edit observation link from dashboard or from add observation link.
This will load the edit observation innerhtml
-->
    <script>
         
    function edit_obs_load(clkloc,id,dialogid,pageno,obserno,totalob) 
    {
        alert("dsads");
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
        url: "editobservation.php",
        data: dataString,
        success: function(data){
        document.getElementById('dialog_edit_obs').innerHTML=data;
       
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
function UpdateObservation1(id)
{
   alert("update");
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
            url: "editobservation.php",
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
	  var editstatus=document.getElementById('editstatus').value;
        dataString +="&editstatus="+editstatus;
    //alert(dataString);
    $.ajax({
    type: "POST",
    url: "editobservation.php",
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
		url: "indiveditobservation.php",
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
         <input type="hidden" name="tree_id" id="tree_id" value=""  />
           <!-- List out all the trees by the user-->
        <? $treeIDAr=array(); //to store all the TreeID's 
             
        //to get no trees for logged in user
    
        $i=0;
               
        if ($treeno=="0")
         {?>
               <div class="Notreemsg"><p>Welcome to SeaonWatch Programme. You don't have any trees yet.<br />
			  Please <a href = "javascript:void(0)" name="openAddTreeModal">Add a tree</a></p></div>
        <? }
        else
        {
        while ($i<$treeno) 
        {?>
                <input type="hidden" id="species_id" value="<? echo $tob[$i]->Species_id; ?>" />
                             
               <!--  start body_content  -->
                    <div class="body_top">
                        <div class="main">
                            <div class="container">
                            <!-- Get the list of trees from the database-->
                                    <div class="flowerleftbox">
                                        <!-- Tree Image & Tree Name-->
                                        <? 
                                        $treeIDAr[$i]=$tob[$i]->Tree_id;
                                        $th_picname=$tob[$i]->species_image;
   					$species_pic1 = str_replace(".jpg",".png",$th_picname);
                                        $th_picname=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
                         		
                                        if (file_exists($th_picname)) {?>
                                         <blockquote><img src="<? echo $th_picname; ?>" alt="<?echo $th_picname?>" title=""/></blockquote>
                                         <?}
                                         else
                                         {?><blockquote><img src="images/noimage.jpg" width="60" height="60" alt="No Image" title="images/noimage.jpg"/></blockquote>
                                         <?}?>
                                    
                                    <div title="<?echo ucfirst(strtolower($tob[$i]->Tree_nickname))?>" ><strong>
                                    <? $pattern="..";
                                    $alttreenickname="";
                                    if  (strlen($tob[$i]->Tree_nickname) > 15)
                                    //echo $_SESSION['fullname'];
                                    $alttreenickname=  rtrim(substr($tob[$i]->Tree_nickname, 0, 15)) . $pattern; 
                                    else 
                                    $alttreenickname=$tob[$i]->Tree_nickname;
                                    echo ucfirst(strtolower(htmlspecialchars($alttreenickname)));?></strong></div>
                                    <div title="<?echo $tob[$i]->Species_common_name;?>"><h5>
                                    <?$malayamname = $tob[$i]->Species_common_name;
                                    if  (strlen($malayamname) > 15)
                                    { $altcmnname=  rtrim(substr($malayamname, 0, 15)) . $pattern;} 
                                    else 
                                    {$altcmnname=$malayamname;}
                                    echo ucfirst(strtolower(htmlspecialchars($altcmnname)));?></h5></div>
                                    <div title="<?echo ucfirst(strtolower($tob[$i]->species_scientific_name));?>"><h5><i>
                                    <?echo ucfirst(strtolower(htmlspecialchars($tob[$i]->species_scientific_name)));?>
                                    </i></h5></div>
                                    </div>
									<?$qObcnt="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='".$tob[$i]->user_tree_id."' and user_id='$_SESSION[userid]' and deleted='0'";
                                    $observationscnt=$dbc->readtabledata($qObcnt);
                                    $totalnoofobservationscnt=mysql_num_rows($observationscnt);
                                    
                                    $obsdates=array();
                                    for($p=0;$p<$observationscnt;$p++){
                                    	$obsdates[$p]=$observationscnt['date'];
                                    }
                                    
                                    
                                    $last2month=date("Y-m-d", strtotime("-2 month") ) ;
                                    //$last3month=date("Y-m-d", strtotime("-3 month") ) ;
    								$today=date("Y-m-d");
    								$nxtmonday= date('Y-m-d', strtotime('next monday'));
    								//$start_date = $last2month; 
    								//$start_date = $last3month;
    								$start_date = date('Y-m-d',strtotime('last monday',strtotime($mondays[0])));
    								$end_date   = $nxtmonday; 
                                                                
                                                                //echo $end_date;
                                                               
                                    $qOb="SELECT  observation_id,date,freshleaf_count,matureleaf_count,bud_count,open_flower_count,fruit_ripe_count,fruit_unripe_count FROM user_tree_observations wHERE 
                                        user_tree_id ='".$tob[$i]->user_tree_id."' and user_id='$_SESSION[userid]' and deleted='0' and date > '".$start_date . "' AND date <= '". $end_date ."' ORDER BY date ASC";
                                       
                                        $observations=$dbc->readtabledata($qOb);
                                        $noofobsforlasttwomonths=mysql_num_rows($observations);
                                        
                                        $obsdatesreq=Array();
                                        while($r=mysql_fetch_array($observations)){
                                        	array_push($obsdatesreq,$r['date']);
                                        }
                                        
                                        if($noofobsforlasttwomonths>0){
                                        	mysql_data_seek($observations,0);}
                                    
                                       //echo $qOb." ".$noofobsforlasttwomonths;
                                    
                                    ?>
                                   <!-- start Graph Section-->
                                    <div class="middlebox">
                                       <? if ($noofobsforlasttwomonths>0){
                                            $n=0;$fetchnext=0;$p=0;
                                            $oneobservation=mysql_fetch_array($observations);
                                         for($m=0;$m<8;$m++){
                                         $observation[$m]=new Observation();
            if($n>=$noofobsforlasttwomonths){
             while($m<8){
              
             $observation[$m]->exists=0;
             $m++;} 
             break;
                 }
            
                 $end_dt = $mondays[$m];
                 if ($m==0)
                 {
                  $start_dt=date('Y-m-d',strtotime('last monday',strtotime($mondays[0])));
                 	//$start_dt=date('Y-m-d',strtotime('last monday',strtotime($last3month)));
                 }
                 else
                 {
                  $start_dt= $mondays[$m-1];
                 }
                 
               //echo " ".$oneobservation['date']." ".$start_dt." ".$end_dt;
             if($oneobservation['date'] >= $start_dt && $oneobservation['date'] < $end_dt)
            {            
             
            	while($p < ($noofobsforlasttwomonths-1) && $obsdatesreq[$p+1] >= $start_dt && $obsdatesreq[$p+1] < $end_dt){
            		//echo "curr date=".$obsdatesreq[$p]."next date".$obsdatesreq[$p+1];
            		$oneobservation=mysql_fetch_array($observations);$p++;
            	
            	}$p++;
            	
            	
             $observation[$m]->exists=1;
            $observation[$m]->observation_id=$oneobservation['observation_id'];
            $observation[$m]->date=$oneobservation['date'];
            $observation[$m]->freshleaf_count=$oneobservation['freshleaf_count'];
            $observation[$m]->matureleaf_count=$oneobservation['matureleaf_count'];
            $observation[$m]->bud_count=$oneobservation['bud_count'];
            $observation[$m]->open_flower_count=$oneobservation['open_flower_count'];
            $observation[$m]->fruit_ripe_count=$oneobservation['fruit_ripe_count'];
            $observation[$m]->fruit_unripe_count=$oneobservation['fruit_unripe_count'];
                           
            $oneobservation=mysql_fetch_array($observations);
             $n++;$fetchnext=1;
            }
            else{
             
            $observation[$m]->exists=0; 
            $fetchnext=0;
                                         }}?>
                                         
                                       
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
                                    <?for ($k =0; $k <8; $k++) 
                                    {
                                        if($observation[$k]->exists)
                                        {  
                                            ?>
                                            <td style="width:71px;height:51px;vertical-align:middle;">
                                            <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                <td>
                                                <? 
                                                  
                                                switch ($observation[$k]->freshleaf_count)
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
                                                <?   switch ($observation[$k]->matureleaf_count)
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
                                            <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                            </tr>
                                            <tr>
                                            <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                            </tr>
                                            </table>
                                            </td>
                                        <?}
                                    }?>
                                    </tr>
                                    </table>
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
                                                                
                                 if($observation[$k]->exists)
                                { 
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <? 
                                  switch ($observation[$k]->bud_count)
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
                                    <img src="images/icon_dontknow.png" title="Don't know">
                                <?} ?>    
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?   switch ($observation[$k]->open_flower_count)
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
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                            }?>
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
                            <?for ($k =0; $k <8; $k++) 
                            {
                                                               
                                 if ($observation[$k]->exists)
                                {  
                                ?>
                                <td style="width:71px;height:51px;vertical-align:middle;">
                                <table width="51%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td>
                                <?//unripe  
                                switch ($observation[$k]->fruit_unripe_count)
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
                                    <img src="images/icon_dontknow.png" title="Don't know">
                                    <?break;
                                }?>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <?
                                switch ($observation[$k]->fruit_ripe_count)
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
                                    <img src="images/icon_dontknow.png" title="Don't know">
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
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    <tr>
                                    <td><img src="images/icon_no_obs.png" title="No Observation"/></td>
                                    </tr>
                                    </table>
                                    </td>
                                <?}
                                
                                }?>
                            </tr>
                            </table>  
                            <!-- Date display-->
                            <table width="673" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                            <td style="height:51px;vertical-align:middle;text-align:center;color:#666666;font-size:14px;"><blockquote style="width:92px;">Week starting</blockquote></td>
                            <td style="height:51px;vertical-align:middle;padding:0px 15px;"><blockquote style="width:60px;">&nbsp;</blockquote></td>
                                <?for ($k =0; $k <8; $k++) 
                                {
                                $end_date = date('Y-m-d',strtotime($mondays[$k]));
                                if ($k==0)
                                {
                                	$lastmonday=strtotime('last monday', strtotime($end_date));
                                    $start_date=date('Y-m-d',$lastmonday);
                                
                                }
                                else
                                {
                                $start_date= date('Y-m-d',strtotime($mondays[$k-1])); 
                                }
								$monthdateformat = date('j-M',strtotime($mondays[$k]));
                               ?>
								<td style="width:71px;height:51px;vertical-align:middle;"><blockquote style="width:71px;text-align:center;color:#666666; font-size:13px;"><?echo $monthdateformat;?></blockquote></td>
								<?}?>   
                                </tr>
                                </table>
                                
                                </tr>
                                </table>
                                        <?}else{?>
                                        <div class="link">Observation not exists for this tree. Please <a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);">Add Observation.</a></div>
                                        <?}?>
                                </div>       <!-- middlebox div close-->                          
                                    <!-- end Graph Section-->
                                    
                                     <div class="add_tree_icon">
                                        <ul>
                                               <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightOne<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/add_observation.png" alt=""  title="Add Observation." /></a></li>
<div id="lightOne<?echo $i;?>" class="white_contentOne"><? include ("addobservationtest.php"); ?></div>
                                                 
                                                
                                                <li class="popup"><a href="<?echo $treeIDAr[$i],$th_picname?>" title="Tree information" id="pop<?echo $i;?>"><img src="images/expand.png" alt=""/></a></li>
  <!--<li class="infoclose"><a href="" title="Close Tree Information."><img src="images/collapse.png"></a></li>-->
                                                <!-- li><a href = "javascript:void(0)" id = '<?php echo $tob[$i]->Tree_id; ?>' onclick = "document.getElementById('tree_id').value=jQuery(this).attr('id');document.getElementById('lightSix').style.display='none';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);edit_tree_load('edittree',<?echo $treeIDAr[$i]?>,<?echo $i?>);"><img src="images/edit_tree.png" alt=""  width="15px" height="15px" title="Edittree." /></a></li-->
                                                <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightSix<?echo $i;?>').style.display='block';document.getElementById('fadeOne').style.display='block';window.scrollTo(0, 0);"><img src="images/edit_tree.png" alt=""  width="15px" height="15px" title="Edittree." /></a></li>
                                                
                                                <div id="lightSix<?echo $i;?>" class="white_contentThree"><?php if($_SESSION['usercategory'] == 'individual') {include ("indivedittreetest.php");}  elseif ($_SESSION['usercategory'] =='school-seed')
        {
             include ("seededittree.php");
        }else {include ("generaledittreetest.php");} ?>
                                                </div>
                                                              <?if ($totalnoofobservationscnt>0){?>
                                                <li><a href="javascript:void(0)" title="Edit Observations" onclick="edit_observation(<?echo $i?>,<?echo $treeIDAr[$i]?>);"/><img src="images/pencil.png" alt="no"></img></a></li>  
                                                <?}?>
                                                
                                        </ul>
                                    </div>
                                <?php include ("indivtreeinfo.php"); ?>
                                    
                                </div> <!-- Div of container body-->
                        </div> <!-- Div of Main body -->
                    </div>  <!-- Div of Body top-->

                    <?
                    $i++;
                 }			
            }?>                   
 </div> <!-- Div of body_content_2 -->
</div>  <!--Div of wrapper  -->

    <div id="fadeOne" class="black_overlayOne"></div>
        <!--MODAL TREE INFO STARTS-->
        <div id="lightFour" class="white_contentThree">
        <?php   if ($_SESSION['usercategory'] =="individual"){ 
        include ("indivaddtree.php");}
        elseif ($_SESSION['usercategory'] =="school-seed")
        {
             include ("seedtreesdream.php");
        }
        elseif($_SESSION['usercategory'] =="school")
        {
             include ("schooltrees.php");
        }
        elseif ($_SESSION['usercategory'] =="school-gsp")
        {
             include ("gsptreesadd.php");
        }
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

<!-- script type="text/javascript">
    var map;
    var geocoder;
    var address;
	

    function initialize() {
      map = new GMap2(document.getElementById("map"),{size:new GSize(900,300)});
      map.setCenter(new GLatLng(<? echo $lat; ?>,<? echo $lng; ?>), 4);
      map.setUIToDefault();
      map.enableDoubleClickZoom();
        geocoder = new GClientGeocoder();
      	GEvent.addListener(map, "click", getAddress);
        GEvent.addListener(map, "zoomend", changeZoom);      
    }


    function changeZoom(from_zoom,to_zoom) {
       
        $('#zoom').val(map.getZoom());
        var zoom_get = $('#zoom').val();
        $('#zoominfo').show();
        $('#zoominfo').html("Current zoom level is " + zoom_get + ".  Please zoom in to a minimum level of 15. To try and spot your tree from the sky, switch to satellite mode!");

    }

    
    function getAddress(overlay, latlng) {
	map.clearOverlays();
      	if (latlng) {
          address = latlng;
	  geocoder.getLocations(latlng, function(addresses) {
          if(addresses.Status.code != 200) {
            alert("reverse geocoder failed to find an address for " + latlng.toUrlValue());
          } else {
            address = addresses.Placemark[0];
            point = new GLatLng(latlng.y, latlng.x);
            $('#lng').val(latlng.x);
            $('#lat').val(latlng.y);
	    var final_address = address.address;
            marker = new GMarker(point);
            map.addOverlay(marker);
            var current_zoom = $('#zoom').val();
            if(current_zoom > 9 ) {
               var zoom_val_set = current_zoom;
            } else {
               var zoom_val_set = 9;
            }
            map.setCenter(new GLatLng(latlng.y, latlng.x), zoom_val_set);
            if(final_address) { setLocationValues(final_address); }  
         }
        });
       }
    }

    function addAddressToMap(response) {
      map.clearOverlays();
      if (!response || response.Status.code != 200) {
        alert("Sorry, we were unable to geocode that address");
      } else {
        place = response.Placemark[0];
        point = new GLatLng(place.Point.coordinates[1],
                            place.Point.coordinates[0]);
        
        marker = new GMarker(point);
        map.addOverlay(marker);
        var current_zoom = $('#zoom').val();
        if(current_zoom > 9 ) {
           var zoom_val_set = current_zoom;
        } else {
               var zoom_val_set = 9;
        }
        map.setCenter(new GLatLng(place.Point.coordinates[1],place.Point.coordinates[0]), zoom_val_set);
        $('#lng').val(place.Point.coordinates[0]);
	$('#lat').val(place.Point.coordinates[1]);


        var final_address = place.address;

         if(final_address) {        
            setLocationValues(final_address);
            
          }
      
      }
     
    }

    function showLocation() {
            var address = $('.address_input').val();
            geocoder.getLocations(address,addAddressToMap);
            
    }
 
    function setLocationValues(final_address) {
       var a1 = final_address;

       a1 = a1.split(',');
       var arcount = a1.length;
       var country_name  = a1[arcount - 1];
       var country_name =  country_name.split(' ').join('');
       if( country_name != 'India') { 
       	   //jAlert("Please choose a location only from India");
	   //$('#lng').val('');
	   //$('#lat').val('');
           //return false;
       }
       var state_name= a1[arcount - 2];
       state_name = state_name.trim();      
       $("#state").val(state_name) 
      

       if( a1[arcount - 4] ) {
          if( a1[arcount-4] != 'undefined') {
              document.getElementById('loc_name').value = a1[arcount - 4];
           } else {
             document.getElementById('loc_name').value = '';
           }  

	   if(a1[arcount-3] != '') {
             if(a1[arcount-3] != 'undefined' ) {
               document.getElementById('city').value = a1[arcount - 3];
             }
            }
        } else {
	   document.getElementById('loc_name').value = a1[arcount - 3];
	}

        if( a1[arcount - 5] ) {
            document.getElementById('loc_name').value = a1[arcount - 5] + ', ' + document.getElementById('loc_name').value;
        }

        if( a1[arcount - 6] ) {
            document.getElementById('loc_name').value = a1[arcount - 6] + ', ' + document.getElementById('loc_name').value;
        }

        var zoom_get = map.getZoom();
        document.getElementById('zoom').value = map.getZoom();
      }
</script-->

<script type="text/javascript" src="js/jquery.validate.js"></script>
