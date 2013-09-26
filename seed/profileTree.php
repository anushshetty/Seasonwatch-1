<?php
/*
Initial Development  :- This page is called when a tree nickname is clicked on 
 * in home.php.It loads all tree details on the left block and the assigned 
 * members on the right.It also has links to load the dialog boxes for
	Edit Tree.
	Add Observations.
	Edit Observations.
 ///////////////////////////////////////////////////////////////////////////////////////
 * Jan 24 2012 :-  Edit boxes with manual date entry is restricted to address 
 * Junk date entring to database.i,e  obdate,from_obdate,to_obdate has made 
 * readonly.User has to select from the calendar only.
 * ////////////////////////////////////////////////////////////////////////////////
 * Jan 30 2012 :-  Added function Date Diff to calculate difference between 
 * jan 1 2010 to today and update that no of days to enable calendar till those
 *  many days.
 * --> ClearDate () function is added to make sure date entry will be cleared .
 * when user clicks on cancel button from Add observation.
 * --> daysInFebruary() To caluclte no of days in Feb.
 * --> DaysArray() tO calculate no of days in a month.
 * --> Validation for user entered date in Submit3 button.
 * --> added js files from calendar jquery js/jquery-1.7.1.min.js,
 *     jquery-ui-1.8.17.custom.min.js and css/smoothness/jquery-ui-1.8.17.custom.css
 *      to display arrow in calendar.
*/

	session_start();
	if ($_SESSION['user_id']=='')
	{
		header("Location: index.php");
	}	
	include_once("includes/dbc.php");
	$tree_id=$_GET[tree_id];
        $Msg=$_GET[msg];
       // echo $tree_id;
	
	//to get last weeks date to pre-load the 7 days observations
	$end_date=date('Y-m-d');
	$m= date("m")-1; // Month value
	$de= date("d"); //today's date
	$y= date("Y"); // Year value
	$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Seed</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
 <link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<!--[if lte IE 6]>
	<script type="text/javascript" src="js/supersleight-min.js"></script>
<![endif]-->
<!--<script type="text/javascript" src="js/jquery-latest.pack.js"></script>-->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script> <!-- added for calendar arrows-->
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script><!-- added for calendar arrows-->
<script type="text/javascript" src="js/custom-form-elements1.js"></script>
<script type="text/javascript" src="js/initiate.js"></script>

<!--
This is to pre-load the observations of last 1 month in the Edit Observations dialog box.
-->
<script>
    $(document).ready(function()
    {
    
        var dString = "Jan, 1, 2010";
        var d1 = new Date(dString);
        var d2 = new Date();// today's date. 
        var noofDays=DateDiff(d1, d2); //Calculates difference 

            $("#obdate").datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
            $("#from_obdate").datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
            $("#to_obdate").datepicker({minDate: -noofDays, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});


            document.getElementById('from_obdate').value="<? echo $start_date; ?>";
            document.getElementById('to_obdate').value="<? echo $end_date; ?>";
            dataString  = "user_id="+<? echo $_SESSION[user_id]; ?>+"&tree_id="+<? echo $tree_id; ?>;
            dataString += "&from_obdate=<? echo $start_date; ?>&to_obdate=<? echo $end_date; ?>";

            //alert(dataString);
            $.ajax({
            type: "POST",
            url: "listobservations.php",
            data: dataString,
            success: function(data){
            document.getElementById('observations').innerHTML=data;
	//window.setTimeout("$('#dialog_edit_tree_filter').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
}
});
return false;	
});

// Function to calcualte difference between two dates.
    function DateDiff(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();
        return parseInt((t2-t1)/(24*3600*1000));
    }
 </script>

<script>
<!--

	function toggleRadio(lblValue,lblID)
	{
		document.getElementById('lbl'+lblID).innerHTML = lblValue;
	}
	function etoggleRadio(lblValue,lblID)
	{
		document.getElementById('elbl'+lblID).innerHTML = lblValue;
	}
//-->
</script>

<!--
This is executed on submitting the Add Observations form.
It validates the data and then passes on values to trackobservations.php in AJAX mode
for adding the observation to the DB.
-->
<script type="text/javascript" >
$(function() {
$(".submit1").click(function() {

if($('#obdate').attr('value') == '' )
{
	alert("Please enter observation date");
	document.getElementById("obdate").focus();
	return false;
}

//var dataString = $("form").serialize();
var dataString = "usertreeid="+$('#usertreeid').attr('value');
dataString += "&obdate="+$('#obdate').attr('value');
//alert($('input:radio[name=l1]:checked').val());

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

if ($('input:radio[name=l2]:checked').val()==0)
{
	dataString += "&is_leaf_mature=0&matureleaf_count=0";
} else if ($('input:radio[name=l2]:checked').val()==1) {
	dataString += "&is_leaf_mature=1&matureleaf_count=1";
} else if ($('input:radio[name=l2]:checked').val()==2) {
	dataString += "&is_leaf_mature=1&matureleaf_count=2";
} else if ($('input:radio[name=l2]:checked').val()==-1) {
	dataString += "&is_leaf_mature=-1&matureleaf_count=-1";
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


$.ajax({
type: "POST",
url: "trackobservations.php",
data: dataString,
success: function(data){
 
//alert(data);
//$('.success').html(data);
$('.success1').fadeIn(200).show();
$('.error1').fadeOut(200).hide();
window.setTimeout("$('#dialog_add_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.success1').css('display','none');window.location.reload(true);", 2000);
}
});
return false;
});
});
function ClearDate()
{
    document.getElementById("obdate").value="";
	window.location.reload(true);  
}
</script>

<!--
This function is called on clicking Edit for an observation on the 
Edit Observations dialog box. It validates the data and then passes these
by AJAX to updateobservations.php for updating this observation row.
-->
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



function edit_obs_submit() {
//$(".submit3").click(function() {
//alert("in submit3");

var dtCh= "-";

if($('#obdate1').attr('value') == '' )
{
	alert("Please enter observation date");
	document.getElementById("obdate1").focus();
	return false;
}
// regular expression to match required date format
re = /^\d{4}\-\d{2}\-\d{2}$/;
if(!$('#obdate1').attr('value').match(re) ) 
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
    var sdate = $('#obdate1').attr('value'); //user entered date 
   
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
        document.getElementById("obdate1").focus();
        return false;
    }
    if (iUserdate < 20100101)
    {
        alert("Please enter an observation date between 1 Jan 2010 and today.");
        document.getElementById("obdate1").focus();
        return false;
    }
    //check month
    if (strMonth.length<1 || imonth<1 || imonth>12 )
    {
        alert("Please check the entered month.Enter an observation date between 2010-01-01 and today.");
        document.getElementById("obdate1").focus();
        return false;
    }
    //check dates
     if (strDate.length<1 || iday<1 || iday>31 || (imonth==2 && iday>daysInFebruary(iyear)) || iday > daysInMonth[imonth] )
     {
        alert("Please check the date with valid month.Enter an observation date between 2010-01-01 and today. ");
        document.getElementById("obdate1").focus();
        return false;
     }

}
        


