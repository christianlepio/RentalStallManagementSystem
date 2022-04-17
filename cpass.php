<?php
    session_start();
    $_SESSION['actib'] = 'cpass';
    require 'header1.php';
?>
    <div class="height-100 bg-light main-content">
        <div class="row justify-content-center p-5  rounded">
            <?php
                if(isset($_GET['cpassform'])){
                    echo '<div class="bg-light rounded p-3">
                    <h3 class="text-center"><i class="fa-solid fa-key"></i> Change password</h3><hr>
                    <div class="row justify-content-center mb-3">';
                }
            ?>
            <?php
                if(isset($_GET['cpassform'])){
                    
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields"){
                            echo '<div class="alert shadow alert-danger alert-dismissible fade show" role="alert">
                                    <strong><small><i class="bi bi-exclamation-square-fill"></i> Please fill out all fields.</small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }elseif($_GET['error'] == "pwdnotmatched"){
                            echo '<div class="alert shadow alert-danger alert-dismissible fade show" role="alert">
                                    <strong><small><i class="bi bi-exclamation-square-fill"></i>&nbsp; Password not matched.</small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }elseif($_GET['error'] == "wrongoldpassword"){
                            echo '<div class="alert shadow alert-danger alert-dismissible fade show" role="alert">
                                    <strong><small><i class="bi bi-exclamation-square-fill"></i>&nbsp; Incorrect old password.</small></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }elseif($_GET['error'] == "success"){
                            echo '<div class="alert shadow alert-success alert-dismissible fade show" role="alert">
                                <strong><small><i class="bi bi-check-circle-fill"></i>&nbsp; Password reset successfully!</small></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                    }
            ?>
            </div>
            
                <form action="includes/manageAcc.inc.php" method="post" class="shadow rounded">
                    <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-md-3">
                            <label for=""><small>Username:</small></label>
                            <input type="text" class="form-control" name="usnn" id="" value="<?php echo $_SESSION['usernm']; ?>" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for=""><small>Current password:</small></label>
                            <input type="password" class="form-control" name="ppass" placeholder="Current password..." required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-md-3">
                            <label for=""><small>New password:</small></label>
                            <input type="password" class="form-control" name="pass1" placeholder="New password..." required>
                        </div>
                        <div class="col-md-3">
                            <label for=""><small>Confirm password:</small></label>
                            <input type="password" class="form-control" name="pass2" placeholder="Re-type password..." required>
                        </div>
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $_SESSION['usrId']; ?>">
                    <div class="row g-3 justify-content-center">
                        <center>
                            <a style="width:85px;" type="submit" class="btn btn-danger btn-sm" href="cpass.php">Cancel</a>&nbsp;
                            <button style="width:85px;" type="submit" name="cpass-submit" class="btn btn-primary btn-sm">Save</button>
                        </center>
                    </div><br>
                </form><hr>
            </div>
            <?php
                }else{
                    echo '<div class="col-5 p-4 bg-light shadow rounded"><hr>
                            <table>  
                                <tr class="p-3">
                                    <td rowspan="2" class="text-center p-4"><h2><i class="fa-solid fa-key"></i></h2></td>
                                    <td><a href="cpass.php?cpassform=true"><h4>Change password ?</h4></a></td>
                                </tr>
                                <tr>
                                    <td><small>It\'s a good idea to use a strong password that you\'re not using elsewhere.</small></td>
                                </tr>   
                            </table><hr>
                        </div>';
                }
            ?>
        </div>
    </div>
    <!--Container Main end-->
<?php
    require 'footer1.php';
?>