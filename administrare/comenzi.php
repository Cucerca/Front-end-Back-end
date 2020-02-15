<?php
include ("conectare.php");
include("autorizare.php");
include("admin_top.php");
?>
<h1>Comenzi</h1>
<hr>
<b><h2>Comenzi inca neonorate</h2></b><br>
<?php
	$sqlTranzactii="SELECT id_tranzactie, DATE_FORMAT(data_tranzactie,'%d-%m-%Y')
	AS data_tranzactie, nume_cumparator, adresa_cumparator
	FROM tranzactii WHERE comanda_onorata=0";
	
	$resursaTranzactii=mysqli_query($con,$sqlTranzactii);
	
	while ($rowTranzactie=mysqli_fetch_array($resursaTranzactii))
	{
?>
	<form action="prelucrare_comenzi.php" method="POST">
		Data comenzii: <b><?php print $rowTranzactie['data_tranzactie']?>
		</b>
		<div style="width:500px; border:1px solid #ffffff; background-color:F9F1E7; padding:5px">
		<b><?php print $rowTranzactie['nume_cumparator']?></b>
			<br>
				<?php print $rowTranzactie['adresa_cumparator']?>
					<table border="1" cellpadding="4" cellspacing="0">
						<tr>
							<td align="center"><b>Produs</b></td>
							<td align="center"><b>Nr Buc</b></td>
							<td align="center"><b>Pret</b></td>
							<td align="center"><b>Total</b></td>
						</tr>
<?php
	$sqlProduse="SELECT titlu, nume_brand, pret, nr_buc FROM vanzari, produse, branduri WHERE produse.id_produs=vanzari.id_produs
	AND produse.id_brand=branduri.id_brand
	AND id_tranzactie=".$rowTranzactie['id_tranzactie'];
	$resursaProduse=mysqli_query($con,$sqlProduse);
	$totalGeneral=0;
		while($rowProdus = mysqli_fetch_array($resursaProduse))
			{
				print '<tr><td>'.$rowProdus['titlu'].' de '.$rowProdus['nume_brand'].'</td>
					<td align="right">'.$rowProdus['nr_buc'].'</td>
					<td align="right">'.$rowProdus['pret'].'</td>';
				$total=$rowProdus['pret'] * $rowProdus['nr_buc'];
				print '<td align="right">'.$total.'</td>
						</tr>';
				$totalGeneral =$totalGeneral+$total;
			}
?>
	<tr>
		<td colspan="3" align="right">Total comanda:</td>
		<td><?php print $totalGeneral?>lei</td>
		
	</tr>
					</table>
	<input type="hidden" name="id_tranzactie" value="<?php print $rowTranzactie['id_tranzactie']?>">
	<input type="submit" name="comanda_onorata" value="Comanda Onorata">
	<input type="submit" name="anuleaza_comanda" value="Anuleaza comanda">
		</div>
	</form>
<?php
	}
?>

<br/><hr>
<b><h2>Comenzi onorate</h2></b><br/>
<?php
	$sqlTranzactii="SELECT id_tranzactie, DATE_FORMAT(data_tranzactie,'%d-%m-%Y')
	AS data_tranzactie, nume_cumparator, adresa_cumparator
	FROM tranzactii WHERE comanda_onorata=1";
	
	$resursaTranzactii=mysqli_query($con,$sqlTranzactii);
	
	while ($rowTranzactie=mysqli_fetch_array($resursaTranzactii))
	{
?>
	<form action="prelucrare_comenzi.php" method="POST">
		Data comenzii: <b><?php print $rowTranzactie['data_tranzactie']?>
		</b>
		<div style="width:500px; border:1px solid #ffffff; background-color:F9F1E7; padding:5px">
		<b><?php print $rowTranzactie['nume_cumparator']?></b>
			<br/>
				<?php print $rowTranzactie['adresa_cumparator']?>
					<table border="1" cellpadding="4" cellspacing="0">
						<tr>
							<td align="center"><b>Produs</b></td>
							<td align="center"><b>Nr Buc</b></td>
							<td align="center"><b>Pret</b></td>
							<td align="center"><b>Total</b></td>
						</tr>
<?php
	$sqlProduse="SELECT titlu, nume_brand, pret, nr_buc FROM vanzari, produse, branduri WHERE produse.id_produs=vanzari.id_produs
	AND produse.id_brand=branduri.id_brand
	AND id_tranzactie=".$rowTranzactie['id_tranzactie'];
	$resursaProduse=mysqli_query($con,$sqlProduse);
	$totalGeneral=0;
		while($rowProdus = mysqli_fetch_array($resursaProduse))
			{
				print '<tr><td>'.$rowProdus['titlu'].' de '.$rowProdus['nume_brand'].'</td>
					<td align="right">'.$rowProdus['nr_buc'].'</td>
					<td align="right">'.$rowProdus['pret'].'</td>';
				$total=$rowProdus['pret'] * $rowProdus['nr_buc'];
				print '<td align="right">'.$total.'</td>
						</tr>';
				$totalGeneral = $totalGeneral  +$total;
			}
?>
	<tr>
		<td colspan="3" align="right">Total comanda:</td>
		<td><?php print $totalGeneral?>lei</td>
		
	</tr>
					</table>
	<input type="hidden" name="id_tranzactie" value="<?=$rowTranzactie['id_tranzactie']?>">
	<input type="submit" name="anuleaza_comanda" value="Anuleaza comanda">
		</div>
	</form>
<?php
	}
?>
	