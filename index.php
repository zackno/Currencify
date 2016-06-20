<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head><title>Keep Track of Currency</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700,900">
    <link type="text/css" rel="stylesheet" href="assets/font/font-icon/font-awesome-4.4.0/css/font-awesome.css">
    <!-- Library css-->
    <link type="text/css" rel="stylesheet" href="assets/libs/bootstrap-3.3.6/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/animate/animate.css">
 
    <!-- style css-->
    <link type="text/css" rel="stylesheet" href="assets/css/layout.css">
    <link type="text/css" rel="stylesheet" href="assets/css/components.css">
    <link type="text/css" rel="stylesheet" href="assets/css/responsive.css">
    
    <!-- LOADING SCRIPTS FOR PAGE--></head>
<body><!-- HEADER-->
<header>

</header>
<!-- WRAPPER-->

<?php
require_once("common/config.php");
require_once("common/define.php");
include ("module/update_user.php");
?>
<div id="wrapper-content"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="section">
                    <div class="banner-02 bg-overlay banner-full-screen">
                        <div class="banner-02-wrapper">
                            <div class="container">							
								<form class="form-inline" action="" method="post">
									<div class="wrapper-title"><h2 class="title">Best place to track a currency</h2><h4 class="sub-title">just tell us your criteria</h4></div>
									<div class="content"><p class="text">      </p></div>
									<div class="select buttons">
									Notify me when
										<select id="target_currency" class="form-control" name="target_currency">
										  <option value="USD">Dollar</option>
										  <option value="EUR">Euro</option>
										</select>
									gets 
										<select id="comparison_category" class="form-control" name="compare_type">
										  <option value="lower">lower than</option>
										  <option value="higher">higer than</option>
										</select>
									<span id="lower_option">
									than 
										<input class="form-control" placeholder="2,89" name="rate"></input>
									tl
									</span>
									</div>
									
									
									   <div class="select buttons">
										  <input type="email" class="form-control" placeholder="Email" name="mail" />
										</div>
	
									<button type="submit" class="btn btn-primary">Next</button>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
				
                        </div>
                    </div>
<!-- FOOTER-->    </div>
</div>



<script type='text/javascript' charset='utf-8' src='popbox.js'></script>
        <link rel='stylesheet' href='popbox.css' type='text/css'>

        <div class='popbox'>
          <div class='collapse'>
            <div class='box'>
              <div class='arrow'></div>
              <div class='arrow-border'></div>
              Content in PopBox goes here :)
              <a href="#" class="close">close</a>
            </div>
          </div>
        </div>






<footer>
</footer>
<!--.body-2.loading<div class="dots-loader"></div>--><!-- JAVASCRIPT LIBS-->
<script src="assets/libs/jquery/jquery-2.1.4.min.js"></script>
<script src="assets/libs/bootstrap-3.3.6/js/bootstrap.min.js"></script>
<script src="main.js"></script>



<!-- MAIN JS-->
<script src="assets/js/main.js"></script>
<!-- LOADING SCRIPTS FOR PAGE--></body>
</html>