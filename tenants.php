<?php
    session_start();
    $_SESSION['actib'] = 'tenants';
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
                border-top: 2px solid #f0c53f;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">

        <h3 class="fw-bold"><i class="fa-solid fa-users"></i> Tenants</h3><br>
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; Tenant '.$_GET['dellastname'].' has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-user-pen"></i>&nbsp; Tenant '.$_GET['lname'].' record has been updated !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>
        <?php
            $sql = "SELECT * FROM tenants_tbl ORDER BY tenantlastname ASC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
            <form action="" method="post">
                <button formaction="tenantRegi.php" type="submit" class="btn btn-dark btn-sm"><i class="fa-solid fa-user-plus"></i><small> Add Tenant</small></button>&nbsp;
                <button type="submit" formaction="tenants.php" class="btn btn-success btn-sm" ><i class="fa-solid fa-arrow-rotate-right"></i><small> Refresh</small></button>
            </form><hr>
        <table id="myDataTable" class="table table-hover table-bordered table-striped table-sm">
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
                    <th><small>Add-Payment</th>
                    <th><small>View</small></th>
                    <th><small>Edit</small></th>
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
                                echo '<td>'.$row['tenantlastname'].', '.$row['tenantfirstname'].'</td>';
                                echo '<td>'.$row['tenantgender'].'</td>';
                                echo '<td>'.$row['birthdate'].'</td>';
                                echo '<td>'.$row['phoneno'].'</td>';
                                echo '<td>'.$row['address'].'</td>';
                                echo '<td>'.$row['dateAdmitted'].'</td>';
                                echo '<td>'.$row['cluster'].'</td>';
                                echo '<td>'.$row['clusterno1'].'-'.$row['clusterno2'].'</td>';
                                echo '<td>₱ '.$row['marketfee'].'</td>';
                                echo '<td class="text-center"><a href="paymentForm.php?addPay='.$row['tenantid'].'" class="btn btn-info btn-sm rounded text-white"><i class="bi bi-credit-card"></i></a></td>';
                                echo '<td class="text-center"><a href="tenants.php?view='.$row['tenantid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="tenantRegi.php?editTenant='.$row['tenantid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/process.inc.php?deleteTenant='.$row['tenantid'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>
        <?php
            if(isset($_GET['view'])){
                $iddd = $_GET['view'];
                $sql = "SELECT * FROM tenants_tbl WHERE tenantid=$iddd;";
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
    <!--Container Main end-->
<?php
    require 'footer1.php';
?>