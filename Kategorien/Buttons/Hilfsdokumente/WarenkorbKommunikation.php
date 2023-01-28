<?php


require_once(__ROOT__.'/Abfragen/Abfragen_Sammlung.php'); 
//include __DIR__ . '/../external_incl/my_incl.php';

$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);


include $rest.'external_incl\my_incl.php';


class WarenkorbKommunikation
{



    function WarenkorbInfos($idBenutzer)
    {
          $Abfragen = new Abfragen();

         $Warenkorbinfos = Array();
         
          try
          {

                $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else {

                        $Warenkorbinfos = $Abfragen->Warenkorbinfos($mysqli,$idBenutzer);                      
                       
                    }

             mysqli_close($mysqli);
          }
          catch(Exception $ex)
          {

          }
         

            return $Warenkorbinfos;

    }

       function Guthaben($idBenutzer)
    {
         $Guthaben = Array();
         #
         $Abfragen = new Abfragen();


          try
          {

               $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else {

                         $Guthaben = $Abfragen->selectBenutzer_Guthaben($mysqli,$idBenutzer);                       
                       
                    }       

            mysqli_close($mysqli);
            var_dump($Guthaben);
            
          }
          catch(Exception $ex)
          {

          }


            return $Guthaben;

    }



  function Warenkorb($idBenutzer)
{
    $Abfragen = new Abfragen();
    $Sammlung = Array();

                                                   
           $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

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
