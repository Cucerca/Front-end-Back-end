<?php
include("conectare.php");
include("autorizare.php");
include("admin_top.php");

if(isset($_POST['adauga_domeniu']))
{
	if($_POST['domeniu_nou']=="")
	{
	print 'Trebuie sa completezi numele de domeniu!<br> <a href="adaugare.php">Inapoi</a>"';
	exit;
	}
$sql="SELECT * FROM domenii WHERE nume_domeniu='".$_POST['domeniu_nou']."'";
$resursa=mysqli_query($con,$sql);
	if(mysqli_num_rows($resursa) !=0)
	{
	echo 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> exista deja in baza de date!<br>
	<a href="adaugare.php">Inapoi</a>';
	exit;
	}

$sql="INSERT INTO domenii (nume_domeniu) VALUES ('".$_POST['domeniu_nou']."')";
mysqli_query($con,$sql);
echo 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> a fost adaugat in baza de date!<br>
<a href="adaugare.php">Inapoi</a>';
exit;
}

if(isset($_POST['adauga_brand']))
{
	if($_POST['brand_nou']=="")
	{
	echo 'Trebuie sa completezi numele brandului!<br> <a href="adaugare.php">Inapoi</a>"';
	exit;
	}
$sql="SELECT * FROM branduri WHERE nume_brand='".$_POST['brand_nou']."'";
$resursa=mysqli_query($con,$sql);
	if(mysqli_num_rows($resursa) !=0)
	{
	print 'Brandul <b>'.$_POST['brand_nou'].'</b> exista deja in baza de date!<br>
	<a href="adaugare.php">Inapoi</a>';
	exit;
	}
$sql="INSERT INTO branduri (nume_brand) VALUES ('".$_POST['brand_nou']."')";
mysqli_query($con,$sql);
print 'Brandul <b>'.$_POST['brand_nou'].'</b> a fost adaugat in baza de date!<br>
<a href="adaugare.php">Inapoi</a>';
exit;
}
if(isset($_POST['adauga_produs']))
{
	if($_POST['titlu']==""|| $_POST['descriere']==""||$_POST['pret']=="")
	{
	print 'Titlu, descrierea sau pretul sunt goale!<br><a href="adaugare.php">Inapoi</a>';
	exit;
	}
	if(!is_numeric($_POST['pret']))
	{
	print 'Campul Pret trebuie sa fie de tip numeric!<br><a href="adaugare.php">Inapoi</a>';
	exit;
	}
$sql="SELECT * FROM produse WHERE id_brand='".$_POST['id_brand']."'AND titlu='".$_POST['titlu']."'";
$resursa=mysqli_query($con,$sql);
	if(mysqli_num_rows($resursa)!=0)
	{print 'Aceast produs exista deja in baza de date!<br>
	<a href="adaugare.php">Inapoi</a>';
	exit;
	}
$sql="INSERT INTO produse (id_domeniu,id_brand,titlu,descriere,pret) VALUES ('".$_POST['id_domeniu']."','".$_POST['id_brand']."','".$_POST['titlu']."','".$_POST['descriere']."','".$_POST['pret']."')";
mysqli_query($con,$sql);
print 'Produsul a fost adaugata in baza de date!<br><a href="adaugare.php">Inapoi</a>';
exit;
}
?>