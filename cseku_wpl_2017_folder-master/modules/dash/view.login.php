<?php

include_once 'blade/view.login.blade.php';
include_once '/../../common/class.common.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>USER Login Operation</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

<body>
<center>
    <div id="header">
        <label>By : Kazi Masudul Alam</a></label>
    </div>

    <div id="form">
        <table width="100%" border="1" cellpadding="15">
            <tr>
                <form method="post">
                    <td>
                        <table width="100%" border="0" cellpadding="3" >
                            <tr>
                                <td colspan="3"><strong>Member Login </strong></td>
                            </tr>
                            <tr>
                                <td width="78">User Name (Email)</td>
                                <td width="6">::</td>
                                <td width="294"><input name="txtEmail" type="text" id="txtEmail"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>::</td>
                                <td><input name="txtPassword" type="password" id="txtPassword"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" name="login" value="Login"></td>
                            </tr>
                        </table>
                    </td>
                </form>
            </tr>
        </table>
    </div>    
</center>
</body>
</html>