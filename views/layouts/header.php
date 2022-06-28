<?php

	if(!isset($_SESSION)) { 
		session_start();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<title>HMIS</title>
<meta charset="utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../../assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/cal/calendar-blue2.css" rel="stylesheet" type="text/css" />
<link href="../../assets/css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/cal/calendar.js"></script>
<script type="text/javascript" src="../../assets/cal/calendar-en.js"></script>
<script type="text/javascript" src="../../assets/cal/calendar-setup.js"></script>
<script type="text/javascript" src="../../assets/js/script.js"></script>

</head>
<body>
<div class="main">
  <div class="header noprint">
  
	<?php if(!isset($_SESSION["user_id"])) { ?>
	<a href="../admin/login.php" id="login" class="pull-right">
		Login 
	</a>
	<?php } else { ?>
	<a href="../../config/logout.php" id="login" class="pull-right">
		Logout
	</a>
	<?php } ?>
  
    <div class="block_header">
      <div class="logo"><a href="index.html"><img src="images/logo_1.gif" width="331" border="0" alt="logo" /></a></div>
      <div class="search">
        <form id="form1" name="form1" method="post" action="">
          <label>
            <input name="q" type="text" class="keywords" id="textfield" maxlength="50" />
            <input name="b" type="image" src="images/search.gif" class="button" />
          </label>
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
			
				<?php if(!isset($_SESSION["user_id"])) { ?>
			
				<ul class="nav navbar-nav" id="nav-top">
                	<li><a href="../../index.php">Home</a></li>
                	
                	<li><a href="../web_site/service.php">Services</a></li>
                	<li><a href="../web_site/news.php">News</a></li>
                	<li class="dropdown"><a href="#" data-toggle="dropdown">About Us <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../web_site/information.php">Information</a></li>
							<li><a href="../web_site/history.php">History</a></li>
							<li><a href="../web_site/chief_biography.php">Chief Biography</a></li>
						</ul>
					</li>
                	<li><a href="../web_site/contact_us.php">Contact Us</a></li>                	
                </ul>
				
				<?php } else { ?>
			
				<ul class="nav navbar-nav" id="nav-top">
					<li class="dropdown"><a href="#" data-toggle="dropdown">Department <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                            <li><a href="../department/department_list.php">Department List</a></li>
                        	<li><a href="../department/room_list.php">Room List</a></li>
                        	
                        </ul>                    
                    </li>
                	<li class="dropdown"><a href="#" data-toggle="dropdown">Patient <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
							
                        	<li><a href="../patient/patient_list.php">Patient List</a></li>
                        	<li><a href="../patient_test/patient_test_list.php">Patient Test</a></li>
                        	<li><a href="../patient_medicine/patient_medicine_list.php">Patient Medicine</a></li>
                        	<li><a href="../patient_surgery/patient_surgery_list.php">Patient Surgery</a></li>
                        	<li><a href="../admit/admit_list.php">Patient Admit</a></li>
                        </ul>                    
                    </li>
					<li class="dropdown"><a href="#" data-toggle="dropdown">Staff <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                        	
                            <li><a href="../staff/staff_list.php">Staff List</a></li>
                            <li><a href="../attendance/attendance_list.php">Staff Attendance</a></li>
                            <li><a href="../overtime/overtime_list.php">Staff Overtime</a></li>
                        </ul>                    
                    </li>
					<li class="dropdown"><a href="#" data-toggle="dropdown">Pharmacy <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                        	<li><a href="../medicine/medicine_list.php">Medicine List</a></li>
                        
                          
                        </ul>                    
                    </li>
					<li class="dropdown"><a href="#" data-toggle="dropdown">Laboratory <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                  
                            <li><a href="../test/test_list.php">Test List</a></li>
           
                        </ul>                    
                    </li>
					<li class="dropdown"><a href="#" data-toggle="dropdown">Surgery <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                        	
                            <li><a href="../surgery/surgery_list.php">Surgery List</a> </li>

                        </ul>                    
                    </li>
				
					<li class="dropdown"><a href="#" data-toggle="dropdown">Finance <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
            
                            <li><a href="../income/income_list.php">Income List</a></li>
                            <li><a href="../expense/expense_list.php">Expense List</a></li>
                            <li><a href="../salary/salary_list.php">Staff Salary</a></li>
                            <li><a href="../finance/report.php">Report</a></li>
                        </ul>                    
                    </li>
					<li class="dropdown"><a href="#" data-toggle="dropdown">Settings <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                        	<li><a href="../user/user_list.php">Users</a></li>
                        
                        	
   
                        </ul>                    
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown">Website <span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                        	<li><a href="../advertisement/advertisement_list.php">Advertisement</a></li>
                        	<li><a href="../history/history_list.php">History</a></li>
                        	<li><a href="../service/service_list.php">Service</a></li>
                        	<li><a href="../slide_show/slide_show_list.php">Slide show</a></li>
                        	<li><a href="../news/news_list.php">News</a></li>
        
                        </ul>                    
                    </li>
                </ul>
				<?php } ?>
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
	  
		<?php if(isset($_GET["authorize"])) { ?>
			<div class="alert alert-warning">
				You are not authorized to access the page!
			</div>
		<?php } ?>
	  
	  