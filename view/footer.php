<footer class="footer footer-static footer-light">
<p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2024<span class="d-none d-sm-inline-block">, All rights Reserved </span></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<?php
if(!isset($_COOKIE['darkmode'])){
setcookie("darkmode", "light", time()+(24*60*60));
}
?>