<?php
// function get all the sundays of the last2 months.   
    $last2month=date("Y-m-d", strtotime("-2 month") ) ;
    $today=date("Y-m-d");
    $nxtmonday= date('Y-m-d', strtotime('next monday'));
    $start = strtotime($last2month); 
    $end   = strtotime($nxtmonday); 
    $Allmondays = array(); 
    $mondays = array(); 
    if(date('N', $start)==7){ 
    $Allmondays[] = date('Y-m-d', $start); 
    } 
    for($start=strtotime('next monday', $start);$start <= $end; $start=strtotime('next monday', $start)){ 
    $Allmondays[] = date('Y-m-d', $start); 
   }
    //store only 8 mondays.    
   if (count($Allmondays) >8)
   {
       $noMonday=count($Allmondays);
      $eihtonly=8;
      $diff = $noMonday-7;
      for($j=$diff-1;$j<$noMonday;$j++)
      {
          $mondays[]=$Allmondays[$j];
      }
   }

?>