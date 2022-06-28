  <?php
     require_once('config/connection.php');
	if(!isset($_SESSION)) { 
		session_start();
	}

	$service = mysqli_query($con,"SELECT * FROM service ");
?>
<!DOCTYPE html>
<html>
<head>
<title>HMIS</title>
<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="assets/cal/calendar-blue2.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/cal/calendar.js"></script>
<script type="text/javascript" src="assets/cal/calendar-en.js"></script>
<script type="text/javascript" src="assets/cal/calendar-setup.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>

</head>
<body>
<div class="main">
  <div class="header noprint">
  
	<?php if(!isset($_SESSION["user_id"])) { ?>
	<a href="views/admin/login.php" id="login" class="pull-right">
		Login 
	</a>
	<?php } else { ?>
	<a href="config/logout.php" id="login" class="pull-right">
		Logout
	</a>
	<?php } ?>
  
    <div class="block_header">
      <div class="logo"><a href="index.html"><img src="images/logo_1.gif" width="331" border="0" alt="logo" /></a></div>

 </div>
 <br>
 <div class="col-md-4">
 <form method="get">

	<div class="input-group">
		<span class="input-group-addon">
			Search:
		</span>
		<input type="text" name="q" autocomplete="off" class="form-control" list="service_list">
		<datalist id="service_list">
           	<?php while($row_service=mysqli_fetch_assoc($service)) { ?>
				<option value="<?php echo $row_service['service_name'];?>"/>
			<?php } ?>
			<option value="All Services">

		</datalist>
		<span class="input-group-btn">
			<button class="btn btn-primary">
				<span style="color:white;" class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
</form>

</div>
      <div class="clr"></div>
      <div class="resize_menu">
        <div class="">
          
		 <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
			
				<ul class="nav navbar-nav" id="nav-top">
                	<li><a href="index.php">Home</a></li>
                	<li><a href="views/web_site/service.php">Services</a></li>
                	<li><a href="views/web_site/news.php">News</a></li>
                
                	<li class="dropdown"><a href="#" data-toggle="dropdown">About Us <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Information</a></li>
							<li><a href="#">History</a></li>
							<li><a href="#">Cheif Biography</a></li>
						</ul>
					</li>
                	<li><a href="index.php">Contact Us</a></li>                	
                </ul>
				
		
			
			
            </div>  
        </nav>
		  
        </div>
        
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="main_body_resize">
    <div class="main_body">
      <div class="clr"></div>
    </div>
  </div>
  <div class="body_resize">
    <div class="body">
      <div class="Welcome col-lg-8 col-md-8 col-sm-8 col-xs-12">
	  
	
	  
	  