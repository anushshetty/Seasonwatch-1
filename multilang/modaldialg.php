<?php ?>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript">
$(document).ready(function() {
	//$('#dialog').dialog();
	
	 $('#dialog').dialog({
                    modal: true,
                    autoOpen: false,
                    width: 760,
                    height: 'auto',             
                    close: function(event, data) {
                   
                    }
                });
	
	
	$('#dialog_link').click(function(e) {

		e.preventDefault();
		$('#dialog').load("indivaddtree.php",function() {
		
		$('#dialog').dialog("open");

		});
		//$('#dialog').style.display='block';
		return false;
	});
});
</script>
<html>
<head>
<title>test</title>
</head>
<body>

<div id="dialog" title="Dialog Title" style="display:none"> Some text</div>  
   <p id="dialog_link">Open Dialog</p>  

</body>

</html>