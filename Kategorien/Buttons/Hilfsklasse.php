<?php 
class Hilfsklasse

{

//Gibt die Anzahl der gemergeten Tabellen an
 function array_Key_count($gemerkteArtikeldP,String $Schluessel)
{
                                                  $merkeStart = Array();

                                                  $Start = 0;

                                                  $keys = array_keys($gemerkteArtikeldP);

                                                  foreach ($keys as $key => $value) {


                                                  $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]);

                                                  if($ErgTest == true)
                                                    {
                                                      $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start
                                                                                                      
                                                     }

                                                   $Start++;
                                                    //var_dump($ErgTest);
                                                    # code...
                                                  }
                                                  return $merkeStart;

}

function splitteEinenTeilInEineListe(Array $ListeGes,Array $zuSplittendeTeil)
{

                                    for($p = 0; $p<count($zuSplittendeTeil); $p++)
                                    {
                                      $liste[] = $ListeGes[$zuSplittendeTeil[$p]];
                                    }

                                    return $liste;

}
function findeDiePositionInDerListe(Array $ListeGes, String $gesucht)
{
$keyList = Array();
                                                    foreach ($ListeGes as $k => $value) 
                                                    {
                                                     
                                                     $key_Position_idArtikel_Verkaufspos = array_search($gesucht,  $ListeGes[$k]);
                                                     //echo 's';
                                                     //echo $k;

                                                     if(!empty($key_Position_idArtikel_Verkaufspos))
                                                     {
                                                      $keyList[] = $k;
                                                     }
                                                    }

                                                    return $keyList;
}                                                    

function array_Key_count2($gemerkteArtikeldP,String $Schluessel , String $Schluessel1)
{


                                                  $merkeStart = Array();

                                                  $Start = 0;

                                                  $keys = array_keys($gemerkteArtikeldP);

                                                  

                                                  foreach ($keys as $key => $value) {

                                                
                                                  $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]);
                                                 
                                                  $ErgTest2 =   array_key_exists($Schluessel1, $gemerkteArtikeldP[$key]);

                                                  if($ErgTest != null && $ErgTest2 != null )
                                                    {
                                                      $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start                                                                                                      
                                                    }

                                                  else
                                                     {
                                                        set_error_handler(function() { /* ignore errors */ });
                                                        dns_get_record();

                                                      $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]['0']);
                                                      $ErgTest2 =   array_key_exists($Schluessel1, $gemerkteArtikeldP[$key]['0']);

                                                         if($ErgTest == true ||  $ErgTest2 ==true )
                                                          {
                                                            $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start                                                                                                            
                                                          }
                                                      }
                                                          restore_error_handler();

                                                   $Start++;
                                                    //var_dump($ErgTest);
                                                    # code...
                                                  }
                                                  return $merkeStart;
                                
                    }




}
?>