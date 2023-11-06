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
    <meta name="author" content="PIXINVENT">
    <title>Danet IT</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
	
 <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->

<?php
$adim = @$_GET["a"];
switch($adim){
case "":	
?>
        

				
				
<?php
break;
case "new": 
$firma = str_replace("'", "\'", $_POST['firma']);

if($firma == ""){
echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}else{
sqlsrv_query($con,"INSERT INTO firma (firma) values ('$firma')");
}
echo '<meta http-equiv="refresh" content="0;URL=index.php">';
break;


case "update": 

$id = $_GET["id"];
$edit_query = sqlsrv_query($con, "select * from firma WHERE id='".$id."'");
$edit_row = sqlsrv_fetch_assoc($edit_query);
?>

<div class="row">
                    <div class="col-12">
					<div class="clearfix"> 		
					<a onclick="history.back();"><button type="button" class="btn btn-warning"><i class="fa fa-undo"></i> Geri Dön </button></a>
							</div>
				     </div>
                </div>		
				
	<form action="index.php?a=updateonay" method="post">
	<input type="hidden" value="<?php echo $_GET["id"]; ?>" name="id">
						<div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle"></h1>

                                <!-- form -->
                                <div id="addNewCardValidation3" class="row gy-1 gx-2 mt-75">

									<div class="col-md-6">
                                        <label class="form-label" for="firma">Firma Adı</label>
                                        <input type="text" id="firma" class="form-control" name="firma" value="<?php echo $edit_row["firma"]; ?>" required>
                                    </div>


                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Güncelle</button>
                                        <button onclick="history.back();" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            İptal
                                        </button>
                                    </div>
                                </div>
                            </div>
			</form>		

<?php
break;


case "updateonay": 

$id = $_POST['id'];
$firma = str_replace("'", "\'", $_POST['firma']);

sqlsrv_query($con,"UPDATE firma SET firma='".$firma."' where id='".$id."' ");

echo '<meta http-equiv="refresh" content="0;URL=index.php">';
break;


case "delete": 
$id = $_GET['id'];
echo "Gizlemek İstiyormuzunuz ? <a href='index.php?a=delete_onay&id=".$id."'>Onayla</a> -";
echo " <a href='index.php'>İptal</a>";
break;

case "delete_onay": 
$id = $_GET['id'];
sqlsrv_query($con,'UPDATE firma SET gizle="1" where id="'.$id.'"');
echo '<meta http-equiv="refresh" content="0;URL=index.php">';
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
	
	<script src="/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->


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
                'serverSide': true,
                'serverMethod': 'post',
				"pageLength": 40,
                //'searching': false, // Remove default Search Control 'order': [[ 0, "desc" ]],
                'ajax': {
                    'url':'list-firma.php',
                },
				'order': [[ 2, "desc" ]],
                'columns': [
                    { data: 'check' },
					{ data: 'firma' },
					{ data: 'kayit_tarih' },
					{ data: "id" , render : function ( data, type, row, meta ) {
				return type === 'display'  ?
               '<a href="firma.php?id='+ data +'"><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i> Detay</button></a> <a href="index.php?a=update&id='+ data +'"><button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> Düzenle</button></a> <a href="index.php?a=delete&id='+ data +'"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Sil</button></a>' :
                data;
				}}
				]	
            });

        });
        </script>
		
</body>
<!-- END: Body-->

</html>