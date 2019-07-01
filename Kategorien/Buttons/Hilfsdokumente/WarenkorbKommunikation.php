<?php


require_once(__ROOT__.'/Abfragen/Abfragen_Sammlung.php'); 

class WarenkorbKommunikation
{



    function WarenkorbInfos($idBenutzer)
    {
          $Abfragen = new Abfragen();

         $Warenkorbinfos = Array();
         
          try
          {

                $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else {

                        $Warenkorbinfos = $Abfragen->Warenkorbinfos($mysqli,$idBenutzer);                      
                       
                    }

            
          }
          catch(Exception $ex)
          {

          }
          mysqli_close($mysqli);

            return $Warenkorbinfos;

    }

       function Guthaben($idBenutzer)
    {
         $Guthaben = Array();
         #
         $Abfragen = new Abfragen();


          try
          {

                $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else {

                         $Guthaben = $Abfragen->selectBenutzer_Guthaben($mysqli,$idBenutzer);

                       
                       
                    }       

          }
          catch(Exception $ex)
          {

          }
          mysqli_close($mysqli);

            return $Guthaben;

    }



  function Warenkorb($idBenutzer)
{
    $Abfragen = new Abfragen();
    $Sammlung = Array();

                                                   
           $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

           if ($mysqli->connect_error)
              {
                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
              } 

          else { 

            /*  1. Warenkorbdetails auslesen (check)
                2. Anhand der Verkaeuferid können Verkäuferdetails gelesen werden (check)
                3. Anhand der Verkaeuferid können Kaufdetails gelesen werden (check)
                4. Anhand der Artikelid kann die Kategorie ermittelt werden
                5. Anhander Kategorie können die Artikeldetails ermittelt werden.
            */      $Warenkorbinfos = $Abfragen->Warenkorbinfos($mysqli,$idBenutzer);


                // var_dump($Warenkorbinfos);

                 $AnzahlWarenkorbartikel = count($Warenkorbinfos);
                 //echo $AnzahlWarenkorbartikel;

                 
                  //var_dump($Guthaben); 

                 //schleife
                 for($i = 0; $i<  $AnzahlWarenkorbartikel; $i++)
                 {                   

                    $Kaufinfos = $Abfragen->Kaufinfos($mysqli, $Warenkorbinfos[$i]['idVerkaeuferposition']);
                    //var_dump($Kaufinfos);               

                    $Artikelinfos = $Abfragen->selectArtikel_by_ArtikelId($mysqli, $Kaufinfos['0']['idArtikel']);
                     // alle Artikel sortiert nach der Artikelid

                    //var_dump($Artikelinfos);

                    $KategorieInfos = $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli, $Artikelinfos['Kategorien'], $Artikelinfos['idArtikel']);
                    //var_dump($KategorieInfos);  

                    $Sammlung[$i] = array_merge($Kaufinfos ,$Artikelinfos ,$KategorieInfos);             

                 }// ende for
               
                 return $Sammlung;
                   
                 
              }
             mysqli_close($mysqli);
}// ende Funktion

} // ende Klasse

?>
