<?php
    session_start();
    require 'header1.php';
?>
    <div class="height-100 bg-light main-content">
    <div class="container bg-light p-4 rounded">
        <h3 class="fw-bold text-center"><?php if(isset($_GET['editTenant'])){echo '<i class="fa-solid fa-user-pen"></i> Edit Tenant';}else{echo '<i class="fa-solid fa-user-plus"></i> Add Tenant';}?></h3><hr>
        <div class="row justify-content-center">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyinput"){
                        echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Please fill out all fields.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }elseif($_GET['error'] == "occupiedstall"){
                        echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Stall number you\'ve entered is already occupied.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }elseif($_GET['error'] == "none"){
                        echo '<div class="alert shadow alert-success alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-check-circle-fill"></i> New tenant has been added!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                    }
                }
            ?>
        </div>
        
        <form action="includes/process.inc.php" method="post" class="row g-1 sform mb-2 shadow" enctype="multipart/form-data">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Last name:</label>
                            <input type="text" name="lname" class="form-control form-control-sm" id="inputEmail4" placeholder="Last name..." value="<?php echo $tlname;?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">First name:</label>
                            <input type="text" name="fname" class="form-control form-control-sm" id="inputEmail4" placeholder="First name..." value="<?php echo $tfname;?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Middle name:</label>
                            <input type="text" name="mname" class="form-control form-control-sm" id="inputEmail4" placeholder="Middle name..." value="<?php echo $tmname;?>" required>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Gender:</label>
                            <select class="form-select form-select-sm" name="gender" aria-label="Default select example" required>
                                <option selected disabled>Gender...</option>
                                <option value="Male" <?php if($tgender == 'MALE'){echo 'selected';} ?>>MALE</option>
                                <option value="Female" <?php if($tgender == 'FEMALE'){echo 'selected';} ?>>FEMALE</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Birthdate:</label>    
                            <input type="date" name="bday" class="form-control form-control-sm" max="2002-12-31" min="1961-01-01" value="<?php echo $tbdate;?>" required>    
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Phone No.:</label>
                            <input type="text" name="phone" class="form-control form-control-sm" id="inputEmail4" placeholder="Phone no..." pattern="[0-9]{11}" value="<?php echo $tphone; ?>" required>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">Address:</label>
                            <textarea class="form-control form-control-sm" name="address" id="exampleFormControlTextarea1" rows="3"><?php echo $taddress;?></textarea>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="" class="form-label">Date Admitted:</label>    
                            <input type="date" name="dateAdmit" class="form-control form-control-sm" value="<?php echo $tAdmit;?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Cluster/Section:</label>
                            <select class="form-select form-select-sm" name="cluster" aria-label="Default select example" required>
                                <option selected disabled>Cluster/Section...</option>
                                <option value="Canteen Section" <?php if($tcluster == 'CANTEEN SECTION'){ echo 'selected';}?>>CANTEEN SECTION</option>
                                <option value="Charcoal Section" <?php if($tcluster == 'CHARCOAL SECTION'){ echo 'selected';}?>>CHARCOAL SECTION</option>
                                <option value="Chicken Section" <?php if($tcluster == 'CHICKEN SECTION'){ echo 'selected';}?>>CHICKEN SECTION</option>
                                <option value="Dried Fish Section" <?php if($tcluster == 'DRIED FISH SECTION'){ echo 'selected';}?>>DRIED FISH SECTION</option>
                                <option value="Dry Goods Section" <?php if($tcluster == 'DRY GOODS SECTION'){ echo 'selected';}?>>DRY GOODS SECTION</option>
                                <option value="Egg Section" <?php if($tcluster == 'EGG SECTION'){ echo 'selected';}?>>EGG SECTION</option>
                                <option value="Fish Section" <?php if($tcluster == 'FISH SECTION'){ echo 'selected';}?>>FISH SECTION</option>
                                <option value="Grocery Old Section" <?php if($tcluster == 'GROCERY OLD SECTION'){ echo 'selected';}?>>GROCERY OLD SECTION</option>
                                <option value="Grocery New Section" <?php if($tcluster == 'GROCERY NEW SECTION'){ echo 'selected';}?>>GROCERY NEW SECTION</option>
                                <option value="Meat Section" <?php if($tcluster == 'MEAT SECTION'){ echo 'selected';}?>>MEAT SECTION</option>
                                <option value="Puto Section" <?php if($tcluster == 'PUTO SECTION'){ echo 'selected';}?>>PUTO SECTION</option>
                                <option value="Rice Section" <?php if($tcluster == 'RICE SECTION'){ echo 'selected';}?>>RICE SECTION</option>
                                <option value="Sago Section" <?php if($tcluster == 'SAGO SECTION'){ echo 'selected';}?>>SAGO SECTION</option>
                                <option value="Vegetable Old Section" <?php if($tcluster == 'VEGETABLE OLD SECTION'){ echo 'selected';}?>>VEGETABLE OLD SECTION</option>
                                <option value="Vegetable New Section" <?php if($tcluster == 'VEGETABLE NEW SECTION'){ echo 'selected';}?>>VEGETABLE NEW SECTION</option>
                            </select>

                        </div>
                        <div class="col-md-2">
                                <label for="" class="form-label">Market fee:</label>    
                                <input type="number" name="marketfee" class="form-control form-control-sm" min="10" placeholder="Market fee..." value="<?php echo $tmarketfee; ?>" required>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <small><label for="inputEmail4" class="form-label">Cluster no. from:</label></small>
                            <input type="number" name="cluster1" class="form-control form-control-sm" id="inputEmail4" min="1" placeholder="Cluster no..." value="<?php echo $tstall1; ?>" required>
                        </div>
                        <div class="col-md-2">
                            <small><label for="inputEmail4" class="form-label">Cluster no. to:</label></small>
                            <input type="number" name="cluster2" class="form-control form-control-sm" id="inputEmail4" min="1" placeholder="Cluster no..." value="<?php echo $tstall2; ?>" required>
                        </div>
                    </div>
                    <input type="hidden" name="tenantid" value="<?php echo $tenantid;?>">
                    <div class="row g-3 justify-content-center mb-4">
                        <div class="col-md-6">
                            <center>
                                <?php
                                    if(isset($_GET['editTenant'])){
                                        echo '<a href="tenants.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="tenant-update" class="btn btn-primary btn-sm">Update</button>';
                                    }else{
                                        echo '<a href="tenants.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="tenant-submit" class="btn btn-primary btn-sm">Save</button>';
                                    }
                                ?>
                            </center>
                        </div>
                    </div>

                </form><hr>
            </div>

    </div>
    <!--Container Main end-->
<?php
    require 'footer1.php';
?>