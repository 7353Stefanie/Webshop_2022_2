<?php

//define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/Hilfsdokumente/Abfragen');
require_once(__ROOT__.'/Abfragen/Abfragen_Sammlung.php'); 


if(  strpos(__DIR__,'Final') == false)
  { 
    $pos=strpos(__DIR__,'Webshop');
  }
  else
  {
    $pos=strpos(__DIR__,'Final');
  }


//echo ('pos'.$pos);

$rest = substr(__DIR__,0,$pos);



include $rest.'/external_incl/my_incl.php';


// Verkäuferposition
//Nr. Datum und Uhrzeit, Bezeichnung , Bild, Kosten, 
//session_start();

 class meineBestellungen
{


public $Bestellposition = Array();

		function AusgabeBestellungen($idBenutzer)
		{
			$Abfragen = new Abfragen();
			$ENDSammlung = Array();
			$Sammlung = Array();
			$KostenSammeln = Array();
		                                        
		           $mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

		           if ($mysqli->connect_error)
		              {
		                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
		              } 

		          else { 	
		          			// Ausgabe aller Daten der Bestellposition
		          			$Bestellposition = $Abfragen->selectBestellpostion_by_Benutzerid($mysqli,$idBenutzer); 

		          			
		          			// idBestellposition, Bestelldatum, Bestellstatus, idBenutzer, idVerkäuferposition, idKaufarten
		          			for($i = 0; $i< count($Bestellposition);$i++)
		          			{

		          				$Kosten = $Abfragen->selectKaufarten_by_idKaufarten($mysqli,$Bestellposition[$i]['idKaufarten']);

		          				$idArtikel = $Abfragen->selectVerkaeuferposition_idArtikel($mysqli,$Bestellposition[$i]['idVerkaeuferposition']);

		          				//var_dump($idArtikel);
		          				$alleArtikel = $Abfragen->selectArtikel_by_ArtikelId($mysqli, $idArtikel['idArtikel']);

								$Kategorien =  $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli, $alleArtikel['Kategorien'], $alleArtikel['idArtikel']);

		          				$Sammlung[$i] = array_merge($Kosten,$Kategorien, $alleArtikel);

		          			}
		          			$ENDSammlung = array_merge( $Sammlung, $Bestellposition);

		          			return $ENDSammlung;

		              }
		             mysqli_close($mysqli);

		     }
 }//Ende class


?>