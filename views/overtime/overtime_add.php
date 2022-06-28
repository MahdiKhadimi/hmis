<?php require_once("../../config/connection.php"); ?>
<?php

    $staff = mysqli_query($con,"SELECT * FROM staff");

	
	
	if(isset($_POST["staff_id"])) {
		$staff_id = getValue($_POST["staff_id"]);
		$staff_id=explode("-",$staff_id);
		$staff_id=$staff_id[0];

		$overtime_year = getValue($_POST["overtime_year"]);
		$overtime_month = getValue($_POST["overtime_month"]);
		$overtime_day = getValue($_POST["overtime_day"]);
		$overtime_hour = getValue($_POST["overtime_hour"]);
	
	
		$result = mysqli_query($con, "INSERT INTO overtime VALUES ( $staff_id,'$overtime_year','$overtime_month','$overtime_day','$overtime_hour')");
		
		if($result) {
			header("location:overtime_list.php?add=done");
		}
		else {
			header("location:overtime_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New overtime</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new overtime!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 staff:
				</span>
				<input type="text" list="staff" class="form-control" name="staff_id">
				<datalist id="staff">
					<?php while($row_staff=mysqli_fetch_assoc($staff) ) { ?>
					
						<option value="<?php echo $row_staff['staff_id']; ?>-<?php echo $row_staff['firstname'];?> <?php echo $row_staff['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		  </div>
			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Year:
				</span>
				<select name="overtime_year" id="" class="form-control">
					<?php $current_year=date('Y'); for($i=$current_year; $i>=$current_year-4;$i--) { ?>
					  <option ><?php echo $i;?></option>
					<?php } ?>  
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Month:
				</span>
				<select name="overtime_month" id="" class="form-control">
				      <?php for($i=1;$i<=12;$i++) {  ?>
						<option <?php if($i==date('m')) {echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>	
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Day:
				</span>
				<select name="overtime_day" id="" class="form-control">
					<?php for($i=1;$i<=30;$i++) { ?>
					  <option <?php if($i==date('d') ){ echo "selected";}?> ><?php echo $i;?></option>
					<?php } ?>    
				</select>
			</div>
	
			
			<div class="input-group">
				<span class="input-group-addon">
				   Hour:
				</span>
				<input type="number" class="form-control" name="overtime_hour">
			</div>
			

		
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add overtime">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	
	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>