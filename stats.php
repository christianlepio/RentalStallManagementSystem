<?php
    session_start();
    $_SESSION['actib'] = 'stats';
    require 'header1.php';

    $curr_month = date("m");
    $curr_year = date("Y");
    $dateYear = $curr_year.'-'.date("m");
    $_SESSION['taon'] = $curr_year;

    $curr_days = cal_days_in_month(CAL_GREGORIAN,date("m"),$curr_year);
    $expectedCollection  = 0;
    $receivedCollection = 0;
    $remaining=0;

    if(isset($_POST['searchDate'])){
        if(empty($_POST['dateYear'])){
            
        }else{
            $yearDate = explode('-',$_POST['dateYear']);

            $curr_month = $yearDate[1];
            $curr_year = $yearDate[0];
            $dateYear = $_POST['dateYear'];

            $curr_days = cal_days_in_month(CAL_GREGORIAN,$yearDate[1],$yearDate[0]);
            $expectedCollection  = 0;
            $receivedCollection = 0;
            $remaining=0;
        }
    }if(isset($_POST['searchYear'])){
        $taon = $_POST['Year'];
        $_SESSION['taon'] = $taon;
        //echo $_SESSION['taon'];
    }

    $sql = "SELECT DISTINCT(cluster) AS distinct_cluster FROM payment_tbl ORDER BY cluster ASC;";
    $result = mysqli_query($conn, $sql);
    $resCheck = mysqli_num_rows($result);

