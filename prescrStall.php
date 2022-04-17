<?php
    require 'indexHeader.php';
    require 'includes/dbh.inc.php';

    $ilname = "";
    $ifname = "";
    $igender = "";
    $icontact = "";
    $iadress = "";
    $iclustername = "";
    $iprodname = "";

    if(isset($_POST['submit-inquiry'])){
        $ilname = $_POST['ilname'];
        $ifname = $_POST['ifname'];
        $igender = $_POST['igender'];
        $icontact = $_POST['icontact'];
        $iadress = $_POST['iadress'];
        $iclustername = $_POST['iclustername'];
        $iprodname = strtoupper($_POST['iprodname']);

        $sql = "SELECT * FROM rental_tbl WHERE cluster='$iclustername' AND status='Available' ORDER BY stallno ASC;";
        $result = mysqli_query($conn, $sql);
        $resCheck = mysqli_num_rows($result);

        if($resCheck == 0){
            header("Location: index.php?error=norental&cluster=".$iclustername."#inquire");
            exit();
        }
    }
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <header>
        
            <nav class="navbar fixed-top navbar-expand-custom navbar-mainbg">
                <a class="navbar-brand navbar-logo" href="#">
                    <img src="img/MCPMS.png" alt="public market logo" height="30" weight="30">&nbsp;
                    Muntinlupa City Public Market
                </a>
                <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#home"><i class="fa-solid fa-house"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#about"><i class="fa-solid fa-circle-info"></i>About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#contact"><i class="far fa-address-book"></i>Contact</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php#inquire"><i class="fa-solid fa-circle-question"></i>Inquire Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        
    </header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <main>
        <section class="home">
            <div class="row justify-content-center">
                <div class="col-md-6 p-2 bg-light border rounded "><hr>
                <h2 style="color:black;" data-aos="fade-down"><i class="fa-solid fa-file-waveform"></i> Prescribed Rental Stalls for you.</h2><hr>
                    <center>
                        <img src="img/palengke1.jpg" alt="Card image cap" class="rounded" data-aos="flip-down">
                    </center>
                    <hr>
                    <div class="card-body" data-aos="zoom-in">
                        <div class="table-responsive p-3 bg-light mb-3 bord border-4 shadow-sm rounded">
                        <h5 class="card-title" style="color:black;">Product name: <?php echo $iprodname; ?> ( <?php echo $iclustername; ?> )</h5><hr>
                        <table id="tblg" class="table table-striped table-hover">
                            <thead>
                                <th>Cluster/Section</th>
                                <th>Stall no.</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM rental_tbl WHERE cluster='$iclustername' AND status='Available' ORDER BY stallno ASC;";
                                    $result = mysqli_query($conn, $sql);
                                    $resCheck = mysqli_num_rows($result);

                                    if($resCheck > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                                echo '<td>'.$row['cluster'].'</td>';
                                                echo '<td>'.$row['stallno'].'</td>';
                                                echo '<td><p class="bg-success rounded text-white text-center"><small>'.$row['status'].'</small></p></td>';
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <div class="bg-light p-2 border rounded"><hr>
                        <form action="" method="post">
                            <input type="hidden" name="ilname" class="form-control" id="" placeholder="Last name..." value="<?php echo $ilname;?>">
                            <input type="hidden" name="ifname" class="form-control" id="" placeholder="First name..." value="<?php echo $ifname;?>">
                            <input type="hidden" name="igender" class="form-control" id="" placeholder="Gender..." value="<?php echo $igender;?>">
                            <input type="hidden" name="icontact" class="form-control" id="" placeholder="Contact no..." pattern="[0-9]{11}" value="<?php echo $icontact;?>">
                            <input type="hidden" name="iadress" class="form-control" id="" value="<?php echo $iadress;?>">
                            <input type="hidden" name="iclustername" class="form-control" id="" placeholder="Cluster/Section..." value="<?php echo $iclustername;?>">
                            <input type="hidden" name="iprodname" class="form-control" id="" placeholder="Product name..." value="<?php echo $iprodname;?>">

                            <label for="exampleFormControlTextarea1"><small>Any Concern?</small></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="iconcern" rows="3"></textarea>
                            <div class="row justify-content-center">
                                <div class="col-4 mt-2 p-2">
                                    <center>
                                        <button type="submit" name="submit-inq" class="btn btn-primary btinquire">Submit Inquiry</button>
                                    </center>
                                </div>
                            </div><hr>
                        </form>
                        <div class="bg-secondary p-3 rounded">
                            <div class="row justify-content-center" data-aos="fade-down">
                                <h5 class="text-center text-white">Contact</h5>
                            </div>
                            <div class="row justify-content-center" data-aos="zoom-in">
                                <img class="log" src="img/MCPMS.png" alt="">
                            </div><br>
                            <div class="row justify-content-center" data-aos="fade-up">
                                <h6 class="text-center text-white">Officer-in-Charge: Mr. Randy Garcia</h6><br>
                            </div>
                            <div class="row justify-content-center" data-aos="fade-up">
                                <p class="text-center"><small>Montillano St., Barangay Alabang, Muntinlupa City</small></p>
                            </div>
                            <div class="row justify-content-center" data-aos="fade-up">
                                <p class="text-center"><strong><i class="fa-solid fa-phone"></i> 0919 079 2097</strong></p>
                            </div>
                        </div><hr>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .home{
            color:black;
        }
        .home img{
            width: 60vmin;
            height: 30vmin;
        }
        .home .log{
            width: 13vmin;
            height: 10vmin;
        }
        .bord{
            border-top: 2px solid red;
        }
    </style>


<?php
    if(isset($_POST['submit-inq'])){
        $ilname = $_POST['ilname'];
        $ifname = $_POST['ifname'];
        $igender = $_POST['igender'];
        $icontact = $_POST['icontact'];
        $iadress = $_POST['iadress'];
        $iclustername = $_POST['iclustername'];
        $iprodname = strtoupper($_POST['iprodname']);
        $iconcern =  $_POST['iconcern'];
        $status = "unread";

        $sql = "INSERT INTO inquiry_tbl (status, lastname, firstname, gender, contact, address, cluster, productname, concern) 
        VALUES('$status', '$ilname', '$ifname', '$igender', '$icontact', '$iadress', '$iclustername', '$iprodname', '$iconcern');";
        $result = mysqli_query($conn, $sql);
        echo mysqli_error($conn);
        if($result){
            echo '<script>window.location.href="index.php?error=none#inquire";</script>';    
        }
    }
    require 'indexFooter.php';
?>