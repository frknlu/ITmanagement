<?php
include("inc/config.php");
error_reporting(0);

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
} 

	$result = mysqli_query($con,"SELECT * FROM settings");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


	$hash = mysqli_real_escape_string($con,$_GET["id"]);
	
    $resultstock=mysqli_query($con,"SELECT * FROM product");
    $value = mysqli_fetch_array($resultstock,MYSQLI_ASSOC);



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
      <div class="container">
	   <div style="margin-top:10px;"> <!-- width: 555px;margin-left: 20; -->

        <div class="row">
          <div class="col"></div>
          <div class="col" style="float:right;text-align: right;"><?php echo date("d/m/Y"); ?></div>
        </div>



<?php


$firma_list = $_POST['firma_list'];

foreach($firma_list as $firma_list_id)
{
 
$try_tutar = 0;
$usd_tutar = 0;
$euro_tutar	= 0;
$gbp_tutar	= 0;

 
$firma_id = $firma_list_id;
$firma_query = mysqli_query($con, "select * from firma WHERE id='".$firma_id."'");
$firma_row = mysqli_fetch_assoc($firma_query);
$empRecords = mysqli_query($con, "select * from veri WHERE hash='".$firma_row["id"]."'");
?>
        <div class="row mx-1" style="margin-bottom:-10px;">
          <div style="float:left;width:100%;">
		    <p style="font-size: 14px; color: black; font-weight: bold;">Firma Adı: <?php echo $firma_row["firma"]; ?></p>
          </div>
        </div>
        <div class="row mx-1 justify-content-center">
          <table>
            <thead style="background-color:#84B0CA ;" class="">
              <tr>
			    <th scope="col">Teslim Alma Tarihi</th>
                <th scope="co">Vade Tarihi</th>
				<th scope="col">Tür</th>
                <th scope="col">Tutar</th>
              </tr>
            </thead>
			  <?php
	while ($veri_row = mysqli_fetch_assoc($empRecords)) {
	
	$vade_tarih1 = $veri_row['vade_tarih'];
	if($vade_tarih1 == "0000-00-00"){
		$vade_tarih = "";
	}
	else{
		$vade_tarih = date('d-m-Y', strtotime($veri_row['vade_tarih']));
	}
	
	if($veri_row['doviz'] == "try"){
		$try_tutar = $try_tutar + $veri_row['tutar'];
	}else if($veri_row['doviz'] == "usd"){
		$usd_tutar = $usd_tutar + $veri_row['tutar'];
	}else if($veri_row['doviz'] == "euro"){
		$euro_tutar = $euro_tutar + $veri_row['tutar'];
	}else if($veri_row['doviz'] == "gbp"){
		$gbp_tutar = $gbp_tutar + $veri_row['tutar'];
	}
	else{}

		echo "<tbody><tr>";
		echo '<td data-label="Teslim Alma Tarihi"> '.date('d-m-Y', strtotime($veri_row['teslim_alma_tarih'])).' </td>';
		echo '<td data-label="Vade Tarihi">'.$vade_tarih."</td>";
		echo '<td data-label="Tür">'.$veri_row['tur']."</td>";
		echo '<td data-label="Tutar">'.number_format($veri_row['tutar'], 2, ',', '.')." ".strtoupper($veri_row['doviz'])." </td>";
		echo "</tr></tbody>";
		
		
			  }
			
		echo "<tfoot><tr>";
		echo '<td colspan="3">'.$firma_row["note"].'</td>';
		echo '<td data-label="Genel Toplam">Toplam Tutar<BR>';
		if($try_tutar != 0){
		echo '(TRY: '.number_format($try_tutar, 2, ',', '.').')<BR>';
		}
		if($usd_tutar != 0){
		echo '(USD: '.number_format($usd_tutar, 2, ',', '.').')<BR>';
		}
		if($euro_tutar != 0){
		echo '(EUR: '.number_format($euro_tutar, 2, ',', '.').')<BR>';
		}
		if($gbp_tutar != 0){
		echo '(GBP: '.number_format($gbp_tutar, 2, ',', '.').')';
		}		
		/*echo '
		(TRY: '.number_format($try_tutar, 2, ',', '.').')<BR> 
		(USD: '.number_format($usd_tutar, 2, ',', '.').')<BR> 
		(EUR: '.number_format($euro_tutar, 2, ',', '.').')<BR> 
		(GBP: '.number_format($gbp_tutar, 2, ',', '.').') 
		</td>';*/
		echo "</td></tr></tfoot>";
		
			?>
          </table>
        </div>

        <div class="row">
          <div class="col">
         
          </div>
          <div class="col-md-4" style="float:right;">
		  
          </div>
        </div>
	
<?php
}
//dongu son
?>




	
		
<div class="row" style="margin-top:10px;text-align:center;font-size:14px;">
<div class="col">
<p>Teslim Eden</p>
<p><?php echo $_POST["teslim_unvan"]; if($_POST["teslim_unvan"]==""){}else{ echo "<br>"; } ?> <?php echo $_POST["teslim_ad"]; ?></p>
</div>
<div class="col">
<p>Teslim Alan</p>
<p><?php echo $_POST["alan_unvan"]; if($_POST["alan_unvan"]==""){}else{ echo "<br>"; } ?> <?php echo $_POST["alan_ad"]; ?></p>
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
