<?php require_once("../../config/connection.php"); ?>


<?php
   //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 9, 9, 9, 4, 9, 9, 9, 9, 9);
	 
    $staff = mysqli_query($con,"SELECT * FROM staff");

	if(isset($_GET['staff_id'])){
	$staff_id = getValue($_GET['staff_id']);
	$year = getValue($_GET['salary_year']);
	$month = getValue($_GET['salary_month']);
    $condition = "WHERE staff.staff_id=$staff_id AND salary_year=$year AND salary_month=$month";   	

	$salary= mysqli_query($con, "SELECT * FROM salary 
	INNER JOIN staff ON salary.staff_id=staff.staff_id
	 $condition ");	

	$row_salary = mysqli_fetch_assoc($salary);
}	
	if(isset($_POST["staff_id"])) {
		$staff_id = getValue($_POST["staff_id"]);
		$staff_id=explode("-",$staff_id);
		$staff_id=$staff_id[0];

		$salary_year = getValue($_POST["salary_year"]);
		$salary_month = getValue($_POST["salary_month"]);
		$absent_amount = getValue($_POST["absent_amount"]);
		$overtime_amount = getValue($_POST["overtime_amount"]);
		$insurance = getValue($_POST["insurance"]);
		$tax = getValue($_POST["tax"]);
		$bonus = getValue($_POST["bonus"]);

		$net_salary = getValue($_POST["net_salary"]);
		$currency = getValue($_POST["currency"]);

		$pay_date = getValue($_POST["pay_date"]);		
		$result = mysqli_query($con, "UPDATE salary SET staff_id=$staff_id, salary_year=$salary_year,salary_month=$salary_month,absent_amount=$absent_amount,overtime_amount=$overtime_amount,insurance=$insurance,tax=$tax,bonus=$bonus,net_salary=$net_salary,currency='$currency', pay_date='$pay_date' WHERE staff_id=$staff_id AND salary_year=$salary_year AND salary_month=$salary_month");
		
		if($result) {
			header("location:salary_list.php?edit=done");
		}
		else {
			header("location:salary_edit.php?error=notedit&staff_id=$staff_id&salary_year=$salary_year&salary_month=$salary_month");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>


<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit Paid Salary</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit paid salary!
			</div>
		<?php } ?>
	
		<form method="post">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 	
		<div class="input-group">
				<span class="input-group-addon">
					 staff:
				</span>
				<input type="text" value="<?php echo $row_salary['staff_id']?>-<?php echo $row_salary['firstname']?> <?php echo $row_salary['lastname']?>" list="staff" autocomplete="off" id="addSalaryStaff" class="form-control" name="staff_id">
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
				<select name="salary_year" id="addSalaryYear" class="form-control">
					<?php $current_year=date('Y'); for($i=$current_year; $i>=$current_year-4;$i--) { ?>
					  <option <?php if($row_salary['salary_year']==$i){echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>  
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
				   Month:
				</span>
				<select name="salary_month" id="addSalaryMonth" class="form-control">
				      <?php for($i=1;$i<=12;$i++) {  ?>
						<option <?php if($row_salary['salary_month']==$i) {echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>	
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Bonus:
				</span>
				<input type="number" value="<?php echo $row_salary['bonus'];?>" class="form-control" id="addSalaryBonus" name="bonus" value="0">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Insurance:
				</span>
				<input type="number" value="<?php echo $row_salary['insurance'];?>" class="form-control" id="addSalaryInsurance" name="insurance" value="0">
			</div>
		   
			<div class="input-group">
				<span class="input-group-addon">
				   Tax:
				</span>
				<input type="number" value="<?php echo $row_salary['tax'];?>" class="form-control" id="addSalaryTax" name="tax" value="0">
			</div>
		
			</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		 <div id="addSalary">
		

		  </div>		
			
			<div class="input-group">
				<span class="input-group-addon">
				   Pay Date:
				</span>
				<input type="text" value="<?php echo $row_salary['pay_date'];?>" autocomplete="off" class="form-control" name="pay_date" id="pay_date">
			</div>
			

		
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Save Change">
	</div>		
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "pay_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	
	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>