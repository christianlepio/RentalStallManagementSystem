<?php
    session_start();
    $_SESSION['actib'] = 'feedback';
    require 'header1.php';

    $iclustername = "CANTEEN SECTION";
    $dateYear = date("2021-12");
    $dateYear1 = date("2021-12");

    if(isset($_POST['searchyearDate'])){
        $dateYear = $_POST['yearMonth'];
        //echo $_SESSION['taon'];
    }
    if(isset($_POST['searchyearDate1'])){
        $dateYear1 = $_POST['yearMonth1'];
        $iclustername = $_POST['iclustername'];
        //echo $_SESSION['taon'];
    }

    $_SESSION['taonbuwan'] = $dateYear;
    $_SESSION['taonbuwan1'] = $dateYear1;
    $_SESSION['clusec'] = $iclustername;
?>

    <!--Container Main start-->
    
    <!-- this is for alert -->
    <div id="dialogoverlay"></div>
        <div id="dialogbox">
            <div>
                <div id="dialogboxhead"></div>
                <div id="dialogboxbody"></div>
                <div id="dialogboxfoot"></div>
            </div>
        </div>
        <!-- end of alert -->
    <div class="height-100 bg-light main-content">
        <div class="bg-light mb-5 p-3 rounded">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded shadow-sm">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ulu">
                        <li class="nav-item">
                            <a class="nav-link fs-6" aria-current="page" href="feedback.php"><i class='fa-solid fa-comments'></i> Feedback History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6" aria-current="page" href="feedback1.php"><strong><i class="bi bi-card-checklist"></i></strong> Survey List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-6" aria-current="page" href="feedback2.php"><i class='bx bx-bar-chart-alt-2'></i> Feedback Analysis</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <style>
            nav .ulu{
                margin:auto;
            }
            nav .ulu li{
                margin-right:50px;
            }
            nav .ulu .active, li:hover{
                background-color: #DD4124;
                color: white !important;
                border-radius:4px;
            }
            .bord{
                border-top: 2px solid green;
            }
            .bordd{
                border-top: 2px solid red;
            }
            .borddd{
                border-top: 2px solid orange;
            }
            .bordddd{
                border-top: 2px solid indigo;
            }
            .borddddd{
                border-top: 2px solid blue;
            }
        </style>
        
        <br><h3 class="fw-bold">&nbsp;&nbsp; <i class='bx bx-bar-chart-alt-2'></i> Feedback Analysis</h3><br>
        <div class="container-fluid">
            <div class="row justify-content-center bg-light bord border-4 shadow-sm rounded pb-4 mb-3">
                <h5 class="text-start mt-4"><i class="fa-solid fa-file-waveform"></i> Prescribed Solutions <?php
                    date_default_timezone_set('Asia/Manila');
                    echo "<span class='fs-6'> (". date('F j, Y g:i:a').")</span>"; ?></h5><hr>
                    <?php

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
                            $flood .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '2' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $security .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '7' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q7 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '8' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q8 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '9' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q9 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '10' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q10 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '11' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q11 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '12' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q12 .= $row['cluster'].', ';
                        }
                    }
                    
                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '13' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q13 .= $row['cluster'].', ';
                        }
                    }

                    $sql = "SELECT DISTINCT(cluster) FROM stallhistory_tbl WHERE questionid = '14' AND EXTRACT(YEAR_MONTH FROM date_created) = '202112';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $q14 .= $row['cluster'].', ';
                        }
                    }

                    if(!empty($flood)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Clean all the canals near these rental stalls in '.$flood.' and renovate pathways to avoid flood.</p></div>';
                    }if(!empty($security)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Intensify your security in '.$security.' for the tenants to feel more safe and comfortable.</p></div>';
                    }if(!empty($q7)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Invite all tenants of '.$q7.' to undergo counseling and to avoid chaos.</p></div>';
                    }if(!empty($q8)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Provide better ventilation in '.$q8.' for the tenants to feel more comfortable.</p></div>';
                    }if(!empty($q9)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Maintain the water supply in '.$q9.' and build a water storage for back-up.</p></div>';
                    }if(!empty($q10)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Fix the problem of your electricity in '.$q10.' to have a better supply of electricity.</p></div>';
                    }if(!empty($q11)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Invite all tenants of '.$q11.' in your office to give an advice on how to catch more customers.</p></div>';
                    }if(!empty($q12)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Always observe cleanliness in '.$q12.' and have a weekly general cleaning.</p></div>';
                    }if(!empty($q13)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Improve the design of rental stalls of '.$q13.' to be more presentable for the customers.</p></div>';
                    }if(!empty($q14)){
                        echo '<div class="col-md-3 my-2 bg-light shadow ms-5 p-4 rounded"><p class="fs-6">Visit some tenants of '.$q14.' and remind them to pay their rental bills on time.</p></div>';
                    }
                ?>
            </div>
            <div class="row justify-content-start mb-3 p-2 bg-light bordd border-4 shadow-sm rounded">
                <div class="col-md-8">
                    <h5 class="text-start mt-4"><i class="fas fa-chart-bar"></i> Satisfaction Rate per Cluster/Section</h5><hr>
                </div>
                <div class="col-md-4">
                    <form action="" method="post" class="mt-3">
                        <div class="col-md-3 input-group mb-3">
                            <input type="month" class="form-control form-control-sm" name="yearMonth" value="<?php echo $dateYear; ?>">
                            <button class="btn btn-info btn-sm text-white" name="searchyearDate" type="submit" id="button-addon1"><small><i class="fa-solid fa-magnifying-glass"></i> Find</small></button>
                        </div>
                    </form><hr>
                </div>
                    <?php
                        $sqll = "SELECT * FROM satisfaction_tbl WHERE syearmonth = '$dateYear' ORDER BY cluster ASC;";
                        $resultt = mysqli_query($conn, $sqll);
                        $resulttCheck = mysqli_num_rows($resultt);
                        $i=0;
                        if($resulttCheck > 0){
                            while($row = mysqli_fetch_assoc($resultt)){
                                $sec = "section".$i;
                                echo '<div class="col-md-3 my-2 rounded">                        
                                    <div class="card">
                                        <div class="class-card">
                                            <canvas id="'.$sec.'"></canvas>
                                        </div>
                                    </div>
                                </div>';
                                //echo $sec;
                                $i++;
                            }
                        }
                    ?><hr>
            </div>

            <div class="row justify-content-start mb-3 p-2 bg-light borddd border-4 shadow-sm rounded">
                <div class="col-md-6">
                    <h5 class="text-start mt-4"><i class="fas fa-chart-bar"></i> Survey Summary per Cluster/Section</h5><hr>
                </div>
                <div class="col-md-6">
                    <form action="" method="post" class="mt-3">
                        <div class="col-md-3 input-group mb-3">
                            <select name="iclustername" class="form-select form-select-sm" required>
                                <option class="bg-secondary text-white" value="CLUSTER/SECTION" selected>Cluster/Section...</option>
                                <?php
                                    $sql = "SELECT DISTINCT(cluster) as cluster FROM rental_tbl ORDER BY cluster ASC;";
                                    $result = mysqli_query($conn, $sql);
                                    $resCheck = mysqli_num_rows($result);

                                    if($resCheck > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.strtoupper($row['cluster']).'">'.strtoupper($row['cluster']).'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <input type="month" class="form-control form-control-sm" name="yearMonth1" value="<?php echo $dateYear1; ?>" required>
                            <button class="btn btn-info btn-sm text-white" name="searchyearDate1" type="submit" id="button-addon1"><small><i class="fa-solid fa-magnifying-glass"></i> Find</small></button>
                        </div>
                    </form><hr>
                </div>
                <h5 class="fs-5 text-center mt-4 my-3"><i class="fa-solid fa-store"></i> <?php echo $_SESSION['clusec']; ?></h4>
                <?php
                    $sqll = "SELECT * FROM problem_tbl WHERE syearmonth = '$dateYear1' AND cluster = '$iclustername';";
                    $resultt = mysqli_query($conn, $sqll);
                    $resulttCheck = mysqli_num_rows($resultt);
                    $i=0;
                    $no = 0;
                    if($resulttCheck > 0){
                        while($row = mysqli_fetch_assoc($resultt)){
                            $sec = "probsection".$i;
                            echo '<div class="col-md-3 my-2 rounded">                        
                                <div class="card">
                                <div class="card-header"><p class="fs-6 text-start"><small><strong>'.++$no.'.</strong> '.$row['question'].'</small></p></div>
                                    <div class="card-body">
                                        <canvas class="p-4" id="'.$sec.'"></canvas>
                                    </div>
                                </div>
                            </div>';
                            //echo $sec;
                            $i++;
                        }
                    }
                ?>
            </div>
<?php
    /*/THIS IS FOR STALL HISTORY...
    $shql1 = "DELETE FROM stallhistory_tbl;";
    $shres1 = mysqli_query($conn, $shql1);
    
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
    }*/
?>

            <div class="row justify-content-around mb-3 p-2 bg-light borddddd border-4 shadow-sm rounded">
                <h5 class="text-start mt-4"><i class="bi bi-clock-history"></i> Stall History</h5><hr>
                    
                <?php
                    $sql = "SELECT * FROM stallhistory_tbl ORDER BY date_created DESC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
            <div class="table-responsive p-3 bg-light mb-3 rounded">
                <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tenant Name</th>
                            <th>Cluster/Section</th>
                            <th>Stall No.</th>
                            <th>Problem Encountered</th>
                            <th>Date</th>

                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 0;
                            if($resultCheck > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>';
                                        echo '<td class="fw-bold">'.++$no.'.</td>';
                                        echo '<td>'.strtoupper($row['tenantname']).'</td>';
                                        //echo '<td>'.$row['tenantgender'].'</td>';
                                        echo '<td>'.$row['cluster'].'</td>';
                                        echo '<td>'.$row['stallno'].'</td>';
                                        echo '<td>'.$row['problem'].'</td>';
                                        echo '<td>'.$row['date_created'].'</td>';

                                        echo '<td class="text-center"><a href="feedback2.php?viewsh='.$row['shid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                    echo '</tr>';
                                }

                            }
                        ?>
                    </tbody>
                </table>
            </div>
                
            </div>


            <div class="row justify-content-around mb-3 p-2 bg-light bordddd border-4 shadow-sm rounded">
                <h5 class="text-start mt-4"><i class="fa-solid fa-face-grin-stars"></i> Recommendation by the Tenants</h5><hr>
                    
                        <?php
                            $sql = "SELECT * FROM recommendation_tbl ORDER BY date_created DESC;";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);
                        ?>
                    <div class="table-responsive p-3 bg-light mb-3 rounded">
                        <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Cluster/Section</th>
                                    <th>Stall No.</th>
                                    <th>Recommendation</th>
                                    <th>Date created</th>

                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    if($resultCheck > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                                echo '<td class="fw-bold">'.++$no.'.</td>';
                                                //echo '<td>'.strtoupper($row['tenantname']).'</td>';
                                                //echo '<td>'.$row['tenantgender'].'</td>';
                                                echo '<td>'.$row['cluster'].'</td>';
                                                echo '<td>'.$row['stallno'].'</td>';
                                                echo '<td>'.$row['recommendation'].'</td>';
                                                echo '<td>'.$row['date_created'].'</td>';

                                                echo '<td class="text-center"><a href="feedback2.php?view='.$row['recommendationid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                            echo '</tr>';
                                        }

                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <?php
            if(isset($_GET['view'])){
                $iddd = $_GET['view'];
                $sql = "SELECT * FROM recommendation_tbl WHERE recommendationid=$iddd;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $p = $row['tenantname'];
                        $k = $row['tenantgender'];
                        $a = $row['cluster'];
                        $b = $row['stallno'];
                        $c = $row['recommendation'];
                        $h = $row['date_created'];
                        
                    }
                }
                echo '<script>
                    let str = `<center><h5>Recommendation:</h3><br><h5>'.$c.'</h4></center><br>Suggested by:&nbsp;&nbsp;&nbsp;&nbsp; '.$p.'<br>Gender:&nbsp;&nbsp;&nbsp;&nbsp; '.$k.'<br>Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>
                    Stall no.:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>Date Created:&nbsp;&nbsp;&nbsp;&nbsp; '.$h.'<br>`
                    Alert.render(str)
                    </script>';
            }if(isset($_GET['viewsh'])){
                $iddd = $_GET['viewsh'];
                $sql = "SELECT * FROM stallhistory_tbl WHERE shid=$iddd;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $p = $row['tenantname'];
                        //$k = $row['tenantgender'];
                        $a = $row['cluster'];
                        $b = $row['stallno'];
                        $c = $row['problem'];
                        $h = $row['date_created'];
                        
                    }
                }
                echo '<script>
                    let str = `<center><h5>Problem:</h3><br><h5>'.$c.'</h4></center><br>Tenant Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$p.'<br>Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>
                    Stall no.:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>Date Created:&nbsp;&nbsp;&nbsp;&nbsp; '.$h.'<br>`
                    Alert.render(str)
                    </script>';
            }
        ?>

    </div>
    </div>
    <!--Container Main end-->

