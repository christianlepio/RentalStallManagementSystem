<?php
    require 'dbh.inc.php';
    
    $sikwel = "SELECT DISTINCT(DATE(response_date)) as rsdate FROM response_tbl WHERE surveyid = '2' ORDER BY cluster ASC;";
    $ressikwel  = mysqli_query($conn, $sikwel);
    $ressikwelCheck = mysqli_num_rows($ressikwel);

    if($ressikwelCheck>0){
        while($row = mysqli_fetch_assoc($ressikwel)){
            $response_date = $row['rsdate'];
            $yearDate = explode('-',$response_date);
            $yearmonth = $yearDate[0].'-'.$yearDate[1];
            //echo $yearmonth.'<hr>';
            $sql1 = "SELECT DISTINCT(cluster) as clus FROM response_tbl WHERE DATE(response_date) = '$response_date' AND surveyid = '2' ORDER BY cluster ASC;";
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
                            $no = 0;
                            $aveyes = 0;
                            $aveno = 0;

                            //YES RESPONSE
                            $sikwel3 = "SELECT COUNT(response) AS yesresponse FROM response_tbl WHERE questionid = '$quesid' AND response = '2' AND cluster = '$cluster' AND DATE(response_date) = '$response_date' AND surveyid = '2';";
                            $ressikwel3 = mysqli_query($conn, $sikwel3);
                            $ressikwel3Check = mysqli_num_rows($ressikwel3);

                            if($ressikwel3Check){
                                while($row3 = mysqli_fetch_assoc($ressikwel3)){
                                    $yes = $row3['yesresponse'];
                                    $aveyes = ($yes / $tottenant) * 100;
                                }
                            }
                            //NO RESPONSE
                            $sikwel4 = "SELECT COUNT(response) AS noresponse FROM response_tbl WHERE questionid = '$quesid' AND response = '1' AND cluster = '$cluster' AND DATE(response_date) = '$response_date' AND surveyid = '2';";
                            $ressikwel4 = mysqli_query($conn, $sikwel4);
                            $ressikwel4Check = mysqli_num_rows($ressikwel4);

                            if($ressikwel4Check){
                                while($row4 = mysqli_fetch_assoc($ressikwel4)){
                                    $no = $row4['noresponse'];
                                    $aveno = ($no / $tottenant) * 100;
                                }
                            }

                            $query2 = "SELECT syearmonth, cluster, surveyid, questionid FROM problem_tbl WHERE syearmonth = '$yearmonth' AND cluster = '$cluster' AND surveyid = '2' AND questionid = '$quesid';";
                            $resquery2 = mysqli_query($conn, $query2);
                            $resqueryCheck2 = mysqli_num_rows($resquery2);
        
                            echo mysqli_error($conn);
        
                            if($resqueryCheck2 > 0){
                                $sikwel11 = "UPDATE problem_tbl SET resyes = '$aveyes', resno = '$aveno' 
                                WHERE syearmonth = '$yearmonth' AND cluster = '$cluster' AND surveyid = '2' AND questionid = '$quesid';";
                                $ressikwel11 =  mysqli_query($conn, $sikwel11);
                            }else{
                                $sikwel1 = "INSERT INTO problem_tbl (syearmonth, cluster, surveyid, questionid, question, resyes, resno) 
                                VALUES('$yearmonth', '$cluster', '2', '$quesid', '$question', '$aveyes', '$aveno');";
                                $ressikwel1 = mysqli_query($conn, $sikwel1);
                                echo mysqli_error($conn);
                            }

                            //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; YES - '.$aveyes.'&nbsp; | &nbsp;';
                            //echo 'NO - '.$aveno.'<br>';
                        }
                    }
                //echo '<hr>';
                }
            }
        }
    }

?>