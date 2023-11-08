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
											<th>Tel No</th>
											<th>Tür</th>
											<th>Kısa Kod</th>
											<th>Marka</th>
											<th>Model</th>
											<th>Renk</th>
											<th>SN</th>
											<th>IMEIL</th>
											<th>Hafıza</th>
											<th>Not</th>
											<th>İşlem</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
				
<form action="phone.php?process=new" method="post">
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
									
											<label class="form-label" for="Number">Numara</label>
											<input type="number" id="Number" class="form-control" name="number" placeholder="Number" required />

                                            <label class="form-label" for="Type">Tür</label>
                                            <select data-placeholder="Select a Tür..." name="type" class="select2-icons form-select" id="Type">
                                                    <option value="SES" data-icon="circle">SES</option>
                                                    <option value="DATA" data-icon="circle">DATA</option>
                                            </select>

											<label class="form-label" for="Short_number">Kısa Kod</label>
											<input type="text" id="Short_number" class="form-control" name="short_number" placeholder="Kısa Kod" />


											<label class="form-label" for="Brand">Marka</label>
											<input type="text" id="Brand" class="form-control" name="brand" placeholder="Marka"  />

											
                                     </div>
									 
									  <div class="col-md-6">

											<label class="form-label" for="Model">Model</label>
											<input type="text" id="Model" class="form-control" name="model" placeholder="Model"  />
											
											<label class="form-label" for="Color">Renk</label>
											<input type="text" id="Color" class="form-control" name="color" placeholder="Renk"  />

											<label class="form-label" for="Sn">SN</label>
											<input type="text" id="Sn" class="form-control" name="sn" placeholder="sn"  />
											
											<label class="form-label" for="Imeil">İmeil</label>
											<input type="text" id="Imeil" class="form-control" name="imeil" placeholder="İmeil"  />
											
											<label class="form-label" for="Memory">Hafıza</label>
											<input type="number" id="Memory" class="form-control" name="memory" placeholder="Hafıza"  />
																					
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
			
			
<form action="phone.php?process=update" method="post">
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
									
											<label class="form-label" for="Number">Numara</label>
											<input type="number" id="number" class="form-control" name="number" placeholder="Number" required />

                                            <label class="form-label" for="Type">Tür</label>
                                            <select data-placeholder="Select a Tür..." name="type" class="select2-icons form-select" id="type">
                                                    <option value="SES" data-icon="circle">SES</option>
                                                    <option value="DATA" data-icon="circle">DATA</option>
                                            </select>

											<label class="form-label" for="short_number">Kısa Kod</label>
											<input type="text" id="short_number" class="form-control" name="short_number" placeholder="Kısa Kod" />


											<label class="form-label" for="Brand">Marka</label>
											<input type="text" id="brand" class="form-control" name="brand" placeholder="Marka"  />

											
                                     </div>
									 
									  <div class="col-md-6">

											<label class="form-label" for="Model">Model</label>
											<input type="text" id="model" class="form-control" name="model" placeholder="Model"  />
											
											<label class="form-label" for="Color">Renk</label>
											<input type="text" id="color" class="form-control" name="color" placeholder="Renk"  />

											<label class="form-label" for="Sn">SN</label>
											<input type="text" id="sn" class="form-control" name="sn" placeholder="sn"  />
											
											<label class="form-label" for="Imeil">İmeil</label>
											<input type="text" id="imeil" class="form-control" name="imeil" placeholder="İmeil"  />
											
											<label class="form-label" for="Memory">Hafıza</label>
											<input type="number" id="memory" class="form-control" name="memory" placeholder="Hafıza"  />
																					
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
			
		  <form action="phone.php?process=delete" method="post">
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
$number = $_POST['number'];
$type = $_POST['type'];
$short_number = $_POST['short_number'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$color = $_POST['color'];
$sn = $_POST['sn'];
$imeil = $_POST['imeil'];
$memory = $_POST['memory'];
$nots = str_replace("'", "\'", $_POST['nots']);
if($number == ""){
echo '<meta http-equiv="refresh" content="0;URL=phone.php">';
}else{
$last_query = sqlsrv_query($con,"INSERT INTO phones (users,number,type,short_number,brand,model,color,sn,imeil,memory,nots) values ('".$users."','".$number."','".$type."','".$short_number."','".$brand."','".$model."','".$color."','".$sn."','".$imeil."','".$memory."','".$nots."')") or die( print_r( sqlsrv_errors(), true));
sqlsrv_next_result($last_query);
sqlsrv_fetch($last_query);
$process_id = sqlsrv_get_field($last_query,0);
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','insert')");
echo '<meta http-equiv="refresh" content="0;URL=phone.php?id='.$process_id.'">';
}
break;
case "update":
$id = $_POST["id"];
$users = $_POST['users'];
$number = $_POST['number'];
$type = $_POST['type'];
$short_number = $_POST['short_number'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$color = $_POST['color'];
$sn = $_POST['sn'];
$imeil = $_POST['imeil'];
$memory = $_POST['memory'];
$nots = str_replace("'", "\'", $_POST['nots']);
sqlsrv_query($con,"UPDATE phones SET users='".$users."',number='".$number."',type='".$type."',short_number='".$short_number."',brand='".$brand."',model ='".$model ."',color='".$color."',sn='".$sn."',imeil='".$imeil."',memory='".$memory."',nots='".$nots."' where id='".$id."' ");
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','update')");
echo '<meta http-equiv="refresh" content="0;URL=phone.php">';
break;
case "delete": 
$id = $_POST['id'];
sqlsrv_query($con,"UPDATE phones SET hide='1' where id='".$id."' ");
$process_id = $id;
sqlsrv_query($con,"INSERT INTO logs (user_id,module,process_id,process) values ('".$_SESSION['UserID']."','".$_SERVER['REQUEST_URI']."','".$process_id."','delete')");
echo '<meta http-equiv="refresh" content="0;URL=phone.php">';
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
                url:"class/phones_fetch.php",  
                method:"POST",  
                data:{id_data:id_data},  
                dataType:"json",  
                success:function(data){  
					 $('#id').val(data.id);
                     $('#users').val(data.users);  
					 $('#number').val(data.number);
					 $('#type').val(data.type);
					 $('#short_number').val(data.short_number);
					  $('#brand').val(data.brand);
					   $('#model').val(data.model);
					    $('#color').val(data.color);
						 $('#sn').val(data.sn);
						  $('#imeil').val(data.imeil);
						  $('#memory').val(data.memory);
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
                    'url':'class/phones.php',
                },
				'order': [[ 0, "desc" ]],
                'columns': [
					{ data: 'id' },
					{ data: 'users' },
					{ data: 'number' },
					{ data: 'type' },
					{ data: 'short_number' },
					{ data: 'brand' },
					{ data: 'model' },
					{ data: 'color' },
					{ data: 'sn' },
					{ data: 'imeil' },
					{ data: 'memory' },
					{ data: 'nots' },
					{ data: "id" , render : function ( data, type, row, meta ) {
				return type === 'display'  ? 
			  '<a type="button" id="'+ data +'" class="delete-record delete_modal">' + feather.icons['trash-2'].toSvg({ class: 'me-50' }) + 
			  '</a> <a type="button" id="'+ data +'" class="item-edit edit_modal" title="Edit">'+ feather.icons['edit'].toSvg({ class: 'me-50' }) +'</a>' + '<a target="_blank" href="print/phones.php?id='+ data +'" class="item-edit" title="Print">'+ feather.icons['printer'].toSvg({ class: 'me-50' }) +'</a>' :
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