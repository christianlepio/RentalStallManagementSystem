<?php
    session_start();
    $_SESSION['actib'] = 'feedback';
    require 'header1.php';
    
    $surveyid = '';
    $tenantlastname = "";
    $tenantfirstname = "";
    $tenantgender = "";
    $cluster = "";
    $clusterno1 = "";
    $clusterno2 = "";
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
                            <a class="nav-link active fs-6" aria-current="page" href="feedback.php"><i class='fa-solid fa-comments'></i> Feedback History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6" aria-current="page" href="feedback1.php"><strong><i class="bi bi-card-checklist"></i></strong> Survey List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6" aria-current="page" href="feedback2.php"><i class='bx bx-bar-chart-alt-2'></i> Feedback Analysis</a>
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
                border-top: 2px solid #FFBF00;
            }
            .col-ques{
                margin: auto;
            }
            .col-ques-img{
                margin: auto;
            }

        </style>
        
        <?php
            if(isset($_GET['viewresponse'])){
                $surveyid = $_GET['sid'];
                $tenantid = $_GET['tid'];
            
                $query = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
                $resquery = mysqli_query($conn, $query);
                $resqueryCheck = mysqli_num_rows($resquery);
                
                if($resqueryCheck > 0){
                    while($row = mysqli_fetch_assoc($resquery)){
                        $tenantlastname = $row['tenantlastname'];
                        $tenantfirstname = $row['tenantfirstname'];
                        $tenantgender = $row['tenantgender'];
                        $cluster = $row['cluster'];
                        $clusterno1 = $row['clusterno1'];
                        $clusterno2 = $row['clusterno2'];
                    }
                }
            
                $stallno = $clusterno1." - ".$clusterno2;

                $stitle = '';
                $sdescription = '';
                $start_date = '';
                $end_date = '';

                $sql = "SELECT * FROM surveyset_tbl WHERE surveyid = '$surveyid';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck){
                    while($row = mysqli_fetch_assoc($result)){
                        $stitle = $row['stitle'];
                        $sdescription = $row['sdescription'];
                        $start_date = $row['start_date'];
                        $end_date = $row['end_date'];
                    }
                }
                
            
        ?>

            <div class="row justify-content-center px-3">
                <h3 class="mt-3"><a href="feedback.php"><i class="bi bi-arrow-left-circle"></i></a></h3><hr>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Name:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $tenantlastname.", ".$tenantfirstname; ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Gender:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $tenantgender; ?>" disabled>
                </div>
            </div>
            <div class="row justify-content-center px-3">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Cluster/Section:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $cluster; ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Stall No.:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $clusterno1." - ".$clusterno2; ?>" disabled>
                </div>
            </div><hr>

            <div class="justify-content-center mt-4 p-3 mb-3 shadow-sm rounded" style="background-color: #ffe9ec;">
                <div class="col-md-7 col-ques-img mb-2 shadow-sm rounded">
                    <img src="img/palengke11.jpg" alt="" class="img-fluid rounded">
                </div>
                <div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 bord border-5 shadow-sm rounded">
                    <h2><?php echo $stitle; ?></h2><hr>
                    <h6><?php echo $sdescription; ?></h6>
                </div>
                <div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                    <p class="fs-6"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp; 4 - Always&nbsp;&nbsp;&nbsp; 3 - Often&nbsp;&nbsp;&nbsp; 2 - Sometimes&nbsp;&nbsp;&nbsp; 1 - Never</p>
                </div>
                <?php
                    $query1 = "SELECT * FROM response_tbl WHERE surveyid = '$surveyid' AND tenantid = '$tenantid';";
                    $resquery1 = mysqli_query($conn, $query1);
                    $resquery1Check = mysqli_num_rows($resquery1);
                    if($resquery1Check > 0){
                        while($row = mysqli_fetch_assoc($resquery1)){
                ?>
                            <div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                <p class="fs-6 fw-bold"><?php echo $row['question']; ?></p>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1" <?php if($row['response'] == "1"){echo 'checked';}?> disabled>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Never
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="2" <?php if($row['response'] == "2"){echo 'checked';}?> disabled>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Sometimes
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="3" <?php if($row['response'] == "3"){echo 'checked';}?> disabled>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Often
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" value="4" <?php if($row['response'] == "4"){echo 'checked';}?> disabled>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Always
                                        </label>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
            </div>

        <?php
            }else{
        ?>
            <br><h3 class="fw-bold">&nbsp;&nbsp; <i class='fa-solid fa-comments'></i> Feedback History</h3><br>
        
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-trash"></i>&nbsp; Inquiry of Mr./Ms. '.$_GET['lastname'].' has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-pen-to-square"></i>&nbsp; '.$_GET['tname'].' will re-take Survey: "'.$_GET['stitle'].'".';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                    }
                ?>
        
        <?php
            $sql = "SELECT * FROM response_tbl ORDER BY response_date DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
        <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Full name</th>
                    <th>Gender</th>
                    <th>Cluster/Section</th>
                    <th>Stall No.</th>
                    <th>Survey Title</th>
                    <th>Response Date</th>

                    <th class="text-center">View</th>
                    <th class="text-center">Re-take</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0;
                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                                echo '<td class="fw-bold">'.++$no.'.</td>';
                                //echo '<td>'.$row['tenantid'].'</td>';
                                echo '<td>'.strtoupper($row['tenantlastname']).'</td>';
                                echo '<td>'.$row['tenantgender'].'</td>';
                                echo '<td>'.$row['cluster'].'</td>';
                                echo '<td>'.$row['stallno'].'</td>';
                                echo '<td>'.$row['stitle'].'</td>';
                                echo '<td>'.$row['response_date'].'</td>';

                                echo '<td class="text-center"><a href="feedback.php?viewresponse=true&sid='.$row['surveyid'].'&tid='.$row['tenantid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/feedback.inc.php?delresponse=true&delsid='.$row['surveyid'].'&deltid='.$row['tenantid'].'&tname='.$row['tenantlastname'].'&stitle='.$row['stitle'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-arrow-rotate-right"></i></a></td>';
                            echo '</tr>';
                        }

                    }
                ?>
            </tbody>
        </table>
        </div>
        <?php
            }
        ?>
    </div>
    </div>
    <!--Container Main end-->

<?php
    require 'footer1.php';
?>