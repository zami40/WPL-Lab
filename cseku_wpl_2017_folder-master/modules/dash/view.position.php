<?php

include_once 'blade/view.position.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Position CRUD Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</a></label>
	</div>

	<div id="form">
		<form method="post">
			<table width="100%" border="1" cellpadding="15">
				<tr>
					<td><input type="text" name="txtName" placeholder="Position Name" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getName();  ?>" /></td>
				</tr>
				<tr>
					<td>
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update">update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save">save</button>
							<?php
						}
						?>
					</td>
				</tr>
			</table>
		</form>

<br />

	<table width="100%" border="1" cellpadding="15" align="center">
	<?php
	
	
	$Result = $_PositionBAO->getAllPositions();

	//if DAO access is successful to load all the Positions then show them one by one
	if($Result->getIsSuccess()){

		$PositionList = $Result->getResultObject();
	?>
		<tr>
			<td>Position Name</td>
		</tr>
		<?php
		for($i = 0; $i < sizeof($PositionList); $i++) {
			$Position = $PositionList[$i];
			?>
		    <tr>
			    <td><?php echo $Position->getName(); ?></td>
			    <td><a href="?edit=<?php echo $Position->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $Position->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
		    </tr>
	    <?php

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