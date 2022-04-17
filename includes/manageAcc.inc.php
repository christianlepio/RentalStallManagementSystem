<?php
    require 'dbh.inc.php';

    if(isset($_POST['forgot-submit'])){
        $usn = $_POST['usname'];
        $sname = $_POST['lname'];
        $gname = $_POST['fname'];
        $mel = $_POST['mel'];
        $pas1 = $_POST['pas1'];
        $pas2 = $_POST['pas2'];

        if(empty($usn) || empty($sname) || empty($gname) || empty($mel) || empty($pas1) || empty($pas2)){
            header("Location: ../forgotPass.php?error=emptyfields");
            exit();
        }elseif($pas1 != $pas2){
            header("Location: ../forgotPass.php?error=pwdnotmatched");
            exit();
        }else{
            $sql = "SELECT lastname, firstname, username, email FROM users_tbl WHERE username='$usn';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            echo mysqli_error($conn);

            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $a = $row['lastname'];
                    $b = $row['firstname'];
                    $c = $row['username'];
                    $d = $row['email'];
                }
                
                if($sname == $a && $gname == $b && $usn == $c && $mel == $d){
                    
                    //this is for password hash
                    $hashP = password_hash($pas1, PASSWORD_DEFAULT);

                    $sql1 = "UPDATE users_tbl SET pwd='$hashP' WHERE username='$usn';";
                    $result1 = mysqli_query($conn, $sql1);
                    
                    if($result1){
                        header("Location: ../forgotPass.php?resetpassword=success");
                        exit();
                    }
                }else{
                    if($sname != $a){
                        header("Location: ../forgotPass.php?error=incorrectlastname");
                        exit();
                    }elseif($gname != $b){
                        header("Location: ../forgotPass.php?error=incorrectfirstname");
                        exit();
                    }elseif($usn != $c){
                        header("Location: ../forgotPass.php?error=incorrectusername");
                        exit();
                    }elseif($mel != $d){
                        header("Location: ../forgotPass.php?error=incorrectemail");
                        exit();
                    }
                }
            }else{
                header("Location: ../forgotPass.php?error=nouser");
                exit();
            }
        }
    }if(isset($_POST['cpass-submit'])){
        $uid = $_POST['uid'];
        $opass = $_POST['ppass'];
        $npass1 = $_POST['pass1'];
        $npass2 = $_POST['pass2'];

        if(empty($opass) || empty($npass1) || empty($npass2)){
            header("Location: ../cpass.php?cpassform=true&error=emptyfields"); //1
            exit();
        }elseif($npass1 != $npass2){
            header("Location: ../cpass.php?cpassform=true&error=pwdnotmatched"); //2
            exit();
        }else{
            $sql = "SELECT * FROM users_tbl WHERE userid=$uid;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $passCheck = password_verify($opass, $row['pwd']);

                    if($passCheck == false){
                        header("Location: ../cpass.php?cpassform=true&error=wrongoldpassword"); //3
                        exit();
                    }elseif($passCheck == true){
                        $hashP = password_hash($npass1, PASSWORD_DEFAULT);

                        $sql1 = "UPDATE users_tbl SET pwd='$hashP' WHERE userid=$uid;";
                        $result1 = mysqli_query($conn, $sql1);
                        
                        if($result1){
                            header("Location: ../cpass.php?cpassform=true&error=success"); //4
                            exit();
                        }                      
                    }
                }
            }
        }
    }
?>