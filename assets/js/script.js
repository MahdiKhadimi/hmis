$(document).ready(function() {
	
	$("a#print").click(function() {
		window.print();
	});
	
	
	window.setTimeout(function() {
		$(".alert").slideUp(500);
	}, 5000);
	
	
	$("a.delete").click(function(event) {
		var result = window.confirm("Are you sure you want to delete?");
		if(!result) {
			event.preventDefault();
		}
	});	
   // making ajax object 
   var xmlttp;
   if(window.XMLHttpRequest){
	   xmlttp = new XMLHttpRequest();
   }else{
	   xmlttp = new ActiveXObject("Microsoft.XMLHTTP")
   }
 //handle ajax requests 

 // when choice a staff this function call 
  $("#addSalaryStaff").keyup(function(){show();});

// when change  year this function call
$("#addSalaryYear").change(function(){show();});

// when change month this function call
$("#addSalaryMonth").change(function(){show();});

// when insert bonus this function call
$("#addSalaryBonus").keyup(function(){show();});

// when insert tax this function call
$("#addSalaryTax").keyup(function(){show();});

// when insert Insurance this function call
$("#addSalaryInsurance").keyup(function(){show();});


// this function use to calculate absent amount overtime amount net salary 	
	function show(){
     let staffInfo = $('#addSalaryStaff').val();
     let year = $('#addSalaryYear').val();
     let month = $('#addSalaryMonth').val();
     let bonus = $('#addSalaryBonus').val();
     let tax = $('#addSalaryTax').val();
     let insurance = $('#addSalaryInsurance').val();
     if(tax=="")tax=0;
	 if(bonus=="")(bonus=0);
	 if(insurance=="")insurance=0;
		 
	
    
	//getting staff id 
	 staffInfo = staffInfo.split("-");
	 let staffId=staffInfo[0];
	 if(!isNaN(staffId)){
		xmlttp.open("GET","../../views/salary_calculate/salary.php?id="+staffId+
		"&year="+year+"&month="+month+
		"&bonus="+bonus+"&tax="+tax+"&insurance="+insurance, true);
		xmlttp.send();
		xmlttp.onreadystatechange = function(){
			if(this.status==200 && this.readyState==4){
			   let result = this.responseText;
			   $('#addSalary').html(result);
			}
		}
	 }	   
  }





});
