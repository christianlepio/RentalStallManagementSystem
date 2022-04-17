<?php
    session_start();
    $_SESSION['actib'] = 'srvy';
    require 'headerTenant.php';

    $surveyid = '';
    $tenantlastname = "";
    $tenantfirstname = "";
    $tenantgender = "";
    $cluster = "";
    $clusterno1 = "";
    $clusterno2 = "";
    $totresponse = '';
    $tid = $_SESSION['tenantId'];
    $qlength = 0;

    $query = "SELECT * FROM tenants_tbl WHERE tenantid = '$tid';";
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

    $sql = "SELECT COUNT(DISTINCT(surveyid)) AS totresponse FROM response_tbl WHERE tenantid = '$tid';";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $totresponse = $row['totresponse'];
        }
    }
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

    <style>
        .bord{
            border-top: 2px solid #000080;
        }
        .col-ques{
            margin: auto;
        }
        .col-ques-img{
            margin: auto;
        }
    </style>
        <div class="bg-light mb-5 p-4 rounded">
            <?php
                if(isset($_GET['takesurvey'])){
                    $surveyid = $_GET['takesurvey'];

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
                <h3><a href="surveycontent.php"><i class="bi bi-arrow-left-circle"></i></a></h3><hr>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Name:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $tenantlastname.", ".$tenantfirstname; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Gender:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $tenantgender; ?>" required>
                </div>
            </div>
            <div class="row justify-content-center px-3">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Cluster/Section:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $cluster; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Stall No.:</small></label>
                    <input type="text" name="stitle" class="form-control form-control-sm" value="<?php echo $clusterno1." - ".$clusterno2; ?>" required>
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
                    <?php
                        if($surveyid == 3){
                            echo '<p class="fs-6"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp; 4 - Very Satisfied&nbsp;&nbsp;&nbsp; 3 - Satisfied&nbsp;&nbsp;&nbsp; 2 - Neutral&nbsp;&nbsp;&nbsp; 1 - Disatisfied</p>';        
                        }elseif($surveyid == 2){
                            echo '<p class="fs-6"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp; 2 - YES&nbsp;&nbsp;&nbsp; 1 - NO</p>';
                        }else{
                            echo '<p class="fs-6"><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp; 4 - Always&nbsp;&nbsp;&nbsp; 3 - Often&nbsp;&nbsp;&nbsp; 2 - Sometimes&nbsp;&nbsp;&nbsp; 1 - Never</p>';
                        }
                    ?>
                </div>
                <form action="" method="post">
                <?php
                    $query1 = "SELECT * FROM question_tbl WHERE surveyid = '$surveyid';";
                    $resquery1 = mysqli_query($conn, $query1);
                    $resquery1Check = mysqli_num_rows($resquery1);
                    if($resquery1Check > 0){
                        while($row = mysqli_fetch_assoc($resquery1)){
                            $qlength++;
                            if($row['surveyid'] == 3){
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                    <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="1" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Disatisfied
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Neutral
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="3">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Satisfied
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="4">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Very Satisfied
                                            </label>
                                    </div>
                                </div>';
                            }elseif($row['surveyid'] == 2){
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                    <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="1" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                NO
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                YES
                                            </label>
                                    </div>
                                </div>';

                            }else{
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                    <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="1" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Never
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Sometimes
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="3">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Often
                                            </label>
                                    </div>
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question'.$row['questionid'].'" value="4">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Always
                                            </label>
                                    </div>
                                </div>';
                            }
                        }
                    }
                ?>
                <div class="row justify-content-center py-3">
                    <div class="col-6">
                        <center>
                            <a href="surveycontent.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" name="answer-submit" class="btn btn-primary btn-sm">Submit</button>
                        </center>
                    </div>
                </div>
                </form>
            </div>

            <?php
                    if(isset($_POST['answer-submit'])){
                        $tenantlastname = $tenantlastname.', '.$tenantfirstname;
                        $sresquery = '';
                        $query1 = "SELECT * FROM question_tbl WHERE surveyid = '$surveyid';";
                        $resquery1 = mysqli_query($conn, $query1);
                        $resquery1Check = mysqli_num_rows($resquery1);

                        //echo mysqli_error($conn);

                        if($resquery1Check > 0){
                            while($row = mysqli_fetch_assoc($resquery1)){
                                $questionid = $row['questionid'];
                                $qs = "question".$row['questionid'];
                                //echo $_POST[$qs].'<br>';
                                $response = $_POST[$qs];
                                $question = $row['question'];

                                $squery = "INSERT INTO response_tbl (surveyid, questionid, tenantid, tenantlastname, tenantgender, cluster, stallno, stitle, sdescription, question, response)
                                VALUES('$surveyid', '$questionid', '$tid', '$tenantlastname', '$tenantgender', '$cluster', '$stallno', '$stitle', '$sdescription', '$question', '$response')";
                                $sresquery = mysqli_query($conn, $squery);
                                //echo mysqli_error($conn);

                            }
                            if($sresquery){
                                echo '<script>window.location.href="surveycontent.php?staken='.$surveyid.'";</script>';    
                            }
                        }
                    }

                }else{
                    if(isset($_GET['staken'])){
                        $ssid = $_GET['staken'];
                        $sstitle = '';

                        $kuery = "SELECT stitle FROM surveyset_tbl WHERE surveyid = '$ssid';";
                        $reskuery = mysqli_query($conn, $kuery);
                        $reskueryCheck = mysqli_num_rows($reskuery);

                        if($reskueryCheck > 0){
                            while($row = mysqli_fetch_assoc($reskuery)){
                                $sstitle = $row['stitle'];
                            }
                        }
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-5 py-3 shadow-sm bord text-end border-4 rounded">
                        <a href="surveycontent.php" class=""><button type="button" class="btn-close"></button></a>
                        <h2 class="text-start"><?php echo $sstitle; ?></h2><br>
                        <p class="text-start">Thank you for answering. God Bless!</p>
                        
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="row justify-content-center">
                        <?php
                            if(isset($_GET['recadd'])){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="bi bi-check-circle-fill"></i></strong>&nbsp;&nbsp; Your recommendation has been submitted to the admin.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            }
                        ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-11 mt-4">
                        <p class="fs-6 text-end">Welcome <?php echo $tenantlastname.', '.$tenantfirstname.'!'; ?></p>
                    </div>
                </div>

                <div class="row g-3 my-2 px-3 mb-2 justify-content-start bg-light shadow-sm rounded">
                    <div class="col-md-3">
                        <div class="p-3 bg-warning shadow-sm p-3 mb-3 d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-6 text-white">Total Responded Surveys</p>
                                <h3 class="fs-4 text-white"><?php echo $totresponse; ?></h3>
                                
                            </div>
                            <i class="fa-solid fa-square-poll-horizontal fs-1 primary-text border rounded-full bg-light p-3"></i>
                        </div>
                    </div>
                </div>
                <div class="row g-3 my-2 px-3 mb-4 justify-content-center bg-light shadow-sm rounded"><hr>
                    <div class="col-md-4">
                        <h4 class="my-2 text-center"><i class="bi bi-plus-circle"></i> Add Recommendations</h4>
                        <form action="" method="post">
                            <textarea name="recomm" class="form-control" id="" cols="40" rows="3" required></textarea>
                            <center>
                                <button type="submit" name="submit-recom" class="mt-3 mb-3 btn btn-primary btn-sm">Submit</button>
                            </center>
                        </form>
                    </div><hr>
                </div>

                <?php
                    if(isset($_POST['submit-recom'])){

                        $tenantname = $tenantlastname.', '.$tenantfirstname;
                        $recommendation = $_POST['recomm'];
                        //echo $tid."<br>".$tenantname."<br>".$tenantgender."<br>".$cluster."<br>".$stallno."<br>".$_POST['recomm'];

                        $mysql="INSERT INTO recommendation_tbl (tenantid, tenantname, tenantgender, cluster, stallno, recommendation)
                        VALUES('$tid', '$tenantname', '$tenantgender', '$cluster', '$stallno', '$recommendation');";
                        $mysqlresult = mysqli_query($conn, $mysql);

                        if($mysqlresult){
                            echo '<script>window.location.href="surveycontent.php?recadd=true";</script>';
                        }
                    }
                ?>
        
            <h3 class="fw-bold"><i class='bx bx-grid-alt'></i> Survey List</h3><hr>
            <div class="row justify-content-center g-3 px-3">
            <?php
                $sqlquery = "SELECT * FROM surveyset_tbl ORDER BY date_created DESC;";
                $resultquery = mysqli_query($conn, $sqlquery);
                $resultCheckquery = mysqli_num_rows($resultquery);

                if($resultCheckquery > 0){
                    while($row = mysqli_fetch_assoc($resultquery)){
                        $tempsid = $row['surveyid'];

                        $sql = "SELECT DISTINCT(surveyid) AS responded FROM response_tbl WHERE tenantid = '$tid' AND surveyid = '$tempsid';";
                        $result = mysqli_query($conn, $sql);
                        $check = mysqli_num_rows($result);

                        if($check > 0){
                            echo '<div class="col-md-3">
                                    <div class="card shadow-sm bg-body bord border-4 p-2 text-dark bg-warning" style="max-width: 20rem;">
                                        <div class="card-header border-light text-end"><button class="btn btn-sm btn-success text-white" disabled>You\'ve already responded</button></div>
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">'.$row['stitle'].'.</h6><hr>
                                            <p class="card-text">'.$row['sdescription'].'.</p>
                                        </div>
                                    </div>
                                </div>';
                        }else{
                            echo '<div class="col-md-3">
                                <div class="card shadow-sm bg-body bord border-4 p-2 text-dark bg-warning" style="max-width: 20rem;">
                                    <div class="card-header border-light text-end"><a class="btn btn-sm btn-danger text-white" href="surveycontent.php?takesurvey='.$row['surveyid'].'">Take Survey</a></div>
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">'.$row['stitle'].'.</h6><hr>
                                        <p class="card-text">'.$row['sdescription'].'.</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    }  
                }
            ?>
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