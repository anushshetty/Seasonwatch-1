<?php /************SEASONWATCH.IN VER 1.0 RELEASE Date: 22 Jul 2013 *********/?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Page get all seed users
 */

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('display_errors','On'); /* to display the errors*/
    ini_set('error_reporting', E_ALL);
    session_start();
    //include_once("includes/dbcon.php");
    include 'includes/Login.php';
    include 'includes/loginsubmit.php';
    $dbc = Dbconn::getdblink();
    $dbc->Connecttodb();
    
    $data=array();
    $comma=",";
    $data[0]="schoolname".$comma."coord name".$comma."seeduserid".$comma."EducationDistrict".$comma."Email";
    //get all seed users 
     $AllRegusersql="SELECT DISTINCT users.user_id,users.educational_district, users.user_name,users.user_category, users.user_email, users.group_id, users.full_name, users.state_id, users.date_of_addition, users.date, user_groups.group_name
FROM users, user_groups
WHERE user_id !=  '140'
AND user_category =  'school-seed'
AND user_groups.coord_id = users.user_id";
                    echo $AllRegusersql;
                    $dbc=Dbconn::getdblink();
                      $induser = $dbc->readtabledata($AllRegusersql);
               while ($induser_row = mysql_fetch_array($induser))
                    {
                    $schoolname=$induser_row['group_name'];
                    $schoolname= str_replace(',', '-',  $schoolname);
                    $coordname=$induser_row['full_name'];
                    $coordname= str_replace(',', '-',  $coordname);
                    $seedlogin =$induser_row['user_name'];
                    $seedlogin= str_replace(',', '-',  $seedlogin);
                    $edudisitrict= $induser_row['educational_district'];
                    $edudisitrict= str_replace(',', '-',  $edudisitrict);
                    $useremail=$induser_row['user_email'];
                    $useremail= str_replace(',', '-',  $useremail);
                      $IndUsertreesql="select utt.tree_nickname,utt.user_tree_id,utt.tree_id,utt.date_of_addition,utt.last_observation_date,t.species_id
                                    from trees as t ,user_tree_table as utt where t.deleted = 0 and 
                                   utt.user_id='$induser_row[user_id]' and t.tree_Id= utt.tree_id
                                        and utt.user_id!=140";
                                $indusertrees = $dbc->readtabledata($IndUsertreesql);
                                $NoOfTrees=mysql_num_rows($indusertrees);
if ($NoOfTrees >'0')
                               {
                     $data[]=$schoolname.$comma.$coordname.$comma.$seedlogin.$comma.
                             $edudisitrict.$comma.$useremail;
                               }
                    }
                    $filename="AllSeeduserwithtree.csv";
                    writecsvfile($filename,$data);
function writecsvfile($filename,$data)
                        {
                            $file = fopen($filename,"w");
                            foreach ($data as $line)
                            {
                            fputcsv($file,explode(',',$line));
                            }

                            fclose($file);

                            
                        }
                        
                    ?>

