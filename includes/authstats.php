<?php

header('Content-Type: application/json');

require 'dbh.inc.php';
session_start();
$taon = $_SESSION['taon'];

$dataYear = array();
$dataMonth = array();
$data = array();

/*
$sql = "SELECT DISTINCT(MONTH(paymentdate)) as months, SUM(total) as tototal FROM payment_tbl WHERE YEAR(paymentdate) = '$taon' ORDER BY YEAR(paymentdate) DESC;";
$result = mysqli_query($conn, $sql);
$resCheck = mysqli_num_rows($result);

print json_encode(mysqli_error($conn));

if($resCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}
*/

$sql = "SELECT DISTINCT(YEAR(paymentdate)) as years FROM payment_tbl WHERE YEAR(paymentdate) = $taon ORDER BY YEAR(paymentdate) DESC";
$result = mysqli_query($conn, $sql);
$resCheck = mysqli_num_rows($result);

if($resCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        
        $dataYear[] = $row['years'];

        $year = $row['years'];

        $sql1 = "SELECT DISTINCT(MONTH(paymentdate)) as months FROM payment_tbl WHERE YEAR(paymentdate) = $year ORDER BY MONTH(paymentdate) ASC";
        $result1 = mysqli_query($conn, $sql1);
        $resCheck1 = mysqli_num_rows($result1);
        
        if($resCheck1 > 0){
            while($row1 = mysqli_fetch_assoc($result1)){
                
                $dataMonth[] = $row1['months'];
                
                $month = $row1['months'];
                $sql2 = "SELECT YEAR(paymentdate) as years, MONTHNAME(paymentdate) as months, SUM(total) as tototal FROM payment_tbl WHERE YEAR(paymentdate) = $year AND MONTH(paymentdate) = $month ORDER BY MONTH(paymentdate) ASC";
                $result2 = mysqli_query($conn, $sql2);
                $resCheck2 = mysqli_num_rows($result2);

                if($resCheck2 > 0){
                    while($row2 = mysqli_fetch_assoc($result2)){

                            $data[] = $row2;
                    }
                }
            }
        }
    }
}


print json_encode($data);