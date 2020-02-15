<?php
include("conectare.php");
include("autorizare.php");
include("admin_top.php");
?>
<h1>Adaugare</h1><br>
<hr>
<b>Adauga domeniu</b>
<form action="prelucrare_adaugare.php" method="POST">
Domeniu nou:<INPUT type="text" name="domeniu_nou">
<INPUT type="submit" name="adauga_domeniu" value="Adauga">
</form>
<hr>
<b>Adauga brand</b>
<form action="prelucrare_adaugare.php" method="POST">
Brand nou: <INPUT type="text" name="brand_nou">
<INPUT type="submit" name="adauga_brand" value="Adauga">
</form>
<hr>
<b>Adauga produs</b>
<form action="prelucrare_adaugare.php" method="POST">
<table>
<tr>
	<td>Domeniu: </td>
	<td><select name="id_domeniu">
	<?php
	$sql="SELECT * FROM domenii ORDER BY nume_domeniu ASC";
	$resursa=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($resursa))
	{
	echo '<option value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td>Brand: </td>
	<td>
	<select name="id_brand">
	<?php
	$sql="SELECT * FROM branduri ORDER BY nume_brand ASC";
	$resursa=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($resursa))
	{
	print'<option value="'.$row['id_brand'].'">'.$row['nume_brand'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td>Titlu: </td>
	<td><INPUT type="text" name="titlu"></td>
</tr>
<tr>
	<td valign="top">Descriere: </td>
	<td><textarea name="descriere" rows="8"></textarea></td>
</tr>
<tr>
	<td>Pret: </td>
	<td><INPUT type="text" name="pret"></td>
</tr>
<tr>
	<td></td>
	<td><INPUT type="submit" name="adauga_produs" value="Adauga"></td>
</tr>
</table>
</form>
<hr>