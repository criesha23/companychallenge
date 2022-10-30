
<style type="text/css">
	.td_label{
		width:25%;
		text-align: right;
	}
	.td_content{
		width: 75%;
	}
</style>

<div class="col-sm-12">
	<div class="container col-sm-6">
		<h3>Add New Company</h3>
		<form name="frmAddCompany" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<br>
			<table border="0" style="width: 100%;">
				<tr>
					<td class="td_label" ><label>Company Name &nbsp;&nbsp; </label></td>
					<td class="td_content">
						<input type="text" class="form-control" id="txt_company_name" name="txt_company_name"  required=true>
					</td>
				</tr>
				
				<tr>
					<td class="td_label" ><label>Address &nbsp;&nbsp; </label></td>
					<td class="td_content">
						<input type="text" class="form-control" id="txt_company_add" name="txt_company_add"  required=true>
					</td>
				</tr>
				


				
			</table>
			
			<div class='form-group'>
				<br/>
				<a class='btn btn-default btn-md' role='button' href='?_p=cancel'  style="float:right;">Cancel</a>
				<input class="btn btn-primary btn-md" type="submit" name="_p" value="Add" style="float:right;margin-right: 1%;">
				
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