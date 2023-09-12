</div>
</div>

<!-- Javascripts -->
<script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="../assets/plugins/bootstrap/popper.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="../assets/plugins/blockui/jquery.blockUI.js"></script>
<script src="../assets/plugins/flot/jquery.flot.min.js"></script>
<script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="../assets/js/connect.min.js"></script>
<script src="../assets/js/pages/dashboard.js"></script>
<script>
    $(document).ready(function() {
        // Menambahkan event click pada elemen dengan class ".sidebar-title"
        $('.sidebar-title').on('click', function() {
            // Menghapus kelas "active" dari semua elemen dengan class ".sidebar-title"
            $('.sidebar-title').removeClass('active');

            // Menambahkan kelas "active" pada elemen yang diklik
            $(this).addClass('active');
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleksi tombol-tombol yang akan digunakan
        var sidebarCloseBtn = document.getElementById("sidebar-close");
        var sidebarOpenBtn = document.getElementById("sidebar-state");
        var pageSidebar = document.querySelector(".page-sidebar");

        // Tambahkan event listener untuk tombol-tombol tersebut
        sidebarCloseBtn.addEventListener("click", function() {
            pageSidebar.classList.remove("active");
        });

        sidebarOpenBtn.addEventListener("click", function() {
            pageSidebar.classList.add("active");
        });
    });
</script>

</body>

</html>

<?php
// Tutup koneksi ke database
mysqli_close($conn);
?>