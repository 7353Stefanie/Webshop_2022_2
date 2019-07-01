<?php

 session_start();

 $date = getdate();

  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
  var_dump($Zeit . "Zeit");

 // echo $_SESSION['Buch'];
 

if(isset($_POST))
{

	  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

          if ($mysqli->connect_error)
             {
                echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
             } 

          else {  
      
          			if($_POST['Kategorie'] == 'Buecher')
          			{	
          				$Artikel = SelectArtikel($mysqli);

                  var_dump('session buch vorhanden');

          				if($Artikel['0']['Kategorien'] == $_POST['Kategorie'] && $Artikel['0']['Bezeichnung'] == $_POST['Titel']) // sind die Einträge gleich
          				{
                     var_dump('kategorie und Bezeichnung gleich');

                    if(isset($_POST['Titelbild'])) // ist ein Titelbild gesetzt?
                    { 
                                  var_dump('Titelbild gesetzt');
                                                         

                      						if($Artikel['0']['Artikelbild'] != $_POST['Titelbild']) // ist das Titelbild nicht das gleiche 
                      						{
                                     var_dump('Titelbild neu');

                      						

                                   neuenArtikelAnlegen($mysqli,$Zeit, $_POST['Titelbild']) ; // idBild am ende
                                     $Artikel = SelectArtikel2($mysqli,$Zeit) ;  

            	          						neuesBuchAnlegen($mysqli, $Artikel['0']['idArtikel']); 
                                    VerkaeuferpositionNeuesBild($mysqli, $Artikel['0']['idArtikel'], $Zeit);
                                    
                  						    } 
                                  else
                                  {
                                    var_dump('Titelbild gleich');
                                    // alle werte sind gleich somit wird kein neuer Artikel angelegt
                                    Verkaeuferposition($mysqli, $Zeit,$_SESSION['Buch']);          					
                                  }   
                     } 
                     else
                     {
                      // es ist kein Titelbild gesetzt somit wird der Bisherige Artikel verwendet mit bisherigem Bild
                      var_dump('ohne Titelbild ');
                      Verkaeuferposition($mysqli, $Zeit,$_SESSION['Buch']);
                     }                         					
          				}
          	  else{
                  //   Verkaeuferbild($mysqli, $_POST['Titelbild'],'1', '0');
                     //echo $id;
                     neuenArtikelAnlegen($mysqli,$Zeit,$_POST['Titelbild']) ; //es sind neue Artikelwerte vorhanden somit wird ein neuere Artikel erstellt
          						 $Artikel = SelectArtikel2($mysqli,$Zeit);   

                       var_dump($Artikel); echo 'Artikel';

                       neuesBuchAnlegen($mysqli, $Artikel['0']['idArtikel']); 
                       VerkaeuferpositionNeuesBild($mysqli, $Artikel['0']['idArtikel'], $Zeit);
                       
          					}
          			}
          	else{	//es wurde keine Artikelid gefunden somit wird ein neuer Artikel angelegt
          					 
                   //  Verkaeuferbild($mysqli, $_POST['Titelbild'],'1','0');

                     neuenArtikelAnlegen($mysqli,$Zeit, $_POST['Titelbild']) ;
                     $Artikel = SelectArtikel2($mysqli,$Zeit);  

                    if($_POST['Kategorie'] == 'Buecher')
                    {  neuesBuchAnlegen($mysqli, $Artikel['0']['idArtikel']);}

                    if($_POST['Kategorie'] == 'Kleidung')
                    {  neueKleidungAnlegen($mysqli, $Artikel['0']['idArtikel']);}

                   VerkaeuferpositionNeuesBild($mysqli, $Artikel['0']['idArtikel'], $Zeit);
                   
          			}  

              
                $AnweisungVerkaeuferposition =   selectVerkaeuferposition($mysqli,$Zeit);
                var_dump($AnweisungVerkaeuferposition );
           
              
               $laenge= count($AnweisungVerkaeuferposition) -1;

               

                if(isset($_POST['BilderGes']) )
               {   
                 var_dump('Bilder');

                $laengeBilder=count($_POST['BilderGes']); 
                $i = 0;

                 while( $i < $laengeBilder)
                 {                            
                    if(strlen($_POST['BilderGes'][$i]) >30)
                    {
                      var_dump($_POST['BilderGes'][$i]);

                     Verkaeuferbild($mysqli,$_POST['BilderGes'][$i], $AnweisungVerkaeuferposition['0']['idVerkaeuferposition'] ); # befüllt Verkaeuferbild
                     $AusgabeVerkaeuferbild = selectVerkaeuferbild($mysqli, $AnweisungVerkaeuferposition['0']['idVerkaeuferposition']); # Ausgabe Verkaeuferbild
                                           
                     }   
                     $i++;         
                  }
                }
              

              Kaufarten($mysqli, $AnweisungVerkaeuferposition['0']['idVerkaeuferposition']);
              $AusgabeKaufarten = selectKaufarten($mysqli,$AnweisungVerkaeuferposition['0']['idVerkaeuferposition']);       	 
              var_dump("Erfolgreich angelegt");


  			} // ende else
                          
        $mysqli->close();

         $_Session['Buch'] = "0";
         $_Session['Bilder'] = "0";
                 


        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/Hilfsdokumente/VerkaufsartikelKommunikation.php');

               
     } // ende if
     else
    {
    	echo "Es sind keine Daten angekommen";
    }


