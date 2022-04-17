<?php
    session_start();

    if(isset($_SESSION['usrId']) || isset($_SESSION['tenantId'])){
        if(isset($_SESSION['usrId'])){
            header("Location: management.php");
            exit();
        }elseif(isset($_SESSION['tenantId'])){
            header("Location: surveycontent.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="indexHeaderrrrr.css">
</head>
<body>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php#home"><i class="fa-solid fa-house"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#about"><i class="fa-solid fa-circle-info"></i>About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#contact"><i class="far fa-address-book"></i>Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#inquire"><i class="fa-solid fa-circle-question"></i>Inquire Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        
    </header>    
