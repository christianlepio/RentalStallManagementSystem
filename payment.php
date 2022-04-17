<?php
    session_start();
    $_SESSION['actib'] = 'payment';
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
                border-top: 2px solid #ff00ff;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">

        <h3 class="fw-bold"><i class='fa-solid fa-cash-register'></i> Payments</h3><br>
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; '.$_GET['lname'].'\'s payment has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-user-pen"></i>&nbsp; Payment record of '.$_GET['lname'].' has been updated !';
                            elseif($_GET['action'] == 'success')
                                echo '<i class="bi bi-check-circle-fill"></i>&nbsp; Payment for '.$_GET['lname'].' has been added !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>        
        <?php
            
            $sql = "SELECT * FROM payment_tbl ORDER BY timestamp DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
            <form action="" method="post">
                    <button formaction="tenants.php" type="submit" class="btn btn-dark btn-sm"><i class='fa-solid fa-cash-register'></i>&nbsp;Add payment</button>&nbsp;
                    <button type="submit" formaction="payment.php" class="btn btn-success btn-sm" ><i class="fa-solid fa-arrow-rotate-right"></i><small> Refresh</small></button>
            </form><hr>
        <table id="myDataTable" class="table table-bordered table-hover table-striped table-sm">
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
                                
                                echo '<td class="text-center"><a href="payment.php?view='.$row['paymentid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="paymentForm.php?editPayment='.$row['paymentid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/process.inc.php?deletePayment='.$row['paymentid'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
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
                $sql = "SELECT * FROM payment_tbl WHERE paymentid=$iddd;";
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
    <!--Container Main end-->
<?php
    require 'footer1.php';
?>