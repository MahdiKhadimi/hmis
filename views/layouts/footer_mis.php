
</div>
<?php
  require_once('../../config/connection.php');
  $news = mysqli_query($con,"SELECT * FROM news ORDER BY news_id ASC LIMIT 2");
  $service = mysqli_query($con,"SELECT * FROM service ORDER BY service_id ASC LIMIT 3");
  $advertisement = mysqli_query($con,"SELECT * FROM advertisement ORDER BY advertisement_id ASC LIMIT 2");

?>

     <div class="Latest col-lg-4 col-md-4 col-sm-4 col-xs-12">
       <!-- side bar information -->
     <!-- // show samary of news   -->
     <div>
         <h2>Hot News </h2>
         <?php while($row_news=mysqli_fetch_assoc($news)){ ?>
          <h3><a href="../web_site/news.php?news_id=<?php echo $row_news['news_id'];?>"><?php echo $row_news['title'];?></a></h3>
           
           <img src="<?php echo $row_news['news_file'];?>" alt="<?php echo $row_news['title'];?>image" style="width:100%;height:200px;">
           <br>
          <?php } ?>
       </div>
       <br>
       <div>
         <h2>New Services </h2>
         <?php while($row_service=mysqli_fetch_assoc($service)){ ?>
          <h3><a href="../web_site/service.php?service_id=<?php echo $row_service['service_id'];?>"><?php echo $row_service['service_name'];?></a></h3>
           
           <img src="<?php echo $row_service['photo'];?>" alt="<?php echo $row_service['service_name'];?>image" style="width:100%;height:200px;">
           <br>
          <?php } ?>
       </div>
       <br>
       <div>
         <h2>Offer For You</h2>
         <?php while($row_advertisement=mysqli_fetch_assoc($advertisement)){ ?>
          <h3><a href="#advertisement<?php echo $row_advertisement['advertisement_id'];?>"><?php echo $row_advertisement['title'];?></a></h3>
           
           <img src="<?php echo $row_advertisement['photo'];?>" alt="<?php echo $row_advertisement['title'];?>image" style="width:100%;height:200px;">
           <br>
          <?php } ?>
       </div>
           
     </div>
    <!-- //end side bar -->

  <div class="clr"></div>
  </div>
  </div>

  

 
  <div class="FBG">
    <div class="FBG_resize">
      <div class="Testimonials col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <h2>Testimonials </h2>
        <p><em>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the. industry's standard dummy”</em></p>
        <p>&nbsp;</p>
        <p><a href="#">Mahdi Khadimi,Web Developer</a></p>
      </div>
      <div class="Company col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <h2>Company News</h2>
        <p class="data">03.12.09</p>
        <p>&nbsp;</p>
        <p>Lorem Ipsum is simply dummy text of printing and typesetting industry...</p>
        <p>&nbsp;</p>
      </div>
      <div class="Con col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <h2>Contact us</h2>
        <p><strong>Hospital And Heath Center </strong><br />
          Barchy,Kabul,Afghaniat<br />
          Telephone: +1 234 567 8910</p>
        <p>FAX: +1 234 567 8910<br />
          E-mail: <a href="#">mail@yoursitename.com</a></p>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <p>Copyright © By <a href="http://github.com/MahdiKhadimi">Mahdi Khadimi</a>. All Rights Reserved<br />
    
  </div>
</div>
</body>
</html>