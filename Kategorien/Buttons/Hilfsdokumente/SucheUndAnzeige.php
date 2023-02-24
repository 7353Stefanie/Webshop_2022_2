<?php
 // define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/');
require_once(__ROOT__.'/Hilfsdokumente/Abfragen/Abfragen_Sammlung.php'); 


/*
if(isset($_SESSION["Erg"]) )
 {  
          $_SESSION["Erg"] = "";  
          $_SESSION["Sammlung"] = "";  
          $_SESSION['gemerkteArtikel'] ="" ; 
          $_SESSION["AnzArtikel"] = ""; 
          $_SESSION["Artikel"] = "";
}*/

// id Artikel in Session speichern


class Anzeige
{

 

 // public $Abfragen;

function gemerkteArtikel()
{

    $Abfragen = new Abfragen();

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                       $gemerkteArtikel = $Abfragen->SelectGemerkteArtikel($mysqli);

                        mysqli_close($mysqli);

                     }

                     return $gemerkteArtikel;
}

function Erg()
{
  $Abfragen = new Abfragen();

 if($_POST != Null)
    {
      
      $_SESSION['idArtikel']  = $_POST['idArtikel'];    
       $idArtikel = $_POST['idArtikel'] ;
    //   echo $_POST['idArtikel'] ;
  }
  else
    { $idArtikel = $_SESSION['idArtikel'] ;}

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                       $Artikel = $Abfragen->selectArtikel_by_ArtikelId($mysqli, $idArtikel); // Artikeldaten des Angeklickten Objektes
                        
                       // var_dump($Artikel);
                    //echo ;

                        $Erg =  $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli, $Artikel['Kategorien'], $idArtikel);
                      // $Erg = switchIt($mysqli, $Artikel, $Artikel,1); //Details wie  z.B.Autor
                    
                     //  var_dump($Erg);
                        mysqli_close($mysqli);

                     }

                     return $Erg;
}

function gesamteArtikel()
{
  
  $Abfragen = new Abfragen();

 if($_POST != Null)
    {
      
      $_SESSION['idArtikel']  = $_POST['idArtikel'];    
       $idArtikel = $_POST['idArtikel'] ;
    //   echo $_POST['idArtikel'] ;
  }
  else
    { $idArtikel = $_SESSION['idArtikel'] ;}
  

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                       $Artikel = $Abfragen->selectArtikel_by_ArtikelId($mysqli, $idArtikel); // Artikeldaten des Angeklickten Objektes
                        
                      
                        mysqli_close($mysqli);

                     }

                     return $Artikel;
}

