<?php require_once("../../config/connection.php"); ?>


<?php
        //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 2, 9, 9, 9, 9, 9);
    $staff = mysqli_query($con,"SELECT * FROM staff");

	
	
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
	
	
		
	
		$result = mysqli_query($con, "INSERT INTO salary VALUES ( $staff_id,$salary_year,$salary_month,$absent_amount,$overtime_amount,$insurance,$tax,$bonus,$net_salary,'$currency','$pay_date')");
		
		if($result) {
			header("location:salary_list.php?add=done");
		}
		else {
			header("location:salary_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>


<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Pay Salary</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not pay salary!
			</div>
		<?php } ?>
	
		<form method="post">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	 	
		<div class="input-group">
				<span class="input-group-addon">
					 staff:
				</span>
				<input type="text" list="staff" autocomplete="off" id="addSalaryStaff" class="form-control" name="staff_id">
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
					  <option ><?php echo $i;?></option>
					<?php } ?>  
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
				   Month:
				</span>
				<select name="salary_month" id="addSalaryMonth" class="form-control">
				      <?php for($i=1;$i<=12;$i++) {  ?>
						<option <?php if($i==date('m')) {echo "selected";} ?> ><?php echo $i;?></option>
					<?php } ?>	
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Bonus:
				</span>
				<input type="number" class="form-control" id="addSalaryBonus" name="bonus" value="0">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Insurance:
				</span>
				<input type="number" class="form-control" id="addSalaryInsurance" name="insurance" value="0">
			</div>
		   
			<div class="input-group">
				<span class="input-group-addon">
				   Tax:
				</span>
				<input type="number" class="form-control" id="addSalaryTax" name="tax" value="0">
			</div>
		
			</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		 <div id="addSalary">
		

		  </div>		
			
			<div class="input-group">
				<span class="input-group-addon">
				   Pay Date:
				</span>
				<input type="text" class="form-control" name="pay_date" id="pay_date">
			</div>
			

		
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Pay">
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