<?php
    //THIS IS FOR SATISFACTORY...
    $sql = "SELECT DISTINCT(DATE(response_date)) as rsdate FROM response_tbl ORDER BY cluster ASC;";
    $result = mysqli_query($conn, $sql);
    $resCheck = mysqli_num_rows($result);

    if($resCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $response_date = $row['rsdate'];
            $yearDate = explode('-',$response_date);
            $yearmonth = $yearDate[0].'-'.$yearDate[1];
            //echo $yearmonth.'<hr>';
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
                    //echo $cluster.'<br>';
                    $sql2 = "SELECT DISTINCT(tenantid) as tid, tenantlastname FROM response_tbl WHERE cluster='$cluster' AND DATE(response_date) = '$response_date';";
                    $result2 = mysqli_query($conn, $sql2);
                    $resCheck2 = mysqli_num_rows($result2);

                    if($resCheck2 > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){
                            $tottenant++;
                            $tenantid = $row2['tid'];
                            $tenantname = $row2['tenantlastname'];
                            //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tenantid.'&nbsp;&nbsp;'.$tenantname.'<br>';
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
                                                //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; total questions: '.$countQues.', Sum of response: '.$sumResponse.'<br>';
                                                
                                                $ave = $sumResponse / $countQues;
                                                $ave = round($ave);
                                                //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vote: '.$ave.'<br>';
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
                    
                    //echo 'Votes:<br>1 - Disatisfied: '.$never.'%<br>2 - Neutral: '.$sometimes.'%<br>3 - Satisfied: '.$often.'%<br>4 - Very Satisfied: '.$always.'%<br><hr>';
                }
            }
        }
    }
?>


<?php
    //THIS IS FOR SURVEY SUMMARY....
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

<?php
    require 'footer1.php';
?>