//var dataString = $("form").serialize();
var dataString = "usertreeid="+$('#usertreeid').attr('value');
dataString += "&obdate="+$('#obdate1').attr('value');
//alert (dataString);
//alert($('input:radio[name=l1]:checked').val());

if ($('input:radio[name=el1]:checked').val()==0)
{
	dataString += "&is_leaf_fresh=0&freshleaf_count=0";
} else if ($('input:radio[name=el1]:checked').val()==1) {
	dataString += "&is_leaf_fresh=1&freshleaf_count=1";
} else if ($('input:radio[name=el1]:checked').val()==2) {
	dataString += "&is_leaf_fresh=1&freshleaf_count=2";
} else if ($('input:radio[name=el1]:checked').val()==-1) {
	dataString += "&is_leaf_fresh=-1&freshleaf_count=-1";
}

if ($('input:radio[name=el2]:checked').val()==0)
{
	dataString += "&is_leaf_mature=0&matureleaf_count=0";
} else if ($('input:radio[name=el2]:checked').val()==1) {
	dataString += "&is_leaf_mature=1&matureleaf_count=1";
} else if ($('input:radio[name=el2]:checked').val()==2) {
	dataString += "&is_leaf_mature=1&matureleaf_count=2";
} else if ($('input:radio[name=el2]:checked').val()==-1) {
	dataString += "&is_leaf_mature=-1&matureleaf_count=-1";
}

if ($('input:radio[name=ef1]:checked').val()==0)
{
	dataString += "&is_flower_bud=0&bud_count=0";
} else if ($('input:radio[name=ef1]:checked').val()==1) {
	dataString += "&is_flower_bud=1&bud_count=1";
} else if ($('input:radio[name=ef1]:checked').val()==2) {
	dataString += "&is_flower_bud=1&bud_count=2";
} else if ($('input:radio[name=ef1]:checked').val()==-1) {
	dataString += "&is_flower_bud=-1&bud_count=-1";
}

if ($('input:radio[name=ef2]:checked').val()==0)
{
	dataString += "&is_flower_open=0&open_flower_count=0";
} else if ($('input:radio[name=ef2]:checked').val()==1) {
	dataString += "&is_flower_open=1&open_flower_count=1";
} else if ($('input:radio[name=ef2]:checked').val()==2) {
	dataString += "&is_flower_open=1&open_flower_count=2";
} else if ($('input:radio[name=ef2]:checked').val()==-1) {
	dataString += "&is_flower_open=-1&open_flower_count=-1";
}

if ($('input:radio[name=efr1]:checked').val()==0)
{
	dataString += "&is_fruit_unripe=0&fruit_unripe_count=0";
} else if ($('input:radio[name=efr1]:checked').val()==1) {
	dataString += "&is_fruit_unripe=1&fruit_unripe_count=1";
} else if ($('input:radio[name=efr1]:checked').val()==2) {
	dataString += "&is_fruit_unripe=1&fruit_unripe_count=2";
} else if ($('input:radio[name=efr1]:checked').val()==-1) {
	dataString += "&is_fruit_unripe=-1&fruit_unripe_count=-1";
}

if ($('input:radio[name=efr2]:checked').val()==0)
{
	dataString += "&is_fruit_ripe=0&fruit_ripe_count=0";
} else if ($('input:radio[name=efr2]:checked').val()==1) {
	dataString += "&is_fruit_ripe=1&fruit_ripe_count=1";
} else if ($('input:radio[name=efr2]:checked').val()==2) {
	dataString += "&is_fruit_ripe=1&fruit_ripe_count=2";
} else if ($('input:radio[name=efr2]:checked').val()==-1) {
	dataString += "&is_fruit_ripe=-1&fruit_ripe_count=-1";
}

if(document.getElementById('eleaf_caterpillar').checked)
{
	dataString += "&leaf_caterpillar=1";
}
else {
	dataString += "&leaf_caterpillar=";
}
if(document.getElementById('eflower_butterfly').checked)
{
	dataString += "&flower_butterfly=1";
}
else {
	dataString += "&flower_butterfly=";
}
if(document.getElementById('eflower_bee').checked)
{
	dataString += "&flower_bee=1";
}
else {
	dataString += "&flower_bee=";
}
if(document.getElementById('efruit_bird').checked)
{
	dataString += "&fruit_bird=1";
}
else {
	dataString += "&fruit_bird=";
}
if(document.getElementById('efruit_monkey').checked)
{
	dataString += "&fruit_monkey=1";
}
else {
	dataString += "&fruit_monkey=";
}
dataString += "&observation_id="+$('#observationid').attr('value');
//alert(dataString);
$.ajax({
type: "POST",
url: "updateobservations.php",
data: dataString,
success: function(data){
//$('.success').html(data);
$('.success3').fadeIn(200).show();
$('.error3').fadeOut(200).hide();
window.setTimeout("$('#dialog_edit_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.success3').css('display','none');", 2000);
}
});
//return false;
}
</script>

<!--
Called on submitting Edit Tree details dialog box.
It validates tree details and then passes on the values by AJAX to
updatetree.php for updating this tree's details on the DB.
-->
<script type="text/javascript" >
$(function() {
$(".submit2").click(function() {


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
		alert("tree height value should be Numeric (2 decimal places) & between 1 to 50");
		document.getElementById("tree_height").focus();
		return false;
}
} 

if(girth != '' )
{
//alert("Hello");
//alert("The value of girth is "+girth);
var numericnew= /^\d+(\.\d{1,2})?$/;
	if(girth.match(numericnew) && (girth>4 && girth<=10000)){
	//return true;
}
else{
		alert("tree girth value should be Numeric (2 decimal places) & between 5 to 10000");
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
dataString += "&user_id=<?php echo $_SESSION[user_id]?>";
dataString += "&tree_id=<?php echo $tree_id; ?>";
dataString += "&species_id="+$('#species_id').attr('value');
	dataString += "&species_id="+document.getElementById('species_id').value;
	dataString += "&members_assigned=";
	j=0;
	for (i=0;i<=document.getElementById('member_num').value;i++)
	{
		if (document.getElementById('members_assigned'+i).checked)
		{
			if (j==0)
			{
				dataString += document.getElementById('members_assigned'+i).value;
			}
			else
			{
				dataString += ", "+document.getElementById('members_assigned'+i).value;			
			}
			j++;			
		}
	}
	if (j == 0)
	{
		alert("Please assign at least one user.");
		document.getElementById("members_assigned0").focus();
		return false;
	}	
//alert(dataString);
$.ajax({
type: "POST",
url: "updatetree.php",
data: dataString,
success: function(data){
//$('.success2').html(data);
$('.success2').fadeIn(200).show();
$('.error2').fadeOut(200).hide();
window.setTimeout("$('#dialog_add_tree').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');window.location.reload(true);", 2000);
}
});
return false;
});
});
</script>

