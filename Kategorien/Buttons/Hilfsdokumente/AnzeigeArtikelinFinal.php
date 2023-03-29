<?php

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

//echo ('rest'.$rest);


include($rest.'/external_incl/my_incl.php');








class Suche
{

 function suche()
 { 

  $Abfragen = new Abfragen();
  $Ergebnis= "";


                 $mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
                 

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {  

                    $Ergebnis = $Abfragen->selectAlleArtikelFinal($mysqli);

                    
                 return $Ergebnis;

                 // Ziel: Ausgabe aller Kategorien, alle verfügbaren Artikel, Bild, titelname(falls das Bild nicht angezeigt wird.)

              
                mysqli_close($mysqli);
                                 
               }   
              // $_SESSION["Verkaeuferpositionen"]  =  $Pos;
              // $_SESSION["Kaufarten"]  =  $Kaufarten;
                 
                 
               //$_SESSION["ErgebnisidArtikel"]  =  $ErgebnisidArtikel2;
                 

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