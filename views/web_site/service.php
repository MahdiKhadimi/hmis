<?php require_once("../layouts/header.php"); ?>
 
<?php
   require_once('../../config/connection.php');
   $condition = "";
   if(isset($_GET['q'])){
      $search = getValue($_GET['q']);
      $condition="WHERE service_name LIKE '%$search%'";
   }
  if(isset($_GET['service_id'])){
   $service_id=getValue($_GET['service_id']);
   $service = mysqli_query($con,"SELECT * FROM service WHERE  service_id=$service_id");      
  }else{
   $service = mysqli_query($con,"SELECT * FROM service $condition ORDER BY service_name");
  }

?>
<h2>Our Services </h2>

<?php while($row_service = mysqli_fetch_assoc($service)) { ?>
   <h3 style="font-size:18px;"><?php echo ucfirst($row_service['service_name']);?></h3>
   <p style="font-size:16px;">Time: <i><?php echo $row_service['timing'];?></i></p>
   <p style="font-size:14px;">Price: <b><?php echo number_format($row_service['amount']);?> <?php echo $row_service['currency'];?></b></p>
   <div class="row">
   <div class="col-md-6">
     <a href="<?php echo $row_service['photo'];?>">
     <img src="<?php echo $row_service['photo'];?>" alt="service_name" style="width:100%">
     </a>
    </div>
    <div class="col-md-6">
       <p style="font-size:14px;"><?php echo $row_service['description'];?></p>
    </div>
  
    </div> 
    <br>
   <?php }  if(isset($_GET['service_id'])) {?>
  
   <a href="service.php" class=" pull-right">See All Services</a>
     
   

<?php } require_once("../layouts/footer_mis.php"); ?>