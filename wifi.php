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
    <title>Wireless | Danet IT</title>
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
$adim = @$_GET["process"];
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
											<th>Marka</th>
											<th>Model</th>
											<th>SN</th>
											<th>IP</th>
											<th>MAC</th>
											<th>Firmware</th>
											<th>Yeri</th>
											<th>Not</th>
											<th>İşlem</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
				
<form action="wifi.php?process=new" method="post">
		 <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Yeni Kayıt</h1>
								
								<div class="row">

									<div class="col-md-6">
									
											<label class="form-label" for="Users">Kullanıcı</label>
											<select data-placeholder="Select a users..." name="users" class="form-select" id="Users">
											<option value="">Kullanıcı Yok</option>
											<?php 
												$departmanet_query = sqlsrv_query($con,"SELECT * FROM employee where hide='0'");
												while($departmanet_row = sqlsrv_fetch_array($departmanet_query)){
													echo '<option value="'.$departmanet_row["id"].'">'.$departmanet_row["name"].'</option>';
												}									
											?>
											</select>									

											<label class="form-label" for="Name">Cihaz Adı</label>
											<input type="text" id="Device_name" class="form-control" name="device_name" placeholder="Cihaz Adı" required />
											
											<label class="form-label" for="Brand">Marka</label>
											<input type="text" id="Brand" class="form-control" name="brand" placeholder="Marka"/>

											<label class="form-label" for="Model">Model</label>
											<input type="text" id="Model" class="form-control" name="model" placeholder="Model"/>

											<label class="form-label" for="Sn">SN</label>
											<input type="text" id="Sn" class="form-control" name="sn" placeholder="Sn"/>
											
                                     </div>
									 
									  <div class="col-md-6">

											<label class="form-label" for="Ip">IP</label>
											<input type="text" id="Ip" class="form-control" name="ip" placeholder="IP"/>
											
											<label class="form-label" for="Mac">MAC</label>
											<input type="text" id="Mac" class="form-control" name="mac" placeholder="MAC"/>
											
											<label class="form-label" for="Location">Yeri</label>
											<input type="text" id="Location" class="form-control" name="location" placeholder="Yeri"/>

											<label class="form-label" for="Firmware">Firmware</label>
											<input type="text" id="Firmware" class="form-control" name="firmware" placeholder="Firmware"/>

                                    </div>
							
											<div class="mb-1">
													<label class="form-label" for="Not">Not</label>
													<textarea name="nots" class="form-control" id="Nots" rows="2" placeholder="Not"></textarea>
											</div>
							
								</div>
	
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Create</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
			</form>		
			
			
<form action="wifi.php?process=update" method="post">
		 <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="editmodaltitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Update</h1>
								
								<div class="row">

									<div class="col-md-6">
									
											<label class="form-label" for="Users">Kullanıcı</label>
											<select data-placeholder="Select a users..." name="users" class="form-select" id="users">
											<option value="">Kullanıcı Yok</option>
											<?php 
												$departmanet_query = sqlsrv_query($con,"SELECT * FROM employee where hide='0'");
												while($departmanet_row = sqlsrv_fetch_array($departmanet_query)){
													echo '<option value="'.$departmanet_row["id"].'">'.$departmanet_row["name"].'</option>';
												}									
											?>
											</select>									

											<label class="form-label" for="Name">Cihaz Adı</label>
											<input type="text" id="device_name" class="form-control" name="device_name" placeholder="Cihaz Adı" required />
											
											<label class="form-label" for="Brand">Marka</label>
											<input type="text" id="brand" class="form-control" name="brand" placeholder="Marka"/>

											<label class="form-label" for="Model">Model</label>
											<input type="text" id="model" class="form-control" name="model" placeholder="Model"/>

											<label class="form-label" for="Sn">SN</label>
											<input type="text" id="sn" class="form-control" name="sn" placeholder="Sn"/>
											
                                     </div>
									 
									  <div class="col-md-6">

											<label class="form-label" for="Ip">IP</label>
											<input type="text" id="ip" class="form-control" name="ip" placeholder="IP"/>
											
											<label class="form-label" for="Mac">MAC</label>
											<input type="text" id="mac" class="form-control" name="mac" placeholder="MAC"/>
											
											<label class="form-label" for="location">Yeri</label>
											<input type="text" id="location" class="form-control" name="location" placeholder="Yeri"/>

											<label class="form-label" for="firmware">Firmware</label>
											<input type="text" id="firmware" class="form-control" name="firmware" placeholder="Firmware"/>
                                    </div>
							
											<div class="mb-1">
													<label class="form-label" for="Not">Not</label>
													<textarea name="nots" class="form-control" id="nots" rows="2" placeholder="Not"></textarea>
											</div>
							
								</div>
	
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Update</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="id" id="id" required />
			</form>				
			
		  <form action="wifi.php?process=delete" method="post">
			 <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deletemodaltitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <div class="col-12 text-center">
									<h1 class="text-center" id="deletemodaltitle">ID: <b id="id_delete_show"></b> Are you sure you want to delete this item?</h1>
                                        <button type="submit" class="btn btn-danger me-1 mt-1">Delete</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="id" id="id_delete" required />
			</form>			
			
			
