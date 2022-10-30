
<style type="text/css">
	.td_label{
		width:25%;
		text-align: right;
	}
	.td_content{
		width: 75%;
	}
	
	input [type="text"]{
		width: 100%;
	}
</style>
<div class="col-sm-12">
	<div class="container col-sm-6">
		<h3>Update Employee</h3>
		<form name="frmEditEmployee" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
			<br>
			<table border="0" style="width: 100%;">
				

				<tr>
					<td class="td_label" ><label>Company &nbsp;&nbsp; </label></td>
					<td class="td_content">
						<select  
							class="form-control input-sm responsive" 
							id="txt_company" 
							name="txt_company" 
							required=true
							style="width: auto;"  
					>
						<?php  foreach($company_list as $company){
							echo "<option value='".$company['company_id']."' ".($company['company_id']==$row_select['company_id'] ? 'selected' : '').">".$company['company_name']."</option>";
						}?>
					</select>
					</td>
				</tr>
				
				<tr>
					<td class="td_label" ><label>Employee Name &nbsp;&nbsp; </label></td>
					<td class="td_content">
						<input type="text" class="form-control" id="txt_name" name="txt_name" value="<?php echo $row_select['employee_name'];?>" required=true>
					</td>
				</tr>
				

				<tr>
					<td class="td_label" ><label>Address &nbsp;&nbsp; </label></td>
					<td class="td_content">
						<input type="text" class="form-control" id="txt_address" name="txt_address" value="<?php echo $row_select['employee_address'];?>" >
					</td>
				</tr>

				
			</table>
			
			<div class='form-group'>
				<br/>
				
				<input type="hidden" class="form-control" id="txt_emp_id" name="txt_emp_id" value="<?php echo $row_select['employee_id'];?>">
				<a class='btn btn-default btn-md' role='button' href='?_p=cancel'  style="float:right;">Cancel</a>
				<input class="btn btn-primary btn-md" type="submit" name="_p" value="Update" style="float:right;margin-right: 1%;">
				
			</div>
		</form>
	</div>
</div>

<!-- this is cont from index -->
					</div>
	        	</div>
	    	</div>
	    </div>
	</body>
</html>