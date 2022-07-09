
<?php require_once("views/web_layout/header.php"); ?>
  <?php
  
    require_once('config/connection.php');
   // list all services 
   $condition = "";
   if(isset($_GET['q'])){

     if($_GET['q']!="All Services"){
     $search = getValue($_GET['q']);
       
     }else{
       $condition = "";

     }
     $condition = "WHERE service_name LIKE '%$search%'";

   }
   $service = mysqli_query($con,"SELECT * FROM service $condition ORDER BY service_name LIMIT 2 ");
   
   // getting data from slide show table 
   $slide_show = mysqli_query($con,"SELECT * FROM slide_show");
   $min = mysqli_query($con,"SELECT MIN(slide_show_id) as min FROM slide_show ");
   $row_min = mysqli_fetch_assoc($min); 
   
   //getting data from advertisement table 
   $date = date("Y-m-d");

  $advertisement = mysqli_query($con,"SELECT * FROM advertisement WHERE start_date >=$date AND end_date>=$date ORDER BY advertisement_id ASC"); 
  
  ?>
  <!-- start slide show  -->
 <div class="row">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  <?php while($row_slide_show=mysqli_fetch_assoc($slide_show)) { ?>  
     <div class="item <?php if($row_slide_show['slide_show_id']==$row_min['min']) { echo "active";} ?>">
      <img src="..<?php echo $row_slide_show['photo'];?>" alt="<?php echo $row_slide_show['title'];?>">
      <div class="carousel-caption">
        <h3 style="color:white;"><?php echo ucfirst($row_slide_show['title']);?></h3>
        <p style="color:white;"><?php echo $row_slide_show['description'];?></p>
      </div>
    </div>
    
<?php } ?>
  </div>    
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
 </div>

</div>
  <!--end slide show  -->
        <h2>Our Services </h2>

        <?php while($row_service = mysqli_fetch_assoc($service)) { ?>
           <h3 style="font-size:18px;"><?php echo ucfirst($row_service['service_name']);?></h3>
           <p style="font-size:16px;">Time: <i><?php echo $row_service['timing'];?></i></p>
           <p style="font-size:14px;">Price: <b><?php echo number_format($row_service['amount']);?> <?php echo $row_service['currency'];?></b></p>
           <div class="row">
           <div class="col-md-6">
             <a href="..<?php echo $row_service['photo'];?>">
             <img src="..<?php echo $row_service['photo'];?>" alt="service_name" style="width:100%">
             </a>
            </div>
            <div class="col-md-6">
               <p style="font-size:14px;"><?php echo $row_service['description'];?></p>
            </div>
          
            </div> 
            <br>
           <?php } ?>
           <a href="views/web_site/service.php" class=" pull-right">See All Services</a>

 <!-- show all advertisement -->
  <h2>Offering </h2>
  <?php while($row_advertisement = mysqli_fetch_assoc($advertisement)) { ?>
   <h3 style="font-size:18px;" id="advertisement<?php echo $row_advertisement['advertisement_id']?>"><?php echo ucfirst($row_advertisement['title']);?></h3>
   <p style="font-size:16px;">Visit: <i><?php echo $row_advertisement['url'];?></i></p>
  
   <div >
   <div >
     <a href="..<?php echo $row_advertisement['photo'];?>">
     <img src="..<?php echo $row_advertisement['photo'];?>" alt="service_name" style="width:100%;max-height:300px;">
     </a>
    </div>
    <div >
       <p style="font-size:14px;"><?php echo $row_advertisement['description'];?></p>
    </div>
  
    </div> 
    <br>
   <?php } ?>
<?php require_once("views/web_layout/footer_website.php"); ?>
