<?php
    session_start();
    require 'header1.php';
?>
    <div class="height-100 bg-light main-content">
        <div class="container bg-light p-4 rounded">
        <?php
            if(isset($_GET['editRental'])){
                echo '<h3 class="fw-bold text-center"><i class="fa-solid fa-pen-to-square"></i> Edit Stall</h3>';
            }else{
                echo '<h3 class="fw-bold text-center"><i class="fa-solid fa-circle-plus"></i> Add Stall</h3>';
            }
        ?><hr>
        <div class="row justify-content-center">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyinput"){
                        echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; Please fill out all fields.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }elseif($_GET['error'] == "none"){
                        echo '<div class="alert shadow alert-success alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-check-circle-fill"></i> New stall has been added!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                    }
                }
                
            ?>
        </div>
        
            <form action="includes/process.inc.php" method="post" class="row g-1 sform mb-2 shadow" enctype="multipart/form-data">
                
                <div class="row g-3 justify-content-center">
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label">Cluster/Section:</label>
                        <select class="form-select form-select-sm" name="cluster" aria-label="Default select example" required>
                            <option selected disabled>Cluster/Section...</option>
                            <option value="Canteen Section" <?php if($cluster == 'Canteen Section'){ echo 'selected';}?>>Canteen Section</option>
                            <option value="Charcoal Section" <?php if($cluster == 'Charcoal Section'){ echo 'selected';}?>>Charcoal Section</option>
                            <option value="Chicken Section" <?php if($cluster == 'Chicken Section'){ echo 'selected';}?>>Chicken Section</option>
                            <option value="Dried Fish Section" <?php if($cluster == 'Dried Fish Section'){ echo 'selected';}?>>Dried Fish Section</option>
                            <option value="Dry Goods Section" <?php if($cluster == 'Dry Goods Section'){ echo 'selected';}?>>Dry Goods Section</option>
                            <option value="Egg Section" <?php if($cluster == 'Egg Section'){ echo 'selected';}?>>Egg Section</option>
                            <option value="Fish Section" <?php if($cluster == 'Fish Section'){ echo 'selected';}?>>Fish Section</option>
                            <option value="Grocery Old Section" <?php if($cluster == 'Grocery Old Section'){ echo 'selected';}?>>Grocery Old Section</option>
                            <option value="Grocery New Section" <?php if($cluster == 'Grocery New Section'){ echo 'selected';}?>>Grocery New Section</option>
                            <option value="Meat Section" <?php if($cluster == 'Meat Section'){ echo 'selected';}?>>Meat Section</option>
                            <option value="Puto Section" <?php if($cluster == 'Puto Section'){ echo 'selected';}?>>Puto Section</option>
                            <option value="Rice Section" <?php if($cluster == 'Rice Section'){ echo 'selected';}?>>Rice Section</option>
                            <option value="Sago Section" <?php if($cluster == 'Sago Section'){ echo 'selected';}?>>Sago Section</option>
                            <option value="Vegetable Old Section" <?php if($cluster == 'Vegetable Old Section'){ echo 'selected';}?>>Vegetable Old Section</option>
                            <option value="Vegetable New Section" <?php if($cluster == 'Vegetable New Section'){ echo 'selected';}?>>Vegetable New Section</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Stall no.:</label>    
                        <input type="number" name="stallnum" class="form-control form-control-sm" min="1" placeholder="Stall no..." value="<?php echo $stall;?>" required>
                    </div>
                </div>
                <div class="row g-3 justify-content-center">
                    <div class="col-md-3">
                        <label for="" class="form-label">Market fee:</label>    
                        <input type="number" name="marketfee" class="form-control form-control-sm" min="10" placeholder="Market fee..." value="<?php echo $marketfee;?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label">Status:</label>
                        <select class="form-select form-select-sm" name="status" aria-label="Default select example" required>
                            <option selected disabled>Status...</option>
                            <option value="Available" <?php if($status == 'Available'){ echo 'selected';}?>>Available</option>
                            <option value="Occupied" <?php if($status == 'Occupied'){ echo 'selected';}?>>Occupied</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="rentalid" value="<?php echo $rentalid?>">
                <div class="row g-3 justify-content-center mb-4">
                    <div class="col-md-6">
                        <center>
                            <?php
                                if(isset($_GET['editRental'])){
                                    echo '<a href="rental.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="submit" name="rental-update" formaction="includes/process.inc.php" class="btn btn-primary btn-sm">Update</button>';
                                }else{
                                    echo '<a href="rental.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="submit" name="rental-submit" class="btn btn-primary btn-sm">Save</button>';
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