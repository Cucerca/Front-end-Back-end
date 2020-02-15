<?php
include ("conectare.php");
include("autorizare.php");
include("admin_top.php");
	if(isset($_POST['modifica_domeniu']))
	{
		$sql="SELECT nume_domeniu FROM domenii WHERE id_domeniu='".$_POST['id_domeniu']."'";
		$resursa=mysqli_query($con,$sql);
		if($resursa && $resursa->num_rows){
				$nume_domeniu = $resursa->fetch_assoc()["nume_domeniu"];
			}
?>
<h1>Modifica nume domeniu</h1>
<form action="prelucrare_modificare_stergere.php" method="POST">
	<INPUT type="text" name="nume_domeniu" value="<?php print $nume_domeniu?>">
	<INPUT type="hidden" name="id_domeniu" value="<?php print $_POST['id_domeniu']?>">
	<INPUT type="submit" name="modifica_domeniu" value="Modifica">
</form>
<?php
}
if (isset($_POST['sterge_domeniu']))
{
$sql="SELECT titlu,nume_brand FROM produse,branduri,domenii WHERE produse.id_domeniu=domenii.id_domeniu AND produse.id_brand=branduri.id_brand AND domenii.id_domeniu=".$_POST['id_domeniu'];
$resursa=mysqli_query($con,$sql);
$nrProduse=mysqli_num_rows($resursa);
if($nrProduse>0)
	{
	print "<p>Sunt $nrProduse produse care apartin acestui domeniu!</p>";
	while($row=mysqli_fetch_array($resursa))
	{
	print "<b>".$row['titlu']."</b> de ".$row['nume_brand']."<br>";
	}
	print "<p>Nu puteti sterge acest domeniu!</p>";
	}
else 
	{
	?>
	<h1>Sterge nume domeniu</h1>
	Esti sigur ca vrei sa stergi acest domeniu?
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<INPUT type="hidden" name="id_domeniu" value="<?php print $_POST['id_domeniu']?>">
	<INPUT type="submit" name="sterge_domeniu" value="Sterge!">
	</form>
	<?php
	}
}
if(isset($_POST['modifica_brand']))
{
$sql="SELECT nume_brand FROM branduri WHERE id_brand='".$_POST['id_brand']."'";
$resursa=mysqli_query($con,$sql);
if($resursa && $resursa->num_rows){
				$nume_brand = $resursa->fetch_assoc()["nume_brand"];
			}
?>
<h1>Modifica nume brand</h1>
<form action="prelucrare_modificare_stergere.php" method="POST">
	<INPUT type="text" name="nume_brand" value="<?php print $nume_brand?>">
	<INPUT type="hidden" name="id_brand" value="<?php print $_POST['id_brand']?>">
	<INPUT type="submit" name="modifica_brand" value="Modifica!">
</form>
<?php
}
if(isset($_POST['sterge_brand']))
{
$sql="SELECT titlu FROM produse,branduri WHERE produse.id_brand=branduri.id_brand AND produse.id_brand='".$_POST['id_brand']."'";
$resursa=mysqli_query($con,$sql);
$nrProduse=mysqli_num_rows($resursa);
if($nrProduse>0)
	{
	print "<p>Sunt $nrProduse produse de acest brand in baza de date!</p>";
	while($row=mysqli_fetch_array($resursa))
	{
	print $row['titlu']."<br>";
	}
	print "<p>Nu puteti sterge acest brand!</p>";
	}
else 
	{
	?>
	<h1>Sterge brand</h1>
	Esti sigur ca vrei sa stergi acest brand?
	<form action="prelucrare_modificare_stergere.php" method="POST">
		<INPUT type="hidden" name="id_brand" value="<?php print $_POST['id_brand']?>">
		<INPUT type="submit" name="sterge_brand" value="Sterge!">
	</form>
	<?php
	}
}
if(isset($_POST['modifica_produs']))
{
print "<h1>Modificare produs</h1>";
$sqlProdus="SELECT * FROM produse WHERE titlu='".$_POST['titlu']."'AND id_brand=".$_POST['id_brand'];
	$resursaProdus=mysqli_query($con,$sqlProdus);
	if(mysqli_num_rows($resursaProdus)==0)
	{
	print"Acesat produs nu exista in baza de date";
	}
	else
	{
	$rowProdus=mysqli_fetch_array($resursaProdus);
	?>
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
	<tr>
		<td><select name="id_domeniu">
		<?php
		$sql="SELECT * FROM domenii ORDER BY nume_domeniu ASC";
		$resursa=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($resursa))
		{
		if ($row['id_domeniu']==$rowProdus['id_domeniu'])
		{
		print '<option SELECTED value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
		}
		else
		{
		print '<option SELECTED value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
		}
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>Brand: </td>
		<td><select name="id_brand">
		<?php
		$sql="SELECT * FROM branduri ORDER BY nume_brand ASC";
		$resursa=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($resursa))
		{
		if ($row['id_brand']==$rowProdus['id_brand'])
		{
		print '<option SELECTED value="'.$row['id_brand'].'">'.$row['nume_brand'].'</option>';
		}
		else
		{
		print '<option  value="'.$row['id_brand'].'">'.$row['nume_brand'].'</option>';		
		}
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td>Titlu: </td>
		<td>
		<INPUT type="text" name="titlu" value="<?php print $rowProdus['titlu']?>">
		</td>
	</tr>
	<tr>
		<td valign="top">Descriere: </td>
		<td><textarea name="descriere" rows="8"><?php print $rowProdus['descriere']?></textarea></td>
	</tr>
	<tr>
		<td>Pret: </td>
		<td><INPUT type="text" name="pret" value="<?php print $rowProdus['pret']?>"></td>
	</tr>
</table>
<INPUT type="hidden" name="id_produs" value="<?php print $rowProdus['id_produs']?>">
<INPUT type="submit" name="modifica_produs" value="Modifica">
</form>
<?php
}
}
if (isset($_POST['sterge_produs']))
{
print "<h1>Sterge produs</h1>";
$sql="SELECT * FROM produse WHERE titlu='".$_POST['titlu']."' AND id_brand=".$_POST['id_brand'];
$resursaProdus=mysqli_query($con,$sql);
if (mysqli_num_rows($resursaProdus)==0)
{
print "Aceast produs nu exista in baza de date";
}
	else
	{
		if($resursaProdus && $resursaProdus->num_rows){
				$id_prod = $resursaProdus->fetch_assoc()["id_produs"];
			}
		?>
		Esti sigur ca vrei sa stergi aceast produs?
			<form action="prelucrare_modificare_stergere.php" method="POST">
				<INPUT type="hidden" name="id_produs" value="<?php print $id_produs?>">
				<INPUT type="submit" name="sterge_produs" value="Sterge!">
			</form>
		<?php
	}
}
?>
