<?php
    require 'indexHeader.php';
    require 'includes/dbh.inc.php';
?>
    <style>
        * {box-sizing: border-box;}
        
        .mySlides {display: none;}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
        }
        /* Caption text */
        .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
        }

        .active {
        background-color: #04204e;
        }

        /* Fading animation */
        .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }

        @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
        .text {font-size: 11px}
        }
    </style>


    <main>
        <div>
            
            <section class="home" id="home">
                <div class="container">
                    <div class="text-center" >
                        <img src="img/MCPMS.png" alt="" data-aos="zoom-in-up">
                    </div>
                    
                    <h1 class="text-center" data-aos="fade-down">Muntinlupa City Public Market</h1>
                    <h5 class="text-center" data-aos="fade-up">Montillano St., Barangay Alabang, Muntinlupa City</h5>
                    <div class="row justify-content-center">
                        <div class="elasticbutt" data-aos="zoom-in" data-aos-duration="4000">
                            <a href="index.php#about"><i class="fa-solid fa-arrow-down"></i> READ MORE</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about bg-light" id="about">
                <div class="row justify-content-center" data-aos="fade-down">
                    <h1 class="h1">About Us</h1>
                </div><hr>



                <div class="slideshow-container">

                    <div class="mySlides fade bg-secondary">
                        <div class="numbertext">1 / 3</div>
                        <img src="img/palengke1.jpg" style="width:100%; height:50vmin;">
                    </div>

                    <div class="mySlides fade bg-secondary">
                        <div class="numbertext">2 / 3</div>
                        <img src="img/p1.jpg" class="img-fluid mx-auto d-block" style="height:50vmin;">
                    </div>

                    <div class="mySlides fade bg-secondary">
                        <div class="numbertext">3 / 3</div>
                        <img src="img/p2.jpg" class="img-fluid mx-auto d-block" style="height:50vmin;">
                    </div>

                </div>
                    <br>

                <div style="text-align:center">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                </div>

                <script>
                    var slideIndex = 0;
                    showSlides();

                    function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 2000); // Change image every 2 seconds
                    }
                </script><hr>
                <div class="row justify-content-center" data-aos="fade-down">
                    <h3 class="h3 opis"><u> &nbsp;Office Profile&nbsp; </u></h3>
                </div><br>
                <div class="row justify-content-center">
                    <div class="col-md-5 px-3" data-aos="zoom-in">
                        <ul>
                            <li>Started as a flea market in 1979, in a parcel of land. Operation and management of which was thru a municipal lease with Kilusan Bayan ng Magtitinda ng Bayang Pamilihang Muntinlupa (KBMBPM).</li><br>
                            <li>1989 thru a Presidential Proclamation No. 1240, Pres. Fidel V. Ramos proclaimed a 20,000 sq. m. land in Alabang, Muntinlupa exclusively devoted for the construction of a public market, thus named Alabang Public Market.</li>
                        </ul>
                    </div>
                    <div class="col-md-5 px-3" data-aos="zoom-in">
                        <ul>
                            <li>1995, May, the municipality was declared as a City. Thus the market is now named Muntinlupa City Public Market.</li><br>
                            <li>2001, the lease Agreement with KBMBPM expires.</li><br>
                            <li>Mid-2001 to present, Operation and management of market were taken over by the City Government.</li>
                        </ul>
                    </div>
                </div><br>
                <div class="row justify-content-center p-2 bg-dark rounded-top">
                    <div class="col-md-4 p-4 mb-2 text-center border rounded aboutsec" data-aos="fade-down">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <h3>Land Area</h3><hr>
                        <p>- Approximately 20,000 sq. m.</p><hr>
                    </div>
                    <div class="col-md-4 p-4 mb-2 text-center border rounded aboutsec" data-aos="fade-down">
                    <i class="fa-solid fa-shop"></i>
                        <h3>Facilities</h3><hr>
                        <p>- Administrative offices, 1,248 covered stores, bay area and storage.</p>
                        <p>- Facility, generator sets, restrooms, dumpsite, parking and delivery area.</p>
                        <p>- Water tank and cemented roadways.</p><hr>
                    </div>                    
                </div>
                <div class="row justify-content-center p-2 bg-dark rounded-bottom">
                    <div class="col-md-4 p-4 mb-2 text-center border rounded" data-aos="fade-up">
                        <i class="fa-solid fa-star border rounded-circle p-3 abouticon"></i>
                        <h3>Mission</h3><hr>
                        <p> > To provide quality public services that include clean, secured, orderly, priced-monitored public market.</p><hr>
                    </div>
                    <div class="col-md-4 p-4 mb-2 text-center border rounded" data-aos="fade-up">
                        <i class="fa-solid fa-eye border rounded-circle p-3 abouticon"></i>
                        <h3>Vision</h3><hr>
                        <p> > To be an ideal and best managed public market in the Philippines with the cooperation of all stakeholders.</p><hr>
                    </div>                    
                </div>
            </section>
            <section class="contact" id="contact">
                <div class="row justify-content-center" data-aos="fade-down">
                    <h1 class="h1 text-white">Contact</h1>
                </div><hr>
                <div class="row justify-content-center" data-aos="zoom-in">
                    <img src="img/MCPMS.png" alt="">
                </div><br>
                <div class="row justify-content-center" data-aos="fade-up">
                    <h4 class="text-white text-center">Officer-in-Charge: Mr. Randy Garcia</h4><br>
                </div>
                <div class="row justify-content-center" data-aos="fade-up">
                    <p class="text-center"><small>Montillano St., Barangay Alabang, Muntinlupa City</small></p>
                </div>
                <div class="row justify-content-center" data-aos="fade-up">
                    <p><strong>Contact No. : 0919 079 2097</strong></p>
                </div>
                
            </section>
            <section class="inquire bg-info" id="inquire">
                    <div class="row justify-content-center" data-aos="fade-down">
                        <h1 class="h1 text-white">Inquire Now</h1>
                    </div><hr>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <?php
                                if(isset($_GET['error'])){
                                    if($_GET['error'] == "norental"){
                                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <small><strong><i class="fa-solid fa-circle-exclamation"></i></strong> '.$_GET['cluster'].' is fully occupied, Please try another Cluster/section.</small>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>';
                                    }elseif($_GET['error'] == "none"){
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <small><strong><i class="fa-solid fa-circle-check"></i></strong> Your inquiry has been submitted, please wait for our calls.</small>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <form action="prescrStall.php#inquire" method="post" data-aos="zoom-in">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>Last name:</small></label>
                                <input type="text" name="ilname" class="form-control" id="" placeholder="Last name..." required>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>First name:</small></label>
                                <input type="text" name="ifname" class="form-control" id="" placeholder="First name..." required>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>Gender:</small></label>
                                <select name="igender" class="custom-select" required required>
                                    <option selected>Gender...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>Contact no:</small></label>
                                <input type="number" name="icontact" class="form-control" id="" placeholder="Contact no..." min="0" pattern="[0-9]{11}" required>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6">
                                <label for="exampleFormControlTextarea1"><small>Address:</small></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="iadress" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>Cluster/Section:</small></label>
                                <select name="iclustername" class="custom-select" required>
                                    <option selected>Cluster/Section...</option>
                                    <?php
                                        $sql = "SELECT DISTINCT(cluster) as cluster FROM rental_tbl ORDER BY cluster ASC;";
                                        $result = mysqli_query($conn, $sql);
                                        $resCheck = mysqli_num_rows($result);

                                        if($resCheck > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$row['cluster'].'">'.$row['cluster'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlTextarea1"><small>Product name:</small></label>
                                <input type="text" name="iprodname" class="form-control" id="" placeholder="Product name..." required>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6">
                                <center><br>
                                    <button type="submit" name="submit-inquiry" class="btn btn-danger btinquire">View Prescribed Stall</button>
                                </center>
                            </div>
                        </div><hr>
                    </form>                  
                
            </section>
        </div>
    </main>
<?php
    require 'indexFooter.php';
?>