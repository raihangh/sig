// Mengaktifkan tautan yang sesuai dengan URL saat ini saat halaman dimuat
document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.pathname;
    var navbarLinks = document.querySelectorAll(".navbar a");

    navbarLinks.forEach(function(link) {
        if (link.getAttribute("href") === currentUrl) {
            link.classList.add("active");
        }
    });
});