?>
    <!--Container Main start-->
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
        </style>

    <div class="bg-light mb-5 p-3 rounded">
        <h3 class="fw-bold"><i class='bx bx-bar-chart-alt-2'></i> Analytics</h3><br>
        <div class="container-fluid px-4">
                <div class="row justify-content-center bg-light bord border-4 shadow-sm rounded mb-3">
                <h4 class="text-start mt-4"><i class="fa-solid fa-file-waveform"></i> Prescribed Decisions <?php
                    date_default_timezone_set('Asia/Manila');
                    echo "<span class='fs-6'> (". date('F j, Y g:i:a').")</span>"; ?></h4><hr>
                    
                    <?php

                        $currentmonth = date("m");
                        $currentyear = date("Y");

                        $expectedCollection1 = 0;
                        $receivedCollection1 = 0;
                        $expectedCollection1month = 0;

                        for ($i=1; $i < $currentmonth; $i++) {
                            
                            $curr_dayss = cal_days_in_month(CAL_GREGORIAN,$i,$currentyear);
                            
                            # code...
                            $query = "SELECT DISTINCT(cluster) AS distinct_cluster FROM payment_tbl ORDER BY cluster ASC;";
                            $resquery = mysqli_query($conn, $query);
                            $resqueryCheck = mysqli_num_rows($resquery);
                            
                                    if($resqueryCheck>0){
                                        while($row = mysqli_fetch_assoc($resquery)){
                                            $distinct_cluster = $row['distinct_cluster'];
                                                                                
                                            $query1 = "SELECT SUM(marketfee) AS totMarketfee FROM payment_tbl 
                                            WHERE cluster='$distinct_cluster' AND MONTH(paymentdate) = '$i' AND YEAR(paymentdate) = '$currentyear';";
                                            $resquery1 = mysqli_query($conn, $query1);
                                            $resqueryCheck1 = mysqli_num_rows($resquery1);

                                            if($resqueryCheck1 > 0){
                                                while($ros = mysqli_fetch_assoc($resquery1)){
                                                    $receivedCollection1 += $ros['totMarketfee'];
                                                }
                                            }
                                        }
                                    }

                            $query = "SELECT * FROM tenants_tbl WHERE MONTH(dateAdmitted) <= '$i' AND YEAR(dateAdmitted) <= '$currentyear';";
                            $resquery = mysqli_query($conn, $query);
                            $resqueryCheck = mysqli_num_rows($resquery);
                            
                            if($resqueryCheck>0){
                                while($row = mysqli_fetch_assoc($resquery)){
                                        $expectedCollection1 += (abs($row['clusterno2'] - $row['clusterno1'])+1) * $row['marketfee'];
                                }
                            }
                            
                            $expectedCollection1 *= $curr_dayss;

                            if($receivedCollection1 != $expectedCollection1 && $receivedCollection1 < $expectedCollection1){
                                $dateObj   = DateTime::createFromFormat('!m', $i);
                                $monthName = $dateObj->format('F');

                                $dateYearStatus = $currentyear.'-'.$i;

                                echo '<div class="col-md-3 mt-2">
                                    <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h6 class="card-title">Received Collection: <span class="fw-bold">₱'.number_format($receivedCollection1,2).'</span><br>
                                            Expected Collection: <span class="fw-bold">₱'.number_format($expectedCollection1, 2).'</span>
                                            </h6><hr>
                                            <p class="card-text">Collect all the payments of your tenants to meet the expected collection in the month of <span class="fw-bold">'.$monthName.'</span>, '.$currentyear.'.</p>
                                        </div>
                                        <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="stats.php?yeardate='.$dateYearStatus.'#unpaid">View unpaid tenants</a></div>
                                    </div>
                                </div>';
                            }
                            $expectedCollection1 = 0;
                            $receivedCollection1 = 0;
                        }

                        //this month this month this month

                        $currentmonth = date("m");
                        $currentyear = date("Y");
                        $curr_dayss = cal_days_in_month(CAL_GREGORIAN,date("m"),$currentyear);

                        $expectedCollection1 = 0;
                        $receivedCollection1 = 0;
                        $expectedCollection1month = 0;


                        $query = "SELECT DISTINCT(cluster) AS distinct_cluster FROM payment_tbl ORDER BY cluster ASC;";
                        $resquery = mysqli_query($conn, $query);
                        $resqueryCheck = mysqli_num_rows($resquery);
                        
                                if($resqueryCheck>0){
                                    while($row = mysqli_fetch_assoc($resquery)){
                                        $distinct_cluster = $row['distinct_cluster'];
                                                                            
                                        $query1 = "SELECT SUM(marketfee) AS totMarketfee FROM payment_tbl 
                                        WHERE cluster='$distinct_cluster' AND MONTH(paymentdate) = '$currentmonth' AND YEAR(paymentdate) = '$currentyear';";
                                        $resquery1 = mysqli_query($conn, $query1);
                                        $resqueryCheck1 = mysqli_num_rows($resquery1);

                                        if($resqueryCheck1 > 0){
                                            while($ros = mysqli_fetch_assoc($resquery1)){
                                                $receivedCollection1 += $ros['totMarketfee'];
                                            }
                                        }
                                    }
                                }

                        $query = "SELECT * FROM tenants_tbl WHERE MONTH(dateAdmitted) <= $currentmonth AND YEAR(dateAdmitted) <= $currentyear;";
                        $resquery = mysqli_query($conn, $query);
                        $resqueryCheck = mysqli_num_rows($resquery);
                        
                        if($resqueryCheck>0){
                            while($row = mysqli_fetch_assoc($resquery)){
                                    $expectedCollection1 += (abs($row['clusterno2'] - $row['clusterno1'])+1) * $row['marketfee'];
                            }
                        }
                        
                        $expectedCollection1 *= $curr_dayss;

                        if($receivedCollection1 != $expectedCollection1 && $receivedCollection1 < $expectedCollection1){

                            $dateYearStatus = $currentyear.'-'.$currentmonth;

                            echo '<div class="col-md-3 mt-2">
                                    <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h6 class="card-title">Received Collection: <span class="fw-bold">₱'.number_format($receivedCollection1,2).'</span><br>
                                            Expected Collection: <span class="fw-bold">₱'.number_format($expectedCollection1, 2).'</span>
                                            </h6><hr>
                                            <p class="card-text">Collect all the payments of your tenants to meet the expected collection for this month of <span class="fw-bold">'.date("F").'</span>, '.$currentyear.'.</p>
                                        </div>
                                        <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="stats.php?yeardate='.$dateYearStatus.'#unpaid">View unpaid tenants</a></div>
                                    </div>
                                </div>';

                        }

                        $percent=0;

                        $query = "SELECT * FROM rental_tbl WHERE status='Occupied';";
                        $res = mysqli_query($conn, $query);
                        $resqueryCheck = mysqli_num_rows($res);
                        //echo $resqueryCheck."<br>";

                        $query = "SELECT * FROM rental_tbl;";
                        $res = mysqli_query($conn, $query);
                        $resqueryCheck1 = mysqli_num_rows($res);
                        //echo $resqueryCheck1."<br>";

                        if($resqueryCheck == 0 && $resqueryCheck1 == 0 || $resqueryCheck == 1 && $resqueryCheck1 == 0){

                        }else{
                            $percent = $resqueryCheck / $resqueryCheck1 * 100;
                        }

                        //echo $percent."<br>";
                        
                        $rentstalls = $resqueryCheck1 - $resqueryCheck;

                        if($resqueryCheck1 == 0){
                            echo '<div class="col-md-3 mt-2">
                                        <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">Rental Stalls: '.number_format($percent,2).'% occupied.</h6><hr>
                                                <p class="card-text">You have no rental stalls added yet, add more rental stalls and also more tenants to increase your expected collection for this month and in the future.</p>
                                            </div>
                                            <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="rental.php">View rental stalls</a></div>
                                        </div>
                                    </div>';
                        }elseif($percent <= 90){

                            echo '<div class="col-md-3 mt-2">
                                    <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">Rental Stalls: '.number_format($percent,2).'% occupied.</h6><hr>
                                            <p class="card-text">'.number_format($rentstalls).' rental stalls are still available, add more tenants to increase your expected collection for this month and in the future.</p>
                                        </div>
                                        <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="tenants.php">Add Tenants</a></div>
                                    </div>
                                </div>';
                        }
                        if($percent >= 90 && $percent <= 100){
                            if($percent == 100){
                                
                                echo '<div class="col-md-3 mt-2">
                                        <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">Rental Stalls: '.number_format($percent,2).'% occupied.</h6><hr>
                                                <p class="card-text">Your rental stalls are all occupied, keep in touch to all your tenants so you can maintain your monthly collection or add more rental stalls to increase your target collection every month.</p>
                                            </div>
                                            <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="rental.php">View rental stalls</a></div>
                                        </div>
                                    </div>';
                            }else{

                                echo '<div class="col-md-3 mt-2">
                                        <div class="card shadow bg-body p-2 text-dark bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">Rental Stalls: '.number_format($percent,2).'% occupied.</h6><hr>
                                                <p class="card-text">Your available rental stalls are getting low, start planning for building more rental stalls.</p>
                                            </div>
                                            <div class="card-footer border-light text-end"><a class="btn btn-sm btn-primary text-white" href="rental.php">View rental stalls</a></div>
                                        </div>
                                    </div>';
                            }
                        }

                    ?>
                    <!--div class="col-md-3 mt-2">
                        <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Warning card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div-->
                    <hr>
                </div>
                <div class="row justify-content-around p-2 bg-light bordd border-4 shadow-sm rounded">
                    <div class="col-md-5 g-5 my-2 bg-light shadow-sm rounded">
                        <br>
                        <h4 class="text-center"><i class="fa-solid fa-coins"></i> Collected Payment</h4>
                        <h6 class="text-center"><?php 
                        $dateObj   = DateTime::createFromFormat('!m', $curr_month);
                        $monthName = $dateObj->format('F');
                        echo $monthName.', '.$curr_year; ?></h6>
                        <form action="" method="post">
                            <div class="col-md-3 input-group mb-3">
                                <input type="month" class="form-control form-control-sm" name="dateYear" aria-label="Example text with button addon" aria-describedby="button-addon1" value="<?php echo $dateYear; ?>">
                                <button class="btn btn-info btn-sm text-white" name="searchDate" type="submit" id="button-addon1"><small><i class="fa-solid fa-magnifying-glass"></i> Find</small></button>
                            </div>
                        </form>

                        <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Cluster/Section</th>
                                    <th>Market</th>
                                    <th>Electricity</th>
                                    <th>Water</th>
                                    <th>Garbage</th>
                                    <th>Other</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($resCheck > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $distinct_cluster = $row['distinct_cluster'];
                                            
                                            $sql1 = "SELECT SUM(marketfee) AS totMarketfee, SUM(electricity) AS totElec, SUM(water) AS totWater, SUM(garbage) AS totGarbage, SUM(other) AS totOther, SUM(total) AS tottotal FROM payment_tbl 
                                            WHERE cluster='$distinct_cluster' AND MONTH(paymentdate) = '$curr_month' AND YEAR(paymentdate) = '$curr_year';";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $resCheck1 = mysqli_num_rows($result1);

                                            if($resCheck1 > 0){
                                                while($ros = mysqli_fetch_assoc($result1)){
                                                    echo '<tr>';
                                                        echo '<td>'.$distinct_cluster.'</td>';
                                                        echo '<td>₱'.number_format($ros['totMarketfee']).'</td>';
                                                        echo '<td>₱'.number_format($ros['totElec']).'</td>';
                                                        echo '<td>₱'.number_format($ros['totWater']).'</td>';
                                                        echo '<td>₱'.number_format($ros['totGarbage']).'</td>';
                                                        echo '<td>₱'.number_format($ros['totOther']).'</td>';
                                                        echo '<td>₱'.number_format($ros['tottotal']).'</td>';
                                                    echo '</tr>';
                                                    $receivedCollection += $ros['tottotal'];
                                                }
                                            }

                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>
                        <?php
                            $sql = "SELECT * FROM tenants_tbl WHERE MONTH(dateAdmitted) <= $curr_month AND YEAR(dateAdmitted) <= $curr_year;";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                            if($resultCheck>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $expectedCollection += (abs($row['clusterno2'] - $row['clusterno1'])+1) * $row['marketfee'];
                                }
                            }
                            $expectedCollection *= $curr_days;
                            $remaining = $expectedCollection - $receivedCollection;
                            $remaining = number_format($remaining, 2);
                            $expectedCollection = number_format($expectedCollection, 2);
                            $receivedCollection = number_format($receivedCollection, 2);
                            
                        ?>
                        <small><p class="fw-bold">Expected Collection: <span class="bg-primary text-white rounded">&nbsp;&nbsp; <?php echo '₱ '.$expectedCollection;?> &nbsp;&nbsp;</span> </p></small>
                        <small><p class="fw-bold">Received Collection: <span class="bg-warning text-black rounded">&nbsp;&nbsp; <?php echo '₱ '.$receivedCollection;?> &nbsp;&nbsp;</span> </p></small>
                        <small><p class="fw-bold">Remaining: <span class="bg-danger text-white rounded">&nbsp;&nbsp; <?php echo '₱ '.$remaining;?> &nbsp;&nbsp;</span> </p></small>
                        <hr>
                    </div>
                    <div class="col-md-6 g-5 my-2 bg-light shadow-sm rounded">
                        <br><h4 class="text-center"><i class="fa-solid fa-coins"></i> Monthly Collection</h4>
                        <hr>
                        <form action="" method="post">
                            <div class="col-md-3 input-group mb-3">
                                <input type="number" class="form-control form-control-sm" name="Year" aria-label="Example text with button addon" aria-describedby="button-addon1" min="1900" max="<?php echo $curr_year; ?>" Placeholder="Enter year here..." value="<?php echo $taon; ?>">
                                <button class="btn btn-info btn-sm text-white" name="searchYear" type="submit" id="button-addon1"><small><i class="fa-solid fa-magnifying-glass"></i> Find</small></button>
                            </div>
                        </form>
                    
                        <div class="card">
                            <div class="class-card">
                                <canvas id="statsChart"></canvas>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <hr>
                </div>
                <div class="row g-3 my-2 justify-content-around">
                    <div class="col-md-12 g-5 my-2 py-3 bg-light borddd border-4 shadow-sm rounded"><br>
                    <h4 class="text-start"><i class="fa-regular fa-clipboard"></i> Summary of Yearly Collection</h4><hr>
                        <?php
                            $jan = 0;
                            $feb = 0;
                            $mar = 0;
                            $apr = 0;
                            $may = 0;
                            $jun = 0;
                            $jul = 0;
                            $aug = 0;
                            $sept = 0;
                            $oct = 0;
                            $nov = 0;
                            $dec = 0;
                            $totalEarnings = 0; 


                            $query = "SELECT DISTINCT(YEAR(paymentdate)) as years FROM payment_tbl;";
                            $resquery = mysqli_query($conn, $query);
                            $resqueryCheck = mysqli_num_rows($resquery);

                            if($resqueryCheck > 0){
                                while($row = mysqli_fetch_assoc($resquery)){
                                    $years = $row['years'];
                                    $query1 = "SELECT DISTINCT(MONTH(paymentdate)) as months FROM payment_tbl WHERE YEAR(paymentdate) = $years ORDER BY MONTH(paymentdate) ASC";
                                    $resquery1 = mysqli_query($conn, $query1);
                                    $resqueryCheck1 =  mysqli_num_rows($resquery1);

                                    if($resqueryCheck1 > 0){
                                        while($row1 = mysqli_fetch_assoc($resquery1)){
                                            $months = $row1['months'];

                                            $sql2 = "SELECT SUM(total) as tototal FROM payment_tbl WHERE YEAR(paymentdate) = $years AND MONTH(paymentdate) = $months ORDER BY MONTH(paymentdate) ASC";
                                            $result2 = mysqli_query($conn, $sql2);
                                            $resCheck2 = mysqli_num_rows($result2);

                                            if($resCheck2 > 0){
                                                
                                                while($row2 = mysqli_fetch_assoc($result2)){
                                                        if($months == 1){
                                                            $jan = $row2['tototal'];
                                                        }elseif($months == 2){
                                                            $feb = $row2['tototal'];
                                                        }elseif($months == 3){
                                                            $mar = $row2['tototal'];
                                                        }elseif($months == 4){
                                                            $apr = $row2['tototal'];
                                                        }elseif($months == 5){
                                                            $may = $row2['tototal'];
                                                        }elseif($months == 6){
                                                            $jun = $row2['tototal'];
                                                        }elseif($months == 7){
                                                            $jul = $row2['tototal'];
                                                        }elseif($months == 8){
                                                            $aug = $row2['tototal'];
                                                        }elseif($months == 9){
                                                            $sept = $row2['tototal'];
                                                        }elseif($months == 10){
                                                            $oct = $row2['tototal'];
                                                        }elseif($months == 11){
                                                            $nov = $row2['tototal'];
                                                        }elseif($months == 12){
                                                            $dec = $row2['tototal'];
                                                        }
                                                        $totalEarnings += $row2['tototal'];
                                                }
                                            }
                                        }
                                    }
                                    $query2 = "SELECT reportyear FROM collectionreport_tbl WHERE reportyear = $years";
                                    $resquery2 = mysqli_query($conn, $query2);
                                    $resqueryCheck2 = mysqli_num_rows($resquery2);

                                    if($resqueryCheck2 > 0){
                                        $sikwel = "UPDATE collectionreport_tbl SET jan = $jan, feb = $feb, mar = $mar, apr = $apr, may = $may, jun = $jun, jul = $jul, aug = $aug, sept = $sept, oct = $oct, nov = $nov, dece = $dec, total = $totalEarnings
                                        WHERE reportyear = $years;";
                                        $ressikwel =  mysqli_query($conn, $sikwel);
                                    }else{
                                        $sikwel1 = "INSERT INTO collectionreport_tbl (reportyear, jan, feb, mar, apr, may, jun, jul, aug, sept, oct, nov, dece, total) 
                                        VALUES('$years', '$jan', '$feb', '$mar', '$apr', '$may', '$jun', '$jul', '$aug', '$sept', '$oct', '$nov', '$dec', $totalEarnings);";
                                        $ressikwel1 = mysqli_query($conn, $sikwel1);
                                        echo mysqli_error($conn);
                                    }
                                    $totalEarnings = 0;
                                }
                            }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Year</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sept</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql = "SELECT * FROM collectionreport_tbl ORDER BY reportyear DESC;";
                                    $res = mysqli_query($conn, $sql);
                                    $resCheck = mysqli_num_rows($res);

                                    if($resCheck > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            echo '<tr>';
                                                echo '<td>'.$row['reportyear'].'</td>';
                                                echo '<td>₱'.number_format($row['jan']).'</td>';
                                                echo '<td>₱'.number_format($row['feb'],2).'</td>';
                                                echo '<td>₱'.number_format($row['mar'],2).'</td>';
                                                echo '<td>₱'.number_format($row['apr'],2).'</td>';
                                                echo '<td>₱'.number_format($row['may'],2).'</td>';
                                                echo '<td>₱'.number_format($row['jun'],2).'</td>';
                                                echo '<td>₱'.number_format($row['jul'],2).'</td>';
                                                echo '<td>₱'.number_format($row['aug'],2).'</td>';
                                                echo '<td>₱'.number_format($row['sept'],2).'</td>';
                                                echo '<td>₱'.number_format($row['oct'],2).'</td>';
                                                echo '<td>₱'.number_format($row['nov'],2).'</td>';
                                                echo '<td>₱'.number_format($row['dece'],2).'</td>';
                                                echo '<td>₱'.number_format($row['total'],2).'</td>';
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                                </tbody>
                            </table><hr>
                        </div>
                    </div>    
                </div>
                <div class="row g-3 my-2 justify-content-around" id="unpaid">
                    <div class="col-md-12 g-5 my-2 py-3 bg-light bordddd border-4 shadow-sm rounded"><br>
                        <?php
                            $currentmonth1 = date("m");
                            $currentyear1 = date("Y");
                            $curr_dayss1 = cal_days_in_month(CAL_GREGORIAN,date("m"),$currentyear1);
                            $dateYearStatus = $currentyear1.'-'.date("m");

                            $expectedCollection2 = 0;
                            $paidAmount = 0;

                        
                            if(isset($_POST['searchDateStatus'])){
                                if(empty($_POST['dateYearStatus'])){
                                    
                                }else{
                                    $yearDate = explode('-',$_POST['dateYearStatus']);
                        
                                    $currentmonth1 = $yearDate[1];
                                    $currentyear1 = $yearDate[0];
                                    $dateYearStatus = $_POST['dateYearStatus'];
                        
                                    $curr_dayss1 = cal_days_in_month(CAL_GREGORIAN,$yearDate[1],$yearDate[0]);
                                    $expectedCollection2 = 0;
                                    $paidAmount = 0;
                                }
                            }elseif(isset($_GET['yeardate'])){
                                $yearDate = explode('-',$_GET['yeardate']);
                    
                                $currentmonth1 = $yearDate[1];
                                $currentyear1 = $yearDate[0];
                                $dateYearStatus = $_GET['yeardate'];

                                $curr_dayss1 = cal_days_in_month(CAL_GREGORIAN,$yearDate[1],$yearDate[0]);
                                $expectedCollection2 = 0;
                                $paidAmount = 0;
                            }
                        ?>
                    <h4 class="text-start"><i class='fa-solid fa-cash-register'></i> Payment Status <span class="fs-6">(<?php $dateObj   = DateTime::createFromFormat('!m', $currentmonth1);
                        $monthName = $dateObj->format('F'); echo $monthName.', '.$currentyear1; ?>)</span></h4><hr>

                    <form action="stats.php#unpaid" method="post">
                        <div class="col-md-3 input-group mb-3">
                            <input type="month" class="form-control form-control-sm" name="dateYearStatus" aria-label="Example text with button addon" aria-describedby="button-addon1" value="<?php echo $dateYearStatus; ?>">
                            <button class="btn btn-info btn-sm text-white" name="searchDateStatus" type="submit" id="button-addon1"><small><i class="fa-solid fa-magnifying-glass"></i> Find</small></button>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-hover table-striped table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Tenant name</th>
                                    <th>Cluster/Section</th>
                                    <th>Stall no.</th>
                                    <th>Rental fee</th>
                                    <th>Paid Amount</th>
                                    <th>Unpaid Amount</th>
                                    <th>Status</th>
                                    <th class="text-center"><small>Action</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    $query = "SELECT * FROM tenants_tbl WHERE MONTH(dateAdmitted) <= $currentmonth1 AND YEAR(dateAdmitted) <= $currentyear1 ORDER BY cluster, tenantlastname;";
                                    $resquery = mysqli_query($conn, $query);
                                    $resqueryCheck = mysqli_num_rows($resquery);
                                    echo mysqli_error($conn);

                                    if($resqueryCheck > 0){
                                        while($row = mysqli_fetch_assoc($resquery)){
                                            $tenantid = $row['tenantid'];
                                            echo '<tr>';
                                                echo '<td>'.++$no.'</td>';
                                                echo '<td>'.$row['tenantlastname'].', '.$row['tenantfirstname'].'</td>';
                                                echo '<td>'.$row['cluster'].'</td>';
                                                echo '<td>'.$row['clusterno1'].'-'.$row['clusterno2'].'</td>';
                                                $expectedCollection2 = (abs($row['clusterno2'] - $row['clusterno1'])+1) * $row['marketfee'];
                                                $expectedCollection2 *= $curr_dayss1;
                                                echo '<td>₱'.number_format($expectedCollection2,2).'</td>';
                                                    
                                                    $query1 = "SELECT SUM(marketfee) AS totMarketfee FROM payment_tbl 
                                                    WHERE tenantid = '$tenantid' AND MONTH(paymentdate) = '$currentmonth1' AND YEAR(paymentdate) = '$currentyear1';";
                                                    $resquery1 = mysqli_query($conn, $query1);
                                                    $resqueryCheck1 = mysqli_num_rows($resquery1);

                                                    if($resqueryCheck1 > 0){
                                                        while($row1 = mysqli_fetch_assoc($resquery1)){
                                                            $paidAmount = $row1['totMarketfee'];
                                                        }
                                                    }
                                                echo '<td>₱';
                                                    if($paidAmount==''){
                                                        $paidAmount = 0;
                                                    }
                                                    echo number_format($paidAmount,2);
                                                echo '</td>';
                                                $bal = $expectedCollection2 - $paidAmount;
                                                echo '<td>₱'.number_format($bal,2).'</td>';
                                                echo '<td class="fw-bold">';
                                                    if($paidAmount == 0){
                                                        echo '<small><span class="bg-danger text-white rounded"> &nbsp; Unpaid &nbsp; </span></small>';
                                                    }elseif($paidAmount < $expectedCollection2){
                                                        echo '<small><span class="bg-danger text-white rounded"> &nbsp; Underpaid &nbsp; </span></small>';
                                                    }elseif($paidAmount == $expectedCollection2){
                                                        echo '<small><span class="bg-success text-white rounded"> &nbsp; Paid &nbsp; </span></small>';
                                                    }
                                                echo '</td>';

                                                if($paidAmount == $expectedCollection2){
                                                    echo '<td class="text-center"><button type="button" class="btn btn-primary btn-sm" disabled><small>Add-payment</small></button></td>';    
                                                }else{
                                                    echo '<td class="text-center"><a href="paymentForm.php?addPay='.$row['tenantid'].'" class="btn btn-primary btn-sm"><small>Add-payment</small></a></td>';   
                                                }
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table><hr>
                    </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    <!--Container Main end-->   
<?php
    require 'footer1.php';
?>