<?php

// Radiobuttonwerte abfragen!! Adresse und Zahlungsart

 session_start();
  /* $_SESSION['Warenkorbartikel'] = "";  

   $_SESSION['Guthaben'] = ""; 
   $_SESSION['Warenkorbinfos'] = "";
   $_SESSION['Adresse'] = "";
   $_SESSION['Zahlungsmethode'] = "";*/

   // define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/Hilfsdokumente');

    require_once(__ROOT__.'/Abfragen/Abfragen_Sammlung.php'); 
   // require_once(__ROOT__.'/WarenkorbKommunikation.php');

    $kaufen = new KaufeArtikelK();
    $kaufen->KaufeArtikelJetzt();


class KaufeArtikelK

{

  function KaufeArtikelJetzt()
  {


  // $Warenkorb_Kom = new WarenkorbKommunikation();
   $Abfragen = new Abfragen();

  // $Guthaben = $Warenkorb_Kom::Guthaben($_SESSION['idBenutzer']); 
  // $Warenkorbartikel = $Warenkorb_Kom::Warenkorb($_SESSION['idBenutzer']); 

                                                  
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
            */  

               // echo $_SESSION['idBenutzer'];

                $Warenkorbinfos = $Abfragen->Warenkorbinfos_Id($mysqli, $_SESSION['idBenutzer']);
                // var_dump($Warenkorbinfos);
                if($Warenkorbinfos == null)
                { 
                  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Warenkorb.php');
                }
                  else
                  {

                       $AnzahlWarenkorbartikel = count($Warenkorbinfos);
                       //echo $AnzahlWarenkorbartikel;

                       // $Guthaben = $Abfragen->SelectBenutzer_Name_Guthaben($mysqli, $_SESSION['idBenutzer']);
                        
                       $Warenkorbinfos2 = Array();
                                    

                        for($i = 0; $i<  $AnzahlWarenkorbartikel; $i++)
                       {
                        $Warenkorbinfos2[$i] = $Warenkorbinfos[$i]['idVerkaeuferposition'];                
                       } 
                     

                       $comma_separated = implode("','", $Warenkorbinfos2);

                       //var_dump($comma_separated );

                       //var_dump($Warenkorbinfos2);    

                       //schleife

                                                                  $Kaufinfos = $Abfragen->Kaufinfos_Array($mysqli,  $comma_separated);

                                                                 //var_dump($Kaufinfos);
                  $doppelt = Array();
                  $n = 0;

                   for($i = 0; $i<=  $AnzahlWarenkorbartikel; $i++)
                 {
                  $idArtikel[$i] = $Kaufinfos[$i+1]['idArtikel']; 

                  
                      if($Kaufinfos[$i]['idArtikel']  == $Kaufinfos[$i+2]['idArtikel'] )
                      {
                        $doppelt[$n] = $Kaufinfos[$i]['idArtikel'];
                        $n++;
                        $i++;
                      } 

                  $i++;
                 } 

                // var_dump($idArtikel);
                 $einmal = array_unique($idArtikel);
                // var_dump($doppelt);

                 $idArtikelString = implode("','",$einmal);

                 //echo $idArtikelString ;
                                                                  
                                                                  $Artikelinfos = $Abfragen->selectArtikel_by_ArtikelId_Array($mysqli, $idArtikelString);
                 //var_dump($Artikelinfos);

                   //ab wo ändert sich die kategorie ?
                   //ausgabe des arrayFeldes und Kategorie in array schreiben                                              
                   $ArtikelElem = Array();
                   $alteKategorie  =$Artikelinfos['0']['Kategorien'];                   
                   $neueKategorie ='';
                   $KategorieInfos = Array();
                   $t= 0;

                  //var_dump(count($doppelt));
                  
                   $anz = $AnzahlWarenkorbartikel -count($doppelt);
                  // echo $anz;
                   for($i = 0; $i<  $anz; $i++)
                 {

                  $neueKategorie = $Artikelinfos[$i]['Kategorien']; 
                  //$KategorieElem[$i] = $Artikelinfos[$i]['Kategorien'];   

                  //echo 'draußen';

                  if($neueKategorie != $alteKategorie)
                  {
                    //echo 'drinnen';
                    $t= 0;
                    $ArtikelElemString = implode("','", $ArtikelElem);

                   //var_dump($ArtikelElemString);
                    $KategorieInfos[$t] = $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId_Array($mysqli,  $alteKategorie,  $ArtikelElemString) ;
                    $ArtikelElem = Array();
                    $t++;
                  }

                  $ArtikelElem[$i] = $Artikelinfos[$i]['idArtikel'];                  
                  
                  //var_dump($KategorieInfos);
                  $alteKategorie = $Artikelinfos[$i]['Kategorien'];                                                
                 } 

                  $ArtikelElemString = implode("','", $ArtikelElem);

                 // var_dump($alteKategorie);

                  // var_dump($ArtikelElemString);
                    $KategorieInfos[$t] = $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId_Array($mysqli,  $alteKategorie,  $ArtikelElemString) ;
                    $ArtikelElem = Array();

                // var_dump($KategorieInfos);

    

                 $Sammlung = array_merge($Kaufinfos ,$Artikelinfos ,$KategorieInfos);  
                // var_dump($Sammlung);
                
                 //$_SESSION['Warenkorbartikel'] = $Sammlung;    
               return $Sammlung;

                
        /*
               $radiobuttons = Array();

                $radiobuttons= $_SESSION['Radiobutton'];

                for( $i = 0; $i < count($_SESSION['Radiobutton']); $i++)
                 {                    

                    $radio =  $radiobuttons['Kaufarten_'.$i];

                    $radioSplit = explode('W', $radio);

                    if($radioSplit['0'] == 'Tauschkosten')
                    {
                        $Abfragen->updateWarenkorbButton($mysqli, $radioSplit['2'], 'T');
                    }
                    else
                    {
                        $Abfragen->updateWarenkorbButton($mysqli, $radioSplit['2'], 'K');
                    }
                  }

                   $_SESSION['Zahlungsmethode']  = $Abfragen->selectZahlungsart_by_Benuzter($mysqli,  $idBenutzer);
                */
                  

                 $mysqli->close();   
                 }   
              }
    

               //  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/Zahlung.php');

}

function Zahlungsart( $idBenutzer)
 {

   $Abfragen = new Abfragen();

         $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else { 
                        $Arr = Array();
                       $Arr =  $Abfragen::selectZahlungsart_by_Benuzter($mysqli, $_SESSION['idBenutzer']);

                   return $Arr;

                }
      } 

function updateWarenkorb($Radio, $ToderK)
 {
   $Abfragen = new Abfragen();

         $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else { 

                   $Abfragen->updateWarenkorbButton($mysqli, $Radio, $ToderK);
                }
      } 
    function Adresse()
    {
       $Abfragen = new Abfragen();

         $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error)
                    {
                        echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                    } 

                else { 

                 return $Adresse = $Abfragen->Adresse($mysqli);
                }
      }  // ende function

}// ende class

?>