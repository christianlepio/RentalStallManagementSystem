<?php
    require 'dbh.inc.php';

    $sql = "SELECT DISTINCT(DATE(response_date)) as rsdate FROM response_tbl ORDER BY cluster ASC;";
    $result = mysqli_query($conn, $sql);
    $resCheck = mysqli_num_rows($result);

    if($resCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $response_date = $row['rsdate'];
            $yearDate = explode('-',$response_date);
            $yearmonth = $yearDate[0].'-'.$yearDate[1];
            echo $yearmonth.'<hr>';
            $sql1 = "SELECT DISTINCT(cluster) as clus FROM response_tbl WHERE DATE(response_date) = '$response_date' ORDER BY cluster ASC;";
            $result1 = mysqli_query($conn, $sql1);
            $resCheck1 = mysqli_num_rows($result1);
            
            if($resCheck1 > 0){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $never = 0;
                    $sometimes = 0;
                    $often = 0;
                    $always = 0;
                    $ave = 0;
                    $tottenant = 0;
                    $surveyid = 0;

                    $cluster = $row1['clus'];
                    echo $cluster.'<br>';
                    $sql2 = "SELECT DISTINCT(tenantid) as tid, tenantlastname FROM response_tbl WHERE cluster='$cluster' AND DATE(response_date) = '$response_date';";
                    $result2 = mysqli_query($conn, $sql2);
                    $resCheck2 = mysqli_num_rows($result2);

                    if($resCheck2 > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){
                            $tottenant++;
                            $tenantid = $row2['tid'];
                            $tenantname = $row2['tenantlastname'];
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tenantid.'&nbsp;&nbsp;'.$tenantname.'<br>';
                            $sql3 = "SELECT DISTINCT(surveyid) as sidd FROM response_tbl WHERE tenantid = $tenantid AND cluster='$cluster' AND DATE(response_date) = '$response_date';";
                            $result3 = mysqli_query($conn, $sql3);
                            $resCheck3 = mysqli_num_rows($result3);

                            if($resCheck3 > 0 ){
                                while($row3 = mysqli_fetch_assoc($result3)){
                                    $surveyid = $row3['sidd'];
                                    //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$surveyid.'<br>';
                                    $sql4 = "SELECT COUNT(question) as countQues, SUM(response) as sumResponse FROM response_tbl WHERE surveyid='$surveyid' AND tenantid = $tenantid AND cluster='$cluster' AND DATE(response_date) = '$response_date';";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $resCheck4 = mysqli_num_rows($result4);

                                    if($resCheck4 > 0 ){
                                        while($row4 = mysqli_fetch_assoc($result4)){
                                            
                                            if($surveyid == 3){
                                                $countQues = $row4['countQues'];
                                                $sumResponse = $row4['sumResponse'];
                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; total questions: '.$countQues.', Sum of response: '.$sumResponse.'<br>';
                                                
                                                $ave = $sumResponse / $countQues;
                                                $ave = round($ave);
                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vote: '.$ave.'<br>';
                                                if($ave == 1){
                                                    $never++;
                                                }elseif($ave == 2){
                                                    $sometimes++;
                                                }elseif($ave == 3){
                                                    $often++;
                                                }elseif($ave == 4){
                                                    $always++;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if($surveyid == 3){
                        //echo 'total tenants:'.$tottenant.'<br>';
                        $never = ($never/$tottenant) * 100;
                        $sometimes = ($sometimes/$tottenant) * 100;
                        $often = ($often/$tottenant) * 100;
                        $always = ($always/$tottenant) * 100;

                        $query2 = "SELECT syearmonth, cluster FROM satisfaction_tbl WHERE syearmonth = '$yearmonth' AND cluster = '$cluster';";
                        $resquery2 = mysqli_query($conn, $query2);
                        $resqueryCheck2 = mysqli_num_rows($resquery2);
    
                        echo mysqli_error($conn);
    
                        if($resqueryCheck2 > 0){
                            $sikwel = "UPDATE satisfaction_tbl SET vsatisfied = '$always', satisfied = '$often', neutral = '$sometimes', disatisfied = '$never'
                            WHERE syearmonth = '$yearmonth' AND cluster = '$cluster';";
                            $ressikwel =  mysqli_query($conn, $sikwel);
                        }else{
                            $sikwel1 = "INSERT INTO satisfaction_tbl (syearmonth, cluster, vsatisfied, satisfied, neutral, disatisfied) 
                            VALUES('$yearmonth', '$cluster', '$always', '$often', '$sometimes', '$never');";
                            $ressikwel1 = mysqli_query($conn, $sikwel1);
                            echo mysqli_error($conn);
                        }
                    }
                    
                    echo 'Votes:<br>1 - Disatisfied: '.$never.'%<br>2 - Neutral: '.$sometimes.'%<br>3 - Satisfied: '.$often.'%<br>4 - Very Satisfied: '.$always.'%<br><hr>';
                }
            }
        }
    }
?>