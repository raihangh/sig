</body>

<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="/assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/assets/js/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="/assets/js/demo.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
<script>
    //mengatur status aktif pada tautan berdasarkan URL
    document.addEventListener("DOMContentLoaded", function() {
        var currentUrl = window.location.pathname;
        var navbarLinks = document.querySelectorAll(".nav-item a");

        navbarLinks.forEach(function(link) {
            // if (link.getAttribute("href") === currentUrl) {
            //     link.classList.add("active");
            // }
            if (link.getAttribute("href").includes('dashboardAwal') && currentUrl.includes('dashboardAwal')) {
                link.classList.add("active");
            } else if (link.getAttribute("href").includes('barang') && currentUrl.includes('barang')) {
                link.classList.add("active");
            } else if (link.getAttribute("href").includes('laporan') && currentUrl.includes('laporan')) {
                link.classList.add("active");
            } else if (link.getAttribute("href").includes('penerimaanBarang') && currentUrl.includes('penerimaanBarang')) {
                link.classList.add("active");
            } else if (link.getAttribute("href").includes('pengeluaranBarang') && currentUrl.includes('pengeluaranBarang')) {
                link.classList.add("active");
            } else {
                null
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabeldashboard').DataTable();
    });

    // Ambil Kode Barang
    async function changeValue() {
        var selectElement = document.getElementById("id_barang");
        var kode_barang = document.getElementById('kode_barang');
        var id = selectElement.value;

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/get-kode-barang/${id}`);
            if (!response.ok) {

                console.log("error")
            }
            const data = await response.json();
            document.getElementById('satuan_penerimaan').value = data.satuan;
            document.getElementById('kode_barang').value = data.kode_barang;
            document.getElementById('packorecer').textContent = data.satuan;
            document.getElementById('jumlah').setAttribute("max", data.stock);

        } catch (error) {
            console.error('Error:', error);
        }

    }
</script>

</html>
