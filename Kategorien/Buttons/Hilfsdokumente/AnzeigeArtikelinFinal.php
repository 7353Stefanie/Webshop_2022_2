<?php

require_once(__ROOT__.'/Abfragen/Abfragen_Sammlung.php'); 

class Suche
{

 function suche()
 { 

  $Abfragen = new Abfragen();

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {  

                    $Egebnis = $Abfragen->selectAlleArtikelFinal($mysqli);
                 

                 // Ziel: Ausgabe aller Kategorien, alle verfügbaren Artikel, Bild, titelname(falls das Bild nicht angezeigt wird.)

              

                                 
               }   
              // $_SESSION["Verkaeuferpositionen"]  =  $Pos;
              // $_SESSION["Kaufarten"]  =  $Kaufarten;
                 
                 
               //$_SESSION["ErgebnisidArtikel"]  =  $ErgebnisidArtikel2;
                 mysqli_close($mysqli);

            //  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/sucheV2.php');
 }








 // function switchIt($mysqli, $Kategorie, $Suche, $Abfrage)
 // {


 // switch ($Kategorie) {
 //   case 'Buecher':
 //              $Erg = $Abfragen->selectBuecher_AllgemeineSuche($mysqli, $Suche);

 //              return($Erg);
 //     break;

 // case 'Alle':
             
 //             $Erg =   $Abfragen->selectBuecher_AllgemeineSuche($mysqli, $Suche);
 //             $Ergo2 =  $Abfragen->selectKleidung_Suche($mysqli, $Suche);

 //             array_push($Erg,$Ergo2);

            

 //              return($Erg);
 //     # code...
 //     break;

 //  case 'Kleidung':

 //            $Erg =  $Abfragen->selectKleidung_Suche($mysqli, $Suche);


 //     # code...
 //     break;

 //    case 'Fahrzeug':
 //     # code...
 //     break;
 //     case 'Spielzeug':
 //     # code...
 //     break;
 //     case 'freizeit+sport':
 //     # code...
 //     break;
 //     case 'sonstiges':
 //     # code...
 //     break;
 //     case 'haushaltundgarten':
 //     # code...
 //     break;
   
 //   default:
 //     # code...
 //     break;
 // }
}

 // ende Klasse
  ?>