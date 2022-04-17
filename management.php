<?php
    session_start();
    $_SESSION['actib'] = 'mngmnt';
    require 'header1.php';

    $collection=0;
    $tenants=0;
    $inquiry=0;
    $user=0;
    $curr_month = date("F");
    $curr_year = date("Y");

    $sql = "SELECT COUNT(tenantid) AS tot FROM tenants_tbl;";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $tenants = $row['tot'];
        }
    }
    $sql = "SELECT COUNT(userid) AS tot FROM users_tbl;";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $user = $row['tot'];
        }
    }
    $sql = "SELECT SUM(total) AS totalCollection FROM payment_tbl WHERE MONTHNAME(paymentdate) = '$curr_month' AND YEAR(paymentdate) = '$curr_year';";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $collection = $row['totalCollection'];
        }
    }
    $sql = "SELECT COUNT(Inq_id) AS tot FROM inquiry_tbl WHERE status='unread';";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $inquiry = $row['tot'];
        }
    }
?>
    <!--Container Main start-->
    <div class="height-100 bg-light main-content">
        <style>
            .bord{
                border-top: 2px solid #04204e;
            }
            .bordd{
                border-top: 2px solid red;
            }
            .borddd{
                border-top: 2px solid #f0c53f;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">
        
        <h3 class="fw-bold mb-2"><i class='bx bx-grid-alt'></i> Dashboard</h3><br>
        
        <div class="p-2 mb-2 bg-light bord border-4 shadow-sm rounded">
                <div class="row g-3 my-2 justify-content-center bg-light rounded">
                    <div class="col-md-3">
                        <div class="p-3 bg-primary shadow-sm p-3 mb-3 d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-white">Collection</p>
                                <h3 class="fs-3 text-white"><i class="fa-solid fa-peso-sign"></i><?php echo number_format($collection, 2); ?></h3>
                                <p class="fs-6 text-white"><?php echo date("F \,  Y") ?></p>
                            </div>
                            
                            <i class="fa-solid fa-coins fs-1 primary-text border rounded-full bg-light p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-warning shadow-sm p-3 mb-3 d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-white">Tenants</p>
                                <h3 class="fs-2 text-white"><?php echo $tenants; ?></h3>
                                <p class="fs-6 text-white">---</p>
                            </div>
                            
                            <i class="fa-solid fa-users fs-1 primary-text border rounded-full bg-light p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-success shadow-sm p-3 mb-3 d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-white">Inquiries</p>
                                <h3 class="fs-2 text-white"><?php echo $inquiry; ?></h3>
                                <p class="fs-6 text-white">---</p>
                            </div>
                            
                            <i class="bx bx-message-square-detail fs-1 primary-text border rounded-full bg-light p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-danger shadow-sm p-3 mb-3 d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5 text-white">Users</p>
                                <h3 class="fs-2 text-white"><?php echo $user; ?></h3>
                                <p class="fs-6 text-white">---</p>
                            </div>
                            <i class="fa-solid fa-user-group fs-1 primary-text border rounded-full bg-light p-3"></i>
                        </div>
                    </div>
                </div>
</div>
<div class="px-4 p-2 bg-light rounded">
                <div class="row justify-content-around rounded">
                    <div class="col-md-7 g-5 my-2 bg-light bordd border-4 shadow-sm rounded">
                    <h4 class="my-3 fw-bold"><i class='fa-solid fa-store'></i> Available Stalls</h4>
                    <hr class="dropdown-divider"></li>
                        <div class="card px-5 my-2">
                            <div class="class-card">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 g-5 my-2 rounded">
                        
                        <div class="table-responsive px-3 my-3 bg-light borddd border-4 shadow-sm rounded">
                        <h4 class="my-3 fw-bold"><i class='fa-solid fa-store'></i> Cluster/Section</h4>
                        <hr class="dropdown-divider"></li>
                            <table id="myDataTable" class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Cluster/Section</th>
                                        <th>Available Stalls</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        $sikwel = "SELECT DISTINCT(cluster) AS cluster_distinct FROM rental_tbl ORDER BY cluster ASC;";
                                        $results = mysqli_query($conn, $sikwel);
                                        $resultsCheck = mysqli_num_rows($results);

                                        if($resultsCheck > 0){
                                            while($rows = mysqli_fetch_assoc($results)){
                                                
                                                $distinctCluster = $rows['cluster_distinct'];
                                                
                                                $sikwel1 = "SELECT COUNT(cluster) AS countCluster FROM rental_tbl WHERE cluster='$distinctCluster' AND status='Available';";
                                                $results1 = mysqli_query($conn, $sikwel1);
                                                $resultsCheck1 = mysqli_num_rows($results1);

                                                if($resultsCheck1 > 0){
                                                    while($rows1 = mysqli_fetch_assoc($results1)){
                                                        echo '<tr>';
                                                            echo '<td class="fw-bold">'.++$no.'.</td>';
                                                            echo '<td>'.$distinctCluster.'</td>';
                                                            echo '<td>'.$rows1['countCluster'].'</td>';
                                                        echo '</tr>';                    
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div><br><br>

    </div>
    </div>
    <!--Container Main end-->   
<?php
    require 'footer1.php';
?>