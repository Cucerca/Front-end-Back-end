	<?php
	session_start();
	require_once("conectare.php");
	require_once("page_top.php");
	require_once("meniu.php");

	$id_brand = $_GET['id_brand'];
	$sqlNumeBrand = "SELECT nume_brand FROM branduri WHERE id_brand=".$id_brand; 
	$resursaNumeAutor = mysqli_query($con,$sqlNumeBrand);
	if($resursaNumeBrand && $resursaNumeBrand->num_rows){
		$numeBrand = $resursaNumeBrand->fetch_assoc()["nume_brand"];
	}
	?>
	<td valign="top">
	<h1>Brand: <?php echo $numeBrand; ?></h1>
	<b>Produsele Brand-ului <u><i> <?php echo $numeBrand; ?></i></u>:</b>
	<table cellpadding="5">
		<?php
		$sql="SELECT id_produs, titlu, descriere, nume_brand, pret FROM prduse, branduri, domenii 
		where prduse.id_domeniu=domenii.id_domeniu and produse.id_brand = branduri.id_brand and branduri.id_brand=".$id_brand;
		$resursa=mysqli_query($con,$sql) or die(mysql_error());
		while($row=mysqli_fetch_array($resursa))
		{
		?>
	<tr>
		<td align="center">
		<?php
		$adresaImagine="coperte/".$row['id_produs'].".jpg";
		if(file_exists($adresaImagine))
		{
			print '<img src="'.$adresaImagine.'"
		width="75" height="100"<br/>';
		}
		else
		{
		print '<div style="width:75px; height:100px; border:1px black solid;
	background-color:#cccccc">Fara Imagine</div>';
		}
		?>
		</td>
		<td>
		<b><a href="produs.php?id_produs=<?php print $row['id_produs']?>">
			<?php print $row['titlu']?></a></b><br/>
			<i>de <?php print $row['nume_brand']?>
			<br/>
			Pret:<?php print $row['pret']?> lei</i>
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