<?php
break;
case "new": 
$users = $_POST['users'];
$device_name = $_POST['device_name'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$sn = $_POST['sn'];
$ip = $_POST['ip'];
$mac = $_POST['mac'];
$location = $_POST['location'];
$firmware = $_POST['firmware'];
$nots = str_replace("'", "\'", $_POST['nots']);
if($device_name == ""){
echo '<meta http-equiv="refresh" content="0;URL=wifi.php">';
}else{
$last_query = sqlsrv_query($con,"INSERT INTO inventory (users,device_name,brand,model,sn,ip,mac,location,firmware,nots,data_type) values ('".$users."','".$device_name."','".$brand."','".$model."','".$sn."','".$ip."','".$mac."','".$location."','".$firmware."','".$nots."','7')") or die( print_r( sqlsrv_errors(), true));
sqlsrv_next_result($last_query);
sqlsrv_fetch($last_query);
$process_id = sqlsrv_get_field($last_query,0);
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','insert')");
echo '<meta http-equiv="refresh" content="0;URL=wifi.php?id='.$process_id.'">';
}
break;
case "update":
$id = $_POST["id"];
$users = $_POST['users'];
$device_name = $_POST['device_name'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$sn = $_POST['sn'];
$ip = $_POST['ip'];
$mac = $_POST['mac'];
$location = $_POST['location'];
$firmware = $_POST['firmware'];
$nots = str_replace("'", "\'", $_POST['nots']);
sqlsrv_query($con,"UPDATE inventory SET users='".$users."',device_name='".$device_name."',brand='".$brand."',model ='".$model ."',ip='".$ip."',sn='".$sn."',mac='".$mac."',location='".$location."',firmware='".$firmware."',nots='".$nots."' where id='".$id."' ");
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','update')");
echo '<meta http-equiv="refresh" content="0;URL=wifi.php">';
break;
case "delete": 
$id = $_POST['id'];
sqlsrv_query($con,"UPDATE inventory SET hide='1' where id='".$id."' ");
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','delete')");
echo '<meta http-equiv="refresh" content="0;URL=wifi.php">';
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
	      $(document).on('click', '.edit_modal', function(){  
           var id_data = $(this).attr("id");  
           $.ajax({  
                url:"class/wifi_fetch.php",  
                method:"POST",  
                data:{id_data:id_data},  
                dataType:"json",  
                success:function(data){  
					 $('#id').val(data.id);
                     $('#users').val(data.users);  
					 $('#device_name').val(data.device_name);
					  $('#brand').val(data.brand);
					   $('#model').val(data.model);
					    $('#ip').val(data.ip);
						 $('#sn').val(data.sn);
						  $('#mac').val(data.mac);
						  $('#location').val(data.location);
						  $('#firmware').val(data.firmware);
						  $('#nots').val(data.nots);
                     $('#edit_modal').modal('show');  
                }  
           });  
		 });
		 
	  $(document).on('click', '.delete_modal', function(){  
           var id_data = $(this).attr("id");  
		   $('#id_delete').val(id_data);
		   $('#id_delete_show').text(id_data); 
		   $('#delete_modal').modal('show'); 
      });
	  
	 });  
	</script>
<script>
        $(document).ready(function(){
            var dataTable = $('#empTable').DataTable({
                'processing': true,
                'serverSide': false,
                'serverMethod': 'post',
				"pageLength": 25,
                'ajax': {
                    'url':'class/wifi.php',
                },
				'order': [[ 0, "desc" ]],
                'columns': [
					{ data: 'id' },
					{ data: 'users' },
					{ data: 'device_name' },
					{ data: 'brand' },
					{ data: 'model' },
					{ data: 'sn' },
					{ data: 'ip' },
					{ data: 'mac' },
					{ data: 'firmware' },
					{ data: 'location' },
					{ data: 'nots' },
					{ data: "id" , render : function ( data, type, row, meta ) {
				return type === 'display'  ? 
			  '<a type="button" id="'+ data +'" class="delete-record delete_modal">' + feather.icons['trash-2'].toSvg({ class: 'me-50' }) + 
			  '</a> <a type="button" id="'+ data +'" class="item-edit edit_modal" title="Edit">'+ feather.icons['edit'].toSvg({ class: 'me-50' }) +'</a>' + '<a target="_blank" href="print/wifi.php?id='+ data +'" class="item-edit" title="Print">'+ feather.icons['printer'].toSvg({ class: 'me-50' }) +'</a>' :
                data;
				}}
				],
				dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				buttons: [
			
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },	
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