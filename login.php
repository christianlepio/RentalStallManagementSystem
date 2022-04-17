<?php
    session_start();
    if(isset($_SESSION['usrId'])){
        header("Location: management.php");
        exit();
    }if(isset($_SESSION['tenantId'])){
        header("Location: surveycontent.php");
        exit();
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
                        <li class="nav-item">
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
                        <li class="nav-item active">
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
    <link rel="stylesheet" href="navbarstylleeee.css">    
    <main class="login">
        <div class="container box">
            <div class="row justify-content-center">
                <div class="col-md-10">
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyinput"){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <small><strong> <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please fill out all fields.</strong></small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "wronglogin1"){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <small><strong> <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Incorrect username.</strong></small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "wronglogin2"){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <small><strong> <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Incorrect password.</strong></small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    }
                ?>
                </div>

                <h2 class="text-center"><img src="img/MCPMS.png" alt="" width="96" height="96"></h2>

                <form action="includes/login.inc.php" method="post" class="row g-1 sform">
                    <div class="row g-3 justify-content-center">
                        <div class="input-group col-md-11">
                            <span class="input-group-text" id="basic-addon1"> <i class="fa-solid fa-user"></i></span>
                            <input type="text" name="usname" class="form-control" placeholder="Username/Email..." aria-label="Username" aria-describedby="basic-addon1">
                            <!--label for="exampleFormControlInput1" class="form-label">Username or Email:</label>
                            <input type="text"  class="form-control" id="exampleFormControlInput1" placeholder="Username/Email..."-->
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="input-group col-md-11">
                            <span class="input-group-text" id="basic-addon1"> <i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="pword" class="form-control" placeholder="Password..." aria-label="Username" aria-describedby="basic-addon1">    
                        
                            <!--label for="inputPassword4" class="form-label">Password:</label>
                            <input type="password"  class="form-control" id="inputPassword4" placeholder="Password..."-->
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-11">
                            <center>
                                <button type="submit" name="login-submit" class="btn btn-primary btlogin">Log In</button>
                            </center>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                    
                        <div class="col-md-5">
                            <center><br><a href="forgotPass.php"><p>Forgot password?</p></a></center>
                        </div>
                        <div class="col-md-5">
                            <center><br><a href="logintenant.php"><p>Login as Tenant?</p></a></center>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </main>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="indexHeader.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
    <script>
        // All animations will take exactly 500ms
            var scroll = new SmoothScroll('a[href*="#"]', {
                    speed: 500,
                    speedAsDuration: true
            });

    </script>
    
<?php
    //require 'indexFooter.php';
?>