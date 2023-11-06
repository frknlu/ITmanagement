<?php
include("inc/config.php");
ob_start();
session_start();

if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}


?>
<!DOCTYPE html>
<html class="loading <?php if($_COOKIE['darkmode']=="dark"){ echo "dark-layout"; } else { echo "light-layout"; } ?>" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="FurkanÜnlü">
    <title>Danet IT</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
	

    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">	
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

	<!-- extra -->
	<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/css/base/jquery-ui.min.css" integrity="sha512-OIJ+9bQE2puZceOJT8hER4vfFzYJoE4iOJAAvgq1ts24d9FNiEm/AbiIVFGSrCXFdB0u+Vi8CJ0gVoZYddnwBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />     

	
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
     <?php include("view/header.php"); ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php include("view/menu.php"); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->


<?php    
$adim = @$_GET["a"];
switch($adim){
 
case "":

?>
		        <section id="responsive-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
								<table id="empTable" class="dataTable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
											<th>Kullanıcı</th>
											<th>Cihaz Adı</th>
											<th>Marka / Model</th>
											<th>SN</th>
											<th>Office</th>
											<th>Lisans</th>
											<th>AD</th>
											<th>İşletim Sistemi</th>
											<th>İşlemci / Ram / Hdd</th>
											<th>IP / MAC</th>
											<th>Lokasyon</th>
											<th>İşlem</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
		
<?php
break;
	
case "add": 

$hash = $_GET["id"];
$tur  = $_POST['tur'];
$teslim_alma_tarih = $_POST['teslim_tarih'];
$vade_tarih = $_POST['vade_tarih'];
$tutar = $_POST['tutar'];
$doviz = $_POST['doviz'];

if($hash == ""){
echo '<meta http-equiv="refresh" content="0;URL=firma.php?id='.$hash.'">';
}else{
sqlsrv_query($con,"INSERT INTO veri (hash,teslim_alma_tarih,vade_tarih,tur,tutar,doviz) values ('$hash','$teslim_alma_tarih','$vade_tarih','$tur','$tutar','$doviz')");
echo '<meta http-equiv="refresh" content="0;URL=firma.php?id='.$hash.'">';
}

break;
case "edit":

$id = $_GET["id"];
$edit_query = sqlsrv_query($con, "select * computers veri WHERE id='".$id."'");
$edit_row = sqlsrv_fetch_array($edit_query);
?>
				
<?php
break;
case "update":

echo $id = $_POST["id"];
echo $tur = $_POST['tur'];
echo $teslim_alma_tarih = $_POST['teslim_tarih'];
echo $vade_tarih = $_POST['vade_tarih'];
echo $tutar = $_POST['tutar'];
echo $doviz = $_POST['doviz'];

$edit_query1 = sqlsrv_query($con, "select * computers veri WHERE id='".$id."'");
$edit_row1 = sqlsrv_fetch_array($edit_query1);

//sqlsrv_query($con,'UPDATE firma SET  tur="'.$tur.'", teslim_alma_tarih="'.$teslim_alma_tarih.'", vade_tarih="'.$vade_tarih.'", tutar="'.$tutar.'", doviz="'.$doviz.'" where id="'.$id.'" ');

sqlsrv_query($con,"UPDATE veri SET  tur='".$tur."', teslim_alma_tarih='".$teslim_alma_tarih."', vade_tarih='".$vade_tarih."', tutar='".$tutar."', doviz='".$doviz."' where id='".$id."' ");


echo '<meta http-equiv="refresh" content="0;URL=firma.php?id='.$edit_row1["hash"].'">'; 

break;

case "delete": 
$id = $_GET['id'];
$edit_query1 = sqlsrv_query($con, "select * computers veri WHERE id='".$id."'");
$edit_row1 = sqlsrv_fetch_array($edit_query1);
echo "Silmek İstiyormuzunuz ? <a href='firma.php?a=delete_onay&id=".$id."'>Onayla</a> -";
echo " <a href='firma.php?id=".$edit_row1["hash"]."'>İptal</a>";
break;

case "delete_onay":
$id = $_GET['id'];
$edit_query1 = sqlsrv_query($con, "select * computers veri WHERE id='".$id."'");
$edit_row1 = sqlsrv_fetch_array($edit_query1);
sqlsrv_query($con,'DELETE computers veri where id="'.$id.'"'); 
echo '<meta http-equiv="refresh" content="0;URL=firma.php?id='.$edit_row1["hash"].'">'; 
break;

}
	?>
            
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
	
	 <?php include("view/footer.php"); ?>
    
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>

    <script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->
	
	<script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

										
<script>
        $(document).ready(function(){
            var dataTable = $('#empTable').DataTable({
                'processing': true,
                'serverSide': false,
                'serverMethod': 'post',
				"pageLength": 25,
                'ajax': {
                    'url':'class/computer.php',
                },
				'order': [[ 0, "desc" ]],
                'columns': [
					{ data: 'id' },
					{ data: 'users' },
					{ data: 'device_name' },
					{ data: 'brandmodel' },
					{ data: 'sn' },
					{ data: 'office' },
					{ data: 'licence' },
					{ data: 'ad' },
					{ data: 'os' },
					{ data: 'cpuramhdd' },
					{ data: 'ipmac' },
					{ data: 'location' },
					{ data: "id" , render : function ( data, type, row, meta ) {
				return type === 'display'  ? 
			  '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown" title="Process">' + feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) + '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a type="button" id="'+ data +'" class="dropdown-item delete-record delete_modal">' + feather.icons['trash-2'].toSvg({ class: 'me-50' }) +
              'Delete</a>' +
              '</div>' +
              '</div> <a href="computers.php?process=edit&id='+ data +'" class="item-edit" title="Edit">'+ feather.icons['edit'].toSvg({ class: 'me-50' }) +'</a>' + '<a target="_blank" href="print/computers.php?id='+ data +'" class="item-edit" title="Print">'+ feather.icons['printer'].toSvg({ class: 'me-50' }) +'</a>' :
                data;
				}}
				],
				dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				buttons: [
	
        {

          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Yeni Kayıt',

          className: 'create-new btn btn-primary',

          attr: {

            'data-bs-toggle': 'modal',

            'data-bs-target': '#addNew'

          },

          init: function (api, node, config) {

            $(node).removeClass('btn-secondary');

          }

        }

      ]	
	  
            });

        });
</script>	
											
	
		
</body>
<!-- END: Body-->

</html>