<?php

include_once 'blade/view.permission.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Permission Assignment Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<script type="text/javascript">
			
			function SetAllCheckBoxes(FormName, FieldName, CheckValue)
			{
				if(!document.forms[FormName])
					return;
				var objCheckBoxes = document.forms[FormName].elements[FieldName];
				if(!objCheckBoxes)
					return;
				var countCheckBoxes = objCheckBoxes.length;
				if(!countCheckBoxes)
					objCheckBoxes.checked = CheckValue;
				else
					// set the check value for all check boxes
					for(var i = 0; i < countCheckBoxes; i++)
						objCheckBoxes[i].checked = CheckValue;
			}
		
			/*
			 *  onChange event handler
			 * getting the url and parsing and rebuilding it with selection information and finally redirect
			 */
			function onChangeEventHandler(event,obj){
				 if(event != null){
				  var url = window.location.href;
				  url = url.indexOf("?") ? url.substring(0,url.indexOf("?")): url;	
				  window.location = url + '?edit='+obj.value;
				 }	
			}

		</script>
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</a></label>
	</div>

	<div id="form">
		<form method="post" name="formPermissions">
			<table width="100%" border="1" cellpadding="15">
				<tr>
					<td>
							<label>Available Roles:: </label>
						    

						    <?php
						    // this block of code prints the list box of roles with current assigned  roles
						    //window.location.href+=\'?edit=\'+this.value;
						    $var = '<select name="selectedRole" id="select-from-roles" onChange="onChangeEventHandler(event,this);">';
							$Result = $_RoleBAO->getAllRoles();
								//if DAO access is successful to load all the Roles then show them one by one
							if($Result->getIsSuccess()){

								$Roles = $Result->getResultObject();
							
						       for ($i=0; $i < sizeof($Roles); $i++) { 
						       		
						       		$Role = $Roles[$i];
						    
						    		$var = $var. '<option value="'.$Role->getID().'"';   

						    		if(isset($_GET['edit']) && !strcmp($_GET['edit'],$Role->getID())) {
						          		$var = $var.' selected="selected"';
						          	} 			

						          	$var = $var.'>'.$Role->getName().'</option>';
					
								}

								$var = $var.'</select>';
							}
							echo $var;
							?>	
					</td>
				</tr>
				<tr>
					<td>
						
						    <?php
						    // this block of code prints the checkbox of permissions
						    $var='<table>';

						    $var=$var.'<tr>';
						    $var=$var.'<td>Permissions</td>';
						    $var=$var.'<td>Create</td>';
						    $var=$var.'<td>Read</td>';
						    $var=$var.'<td>Update</td>';
						    $var=$var.'<td>Delete</td>';
						    $var=$var.'</tr>';
						    $Result = $_RoleBAO->getAllPermissions();

								
							if($Result->getIsSuccess()){

								$Permissions = $Result->getResultObject();
								
								//building all the permission block
						       for ($i=0; $i < sizeof($Permissions); ) { 

						       		$Permission = $Permissions[$i];
						       		$var = $var.'<tr>';
						       		$var = $var.'<td>'.$Permission->getCategory().'</td>';

						       		$j=$i;

						       		for ( ; $j < sizeof($Permissions)  ; $j++) { 

						       			if(!strcmp($Permissions[$i]->getCategory(), $Permissions[$j]->getCategory())){

						    				$var = $var.'<td><input type="checkbox" name="selectedPermissions[]" 
						    					value="'.$Permissions[$j]->getID().'" 
						    					id="'.$Permissions[$j]->getID().'"';

						    				if(isset($_GET['edit']) && isPermissionAvailable($Permissions[$j],$globalRole->getPermissions())) {
						          				$var = $var.' checked="checked"';
						          			} 

						          			$var = $var.'/></td>';
						       			}
						       			else{

						       				break;
						       			}
						       		}

						       		$i=$j;

						       		$var = $var. '</tr>';
						       		
						    	}

						    	$var = $var.'</table>';	

						    }

						    echo $var;
						    ?>
					</td>
				</tr>
				<tr>
					<table>
						<tr>
							<td>
									<input type="button" name="checkAll" onclick="SetAllCheckBoxes('formPermissions', 'selectedPermissions[]', true);" value="Check All"/> 
							</td>
							<td>
									<input type="button" name="uncheckAll" onclick="SetAllCheckBoxes('formPermissions', 'selectedPermissions[]', false);" value="Uncheck All"/> 
							</td>
						</tr>
					</table>
				</tr>
				<tr>
					<td>		

							<button type="submit" name="save">save</button>

					</td>
				</tr>
			</table>
		</form>

<br />

	<table width="100%" border="1" cellpadding="15" align="center">
	
	</table>
	</div>
</center>
</body>
</html>