<?php
    require 'dbh.inc.php';

    if(isset($_POST['submit-addsurvey'])){

        $stitle = $_POST['stitle'];
        $sdescription = $_POST['sdescription'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $query = "INSERT INTO surveyset_tbl (stitle, sdescription, start_date, end_date)
        VALUES('$stitle', '$sdescription', '$start_date', '$end_date');";
        $result = mysqli_query($conn, $query);

        echo mysqli_error($conn);

        if($result){
            header("Location: ../feedback1.php?action=success");
            exit();
        }
    }if(isset($_POST['survey-update'])){
        $surveyid = $_POST['surveyid'];
        $stitle = $_POST['stitle'];
        $sdescription = $_POST['sdescription'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $query = "UPDATE surveyset_tbl SET stitle='$stitle', sdescription = '$sdescription', start_date = '$start_date', end_date = '$end_date'
        WHERE surveyid = '$surveyid';";
        $result = mysqli_query($conn, $query);
        
        if($result){
            header("Location: ../feedback1.php?action=warning&stitle=".$stitle);
            exit();
        }
    }if(isset($_POST['add-question'])){
        $surveyid = $_POST['surveyid'];
        $question = $_POST['question'];

        if(empty($question) || empty($surveyid)){
            header("Location: ../feedback1.php?viewsurveyset=".$surveyid."&action=danger");
            exit();
        }else{
            $query = "INSERT INTO question_tbl (surveyid, question)
            VALUES('$surveyid', '$question');";
            $result = mysqli_query($conn, $query);
    
            echo mysqli_error($conn);
    
            if($result){
                header("Location: ../feedback1.php?viewsurveyset=".$surveyid."&action=success");
                exit();
            }
        }
    }if(isset($_POST['update-question'])){
        $surveyid = $_POST['surveyid'];
        $questionid = $_POST['questionid'];
        $question = $_POST['question'];

        if(empty($question) || empty($surveyid) || empty($questionid)){
            header("Location: ../feedback1.php?viewsurveyset=".$surveyid."&editquestion=".$questionid."&action=danger");
            exit();
        }else{
            $query = "UPDATE question_tbl SET question = '$question'
            WHERE questionid = '$questionid' AND surveyid = '$surveyid';";
            $result = mysqli_query($conn, $query);
    
            echo mysqli_error($conn);
    
            if($result){
                header("Location: ../feedback1.php?viewsurveyset=".$surveyid."&question=".$question."&action=warning");
                exit();
            }
        }
    }if(isset($_GET['delresponse']) && isset($_GET['delsid']) && isset($_GET['deltid'])){
        $surveyid = $_GET['delsid'];
        $stitle = $_GET['stitle'];
        $tenantid = $_GET['deltid'];
        $tenantname = $_GET['tname'];

        $query = "DELETE FROM response_tbl WHERE surveyid = '$surveyid' AND tenantid = '$tenantid';";
        $result = mysqli_query($conn, $query);
        
        if($result){
            header("Location: ../feedback.php?action=warning&tname=".$tenantname."&stitle=".$stitle);
            exit();
        }

    }