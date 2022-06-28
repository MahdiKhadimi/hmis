<?php require_once("../../config/connection.php"); ?>


<?php

     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 1, 9, 9, 9, 9, 9);
 if(isset($_GET['year'])){
	 $year= getValue($_GET['year']);
	 $month= getValue($_GET['month']);

 }else{
	 $year= date("Y");
	 $month= date("m");
 }



  $salary= mysqli_query($con, "SELECT * FROM salary 
	  INNER JOIN staff ON salary.staff_id=staff.staff_id
	  WHERE salary_year=$year AND salary_month=$month
  	 ORDER BY salary_year DESC, salary_month DESC ");	

	$totalRows_salary = mysqli_num_rows($salary);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>Paid Salary List
<a href="salary_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	pay salary 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New salary has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected paid salary has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected paid salary has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected salary!
	</div>
<?php } ?>

<div class="table-responsive">	

<form method="get" class="noprint">
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	
	<div class="input-group">
		<span class="input-group-addon">
			Month: 
		</span>
		<select class="form-control" name="month">
			<option <?php if(date('m')==1){ echo "selected";} ?> value="1">January</option>
			<option  <?php if(date('m')==2){ echo "selected";} ?> value="2">February</option>
			<option  <?php if(date('m')==3){ echo "selected";} ?> value="3">March</option>
			<option  <?php if(date('m')==4){ echo "selected";} ?> value="4">April</option>
			<option  <?php if(date('m')==5){ echo "selected";} ?> value="5">May</option>
			<option  <?php if(date('m')==6){ echo "selected";} ?> value="6">June</option>
			<option  <?php if(date('m')==7){ echo "selected";} ?> value="7">July</option>
			<option  <?php if(date('m')==8){ echo "selected";} ?> value="8">Auguest</option>
			<option  <?php if(date('m')==9){ echo "selected";} ?> value="9">September</option>
			<option  <?php if(date('m')==10){ echo "selected";} ?> value="10">October</option>
			<option  <?php if(date('m')==11){ echo "selected";} ?> value="11">November</option>
			<option  <?php if(date('m')==12){ echo "selected";} ?> value="12">December</option>
		</select>
	</div>
	
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
		<div class="input-group">
			<span class="input-group-addon">
				Year:
			</span>
			<input value="<?php echo date("Y"); ?>" type="text" name="year" class="form-control">
			<span class="input-group-btn">
				<input type="submit" value="Show" class="btn btn-primary">
			</span>
		</div>
		
		
		
		
	
	</div>
	
</form>




<table class="table table-striped">
	<tr>
		<th>S/No</th>
		<th>Staff Name </th>
		<th>Photo</th>
		<th style="min-width:90px;">Gross Salary</th>
		<th>Year</th>
		<th>Month</th>
		<th>Absent Amount</th>
		<th>Overtime Amount</th>
		<th>Insurance</th>
		<th>Tax</th>
		<th>Bonus</th>
		<th style="min-width:90px;">Net Salary</th>
		<th style="min-width:90px;">Pay Date</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php $x=1; while($row_salary = mysqli_fetch_assoc($salary)) { ?>
		<tr>
			<td><?php echo $x++;?></td>
			<td> <?php echo $row_salary["firstname"]; ?>  <?php echo $row_salary["lastname"]; ?> </td>
			<td><img src="<?php echo $row_salary['photo'];?>" style="width:40px;"></td>
			<td><?php echo number_format($row_salary["gross_salary"]); ?> <?php echo $row_salary["currency"]; ?> </td>
			<td><?php echo $row_salary["salary_year"]; ?></td>
			<td><?php echo  $row_salary["salary_month"]; ?></td>
			<td><?php echo number_format($row_salary["absent_amount"]); ?></td>
			<td><?php echo number_format($row_salary["overtime_amount"]); ?></td>
			<td><?php echo number_format($row_salary["insurance"]); ?></td>
			<td><?php echo number_format($row_salary["tax"]); ?></td>
			<td><?php echo number_format($row_salary["bonus"]); ?></td>
			<td><?php echo number_format($row_salary["net_salary"]); ?> <?php echo $row_salary["currency"]; ?></td>
			<td><?php echo $row_salary["pay_date"]; ?></td>

			<td>
				<a href="salary_edit.php?staff_id=<?php echo $row_salary["staff_id"]; ?>&salary_year=<?php echo $row_salary["salary_year"]; ?>&salary_month=<?php echo $row_salary["salary_month"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="salary_delete.php?staff_id=<?php echo $row_salary["staff_id"]; ?>&salary_year=<?php echo $row_salary["salary_year"]; ?>&salary_month=<?php echo $row_salary["salary_month"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		
		</tr>
	<?php } ?>
	

	
</table>
</div>



<?php require_once("../layouts/footer_mis.php"); ?>