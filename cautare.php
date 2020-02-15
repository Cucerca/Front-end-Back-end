<?php
	session_start();
	require_once("conectare.php");
	require_once("page_top.php");
	require_once("meniu.php");
	$cuvant=$_GET['cuvant'];
?>
	<td valign="top">
	<h1>Rezulatele cautarii</h1>
	<p>Textul cautat: <b><?php echo $cuvant;?></b></p>
	<b>Branduri</b>
	<blockquote>
	<?php
		$sql="SELECT id_brand, nume_brand FROM branduri WHERE nume_brand LIKE '%".$cuvant."%'";
		$resursa=mysqli_query($con,$sql);
		if(mysqli_num_rows($resursa)==0)
		{
		echo "<i>Nici un rezultat</i>";
		}
		while($row=mysqli_fetch_array($resursa))
		{
			$nume_brand=str_replace($cuvant,"<b>$cuvant</b>",$row['nume_brand']);
			echo '<a href="brand.php?id_brand='.$row['id_brand'].'">'.$nume_brand.'</a><br>';
		}
		
	?>
	</blockquote>
	<b>Titluri:</b>
	<blockquote>
	<?php
		$sql="SELECT id_produs, titlu FROM produse WHERE titlu LIKE '%".$cuvant."%'";
		$resursa=mysqli_query($con,$sql);
		if(mysqli_num_rows($resursa)==0)
		{
		echo '<i>Nici un rezultat</i>';
		}
		while($row=mysqli_fetch_array($resursa))
		{
		$titlu=str_replace($cuvant,"<b>$cuvant</b>",$row['titlu']);
		echo '<a href="produs.php?id_produs='.$row['id_produs'].'">'.$titlu.'</a><br>';
		}
	?>
	</blockquote>
	<b>Descrieri</b>
	<blockquote>
	<?php
		$sql="SELECT id_produs, titlu, descriere FROM produse WHERE descriere LIKE '%".$cuvant."%'";
		$resursa=mysqli_query($con,$sql);
		if(mysqli_num_rows($resursa)==0)
		{
			echo '<i>Nici un rezultat</i>';
		}
		while($row=mysqli_fetch_array($resursa))
		{
			$descriere=str_replace($cuvant,"<b>$cuvant</b>",$row['descriere']);
			echo '<a href="produs.php?id_produs='.$row['id_produs'].'">'.$row['titlu'].'</a><br>
			'.$descriere.'<br><br>';
		}
	?>
	</blockquote>
	</td>
	<?php
	include("page_bottom.php");
	?>
	
	
	
	
	