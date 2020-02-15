<?php
include ("conectare.php");
include("autorizare.php");
include("admin_top.php");
?>
<h1>Modificare sau stergere comentarii</h1>
<b>Comentariile utilizatorului de la ultima moderare:</b><br>
<?php
	$sql="SELECT * FROM comentarii,admin,produse,branduri WHERE id_comentariu>admin.ultimul_comentariu_moderat AND produse.id_produs = comentarii.id_produs AND produse.id_brand=branduri.id_brand ORDER BY id_comentariu ASC";
	$resursa= mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($resursa))
			{		
?>
		<form action="formulare_moderare_opinii.php" method="POST">
		<div style="width:500px;border:1px solid #ffffff; background-color:#F9F1E7; padding:5px">
			<b><?php print $row['titlu']?></b> de <?php print $row['nume_brand']?>
			<hr size="1">
			<a href="mailto:<?php print $row['adresa_email']?>">
			<?php print $row['nume_utilizator']?>
			</a><br>
			<?php print $row['comentariu']?>
		</div>
		<input type="hidden" name="id_comentariu" value="<?=$row['id_comentariu']?>">
		<input type="submit" name="modifica" value="Modifica">
		<input type="submit" name="sterge" value="Sterge">
		</form>
<?php }
$sql1="SELECT id_comentariu FROM comentarii,admin WHERE id_comentariu>admin.ultimul_comentariu_moderat 
ORDER BY id_comentariu DESC LIMIT 0,1";
$resursa=mysqli_query($con,$sql1);
if($resursa && $resursa->num_rows){
	$ultimul_id = $resursa->fetch_assoc();}
$nrComentarii=mysqli_num_rows($resursa);

if($nrComentarii > 0){
?>
	<form action="formulare_moderare_opinii.php" method="POST" >
	<input type="hidden" name="ultimul_id" value="<?php print $ultimul_id?>">
	<input type="submit" name="seteaza_moderate" value="Seteaza aceste comentarii ca fiind moderate">
	</form>
<?php
}
else
{
	echo "<p> Nu exista comentarii.</p>";
}
?>