<?php

include_once 'blade/view.log.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Discipline CRUD Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</label>
	</div>

	<div>
		<label>Log of Files</label>
	</div>

	<div id="notification">
		<form method="post">
			<table width="100%" border="1" cellpadding="15">

				<?php
	
				
				$Result = $_File_assignBAO->searchFileID($globalFileID);

				//if DAO access is successful to load all the File_assigns then show them one by one
				if($Result->getIsSuccess()){

					$FileAssignList = $Result->getResultObject();
					//print_r($FileAssignList);

				?>



			<tr>
				<td>File ID</td>
				<td>File Comment</td>
				<td>Current User</td>
				<td>Previous User</td>
				<td>Creation Date</td>
				<td>Status</td>
				<td>Approve Date</td>
				<td>Assign Date</td>
			</tr>


			<?php 
			//echo '<br>'.sizeof($FileAssignList);
			for($i = 0; $i < sizeof($FileAssignList); $i++) {
				$File = $FileAssignList[$i];
				//echo '<br>'.$i;
			?>
		    <tr>
			    <td><?php echo $File->getFile(); ?></td>
			    <td><?php echo $File->getFileComment(); ?></td>
			    <td><?php 

			    	$User = new user();
			    	$User->setID($File->getCurrentUser());
			    	$User = $_UserBAO->readUser($User);
			    	$User = $User->getResultObject();


			    	echo $User->getFirstName() ." ". $User->getLastName(); ?></td>
			    <td><?php 

			    	$User = new user();
			    	$User->setID($File->getPreviousUser());
			    	$User = $_UserBAO->readUser($User);
			    	$User = $User->getResultObject();


			    	echo $User->getFirstName() ." ". $User->getLastName(); ?></td>
			    <td><?php echo $File->getCreationDate(); ?></td>
			    <td><?php 
			    	if($File->getIsApproved())
			    		echo "Approved";
			    	else if($File->getIsPending())
			    		echo "Pending";
			    	else
			    		echo "Rejected"; 

			    ?></td>
			    <td><?php echo $File->getApproveDate(); ?> </td>
			    <td><?php echo $File->getAssignDate(); ?></td>
			    
			    <!-- <td><a href="?edit=<?php echo $File->getFile(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $File->getFile(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td> -->
		    </tr>
	    <?php

		}

	}
	else{

		echo $Result->getResultObject(); //giving failure message
	}

	?>




			</table>
				
		</form>
			
	</div>




</center>
</body>
</html>