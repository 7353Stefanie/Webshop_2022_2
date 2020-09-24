<?php

 session_start();

 // define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/');
 

require_once(__ROOT__.'/Hilfsdokumente/Abfragen/Abfragen_Sammlung.php'); 

 $date = getdate();

 $_SESSION['gemerkteArtikel'] = "";
 $_SESSION['gemerkteArtikelInfos'] = "";

	  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
	 // var_dump($Zeit . "Zeit");



 $Sammlung = Array();


// gemerkte Artikel 
// ausgabe aller gemerkten Artikel von Benutzer mit der ID XX

 class gemerkteArtikel

{

  

  function AusgabeAllergemerktenArtikelDerPerson()
  {

      $Abfragen = new Abfragen();


	  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
					
                   }
                    else 
                   { 

                    $gemerkteArtikel = $Abfragen->selectMerken($mysqli,$_SESSION['idBenutzer']);

                    // 1. finde alle Artikel des Benutzers die er sich gemerkt hat
                    //2. gebe den Namen des Artikels  --> Bezeichnung, Kategorie , Bild == Tabelle Artikel 

                           /* case 'Buecher':

                            echo  $Artikel['Autor'] . ", <br>";
                            echo  $Artikel['Erscheinungsjahr'] . ", ";
                            echo  'Auflage: '.$Artikel['Auflage']; 

                              case 'Kleidung':

                            echo  $Artikel['Marke'] . ", <br>";
                            echo  $Artikel['Groesse'] . ", ";
                            echo  $Artikel['Farbe'];
                          
                          Zustand,Kauf ,Tausch, Verfuegbarkeitstatus und Artikelbeschreibung von Tabelle verkaeuferposition

                          , Kauf, Tausch, Preis von Tabelle Kaufarten
                           */ 

                    // 3. finde herraus ob dieser Artikel noch verfügbar ist oder schon verkauft ist oder sich im Warenkorb eines anderen Benutzers befindet

                   		$gemerkteArtikel = $Abfragen->selectMerken($mysqli,$_SESSION['idBenutzer']); //alle gemerkten Artikel der Person

                    // id Verkaeuferposition in einer Liste
                      
                      $ArtikelElemString =   $this->idListe($gemerkteArtikel, 'idVerkaeuferposition');
                      // Verkäuferpsoition
                       // var_dump($ArtikelElemString);


                        $Status = $Abfragen->VerkaufspositionsInfos($mysqli,$ArtikelElemString);

                       $ListeIDArtikel =  $this->idListe($Status, 'idArtikel');
                       $ListeIDBenutzer =  $this->idListe($Status, 'idBenutzer');


                       $ArtikelListe = $Abfragen->selectArtikel_by_ArtikelId_Array($mysqli,$ListeIDArtikel);

                      // var_dump($ArtikelListe);

                       $Benutzername =  $Abfragen->selectBenutzername($mysqli,$ListeIDBenutzer);

                        $ArrayBenuzter = Array(); // notwendig durch fehler bei Ausgabe

                        $ArrayBenuzter['0'] = $Benutzername; //// notwendig durch fehler bei Ausgabe


                       //var_dump($ArtikelListe);

                        $KategorieDetails = Array();
                      

                         for($y= 0; $y < count($ArtikelListe); $y++)
                         {

                            $KategorieDetails[] = $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli,$ArtikelListe[$y]['Kategorien'],$ArtikelListe[$y]['idArtikel'] );

                         }

                   

                             // var_dump($KategorieDetails);

                            $Kaufarten=  $Abfragen->selectKaufarten_by_idVerkaeuferposition_Array($mysqli,$ArtikelElemString  );
                      

                      //var_dump($Kaufarten);
                     


                          if(isset($Status,$ArtikelListe,$ArrayBenuzter, $Kaufarten, $KategorieDetails, $gemerkteArtikel))
                          {

                          


                           $ArrayListe = array_merge($Status,$ArtikelListe,$ArrayBenuzter, $Kaufarten, $KategorieDetails, $gemerkteArtikel);
                         }
                         else
                          {$ArrayListe = null;}

                        $mysqli->close();  

                    //var_dump($ArrayListe);

                    return $ArrayListe;

                       
                  

                      } // ende else
        } // ende MEthode

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

                    



  function idListe($gemerkteArtikel, $Inhalt) // schreibt alle ids in eine Liste
  {

    if(isset($gemerkteArtikel) && isset($Inhalt))
    {#
       $ArraygemerkterArtikel = Array();
      
    $i = 0;

                        foreach ($gemerkteArtikel as $key => $value) {

                        

                      $ArraygemerkterArtikel[$i]  = $value[$Inhalt];
                      $i++;
                      }
                     

                        $ArtikelElemString = implode("','", $ArraygemerkterArtikel);

                        return $ArtikelElemString;
     }
     else
     {return null;}                   
  }


function DerRest()
{


                   		$AnzahlGemerkteartikel =  count($gemerkteArtikel);   // anzahl

                      $imWarenkorb = $Abfragen->liegtImWarenkorb($mysqli) ; // ausgabe idVerkäuferposition und idBenutzer

                      var_dump($gemerkteArtikel);

                      $i = 0;

                      foreach ($gemerkteArtikel as $key => $value) {

                        var_dump($value);

                      $ArraygemerktArtikel[$i]  = $value['idVerkaeuferposition'];
                      $i++;
                      }

                      var_dump($ArraygemerktArtikel);  // enthält die Verkäuferposition

                      $ArtikelElemString = implode("','", $ArraygemerktArtikel);

                      var_dump($ArtikelElemString);

                      $Status = $Abfragen->Verkaufspositionsstatus($mysqli,$ArtikelElemString);

                      echo 'status';
                      var_dump($Status);
   } // ende func

                }//ende class
                      
             




                      //     $Warenkorbinformation = array_search( $gemerkteArtikel[$i]['idVerkaeuferposition'], array_column($imWarenkorb, 'idVerkaeuferposition')); //gleiche die Artikel im Warenkorb mit denen die gemerkt wurden ab
                      
                      /*
                       for($i = 0; $i< $AnzahlGemerkteartikel; $i++)
                         {  

                           var_dump($Warenkorbinformation);

                           $Warenkorbinformation =   $imWarenkorb[$Warenkorbinformation] ;                        

                            $Kaufinfos = Kaufinfos($mysqli, $gemerkteArtikel[$i]['idVerkaeuferposition']);
                            //var_dump($Kaufinfos);               

                            $Artikelinfos = Artikel($mysqli, $Kaufinfos['0']['idArtikel']);
                            //var_dump($Artikelinfos);

                            $KategorieInfos = Kategorie($mysqli,  $Artikelinfos['0']['Kategorien'], $Artikelinfos['0']['idArtikel']) ;   
                            //var_dump($KategorieInfos);  

                            $Sammlung[$i] = array_merge( $Kaufinfos ,$Artikelinfos ,$KategorieInfos, $Warenkorbinformation);             

                         }// ende for
                         //var_dump( $Warenkorbinformation);
                         */
                       


                        // $_SESSION['gemerkteArtikel'] = $gemerkteArtikel;
                        // $_SESSION['gemerkteArtikelInfos'] = $Sammlung;    
                         //var_dump($Sammlung);               
                
  ?>   