<?php
    require 'dbh.inc.php';

    $flood = '';
    $security = '';
    $q7 = '';
    $q8 = '';
    $q9 = '';
    $q10 = '';
    $q11 = '';
    $q12 = '';
    $q13 = '';
    $q14 = '';

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '1' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $flood .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '2' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $security .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '7' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q7 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '8' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q8 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '9' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q9 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '10' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q10 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '11' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q11 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '12' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q12 .= $row['cluster'].'. ';
        }
    }
    
    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '13' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q13 .= $row['cluster'].'. ';
        }
    }

    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '14' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $q14 .= $row['cluster'].'. ';
        }
    }

    if(!empty($flood)){
        echo 'Clean all the canals near these rental stalls in '.$flood.' and renovate pathways to avoid flood.';
    }if(!empty($security)){
        echo 'Intensify your security in '.$security.' for the tenants to feel more safe and comfortable.';
    }if(!empty($q7)){
        echo 'Invite all tenants of '.$q7.' to undergo counseling and to avoid chaos.';
    }if(!empty($q8)){
        echo 'Provide better ventilation in '.$q8.' for the tenants to feel more comfortable.';
    }if(!empty($q9)){
        echo 'Maintain the water supply in '.$q9.' and build a water storage for back-up.';
    }if(!empty($q10)){
        echo 'Fix the problem of your electricity in '.$q10.' to have a better supply of electricity.';
    }if(!empty($q11)){
        echo 'Invite all tenants of '.$q11.' in your office to give an advice on how to catch more customers.';
    }if(!empty($q12)){
        echo 'Always observe cleanliness in '.$q12.' and have a weekly general cleaning.';
    }if(!empty($q13)){
        echo 'Improve the design of rental stalls of '.$q13.' to be more presentable for the customers.';
    }if(!empty($q14)){
        echo 'Visit some tenants of '.$q14.' and remind them to pay their rental bills on time.';
    }
?>