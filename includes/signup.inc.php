<?php

    if(isset($_POST['signup-submit'])){
        
        require 'dbh.inc.php';
        require 'functions.inc.php';

        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $usname = $_POST['usname'];
        $usrtype = $_POST['usrtype'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pwd1 = $_POST['pwd1'];
        $pwd2 = $_POST['pwd2'];

        $img_name = $_FILES['img-input']['name'];
        $img_type = $_FILES['img-input']['type'];
        $img_tmp_name = $_FILES['img-input']['tmp_name'];
        $img_error = $_FILES['img-input']['error'];
        $img_size = $_FILES['img-input']['size'];

        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_ext = array("jpeg", "jpg", "png");


        if(emptyInput($lname, $fname, $usname, $usrtype, $email, $pwd1, $pwd2, $phone, $img_error) !== false){
            header("Location: ../signup.php?error=emptyinput");
            exit();
        }if(invalidUid($usname) !== false){
            header("Location: ../signup.php?error=invalidusname");
            exit();
        }if(invalidEmail($email) !== false){
            header("Location: ../signup.php?error=invalidemail");
            exit();
        }if(pwdMatch($pwd1, $pwd2) !== false){
            header("Location: ../signup.php?error=pwdnotmatched");
            exit();
        }if(usnameExists($conn, $usname, $email) !== false){
            header("Location: ../signup.php?error=usnametaken");
            exit();
        }else{
            $sql = "SELECT username FROM users_tbl WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "s", $usname);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0){
                    header("Location: ../signup.php?error=usnametaken");
                    exit();
                }else{

                    if($img_error == 0){
                        if($img_size <= 1000000){
                            if(in_array($img_ext, $allowed_ext)){
                                $img_new_name = uniqid("IMG-", true) . '.' . $img_ext;
                                $img_upload_path = '../imgFolder/'. $img_new_name;
                                move_uploaded_file($img_tmp_name, $img_upload_path);
                            }else{
                                header("Location: ../signup.php?error=extensionformatimg");
                            }
                        }else{
                            header("Location: ../signup.php?error=largesizeimg");
                            exit();
                        }
                    }else{
                        header("Location: ../signup.php?error=noimage");
                        exit();
                    }

                    $sql = "INSERT INTO users_tbl (lastname, firstname, username, usertype, email, phone, pwd, img_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }else{
                        //this is for encrypting the password...
                        $hashedPass = password_hash($pwd1, PASSWORD_DEFAULT);
    
                        mysqli_stmt_bind_param($stmt, "ssssssss", $lname, $fname, $usname, $usrtype, $email, $phone, $hashedPass, $img_new_name);
                        //this is for execution of the sql statement
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?error=none");
                        exit();
                    }
                }
            }
        }

    }else{
        header("Location: ../signup.php?error=clkbtn");
        exit();
    }