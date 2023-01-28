<?php

require_once(__DIR__.'\Hilfsdokumente\Abfragen\Abfragen_Sammlung.php'); 
require_once(__DIR__.'\Hilfsdokumente\Abfragen\Kategorien.php'); 

$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);

echo $rest;
include $rest.'external_incl\my_incl.php';

echo $DBserver,$DBuser,$DBpassword,$DBname;


class Suche_Artikel // wird in suchev2 verwendet
{


 function suche($Kategorie,   $Bezeichnung)
 { 
  $Abfragen = new Abfragen();

                mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

                $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   


                    //charakerUeberpruefung($Ergebnis);
                    $ErgebnisidArtikel = $this->switchIt($mysqli, $Kategorie, $Abfragen , $Bezeichnung);  
                     mysqli_close($mysqli);
                    }   
                
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




 function suche_allg($Kategorie,   $Bezeichnung) // wird bei suche V2 ausgeführt
 { 
  $Abfragen = new Abfragen();





// $mysqli = @new mysqli('localhost','Webshop','','');
  mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

                  $mysqli = @new mysqli($DBserver, $DBuser, $DBpassword,$DBname);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                     $ErgebnisidArtikel = $this->switch_allgSuche($mysqli, $Kategorie, $Abfragen,  $Bezeichnung);

                  mysqli_close($mysqli);

               }   
                
                return $ErgebnisidArtikel;
 } // ende function

 function Ergebnissuche_Alles_Kleidung($mysqli,$Abfragen,$Ergebnis)
 {
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

               return $Ergebnis;
 }





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


function sucheAlleArtikelEinerKategorie( $Kategorie)
{
 # gebe alle  Bücher aus
   $Abfragen = new Abfragen();

                 $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

         $Erg = $Abfragen->sucheAlleArtikelEinerKategorie($mysqli, $Kategorie);

         //var_dump($Erg);

                $i = 0;

               $ArtikelElemString = Array();
                $idListe = Array();
               
                foreach( $Erg as $idArtikel )
               {
                  $idListe[$i] = $idArtikel['idArtikel'];
                  $i++;
               }

                $ArtikelElemString = implode("','", $idListe);

               // var_dump( $ArtikelElemString);

                $AusgabeBuecher = $Abfragen->selectBuecher_byArtikelid_Liste($mysqli, $ArtikelElemString);

                $AusgabeArtikel = $Abfragen->selectAlleArtikel_Alle_Liste($mysqli, $ArtikelElemString);

                 $Ergebnis = array_merge($AusgabeArtikel, $AusgabeBuecher);

              }

         //speichere alle idArtikel in einer Datei und lasse alle Bücher dieser Artikel aus

          mysqli_close($mysqli);


         return  $Ergebnis;
       }


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

                   // gebe alle Artikel der Kategorie Kleidung aus
     # code...
     break;
   

 
                 }// ende switch
}// ende function


function auslagerung_Suche_switch(Array $Ergebnis,  $Abfragen, $mysqli)
{
      try{
   

            if($Ergebnis != null )

              { //$Ergebnis =  Ergebnissuche_Alles_Kleidung($mysqli,$Abfragen, $Erg); // $Ergebnis enthällt alle Artikel die Verfügbar sind.

                 $idListe = Array();
               $AusgabeKleidung = Array();
               $ArtikelElemString = Array();
               $AusgabeVerfügbarkeit = Array();
               $AusgabePreise = Array();
               $i = 0;

              // var_dump($Ergebnis);

               foreach( $Ergebnis as $idErg )
               {
                  $idListe[$i] = $idErg['idArtikel'];
                  $i++;
               } // auslesen der Artikel id // Alle idArtikel werden in eine Liste gespeichert

               $ArtikelElemString = implode("','", $idListe);

               $AusgabeKleidung= $Abfragen->selectKleidungArray($mysqli,  $ArtikelElemString);

               // auslesen der Artikel id und mit den Daten in tabelle Kleiung vergleichen
              // echo ('hallo');
               //var_dump( $ArtikelElemString); 

               var_dump($AusgabeKleidung);

               //Zeige alle Preise von Kaufarten, für die liste idArtikel, an wo der Verfuegbarkeitsstatus 1 und 0 ist 
             

          

               $AusgabeVerfuegbarkeit = $Abfragen->SelectVerkaeuferposition_byArtikel_outIdVerkaeuferposition_Verfuegbarkeitsstatus01($mysqli,$ArtikelElemString);



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

                    if(isset($Ergebnis ,$AusgabeKleidung, $AusgabeVerfuegbarkeit, $AusgabePreise))
                    {
                            $Ergebnis = array_merge($Ergebnis ,$AusgabeKleidung, $AusgabeVerfuegbarkeit, $AusgabePreise );

                    }
              else
                    {
                      $Ergebnis = null;

                     echo'  <div class="container"><h4>Leider wurden keine Ergebnisse zu Deiner Suchanfrage gefunden.</h4></div>';
                    }
            } 
           }
            catch(Exception $err)
            {echo $err;}

            

              return $Ergebnis;
               
             
              //$idListe = Array();
              // $i = 0;

              /* foreach( $Ergebnis['idArtikel'] as $idErg )
               {
                  $idListe[$i] = $idErg;

               }*/

              

             // $Ergebnis2 =  $Abfragen->selectKleidungArray($mysqli, $idListe); // Alle Kleidungsergebnisse ohne Preise etc.
//
             // var_dump($Ergebnis2);array_merge($Ergebnis,$Ergebnis2);

               
               #Wenn Kategorie Kleidung dabei ist muss noch der Preis und die Größe und Marke ermittelt werden

               #schleife
             

}  // ende funktion

