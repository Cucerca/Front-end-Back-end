<?php
session_start();
require_once("conectare.php");
require_once("page_top.php");
require_once("meniu.php");

$id_produs = $_GET['id_produs'];
$sql="select titlu, nume_brand, descriere, pret from produse, branduri where id_produs='".$id_produs."' and produse.id_brand=branduri.id_brand";
$resursa=mysqli_query($con,$sql);
$row=mysqli_fetch_array($resursa);
?>
<td valign="top">
<table>
<tr>
  <td valign="top">
  <h1><?php echo $row['titlu']; ?></h1>
</td>
</tr>
<tr>
  <td valign="top">
    <?php
      $adresaImagine="coperte/".$id_produs.".jpg";
        if(file_exists($adresaImagine)){
            echo '<img src="'.$adresaImagine.'" width="200" height="250" hspace="10"><br/>';
          }else{
            echo '<div  style="width:150px; height:150px;border: 1px black solid; background-color:#CCCCCC">Fara imagine</div>';
          }
    ?>
  </td>
  <td valign="top">
  <i>de <b><?=$row['nume_brand']?></b></i>
  <p><i><?=$row['descriere']?></i></p>
  <p>Pret: <?=$row['pret']?> lei </p>
  </td>
</tr>
</table>
<br>

<form action="cos.php?actiune=adauga" method="post">
<input type="hidden" name="id_produs" value="<?php echo $id_produs; ?>">
<input type="hidden" name="titlu" value="<?php echo $row['titlu']; ?>">
<input type="hidden" name="nume_brand" value="<?php echo $row['nume_brand'];?>">
<input type="hidden" name="pret" value="<?php echo $row['pret']; ?>">
<input type="submit" value="Cumpara acum">
</form>

<hr>

<p><b>Opiniile cititorilor</b></p>
<?php
$sqlComentarii="SELECT * FROM comentarii WHERE id_produs=".$id_produs;
$resursaComentarii=mysqli_query($con,$sqlComentarii);
while($row=mysqli_fetch_array($resursaComentarii))
{
	print '<div style="width:400px; border:1px solid #ffffff; background-color:#F9F1E7; padding:5px;"><a href="mailto:'.$row['adresa_email'].'">'.$row['nume_utilizator'].'</a><br/>'.$row['comentariu'].'</div>';
}
?>
<br>
<div style="width:400px; border:1px solid #ffffff; background-color:#F9F1E7; padding:5px;">
<b>Adauga opinia ta:</b>
<hr size="1">
<form action="adauga_comentariu.php" method="POST">
Nume:<input type="text" name="nume_utilizator"><br>
Email:<input type="text" name="adresa_email"><br/>
Comentariu:<br/><textarea name="comentariu" cols="45"></textarea><br/><br/>
<input type="hidden" name="id_produs" value="<?=$id_produs?>">
<center><input type="submit" value="Adauga"></center>
</form>
</div>
</td>
<?php 
include("page_bottom.php");
?>