<?php
session_start();
require_once("conectare.php");
require_once("page_top.php");
require_once("meniu.php");

$id_domeniu=$_GET['id_domeniu'];
$sqlNumeDomeniu = "SELECT nume_domeniu FROM domenii where id_domeniu=".$id_domeniu;
$resursaNumeDomeniu = mysqli_query($con,$sqlNumeDomeniu);
if($resursaNumeDomeniu && $resursaNumeDomeniu->num_rows){
	$numeDomeniu = $resursaNumeDomeniu->fetch_assoc()['nume_domeniu'];
}
?>
<td valign="top">
<h1>Domeniu: <?php echo $numeDomeniu; ?></h1>
<b>Produse in domeniul <u><i><?php echo $numeDomeniu; ?></i></u>:</b>
<table cellpadding="5">
<?php
	$sql="SELECT id_produs, titlu, descriere, pret, nume_brand FROM produse, branduri, domenii WHERE produse.id_domeniu=domenii.id_domeniu and produse.id_brand=branduri.id_brand and domenii.id_domeniu=".$id_domeniu;
	$resursa=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($resursa))
	{
?>
<tr>
<td align="center">
<?php
$adresaImagine="coperte/".$row['id_produs'].".jpg";
if(file_exists($adresaImagine))
{
echo '<img  src="'.$adresaImagine.'" width="75" height="100"><br/>';
}
else 
{
echo '<div  style="width:75px; height:100px; border: 1px black solid; background-color:#CCCCCC">Fara imagine</div>';
}
?>
</td>
<td>
<?php
	print '<b><a href="produs.php?id_produs='.$row['id_produs'].'">'.$row['titlu'].'</a></b><br/> de <i>'.$row['nume_brand'].'</i><br/>Pret:'.$row['pret'].'lei</td>';
	?>
</td>
</tr>

<?php
}
?>
</table>
</td>
<?php
include("page_bottom.php");
?>