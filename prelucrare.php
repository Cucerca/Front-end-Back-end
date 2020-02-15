<?php
session_start();
include("conectare.php");

if($_POST['nume']=="")
{
print 'Trebuie sa completati numele!<a href="cos.php">Inapoi</a>';
exit;
}
if($_POST['adresa'] == "")
{
print 'Trebuie sa introduceti adresa!<a href="cos.php">Inapoi</a>';
exit;
}

$nrProduse=array_sum($_SESSION['nr_buc']);
if($nrProduse==0)
{
print 'Trebuie sa completati cel putin un produs!<a href="cos.php">Inapoi</a>';
exit;
}


$sqlTranzactie="insert into tranzactii(nume_cumparator, adresa_cumparator) values('".$_POST['nume']."','".$_POST['adresa']."')";
$resursaTranzactie=mysqli_query($con,$sqlTranzactie);
$id_tranzactie=mysqli_insert_id();
for($i=0;$i<count($_SESSION['id_produs']);$i++)
{
if($_SESSION['nr_buc'][$i]>0)
{
$sqlVanzare="insert into vanzari values('".$_SESSION['id_tranzactie']."','".$_SESSION['id_produs'][$i]."','".$_SESSION['nr_buc'][$i]."')";
mysqli_query($con,$sqlVanzare);
}
}
$emailDestinatar="deacbeatrice@yahoo.com";
$subiect="O noua comanda!";
$mesaj="O noua comanda de la <b>".$_POST['nume']."</b><br/>";
$mesaj .="Adresa: ".$_POST['adresa']."<br/>";
$mesaj .="Produse comandate: <br/><br/>";
$mesaj .="<table border='1' cellspacing='0' cellpadding='4'>";
for($i=0;$i<count($_SESSION['id_produs']);$i++)
{
if($_SESSION['nr_buc'][$i]>0)
{
$mesaj .="<tr><td>".$_SESSION['titlu'][$i]." de ".$_SESSION['nume_brand'][$i]."</td><td>".$_SESSION['nr_buc'][$i]." buc</td></tr>";
$totalGeneral=$totalGeneral+($_SESSION['nr_buc'][$i]*$_SESSION['pret'][$i]);
}
}

$mesaj .="</table>";
$mesaj .="Total: <b>".$totalGeneral."</b>";
$headers="MIME-Version:1.0\r\nContent-type: text/html; charset=iso-8859-2\r\n";

mail($emailDestinatar, $subiect, $mesaj, $headers);
session_unset();
session_destroy();
include("page_top.php");
include("meniu.php");
?>

<td valign="top">
<h1>Multumim!</h1>
Va multumim ca ati cumparat de la noi! Veti primi comanda solicitata in cel mai scurt timp.</td>
<td>
<a href="index.php">Inapoi la pagina principala!</a>
</td>
<?
include("page_bottom.php");
?>
