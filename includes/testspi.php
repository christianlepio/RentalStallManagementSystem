<?php
    require 'dbh.inc.php';
    
    $sikwel = "SELECT DISTINCT(DATE(response_date)) as rsdate FROM response_tbl WHERE surveyid = '2' ORDER BY response_date DESC;";
    $ressikwel  = mysqli_query($conn, $sikwel);
    $ressikwelCheck = mysqli_num_rows($ressikwel);

    $no=0;
    if($ressikwelCheck>0){
        while($row = mysqli_fetch_assoc($ressikwel)){
            $response_date = $row['rsdate'];
            $yearDate = explode('-',$response_date);
            $yearmonth = $yearDate[0].'-'.$yearDate[1];
            //echo $yearmonth.'<hr>';
            $sql1 = "SELECT DISTINCT(cluster) as clus FROM response_tbl WHERE DATE(response_date) = '$response_date' AND surveyid = '2' ORDER BY response_date DESC;";
            $result1 = mysqli_query($conn, $sql1);
            $resCheck1 = mysqli_num_rows($result1);

            if($resCheck1 > 0){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $tottenant = 0;
                    $surveyid = 2;

                    $cluster = $row1['clus'];
                    //echo $cluster.'<br>';

                    $sql = "SELECT COUNT(DISTINCT(tenantid)) AS tottenant FROM response_tbl WHERE cluster = '$cluster' AND DATE(response_date) = '$response_date' AND surveyid = '2';";
                    $res = mysqli_query($conn, $sql);
                    $resCheck = mysqli_num_rows($res);

                    if($resCheck > 0){
                        while($ro = mysqli_fetch_assoc($res)){
                            $tottenant = $ro['tottenant'];
                        }
                    }
                    //echo '&nbsp; Tottal tenant: '.$tottenant.'<br>';

                    $sikwel2 = "SELECT DISTINCT(questionid) AS quesid , question FROM response_tbl WHERE cluster = '$cluster' AND DATE(response_date) = '$response_date' AND surveyid = '2';";
                    $ressikwel2 = mysqli_query($conn, $sikwel2);
                    $ressikwel2Check = mysqli_num_rows($ressikwel2);

                    if($ressikwel2Check>0){
                        while($row2 = mysqli_fetch_assoc($ressikwel2)){
                            //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$row2['quesid'].'.&nbsp; '.$row2['question'].'<br>';
                            $quesid = $row2['quesid'];
                            $question = $row2['question'];

                            $yes = 0;

                            //YES RESPONSE
                            $sikwel3 = "SELECT response AS yesresponse, stallno, tenantid, tenantlastname, response_date FROM response_tbl WHERE questionid = '$quesid' AND cluster = '$cluster' AND DATE(response_date) = '$response_date' AND surveyid = '2';";
                            $ressikwel3 = mysqli_query($conn, $sikwel3);
                            $ressikwel3Check = mysqli_num_rows($ressikwel3);
                            
                            if($ressikwel3Check){
                                while($row3 = mysqli_fetch_assoc($ressikwel3)){
                                    $tname = $row3['tenantlastname'];
                                    $stallno = $row3['stallno'];
                                    $dateres = $row3['response_date'];
                                    $yes = $row3['yesresponse'];
                                    $aveyes = ($yes / $tottenant) * 100;
                                    if($quesid == 1 && $yes == 2){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'The stall area is prone to flood.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 2 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'The tenant has a problem with their safety and security in their stall area.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);
                                        
                                    }elseif($quesid == 7 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'The tenant has a problem with the behavior of his/her co-tenant.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);
                                        
                                    }elseif($quesid == 8 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'The tenant has a problem with the ventilation of their stall area.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 9 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Unstable Water Supply.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 10 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Unstable supply of electricity.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 11 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Sales weakened / Loss of income.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 12 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Dirty environment.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 13 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Unattractive stall area.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);

                                    }elseif($quesid == 14 && $yes == 1){
                                        $shql = "INSERT INTO stallhistory_tbl (questionid, tenantname, cluster, stallno, problem, date_created)
                                        VALUES('$quesid', '$tname', '$cluster', '$stallno', 'Did not pay rental bills on time.', '$dateres');";
                                        $shres = mysqli_query($conn, $shql);
                                    }
                                }
                            }
                        }
                    }
                //echo '<hr>';
                }
            }
        }
    }
?>