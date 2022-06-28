
<?php
   include_once('../../config/connection.php');

 // this function use to calculate absent amount
function absentAmount($gross_salary,$hours){
   $daily_salary = $gross_salary/26;
   $hourly_salary =$gross_salary/(8*26);
   $absent_amount=ceil($hours*$hourly_salary);
   return $absent_amount; 
}

//this function use to calculate overtime amount
function overtimeAmount($gross_salary,$hours){
   $daily_salary = $gross_salary/26;
   $hourly_salary =$gross_salary/(8*26);
   $overtime_amount=ceil($hours*$hourly_salary);
   return $overtime_amount; 
}

//this function use to calculate net_salary
function netSalary($gross_salary,$overtime_amount,$bonus,$absent_amount,$tax,$insurance){
   
   $increase_salary= ceil($overtime_amount+$bonus);
   $decrease_salary =ceil($absent_amount+$tax+$insurance);
 
    $net_salary = floor($gross_salary+$increase_salary-$decrease_salary);
   return $net_salary;
}

  // This function use to calculate gross salary
  function grossSalary($id=NULL,$year,$month,$bonus,$tax,$insurance){
     global $con; 
     if($id!=""){
      $staff = mysqli_query($con,"SELECT * FROM staff WHERE staff_id=$id");
      $row_staff = mysqli_fetch_assoc($staff);
      $gross_salary = $row_staff['gross_salary'];
      $currency = $row_staff['currency'];

      // getting absent hours
      $absent = mysqli_query($con,"SELECT SUM(hours) as hours FROM attendance WHERE staff_id=$id AND absent_year=$year AND absent_month=$month");
      $row_absent = mysqli_fetch_assoc($absent);
      $absent_hours = $row_absent['hours'];

      // getting overtime hours
         $overtime = mysqli_query($con,"SELECT SUM(hours) as hours FROM overtime WHERE staff_id=$id AND overtime_year=$year AND overtime_month=$month");
         $row_overtime = mysqli_fetch_assoc($overtime);
         $overtime_hours = $row_overtime['hours'];
         
         // calling function 
         $absent_amount = absentAmount($gross_salary,$absent_hours);
         $overtime_amount = absentAmount($gross_salary,$overtime_hours);
         $net_salary = netSalary($gross_salary,$overtime_amount,$bonus,$absent_amount,$tax,$insurance);

      // show form element 
  ?>
  <div class="input-group" id="addSalaryGrossSalary">
    <span class="input-group-addon">Gross Salary</span>
    <input type="text" value="<?php echo number_format($gross_salary);?>" class="form-control" readonly>
   </div>
   <div class="input-group">
				<span class="input-group-addon">
				   Absent Amount:
				</span>
				<input type="text" value="<?php echo number_format($absent_amount);?>  " readonly class="form-control" id="addSalaryAbsent" name="absent_amount">
	</div> 
   <div class="input-group">
				<span class="input-group-addon">
				  Overtime Amount:
				</span>
				<input type="text" value="<?php echo number_format($overtime_amount);?>" readonly class="form-control" id="addSalaryOvertime" name="overtime_amount">
	</div> 
    
	 <div class="input-group">
				<span class="input-group-addon">
				   Net Salary:
				</span>
				<input type="hidden" value="<?php echo $net_salary;?>  " class="form-control"  name="net_salary">
				<input type="hidden" value="<?php echo $row_staff['currency'];?>" class="form-control"  name="currency">
                        
				<input type="text" value="<?php echo number_format($net_salary); ?> <?php echo $currency; ?> " class="form-control" id="addNetSalary" readonly >
		</div>
			

<?php }} 
 
 if(isset($_GET['id'],$_GET['year'],$_GET['month'])){
     $id = $_GET['id'];     
     $year = $_GET['year'];     
     $month = $_GET['month'];     
     $bonus = $_GET['bonus'];     
     $tax = $_GET['tax'];     
     $insurance = $_GET['insurance'];     
     echo grossSalary($id,$year,$month,$bonus,$tax,$insurance);       
 }

 
?>

