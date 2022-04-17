<?php
    //session_start();
    if(!isset($_SESSION['usrId'])){
        header("Location: index.php");
        exit();
    }
    if(!isset($_SESSION['usrId'])){
        header("Location: login.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
    <!--This is for pagination-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.bootstrap5.min.css">
    <!--End of pagination-->

    <link rel="stylesheet" href="alert.css">
    <script src="alertjs.js"></script>
    <link rel="stylesheet" href="hstyle.css">
    <link rel="stylesheet" href="styles.css" />
</head>
<body id="body-pd">
    <?php
        require 'includes/process.inc.php';
    ?>
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img">
             <img src="img/MCPMS.png" alt="" width="42" height="42">
        </div>
    </header>
    <div class="l-navbar border-end border-info" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="cpass.php" class="nav_logo <?php if($_SESSION['actib'] == 'cpass'){echo 'active';}?>">
                    <img src="imgFolder/<?php echo $_SESSION['image'];?>" alt="" width="28" height="28" style="border-radius:50%">
                    <span class="nav_logo-name">Account</span> 
                </a>
                <div class="nav_list">
                    <a href="management.php" class="nav_link <?php if($_SESSION['actib'] == 'mngmnt'){echo 'active';}?>">
                        <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                    </a>
                    
                    <a href="feedback.php" class="nav_link <?php if($_SESSION['actib'] == 'feedback'){echo 'active';}?>">
                        <i class='fa-solid fa-comments nav_icon'></i> 
                        <span class="nav_name">Feedback</span> 
                    </a>

                    <?php
                        if($_SESSION['ustype'] == 'Admin'){
                            echo '<a href="user.php" class="nav_link '.$_SESSION['actib'].'"> 
                                    <i class="fas fa-user nav_icon"></i> 
                                        <span class="nav_name">Users</span> 
                                </a> ';
                        }
                    ?>
                    
                    <a href="inquiry.php" class="nav_link <?php if($_SESSION['actib'] == 'inquiry'){echo 'active';}?>"> 
                        <?php 
                            $inquiry = 0;
                            $sql = "SELECT COUNT(Inq_id) AS tot FROM inquiry_tbl WHERE status='unread';";
                            $result = mysqli_query($conn, $sql);
                            $check = mysqli_num_rows($result);
                            if($check > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $inquiry = $row['tot'];
                                }
                            }
                        ?>
                        <i class='bx bx-message-square-detail nav_icon <?php if($inquiry > 0){echo 'position-relative';}?>'>
                            <?php
                                if($inquiry > 0){
                                    echo  '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.
                                    $inquiry
                                            .'<span class="visually-hidden">unread messages</span>
                                        </span>';
                                }
                            ?>
                        </i> 
                        <span class="nav_name">Inquiries</span> 
                    </a> 
                    <a href="rental.php" class="nav_link <?php if($_SESSION['actib'] == 'rental'){echo 'active';}?>">
                        <i class='fa-solid fa-store nav_icon'></i> 
                        <span class="nav_name">Rental Stall</span> 
                    </a> 
                    <a href="tenants.php" class="nav_link <?php if($_SESSION['actib'] == 'tenants'){echo 'active';}?>"> 
                        <i class="fa-solid fa-users"></i> 
                        <span class="nav_name">Tenants</span> 
                    </a> 
                    <a href="payment.php" class="nav_link <?php if($_SESSION['actib'] == 'payment'){echo 'active';}?>">
                        <i class='fa-solid fa-cash-register nav_icon'></i> 
                        <span class="nav_name">Payment</span> 
                    </a> 
                    <a href="stats.php" class="nav_link <?php if($_SESSION['actib'] == 'stats'){echo 'active';}?>"> 
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                        <span class="nav_name">Analytics</span> 
                    </a>
                    <a href="deletedRec.php" class="nav_link <?php if($_SESSION['actib'] == 'delrec'){echo 'active';}?>"> 
                        <i class="fa-solid fa-trash-can nav_icon"></i> 
                        <span class="nav_name">Deleted Records</span> 
                    </a>
                </div>
            </div> 
                <a href="includes/logout.inc.php" class="nav_link"> 
                    <i class='bx bx-log-out nav_icon' style="color:white;"></i> 
                    <span class="nav_name" style="color:white;">SignOut</span> 
                </a>
        </nav>
    </div>