<?php require_once("../../config/connection.php"); ?>
<?php
    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 1, 9, 9, 9, 9, 9);
	$condition = "";
   if(isset($_GET['start_date'])){
	   $start_date = getValue($_GET['start_date']);
	   $end_date = getValue($_GET['end_date']);

   }else{
	   $year = date("Y");
	   $month = date("m");

	   $start_date = $year."-".$month."-"."1";
	   $end_date = $year."-".$month."-"."30";
    }


     $condition = " BETWEEN '$start_date' AND '$end_date'";
	
	
	$income = mysqli_query($con, "SELECT SUM(amount) as amount,income_currency FROM income WHERE income_date $condition  GROUP BY income_currency");

	$expense = mysqli_query($con, "SELECT SUM(amount) as amount,currency FROM expense WHERE expense_date $condition  GROUP BY currency");
	$salary = mysqli_query($con, "SELECT SUM(net_salary) as amount,currency FROM salary WHERE pay_date $condition  GROUP BY currency");
	
	


 

   	
	
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>Finance Report

</h2>

<div>
<form method="get">
<div class="col-md-6">
	<div class="input-group">
		<span class="input-group-addon">
			Start Date:
		</span>
		<input type="text" value="<?php echo $start_date?> " name="start_date" class="form-control" id="startDate" autocomplete="off">
		
	 </div>
	</div>	
  	<div class="col-md-6">
	<div class="input-group">
		<span class="input-group-addon">
			End Date:
		</span>
		<input type="text" value="<?php echo $end_date?>" name="end_date" class="form-control" id="endDate" autocomplete="off">
		<span class="input-group-btn">
			<button class="btn btn-primary">
				<span style="color:white;" class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	 </div>
	</div>
</form>
</div>

<table class="table table-bordered">
	<caption><span style="font-size:20px;">Finace Report:  (<?php echo $start_date?>)-(<?php echo $end_date?>) </span></caption>
 <thead>	
	<tr>
		<th >Total Income </th>
		<th >Total Expense</th>
		<th >Employee Salary </th>
	</tr>
</thead>
 <tbody>	
	<tr>

		<td> 
		 <?php while($row_income=mysqli_fetch_assoc($income)) { ?>    
	    <p style="font-size:14px;"> <?php echo number_format($row_income['amount']);?>  <?php echo $row_income['income_currency']?> </p>
		 <?php } ?>
		</td>
		
		<td> 
		 <?php while($row_expense=mysqli_fetch_assoc($expense)) { ?>    
	    <p style="font-size:14px;"> <?php echo number_format($row_expense['amount']);?>  <?php echo $row_expense['currency']?> </p>
		 <?php } ?>
		</td>
		
		<td> 
		 <?php while($row_salary=mysqli_fetch_assoc($salary)) { ?>    
	        <p style="font-size:14px;"> <?php echo number_format($row_salary['amount']);?>  <?php echo $row_salary['currency']?> </p>
		 <?php } ?>
		</td>
		

	</tr>
 </tbody>
<tfoot style="font-size:16px;">
	<tr>
	 
	</tr>
</tfoot>
</table>
   
  



	

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "startDate",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	Calendar.setup({
        inputField      :    "endDate",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	
</script>


<?php require_once("../layouts/footer_mis.php"); ?>