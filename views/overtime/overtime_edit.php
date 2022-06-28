<?php require_once("../../config/connection.php"); ?>
<?php

    $staff = mysqli_query($con,"SELECT * FROM staff");

	$staff_id="";
	$overtime_year="";
	$overtime_month="";
	$overtime_day="";
	$condition="";
	if(isset($_GET['staff_id'])){
		$staff_id = getValue($_GET['staff_id']);
		$overtime_year = getValue($_GET['overtime_year']);
		$overtime_month = getValue($_GET['overtime_month']);
		$overtime_day = getValue($_GET['overtime_day']);
        $condition ="WHERE overtime.staff_id=$staff_id AND overtime_year='$overtime_year'
		AND overtime_month='$overtime_month'
		AND overtime_day='$overtime_day'
		
		";
      
		$overtime = mysqli_query($con, "SELECT * FROM overtime 
		INNER JOIN staff ON overtime.staff_id=staff.staff_id
		$condition ORDER BY overtime.staff_id DESC");	

        $row_overtime = mysqli_fetch_assoc($overtime); 
	} 
	
	if(isset($_POST["staff_id"])) {
		$staff_id = getValue($_POST["staff_id"]);
		$staff_id=explode("-",$staff_id);
		$staff_id=$staff_id[0];

		$overtime_year = getValue($_POST["overtime_year"]);
		$overtime_month = getValue($_POST["overtime_month"]);
		$overtime_day = getValue($_POST["overtime_day"]);
		$overtime_hour = getValue($_POST["overtime_hour"]);

		$result = mysqli_query($con, "UPDATE overtime  SET staff_id=$staff_id,overtime_year='$overtime_year',overtime_month='$overtime_month',overtime_day='$overtime_day',hours='$overtime_hour' $condition");
		
		if($result) {
			header("location:overtime_list.php?edit=done");
		}
		else {
			header("location:overtime_add.php?error=notedit&staff_id=$staff_id&overtime_year=$overtime_year&overtime_month=$overtime_month&overtime_day=$overtime_day");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit overtime</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit overtime!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 staff:
				</span>
				<input type="text" value="<?php echo $row_overtime['staff_id']?>-<?php echo $row_overtime['firstname']?> <?php echo $row_overtime['lastname']?>" list="staff" class="form-control" name="staff_id">
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
					  <option <?php if( $row_overtime['overtime_year']==$i) {echo "selected"; }?> ><?php echo $i;?></option>
					<?php } ?>  
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Month:
				</span>
				<select name="overtime_month" id="" class="form-control">
				      <?php for($i=1;$i<=12;$i++) {  ?>
						<option <?php if($row_overtime['overtime_month']==$i) {echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>	
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Day:
				</span>
				<select name="overtime_day" id="" class="form-control">
					<?php for($i=1;$i<=30;$i++) { ?>
					  <option  <?php if($row_overtime['overtime_month']==$i) {echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>    
				</select>
			</div>
	
			
			<div class="input-group">
				<span class="input-group-addon">
				   Hour:
				</span>
				<input type="number" value="<?php echo $row_overtime['hours']?>" class="form-control" name="overtime_hour">
			</div>
			

		
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add overtime">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	
	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>