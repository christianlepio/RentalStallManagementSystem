<?php
    session_start();
    $_SESSION['actib'] = 'active';
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
                border-top: 2px solid #aa8cfa;
            }
        </style>

    <div class="bg-light mb-5 p-3 rounded">
        
            <h3 class="fw-bold"><i class="fa-solid fa-user"></i> Users</h3><br>
        
                <?php
                    if(isset($_GET['action'])){
                        echo '<center><small><div class="text-start alert alert-'.$_GET['action'].' alert-dismissible fade show" role="alert">
                            <strong>';
                            if($_GET['action'] == 'danger')
                                echo '<i class="fa-solid fa-user-xmark"></i>&nbsp; '.$_GET['usertyp'].' '.$_GET['userlname'].' has been deleted !';
                            elseif($_GET['action'] == 'warning')
                                echo '<i class="fa-solid fa-user-pen"></i>&nbsp; User record has been updated !';
                        echo '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></small></center>';
                        
                    }
                ?>
        <?php
                $sql = "SELECT * FROM users_tbl ORDER BY lastname ASC;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
            <form action="" method="post">
                <button formaction="signup.php" type="submit" class="btn btn-dark btn-sm"><i class="fa-solid fa-user-plus"></i><small> Add User</small></button>&nbsp;
                <button type="submit" formaction="user.php" class="btn btn-success btn-sm" ><i class="fa-solid fa-arrow-rotate-right"></i> <small>Refresh</small></button>
            </form><hr>
        <table id="myDataTable" class="table table-striped table-hover table-bordered table-sm">
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
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
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
                                echo '<td class="text-center"><a href="user.php?view='.$row['userid'].'" class="btn btn-primary btn-sm rounded"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td class="text-center"><a href="signup.php?editUser='.$row['userid'].'" class="btn btn-warning btn-sm rounded"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                echo '<td class="text-center"><a href="includes/process.inc.php?deleteUser='.$row['userid'].'&deletelname='.strtoupper($row['lastname']).'&deleteusrtyp='.ucfirst($row['usertype']).'" class="btn btn-danger btn-sm rounded"><i class="fa-solid fa-trash"></i></a></td>';
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
                $sql = "SELECT * FROM users_tbl WHERE userid=$iddd;";
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
    <!--Container Main end-->   
<?php
    require 'footer1.php';
?>