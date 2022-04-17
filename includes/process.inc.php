<?php
    require 'dbh.inc.php';

    $userid = '';
    $uslname = '';
    $usfname  = '';
    $usname = '';
    $usrtyp = '';
    $usemail = '';
    $usphone = '';
    $cluster = '';
    $stall  = '';
    $marketfee = '';
    $status = '';

    $surveyid = '';
    $stitle = '';
    $sdescription = '';
    $start_date = '';
    $end_date = '';

    $questionid = '';
    $question = '';

    $tenantid = '';
    $tlname = '';
    $tfname = '';
    $tmname = '';
    $tgender = '';
    $tbdate = '';
    $tphone = '';
    $taddress = '';
    $tcluster = '';
    $tstall1 = '';
    $tstall2 = '';
    $tmarketfee = '';
    $tAdmit = date("Y-m-d");

    $temptcluster = '';
    $temptstall1 = '';
    $temptstall2 = '';
    $temptmarketfee = '';
    $today = '';

    $telec = '';
    $twater = '';
    $tgarbage = '';
    $tother = '';
    $torno = '';

    if(isset($_GET['deleteUser'])){
        $userid = $_GET['deleteUser'];

        $query = "SELECT * FROM users_tbl WHERE userid = $userid";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $userlast = $row['lastname'];
                $userfirst = $row['firstname'];
                $username = $row['username'];
                $usertype = $row['usertype'];
                $email = $row['email'];
                $phone = $row['phone'];
                $pwd = $row['pwd'];
                $img_url = $row['img_url'];

                $query1 = "INSERT INTO delusers_tbl (userid, lastname, firstname, username, usertype, email, phone, pwd, img_url) 
                VALUES('$userid', '$userlast', '$userfirst', '$username', '$usertype', '$email', '$phone', '$pwd', '$img_url');";
                $resquery1 = mysqli_query($conn, $query1);
                
                if($resquery1){
                    $usrtyp = $_GET['deleteusrtyp'];
                    $usrlname = $_GET['deletelname'];
                    $sql = "DELETE FROM users_tbl WHERE userid = '$userid';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../user.php?action=danger&usertyp=".$usrtyp."&userlname=".$usrlname);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['restoreUser'])){
        $userdelid = $_GET['restoreUser'];

        $query = "SELECT * FROM delusers_tbl WHERE userdelid = $userdelid";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $userid = $row['userid'];
                $userlast = $row['lastname'];
                $userfirst = $row['firstname'];
                $username = $row['username'];
                $usertype = $row['usertype'];
                $email = $row['email'];
                $phone = $row['phone'];
                $pwd = $row['pwd'];
                $img_url = $row['img_url'];

                $query1 = "INSERT INTO users_tbl (userid, lastname, firstname, username, usertype, email, phone, pwd, img_url) 
                VALUES('$userid', '$userlast', '$userfirst', '$username', '$usertype', '$email', '$phone', '$pwd', '$img_url');";
                $resquery1 = mysqli_query($conn, $query1);
                
                if($resquery1){
                    $usrtyp = $_GET['deleteusrtyp'];
                    $usrlname = $_GET['deletelname'];
                    $sql = "DELETE FROM delusers_tbl WHERE userdelid = '$userdelid';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../deletedRec.php?action=success&usertyp=".$usertype."&userlname=".$userlast);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['deletedelUser'])){
        $userdelid = $_GET['deletedelUser'];

        $usrtyp = $_GET['deleteusrtyp'];
        $usrlname = $_GET['deletelname'];
        $sql = "DELETE FROM delusers_tbl WHERE userdelid = '$userdelid';";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../deletedRec.php?action=danger&usertyp=".$usrtyp."&userlname=".$usrlname);
            exit();
        }

    }if(isset($_GET['editUser'])){
        $userid = $_GET['editUser'];

        $sql = "SELECT * FROM users_tbl WHERE userid = $userid;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $uslname = $row['lastname'];
                $usfname  = $row['firstname'];
                $usname = $row['username'];
                $usrtyp = $row['usertype'];
                $usemail = $row['email'];
                $usphone = $row['phone'];
            }
        }
    }if(isset($_POST['signup-update'])){
        $userid = $_POST['userid'];
        $uslname = $_POST['lname'];
        $usfname  = $_POST['fname'];
        $usrtyp = $_POST['usrtype'];
        $usphone = $_POST['phone'];
        
        $img_name = $_FILES['img-input']['name'];
        $img_type = $_FILES['img-input']['type'];
        $img_tmp_name = $_FILES['img-input']['tmp_name'];
        $img_error = $_FILES['img-input']['error'];
        $img_size = $_FILES['img-input']['size'];

        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_ext = array("jpeg", "jpg", "png");

        if(empty($uslname) || empty($usfname) || empty($usrtyp) || empty($usphone)){
            header("Location: ../signup.php?error=emptyinput&editUser=".$userid);
            exit();
        }else{
            if($img_error > 0){

                $sql1 = "UPDATE users_tbl SET lastname='$uslname', firstname='$usfname', usertype='$usrtyp', phone='$usphone' WHERE userid=$userid;";
                $result1 = mysqli_query($conn, $sql1);

                if($result1){
                    header("Location: ../user.php?action=warning");
                    exit();
                }
            
            }else{

                if($img_error == 0){
                    if($img_size <= 1000000){
                        if(in_array($img_ext, $allowed_ext)){
                            $img_new_name = uniqid("IMG-", true) . '.' . $img_ext;
                            $img_upload_path = '../imgFolder/'. $img_new_name;
                            move_uploaded_file($img_tmp_name, $img_upload_path);
                        }else{
                            header("Location: ../signup.php?error=extensionformatimg&editUser=".$userid);
                        }
                    }else{
                        header("Location: ../signup.php?error=largesizeimg&editUser=".$userid);
                        exit();
                    }
                }else{
                    header("Location: ../signup.php?error=noimage&editUser=".$userid);
                    exit();
                }

                $sql1 = "UPDATE users_tbl SET lastname='$uslname', firstname='$usfname', usertype='$usrtyp', phone='$usphone', img_url='$img_new_name' WHERE userid=$userid;";
                $result1 = mysqli_query($conn, $sql1);

                if($result1){
                    header("Location: ../user.php?action=warning");
                    exit();
                }
        }
        }

    }if(isset($_POST['rental-submit'])){
        $cluster = $_POST['cluster'];
        $stall = $_POST['stallnum'];
        $marketfee = $_POST['marketfee'];
        $status = $_POST['status'];

        if(empty($cluster) || empty($stall) || empty($marketfee) || empty($status)){
            header("Location: ../rentalRegi.php?error=emptyinput");
            exit();
        }else{
            $sql = "INSERT INTO rental_tbl (cluster, stallno, marketfee, status) VALUES('$cluster','$stall','$marketfee','$status');";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("Location: ../rentalRegi.php?error=none");
                exit();
            }
        }
    }/*if(isset($_POST['sol'])){
        $result = false;
        for($x = 1; $x < 65; $x++){
            $sql = "INSERT INTO rental_tbl (cluster, stallno, marketfee, status) VALUES('Chicken Section','$x',80,'Available');";
            $result = mysqli_query($conn, $sql);
        }
        if($result){
            header("Location: ../rental.php?error=VegetableOld");
            exit();
        }
    }*/
    if(isset($_GET['editRental'])){
        $rentalid = $_GET['editRental'];

        $sql = "SELECT * FROM rental_tbl WHERE rentalid=$rentalid;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $cluster = $row['cluster'];
                $stall  = $row['stallno'];
                $marketfee = $row['marketfee'];
                $status = $row['status'];
            }
        }
    }if(isset($_POST['rental-update'])){
        $rentalid  = $_POST['rentalid'];
        $cluster = $_POST['cluster'];
        $stall = $_POST['stallnum'];
        $marketfee = $_POST['marketfee'];
        $status = $_POST['status'];   

        if(empty($cluster) || empty($stall) || empty($marketfee) || empty($status)){
            header("Location: ../rentalRegi.php?error=emptyinput&editRental=".$rentalid);
            exit();
        }else{
            $sql = "UPDATE rental_tbl SET cluster='$cluster', stallno='$stall', marketfee='$marketfee', status='$status' WHERE rentalid=$rentalid;";
            $result1 = mysqli_query($conn, $sql);
            echo mysqli_error($conn);
            if($result1){
                header("Location: ../rental.php?action=warning");
                exit();
            }       
        }
    }if(isset($_GET['deleteRental'])){
        $rentalid  = $_GET['deleteRental'];
        $rentcluster = $_GET['deleterentcluster'];
        $rentstall = $_GET['deleterentstallno'];

        $query = "SELECT * FROM rental_tbl WHERE rentalid = '$rentalid'";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $holderid = $row['holderid'];
                $holder = $row['holder'];
                $cluster = $row['cluster'];
                $stallno = $row['stallno'];
                $marketfee = $row['marketfee'];
                $status = $row['status'];
                
                $query1 = "INSERT INTO delrental_tbl (rentalid, holderid, holder, cluster, stallno, marketfee, status) 
                VALUES('$rentalid', '$holderid', '$holder', '$cluster', '$stallno', '$marketfee', '$status');";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $sql = "DELETE FROM rental_tbl WHERE rentalid='$rentalid';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../rental.php?action=danger&cluster=".$rentcluster."&stall=".$rentstall);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['restoreRental'])){
        $rentalid  = $_GET['restoreRental'];
        $rentcluster = $_GET['deleterentcluster'];
        $rentstall = $_GET['deleterentstallno'];

        $query = "SELECT * FROM delrental_tbl WHERE rentalid = '$rentalid'";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $holderid = $row['holderid'];
                $holder = $row['holder'];
                $cluster = $row['cluster'];
                $stallno = $row['stallno'];
                $marketfee = $row['marketfee'];
                $status = $row['status'];
                
                $query1 = "INSERT INTO rental_tbl (rentalid, holderid, holder, cluster, stallno, marketfee, status) 
                VALUES('$rentalid', '$holderid', '$holder', '$cluster', '$stallno', '$marketfee', '$status');";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $sql = "DELETE FROM delrental_tbl WHERE rentalid='$rentalid';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../deletedRec.php?actionrental=success&cluster=".$cluster."&stall=".$stallno);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['deletedelRental'])){
        $rentalid = $_GET['deletedelRental'];
        $cluster = $_GET['deleterentcluster'];
        $stallno = $_GET['deleterentstallno'];

        $sql = "DELETE FROM delrental_tbl WHERE rentalid='$rentalid';";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../deletedRec.php?actionrental=danger&cluster=".$cluster."&stall=".$stallno);
            exit();
        }
    }if(isset($_POST['tenant-submit'])){
        $tlname = strtoupper($_POST['lname']);
        $tfname = strtoupper($_POST['fname']);
        $tmname = strtoupper($_POST['mname']);
        $tgender = strtoupper($_POST['gender']);
        $tbdate = $_POST['bday'];
        $tphone = $_POST['phone'];
        $taddress = strtoupper($_POST['address']);
        $tAdmit = $_POST['dateAdmit'];
        $tcluster = strtoupper($_POST['cluster']);
        $tstall1 = $_POST['cluster1'];
        $tstall2 = $_POST['cluster2'];
        $tmarketfee = $_POST['marketfee'];

        $sqlcheck = "SELECT * FROM rental_tbl WHERE cluster='$tcluster' AND stallno >= '$tstall1' AND stallno <= '$tstall2' AND status='Occupied';";
        $res = mysqli_query($conn, $sqlcheck);
        $rescheck = mysqli_num_rows($res);

        if(empty($tlname) || empty($tfname) || empty($tmname) || empty($tgender) || empty($tbdate) || empty($tphone) || empty($taddress) || empty($tAdmit) || empty($tcluster) || empty($tstall1) || empty($tstall2) || empty($tmarketfee)){
            header("Location: ../tenantRegi.php?error=emptyinput");
            exit();
        }elseif($rescheck > 0){
            header("Location: ../tenantRegi.php?error=occupiedstall");
            exit();
        }else{
            $sql = "INSERT INTO tenants_tbl (tenantlastname, tenantfirstname, tenantmiddlename, tenantgender, birthdate, phoneno, address, dateAdmitted, cluster, clusterno1, clusterno2, marketfee) 
            VALUES('$tlname', '$tfname', '$tmname', '$tgender', '$tbdate', '$tphone', '$taddress', '$tAdmit', '$tcluster', '$tstall1', '$tstall2', '$tmarketfee');";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sikwel = "SELECT * from tenants_tbl WHERE tenantlastname='$tlname' AND cluster='$tcluster' AND clusterno1='$tstall1' AND clusterno2='$tstall2';";
                $sikwelres = mysqli_query($conn, $sikwel);
                $sikwelrescheck = mysqli_num_rows($sikwelres);
                if($sikwelrescheck > 0){
                    while($rows = mysqli_fetch_assoc($sikwelres)){
                        $holderid = $rows['tenantid'];
                        $holdername = $rows['tenantlastname'];
                    }
                }

                $sql1 = "UPDATE rental_tbl SET holderid='$holderid', holder='$holdername', status='Occupied' WHERE cluster='$tcluster' AND stallno >= '$tstall1' AND stallno <= '$tstall2';";
                $result1 = mysqli_query($conn, $sql1);

                echo mysqli_error($conn);

                header("Location: ../tenantRegi.php?error=none");
                exit();
            }
        }
    }if(isset($_GET['editTenant'])){
        $tenantid = $_GET['editTenant'];

        $sql = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tlname = $row['tenantlastname'];
                $tfname = $row['tenantfirstname'];
                $tmname = $row['tenantmiddlename'];
                $tgender = $row['tenantgender'];
                $tbdate = $row['birthdate'];
                $tphone = $row['phoneno'];
                $taddress = $row['address'];
                $tAdmit = $row['dateAdmitted'];
                $tcluster = $row['cluster'];
                $tstall1 = $row['clusterno1'];
                $tstall2 = $row['clusterno2'];
                $tmarketfee = $row['marketfee'];           
            }
        }
    }if(isset($_POST['tenant-update'])){
        $tenantid = $_POST['tenantid'];
        $tlname = strtoupper($_POST['lname']);
        $tfname = strtoupper($_POST['fname']);
        $tmname = strtoupper($_POST['mname']);
        $tgender = strtoupper($_POST['gender']);
        $tbdate = $_POST['bday'];
        $tphone = $_POST['phone'];
        $taddress = strtoupper($_POST['address']);
        $tAdmit = $_POST['dateAdmit'];
        $tcluster = strtoupper($_POST['cluster']);
        $tstall1 = $_POST['cluster1'];
        $tstall2 = $_POST['cluster2'];
        $tmarketfee = $_POST['marketfee'];
        
        $sql = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $temptlname = $row['tenantlastname'];
                $temptcluster = $row['cluster'];
                $temptstall1 = $row['clusterno1'];
                $temptstall2 = $row['clusterno2'];
                $temptmarketfee = $row['marketfee'];
            }
        }
        if(empty($tlname) || empty($tfname) || empty($tmname) || empty($tgender) || empty($tbdate) || empty($tphone) || empty($taddress) || empty($tAdmit) || empty($tcluster) || empty($tstall1) || empty($tstall2) || empty($tmarketfee)){
            header("Location: ../tenantRegi.php?error=emptyinput&editTenant=".$tenantid);
            exit();
        }else{
            if($temptcluster != $tcluster || $temptstall1 != $tstall1 || $temptstall2 != $tstall2){
            
                $sikwel = "UPDATE rental_tbl SET holderid=0, holder='', status='Available' WHERE holderid='$tenantid' AND cluster='$temptcluster' AND stallno >= '$temptstall1' AND stallno <= '$temptstall2';";
                $ressikwel = mysqli_query($conn, $sikwel);

                $sqlcheck = "SELECT * FROM rental_tbl WHERE cluster='$tcluster' AND stallno >= '$tstall1' AND stallno <= '$tstall2' AND status='Occupied';";
                $res = mysqli_query($conn, $sqlcheck);
                $rescheck = mysqli_num_rows($res);

                if($rescheck > 0){
                    $sql1 = "UPDATE rental_tbl SET holderid='$tenantid', holder='$temptlname', status='Occupied' WHERE cluster='$temptcluster' AND stallno >= '$temptstall1' AND stallno <= '$temptstall2';";
                    $result1 = mysqli_query($conn, $sql1);
                    header("Location: ../tenantRegi.php?error=occupiedstall&editTenant=".$tenantid);
                    exit();
                }else{
                    $sql1 = "UPDATE rental_tbl SET holderid=0, holder='', status='Available' WHERE holderid='$tenantid';";
                    $result1 = mysqli_query($conn, $sql1);
                
                    $sql2 = "UPDATE tenants_tbl SET tenantlastname='$tlname', tenantfirstname='$tfname', tenantmiddlename='$tmname', tenantgender='$tgender', birthdate='$tbdate', phoneno='$tphone', address='$taddress', dateAdmitted='$tAdmit', cluster='$tcluster', clusterno1='$tstall1', clusterno2='$tstall2', marketfee='$tmarketfee' WHERE tenantid = $tenantid;";
                    $result2 = mysqli_query($conn, $sql2);
                    echo mysqli_error($conn);

                    if($result2){
                        $sql4 = "UPDATE rental_tbl SET holderid='$tenantid', holder='$tlname', status='Occupied' WHERE cluster='$tcluster' AND stallno >= '$tstall1' AND stallno <= '$tstall2';";
                        $result4 = mysqli_query($conn, $sql4);
    
                        echo mysqli_error($conn);
    
                        header("Location: ../tenants.php?action=warning&lname=".$tlname);
                        exit();
                    }
                }

            }else{
                $sql2 = "UPDATE tenants_tbl SET tenantlastname='$tlname', tenantfirstname='$tfname', tenantmiddlename='$tmname', tenantgender='$tgender', birthdate='$tbdate', phoneno='$tphone', address='$taddress', dateAdmitted='$tAdmit', cluster='$tcluster', clusterno1='$tstall1', clusterno2='$tstall2', marketfee='$tmarketfee' WHERE tenantid = $tenantid;";
                $result2 = mysqli_query($conn, $sql2);
                echo mysqli_error($conn);

                if($result2){
                    $sql4 = "UPDATE rental_tbl SET holderid='$tenantid', holder='$tlname', status='Occupied' WHERE cluster='$tcluster' AND stallno >= '$tstall1' AND stallno <= '$tstall2';";
                        $result4 = mysqli_query($conn, $sql4);
    
                        echo mysqli_error($conn);
                    header("Location: ../tenants.php?action=warning&lname=".$tlname);
                    exit();
                }
            }
        }
    }if(isset($_GET['deleteTenant'])){
        $tenantid = $_GET['deleteTenant'];

        $sql = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo mysqli_error($conn);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $temptcluster = $row['cluster'];
                $temptstall1 = $row['clusterno1'];
                $temptstall2 = $row['clusterno2'];
                $temptmarketfee = $row['marketfee'];

                
                $tenantlastname = $row['tenantlastname'];
                $tenantfirstname = $row['tenantfirstname'];
                $tenantmiddlename = $row['tenantmiddlename'];
                $tenantgender = $row['tenantgender'];
                $birthdate = $row['birthdate'];
                $phoneno = $row['phoneno'];
                $address = $row['address'];
                $dateAdmitted = $row['dateAdmitted'];
                $cluster = $row['cluster'];
                $clusterno1 = $row['clusterno1'];
                $clusterno2 = $row['clusterno2'];
                $marketfee = $row['marketfee'];

                $query = "INSERT INTO deltenants_tbl (tenantid, tenantlastname, tenantfirstname, tenantmiddlename, tenantgender, birthdate, phoneno, address, dateAdmitted, cluster, clusterno1, clusterno2, marketfee) 
                VALUES('$tenantid', '$tenantlastname', '$tenantfirstname', '$tenantmiddlename', '$tenantgender', '$birthdate', '$phoneno', '$address', '$dateAdmitted', '$cluster', '$clusterno1', '$clusterno2', '$marketfee');";
                $resquery = mysqli_query($conn, $query);
                echo mysqli_error($conn);
                if($resquery){
                    $sql1 = "UPDATE rental_tbl SET holderid=0, holder='', status='Available' WHERE holderid='$tenantid' AND cluster='$temptcluster' AND stallno >= '$temptstall1' AND stallno <= '$temptstall2';";
                    $result1 = mysqli_query($conn, $sql1);
                    
                    echo mysqli_error($conn);
            
                    if($result1){
                        $sql2 = "DELETE FROM tenants_tbl WHERE tenantid = $tenantid;";
                        $result2 = mysqli_query($conn, $sql2);
                        echo mysqli_error($conn);
                        if($result2){
                            header("Location: ../tenants.php?action=danger&dellastname=".$tenantlastname);
                            exit(); 
                        }
                    }
                }
            }
        }
    }if(isset($_GET['restoreTenant'])){
        $tenantid = $_GET['restoreTenant'];

        $sql = "SELECT * FROM deltenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo mysqli_error($conn);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                
                $tenantlastname = $row['tenantlastname'];
                $tenantfirstname = $row['tenantfirstname'];
                $tenantmiddlename = $row['tenantmiddlename'];
                $tenantgender = $row['tenantgender'];
                $birthdate = $row['birthdate'];
                $phoneno = $row['phoneno'];
                $address = $row['address'];
                $dateAdmitted = $row['dateAdmitted'];
                $cluster = $row['cluster'];
                $clusterno1 = $row['clusterno1'];
                $clusterno2 = $row['clusterno2'];
                $marketfee = $row['marketfee'];

                $query = "INSERT INTO tenants_tbl (tenantid, tenantlastname, tenantfirstname, tenantmiddlename, tenantgender, birthdate, phoneno, address, dateAdmitted, cluster, clusterno1, clusterno2, marketfee) 
                VALUES('$tenantid', '$tenantlastname', '$tenantfirstname', '$tenantmiddlename', '$tenantgender', '$birthdate', '$phoneno', '$address', '$dateAdmitted', '$cluster', '$clusterno1', '$clusterno2', '$marketfee');";
                $resquery = mysqli_query($conn, $query);
                echo mysqli_error($conn);
                if($resquery){
                    $sql1 = "UPDATE rental_tbl SET holderid='$tenantid', holder='$tenantlastname', status='Occupied' WHERE cluster='$cluster' AND stallno >= '$clusterno1' AND stallno <= '$clusterno2';";
                    $result1 = mysqli_query($conn, $sql1);
                    
                    echo mysqli_error($conn);
            
                    if($result1){
                        $sql2 = "DELETE FROM deltenants_tbl WHERE tenantid = $tenantid;";
                        $result2 = mysqli_query($conn, $sql2);
                        echo mysqli_error($conn);
                        if($result2){
                            header("Location: ../deletedRec.php?actiontenant=success&dellastname=".$tenantlastname);
                            exit(); 
                        }
                    }
                }
            }
        }
    }if(isset($_GET['deletedelTenant'])){
        $tenantid = $_GET['deletedelTenant'];

        $sql2 = "DELETE FROM deltenants_tbl WHERE tenantid = $tenantid;";
        $result2 = mysqli_query($conn, $sql2);
        echo mysqli_error($conn);
        if($result2){
            header("Location: ../deletedRec.php?actiontenant=danger&dellastname=".$tenantlastname);
            exit(); 
        }
    }if(isset( $_GET['addPay'])){
        $tenantid = $_GET['addPay'];
        $today = date("Y-m-d");

        $sql = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tlname = $row['tenantlastname'];
                $tfname = $row['tenantfirstname'];
                $tcluster = $row['cluster'];
                $tstall1 = $row['clusterno1'];
                $tstall2 = $row['clusterno2'];
                $tmarketfee = $row['marketfee'];           
            }
        }
        $totalmarketfee = (abs($tstall2 - $tstall1)+1)*$tmarketfee;
    }if(isset($_POST['payment-submit'])){
        $tenantid = $_POST['tenantid'];
        $pdate = $_POST['pdate'];
        $pholder = $_POST['hiddenlname'];
        $pcluster = $_POST['hiddencluster'];
        $pstall = $_POST['hiddenstall'];
        $pmarketfee = $_POST['totmarketfee'];
        $pelec = $_POST['elec'];
        $pwater = $_POST['water'];
        $pgarbage = $_POST['garbage'];
        $potherf = $_POST['otherf'];
        $pornum = $_POST['orn'];

        date_default_timezone_set('Asia/Manila');
        $taym = $pdate." ".date('g:i:s');

        $sql = "SELECT * FROM tenants_tbl WHERE tenantid = '$tenantid';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tlname = $row['tenantlastname'];
                $tfname = $row['tenantfirstname'];
                $tcluster = $row['cluster'];
                $tstall1 = $row['clusterno1'];
                $tstall2 = $row['clusterno2'];
                $tmarketfee = $row['marketfee'];           
            }
        }

        if(empty($pdate) || empty($pmarketfee) || empty($pornum)){
            header("Location: ../paymentForm.php?error=emptyinput&addPay=".$tenantid);
            exit();
        }if(empty($pelec)){
            $pelec=0;
        }if(empty($pwater)){
            $pwater=0;
        }if(empty($pgarbage)){
            $pgarbage=0;
        }if(empty($potherf)){
            $potherf=0;
        }if(strlen($pornum) != 7){
            header("Location: ../paymentForm.php?error=ornumlength&addPay=".$tenantid);
            exit();
        }
        $totalpayment = $pmarketfee + $pelec + $pwater + $pgarbage + $potherf;

        $sql1 = "INSERT INTO payment_tbl (tenantid, ornumber, timestamp, paymentdate, holder, cluster, clusterno1, clusterno2, marketfee, electricity, water, garbage, other, total) 
        VALUES('$tenantid', '$pornum', '$taym', '$pdate', '$pholder', '$pcluster', '$tstall1', '$tstall2', '$pmarketfee', '$pelec', '$pwater', '$pgarbage', '$potherf', '$totalpayment');";
        $result1 = mysqli_query($conn, $sql1);

        echo mysqli_error($conn);

        if($result1){
            header("Location: ../payment.php?action=success&lname=".$pholder);
            exit();
        }
    }if(isset($_GET['editPayment'])){
        $paymentid = $_GET['editPayment'];

        $sql = "SELECT * FROM payment_tbl WHERE paymentid='$paymentid';";
        $result = mysqli_query($conn, $sql);
        $rescheck = mysqli_num_rows($result);

        if($rescheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tenantid = $row['tenantid'];
                $today = $row['paymentdate'];
                $holder = $row['holder'];
                $tcluster = $row['cluster'];
                $tstall1 = $row['clusterno1'];
                $tstall2 = $row['clusterno2'];
                $totalmarketfee = $row['marketfee'];
                $telec = $row['electricity'];
                $twater = $row['water'];
                $tgarbage = $row['garbage'];
                $tother = $row['other'];
                $torno = $row['ornumber'];
            }
        }
    }if(isset($_POST['payment-update'])){
        $paymentid = $_POST['paymentid'];
        $tenantid = $_POST['tenantid'];
        $pdate = $_POST['pdate'];
        $pholder = $_POST['hiddenlname'];
        $pcluster = $_POST['hiddencluster'];
        $pstall = $_POST['hiddenstall'];
        $pmarketfee = $_POST['totmarketfee'];
        $pelec = $_POST['elec'];
        $pwater = $_POST['water'];
        $pgarbage = $_POST['garbage'];
        $potherf = $_POST['otherf'];
        $pornum = $_POST['orn'];

        $sql = "SELECT * FROM payment_tbl WHERE paymentid='$paymentid';";
        $result = mysqli_query($conn, $sql);
        $rescheck = mysqli_num_rows($result);

        if($rescheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tcluster = $row['cluster'];
                $tstall1 = $row['clusterno1'];
                $tstall2 = $row['clusterno2'];
            }
        }

        if(empty($pdate) || empty($pmarketfee) || empty($pornum)){
            header("Location: ../paymentForm.php?error=emptyinput&editPayment=".$paymentid);
            exit();
        }if(empty($pelec)){
            $pelec=0;
        }if(empty($pwater)){
            $pwater=0;
        }if(empty($pgarbage)){
            $pgarbage=0;
        }if(empty($potherf)){
            $potherf=0;
        }if(strlen($pornum) != 7){
            header("Location: ../paymentForm.php?error=ornumlength&editPayment=".$paymentid);
            exit();
        }
        $totalpayment = $pmarketfee + $pelec + $pwater + $pgarbage + $potherf;

        $sql1 = "UPDATE payment_tbl SET ornumber='$pornum',  marketfee='$pmarketfee', electricity='$pelec', water='$pwater', garbage='$pgarbage', other='$potherf', total='$totalpayment' WHERE paymentid='$paymentid';";
        $result1 = mysqli_query($conn, $sql1);

        if($result1){
            header("Location: ../payment.php?action=warning&lname=".$pholder);
            exit();
        }
    }if(isset($_GET['deletePayment'])){
        $paymentid = $_GET['deletePayment'];

        $query = "SELECT * FROM payment_tbl WHERE paymentid='$paymentid';";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $tenantid = $row['tenantid'];
                $ornumber = $row['ornumber'];
                $timestamp = $row['timestamp'];
                $paymentdate = $row['paymentdate'];
                $paymenttime = $row['paymenttime'];
                $holder = $row['holder'];
                $cluster = $row['cluster'];
                $clusterno1 = $row['clusterno1'];
                $clusterno2 = $row['clusterno2'];
                $marketfee = $row['marketfee'];
                $electricity = $row['electricity'];
                $water = $row['water'];
                $garbage = $row['garbage'];
                $other = $row['other'];
                $total = $row['total'];

                $query1 = "INSERT INTO delpayment_tbl (paymentid, tenantid, ornumber, timestamp, paymentdate, paymenttime, holder, cluster, clusterno1, clusterno2, marketfee, electricity, water, garbage, other, total) 
                VALUES('$paymentid', '$tenantid', '$ornumber', '$timestamp', '$paymentdate', '$paymenttime', '$holder', '$cluster', '$clusterno1', '$clusterno2', '$marketfee', '$electricity', '$water', '$garbage', '$other', '$total');";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $sql = "DELETE FROM payment_tbl WHERE paymentid='$paymentid';";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        header("Location: ../payment.php?action=danger&lname=".$holder);
                        exit();
                    }
                }
            }
        } 
    }if(isset($_GET['restoredelPayment'])){
        $paymentid = $_GET['restoredelPayment'];

        $query = "SELECT * FROM delpayment_tbl WHERE paymentid='$paymentid';";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $tenantid = $row['tenantid'];
                $ornumber = $row['ornumber'];
                $timestamp = $row['timestamp'];
                $paymentdate = $row['paymentdate'];
                $paymenttime = $row['paymenttime'];
                $holder = $row['holder'];
                $cluster = $row['cluster'];
                $clusterno1 = $row['clusterno1'];
                $clusterno2 = $row['clusterno2'];
                $marketfee = $row['marketfee'];
                $electricity = $row['electricity'];
                $water = $row['water'];
                $garbage = $row['garbage'];
                $other = $row['other'];
                $total = $row['total'];

                $query1 = "INSERT INTO payment_tbl (paymentid, tenantid, ornumber, timestamp, paymentdate, paymenttime, holder, cluster, clusterno1, clusterno2, marketfee, electricity, water, garbage, other, total) 
                VALUES('$paymentid', '$tenantid', '$ornumber', '$timestamp', '$paymentdate', '$paymenttime', '$holder', '$cluster', '$clusterno1', '$clusterno2', '$marketfee', '$electricity', '$water', '$garbage', '$other', '$total');";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $sql = "DELETE FROM delpayment_tbl WHERE paymentid='$paymentid';";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        header("Location: ../deletedRec.php?actiondelpay=success&lname=".$holder);
                        exit();
                    }
                }
            }
        } 
    }if(isset($_GET['deleteInquiry'])){
        $inq_id = $_GET['deleteInquiry'];

        $query = "SELECT * FROM inquiry_tbl WHERE Inq_id = $inq_id";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $inq_date = $row['inq_date'];
                $status = $row['status'];
                $lastname = $row['lastname'];
                $firstname = $row['firstname'];
                $gender = $row['gender'];
                $contact = $row['contact'];
                $address = $row['address'];
                $cluster = $row['cluster'];
                $productname = $row['productname'];
                $concern = $row['concern'];

                $query1 = "INSERT INTO delinquiry_tbl (Inq_id, inq_date, status, lastname, firstname, gender, contact, address, cluster, productname, concern) 
                VALUES('$inq_id', '$inq_date', '$status', '$lastname', '$firstname', '$gender', '$contact', '$address', '$cluster', '$productname', '$concern')";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $inqlast = $_GET['deleteinqname'];
        
                    $sql = "DELETE FROM inquiry_tbl WHERE Inq_id = '$inq_id';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../inquiry.php?action=danger&lastname=".$inqlast);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['restoreInquiry'])){
        $inq_id = $_GET['restoreInquiry'];

        $query = "SELECT * FROM delinquiry_tbl WHERE Inq_id = $inq_id";
        $resquery = mysqli_query($conn, $query);
        $resqueryCheck = mysqli_num_rows($resquery);

        if($resqueryCheck > 0){
            while($row = mysqli_fetch_assoc($resquery)){
                $inq_date = $row['inq_date'];
                $status = $row['status'];
                $lastname = $row['lastname'];
                $firstname = $row['firstname'];
                $gender = $row['gender'];
                $contact = $row['contact'];
                $address = $row['address'];
                $cluster = $row['cluster'];
                $productname = $row['productname'];
                $concern = $row['concern'];

                $query1 = "INSERT INTO inquiry_tbl (Inq_id, inq_date, status, lastname, firstname, gender, contact, address, cluster, productname, concern) 
                VALUES('$inq_id', '$inq_date', '$status', '$lastname', '$firstname', '$gender', '$contact', '$address', '$cluster', '$productname', '$concern')";
                $resquery1 = mysqli_query($conn, $query1);

                if($resquery1){
                    $inqlast = $_GET['deleteinqname'];
        
                    $sql = "DELETE FROM delinquiry_tbl WHERE Inq_id = '$inq_id';";
                    $result = mysqli_query($conn, $sql);
            
                    if($result){
                        header("Location: ../deletedRec.php?actioninquiry=success&lastname=".$lastname);
                        exit();
                    }
                }
            }
        }
    }if(isset($_GET['deletedelInquiry'])){
        $inq_id = $_GET['deletedelInquiry'];
        $inqlast = $_GET['deletedelinqname'];
        
        $sql = "DELETE FROM delinquiry_tbl WHERE Inq_id = '$inq_id';";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: ../deletedRec.php?actioninquiry=danger&lastname=".$inqlast);
            exit();
        }
    }if(isset($_GET['addsurvey'])){
        $surveyid = $_GET['addsurvey'];

        $query = "SELECT * FROM surveyset_tbl WHERE surveyid = '$surveyid';";
        $result = mysqli_query($conn, $query);
        $rescheck = mysqli_num_rows($result);
        
        if($rescheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $surveyid = $row['surveyid'];
                $stitle = $row['stitle'];
                $sdescription = $row['sdescription'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
            }
        }
    }if(isset($_GET['editquestion'])){
        $questionid = $_GET['editquestion'];

        $query = "SELECT * FROM question_tbl WHERE questionid = '$questionid';";
        $result = mysqli_query($conn, $query);
        $rescheck = mysqli_num_rows($result);
        
        if($rescheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $surveyid = $row['surveyid'];
                $question = $row['question'];
            }
        }
    }