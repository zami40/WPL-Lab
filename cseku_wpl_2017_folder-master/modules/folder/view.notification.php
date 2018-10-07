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
		<label>By : CSE 14 Batch</label>
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
			
			<td>From</td>
			<td>To</td>
			<td>Link</td>>
			<td>Creation Date</td>
			<td>Comments</td>
			
			
		</tr>
		<?php 
		for($i = 0; $i < sizeof($FileList); $i++) {
			$File = $FileList[$i];
			if($File->getIsPending())
			{
			?>
		    <tr>
			    <td><?php 
			    	$User = new user();
			    	$User->setID($File->getCurrentUser());
			    	$User = $_UserBAO->readUser($User);
			    	$User = $User->getResultObject();


			    	echo $User->getFirstName() ." ". $User->getLastName(); ?>
			    		
			    </td>
			    <td><?php
			    	$User = new user();
			    	$User->setID($File->getPreviousUser());
			    	$User = $_UserBAO->readUser($User);
			    	$User = $User->getResultObject();


			    	echo $User->getFirstName() ." ". $User->getLastName(); ?>
			    		
			    </td>
			    <td>
			    <?php
			    $File1 = new File();
			    	$File1->setID($File->getFile());
			    	$File2 = $_FileBAO->readFile($File1);
			    	$File1 = $File2->getResultObject();
			    	//echo $File1->getLink();
			    ?>
			    <a href='<?php 
			    echo "/2017_education/modules/folder/".$File1->getLink(); ?>' target="_blank"><?php echo "".$File1->getLink(); ?></a>

			    </td>
			    <td><?php echo $File->getAssignDate(); ?></td>
			    <td><?php echo $File->getFileComment(); ?></td>
			    <td>
			    	<a href="?accept=<?php echo $File->getID(); ?>" onclick="return confirm('sure to accept ?'); " >accept</a>
			    </td>
			    <td>
			    	<a href="?reject=<?php echo $File->getID(); ?>" onclick="return confirm('sure to reject ?'); " >reject</a>
			    </td>
			    
			    <td>
			    	<a href="?history=<?php echo $File->getFile(); ?>" onclick="return confirm('sure to go to see history ?'); " >history</a>
			    </td>
			    
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
