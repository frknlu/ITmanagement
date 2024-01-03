<?php
include("../inc/config.php");

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
} 

?>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	
	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
	

	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
     
	 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

	 
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	   
	    <style>
  table {
	  font-size:12px;
  }

  p {
	  font-size:14px;
  }
  
  @media only screen and (max-width: 600px) {
	    .mleft{
	  float:left!important;
  }
	  
  }
  
@media print {
   a[href]:after {
      display: none;
      visibility: hidden;
   }
}

table{border:1px solid #ccc;border-collapse:collapse;margin:0;padding:0;width:100%;table-layout:fixed}table caption{font-size:1.5em;margin:.5em 0 .75em}table tr{border:1px solid #ddd;padding:.35em}table td,table th{padding:.625em;text-align:center}table th{font-size:.85em;letter-spacing:.1em;text-transform:uppercase}@media screen and (max-width:600px){table{border:0}table caption{font-size:1.3em}table thead{border:none;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}table tr{border-bottom:3px solid #ddd;display:block;margin-bottom:.625em}table td{border-bottom:1px solid #ddd;display:block;font-size:.8em;text-align:right}table td::before{content:attr(data-label);float:left;font-weight:700;text-transform:uppercase}table td:last-child{border-bottom:0}}


  </style>
</head>
<body id="body" style="font-family: serif!important;">

<div> <!-- class="container" style="max-width:2480;max-height:3508;" bis_skin_checked="1" -->
<div id="printarea">
      <div class="">
	   <div style="margin-top:10px;"> <!-- width: 555px;margin-left: 20; -->

        <div class="row">
          <div class="col"></div>
          <div class="col" style="float:right;text-align: right;"><?php echo date("d/m/Y"); ?></div>
        </div>



<?php
$inventory_query = sqlsrv_query($con, "select * from inventory WHERE id='".$_GET["id"]."'");
$inventory_row = sqlsrv_fetch_array($inventory_query);

$users_query = sqlsrv_query($con, "select * from employee WHERE id='".$inventory_row["users"]."'");
$users_row = sqlsrv_fetch_array($users_query);
?>
        <div class="row mx-1" style="margin-bottom:-10px;">
          <div style="float:left;width:100%;">
		    <p style="font-size: 14px; color: black; font-weight: bold;">Kullanıcı: <?php echo $firma_row["firma"]; ?></p>
          </div>
        </div>
        <div class="row mx-1 justify-content-center">
          <table>
		  
		  
            <thead></thead>


			<tbody><tr>
			<td data-label="">		
<?php
$print_query = sqlsrv_query($con, "select * from prints WHERE id='1'");
$print_row = sqlsrv_fetch_array($print_query);
echo $print_row["text"];
?>			
			</td>
			</tr></tbody>

			
          </table>
        </div>

        <div class="row">
          <div class="col">
         
          </div>
          <div class="col-md-4" style="float:right;">
		  
          </div>
        </div>

<div class="row" style="margin-top:10px;text-align:center;font-size:14px;">

<div class="col">
<p>Teslim Alan</p>
<p><?php echo $_POST["alan_unvan"]; if($_POST["alan_unvan"]==""){}else{ echo "<br>"; } ?> <?php echo $_POST["alan_ad"]; ?></p>
</div>

<div class="col">
<p>Teslim Eden</p>
<p><?php echo $_POST["teslim_unvan"]; if($_POST["teslim_unvan"]==""){}else{ echo "<br>"; } ?> <?php echo $_POST["teslim_ad"]; ?></p>
</div>

</div>




</div>
</div>  
</div>
</div>
 
 
 
 
<script>
window.print()
/*
 var pdf = new jsPDF('2', 'pt'); //[1170, 1800]

        window.html2canvas = html2canvas;
		
            pdf.html(document.getElementById('printarea'), {
                callback: function (pdf) {
                    pdf.save(<?php echo "'".$_GET["id"];?>.pdf');
                }
            });
 /*     

  setTimeout(function() {
      window.close()
  }, 1000);
  
  
*/  
</script>
</body>
</html>
