<?php
session_start();
include("conectare.php");
function autorizat()
{
	$sql="select*from admin where admin_nume='".$_SESSION['nume_admin']."'
	and admin_parola='".$_SESSION['parola_encriptata']."'";
	$resursa=mysql_query($sql);
	if($_SESSION['key_admin'] != session_id() || mysql_num_rows($resursa) != 1)
	{
		return false ;
	}
	else
	{
		return true;
	}
}
?>

	