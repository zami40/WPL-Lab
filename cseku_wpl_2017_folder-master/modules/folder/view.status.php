<?php

include_once 'blade/view.notification.blade.php';
include_once '/../../common/class.common.php';

?>


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

	<div id="notification">
	<table width="100%" border="1" cellpadding="15" align="center">
	<?php
	
	
	$Result = $_File_assignBAO->searchFile_assign($globalUser->getID());

	//if DAO access is successful to load all the Terms then show them one by one
	if($Result->getIsSuccess()){

		$FileList = $Result->getResultObject();
		//print_r(sizeof($FileList));
	?>
		<tr>
			
			<td>File ID</td>
			<td>File Comment</td>
			<td>Current User</td>
			<td>Creation Date</td>
			<td>Status</td>
			<td>Approve Date</td>
			<td>Assign Date</td>
			
		</tr>
		<?php 
		for($i = 0; $i < sizeof($FileList); $i++) {
				$File = $FileList[$i];
				if(!$File->getIsPending())
				{
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
			    <td><?php echo $File->getCreationDate(); ?></td>
			    <td><?php 
			    	if($File->getIsApproved())
			    		echo "Approved";
			    	else
			    		echo "Rejected";

			    ?></td>
			    <td><?php echo $File->getApproveDate(); ?> </td>
			    <td><?php echo $File->getAssignDate(); ?></td>
			    
			    
			    <td><a href="?send=<?php echo $File->getID(); ?>" onclick="return confirm('sure to send !'); " >send</a></td>
		    </tr>
	    <?php
	    	}
		}

	}
	else{

		echo $Result->getResultObject(); //giving failure message
	}

	?>
	</table>
	</div>

</center>
</body>
</html>