function switchit($Kategorie)
{
  switch ($Kategorie) {
    case 'Buecher':
      # code...
      break;

    case 'Buecher':
      # code...
      break;
    
    default:
      # code...
      break;
  }
}



function neuesBuchAnlegen($mysqli, $idArtikel)
{
 
	         $query = sprintf("INSERT INTO Buecher(ISBN, Autor, Erscheinungsjahr, Auflage,  Kurzbeschreibung, idArtikel, Genre, Seitenanzahl, Mediumart)
                            VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')" ,

                    $mysqli->real_escape_string($_POST['ISBN']),      				   
      				   	  $mysqli->real_escape_string($_POST['Autor']),
	                	$mysqli->real_escape_string($_POST['Erscheinungsjahr']),
	                	$mysqli->real_escape_string($_POST['Auflage']),
	                	 $mysqli->real_escape_string($_POST['Kurzbeschreibung']),
      				   	  $mysqli->real_escape_string($idArtikel),
      				   	  $mysqli->real_escape_string($_POST['Genre']),
	                	$mysqli->real_escape_string($_POST['Seitenanzahl']),
	                	$mysqli->real_escape_string($_POST['Mediumart']) );
       		

            $result = $mysqli->query($query);

                         if ( !  $result )
                    {
                       die('Ungültige Abfrage: Buch anlegen' . mysqli_error());
                    }
}

function neueKleidungAnlegen($mysqli, $idArtikel)
{
 
           $query = sprintf("INSERT INTO Kleidung(Marke, Groesse, idArtikel, Geschlecht, Farbe)
                            VALUES ('%s','%s','%s','%s','%s')" ,

                    $mysqli->real_escape_string($_POST['Marke']),                
                    $mysqli->real_escape_string($_POST['Groesse']),
                    $mysqli->real_escape_string($idArtikel),
                    $mysqli->real_escape_string($_POST['Geschlecht']),
                    $mysqli->real_escape_string($_POST['Farbe']) );
          

            $result = $mysqli->query($query);

                         if ( !  $result )
                    {
                       die('Ungültige Abfrage: Kleidung anlegen' . mysqli_error());
                    }
}


// für alle Artikel gültig -->



