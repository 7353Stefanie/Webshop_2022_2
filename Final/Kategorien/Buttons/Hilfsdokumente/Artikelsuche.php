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
                 
                    $z =0;
                    $u =0;
                  
                    $Pos = Array(); 
                    $Kaufarten = Array();

                    $ErgebnisidArtikel2 = Array();


                    $ErgebnisidArtikel = switchIt($mysqli, $Kategorie, $Suche, $Abfrage);  
                    $Anz = count($ErgebnisidArtikel);
                    
                    $Anz2 = count($ErgebnisidArtikel[$Anz-1]);

                    echo $Anz2;

                    //

                    foreach ( $ErgebnisidArtikel as $key ) {
                            if(isset($key['idArtikel']))
                            {
                              $Pos[$z] = $Abfragen->SelectVerkaeuferposition_byArtikel($mysqli,$key['idArtikel']);
                              //var_dump( $Pos[$z]);
                              if($Pos[$z] !=null)
                              {
                               $ErgebnisidArtikel2[$u] = $key;
                               $Kaufarten[$u] =$Abfragen->selectKaufarten_by_idVerkaeuferposition($mysqli,$Pos[$z]['0']['idVerkaeuferposition']);
                                $u++;
                              }
                              $z++;
                            } 
                      else{

                        for($v = 0; $v < $Anz2; $v++)
                        {
                        // var_dump( $key[$v]['idArtikel']);
                           $Pos[$z] = $Abfragen->SelectVerkaeuferposition_byArtikel($mysqli,$mysqli,$key[$v]['idArtikel']); 

                         //var_dump($Pos[$z]);                          
                        
                              if($Pos[$z] !=null)
                              {
                               // var_dump('in IF'); 
                                $ErgebnisidArtikel2[$u] = $key[$v];
                                //var_dump($Pos[$z]);
                                var_dump($Pos[$z]['0']['idVerkaeuferposition']);
                                
                               // echo($Pos['idVerkaeuferposition']);
                                $Kaufarten[$u] = $Abfragen->selectKaufarten_by_idVerkaeuferposition($mysqli,$Pos[$z]['0']['idVerkaeuferposition']);

                                $u++;
                              }
                           $z++;
                         }// ende for
                      }// ende else    
                    }// ende foreach

                    var_dump($Kaufarten);

                                 
               }   
              // $_SESSION["Verkaeuferpositionen"]  =  $Pos;
              // $_SESSION["Kaufarten"]  =  $Kaufarten;
                 
               //$_SESSION["ErgebnisidArtikel"]  =  $ErgebnisidArtikel2;
                 mysqli_close($mysqli);

            //  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/sucheV2.php');
 }








 function switchIt($mysqli, $Kategorie, $Suche, $Abfrage)
 {


 switch ($Kategorie) {
   case 'Buecher':
              $Erg = $Abfragen->selectBuecher_AllgemeineSuche($mysqli, $Suche);

              return($Erg);
     break;

 case 'Alle':
             
             $Erg =   $Abfragen->selectBuecher_AllgemeineSuche($mysqli, $Suche);
             $Ergo2 =  $Abfragen->selectKleidung_Suche($mysqli, $Suche);

             array_push($Erg,$Ergo2);

            

              return($Erg);
     # code...
     break;

  case 'Kleidung':

            $Erg =  $Abfragen->selectKleidung_Suche($mysqli, $Suche);


     # code...
     break;

    case 'Fahrzeug':
     # code...
     break;
     case 'Spielzeug':
     # code...
     break;
     case 'freizeit+sport':
     # code...
     break;
     case 'sonstiges':
     # code...
     break;
     case 'haushaltundgarten':
     # code...
     break;
   
   default:
     # code...
     break;
 }
}

} // ende Klasse
  ?>