function Sammlung()
 { 

  $Abfragen = new Abfragen();

      if($_POST != Null)
    {
    $idArtikel = $_POST['idArtikel'] ;
    $_SESSION['idArtikel'] = $_POST['idArtikel'];
    //echo $_POST['idArtikel'] ;
  }else
  {
    $idArtikel = $_SESSION['idArtikel'] ;
  }

    

                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   


            //1. select Artikel gibt den ARtikel mit der entsprechenden id (check)
            //1.1 switchcase Kategorie  caseNr = 1 (check)
            //1.1. select Kategorie speicherung der spezifischen Variablen  (check)      

          //  1.2. überprüfen ob es weitere Artikel gibt, die die gleiche Bezeichnung, und Kategorie haben (true bei weiteren Artikeln) (check)
          //  1.3. Verkäuferposition auslesen, von allen Artikeln mit der ArtikelNrXX und bei true ArtikelNr[X]XX weitereArtikel (check)
          //  1.4. Auselsen der Kaufarten  (check)
           // 1.5. Auselsen der Verkäuferbilder
                    $Sammlung = Array();
                   // $Verkaeuferpositionen = Array();
                    
                   // $Gesammelt = Array();

                    $Artikel = $Abfragen->selectArtikel_by_ArtikelId($mysqli, $idArtikel); // Artikeldaten des Angeklickten Objektes
                   // var_dump($Artikel);
                    //echo ;
                  // $Erg = switchIt($mysqli, $Artikel['Kategorien'], $Artikel,1); //Details wie  z.B.Autor
                    

                    $weitereArtikel = $Abfragen->SelectWeitereArtikel($mysqli,$Artikel['Kategorien'],$Artikel['Bezeichnung']); // gibt es weitere Artikel mit gleicher Bezeichnung?
                    
                    $Anzahl =  count($weitereArtikel); // wenn ja wie viele
                    //var_dump($weitereArtikel);

                 
                    // select gemerkte Artikel
                  


                     for($i = 0; $i<$Anzahl; $i++ ) // läuft aufjeden Fall einmal durch
                   {
                      // mehrere Verkäuferpositionen sind möglich
                      $Verkaeuferposition[$i] = $Abfragen->SelectVerkaeuferposition_byArtikel($mysqli,$weitereArtikel[$i]['idArtikel']); //Ausgabe Verkäuferposition

                     //var_dump($Verkaeuferposition[$i]);

                      if($Verkaeuferposition[$i] !=Null) // Es kann mehrere Verkäuferpositionen für einen Artikel geben
                     { //

                      $AnzahlVerkaeuferpositionen = count($Verkaeuferposition[$i]); 

                     // echo $AnzahlVerkaeuferpositionen. 'Positionen';
                      // Durchlauf der Verkäuferpsoitionen

                            if($AnzahlVerkaeuferpositionen != 0)// wenn es mehr als eine Verkäuferposition gibt, dann
                            {

                               for($p = 0; $p<$AnzahlVerkaeuferpositionen; $p++)
                                  {
                                    if( $Verkaeuferposition[$i][$p]['Verfuegbarkeitsstatus'] != 0)
                                     {
                                        $Kaufarten = Array();
                                          $Kaufarten[$p] = $Abfragen->selectKaufarten_by_idVerkaeuferposition($mysqli,$Verkaeuferposition[$i][$p]['idVerkaeuferposition']);
                                        // var_dump($Kaufarten[$p]);
                                          $Verkaeuferbild[$p] =  $Abfragen->SelectVerkaufsbilder($mysqli,$Verkaeuferposition[$i][$p]['idVerkaeuferposition']);
                                          $Benutzerinformation[$p] = $Abfragen->SelectBenutzer_Name($mysqli,$Verkaeuferposition[$i][$p]['idBenutzer']);

                                          // Ziel alle Positionen einer Verkäuferposition 

                                          
                                          $Sammlung[$i][$p] = array_merge($Verkaeuferposition[$i][$p] ,$Kaufarten,$Benutzerinformation[$p], $Verkaeuferbild[$p]) ;
                                        

                                     }                                      
                                  } 
                                 //var_dump($Sammlung);         

                                  $array[$i]  = array( 'AnzArtikel'  => $Anzahl, 'AnzahlVerkaeuferpositionen' => $AnzahlVerkaeuferpositionen);
                                  
                                  return $Sammlung;
                                                                 
                            } // ende if anz Verk
                      } // ende if is null                    

                    }// ende for
                          //   $_SESSION['gemerkteArtikel'] = $gemerkteArtikel;    
                          //   $_SESSION["Erg"] = $Erg;            // Artikelpsezifischedetails     
                            // $_SESSION["Verkaeuferposition"] = $Verkaeuferposition; // kann leer sein
                          //   $_SESSION["Artikel"] = $Artikel;  // Arikel

                             //var_dump($_SESSION["Verkaeuferposition"]); 
               }   

                 mysqli_close($mysqli);

                   // $serial_arr=urlencode(base64_encode(serialize($Gesammelt)));
               // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/ArtikelDetailsVerkauf.php');
                 
}
             //   return $ErgebnisidArtikel;
 



 function switchIt($mysqli, $Kategorie,$Artikel, $CaseNr)
 {
  $Abfragen = new Abfragen();

 switch ($Kategorie) {
   case 'Buecher':
                if($CaseNr==1)
              { $Erg = $Abfragen->selectBuecher_byArtikelid($mysqli, $_POST['idArtikel']);
                return($Erg);
              }              
     break;

 case 'Alle':
              $Erg = $Abfragen->selectAlle($mysqli);
              return($Erg);
     # code...
     break;

  case 'Kleidung':

              if($CaseNr==1)
              { $Erg = $Abfragen->selectKleidung($mysqli,$_SESSION['$idArtikel']);
                return($Erg);
              }
     # code...
     break;

    case 'Fahrzeug':
     # code...
     break;
     case 'Spielzeug':
     # code...
     break;
     case 'FreizeitundSport':
     # code...
     break;
     case 'Sonstiges':
     # code...
     break;
     case 'HaushaltundGarten':
     # code...
     break;
   
   default:
     # code...
     break;
 }
} // ende funktion

}// ende class