function SelectArtikel($mysqli)
{
  $query = sprintf("Select * from Artikel where idArtikel = '%s'   ", 
    $mysqli->real_escape_string($_SESSION['Buch'])
    
     ); 

   $Rows = Array(); 

      $result = $mysqli->query($query);
               
                  if ( !  $result)
                    {
                       die('Ungültige Abfrage: selectArtikel' . mysqli_error());
                    }


       while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten                         
                     }

        mysqli_free_result( $result );
         return $Rows;
}

function SelectArtikel2($mysqli,$Zeit)
{
  $query = sprintf("Select * from Artikel where Zeitstempel = '%s' ", 
   
    $mysqli->real_escape_string($Zeit) ); 

   $Rows = Array(); 

      $result = $mysqli->query($query);
               
                  if ( !  $result)
                    {
                       die('Ungültige Abfrage: selectArtikel' . mysqli_error());
                    }

       while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten                         
                     }

        mysqli_free_result( $result );
         return $Rows;
}


function neuenArtikelAnlegen($mysqli,$Zeit, $Bild)
{ 

         $query = sprintf("INSERT INTO Artikel(Kategorien, Bezeichnung,  Zeitstempel, Titelbild)
                            VALUES ('%s','%s','%s','%s')" ,

                         $mysqli->real_escape_string($_POST['Kategorie']),
                         $mysqli->real_escape_string($_POST['Titel']),
                          $mysqli->real_escape_string($Zeit),
                          $mysqli->real_escape_string( $Bild) ); 

        $result = $mysqli->query($query); 

          if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }  
}



function Verkaeuferposition($mysqli,$Zeit,$idArtikel)
{
  if(isset($_POST['Kaufen']))
    {$kauf = '1';}
  else{$kauf = '0';}

  if(isset($_POST['Tauschen']))
    {$tausch = '1';}
  else{$tausch = '0';}


  var_dump($_SESSION['idBenutzer'], $_SESSION['Buch'],$_POST['Zustand'],$_POST['Beschreibung'],$kauf,$tausch );


              $query2 = sprintf("INSERT INTO Verkaeuferposition (idBenutzer, Verkaufsmenge, idArtikel, Zustand, Artikelbeschreibung, Verfuegbarkeitsstatus, Kauf, Tausch, Verkaufspositionsdatum, Aenderungsdatum)
                                 VALUES ('%s', '','%s', '%s','%s','1','%s','%s','%s','0')" ,   


                  $mysqli->real_escape_string($_SESSION['idBenutzer']),
                  
                  
                  $mysqli->real_escape_string($idArtikel), // idARtikel
                  $mysqli->real_escape_string($_POST['Zustand']),
                  $mysqli->real_escape_string($_POST['Beschreibung']),                   
                   $mysqli->real_escape_string($kauf),
                  $mysqli->real_escape_string($tausch),
                   $mysqli->real_escape_string($Zeit)                  
               
                ); 

         $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Verkaeuferposition ' . mysqli_error());
                    }
}


function VerkaeuferpositionNeuesBild($mysqli, $idArtikel,$Zeit)
{
  if(isset($_POST['Kaufen']))
    {$kauf = '1';}
  else{$kauf = '0';}

  if(isset($_POST['Tauschen']))
    {$tausch = '1';}
  else{$tausch = '0';}

   var_dump($_SESSION['idBenutzer']. 'Benutzer'.  $_SESSION['Buch'] . $_POST['Zustand'] . 'Zustand'. $_POST['Beschreibung'],$kauf,$tausch );

              $query2 = sprintf("INSERT INTO Verkaeuferposition (idBenutzer, Verkaufsmenge, idArtikel, Zustand, Artikelbeschreibung, Verfuegbarkeitsstatus, Kauf, Tausch, Verkaufspositionsdatum, Aenderungsdatum)
                                 VALUES ('%s', '','%s', '%s','%s','1','%s','%s','%s', '0')" ,   

                  $mysqli->real_escape_string($_SESSION['idBenutzer']),
                     
                 
                  $mysqli->real_escape_string($idArtikel),
                  $mysqli->real_escape_string($_POST['Zustand']),
                  $mysqli->real_escape_string($_POST['Beschreibung']),                   
                   $mysqli->real_escape_string($kauf),
                  $mysqli->real_escape_string($tausch),
                   $mysqli->real_escape_string($Zeit)                 
               
                ); 

         $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Verkaeuferposition ' . mysqli_error());
                    }
}

