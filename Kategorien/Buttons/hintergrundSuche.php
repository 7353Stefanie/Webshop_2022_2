<?php

require_once(__ROOT__.'/Hilfsdokumente/Abfragen/Abfragen_Sammlung.php'); 

 

class Suche_Artikel // wird in suchev2 verwendet
{


 function suche($Kategorie,   $Bezeichnung)
 { 
  $Abfragen = new Abfragen();

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   



                    $ErgebnisidArtikel = $this->switchIt($mysqli, $Kategorie, $Abfragen , $Bezeichnung);  
               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 } // ende function

 function AnzahlderArrayVariablenzumSplitten($VariableZumSplitten, $Array)
 {

   $AnzahlStatus = 0;

  for ($i=0; $i < count($Array); $i++) { 

      $KeyExStatus = array_key_exists($VariableZumSplitten,$Array[$i]);

    if($KeyExStatus == true)
    {
      $AnzahlStatus = $AnzahlStatus+1;    
    }

    if($KeyExStatus == false &&  $AnzahlStatus >0)
    {
      break;
    }
   
  }

  return $AnzahlStatus;
}

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
              //nehem alle idArtikel und dazu alle Kleidungen
              //Select * from Kleidung where idArtikel = $idArtikel

              return($Erg);
     break;

 case 'Alle': //1 . ermittel alle angesprochenen Kategorien
              // Suche in allen Kategorien


              $Erg = $Abfragen->selectAlleArtikel($mysqli, $Bezeichnung);
 

              return($Erg);

case 'Kleidung': // größe marke und preis wird benötigt group by idArtikel
                  
                   $Erg = $Abfragen->selectAlleArtikel($mysqli, $Bezeichnung);
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

               
              $idListe = Array();
               $i = 0;

               foreach( $Ergebnis['idArtikel'] as $idErg )
               {
                  $idListe[$i] = $idErg;

               }

               echo ('hallo');
               var_dump($idErg); 

               var_dump($idListe);

                $Ergebnis  = Array();

             // $Ergebnis2 =  $Abfragen->selectKleidungArray($mysqli, $idListe); // Alle Kleidungsergebnisse ohne Preise etc.
//
             // var_dump($Ergebnis2);array_merge($Ergebnis,$Ergebnis2);

               
               #Wenn Kategorie Kleidung dabei ist muss noch der Preis und die Größe und Marke ermittelt werden

               #schleife

                 
             }
              else
             {
               $Ergebnis= $Abfragen->selectAlleArtikel_Alle($mysqli);

               $idListe = Array();
               $AusgabeKleidung = Array();
               $ArtikelElemString = Array();
               $AusgabeVerfügbarkeit = Array();
               $AusgabePreise = Array();
               $i = 0;

               foreach( $Ergebnis as $idErg )
               {
                  $idListe[$i] = $idErg['idArtikel'];
                  $i++;
               } // auslesen der Artikel id 

               $ArtikelElemString = implode("','", $idListe);



               $AusgabeKleidung= $Abfragen->selectKleidungArray($mysqli,  $ArtikelElemString);

               // auslesen der Artikel id und mit den Daten in tabelle Kleiung vergleichen
              // echo ('hallo');
               //var_dump( $ArtikelElemString); 

               //var_dump($AusgabeKleidung);

               //Zeige alle Preise von Kaufarten, für die liste idArtikel, an wo der Verfuegbarkeitsstatus 1 und 0 ist 

               $AusgabeVerfügbarkeit = $Abfragen->SelectVerkaeuferposition_byArtikel_outIdVerkaeuferposition_Verfuegbarkeitsstatus01($mysqli,$ArtikelElemString);

               $i = 0;
               $ArtikelElemString = Array();
                $idListe = Array();
               
                foreach( $AusgabeVerfügbarkeit as $idErg )
               {
                  $idListe[$i] = $idErg['idVerkaeuferposition'];
                  $i++;
               }

               $ArtikelElemString = implode("','", $idListe);

                $AusgabePreise = $Abfragen->selectKaufarten_by_idVerkaeuferposition_Array($mysqli,$ArtikelElemString);
               // ausgabe des Preises

               $Ergebnis = array_merge($Ergebnis ,$AusgabeKleidung, $AusgabeVerfügbarkeit, $AusgabePreise );

               //echo ('ende Liste ---------------------------------------------');

              

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