<!--
Called from Edit Observations dialog box on choosing From & To dates and clicking submit.
It calls listobservations.php by AJAX to load the list of observations
within these dates on the same dialog box.
-->
<script type="text/javascript" >
$(function() {
$(".ok_button").click(function() {

//alert(document.getElementById('observations').innerHTML);
//document.getElementById('observations').innerHTML="in javascript";
dataString  = "user_id="+<? echo $_SESSION[user_id]; ?>+"&tree_id="+<? echo $tree_id; ?>;
dataString += "&from_obdate="+document.getElementById('from_obdate').value+"&to_obdate="+document.getElementById('to_obdate').value;
//alert(dataString);
$.ajax({
type: "POST",
url: "listobservations.php",
data: dataString,
success: function(data){
document.getElementById('observations').innerHTML=data;
//window.setTimeout("$('#dialog_edit_tree_filter').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
}
});
return false;
});
});
</script>

<!--
This function is called on clicking the Delete link next to observations on the
Edit Observations dialog box. It passes on the observation_id by AJAX to 
deleteobservations.php to delete this obs from the DB.
-->
<script type="text/javascript" >
function obs_delete(id) {
if (confirm("Are you sure you want to delete?")) {
	dataString  = "observation_id="+id;
	//alert(dataString);
	$.ajax({
	type: "POST",
	url: "deleteobservations.php",
	data: dataString,
	success: function(data){
	document.getElementById('observations').innerHTML=data;
	//window.setTimeout("$('#dialog_edit_tree_filter').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
	}
	});
}
else
{
}

};

function show(obj,msg,x,y){  

	//alert(document.getElementById('messageBox').style.top+"xx"+y);
	document.getElementById('messageBox').style.top=y;
	//alert(document.getElementById('messageBox').style.top);	
	document.getElementById('messageBox').style.left=x;
	document.getElementById('contents').innerHTML=msg;
	document.getElementById('messageBox').style.display="block";
}
function hide(){
document.getElementById('messageBox').style.display='none';
}  
</script>

