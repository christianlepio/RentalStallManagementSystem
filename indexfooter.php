        <footer>
                <center>
                        <img src="img/MCPMS.png" class="logokofooter" alt="">
                </center><br>
            <div class="row justify-content-center">
                <div class="col-1 footer-col">
                    <a href="https://web.facebook.com/mcpm.official">
                         <i class="fa-brands fa-facebook border rounded-circle p-1"></i>
                    </a>
                </div>
                <div class="col-1 footer-col">
                    <a href="index.php#home">
                            <i class="fa-brands fa-google border rounded-circle p-1"></i>
                    </a>
                </div>
                <div class="col-1 footer-col">
                    <a href="index.php#home">
                            <i class="fa-brands fa-instagram border rounded-circle p-1"></i>
                    </a>
                </div>
                <div class="col-1 footer-col">
                    <a href="index.php#home">
                          <i class="fa-brands fa-twitter border rounded-circle p-1"></i>
                    </a>
                </div>
            </div>
            <p id="copyright">Copyright &copy; 2021 | Muntinlupa City Public Market</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="indexHeader.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
	        // All animations will take exactly 500ms
                var scroll = new SmoothScroll('a[href*="#"]', {
                        speed: 500,
                        speedAsDuration: true
                });

        </script>
        <script>
                AOS.init();
        </script>

        <!--pagination-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
        <script>
                $(document).ready(function() {
                $('#tblg').DataTable();
                } );
        </script>
</body>
</html>