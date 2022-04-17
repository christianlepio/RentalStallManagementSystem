<?php
    function emptyInput($lname, $fname, $usname, $usrtype, $email, $pwd1, $pwd2, $phone, $img_error){
        $result;

        if(empty($lname) || empty($fname) || empty($usname) || empty($usrtype) || empty($email) || empty($pwd1) || empty($pwd2) || empty($phone) || $img_error > 0){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function invalidUid($usname){
        $result;

        if(!preg_match("/^[a-zA-Z0-9]*$/", $usname)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email){
        $result;
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pwd1, $pwd2){
        $result;
        
        if($pwd1 !== $pwd2){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function usnameExists($conn, $usname, $email){
        $sql = "SELECT * FROM users_tbl WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $usname, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }

    function emptyInputLogin($username, $pass){
        $result;

        if(empty($username) || empty($pass)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }