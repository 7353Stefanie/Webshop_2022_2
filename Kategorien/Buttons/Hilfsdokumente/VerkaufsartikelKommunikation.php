<?php
        

require_once(__DIR__.'\Abfragen\Abfragen_Sammlung.php');

$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);


include $rest.'external_incl\my_incl.php';

            // Alle Verkaufsartikel eines Verkäufers (idVerkaufsartikel) (Verkausmenge,idArtikel, Zustand, Artikelbeschreibung)
            // Preise zu den Verkaufsartikeln (idVerkaufsartikel)#
            // Artikelinformationen  entsprechend Kategorie

            /*  1. Warenkorbdetails auslesen (check)
                2. Anhand der Verkaeuferid können Verkäuferdetails gelesen werden (check)
                3. Anhand der Verkaeuferid können Kaufdetails gelesen werden (check)
                4. Anhand der Artikelid kann die Kategorie ermittelt werden
                5. Anhander Kategorie können die Artikeldetails ermittelt werden.
            */  
 class VerkaufsartikelKommunikation
 {   



 function Verkaufsartikel($idBenutzer)
                {

          $Abfragen = new Abfragen();  
          $Artikelinfos = Array();

                                                   
           $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

           if ($mysqli->connect_error)
              {
                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
              } 

          else { 

                $Artikelinfos =  $Abfragen->Artikelinformationen_byidBenutzer_sort_idVk($mysqli, $idBenutzer);
                $AnzahlArtikel = count($Artikelinfos);

                // var_dump($Artikelinfos);

                for($i = 0; $i<  $AnzahlArtikel; $i++)
                 { 
                    $Preise          =  $Abfragen->selectKaufarten_by_idVerkaeuferposition($mysqli,$Artikelinfos[$i]['idVerkaeuferposition'] );  
                  
                    $Artikeldetails  =  $Abfragen->selectArtikel_by_ArtikelId($mysqli, $Artikelinfos[$i]['idArtikel']);
                   
                    $KategorieInfos  =  $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli,  $Artikeldetails['Kategorien'], $Artikeldetails['idArtikel']) ;   

                    $Sammlung2[$i] = array_merge($Artikeldetails,$KategorieInfos,$Artikelinfos[$i], $Preise);
                 }


                 return $Sammlung2;

                 $mysqli->close();   
                // var_dump($Warenkorbinfos);

                
                 
               } // ende else
             } // ende function
                 

          





/*function Kaufinfos($mysqli, $idVerkaeuferposition)
{
      $query = sprintf("SELECT  Preis, Zustand, Verkaufsmenge,  Kaufarten, v.idVerkaeuferposition, idArtikel, Kauf, Tausch, Verfuegbarkeitsstatus
                         from    Kaufarten k, Verkaeuferposition v
                         where  v.idVerkaeuferposition = k.idVerkaeuferposition 
                         and    v.idVerkaeuferposition = '%s'
                         Group by v.idVerkaeuferposition, Kaufarten",                                                         
                                                          
                         $mysqli->real_escape_string($idVerkaeuferposition) 

                         ); 

                            $result = $mysqli->query($query);     

                    if ( !  $result )
                       {
                         die('Ungültige Abfrage: ' . mysqli_error());
                       }

                   $rows = Array(); 


                  while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                            $rows[] = $row;  
                     }                                                   

                  mysqli_free_result( $result );               

                  return $rows; 
}*/

}// ende class

?>
