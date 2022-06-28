<?php require_once("../layouts/header.php"); ?>
 
<?php
   require_once('../../config/connection.php');

  if(isset($_GET['news_id'])){
   $news_id=getValue($_GET['news_id']);
   $news = mysqli_query($con,"SELECT * FROM news WHERE  news_id=$news_id");

   $visit_number= mysqli_query($con,"SELECT visit FROM news WHERE  news_id=$news_id");
   $visit = mysqli_fetch_assoc($visit_number); 
    $visit=$visit['visit']+1;
 
   mysqli_query($con,"UPDATE news SET visit=$visit WHERE news_id=$news_id");     
  }else{
   $news = mysqli_query($con,"SELECT * FROM news  ORDER BY news_id");
  }

?>
<h2>Our newss </h2>

<?php while($row_news = mysqli_fetch_assoc($news)) { ?>
   <h3 style="font-size:18px;"><?php echo ucfirst($row_news['title']);?></h3>
 
   <p style="font-size:14px;">Number Of visited: <b> <?php echo $row_news['visit'];?></b></p>
   <div class="row" style="padding-left:20px;">
   <div>
     <a href="<?php echo $row_news['news_file'];?>">
     <img src="<?php echo $row_news['news_file'];?>" alt="news_name" style="width:100%;height:300px;">
     </a>
    </div>
    <div>
       <p style="font-size:14px;"><?php echo $row_news['description'];?></p>
    </div>
  
    </div> 
    <br>
   <?php }  if(isset($_GET['news_id'])) {?>
  
   <a href="news.php" class=" pull-right">See All newss</a>
     
   

<?php } require_once("../layouts/footer_mis.php"); ?>