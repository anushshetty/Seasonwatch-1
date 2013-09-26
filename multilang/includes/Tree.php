<?php

//include "includes/dbcon.php";

abstract class Species
{
	var $Species_id;
	var $Species_common_name;
	var $species_scientific_name;
	var $species_family;
	var $species_image;
	
	function readSpecies(){
		echo "hi";
	}
	function editSpecies(){
		echo "hi";
	}

}

class Tree_measurement
{

	var $measurement_id;
	var $date_of_msmt;
	var $girth;
	var $height;
	var $damage;
	var $other_notes;
	var $is_fert;
	var $is_wate;
	var $is_dama;
	var $deg_of_slope;
	var $aspect;
	var $distance_from_water;

}


Class Tree extends Species 
{

	var $Tree_id;
	var $Addedby_userid;
	var $Tree_nickname;
	var $Tree_desc;
	var $Tree_loc_type;
	var $members_assigned;
	var $user_tree_id;
	
	var $Loc_id;
	var $Loc_name;
	var $Loc_city;
	var $Loc_state;
	var $Loc_zoom;
	
	var $treemsmtobj=array();
	
	function __construct() {
				//AddTree();	
	}

	static function viewTreeinfo($dbc,$Tree_id)
	{
	
	    $query_tree="SELECT tree_nickname, species_primary_common_name,species_scientific_name,species_master.species_id, members_assigned, trees.tree_Id as tid, user_tree_id FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND trees.tree_Id='$Tree_id') ON species_master.species_id = trees.species_id ";
            //echo $query_tree;
            $tree_rec=$dbc->readtabledata($query_tree);
            $treeInfo = mysql_fetch_array($tree_rec);
            $Tree_nickname =$treeInfo[0];
            return ($treeInfo);
		
	}
	
	
	
	function AddTree()
	{

	}

	function Edittree()
	{
	}

	function Deletetree()
	{
	}
	
	function readlocation(){}
	function addLocation(){}
	function editLocation(){}

	function addnewmeasurement()
	{
		//$treemsmtobj[] =new Tree_measurement();
	}

 }

?>