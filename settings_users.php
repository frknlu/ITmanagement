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
    <title>Kullanıcı Yönetimi | Danet IT</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
	
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">	
	
	<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
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
                <div class="row">
                    <div class="col-12">


<?php
$adim = @$_GET["process"];
switch($adim){
case "":	/*
$empRecords = sqlsrv_query($con, "select * from users where active='1'");
$active = sqlsrv_num_rows($empRecords);
$empRecords2 = sqlsrv_query($con, "select * from users where active='0'");
$closed = sqlsrv_num_rows($empRecords2);*/
?>

					<div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75"><?php echo $active ?></h3>
                                        <span>Active Users</span>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75"><?php echo $closed ?></h3>
                                        <span>Passive Users</span>
                                    </div>
                                    <div class="avatar bg-light-warning p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-x" class="font-medium-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
		         <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table id="empTable" class="dataTable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
											<th>USERNAME</th>
											<th>AUTHORITY</th>
											<th>MODIFIED</th>
											<th>STATUS</th>
											<th>PROCESS</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

	
		 <form action="settings_users.php?process=new" method="post">
		 <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="addNewCardTitle">Create User</h1>
								
								<div class="row">

									<div class="col-md-12">
									
											<label class="form-label" for="Username">Username</label>
											<input type="text" id="Username" class="form-control" name="username" placeholder="Username" required />
											
											<label class="form-label" for="Password">Password</label>
											<input type="text" id="Password" class="form-control" name="password" placeholder="Password" required />	

											<label class="form-label" for="Status">Status</label>
											<select data-placeholder="Select a status..." name="status" class="form-select" id="Status">
													   <option value="1">Active</option>
														<option value="0">Passive</option>
											</select>

											<label class="form-label" for="Authority">Authority</label>
											<select data-placeholder="Select a Authority..." name="authority[]" class="select2 form-select" id="Authority" multiple>
												<option value="1">Ekle</option>
												<option value="2">Düzenle</option>
												<option value="3">Sil</option>
												<option value="4">Görüntüle</option>
												<option value="5">Ayarlar</option>
											</select>											
												
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
		

		 <form action="settings_users.php?process=update" method="post">
		 <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="editmodaltitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h1 class="text-center mb-1" id="editmodaltitle">Update Stop Sales</h1>
								
							<div class="row">

									<div class="col-md-12">
									
											<label class="form-label" for="Username">Username</label>
											<input type="text" id="username" class="form-control" name="username" placeholder="Username" required />
											
											<label class="form-label" for="Password">Password</label>
											<input type="text" id="password" class="form-control" name="password" placeholder="Password" />	

											<label class="form-label" for="Status">Status</label>
											<select data-placeholder="Select a status..." name="status" class="form-select" id="status">
													<option value="1">Active</option>
													<option value="0">Passive</option>
											</select>

											<label class="form-label" for="Authority">Authority</label>
											<select data-placeholder="Select a Authority..." name="authority[]" class="select2 form-select" id="authority" multiple>
												<option value="1">Ekle</option>
												<option value="2">Düzenle</option>
												<option value="3">Sil</option>
												<option value="4">Görüntüle</option>
												<option value="5">Ayarlar</option>
											</select>											
												
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
			
			
		  <form action="settings_users.php?process=delete" method="post">
			 <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deletemodaltitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <div class="col-12 text-center">
									<h1 class="text-center" id="deletemodaltitle">ID: <b id="id_delete_show"></b> Are you sure you want to close this account?</h1>
                                        <button type="submit" class="btn btn-danger me-1 mt-1">Close Account</button>
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
			
		  <form action="settings_users.php?process=active" method="post">
			 <div class="modal fade" id="active_modal" tabindex="-1" aria-labelledby="activemodaltitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <div class="col-12 text-center">
									<h1 class="text-center" id="activemodaltitle">ID: <b id="id_active_show"></b> Are you sure you want to active this account?</h1>
                                        <button type="submit" class="btn btn-success me-1 mt-1">Active Account</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="id" id="id_active" required />
			</form>			
			
<?php
break;

case "new": 
$username = str_replace("'", "\'", $_POST['username']);
$authority = implode(",", $_POST['authority']);
$active = $_POST['status'];
$password = hash('sha256', $_POST['password']);
if($username == ""){
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
}else{
$last_query = sqlsrv_query($con,"INSERT INTO users (nickname,authority,active,password) values ('$username','$authority','$active','$password') ");
sqlsrv_next_result($last_query);
sqlsrv_fetch($last_query);
$process_id = sqlsrv_get_field($last_query,0);
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','insert')");
}
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
break;

case "update": 
$id = $_POST['id'];
$username = str_replace("'", "\'", $_POST['username']);
$authority = implode(",", $_POST['authority']);
$active = $_POST['status'];
$password = $_POST['password'];
if($username == ""){
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
}else{
if($password == ""){
sqlsrv_query($con,"UPDATE users SET nickname='".$username."',authority='".$authority."',active='".$active."' where id='".$id."' ");	
}
else{
$password = hash('sha256', $password);
sqlsrv_query($con,"UPDATE users SET nickname='".$username."',authority='".$authority."',active='".$active."',password='".$password."' where id='".$id."' ");	
}
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','update')");
}
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
break;

case "delete": 
$id = $_POST['id'];
sqlsrv_query($con,'UPDATE users SET active="0" where id="'.$id.'"');
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','passive')");
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
break;

case "active": 
$id = $_POST['id'];
sqlsrv_query($con,'UPDATE users SET active="1" where id="'.$id.'"');
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','active')");
echo '<meta http-equiv="refresh" content="0;URL=settings_users.php">';
break;
}
	?>

                    </div>
                </div>

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
	
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>	

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
	
	<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
	<script src="../../../app-assets/js/scripts/forms/form-select2.js"></script>
	
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
                url:"class/settings_users_fetch.php",  
                method:"POST",  
                data:{id_data:id_data},  
                dataType:"json",  
                success:function(data){  
					 $('#id').val(data.id);
                     $('#username').val(data.nickname);  
					 $('#status').val(data.active);  
					 var authority_data = data.authority;
					 authority_split = authority_data.split(',');
					 $('#authority').val(authority_split);
					 $('#authority').select2().trigger('change');
                     $('#edit_modal').modal('show'); 
                }  
           });  
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
                    'url':'class/settings_users.php',
                },
				'order': [[ 0, "desc" ]],
				'columns': [
                    { data: 'id' },
					{ data: 'username' },
					{ data: 'authority' },
					{ data: 'modified' },
					{ data: 'active' },
					{ data: "id" , render : function ( data, type, row, meta ) {
				return type === 'display'  ? 
			  '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown" title="Process">' + feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) + '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a type="button" id="'+ data +'" class="dropdown-item delete-record delete_modal">' + feather.icons['user-x'].toSvg({ class: 'me-50' }) +
              'Closed Account</a>' +
			  '<a type="button" id="'+ data +'" class="dropdown-item delete-record active_modal">' + feather.icons['user-check'].toSvg({ class: 'me-50' }) +
              'Active Account</a>' +
              '</div>' +
              '</div> <a type="button" id="'+ data +'" class="item-edit edit_modal" title="Edit">'+ feather.icons['edit'].toSvg({ class: 'me-50' }) +'</a>' :
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