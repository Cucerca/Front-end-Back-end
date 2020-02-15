<?php
if($_POST['nume_utilizator'] == ""  || $_POST['adresa_email'] == "" || $_POST['comentariu'] == "")
{
 print "Trebuie sa completezi toate campurile!";
  exit;
}
include("conectare.php");
$numeFaraTags=strip_tags($_POST['nume_utilizator']);
$emailFaraTags=strip_tags($_POST['adresa_email']);
$comentariuFaraTags=strip_tags($_POST['comentariu']);

$sql="INSERT INTO comentarii(id_produs, nume_utilizator, adresa_email, comentariu) VALUES(".$_POST['id_produs'].",'".$numeFaraTags."','".$emailFaraTags."','".$comentariuFaraTags."')";
mysqli_query($con,$sql);
$inapoi="produs.php?id_produs=".$_POST['id_produs'];
header("location: $inapoi");
print "<b>Comentariul dumneavoastra a fost adaugat cu succes!</b>";
?>
<br/>
<a href="index.php">Inapoi la cumparaturi</a>