<?php
    session_start();
    $_SESSION['actib'] = 'rental';
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
                border-top: 2px solid #005c5c;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">
        
        <h3 class="fw-bold"><i class='fa-solid fa-store'></i> Rental Stalls</h3><br>
        
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-trash"></i>&nbsp; '.$_GET['cluster'].', Stall no. '.$_GET['stall'].' has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-user-pen"></i>&nbsp; Stall record has been updated !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                    }
                ?>        
        <?php
            $sql = "SELECT * FROM rental_tbl ORDER BY cluster ASC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
            <form action="" method="post">
                    <button formaction="rentalRegi.php" type="submit" class="btn btn-dark btn-sm"><i class="fa-solid fa-circle-plus"></i><small> Add Stall</small></button>&nbsp;
                    <button type="submit" formaction="rental.php" class="btn btn-success btn-sm" ><i class="fa-solid fa-arrow-rotate-right"></i><small> Refresh</small></button>
                    <!--button type="submit" formaction="includes/process.inc.php" name="sol" class="btn btn-primary btn-sm" >solusyon</button-->
            </form><hr>
        <table id="myDataTable" class="table table-hover table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Holder name</th>
                    <th>Cluster/Section</th>
                    <th>Stall no.</th>
                    <th>Market fee</th>
                    <th>Status</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
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

                                
                                echo '<td class="text-center"><a href="rental.php?view='.$row['rentalid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="rentalRegi.php?editRental='.$row['rentalid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/process.inc.php?deleteRental='.$row['rentalid'].'&deleterentcluster='.$row['cluster'].'&deleterentstallno='.$row['stallno'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
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
                $sql = "SELECT * FROM rental_tbl WHERE rentalid=$iddd;";
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
    <!--Container Main end-->

<?php
    require 'footer1.php';
?>