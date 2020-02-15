<?php
session_start();
require_once("conectare.php");
require_once("page_top.php");
require_once("meniu.php");

$actiune=isset($_GET['actiune']);
if(isset($_GET['actiune'])&& $_GET['actiune']!="modifica")
	{
		$_SESSION['id_produs'][]=$_POST['id_produs'];
		$_SESSION['nr_buc'][]=1;
		$_SESSION['pret'][]=$_POST['pret'];
		$_SESSION['titlu'][]=$_POST['titlu'];
		$_SESSION['nume_brand'][]=$_POST['nume_brand'];
	}
if(isset($_GET['actiune']) && $_GET['actiune']=="modifica")
	{
		for($i=0;$i<count($_SESSION['id_produs']);$i++)
		{
		$_SESSION['nr_buc'][$i]=$_POST['noulNrBuc'][$i];
		}
	}
?>
<td valign="top">
<h1>Cosul de cumparaturi</h1>
<form action="cos.php?actiune=modifica" method="post">
<table border="1" cellpadding="4" cellspacing="0">
<tr bgcolor="#F9F1E7">
  <td><b>Nr. buc</b></td>
   <td><b>Produs</b></td>
   <td><b>Pret</b></td>
   <td><b>Total</b></td>
  </tr>
<?php
$totalGeneral=0;
for($i=0;$i<count($_SESSION['id_produs']);$i++)
{
if($_SESSION['nr_buc'][$i]!=0)
{
print '<tr><td><input type="text" name="noulNrBuc['.$i.']" size="1" value="'.$_SESSION['nr_buc'][$i].'">
</td>
<td><b>'.$_SESSION['titlu'][$i].'</b>de '.$_SESSION['nume_brand'][$i].'</td>
<td align="right">'.$_SESSION['pret'][$i].' lei</td>
<td align="right">'.($_SESSION['pret'][$i]*$_SESSION['nr_buc'][$i]).' lei</td>
</tr>';
$totalGeneral=isset($totalGeneral)+($_SESSION['pret'][$i]*$_SESSION['nr_buc'][$i]);
}
}
print '<tr><td align="right" colspan="3"><b>Total in cos</b></td>
<td align="right"><b>'.$totalGeneral.'</b>lei</td></tr>';
?>  
</table>
<br>
<input type="submit" value="Modifica"><br/><br/>
Introduceti<b> 0 </b>pentru produsele ce doriti sa le scoateti din cos!
<h1>Continuare</h1>
<table>
	<tr>
		<td width="200" align="center">
			<img src="imagini/cos.png"><br>
			<a href="index.php">Continua cumparaturile</a>
		</td>
		<td width="200" align="center">
			<img src="imagini/casa.png"><br>
			<a href="casa.php">Mergi la casa</a>
		</td>
	</tr>
</table>
</body>
</html>
<?
include("page_bottom.php");
?>

