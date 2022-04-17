<?php
    session_start();
    $_SESSION['actib'] = 'delrec';
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
        <style>
            .bord{
                border-top: 2px solid red;
            }
            .bordd{
                border-top: 2px solid orange;
            }
            .borddd{
                border-top: 2px solid green;
            }
            .bordddd{
                border-top: 2px solid violet;
            }
            .borde{
                border-top: 2px solid blue;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">

        <h3 class="fw-bold"><i class="fa-solid fa-trash-can"></i> Deleted Records</h3><br>

        <!-- This is for users -->
        <?php
            if($_SESSION['ustype'] == 'Admin'){
        ?>
        <div class="row g-3 my-2 justify-content-around" id="unpaid">
            <div class="col-md-12 g-5 my-2 py-3 bg-light bord border-4 shadow-sm rounded">
            <h5 class="text-start"><i class="fa-solid fa-user"></i> Users</h5><hr>
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'success')
                                echo '<i class="fa-solid fa-circle-check"></i>&nbsp; '.$_GET['usertyp'].' '.$_GET['userlname'].' has been restored !';
                            elseif($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; '.$_GET['usertyp'].' '.$_GET['userlname'].' has been permanently deleted !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>
                <?php
                    $sql = "SELECT * FROM delusers_tbl ORDER BY lastname ASC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
                <div class="table-responsive">
                <table id="myDataTable" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Profile</th>
                            <th>Last name</th>
                            <th>First name</th>
                            <th>Username</th>
                            <th>User type</th>
                            <th>Email</th>
                            <th>Phone no.</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Restore</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php
                            $no = 0;
                            if($resultCheck > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>';
                                        echo '<td class="fw-bold">'.++$no.'.</td>';
                                        echo '<td class="text-center"><img style="width:50px; height:50px; border-radius:25px;" src="imgFolder/'.$row['img_url'].'"></td>';
                                        echo '<td>'.strtoupper($row['lastname']).'</td>';
                                        echo '<td>'.$row['firstname'].'</td>';
                                        echo '<td>'.$row['username'].'</td>';
                                        echo '<td>'.$row['usertype'].'</td>';
                                        echo '<td>'.$row['email'].'</td>';
                                        echo '<td>'.$row['phone'].'</td>';
                                        echo '<td class="text-center"><a href="deletedRec.php?view='.$row['userid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                        echo '<td class="text-center"><a href="includes/process.inc.php?restoreUser='.$row['userdelid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-trash-arrow-up"></i></a></td>';
                                        echo '<td class="text-center"><a href="includes/process.inc.php?deletedelUser='.$row['userdelid'].'&deletelname='.strtoupper($row['lastname']).'&deleteusrtyp='.ucfirst($row['usertype']).'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                                    echo '</tr>';
                                }

                            }
                        ?>
                    </tbody>
                </table>
                </div><hr>
                <?php
                    if(isset($_GET['view'])){
                        $iddd = $_GET['view'];
                        $sql = "SELECT * FROM delusers_tbl WHERE userid=$iddd;";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $p = $row['img_url'];
                                $k = $row['userid'];
                                $a = $row['lastname'];
                                $b = $row['firstname'];
                                $c = $row['username'];
                                $h = $row['usertype'];
                                $d = $row['email'];
                                $ph = $row['phone'];
                                
                            }
                        }
                        echo '<script>
                            let str = `<center><img style="height:110px; width:110px; border-radius:60px;" src="imgFolder/'.$p.'"><br><h3>Profile</h3></center><br>Last Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>First Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>Username:&nbsp;&nbsp;&nbsp;&nbsp; '.$c.'<br>
                            User Type:&nbsp;&nbsp;&nbsp;&nbsp; '.$h.'<br>Email:&nbsp;&nbsp;&nbsp;&nbsp; '.$d.'<br>Phone no.:&nbsp;&nbsp;&nbsp;&nbsp; '.$ph.'<br>`
                            Alert.render(str)
                            </script>';
                    }
                ?>

            </div>
        </div>
        <?php
            }
        ?>
        
        <!-- This is for inquiry -->
        <div class="row g-3 my-2 justify-content-around" id="unpaid">
            <div class="col-md-12 g-5 my-2 py-3 bg-light bordd border-4 shadow-sm rounded">
            <h5 class="text-start"><i class='bx bx-message-square-detail'></i> Inquiries</h5><hr>
            <?php
                    if(isset($_GET['actioninquiry'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['actioninquiry'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['actioninquiry'] == 'success')
                                echo '<i class="fa-solid fa-circle-check"></i>&nbsp; Inquiry of Mr./Ms. '.$_GET['lastname'].' has been restored !';
                            elseif($_GET['actioninquiry'] == 'danger')
                                echo '<i class="fa-solid fa-trash"></i></i>&nbsp; Inquiry of Mr./Ms. '.$_GET['lastname'].' has been permanently deleted !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                    }
                ?>
        
            <?php
                $sql = "SELECT * FROM delinquiry_tbl ORDER BY delinquiryid DESC;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
            ?>
            <div class="table-responsive">
            <table id="myDataTable1" class="table table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Status</th>
                        <th>Inquiry Date</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Product Name</th>
                        <th>Cluster</th>
                        <th>Concern</th>

                        <th class="text-center">View</th>
                        <th class="text-center">Restore</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php
                        $nn = "NONE";
                        $no = 0;
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo '<tr>';
                                    echo '<td class="fw-bold">'.++$no.'.</td>';

                                    if($row['status'] == 'unread'){
                                        echo '<td class="text-center"><p class="bg-danger text-white rounded"><small>'.$row['status'].'</small></p></td>';
                                    }elseif($row['status'] == 'read'){
                                        echo '<td class="text-center"><p class="bg-warning text-white rounded"><small>'.$row['status'].'</small></p></td>';
                                    }

                                    echo '<td>'.$row['inq_date'].'</td>';
                                    echo '<td>'.strtoupper($row['lastname']).'</td>';
                                    echo '<td>'.$row['firstname'].'</td>';
                                    echo '<td>'.$row['gender'].'</td>';
                                    echo '<td>'.$row['address'].'</td>';
                                    echo '<td>'.$row['contact'].'</td>';
                                    echo '<td>'.$row['productname'].'</td>';
                                    echo '<td>'.$row['cluster'].'</td>';
                                    echo '<td>'.$row['concern'].'</td>';

                                    echo '<td class="text-center"><a href="deletedRec.php?viewinquiry='.$row['Inq_id'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                    echo '<td class="text-center"><a href="includes/process.inc.php?restoreInquiry='.$row['Inq_id'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-trash-arrow-up"></i></a></td>';
                                    echo '<td class="text-center"><a href="includes/process.inc.php?deletedelInquiry='.$row['Inq_id'].'&deletedelinqname='.$row['lastname'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                                echo '</tr>';
                            }

                        }
                    ?>
                </tbody>
            </table>
            </div><hr>
            <?php
                if(isset($_GET['viewinquiry'])){
                    $iddd = $_GET['viewinquiry'];

                        $sql = "SELECT * FROM delinquiry_tbl WHERE Inq_id=$iddd;";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $a = $row['inq_date'];
                                $b = $row['lastname'];
                                $c = $row['firstname'];
                                $d = $row['gender'];
                                $e = $row['address'];
                                $f = $row['contact'];
                                $g = $row['productname'];
                                $h = $row['cluster'];
                                $i = $row['concern'];
                            }
                            echo '<script>
                                        let str = `<br>Inquiry Date:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>Last name:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>First name:&nbsp;&nbsp;&nbsp;&nbsp; '.$c.'<br>
                                        Gender:&nbsp;&nbsp;&nbsp;&nbsp; '.$d.'<br>Address:&nbsp;&nbsp;&nbsp;&nbsp; '.$e.'<br>Contact:&nbsp;&nbsp;&nbsp;&nbsp; '.$f.'<br>Product name:&nbsp;&nbsp;&nbsp;&nbsp; '.$g.'<br>
                                        Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$h.'<br>Concern:&nbsp;&nbsp;&nbsp;&nbsp; '.$i.'<br>`
                                        Alert.render(str)
                                    </script>';
                    }
                }
            ?>
            </div>
        </div>

        <!-- This is for rental -->
        <div class="row g-3 my-2 justify-content-around" id="delrental">
            <div class="col-md-12 g-5 my-2 py-3 bg-light borddd border-4 shadow-sm rounded">
                <h5 class="text-start"><i class='fa-solid fa-store'></i> Rental Stalls</h5><hr>

                <?php
                    if(isset($_GET['actionrental'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['actionrental'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['actionrental'] == 'success')
                                echo '<i class="fa-solid fa-circle-check"></i>&nbsp; '.$_GET['cluster'].', Stall no. '.$_GET['stall'].' has been restored !';
                            elseif($_GET['actionrental'] == 'danger')
                                echo '<i class="fa-solid fa-trash"></i>&nbsp; '.$_GET['cluster'].', Stall no. '.$_GET['stall'].' has been permanently deleted !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div></small></center>';
                    }
                ?>        
                <?php
                    $sql = "SELECT * FROM delrental_tbl ORDER BY cluster ASC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
                <div class="table-responsive">
                <table id="myDataTable2" class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Holder name</th>
                            <th>Cluster/Section</th>
                            <th>Stall no.</th>
                            <th>Market fee</th>
                            <th>Status</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Restore</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php
                            $nn = "NONE";
                            $no = 0;
                            if($resultCheck > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>';
                                        echo '<td class="fw-bold">'.++$no.'.</td>';
                                        if($row['holder'] == ''){echo '<td class="fw-bold">'.$nn.'</td>';}
                                        else{echo '<td class="fw-bold">'.$row['holder'].'</td>';}
                                        echo '<td>'.$row['cluster'].'</td>';
                                        echo '<td>'.$row['stallno'].'</td>';
                                        echo '<td> ₱ '.$row['marketfee'].'</td>';

                                        if($row['status'] == 'Available'){
                                            echo '<td class="text-center"><p class="bg-success text-white"><small>'.$row['status'].'</small></p></td>';
                                        }elseif($row['status'] == 'Occupied'){
                                            echo '<td class="text-center"><p class="bg-warning text-white"><small>'.$row['status'].'</small></p></td>';
                                        }

                                        
                                        echo '<td class="text-center"><a href="deletedRec.php?viewdelrental='.$row['rentalid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                        echo '<td class="text-center"><a href="includes/process.inc.php?restoreRental='.$row['rentalid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-trash-arrow-up"></i></a></td>';
                                        echo '<td class="text-center"><a href="includes/process.inc.php?deletedelRental='.$row['rentalid'].'&deleterentcluster='.$row['cluster'].'&deleterentstallno='.$row['stallno'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                                    echo '</tr>';
                                }

                            }
                        ?>
                    </tbody>
                </table>
                </div><hr>
                <?php
                    if(isset($_GET['viewdelrental'])){
                        $iddd = $_GET['viewdelrental'];
                        $sql = "SELECT * FROM delrental_tbl WHERE rentalid=$iddd;";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $k = $row['cluster'];
                                $a = $row['stallno'];
                                $b = $row['marketfee'];
                                $c = $row['status'];
                            }
                        }
                        echo '<script>
                            let str = `<br>Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$k.'<br>Stall Number:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>Market Fee:&nbsp;&nbsp;&nbsp;&nbsp; ₱ '.$b.'<br>
                            Status:&nbsp;&nbsp;&nbsp;&nbsp; '.$c.'<br>`
                            Alert.render(str)
                            </script>';
                    }
                ?>
            </div>
        </div>

        <!-- This is for tenants -->
        <div class="row g-3 my-2 justify-content-around" id="delrental">
            <div class="col-md-12 g-5 my-2 py-3 bg-light borde border-4 shadow-sm rounded">
                <h5 class="text-start"><i class="fa-solid fa-users"></i> Tenants</h5><hr>

                <?php
                    if(isset($_GET['actiontenant'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['actiontenant'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['actiontenant'] == 'success')
                                echo '<i class="fa-solid fa-circle-check"></i>&nbsp; Tenant '.$_GET['dellastname'].' has been restored !';
                            elseif($_GET['actiontenant'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; Tenant '.$_GET['dellastname'].' record has been permanently deleted !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>

                <?php
                    $sql = "SELECT * FROM deltenants_tbl ORDER BY tenantlastname ASC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
                <div class="table-responsive">
                    <table id="myDataTable3" class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Phone No.</th>
                                <th>Address</th>
                                <th>Date Admitted</th>
                                <th>Cluster/Section</th>
                                <th>Stall No.</th>
                                <th>Market Fee</th>
                                <th><small>View</small></th>
                                <th><small>Restore</small></th>
                                <th><small>Delete</small></th>
                            </tr>
                        </thead>
                        <tbody class="table-secondary">
                            <?php
                                $no = 0;
                                if($resultCheck > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<tr>';
                                            echo '<td class="fw-bold">'.++$no.'.</td>';
                                            echo '<td>'.$row['tenantlastname'].', '.$row['tenantfirstname'].'</td>';
                                            echo '<td>'.$row['tenantgender'].'</td>';
                                            echo '<td>'.$row['birthdate'].'</td>';
                                            echo '<td>'.$row['phoneno'].'</td>';
                                            echo '<td>'.$row['address'].'</td>';
                                            echo '<td>'.$row['dateAdmitted'].'</td>';
                                            echo '<td>'.$row['cluster'].'</td>';
                                            echo '<td>'.$row['clusterno1'].'-'.$row['clusterno2'].'</td>';
                                            echo '<td>₱ '.$row['marketfee'].'</td>';
                                            echo '<td class="text-center"><a href="deletedRec.php?viewdeltenant='.$row['tenantid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                            echo '<td class="text-center"><a href="includes/process.inc.php?restoreTenant='.$row['tenantid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-trash-arrow-up"></i></a></td>';
                                            echo '<td class="text-center"><a href="includes/process.inc.php?deletedelTenant='.$row['tenantid'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div><hr>
                <?php
                    if(isset($_GET['viewdeltenant'])){
                        $iddd = $_GET['viewdeltenant'];
                        $sql = "SELECT * FROM deltenants_tbl WHERE tenantid=$iddd;";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $p = $row['tenantlastname'];
                                $k = $row['tenantfirstname'];
                                $a = $row['tenantmiddlename'];
                                $b = $row['tenantgender'];
                                $c = $row['birthdate'];
                                $h = $row['phoneno'];
                                $d = $row['address'];
                                $ph = $row['cluster'];
                                $cn1 = $row['clusterno1'];
                                $cn2 = $row['clusterno2'];
                                $mfee = $row['marketfee'];
                            }
                        }
                        echo '<script>
                            let str = `<br>Last Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$p.'<br>First Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$k.'<br>Middle Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>
                            Gender:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>Birthdate:&nbsp;&nbsp;&nbsp;&nbsp; '.$c.'<br>Phone No.:&nbsp;&nbsp;&nbsp;&nbsp; '.$h.'
                            <br>Address:&nbsp;&nbsp;&nbsp;&nbsp; '.$d.'<br>Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$ph.'<br>Stall No.:&nbsp;&nbsp;&nbsp;&nbsp; '.$cn1.'-'.$cn2.'
                            <br>Market Fee:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$mfee.'<br>`
                            Alert.render(str)
                            </script>';
                    }
                ?>
            </div>
        </div>

        <!-- This is for payments-->
        <div class="row g-3 my-2 justify-content-around" id="delpayment">
            <div class="col-md-12 g-5 my-2 py-3 bg-light bordddd border-4 shadow-sm rounded">
                <h5 class="text-start"><i class='fa-solid fa-cash-register'></i> Payments</h5><hr>

                <?php
                    if(isset($_GET['actiondelpay'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['actiondelpay'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['actiondelpay'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; Payment has been deleted !';
                            elseif($_GET['actiondelpay'] == 'success')
                                echo '<i class="fa-solid fa-circle-check"></i>&nbsp; '.$_GET['lname'].'\'s payment has been restored !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>
                <?php
                    
                    $sql = "SELECT * FROM delpayment_tbl ORDER BY timestamp DESC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    
                ?>
                <div class="table-responsive p-3 bg-light rounded">
                    <table id="myDataTable4" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>O.R. number</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Holder</th>
                                <th>Cluster/Section</th>
                                <th>Stall no.</th>
                                <th>Market fee</th>
                                <th>Electrcity</th>
                                <th>Water</th>
                                <th>Garbage</th>
                                <th>Other</th>
                                <th>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th><small>View</small></th>
                                <th><small>Restore</small></th>
                                <th><small>Delete</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 0;
                                if($resultCheck > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<tr>';
                                            echo '<td class="fw-bold">'.++$no.'.</td>';
                                            echo '<td>'.$row['ornumber'].'</td>';
                                            echo '<td>'.$row['paymentdate'].'</td>';
                                            echo '<td>'.$row['paymenttime'].'</td>';
                                            echo '<td>'.$row['holder'].'</td>';
                                            echo '<td>'.$row['cluster'].'</td>';
                                            echo '<td>'.$row['clusterno1'].'-'.$row['clusterno2'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['marketfee'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['electricity'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['water'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['garbage'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['other'].'</td>';
                                            echo '<td class="fw-bold">₱ '.$row['total'].'</td>';
                                            
                                            echo '<td class="text-center"><a href="deletedRec.php?viewdelpayment='.$row['paymentid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                            echo '<td class="text-center"><a href="includes/process.inc.php?restoredelPayment='.$row['paymentid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-trash-arrow-up"></i></a></td>';
                                            echo '<td class="text-center"><a href="includes/process.inc.php?deletedelPayment='.$row['paymentid'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div><hr>
                <?php
                    if(isset($_GET['viewdelpayment'])){
                        $iddd = $_GET['viewdelpayment'];
                        $sql = "SELECT * FROM delpayment_tbl WHERE paymentid=$iddd;";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $a = $row['ornumber'];
                                $b = $row['paymentdate'];
                                $c = $row['paymenttime'];
                                $d = $row['holder'];
                                $e = $row['cluster'];
                                $f = $row['clusterno1'];
                                $g = $row['clusterno2'];
                                $h = $row['marketfee'];
                                $i = $row['electricity'];
                                $j = $row['water'];
                                $k = $row['garbage'];
                                $l = $row['other'];
                                $m =  $row['total'];
                            }
                        }
                        echo '<script>
                            let str = `<br>O.R. number:&nbsp;&nbsp;&nbsp;&nbsp; '.$a.'<br>Payment Date:&nbsp;&nbsp;&nbsp;&nbsp; '.$b.'<br>Payment Time:&nbsp;&nbsp;&nbsp;&nbsp; '.$c.'<br>
                            Holder Name:&nbsp;&nbsp;&nbsp;&nbsp; '.$d.'<br>Cluster/Section:&nbsp;&nbsp;&nbsp;&nbsp; '.$e.'<br>Stall No.:&nbsp;&nbsp;&nbsp;&nbsp; '.$f.'-'.$g.'
                            <br>Market Fee:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$h.'<br>Electricity:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$i.'<br>Water:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$j.'
                            <br>Garbage:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$k.'<br>Other Fee:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$l.'<br>Total:&nbsp;&nbsp;&nbsp;&nbsp;₱ '.$m.'<br>`
                            Alert.render(str)
                            </script>';
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
    <!--Container Main end-->
<?php
    require 'footer1.php';
?>