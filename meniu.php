<?php
require_once("conectare.php");
?>
<td valign="top" width="150">
<div id="box">
<h1><b><font color="blue">Alege domeniul</font></b></h1><hr>
<?php
$sql="SELECT * FROM domenii ORDER BY nume_domeniu ASC";
$resursa=mysqli_query($con, $sql);
while($row=mysqli_fetch_array($resursa)){
print '<a href="domeniu.php?id_domeniu='.$row['id_domeniu'].'">'.$row['nume_domeniu'].'</a><br>';
}
?>
</div>
<br/>
<div id="box">
	<form action="cautare.php" method="GET">
	<h1><b><font color="blue">Cautare</font></b></h1><hr>
	<input type="text" id="cauta" name="cuvant" size="12"><br/>
	<input type="submit" value="Cauta">
	</form>
</div>
<br/>
<div id="box">
	<h1><b><font color="blue">Cosul meu</font></b></h1><hr>
	<?php
	$nrProduse=0;
	$totalValoare=0;
    if(isset($_SESSION['titlu'])){
	for($i=0;$i<count(isset($_SESSION['titlu']));$i++)
	{
	$nrProduse=$nrProduse+isset($_SESSION['nr_buc'][$i]);
	$totalValoare=$totalValoare+isset($_SESSION['nr_buc'][$i])*isset($_SESSION['pret'][$i]);
	}
    }
	?>
	Aveti <b><?=$nrProduse?></b> produse in cos, in valoare totala de <b><?=$totalValoare?></b> lei.
	<a href="cos.php">Click aici pentru a vedea continutul cosului</a>
</div>
</td>