function selectVerkaeuferposition($mysqli,$Zeit)
{
  $query3 = sprintf("Select * from Verkaeuferposition where Verkaufspositionsdatum = '%s' ", 

   $mysqli->real_escape_string($Zeit)  ); 

 //echo' query3 = sprintf("Select * from Verkaeuferposition where Verkaufspositionsdatum = '.$Zeit.' ", ';

   $Rows = Array(); 
      $result3 = $mysqli->query($query3);
                
                  if ( !  $result3)
                    {
                       die('Ungültige Abfrage: selectVerkaeuferposition' . mysqli_error());
                    }


       while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten                         
                     }

                      mysqli_free_result( $result3 );
                      return $Rows;
}

function Verkaeuferbild($mysqli,  $Titelbild, $idVerkaeuferposition )
{
 

         $query2 = sprintf("INSERT INTO Verkaeuferbild( Verkaeuferbild, idVerkaeuferposition)
                            VALUES ('%s', '%s' )" ,
                        
                          $mysqli->real_escape_string($Titelbild),
                          $mysqli->real_escape_string($idVerkaeuferposition)

                          );
        

        $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Verkaeuferbild' . mysqli_error());
                    } 

    
}

function selectVerkaeuferbild($mysqli,$idVerkaeuferposition)
{
    

    $query4 = sprintf("Select * from Verkaeuferbild where 'idVerkaeuferposition' = '%s' ", 
    $mysqli->real_escape_string($idVerkaeuferposition) ); 

      $result4 = $mysqli->query($query4);
      $Rows = Array(); 

                
                  if ( !  $result4)
                    { die('Ungültige Abfrage:  selectVerkaeuferbild' . mysqli_error());
                    }


       while ($row = $result4->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten
                     }

                      mysqli_free_result( $result4 );
                      return $Rows;
  
}

function Kaufarten($mysqli, $idVerkaeuferposition)
{
  var_dump('kaufart angelegt');

				 $query = sprintf("INSERT INTO Kaufarten(Preis, Kaufarten, idVerkaeuferposition)
				                    VALUES ('%s','Tauschwert','%s')" ,

                $mysqli->real_escape_string($_POST['Tauschwert']*100) ,
                $mysqli->real_escape_string($idVerkaeuferposition) );

 				$result = $mysqli->query($query);

                         if ( !  $result)
                    {
                       die('Ungültige Abfrage: Kaufarten ' . mysqli_error());
                    }

				$query2 = sprintf("INSERT INTO Kaufarten(Preis, Kaufarten, idVerkaeuferposition)
				                    VALUES ('%s','Restwert','%s')" ,

                $mysqli->real_escape_string($_POST['Restwert']*100),
                $mysqli->real_escape_string($idVerkaeuferposition) );

 				$result2 = $mysqli->query($query2);

                 if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Kaufarten' . mysqli_error());
                    }
}

function selectKaufarten($mysqli,$idVerkaeuferposition)
{
		  $query4 = sprintf("Select * from Kaufarten where 'idVerkaeuferposition' = '%s' ", 
		  $mysqli->real_escape_string($idVerkaeuferposition) ); 

     	  $result4 = $mysqli->query($query4);

   		  $Rows = Array();                 
                  if ( !  $result4)
                    { die('Ungültige Abfrage: selectKaufarten' . mysqli_error());
                    }


       		while ($row = $result4->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten
                     }

                      mysqli_free_result( $result4 );
                      return $Rows;
}


