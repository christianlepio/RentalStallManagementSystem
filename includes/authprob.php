<?php

header('Content-Type: application/json');

require 'dbh.inc.php';
session_start();
$taon = $_SESSION['taonbuwan1'];
$cluster = $_SESSION['clusec'];

$data = array();

$sql = "SELECT * FROM problem_tbl WHERE syearmonth = '$taon' AND cluster = '$cluster';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

print json_encode($data);