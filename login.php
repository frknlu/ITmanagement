<?php
include("inc/config.php");
ob_start();
session_start();

if ( $_SESSION['Oturum'] == 'true' ) { 
 header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Danet IT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

	  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
  
  <link rel="stylesheet" href="<?php echo $wurl; ?>/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="form">
    <!--login form start-->
    <form class="login-form" action="login_auth.php" method="post">
      <img src="app-assets/images/danet.png"  style="height: 150px;"/>
	   <div class="options-02" style="margin-top: 10px;margin-bottom: 20px;font-size: 19px;font-weight: bold;color: red;"> <?php echo @$_GET["msg"]; ?></div>
      <input class="user-input" type="text" name="nickname" value="" placeholder="Kullanıcı Kodu" required autocomplete>
      <input class="user-input" type="password" name="pass" placeholder="Şifre" required autocomplete>
      <div class="options-01">
        <label class="remember-me"><input type="checkbox" name="remember-me" checked>Beni Hatırla</label>
        <a href="#"></a>
      </div>
      <input class="btn" type="submit" value="GİRİŞ YAP">
     
    </form>
    <!--login form end-->
    <br>
	
  </div>

  <!--
  	 <a class="b-btn" target="blank" href="">
	 <img src="" title="Furkan ÜNLÜ" alt="Furkan ÜNLÜ" style="height: 50px;position: fixed;bottom: 0px;left: 0px;padding: 10px 10px;"/>
	 </a>
 -->
	 
</body>
</html>
