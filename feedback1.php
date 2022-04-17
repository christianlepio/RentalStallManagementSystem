<?php
    session_start();
    $_SESSION['actib'] = 'feedback';
    require 'header1.php';
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
                            <a class="nav-link active fs-6" aria-current="page" href="feedback1.php"><strong><i class="bi bi-card-checklist"></i></strong> Survey List</a>
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
            .unahr {
            }
            .bord{
                border-top: 2px solid red;
            }
            .col-ques{
                margin: auto;
            }
            .col-ques-img{
                margin: auto;
            }
            /*.accordion {
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
            }

            .accordion:hover {
            background-color: #ccc;
            }

            .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
            }

            .accordion .active:after {
            content: "\2212";
            }

            .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            }*/
            .btq{
                width:90%;
            }

        </style>
            <?php
                if(isset($_GET['addsurvey'])){
                    if(is_numeric($_GET['addsurvey'])){
                        echo '<br><h3 class="fw-bold">&nbsp;&nbsp; <i class="fa-solid fa-pen-to-square"></i> Edit Survey</h3><hr>';
                    }else{
                        echo '<br><h3 class="fw-bold">&nbsp;&nbsp; <i class="bi bi-plus-circle"></i> Add New Survey</h3><hr>';
                    }
                }elseif(isset($_GET['viewsurveyset'])){
                    $viewq = $_GET['viewsurveyset'];
                    echo '<br><h3 class="fw-bold">&nbsp;&nbsp; <i class="fa-solid fa-eye"></i> View Survey</h3><hr>';
                }else{
                    echo '<br><h3 class="fw-bold">&nbsp;&nbsp; <i class="bi bi-card-checklist"></i> Survey List</h3><br>';
                }
            ?>
        
                <?php
                    if(!isset($_GET['viewsurveyset'])){
                        if(isset($_GET['action'])){
                            echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                                <strong>';
                                if($_GET['action'] == 'success')
                                    echo '<i class="bi bi-check-circle-fill"></i>&nbsp; New survey set has been added !';
                                elseif($_GET['action'] == 'warning')
                                    echo '<i class="fa-solid fa-pen-to-square"></i>&nbsp; '.$_GET['stitle'].' has been updated !';
                            echo '</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div></small></center>';
                        }
                    }
                ?>
        <?php
            if(isset($_GET['addsurvey'])){
        ?>

        <form action="includes/feedback.inc.php" method="post" class="bord border-4 py-3 shadow-sm rounded">
            <div class="row mb-3 justify-content-center">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Title:</small></label>
                    <input type="text" name="stitle" class="form-control" value="<?php echo $stitle; ?>" required>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Description:</small></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="sdescription" rows="3"><?php echo $sdescription; ?></textarea>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>Start date:</small></label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>" required>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><small>End date:</small></label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>" required>
                </div>
            </div>
            
            <input type="hidden" name="surveyid" value="<?php echo $surveyid; ?>">

            <div class="row mb-3 justify-content-center">
                <div class="col-md-6">
                    <center><br>
                        <a href="feedback1.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                            if(isset($_GET['addsurvey'])){
                                if(is_numeric($_GET['addsurvey'])){
                                    echo '<button type="submit" name="survey-update" class="btn btn-primary btn-sm">Update</button>';
                                }else{
                                    echo '<button type="submit" name="submit-addsurvey" class="btn btn-primary btn-sm">Save</button>';
                                }
                            }
                        ?>
                    </center>
                </div>
            </div><hr>
        </form>
        
        <?php
            }elseif(isset($_GET['viewsurveyset'])){

                $surveyid = $_GET['viewsurveyset'];
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
                if(isset($_GET['action'])){
                    echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                        <strong>';
                        if($_GET['action'] == 'success')
                            echo '<i class="bi bi-check-circle-fill"></i>&nbsp; New Question has been added !';
                        elseif($_GET['action'] == 'warning')
                            echo '<i class="fa-solid fa-pen-to-square"></i>&nbsp; Question: "'.$_GET['question'].'" has been updated !';
                        elseif($_GET['action'] == 'danger')
                            echo '<i class="bi bi-exclamation-circle-fill"></i>&nbsp; Please fill out all fields !';
                    echo '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div></small></center>';
                }

                $query1 = "SELECT * FROM question_tbl WHERE surveyid = '$surveyid';";
                $resquery1 = mysqli_query($conn, $query1);
                $resquery1Check = mysqli_num_rows($resquery1);

        ?>
            <!--button class="accordion btn btn-dark fw-bold"><i class="bi bi-plus-circle"></i> Add Question</button>
            <div class="panel shadow-sm rounded"-->
            <div class="shadow-sm rounded">
                <?php
                    if(isset($_GET['editquestion'])){
                        echo '<h4 class="text-center"><i class="fa-solid fa-pen-to-square"></i> Edit Question</h4>';
                    }else{
                        echo '<h4 class="text-center"><i class="bi bi-plus-circle"></i> Add Question</h4>';
                    }
                ?>
                <form action="includes/feedback.inc.php" method="post">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4">
                            <textarea name="question" class="form-control" id="" cols="30" rows="2"><?php echo $question; ?></textarea>
                        </div>                
                    </div>
                    <input type="hidden" name="surveyid" value="<?php echo $surveyid; ?>">
                    <input type="hidden" name="questionid" value="<?php echo $questionid; ?>">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-3">
                            <center><br>
                                <?php
                                    if(isset($_GET['editquestion'])){
                                        echo '<button type="submit" name="update-question" class="btn btn-primary btn-sm btq mb-3">Update</button>';
                                    }else{
                                        echo '<button type="submit" name="add-question" class="btn btn-primary btn-sm btq mb-3">Save</button>';
                                    }
                                ?>
                            </center>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
                <h5><i class="bi bi-table"></i> Questions</h5><hr>
            <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Question</th>
                    <th>Date Created</th>

                    <th class="text-center">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0;
                    if($resquery1Check > 0){
                        while($row = mysqli_fetch_assoc($resquery1)){
                            echo '<tr>';
                                echo '<td class="fw-bold">'.++$no.'.</td>';
                                echo '<td><strong>'.$row['question'].'</strong></td>';
                                echo '<td>'.$row['date_created'].'</td>';
                                
                                echo '<td class="text-center"><a href="feedback1.php?viewsurveyset='.$surveyid.'&editquestion='.$row['questionid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                //echo '<td class="text-center"><a href="includes/process.inc.php?deleteInquiry='.$row['Inq_id'].'&deleteinqname='.$row['lastname'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>
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
                <?php
                    $query1 = "SELECT * FROM question_tbl WHERE surveyid = '$surveyid';";
                    $resquery1 = mysqli_query($conn, $query1);
                    $resquery1Check = mysqli_num_rows($resquery1);
                    if($resquery1Check > 0){
                        while($row = mysqli_fetch_assoc($resquery1)){

                            if($row['surveyid'] == 3){
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Disatisfied
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Neutral
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Satisfied
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Very Satisfied
                                        </label>
                                </div>
                            </div>';
                            }elseif($row['surveyid'] == 2){
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            NO
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            YES
                                        </label>
                                </div>
                            </div>';
                            }else{
                                echo '<div class="col-md-7 col-ques p-2 py-4 px-4 bg-light mb-2 shadow-sm rounded">
                                <p class="fs-6 fw-bold">'.$row['question'].'</p>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Never
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Sometimes
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Often
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question'.$row['questionid'].'">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Always
                                        </label>
                                </div>
                            </div>';
                            }
                        }
                    }
                ?>
            </div>
        <?php
            }else{
            $sql = "SELECT * FROM surveyset_tbl ORDER BY date_created DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
            <a href="feedback1.php?addsurvey=true" class="btn btn-outline-dark btn-sm text-end"><i class="bi bi-plus-circle"></i> Add New Survey</a><hr>
        <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Survey Title/Factor</th>
                    <th>Description</th>
                    <th>Start date</th>
                    <th>End date</th>

                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nn = "NONE";
                    $no = 0;
                    if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                                echo '<td class="fw-bold">'.++$no.'.</td>';
                                echo '<td><strong>'.$row['stitle'].'</strong></td>';
                                echo '<td class="">'.$row['sdescription'].'</td>';
                                echo '<td><strong>'.$row['start_date'].'</strong></td>';
                                echo '<td><strong>'.$row['end_date'].'</strong></td>';
                                
                                echo '<td class="text-center"><a href="feedback1.php?viewsurveyset='.$row['surveyid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="feedback1.php?addsurvey='.$row['surveyid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                //echo '<td class="text-center"><a href="includes/process.inc.php?deleteInquiry='.$row['Inq_id'].'&deleteinqname='.$row['lastname'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
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

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
</script>
        
        
    </div>
    </div>
    <!--Container Main end-->

<?php
    require 'footer1.php';
?>