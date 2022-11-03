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
	<h3>Add New Employee</h3>
	<form name="frmAddEmployee" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
		<br>
		<div class="form-group">
			<label for="txt_company">Company</label>
			<select  
					class="form-control input-sm responsive" 
					id="txt_company" 
					name="txt_company" 
					required=true
					style="width: auto;"  
			>
				<?php foreach($company_list as $company){
					echo "<option value='".$company['company_id']."'>".$company['company_name']."</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="txt_name">Name</label>
			<input type="text" class="form-control" id="txt_name" name="txt_name"  required=true>
		</div>
		<div class="form-group">
			<label for="txt_address">Address</label>
			<input type="text" class="form-control" id="txt_address" name="txt_address" >

		</div>
			
		
		<div class='form-group'>
			<br/>
			<a class='btn btn-default btn-md' role='button' href='?_p=cancel'  style="float:right;">Cancel</a>
			<input class="btn btn-primary btn-md" type="submit" name="_p" value="Add" style="float:right;margin-right: 1%;">
			
		</div>
	</form>
</div>

<!-- this is cont from index -->
					</div>
	        	</div>
	    	</div>
	    </div>
	</body>
</html>