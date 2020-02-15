	<?php
	session_start();
	require_once("conectare.php");
	require_once("page_top.php");
	require_once("meniu.php");
   
	?>
		<td valign="top">
		<center><h1><b><font color="blue" size="20">Cele mai noi produse</font></b></h1></center>
		<table cellpadding="5">
		 <tr>
		 <?php
		 $sql="SELECT id_produs, titlu, nume_brand, pret FROM produse, branduri WHERE produse.id_brand=branduri.id_brand ORDER BY data DESC LIMIT 0,5";
		 $resursa=mysqli_query($con,$sql);
		 while($row=mysqli_fetch_array($resursa))
		 {
		 print '<td align="center">';
		 $adresaImagine="coperte/".$row['id_produs'].".jpg";
		 if(file_exists($adresaImagine))
		 {
		 print '<img src="'.$adresaImagine.'" width="150" height="120"><br/>';
		 }
		 else {
		 print '<div style="width:75px; height:100px; border: 1px black solid; background-color:#CCCCCC">Fara imagine</div>';
		 }
		 print '<b><a href="produs.php?id_produs='.$row['id_produs'].'">'.$row['titlu'].'</a></b><br/> de <i>'.$row['nume_brand'].'</i><br>Pret: '.$row['pret'].' lei </td>';
		 }
		 ?>
		 </tr>
		 </table>
		 <hr><hr>
		 <center><h1><b><font color="blue" size="20">Cele mai populare produse</font></b></h1></center>
		 <table cellpadding="5">
		 <tr>
		 <?php
			 $sqlVanzari="SELECT id_produs, sum(nr_buc) as bucatiVandute FROM vanzari GROUP BY id_produs ORDER BY bucatiVandute DESC LIMIT 0,5";
			 $resursaVanzari=mysqli_query($con,$sqlVanzari);
			 while($rowVanzari=mysqli_fetch_array($resursaVanzari))
			 {
			 $sqlProdus="SELECT titlu, nume_brand, pret FROM produse, branduri where produse.id_brand=branduri.id_brand and id_produs=".$rowVanzari['id_produs'];
			 $resursaProdus=mysqli_query($con,$sqlProdus);
			 while($rowProdus=mysqli_fetch_array($resursaProdus))
			 {
			 print '<td  align="center">';
			 $adresaImagine="coperte/".$rowVanzari['id_produs'].".jpg";
			 if(file_exists($adresaImagine))
			 {
			 print '<img src="'.$adresaImagine.'" width="150px" height="100px"><br/>';
			 }
			 else
			 {
			 print '<div style="width:75px; height:100px; border 1px black solid; background-color:#CCCCCC">Fara imagine</div>';
			 }
			 print '<b><a href="produs.php?id_produs='.$rowVanzari['id_produs'].'">'.$rowProdus['titlu'].'</a></b><br/> de <i>'.$rowProdus['nume_brand'].'</i><br/>Pret: '.$rowProdus['pret'].' lei </td>';
			 }
			 }
		 ?>
		 </tr>
		 </table>
		 </td>
		 </tr>
		 </table>
	<?php 
	 include("page_bottom.php");
	?>
