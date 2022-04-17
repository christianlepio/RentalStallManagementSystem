<?php
    //session_start();
    if(!isset($_SESSION['tenantId'])){
        header("Location: index.php");
        exit();
    }
    if(!isset($_SESSION['tenantId'])){
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
                <a href="#" class="nav_logo <?php if($_SESSION['actib'] == 'cpass'){echo 'active';}?>">
                    <img src="imgFolder/pngegg.png" alt="" width="28" height="28" style="border-radius:50%">
                    <span class="nav_logo-name"><?php echo $_SESSION['tlname']; ?></span> 
                </a>
                <div class="nav_list">
                    <a href="surveycontent.php" class="nav_link <?php if($_SESSION['actib'] == 'srvy'){echo 'active';}?>">
                        <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Survey List</span>
                    </a>
                </div>
            </div> 
                <a href="includes/logout.inc.php" class="nav_link"> 
                    <i class='bx bx-log-out nav_icon' style="color:white;"></i> 
                    <span class="nav_name" style="color:white;">SignOut</span> 
                </a>
        </nav>
    </div>