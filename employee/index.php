<?php
	include_once('../lib/mysql_connect.php');
	$_p=NULL;
	if (isset($_REQUEST['_p'])){
		$_p = $_REQUEST['_p'];
	}


	function func_get_companies($conn){
		$sql_select_companies = "SELECT * FROM tbl_companies ";
		$return_companies=mysqli_query($conn,$sql_select_companies);

		$array_companies=array();
		while($row_companies = mysqli_fetch_assoc($return_companies)){
			$array_companies[]=$row_companies;
		}

		return $array_companies;
	}
?>
<!DOCTYPE html>
<html>
	<?php include_once('../lib/header_menu.php'); ?>
	<body>
		<script type="text/javascript">
			$(document).ready(function(){
				"use strict";
				$("#employee_jqgrid").jqGrid({
					idPrefix: "g1_",
					url: "employee_list-ajax.php",		
					datatype: "json",
					mtype: "GET",
					colModel: [
						{ name: "employee_id", label: "", width: 70, 
							formatter: employee_action_row,
							stype: "select",	
							key: true,			
						},
						{ name: "company_name", label: "Company", width: 250, template: "text",
							searchoptions: { sopt: ["bw","ew", "cn", "nc", "eq", "ne","em", "nm"] }
						},
						{ name: "employee_name", label: "Employee", width: 300, template: "text",
							searchoptions: { sopt: ["bw","ew", "cn", "nc", "eq", "ne","em", "nm"] }
						},
						
						{ name: "employee_address", label: "Address", width: 300, template: "text",
							searchoptions: { sopt: ["bw","ew", "cn", "nc", "eq", "ne","em", "nm"] }
						},
										
					],
					loadonce: true, //prevents reloading of server data which prevents filtering and sorting featues from working
					iconSet: "fontAwesome",
					rownumbers: true,	
					rowList: [10,20,50], //options on how many rows to show at a time
					sortname: "employee_id", //sort field
					sorttype: "integer",  //sorttype options are "text", "integer", "number", "date" (works for d-m-y style format)
					sortorder: "asc",
					toppager: true,
					pagerpos:"left",
					rowNum: 10,  //number of rows to show
					viewrecords: true,  // show range of records currently displayed
					threeStateSort: true, //allow 3 state sorting by column (asc, desc, unsorted )
					multiSort: true,  //allow sort with multiple column criteria
					searching: {
						defaultSearch: "cn"  // "cn"-> contains, "bw" -> begins with, "ew" -> ends with
					},

					//Select row only if the row selector checkbox was clicked
					onSelectRow : function (rowId, status) {
						var selectorCheckboxIdPrefix='jqg_'+this.id+'_'; //Change this to whatever is the checkbox id/name prefix as shown by inspect element tool of browser
						var elem = document.activeElement; //Row element that has been clicked. 
						//console.log('rowId='+rowId+' | status='+status +' | elem.id='+elem.id); //Enable for debugging only
						
						// Check if selector checkbox has been clicked in the row which is identified if its id starts with value of selectorCheckboxIdPrefix variable
						if (elem.id.startsWith(selectorCheckboxIdPrefix)==true) {   
							return true; //allow row selection according to default behavior
						}else{
							$(this).setSelection(rowId, false); //unselect current selection because some other element in the row has been clicked.
						}
						
					},
					loadComplete: function(data) {
						var filter_msg = "Found "+$(this).getGridParam('records');
						if ($(this).getGridParam('records') == 1){
							filter_msg=filter_msg+' record';
						}else{
							filter_msg=filter_msg+' records';
						}
						$('#span_tab1_recordcount').text(filter_msg);
					},
					
					searching: {
						//showQuery: true,
						//loadFilterDefaults: false,
						multipleSearch: true,
						multipleGroup: true,
						closeOnEscape: true,
						searchOperators: true,
						searchOnEnter: true
					},
					customUnaryOperations: ["em", "nm"],
					customSortOperations: {
						em: {
							operand: "=''",
							text: "is empty",
							filter: function (options) {
								var v = options.item[options.cmName];
								if (v === undefined || v === "") {
									return true;
								}
							}
						},
						nm: {
							operand: "!=''",
							text: "is not empty",
							filter: function (options) {
								var v = options.item[options.cmName];
								if (v !== undefined && v !== "") {
									return true;
								}
							}
						}
					},
					
				}).jqGrid("filterToolbar",
					{
						// "afterSearch": function(){
						// // 	//show that recordcount in grid tab is filtered.
						// 	var record_count=$('#span_tab1_recordcount').text();
						// 	$('#span_tab1_recordcount').text('Showing '+record_count+' filtered');

						// }
					}
				) //this method adds the filtertoolbar

			});
				

			function employee_action_row(value, options, rowObject){
				action_row="<a href='?_p=Edit&id="+value+"' class='btn btn-default btn-md' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>";
				return action_row;

			}
			
		
		</script>
		<?php include_once('../lib/sidebar_menu.php'); ?>

	  	<div class="main">
	     	<div class="row">
	        	<div class="col-xs-12 col-lg-12">
	          		<div class="panel">
			          	<?php 
			          		if($_p == "AddEmployee"){
								$company_list = func_get_companies($conn);

			          			include_once('employee_add_form.php');
			          			exit;
			          		}
							else if ($_p == "Add"){
			          			$name_for_insert=NULL;
								if(isset($_REQUEST["txt_name"])==true){
									$name_for_insert=$_REQUEST["txt_name"];
									$name_for_insert = str_replace("'","\'",$name_for_insert);
								}


								$address_for_insert=NULL;
								if(isset($_REQUEST["txt_address"])==true){
									$address_for_insert=$_REQUEST["txt_address"];
									$address_for_insert = str_replace("'","\'",$address_for_insert);
								}


								$company_id=NULL;
								if(isset($_REQUEST["txt_company"])==true){
									$company_id=$_REQUEST["txt_company"];
								}


								$sql_insert = "INSERT INTO tbl_employees (company_id, employee_name, employee_address) 
								VALUES ('".$company_id."', '".$name_for_insert."', '".$address_for_insert."' ) ";
								$return_insert=mysqli_query($conn,$sql_insert);
								$emp_id = mysqli_insert_id($conn);
	
								

			          		}else if ($_p == "Edit"){
								$company_list = func_get_companies($conn);


			          			$id = $_REQUEST['id'];
			          			$sql_select="SELECT * FROM tbl_employees WHERE employee_id = '$id' ";
			          			$return_select = mysqli_query($conn,$sql_select) or die( mysqli_error($conn) );
			          			$row_select = mysqli_fetch_assoc($return_select);

			          			
			          			include_once('employee_edit_form.php');
			          			exit;
			          		}else if ($_p == "Update"){
			          			$emp_id=$_REQUEST["txt_emp_id"];
			          			$name_for_update=NULL;
								if(isset($_REQUEST["txt_name"])==true){
									$name_for_update=$_REQUEST["txt_name"];
									$name_for_update = str_replace("'","\'",$name_for_update);
								}
								$address_for_update=NULL;
								if(isset($_REQUEST["txt_address"])==true){
									$address_for_update=$_REQUEST["txt_address"];
									$address_for_update = str_replace("'","\'",$address_for_update);
								}


								$company_id=NULL;
								if(isset($_REQUEST["txt_company"])==true){
									$company_id=$_REQUEST["txt_company"];
								}

								$sql_update="UPDATE tbl_employees SET 
									employee_name='".$name_for_update."', 
									employee_address='".$address_for_update."', 
									
									company_id='".$company_id."'
									WHERE employee_id = ".$emp_id;
								mysqli_query($conn,$sql_update) or die( mysqli_error($conn) );							
								

			          		}
			          	?>
	            		<div class="row">
			              	<div class="col-xs-12">
			                	<h4><a class='btn btn-default btn-md' href="../employee/">Employee List</a></h4>
			             	</div>
	            		</div>
			            <div class="panel-body">
			            	<?php if ($_p == "Add"){
			            		echo "<pre>"
								."Added record  ".$name_for_insert." "
								."<a class='btn btn-default btn-md' role='button' href='?_p=Edit&id=$emp_id'><span class='glyphicon glyphicon-pencil'></span>&nbspEdit</a>"
								."</pre><br>";
							}else if ($_p == "Update"){
								echo "<pre>"
								."Updated record  ".$name_for_update."  "
								."<a class='btn btn-default btn-md' role='button' href='?_p=Edit&id=$emp_id'><span class='glyphicon glyphicon-pencil'></span>&nbspEdit</a>"
								."</pre><br>";
			          		}
							?>


			                <a href="?_p=AddEmployee" type="button" class="btn btn-primary btn-xs">Add Employee</a>&nbsp;|&nbsp;
			                <span id='span_tab1_recordcount'></span>&nbsp;|&nbsp;
							<button class="btn btn-default btn-xs" onClick="filterToolbar_clearFilters('employee_jqgrid');">Clear filters</button>		
						  	<br>	
						  	<br>	
					      	<table id="employee_jqgrid"></table>
			            </div>
	          		</div>
	        	</div>
	    	</div>
	    </div>
	</body>
</html>