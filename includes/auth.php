<?php

header('Content-Type: application/json');

require 'dbh.inc.php';

$data = array();
$data1 = array();

$sikwel = "SELECT DISTINCT(cluster) AS cluster_distinct FROM rental_tbl ORDER BY cluster ASC;";
$results = mysqli_query($conn, $sikwel);
$resultsCheck = mysqli_num_rows($results);

if($resultsCheck > 0){
    while($rows = mysqli_fetch_assoc($results)){
        
        $distinctCluster = $rows['cluster_distinct'];
        
        $sikwel1 = "SELECT DISTINCT(cluster) AS cluster_distinct, COUNT(cluster) AS countCluster FROM rental_tbl WHERE cluster='$distinctCluster' AND status='Available';";
        $results1 = mysqli_query($conn, $sikwel1);
        $resultsCheck1 = mysqli_num_rows($results1);

        if($resultsCheck1 > 0){
            while($rows1 = mysqli_fetch_assoc($results1)){
                $data[] = $rows1;                     
            }
        }
    }
}

print json_encode($data);