<?php
include("autorizare.php");
include ("admin_top.php");
include ("conectare.php");
?>
<h1>Modificare sau Stergere</h1>
<p><b>Nota:</b> Nu veti putea sterge domenii care au produse in ele.
Inainte de a sterge domeniul, modificati produsele din el astfel incat sa apartine altor domenii.
De asemenea nu veti putea sterge un brand daca exista produse in baza de date care au acel brnad.</p>
<br>
<hr>
<br>
<b>Selecteaza domeniul ce doresti sa il modifici sau stergi:</b>
<form action="formulare_modificare_stergere.php" method="POST">
Domeniu:
<select name="id_domeniu">
<?php
$sql="select * from domenii order by nume_domeniu asc";
$resursa=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($resursa))
{
	print '<option value="'.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</option>';
}
?>
</select>
<input type="submit" name="modifica_domeniu" value="Modifica">
<input type="submit" name="sterge_domeniu" value="Sterge">
</form>

<b>Selecteaza brandul ce doresti sa il modifici sau stergi:</b>
<form action="formulare_modificare_stergere.php" method="post">
Brand:
<select name="id_Brand">

<?php
$sql="select * from branduri order by nume_brand asc";
$resursa=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($resursa))
{
	print '<option value="'.$row['id_brand'].'">'.$row['nume_brand'].'</option>';
}
?>
</select>
<input type="submit" name="modificare_autor" value="Modifica">
<input type="submit" name="sterge_brand" value="Sterge">
</form>
<b>Selecteaza brandul si scrie titlul produsului ce doresti sa il modifici sau stergi:</b>
<form action="formulare_modificare_stergere.php" method="post">
<table>
<tr>
<td>Brand:</td>
<td>
<select name="id_brand">
<?php
$sql="select * from branduri order by nume_brand asc";
$resursa=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($resursa))
{
	print '<option value="'.$row['id_brand'].'">'.$row['nume_brand'].'</option>';
}
?>
</select>
</td>
</tr>
<tr>
<td>Titlu:</td>
<td><input type="text" name="titlu">
</td>
</tr>
</table>
<input type="submit" name="modifica_produs" value="Modifica">
<input type="submit" name="sterge_produs" value="Sterge">
</form>