function wenn_Bezeichnung_null(Array $Ergebnis,  $Abfragen, $mysqli)
{




              // var_dump($Ergebnis);

              //$Ergebnis =  Ergebnissuche_Alles_Kleidung($mysqli,$Abfragen,$Ergebnis);

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

                     if($AusgabeKleidung != null)
                     {
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
                    }
                    return $Ergebnis;
                  
}


 function switch_allgSuche($mysqli, $Kategorie, $Abfragen,  $Bezeichnung)
 {

$Endergebnis = Array() ;

 switch ($Kategorie) {
 case 'Alle':

 //Zeige alle verfügbaren Bücher und Kleidungen an. Limit setzten

 //gebe alle Artikel aus die den Verfügbarkeitsstatus 1 haben.

 //gebe anhand der idArtikel die Bücher aus

 //gebe anhand der idArtikel die Kleidung aus und anhand der Kategorie die Kategoriedetails



              if($Bezeichnung !=null)
             {
               $Ergebnis= $Abfragen->selectAlleArtikel($mysqli, $Bezeichnung);
                $Endergebnis =  $this->auslagerung_Suche_switch($Ergebnis, $Abfragen, $mysqli);
             }
             else
             {
                $Ergebnis= $Abfragen->selectAlleArtikel_Alle($mysqli);
                $Endergebnis =  $this->wenn_Bezeichnung_null( $Ergebnis,  $Abfragen, $mysqli);
             }
               //var_dump($Ergebnis);
              
              
               //echo ('ende Liste ---------------------------------------------');
              
              

             
              // Hersteller ist in diesem Fall der Autor

              return($Endergebnis);
     break;

 case 'Buecher':
               if($Bezeichnung !=null)
             {
               $Ergebnis= $Abfragen->selectAlleArtikel_nur_Buecher($mysqli, $Bezeichnung);
               //var_dump($Ergebnis);

               $Endergebnis =  $this->auslagerung_Suche_switch($Ergebnis);
              }
               else
             {
                $Ergebnis= $Abfragen->selectAlleBuecher_Alle($mysqli);
                $Endergebnis =  $this->wenn_Bezeichnung_null( $Ergebnis,  $Abfragen, $mysqli);
             }
            return  $Endergebnis;
 

              
     # code...
     break;

case 'Kleidung': // group by idArtikel


        
             if($Bezeichnung !=null)
             {
               $Ergebnis= $Abfragen->selectAlleArtikel_nur_Kleidung($mysqli, $Bezeichnung);
               //var_dump($Ergebnis);

               $Endergebnis =  $this->auslagerung_Suche_switch($Ergebnis);
              }
               else
             {
                $Ergebnis= $Abfragen->selectAlleKleidung_Alle($mysqli);
                $Endergebnis =  $this->wenn_Bezeichnung_null( $Ergebnis,  $Abfragen, $mysqli);
             }
            return  $Endergebnis;
              

     # code...
     break;

 
   
   default:

     # code...
     break;
                 }// ende switch
}// ende function


} // ende class
?>