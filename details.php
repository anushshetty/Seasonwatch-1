<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
﻿<?php 
/*Initial Development :- This page will be displayed once user clicks on details link.*/
	ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
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
<!-- script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/googletrack.js"></script>
<script type="text/javascript" src="js/loginfunction.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  // Code using $ as usual goes here.
  //The DOM is now loaded and can be manipulated.
});
</script>
</head>

<body>
  


    <?php include ("includes/headerbeforelogin.php"); ?> <!--  start header_place_holder  -->
     <!--  end header_place_holder  -->
          <div class="body_content"> <!--  start body_content  -->
            <!--  start body_top  -->
    	<div class="body_top">
        <!--  start main  -->
        	<div class="main">
               	<h3 class="Rhythm_TEXT"><a name="seasonwatch">Why SeasonWatch</a></h3>
                 <div class="container"> 
                 	<div class="left_BOX">
                 		<p class="leftSection_TEXT">
                                  All of us have observed how the annual temperature and rainfall patterns in the country are 
                                  changing rapidly. Along with the seasons, the flowering and fruiting patterns of common trees 
                                  like the Mango and Amaltas also appear to be changing every year. But these are just impressions 
                                  and are not based on solid information from across the country.</p>
                                 <p class="leftSection_TEXT">With SeasonWatch we hope to fill this gap in with what we know. 
                                     By systematically recording the changing patterns of plant life, and understanding how climate 
                                     affects their lifecycle, we can work together with Nature to conserve her bounty.</p> 
                        </div>
                    	<div class="Right_SECTION_TEXT"><img src="images/imagefive.png" alt="image" /></div>
                        
                </div>  
                    <div class="Right_SECTION_TEXT">
                    <p> Also, the seasonal cycles can be fascinating to observe, as well as reveal a whole new world of micro-cycles within them!
                    Here is an example of a chain of ecological interactions that depends on the seasonal resources trees provide:
                    <ul>
                    <li><b>Caterpillars</b> and <b>monkeys</b> eat fresh leaves.</li>
                    <li><b>Bees</b> and <b>butterflies</b> flit over the flowers for nectar, and pollinate the flowers while they do so.</li>
                    <li><b>Birds,</b> squirrels, bats and people eat the fruit.</li>
                    </ul>
                    </p> 
                    </div>
            </div><!--  end main  -->
         </div><!--  end body_top  -->
        <div class="clearBoth"></div> <!--  start body_top1  -->
        <div class="body_top1"><!--  start main  -->
          	<div class="main">
                 <div class="container"> 
                    <div class="left_BOX">
                        <p>
                            <img src="images/imagegroup.jpg" alt="image" />
                        </p>  
                    </div>
                   
                    <div class="Right_SECTION">
                        <h3 class="Rhythm_TEXT_details_right "><a name="seastree">Monitored Trees</a></h3>
                        <div class="Right_SECTION_TEXT">
                            <p >
                            Some of the trees being monitored under SeasonWatch are Jackfruit (Kathal),
                            Indian Blackberry (Jamun), Pride of India (Jarul), Indian Gooseberry (Amla),
                            Mango (Aam), Banyan (Bargad), Devil’s Tree (Saptaparni), Purple Bauhinia (Kaniar),
                            Indian Coral Tree (Pangra), Flame of the Forest (Dhak/Palash), Indian Laburnum (Amaltas), 
                            Pongam Tree/Indian Beech (Karanj), Tamarind (Imli), Margosa (Neem), Flame Tree (Gulmohur),
                            Red Silk Cotton Tree (Semul).</p>
                            <p >Can you recognize all these beautiful trees of India? This is not the complete list but 
                            after you register, you can learn how to recognize and relate to all these SeasonWatch trees.</p> 
                            </p>
                        </div>
                    </div>
                </div> 
            </div><!--  end main  -->
        </div> <!--  end body_top1  -->
        <div class="clearBoth"></div>
        	<div class="clearBoth"></div>
        	<div class="body_top1"><!--  start body_top2  --><!-- who's involved-->
                    <div class="main">  <!--  start main  -->          	
                    <h3 class="Rhythm_TEXT"><a name="Involve">Who's Involved</a></h3>
                    <div class="container">                    
                        <div class="left_BOX">
                            <p class="leftSection_TEXT">
                            SeasonWatch is part of the Citizen Science program at 
				the National Centre for Biological Sciences (NCBS), the biological 
				wing of the Tata Institute of Fundamental Research (TIFR). Nature 
				Conservation Foundation (NCF) an NGO that does pioneering work in 
				conservation biology in various ecosystems across India provides valuable 
				expertise and support to the program. SeasonWatch is funded by Wipro 
				Applying Thought in Schools (WATIS), the division of Wipro that works 
				extensively with many NGOs across India on educational reforms in schools.</p>  
                        </div>
                        <div class="Right_SECTION">                      
                            <p class="Right_PARAGRAPH">
                            
                            </p>
                        </div>
                    </div>    
                    </div> <!--  end main  -->
                </div>
        <!--  end body_top2  -->
        <div class="clearBoth"></div> 
     	<div class="body_top1">
        	<div class="main">
            	       <div class="container"> 
                 	<div class="left_BOX">
                	 </div>
                      <div class="Right_SECTION">
			   <h3 class="Rhythm_TEXT_details_right"><a name="Results">Explore the Results</a></h3>
                        <div class="Right_SECTION_TEXT">
                            <p>
                                All the observations that are part of the SeasonWatch 
                                database become interesting when you can play around with them. 
                                This means that you can ask interesting questions and studying 
                                the SeasonWatch observations data can discover your own answers. 
                                (remember that this is an open-source project and ALL participants
                                get full access to ALL data). 
                                Once the observations start flowing in, combining them with other
                                information available in the public domain, you can possibly get 
                                answers to questions like:</p>
                                <ul >
                                <li >How does the flowering time of Neem change across India?</li>
                                <li >Is fruiting of Tamarind different in different 
                                parts of the country depending on rainfall in 
                                the previous year?</li>
                                <li>Is year-to-year 
                                variation in flowering and fruiting time of Mango 
                                related to winter temperatures?</li>
                                </ul>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="body_top2">
         	<div class="main"> <a name="faq"><!--  start main  -->       	
                    <h3 class="Rhythm_TEXT">FAQ</h3></a>
                     <div class="container">                    
                            <div class="left_BOX">
                                    <p>
                                        <ul class="leftSection_TEXT"> 
                                            <li><h4>Q.&nbsp;Can I participate?</h4></li>
                                            <li><b>A.</b>&nbsp;Anyone interested 
                                                in trees and the changing climate can 
                                                register and participate. You can 
                                                register as an individual or as a school.
                                                More details are available when you register. 
                                            </li>
                                        </ul>
                                        <ul class="leftSection_TEXT">   
                                            <li><h4>Q.&nbsp;When can I start?</h4></li>
                                            <li><b>A.</b>&nbsp;There are no time
                                                limitations or starting dates. You can 
                                                start participating any time. How about 
                                                today?
                                            <li>
                                        </ul>
                                        <br/>
                                      </p>  
                            </div>
                            <div class="Right_SECTION">                      
                                    <p>
                                        <ul class="Right_SECTION_TEXT">
                                            <li><h4> Q.&nbsp;How much time do I have to spend 
                                                    monitoring each tree?</h4></li>
                                            <li><b>A.</b>&nbsp;About five minutes 
                                                per tree to look at it 
                                                closely. This needs to be done only 
                                                once a week so it takes only a little
                                                time to connect with your tree and 
                                                observe it for any changes.
                                            </li>
                                        </ul>
                                       
                                        <ul class="Right_SECTION_TEXT">
                                            <li><h4> Q.&nbsp;What if I have more questions?</h4></li>
                                            <li><b>A.</b>&nbsp;Drop an email to sw@seasonwatch.in and we will be 
							very happy to answer all your queries. You can also download the SeasonWatch handbook (17 Mb pdf) that 
							has the step-by-step procedure on how to participate by clicking <a href="downloads/SW_HandBook.pdf" target=_blank><span class="redColor">here</span></a>.
                                            </li>
                                        </ul>
                                   </p>
                            </div>
                    </div>    
            </div> <!--  end main  -->
          </div>
        <div class="clearBoth"></div>
   </div>
    <!--  end body_content  -->
     <div class="clearBoth"></div>
    <!--  start footer  -->
    <?php include ("includes/footer.php"); ?>
    <!--  end footer  -->
    <div class="clearBoth"></div>
</body>
</html>
