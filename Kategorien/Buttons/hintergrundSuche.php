<?php

require_once(__ROOT__.'/Hilfsdokumente/Abfragen/Abfragen_Sammlung.php'); 

class Suche_Artikel
{
 function suche($Kategorie,   $Bezeichnung)
 { 
  $Abfragen = new Abfragen();

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   



                    $ErgebnisidArtikel = $this->switchIt($mysqli, $Kategorie,$Abfragen , $Bezeichnung);  
               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 } // ende function

 function suche_allg($Kategorie,   $Bezeichnung)
 { 
  $Abfragen = new Abfragen();

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                     $ErgebnisidArtikel = $this->switch_allgSuche($mysqli, $Kategorie, $Abfragen,  $Bezeichnung);

                 

               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 } // ende function



// Suche die Artikel mit der Bezeichnung XX
// Finde herraus ob es eine Verkäuferposition zu diesem Artikel gibt
// Suche dann den Preis dieser Artikel heraus

  
//select * from Artikel , Kategorie where 

 // select * from 'Kategorie' where id Artikel = x
 // alle Artikel auslesen
 // alle Kategorien der Artikel auslesen anhand der idArtikel


/*
SUche :

Ermittel die Kagtegorien
Buch; Kleidung....

mehrere Kategrien gleichzeitig?

Ausgabe aus allen Kategorien.
*/


 function switchIt($mysqli, $Kategorie, $Abfragen,  $Bezeichnung)
 {



 switch ($Kategorie) {

   case 'Buecher':
              $Erg = $Abfragen->selectBuecher($mysqli, $Bezeichnung);  // Hersteller ist in diesem Fall der Autor

              return($Erg);
     break;

 case 'Alle': //1 . ermittel alle angesprochenen Kategorien
              // Suche in allen Kategorien


              $Erg = $Abfragen->selectAlleArtikel($mysqli, $Bezeichnung);
 

              return($Erg);

case 'Kleidung': // group by idArtikel

     # code...
     break;
   

 
                 }// ende switch
}// ende function

 function switch_allgSuche($mysqli, $Kategorie, $Abfragen,  $Bezeichnung)
 {



 switch ($Kategorie) {
 case 'Alle':
              if($Bezeichnung !=null)
             {
               $Ergebnis= $Abfragen->selectAlleArtikel($mysqli, $Bezeichnung);
               #Wenn Kategorie Kleidung dabei ist muss noch der Preis und die Größe und Marke ermittelt werden

               #schleife

                 
             }
              else
             {
               $Ergebnis= $Abfragen->selectAlleArtikel_Alle($mysqli);
             }
              // Hersteller ist in diesem Fall der Autor

              return($Ergebnis);
     break;

 case 'Buecher':
               if($Bezeichnung !=null)
             {
               $Ergebnis =  $Abfragen->selectKategorie($mysqli,$Bezeichnung, $Kategorie);
             }
             else
             {
              $Ergebnis =  $Abfragen->selectKategoriealle($mysqli,$Kategorie);
             }
 

              return( $Ergebnis);
     # code...
     break;

case 'Kleidung': // group by idArtikel

     # code...
     break;

 
   
   default:

     # code...
     break;
                 }// ende switch
}// ende function


} // ende class
?>