<!--
Called from upload Observations dialog box on choosing From & To dates and clicking submit.
It calls UploadFile.php by AJAX to load the list of observations
within these dates on the same dialog box.
-->
<script type="text/javascript">
$(function() {
$(".submit4").click(function() {
var UploadFileName="";
var error ="";
var fileSelected="";
var fileSelected= new Boolean( 0);
var allowed_extensions=/(xls|xlsx)$/; //check for allowed extension it is simple regular expression

//validating for xls or xlsx file upload
UploadFileName = document.getElementById("ExcelUploadFile").value;
	if(UploadFileName=='')
        {
            error+="Please Select a file";
        }
        else
        { 
            fileSelected=1 ;
        }
        if(!UploadFileName.match(allowed_extensions)){
        if (fileSelected==1)
        {
            error+= " Select file"
        }
            error+=" with xls or xlsx extenstion.";
        }
        if(error!='')
        {  //check for any errors
            alert(error);   //if error alert error
            return false;   //return to form don't submit to action page
        }
 //return true;
$.ajax({
type: "POST",
url: "UploadFile.php",
data: dataString,
success: function(data){
document.getElementById('observations').innerHTML=data;
$('.success2').fadeIn(200).show();
window.setTimeout("$('#dialog_upload_obs').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
}
});
return true;
});
});
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

</head><body>

<!-- Main Holder Starts -->
<div id="mainHolder">

	<!-- header starts -->
   <div id="homeHeader">
    	<a href="home.php"><img src="images/logo.png" alt="Seed" title="Seed" width="150" height="98" class="logo" /></a>
        <span><? echo $_SESSION['num_obs']; ?> updates this week / <? echo $_SESSION['num_trees']; ?> trees</span>		
        <img src="images/seasonWatch.jpg" alt="Season Watch" title="Season Watch" width="202" height="89" class="season" />
    </div>
     <!-- header ends -->
    
    <!-- content holder starts -->
    <div id="mainContentHolder" class="profileTree">
    	
            <!-- User status starts -->
            <dl class="userStatus">
                <dt><? echo $_SESSION['school_name']; ?> | <a href="home.php">HOME</a></dt>
                <dd>Welcome <? echo $_SESSION['full_name']; ?> | <a href="index.php?action=logout">LOGOUT</a></dd>
            </dl>
            <!-- User status ends -->
            <dl class="supportLinks">
                <dt>&nbsp;</dt>
                <dd><a href="#dialog3" name="modal">Download</a> | <a href="#dialog4" name="modal">Learn</a></dd>
            </dl>
            
            <!-- Left block starts -->
            <div class="leftBlock">

				<?php
                                //echo $_SESSION[user_id],"treeid",$tree_id;
                                
                                
				$group_trees = mysql_query("SELECT tree_nickname from user_tree_table where tree_id='$tree_id' and user_id='$_SESSION[user_id]'");
				$group_trees_row = mysql_fetch_array($group_trees);
				
				list($tree_code_sms,$tree_nickname)=mysql_fetch_row(mysql_query("SELECT tree_code_sms, tree_nickname FROM user_tree_table WHERE tree_id='$tree_id' AND user_id='$_SESSION[user_id]'"));
				list($species_name,$species_id) = mysql_fetch_row(mysql_query("SELECT species_primary_common_name, species_id from species_master 
							where species_id in (SELECT species_id from trees WHERE tree_Id='$tree_id')"));
				list($malayalam_name) = mysql_fetch_row(mysql_query("SELECT alternative_name from species_alternate_name
							where species_id = '$species_id' AND language_id='8'"));
				list($height,$girth,$damage) = mysql_fetch_row(mysql_query("SELECT tree_height, tree_girth, tree_damage FROM tree_measurement 
							WHERE tree_id='$tree_id' and user_id='$_SESSION[user_id]'"));
				?>
			
                <!-- header starts -->
                <div class="leftHeader">
                	<h1><? echo $group_trees_row['tree_nickname']; ?></h1>
                    <span><a href="#dialog_add_tree" name="modal">Edit Tree</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#dialog_add_obs" name="modal">Add Observation</a>
					&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#dialog_edit_obs_filter" name="modal">Edit Observation</a>
                                        
                    </a></span></span>
                </div>
                <!-- header ends -->
                
                <div class="profileTreeHolder">
                	
                        <h5><? echo $_SESSION['school_code_sms'].$tree_code_sms; ?></h5>
                        <?php 
                         if (strtolower($Msg)=="sucess") 
                         { echo "File has been uploaded and Observations are added";
                             $Msg ="";}
                         else if  (strtolower($Msg)=="notsucess")
                         {
                             $UploadMsg="Uploaded file's tree name is not matching.Please check the treename and upload.";  ?>
                        <font color="red"><? echo $UploadMsg; ?></font>
                        <?php 
                            //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; echo $url;
                         }
                         else 
                             echo "";
                        ?>
                        <!--<blockquote>Phenology status over time.</blockquote>-->
                        
                        <blockquote><img src="images/profileTreeGraph.jpg" alt=" " width="596" height="69"></blockquote>
                      <!--Tree graph-->
                        
                        <div>
                            <dl>
                                <dt>Species name:</dt><dd><? echo $species_name; ?></dd>
								<!--<dt>Malayalam name:</dt><dd><? echo $malayalam_name; ?></dd>-->
                            </dl>
                            <dl>
                                <dt>Height</dt><dd><? if ($height!='') {if ($height-floor($height)) { echo $height;} else { echo floor($height); } } else {echo "--";}; ?> m</dd>
                                <dt>Girth</dt><dd><? if ($girth!='') {if ($girth-floor($girth)) { echo $girth;} else { echo floor($girth); } } else {echo "--";}; ?> cm</dd>
                            </dl>
                            <dl class="no">
                                <dt>Damage</dt><dd><? if ($damage==0) { echo "None";} elseif ($damage==1) {echo "Some damage";} else {echo "Don't know";}; ?></dd>
                            </dl>
                        </div>
						<?php
						$result = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$species_id'");
						$image_names = mysql_fetch_array($result);
						$species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
						$th_picname1=substr($species_pic1,0,strlen($species_pic1)-4)."_th".substr($species_pic1,strlen($species_pic1)-4,4);
						$image_names = mysql_fetch_array($result);
						$species_pic2 = $image_names['path_name'].'/'.$image_names['file_name'];
						$th_picname2=substr($species_pic2,0,strlen($species_pic2)-4)."_th".substr($species_pic2,strlen($species_pic2)-4,4);
						?>						
                    	<p>
                        	<img src="../<? echo $th_picname1; ?>" alt=" " width="150"><img src="../<? echo $th_picname2; ?>" alt=" " width="150">
                        </p>
                        
                </div>
                
            </div>
            <!-- Left block ends -->
            
            
            <!-- Right block starts -->
            <div class="rightBlock">
                
                <!-- header starts -->
                <div class="rightHeader">
                	<h1>Assigned students</h1>
					<span><a href="#dialog_add_tree" name="modal">EDIT</a></span>					
                </div>
                <!-- header ends -->

				<?php
				$school_members = mysql_query("SELECT full_name, users.group_id, group_name, group_role, users.user_id as uid, user_tree_table.user_tree_id as utid 
												FROM users, user_groups, user_tree_table 
												WHERE users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' 
												AND user_tree_table.user_id='$_SESSION[user_id]' AND user_tree_table.tree_id='$tree_id'
												ORDER BY users.user_id;");
				while ($row_settings = mysql_fetch_array($school_members)) 
				{				
				$is_member=mysql_query("SELECT 	COUNT(*) as c FROM user_tree_table 
										WHERE user_tree_id='$row_settings[utid]' AND members_assigned LIKE '%$row_settings[uid]%'");
				$is_member_value=mysql_fetch_array($is_member);
				?>
				
                
                <dl class="assignedMemberList">
                	<dt><a href="#" <?php if ($is_member_value[c]<=0) {echo "class='dactive'" ;} ?>><? echo $row_settings['full_name']; ?></a>
					</dt>
					<dd>
						<?php if($is_member_value[c]>0)
						{
							//echo "<input name='' src='images/icoTick.jpg' type='image'> <input name='' src='images/icoDactDelete.jpg' type='image'>";
							echo "<img name='' src='images/icoTick.jpg' > <img name='' src='images/icoDactDelete.jpg'>";
						} 
						else {
							//echo " <input name='' src='images/icoDactAdd.jpg' type='image'>";
							echo " <img name='' src='images/icoDactAdd.jpg' >";
						}
						?>
						
					</dd>
                </dl>
   
				<?php
				}
				?>
                
            </div>
            <!-- Right block ends -->
            
        
    </div>
    <!-- content holder ends -->
    <div class="footer">
    <p><a href="http://ncbs.res.in"><img src="images/ncbs-logo.bmp" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="http://www.wiproeducation.com"><img src="images/WCC_Logo.png" /></a></p>
  </div>
        
</div>

<!-- Main Holder Ends -->

<!--MODAL Starts-->
<!--
This dialog box loads on clicking Add Observations.
It displays a form for capturing all the information for an Observation.
-->

<!-- Make sure that this and id=dialog_add_obs in home.php are always in sync. Though currently this is not on home.php-->
<div id="dialog_add_obs" class="window treeModal">

	<div class="treeModalLeft">
		<?php
		list($user_tree_id)=mysql_fetch_row(mysql_query("SELECT user_tree_id FROM user_tree_table
							WHERE user_id='$_SESSION[user_id]' AND tree_id='$tree_id'"));
		?>

		<form name="add_obs" id="add_obs" method="POST" action="">
		<input type="hidden" name="usertreeid" id="usertreeid" value="<?echo $user_tree_id; ?>"  />
		<!--<input type="hidden" name="obdate" id="obdate" value="<?echo date("Y-m-d"); ?>" />-->
		<h1><? echo $_SESSION['school_code_sms'].$tree_code_sms; ?>
		<span><? echo $tree_nickname; ?></span></h1>
		<small>
        	Observed on
            <!--<select id="loc" name="loc" class="styled1"><option>27.10.2010</option><option>28.10.2010</option></select>-->
			<div><input type="text" name="obdate" id="obdate" value="" readonly="true"/></div> <!-- Changed to stop editing of date-->
        </small>
		
    	<ul class="treePartHeader">
    		<li class="first">LEAVES</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeLeaves">
        	<li class="first">Fresh</li>
            <li class="second" onMouseover="show(this,'no fresh leaves','350pt','100pt');" onMouseout="hide();"><input name="l1" checked="checked" value="0" onclick="toggleRadio(0,1)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with fresh leaves','410pt','100pt');" onMouseout="hide();"><input name="l1" value="1" onclick="toggleRadio(1,1)" type="radio"> <img src="images/l_02.png" alt="Few fresh leaves." title="Few fresh leaves." class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with fresh leaves','470pt','100pt');" onMouseout="hide();"><input name="l1" value="2" onclick="toggleRadio(2,1)" type="radio"> <img src="images/l_03.png" alt="Many fresh leaves." title="Many fresh leaves." class="imgAlignVertical"></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are fresh leaves','560pt','100pt');" onMouseout="hide();"><input name="l1" value="-1" onclick="toggleRadio('x',1)" type="radio"></li>			
        </ul>
		<!--<label class="treeLeaveslabel1" id="lbl1">0</label>-->
        <ul class="treeLeaves">
    		<li class="first">Mature</li>
            <li class="second" onMouseover="show(this,'no mature leaves','350pt','140pt');" onMouseout="hide();"><input name="l2" checked="checked" value="0" onclick="toggleRadio(0,2)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with mature leaves','410pt','140pt');" onMouseout="hide();"><input name="l2" value="1" onclick="toggleRadio(1,2)" type="radio"> <img src="images/ml_02.png" alt="Few matured leaves." title="Few matured leaves."class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with mature leaves','470pt','140pt');" onMouseout="hide();"><input name="l2" value="2" onclick="toggleRadio(2,2)" type="radio"> <img src="images/ml_03.png" alt="Many matured leaves. " title="Many matured leaves." class="imgAlignVertical" ></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are mature leaves','560pt','140pt');" onMouseout="hide();"><input name="l2" value="-1" onclick="toggleRadio('x',2)" type="radio"></li>    	
        </ul>
		<!--<label class="treeLeaveslabel2" id="lbl2">0</label>-->		
        
        
        <ul class="treePartHeader">
    		<li class="first">FLOWERS</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeFlowers">
    		<li class="first">Bud</li>
            <li class="second" onMouseover="show(this,'no buds','350pt','225pt');" onMouseout="hide();"><input name="f1" checked="checked" value="0" onclick="toggleRadio(0,3)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with buds','410pt','225pt');" onMouseout="hide();"><input name="f1" value="1" onclick="toggleRadio(1,3)" type="radio"> <img src="images/bu_02.png" alt="Few buds." title="Few buds."class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with buds','470pt','225pt');" onMouseout="hide();"><input name="f1" value="2" onclick="toggleRadio(2,3)" type="radio"> <img src="images/bu_03.png"  alt="Many buds." title="Many buds."class="imgAlignVertical" ></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are buds','560pt','225pt');" onMouseout="hide();"><input name="f1" value="-1" onclick="toggleRadio('x',3)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFlowerlabel1" id="lbl3">0</label>-->
        <ul class="treeFlowers">
    		<li class="first">Open</li>
            <li class="second" onMouseover="show(this,'no open flowers','350pt','265pt');" onMouseout="hide();"><input name="f2" checked="checked" value="0" onclick="toggleRadio(0,4)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with open flowers','410pt','265pt');" onMouseout="hide();"><input name="f2" value="1" onclick="toggleRadio(1,4)" type="radio"> <img src="images/f_02.png"  alt="Few flowers." title="Few flowers."class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with open flowers','470pt','265pt');" onMouseout="hide();"><input name="f2" value="2" onclick="toggleRadio(2,4)" type="radio"> <img src="images/f_03.png"  alt="Many flowers." title="Many flowers."class="imgAlignVertical" ></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are open flowers','560pt','265pt');" onMouseout="hide();"><input name="f2" value="-1" onclick="toggleRadio('x',4)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFlowerlabel2" id="lbl4">0</label>-->
        
        
        <ul class="treePartHeader">
    		<li class="first">FRUITS</li>
            <li class="second">none</li>
            <li class="third">few</li>
            <li class="fourth">many</li>
            <li class="fifth">don't know</li>    	
        </ul>
    	<ul class="treeFruits">
    		<li class="first">Unripe</li>
            <li class="second" onMouseover="show(this,'no unripe fruits','350pt','350pt');" onMouseout="hide();"><input name="fr1" checked="checked" value="0" onclick="toggleRadio(0,5)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with unripe fruits','410pt','350pt');" onMouseout="hide();"><input name="fr1" value="1" onclick="toggleRadio(1,5)" type="radio"> <img src="images/un_fr_02.png" alt="Few unripe fruits." title="Few unripe fruits."class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with unripe fruits','470pt','350pt');" onMouseout="hide();"><input name="fr1" value="2" onclick="toggleRadio(2,5)" type="radio"> <img src="images/un_fr_03.png" alt="Many unripe fruits." title="Many unripe fruits."class="imgAlignVertical" ></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are unripe fruits','560pt','350pt');" onMouseout="hide();"><input name="fr1" value="-1" onclick="toggleRadio('x',5)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFruitlabel1" id="lbl5">0</label>-->
        <ul class="treeFruits">
    		<li class="first">Ripe</li>
            <li class="second" onMouseover="show(this,'no ripe fruits','350pt','390pt');" onMouseout="hide();"><input name="fr2" checked="checked" value="0" onclick="toggleRadio(0,6)" type="radio"> </li>
            <li class="third" onMouseover="show(this,'less than 1/3rd of tree with ripe fruits','410pt','390pt');" onMouseout="hide();"><input name="fr2" value="1" onclick="toggleRadio(1,6)" type="radio"> <img src="images/fr_02.png"  alt="Few ripe fruits." title="Few ripe fruits."class="imgAlignVertical" ></li>
            <li class="fourth" onMouseover="show(this,'more than 1/3rd of tree with ripe fruits','470pt','390pt');" onMouseout="hide();"><input name="fr2" value="2" onclick="toggleRadio(2,6)" type="radio"> <img src="images/fr_03.png" alt="Many ripe fruits." title="Many ripe fruits." class="imgAlignVertical" ></li>
            <li class="fifth" onMouseover="show(this,'dont know whether or not there are ripe fruits','560pt','390pt');" onMouseout="hide();"><input name="fr2" value="-1" onclick="toggleRadio('x',6)" type="radio"></li>    	
        </ul>
		<!--<label class="treeFruitlabel2" id="lbl6">0</label>-->				
    </div>

    <div class="treeModalRight">
    	
        <h1>Insects/Birds/Animals</h1>
        
        <span>Did you see these eating the leaves?</span>
        <dl onMouseover="show(this,'caterpillar','670pt','110pt');" onMouseout="hide();">
        	<dt><input name="leaf_caterpillar" id="leaf_caterpillar" type="checkbox" value="" /></dt>
            <dd><img src="images/imgCaterpilar.jpg" alt=" " width="62" height="51" /></dd>
        </dl>
        
        <span>Were these pollinating the flowers?</span>
        <dl onMouseover="show(this,'butterflies','660pt','225pt');" onMouseout="hide();">
        	<dt><input name="flower_butterfly" id="flower_butterfly" type="checkbox" value="" /></dt>
            <dd><img src="images/imgButterly.jpg" alt=" " width="62" height="56" /></dd>
        </dl>
        <dl onMouseover="show(this,'bees','710pt','230pt');" onMouseout="hide();">
        	<dt><input name="flower_bee" id="flower_bee" type="checkbox" value="" /></dt>
            <dd><img src="images/imgAnt.jpg" alt=" " width="60" height="56" /></dd>
        </dl>
        
        <span>Were they eating the fruit?</span>
        <dl onMouseover="show(this,'monkey','660pt','340pt');" onMouseout="hide();">
        	<dt><input name="fruit_monkey" id="fruit_monkey" type="checkbox" value="" /></dt>
            <dd><img src="images/imgMonkey.jpg" alt=" " width="56" height="65" /></dd>
        </dl>
        <dl onMouseover="show(this,'birds','710pt','340pt');" onMouseout="hide();">
        	<dt><input name="fruit_bird" id="fruit_bird" type="checkbox" value="" /></dt>
            <dd><img src="images/imgBird.jpg" alt=" " width="47" height="57" /></dd>
        </dl>
        
        
    </div>
	
    <p>
		<input name="" type="submit" value="OK" class="submit1" />  <input name="" class="close" value="CANCEL" type="button" Onclick="ClearDate()">
		<span class="error1" style="display:none"> Observation NOT added. Please Re-enter all data and try again.</span>
		<span class="success1" style="display:none">Added successfully.</span>
    </p>
	</form>
</div>
<!--MODAL Ends-->

<!--MODAL Starts-->
<!--
This dialog box loads on clicking Edit Observations.
It displays a form with From & To dates to filter and load old Observations for editing.
-->

<div id="dialog_edit_obs_filter" class="window treeModal">
	<div class="treeModalLeft">
		<h1><? echo $_SESSION['school_code_sms'].$tree_code_sms; ?>
		<span><? echo $tree_nickname; ?></span></h1>
		<small>
        	To Date 
			<div><input type="text" name="to_obdate" id="to_obdate" value="" readonly="true"/></div><!-- Changed to stop editing of date-->
        </small>
		<small>
        	From Date 
            <div><input type="text" name="from_obdate" id="from_obdate" value="" readonly="true"/></div><!-- Changed to stop editing of date-->
        </small>
		<input class=ok_button type=button value="ok" />
		<div class="observations" id="observations">
		</div>
	</div>
	<p>
		<input name="" class="close" value="CANCEL" type="button">
	</p>
</div>
<!--MODAL Ends-->

<!--MODAL Starts-->
<!--
This dialog box is empty here but is filled dynamically through AJAX by
listobservations.php.
Once loaded it displays the list of old Observations for editing with an Edit and Delete link next to each observation.
-->
<div id="dialog_edit_obs" class="window treeModal">
</div>
<!--MODAL Ends-->


<?php
	list($tree_nickname, $location_type, $tree_height, $tree_girth, $tree_damage, $is_fertilised, $is_watered, $distance_from_water, $degree_of_slope, $aspect, $other_notes, $species_id)=mysql_fetch_row(mysql_query("
									SELECT tree_nickname, location_type, tree_height, tree_girth, tree_damage, 
									is_fertilised, is_watered, distance_from_water, degree_of_slope, aspect, other_notes, species_id
									FROM trees, tree_measurement, user_tree_table 
									WHERE trees.tree_Id=tree_measurement.tree_Id AND tree_measurement.user_id='$_SESSION[user_id]'
									AND trees.tree_Id=user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[user_id]'
									AND trees.tree_Id='$tree_id'"));

switch ($location_type)
{
case "Garden/Park":
$Garden="selected";
break;
case "Avenue":
$Avenue="selected";
break;
case "Forest":
$Forest="selected";
break;
case "Campus":
$Campus="selected";
break;
case "Marsh":
$Marsh="selected";
break;
case "Grassland":
$Grassland="selected";
break;
case "Plantation":
$Plantation="selected";
break;
case "Farmland":
$Farmland="selected";
break;
case "Other":
$Other="selected";
break;
}
?>
<!--MODAL Starts-->
<!-- 
This dialog box is loaded on clicking Edit Tree.
It displays a form with all Tree details like height, nickname etc loaded as it is on DB.
User can edit these details and submit it to change the values on the DB.
-->

<!-- Make sure that this and id=dialog_add_tree in home.php are always in sync-->
<div id="dialog_add_tree" class="window addTreeModal">
 
    <h1>Edit Tree Details</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;Fields marked with <font color="red">*</font> are compulsory.		
			<?php
			$sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[user_id]' AND tree_id <> '$tree_id'");
			echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
			while($row=mysql_fetch_array($sql))
			{
			echo "<option>".$row['tree_nickname']."</option>";
			}
			echo "</select>";
			?>

	<form name="add_tree" id="add_tree" method="POST" action="">
	<input type="hidden" id="species_id" value="<? echo $species_id; ?>" />
    <blockquote class="border">
    	
        <dl>
        	<dt>Nickname<font color="#CC0000">*</font></dt>
            <dd><div><input id="tree_nickname" type="text" value="<? echo $tree_nickname; ?>"/></div>
			<a href="#" title="Please give all your trees a unique nickname. This will help you distinguish your individual trees (e.g. �Home_Neem� from �Street_Neem�) later at the time of adding observations.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Location type</dt>
            <dd><div><select id="location_type" name="location_type">
						<option name="Choose" value="0">-- Choose --</option>
						<option name="Garden/Park" value="Garden/Park" <? echo $Garden; ?>>Garden/Park</option>
						<option name="Avenue" value="Avenue" <? echo $Avenue; ?>>Avenue</option>
						<option name="Forest" value="Forest" <? echo $Forest; ?>>Forest</option>
						<option name="Campus" value="Campus" <? echo $Campus; ?>>Campus</option>
						<option name="Marsh" value="Marsh" <? echo $Marsh; ?>>Marsh</option> 
						<option name="Grassland" value="Grassland" <? echo $Grassland; ?>>Grassland</option> 
						<option name="Plantation" value="Plantation" <? echo $Plantation; ?>>Plantation</option>
						<option name="Farmland" value="Farmland" <? echo $Farmland; ?>>Farmland</option>
						<option name="Other" value="Other" <? echo $Other; ?>>Other</option>
			</select></div></dd>
        </dl>
        <dl>
        	<dt>Height (in m)</dt>
            <dd><div><input id="tree_height" type="text" value="<? echo $tree_height; ?>" /></div>
			<a href="#" title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured).">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Girth (in cm)</dt>
            <dd><div><input id="tree_girth" type="text" value="<? echo $tree_girth; ?>"  /></div>
			<a href="#" title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler.">(?)</a>
			</dd>
        </dl>
        
        
        <dl class="extraTopPadding">
        	<dt>Damaged?</dt>
            <dd>
				<?php
				if ($tree_damage=='0')
				{
					?>
					<td>
					<input type="radio" class="radio" name="tree_damage" value="1" > Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="tree_damage" value="0"  checked="checked"> No</input>
					<?php
				}
				elseif ($tree_damage=='1')
				{
					?>
					<td>
					<input type="radio" class="radio" name="tree_damage" value="1" checked="checked"> Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="tree_damage" value="0"  > No</input>
					<?php
				}
				else
				{
					?>
					<td>
					<input type="radio" class="radio" name="tree_damage" value="1" > Yes</input>
					&nbsp;
					<input type="radio" class="radio" name="tree_damage" value="0"> No </input>
					<?php
				}
				?>
				<a href="#" title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Fertilized?</dt>
            <dd>
				<?php
				if ($is_fertilised==0)
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_fertilised" value="1" > Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="is_fertilised" value="0" checked="checked"> No</input>
					<?php
				}
				elseif ($is_fertilised==1)
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_fertilised" value="1"  checked="checked" > Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="is_fertilised" value="0"> No</input>
					<?php
				}
				else
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_fertilised" value="1"  > Yes</input>
					&nbsp;
					<input type="radio" class="radio" name="is_fertilised" value="0"> No </input>
					<?php
				}
				?>
				<a href="#" title="Many trees in parks, gardens and campuses are regularly fertilized � this affects the phenology of the tree and therefore must be noted.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Watered?</dt>
            <dd>
				<?php
				if ($is_watered==0)
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_watered" value="1" > Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="is_watered" value="0" checked="checked"> No</input>
					<?php
				}
				elseif ($is_watered==1)
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_watered" value="1" checked="checked"> Yes </input>
					&nbsp;
					<input type="radio" class="radio" name="is_watered" value="0"> No</input>
					<?php
				}
				else
				{
					?>
					<td>
					<input type="radio" class="radio" name="is_watered" value="1"  > Yes</input>
					&nbsp;
					<input type="radio" class="radio" name="is_watered" value="0"> No </input>
					<?php
				}
				?>
				<a href="#" title="Many trees in parks, gardens and campuses are regularly watered � this affects the phenology of the tree and therefore must be noted.">(?)</a>
			</dd>
        </dl>
        
        
        <dl class="extraTopPadding">
        	<dt>Distance from Water (m)</dt>
            <dd><div><input type="text" id="distance_from_water" id="distance_from_water" value="<? echo $distance_from_water; ?>" style="width:200px;"></div>
			<a href="#" title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc.">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Degree of slope(�)</dt>
            <dd><div><input type="text" id="degree_of_slope" id="degree_of_slope" value="<? echo $degree_of_slope; ?>" style="width:200px;"></div>
			<a href="#" title="If your plant is on a hill, try to note the incline of the slope in degree by visual estimation (e.g. slope of 20�). ">(?)</a>
			</dd>
        </dl>
        <dl>
        	<dt>Aspect</dt>
            <dd><div>
			<?php
			switch ($aspect)
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
			<select id="aspect" name="aspect">
			<option name="Dont know" value="" <? echo $Dont_know; ?>>Choose one</option>
			<option name="North" value="North" <? echo $North; ?>>North</option>
			<option name="NorthEast" value="NorthEast" <? echo $NorthEast; ?>>North-East</option>
			<option name="East" value="East" <? echo $East; ?>>East</option>
			<option name="SouthEast" value="SouthEast" <? echo $SouthEast; ?>>South-East</option>
			<option name="South" value="South" <? echo $South; ?>>South</option>
			<option name="SouthWest" value="SouthWest" <? echo $SouthWest; ?>>South-West</option>
			<option name="West" value="West" <? echo $West; ?>>West</option>
			<option name="NorthWest" value="NorthWest" <? echo $NorthWest; ?>>North-West</option>
			</select>
		</div>
			<a href="#" title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)">(?)</a>
			</dd>
        </dl>
        
    </blockquote>
    <blockquote>
    	<strong>Other notes (description of tree, location, etc)</strong>
        <p><textarea id="other_notes" cols="" rows=""><? echo $other_notes; ?></textarea></p>
		<div style="width:325px; height:150px; overflow:auto;">
		<table>
		<th colspan=6>
		Assign students<font color="red">*</font>
		</th>
			<?php
				$school_members = mysql_query("SELECT full_name, users.group_id, group_name, group_role, user_id FROM users INNER JOIN user_groups ON users.group_id=user_groups.group_id AND  users.group_id='$_SESSION[group_id]' ORDER BY user_id;");
				$i=0;
				while ($row_settings = mysql_fetch_array($school_members)) 
				{	
					if ($i % 3 == 0) { 
						echo "<tr>";
					}
					list($member_checked) = mysql_fetch_row(mysql_query("SELECT count(*) as c FROM user_tree_table WHERE tree_Id='$tree_id' AND user_id='$_SESSION[user_id]' AND members_assigned like '%$row_settings[user_id]%'"));
			?>
				
					<td width="8%"><input type="checkbox" name="members_assigned<? echo $i; ?>" id="members_assigned<? echo $i; ?>" value="<? echo $row_settings['user_id'];?>" 
					<? if ($member_checked) { echo "checked=yes";};?>/></td>
					<td width="25%"><a href="#"><? echo $row_settings['full_name']; ?></a></td>					
			
			<?php
					$i++;
					if ($i % 3 == 0) { 
						echo "</tr>";
					}					
				}
			?>
			<input type="hidden" id="member_num" value="<? echo $i-1; ?>" />
		</table>			
		</div>
    </blockquote>
    
    <span>
    	<input name="" type="submit" value="OK" class="submit2" /> 
		<!--<input name="" type="Submit" value="OK" onClick="$('#dialog_add_tree').hide();showNext('#dialog2');" />-->
		<input name="" type="button" class="close" value="CANCEL" />
		<span class="error2" style="display:none"> Tree data not edited. Please Re-enter all data and try again.</span>
		<span class="success2" style="display:none">Your tree details have been edited successfully.</span>
    </span>
	</form>
	
    <div class="tooltip" id="tooltip" style="display:none;">
    	<img src="images/tooltipBgTop.jpg" alt=" " width="254" height="7" class="floatLeft" />
        <small>
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy
        </small>
        <img src="images/tooltipBgBottom.jpg" alt=" " width="254" height="7" class="floatLeft" />
    </div>
    
</div>
<!--MODAL Ends-->
<div id="dialog_upload_obs" class="window upload">
    
        <?php
            list($user_tree_id)=mysql_fetch_row(mysql_query("SELECT user_tree_id FROM user_tree_table
            WHERE user_id='$_SESSION[user_id]' AND tree_id='$tree_id'"));
            ?>
        <form name="upload_obs" id="upload_obs" method="POST" action="UploadFile.php" enctype="multipart/form-data">
            <input type="hidden" name="usertreeid" id="usertreeid" value="<?echo $user_tree_id; ?>" />
            <input type="hidden" name="treeid" id="treeid" value="<?echo $tree_id; ?>" />
            <input type="hidden" name="speciesid" id="speciesid" value="<?echo $species_id; ?>" />
            
            <h2 align="center"> Upload observations for <? echo $tree_nickname; ?></h2>
            
            
            <ul>     
                <li>Blank Excel Sheet  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="downloads/SeasonWatchObservationsFormat.xls" target="_blank">download</a></li>
                <li>Upload Excel sheet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="ExcelUploadFile" type="file" id="ExcelUploadFile" size="30"/></li>
            </ul>
            <p align="center">
            <input name="" type="submit" value="Upload" class="submit4" /> 
            <input name="" type="button" class="close" value="Close" />

            <span class="success2" style="display:none">Added successfully.</span>
            </p>
        </form>
</div>

<!-- Mask to cover the whole screen -->
<div id="mask"></div>

<!--
Though currently this function appears to not be called on this page, it is called from the dynamic portion
loaded by AJAX through listobservations.php within the div id=dialog_edit_obs. The observations within that div
will have an Edit link. This function is executed on clicking the Edit link.
-->
<script type="text/javascript" >
<!--	$(".edit_obs_link").click(function(e) {-->
function edit_obs_load(obs_id) {
		//Cancel the link behavior
		//$(this).preventDefault();
		//Get the A tag
		//var id = $(this).attr('href');
		//alert(id);	
		//Get the screen height and width

		dataString  = "observation_id="+obs_id+"&tree_code_sms=<? echo $tree_code_sms; ?>&tree_nickname=<? echo $tree_nickname?>";
		//dataString += "&from_obdate="+document.getElementById('from_obdate').value+"&to_obdate="+document.getElementById('to_obdate').value;
		//alert(dataString);
		$.ajax({
		type: "POST",
		url: "editobservations.php",
		data: dataString,
		success: function(data){
		document.getElementById('dialog_edit_obs').innerHTML=data;
		//window.setTimeout("$('#dialog_edit_tree_filter').fadeOut(1000);$('#mask').fadeOut(500);$('.success2').css('display','none');", 2000);
		}
		});

		$("#obdate1").datepicker({minDate: -180, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
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
<!--	});-->
</script>
<div id="messageBox" style="z-index:9999;display:none;position:absolute;left:0;top:0;background-color:#ffff00;">  
<div id="contents"></div>  
</div>  



 
<!--MODAL Download Starts-->
<div id="dialog3" class="window download">

	<h1>Downloads</h1>
    
    <p>Tree guide book</p>
    <ul>
        <li>(English, pdf, 4.8 MB) - <a href="downloads/TreeGuideBook_English.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>Tree identification book</p>
    <ul>
    	<li>(Bilingual- Malayalam/ English, pdf, 14 MB) - <a href="downloads/TreeIdentificationBook.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>Tree observation sheets/ book</p>
    <ul>
    	<li>Blank data sheets (English, pdf, 0.2 MB) - <a href="downloads/TreeObservationsBlankSheets.pdf" target="_blank">download</a></li>
        <li>Guidelines/ instructions (English, pdf, 0.9 MB) - <a href="downloads/TreeObservationsInstructions.pdf" target="_blank">download</a></li>
    </ul>
    
    <p>SeasonWatch presentation</p>
    <ul>
    	<li>(English, Macromedia flash presentation, zip file, 29 MB) - <a href="downloads/SWSEEDPresentation.zip" target="_blank">download</a></li>
    </ul>
    
    <p>Tree details</p>
     <ul>
    	<li><strong>Part 1</strong> - Jackfruit,Maulsari,Kadamb,Jamun,Gular (English, Microsoft Excel file, 1.1 MB) - <a href="downloads/SeedSWTreeDetails1.xlsx">download</a></li>
        <li><strong>Part 2</strong> - Indian elm,Jarul,Amla,Peepal,Aam(English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails2.xlsx">download</a></li>
        <li><strong>Part 3</strong> - Gamar,Chandada,Saptaparni,Mahua,Teak(English, Microsoft Excel file, 1.5 MB) - <a href="downloads/SeedSWTreeDetails3.xlsx">download</a></li>
        <li><strong>Part 4</strong> - Kaniar,Pangra,Bael,Amaltas,Karanj(English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails4.xlsx">download</a></li>
        <li><strong>Part 5</strong> - Ashoka,Imli,Gulmohur,Rain tree,Semul (English, Microsoft Excel file, 1 MB) - <a href="downloads/SeedSWTreeDetails5.xlsx">download</a></li>
    </ul>
    
  
    
    <span>
    	<input name="" type="button" class="close" value="CLOSE" />
    </span>
</div>
<!--MODAL Ends--> 
 
 
 
<!--MODAL learn Starts-->
<div id="dialog4" class="window learn">

	<h1>Learn</h1>
    
    <p>This is an <strong>audio presentation</strong>.<br />Please turn on your <strong>speakers</strong> or use your <strong>headphones</strong> to hear what is being said.</p>
    
	<span>
    	<input name="#dialog5" type="button" class="nowOpen" value="OK" style="width:52px;" />
    </span>
</div>
<!--MODAL Ends-->

<!--MODAL learn Starts-->
<div id="dialog5" class="window learn">

	<h1>Learn</h1>
    
    <p>
    	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="780" height="390">
        <param name="movie" value="Main Menu.swf" />
        <param name="quality" value="high" />
        <embed src="Main Menu.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="780" height="390"></embed>
        </object>
    </p>
    
	<span>
    	<input name="" type="button" class="close" value="CLOSE" />
    </span>
</div>
<!--MODAL Ends-->

</body></html>

<?php
?>