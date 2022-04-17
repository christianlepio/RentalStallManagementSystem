<?php
    session_start();
    require 'header1.php';
?>
    <main class="signup-form">
        <div class="container">
        <div class="bg-light p-4 rounded">
        <?php
                        if(isset($_GET['editUser'])){
                            echo '<h2 class="text-center"><i class="fa-solid fa-user-pen"></i> Edit User</h2>';
                        }else{
                            echo '<h2 class="text-center"><i class="fa-solid fa-user-plus"></i> Add User</h2>';
                        }
                    ?><hr>
            <div class="row justify-content-center">
            
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyinput"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                        }elseif($_GET['error'] == "invalidusname"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Invalid username.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "invalidemail"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Your email is invalid.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "pwdnotmatched"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Password not matched.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "usnametaken"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Username/Email has been taken already, please try new one.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "extensionformatimg"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Inappropriate image file-extension.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "largesizeimg"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Too large image size.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }elseif($_GET['error'] == "noimage"){
                            echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Please attach your photo.</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                        elseif($_GET['error'] == "none"){
                            echo '<div class="alert shadow alert-success alert-dismissible fade show" role="alert">
                                <strong> <i class="bi bi-check-circle-fill"></i> New user has been added!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';

                        }
                    }
                ?>
                
                    

                    <form action="includes/signup.inc.php" method="post" class="row g-1 sform mb-2 shadow" enctype="multipart/form-data">
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Last name:</label>
                                <input type="text" name="lname" class="form-control form-control-sm" id="inputEmail4" placeholder="Last name..." value="<?php echo $uslname;?>" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">First name:</label>
                                <input type="text" name="fname" class="form-control form-control-sm" id="inputEmail4" placeholder="First name..." value="<?php echo $usfname;?>" required>
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Username:</label>
                                <input type="text" name="usname" class="form-control form-control-sm" id="inputEmail4" placeholder="Username..." value="<?php echo $usname; ?>" required <?php if(isset($_GET['editUser'])){echo 'disabled';}?>>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">User type:</label>
                                <select class="form-select form-select-sm" name="usrtype" aria-label="Default select example" required>
                                    <option selected disabled>User type...</option>
                                    <option value="Admin" <?php if($usrtyp == 'Admin'){ echo 'selected';}?>>Admin</option>
                                    <option value="Staff" <?php if($usrtyp == 'Staff'){ echo 'selected';}?>>Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control form-control-sm" id="inputEmail4" placeholder="Email..." value="<?php echo $usemail; ?>" required <?php if(isset($_GET['editUser'])){echo 'disabled';}?>>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Phone No.:</label>
                                <input type="text" name="phone" class="form-control form-control-sm" id="inputEmail4" placeholder="Phone no..." pattern="[0-9]{11}" value="<?php echo $usphone; ?>" required>
                            </div>
                        </div>
                        <?php
                            if(!isset($_GET['editUser'])){
                                echo '<div class="row g-3 justify-content-center">
                                    <div class="col-md-3">
                                        <label for="inputEmail4" class="form-label">Password:</label>
                                        <input type="password" name="pwd1" class="form-control form-control-sm" id="inputEmail4" placeholder="Password..." required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputEmail4" class="form-label">Confirm password:</label>
                                        <input type="password" name="pwd2" class="form-control form-control-sm" id="inputEmail4" placeholder="Confirm password..." required>
                                    </div>
                                </div>';
                            }
                        ?>
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Attach photo (optional):</label>
                                <input type="file" name="img-input" class="form-control form-control-sm" <?php if(!isset($_GET['editUser'])){ echo 'required';} ?>>
                            </div>
                        </div>
                        <input type="hidden" name="userid" value="<?php echo $userid?>">
                        <div class="row g-3 justify-content-center mb-4">
                            <div class="col-md-6">
                                <center>
                                    <?php
                                        if(isset($_GET['editUser'])){
                                            echo '<a href="user.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" name="signup-update" formaction="includes/process.inc.php" class="btn btn-primary btn-sm">Update</button>';
                                        }else{
                                            echo '<a href="user.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" name="signup-submit" class="btn btn-primary btn-sm">Submit</button>';
                                        }
                                    ?>
                                </center>
                            </div>
                        </div>

                    </form><hr>
                </div>
            </div>
        </div>
    </main>
<?php
    require 'footer1.php';
?>