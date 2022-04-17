<?php
    session_start();
    $_SESSION['actib'] = 'inquiry';
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
                border-top: 2px solid #c33a08;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">
        
            <h3 class="fw-bold"><i class='bx bx-message-square-detail'></i> Inquiries</h3><br>
        
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-trash"></i>&nbsp; Inquiry of Mr./Ms. '.$_GET['lastname'].' has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-user-pen"></i>&nbsp; Stall record has been updated !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                    }
                ?>
        
        <?php
            $sql = "SELECT * FROM inquiry_tbl ORDER BY inq_date DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
        <table id="myDataTable" class="table table-hover table-striped table-bordered table-sm">
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

                                echo '<td class="text-center"><a href="inquiry.php?view='.$row['Inq_id'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/process.inc.php?deleteInquiry='.$row['Inq_id'].'&deleteinqname='.$row['lastname'].'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
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

                $query = "UPDATE inquiry_tbl SET status='read' WHERE Inq_id=$iddd;";
                $resquery = mysqli_query($conn, $query);

                if($resquery){
                    $sql = "SELECT * FROM inquiry_tbl WHERE Inq_id=$iddd;";
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
            }
        ?>
        </div>
    </div>
    <!--Container Main end-->

<?php
    require 'footer1.php';
?>