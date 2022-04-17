<?php
    session_start();
    require 'header1.php';
?>
    <div class="height-100 bg-light main-content">
    <div class="container bg-light p-4 rounded">
        <h3 class="fw-bold text-center"><i class="bi bi-credit-card-fill"></i> <?php if(isset($_GET['editPayment'])){echo 'Edit Payment';}else{echo 'Add Payment';}?></h3><hr>
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
                    }elseif($_GET['error'] == "ornumlength"){
                        echo '<div class="alert shadow alert-warning alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-exclamation-square-fill"></i>&nbsp; O.R. number must contain 7 digits.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }elseif($_GET['error'] == "none"){
                        echo '<div class="alert shadow alert-success alert-dismissible fade show" role="alert">
                            <strong> <i class="bi bi-check-circle-fill"></i> Payment has been added!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
            ?>
        </div>

        <form action="includes/process.inc.php" method="post" class="row g-1 sform mb-2 shadow" enctype="multipart/form-data">
                    
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-4">
                            <label for="" class="form-label">Payment date:</label>    
                            <input type="date" name="pdate" class="form-control form-control-sm" value="<?php echo $today;?>" required <?php if(isset($_GET['editPayment'])){ echo 'disabled';}?>>
                            <?php
                                if(isset($_GET['editPayment'])){
                                    echo '<input type="hidden" name="pdate" class="form-control form-control-sm" value="'.$today.'" required>';
                                }
                            ?>
                                
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Holder name:</label>
                            <input type="text" name="lname" class="form-control form-control-sm" id="inputEmail4" placeholder="Holder name..." value="<?php if(isset($_GET['editPayment'])){ echo $holder;}else{echo $tlname.', '.$tfname;}?>" required disabled>
                            <input type="hidden" name="hiddenlname" class="form-control form-control-sm" id="inputEmail4" placeholder="Holder name..." value="<?php if(isset($_GET['editPayment'])){ echo $holder;}else{echo $tlname.', '.$tfname;}?>">
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Cluster/Section:</label>
                            <input type="text" name="cluster" class="form-control form-control-sm" id="inputEmail4" placeholder="Cluster/Section..." value="<?php echo $tcluster;?>" required disabled>
                            <input type="hidden" name="hiddencluster" class="form-control form-control-sm" id="inputEmail4" placeholder="Cluster/Section..." value="<?php echo $tcluster;?>">
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label">Stall no.:</label>
                            <input type="text" name="stall" class="form-control form-control-sm" id="inputEmail4" placeholder="Stall no..." value="<?php echo $tstall1.'-'.$tstall2;?>" required disabled>
                            <input type="hidden" name="hiddenstall" class="form-control form-control-sm" id="inputEmail4" placeholder="Stall no..." value="<?php echo $tstall1.'-'.$tstall2;?>">
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Total Market fee:</label>    
                            <input type="number" name="totmarketfee" class="form-control form-control-sm" min="10" placeholder="Market fee..." value="<?php echo $totalmarketfee; ?>" required>
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-2">
                            <label for="" class="form-label">Electrcity:</label>    
                            <input type="number" name="elec" class="form-control form-control-sm" min="0" placeholder="Electrcity fee..." value="<?php echo $telec; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Water:</label>    
                            <input type="number" name="water" class="form-control form-control-sm" min="0" placeholder="Water fee..." value="<?php echo $twater; ?>">
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                    <div class="col-md-2">
                            <label for="" class="form-label">Garbage:</label>    
                            <input type="number" name="garbage" class="form-control form-control-sm" min="0" placeholder="Garbage fee..." value="<?php echo $tgarbage; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Other fee:</label>    
                            <input type="number" name="otherf" class="form-control form-control-sm" min="0" placeholder="Other fee..." value="<?php echo $tother; ?>">
                        </div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-4">
                            <label for="" class="form-label">O.R. number:</label>    
                            <input type="number" name="orn" class="form-control form-control-sm" min="10" placeholder="O.R. number..." value="<?php echo $torno; ?>" required>
                        </div>
                    
                    </div>
                    
                    <input type="hidden" name="tenantid" value="<?php echo $tenantid;?>">
                    <input type="hidden" name="paymentid" value="<?php echo $paymentid;?>">
                    <div class="row g-3 justify-content-center mb-4">
                        <div class="col-md-6">
                            <center>
                                <?php
                                    if(isset($_GET['editPayment'])){
                                        echo '<a href="payment.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="payment-update" class="btn btn-primary btn-sm">Update</button>';
                                    }else{
                                        echo '<a href="tenants.php" class="btn btn-danger btn-sm">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" name="payment-submit" class="btn btn-primary btn-sm">Save</button>';
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