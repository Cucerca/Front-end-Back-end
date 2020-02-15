<?php
include ("conectare.php");
include("autorizare.php");
include("admin_top.php");
if(isset($_POST['modifica_domeniu']))	
		
	if($_POST['nume_domeniu']=="")
	{ 	
	echo "Nu ati introdus numele domeniului!";
	}
	else
	{
		$sql = "UPDATE domenii SET nume_domeniu='".$_POST['nume_domeniu']."' WHERE id_domeniu=".$_POST['id_domeniu'];
		mysqli_query($con,$sql);
		echo "Numele domeniului a fost modificat!";
				
	}
if(isset($_POST['sterge_domeniu']))
	{
		$sql= "DELETE FROM domenii WHERE id_domeniu=".$_POST['id_domeniu'];
		mysqli_query($con,$sql);
		echo  "Domeniul a fost sters!";
	}
	
	
if(isset($_POST['modifica_brand']))
	{
		if($_POST['nume_brand'] =="")
		{
			print "Nu ati introdus numele brandului!";
		}
		else
		{
			$sql="UPDATE branduri SET nume_brand='".$_POST['nume_brand']."' WHERE id_brand=".$_POST['id_brand'];
			mysqli_query($con,$sql);
			print "Numele brandului a fost modificat!";
		}	
	}
if(isset($_POST['sterge_brand']))
	{
		$sql="DELETE FROM branduri WHERE id_brand=".$_POST['id_brand'];
		mysqli_query($con,$sql);
		echo "Brandul a fost sters!";
	}
	if(isset($_POST['modifica_produs']))
		{
			if($_POST['titlu'] == "")
				{
					echo "Nu ati introdus titlul!";
				}
			else if($_POST['descriere'] == "")
				{
					echo "Nu ati introdus descrierea!";
				}
			else if($_POST['pret'] == "")
				{
					echo "Nu ati introdus pretul!";
				}
					else if(!is_numeric($_POST['pret']))
						{
							echo "Pretul trebuie sa fie numeric! Scrieti <b> 100</b> in loc de <b> 100 lei </b>!";
						}
						else
							{
								$sql="UPDATE produse SET id_domeniu=".$_POST['id_domeniu'].",
								id_brand=".$_POST['id_brand'].",
								titlu='".$_POST['titlu']."',
								descriere='".$_POST['descriere']."',
								pret=".$_POST['pret']." WHERE 
								id_produs=".$_POST['id_produs'];
								mysqli_query($con,$sql);
								echo "Informatiile au fost modificate!";
							}
		}
	if(isset($_POST['sterge_produs']))
		{
			$sql="DELETE FROM produse WHERE id_produs=".$_POST['id_produs'];
			mysqli_query($con,$sql);
			$sqlComentarii="DELETE FROM comentarii WHERE id_produs=".$_POST['id_produs'];
			mysqli_query($con,$sqlComentarii);
			echo "Produs a fost stearsa din baza de date!";
		}
?>