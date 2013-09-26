<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>

<div class="footer_SECTION">
    <div class="main">
        <div class="container">
            <div class="footerNAV">
                <ul>
                    <li><a class="select" href="index.php">Home</a></li>
                    <li><a href="details.php">Details </a></li>
		    <li><a href="javascript:void(0)" onclick = "document.getElementById('lightdownload').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);">Download </a></li>
                      <li><a href="javascript:void(0)" onclick = "document.getElementById('lightcontactus').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);">Contact us </a></li>
					  <? if (isset($_SESSION['log_status']) == 'Y') {?>
					  <li><a href = "#">Register</a></li>
                 <?}else{?>
                    <li><a href = "javascript:void(0)" onclick = "document.getElementById('lightReg').style.display='block';document.getElementById('fade').style.display='block';window.scrollTo(0, 0);">Register</a></li>
			     <?}?>
                </ul>
            </div>
            <div class="partner_SECTION ">
            
                        <ul class="footer_logo">
                        <li style="padding-left: 0px;"><a href="http://ncbs.res.in" target="_blank"><img src="images/ncbs-logo.png" alt=""  width="200" height="72"/></a></li>
                        <li style="padding-left: 50px;"><a href="http://www.wiproeducation.com" target="_blank"><img src="images/WiproLogo.gif" alt=""  width="150" height="150"/></a></li>
                         <li style="padding-left: 70px;"><a href="http://ncf-india.org" target="_blank"><img src="images/NCFLogo.gif" alt="" width="200" height="72" /></a></li>
                    </ul>
                  <div class="footer_menu">
                    <ul class="footer_menu">
                        <li style="font-size:18px;padding-left: 30px;"><a href="http://www.mbiseed.com" target=_blank>Matrubhoomi SEED </a></li>
                        <li style="font-size:18px;padding-left: 5px;"><a href="http://www.cseindia.org/taxonomy/term/20071/menu" target=_blank>Green Schools Program </a></li>
                         <li style="font-size:18px;padding-left:5px;"><a href="https://sites.google.com/site/efloraofindia/" target=_blank>efloraofindia </a></li>
                    </ul>
               </div>
                  
           
              
        </div>
           
    </div>
</div>

    <script language="javascript"> 
    function toggleHM() {
    var ele1 = document.getElementById("toggleTextHM");
    var text1 = document.getElementById("displayTextHM");
    if(ele1.style.display == "block") {
    ele1.style.display = "none";
    text1.innerHTML = "More";
    }
    else {
    ele1.style.display = "block";
    text1.innerHTML = "Less";
    }
    }

    </script>
 <div id="lightdownload" class="white_contentdown">
                            <a href = "javascript:void(0)" onclick = "document.getElementById('lightdownload').style.display='none';document.getElementById('fade').style.display='none';"><img src="images/close.png" alt="close" /></a>
                            <div class="registerLightBoxDown">
                                <form name="regstep1">
                                <h2>Download</h2>
                                <br>
                                <div id=mainHolder class="message">
                                    Welcome to the Downloads page of the SeasonWatch website. <br>
                                    You can download the files from here to learn more about and to participate in the 
                                    SeasonWatch program. 
                                </div> 
                                <h4> HandBook:</h4>
                                 <ul>
                                    
                                     <li>
                                        SeasonWatch Handbook <a href="downloads/SW_HandBook.pdf" target=_blank>(download. 14 MB)</a>&nbsp;<a id="displayTextHM" href="javascript:toggleHM();" title="">More</a></br>
                                        <div id="toggleTextHM" style="display: none" class="moremessage">This is the SeasonWatch handbook. 
                                        It has ALL THE INSTRUCTIONS AND INFORMATION needed for you to start SeasonWatching today.</div>
                                        </li>
                                    
                                  </ul>

                                </form>
                            </div>
                        </div>
    
    <div id="lightcontactus" class="white_contentdown">
        <a href = "javascript:void(0)" onclick = "document.getElementById('lightcontactus').style.display='none';document.getElementById('fade').style.display='none';"><img src="images/close.png" alt="close" /></a>
        <div class="registerLightBoxDown">
        <h2>Contact us </h2>
        <br>
        <div class="centermessage" >
            
                    Dr. Suhel Quader<br>
                    Head, Citizen Science Division<br>
                    National Centre for Biological Sciences<br>
                    GKVK campus, Bellary Road<br>
                    Bangalore - 560 065<br>
                    Karnataka.<br>
                 
                    Email:   <a href="mailto:sw@seasonwatch.in">sw@seasonwatch.in</a>, <a href="mailto:ashish@seasonwatch.in">ashish@seasonwatch.in</a><br>
                    Mobile:   0-9871702439<br>
                    <br>
        
        </div> 
    </div>
    </div>
