<?php
    $connection = mysql_connect("localhost","root","root");

    if(!$connection)
    {
        die('could not connect: '. mysql_error());
    }

    mysql_select_db("seasonwatch",$connection);


    $json_collections = array();

    // add more queries here.
    $json_collections["species_trees"]="select species_master.*, count(*) as cnt, species_primary_common_name as species_name from trees natural join species_master group by species_id order by cnt desc";
    //$json_collections["species_datapoints"]="select species_master.*, count(*) as cnt, species_primary_common_name as species_name from user_tree_observations natural join species_master group by species_id order by cnt desc";

    $data=array();
    $models = "";
    function modelCase($name) {
        $newName = '';
        $parts = explode('_', $name);
        foreach ($parts as $part) {
            $newName .= ucfirst($part);
        }
        return $newName;
    }

    foreach ($json_collections as $collection => $query) {

        echo "$collection -> $query\n";
        $r=mysql_query($query);
        if(!$r)
        {
            die("query \"$query\" not executed: ".mysql_error());
        }

        $json_object = array();
        while($row=mysql_fetch_assoc($r))
        {
                $json_object[] = $row;
        }
        $data[modelCase($collection)] = $json_object;
        $models .= sprintf("Data.%s = new Meteor.Collection(\"%s\");\n", modelCase($collection), $collection);
    }

    file_put_contents("data.js" , "self=this; if (Meteor.isServer) { self.DataSet=" . json_encode($data). "; };");
    file_put_contents("models.js" , "Data = {}; " . $models);

