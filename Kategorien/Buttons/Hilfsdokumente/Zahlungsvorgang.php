<?php

//1. Zahlungsvorgang
/*1.1 update Table Adresse und Kaufarten check
  1.1.1 Übertragung der Radiobuttonwerte über die Forms --> check
  1.1.2 neue Zeile in DB einrichten (boolean) 0 = nicht angeklickt,  1 = angeklickt  
  1.1 Tests durchgeführt Adresse übertragung



wenn $_POST daten angekommen sind dann 

Annahme : Zahlungs ist erfolgreich abgeschlossen worden.
			Tausch Guthaben muss evtl. angepasst werden.!!!
*/
 session_start();

  $date = getdate();

  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
  var_dump($Zeit . "Zeit");



		if (isset($_SESSION['AdressePar']) && isset($_SESSION['Zahlungsart'] ))
			{
				 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

	           if ($mysqli->connect_error)
	              {
	                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
	              } 

	          else { 	

              try{

    						$Adresse   =  Array();
    						$Adresse  = $_SESSION['AdressePar'] ;

    						var_dump($Adresse);
    					
    						$numbers = preg_replace('/[^0-9]/', '', $Adresse);
    						$letters = preg_replace('/[^a-zA-Z]/', '', $Adresse);

    						var_dump($numbers);
    						var_dump($letters);

    						$Rueckgabe = selectAdresse($mysqli);			 // alle Werte in denen ein R , V oder RV vorkommt 	
    						$id = array_search($Rueckgabe[0]['idAdresse'],$numbers);

    						var_dump($Rueckgabe);
    						#
    				if($numbers[0] == $numbers[1]) 
    						{								
							// überprüfe ob die Einstellung gleichgeblieben ist // Annahme es können maximal 2 werte in Numbers vorhanden sein
							 

							 if($Rueckgabe[0]['ausgewaehlt'] != 'VR' || $Rueckgabe[0]['idAdresse'] != $numbers[0] )
							 {
								//löschen bzw. update der bisherigen werte
							 	
							 		upadteAdresse($mysqli,$Rueckgabe[1]['idAdresse'], '0');
							 		upadteAdresse($mysqli,$Rueckgabe[0]['idAdresse'], '0');

							 		upadteAdresse($mysqli,$numbers[0], 'VR');
							 }							
						}
						else{ // es gibt 2 ids 							

								$id = array_search($Rueckgabe[0]['idAdresse'],$numbers);//  $id// weichen die vorhandenen Daten aus der Datenbank mit den neuen ab ? 
								 
								if(($Rueckgabe[0]['idAdresse'] != $letters[$id]) || ($Rueckgabe[1]['idAdresse'] == $letters[$id]))
								{
									upadteAdresse($mysqli,$Rueckgabe[1]['idAdresse'], '0');
							 		upadteAdresse($mysqli,$Rueckgabe[0]['idAdresse'], '0');

									upadteAdresse($mysqli, $numbers[0], $letters[0]);
									upadteAdresse($mysqli, $numbers[1], $letters[1]);
								}	

							} // ende else

							// Ende update Adresse//Start update Zahlungsart in Tabelle Guthaben

							// select Guthaben  und updateGuthaben falls sich etwas geändert hat

							$bisherigeZahlungsart = selectZahlungsart($mysqli);  // Zahlungsart K, P, S


							//var_dump($bisherigeZahlungsart);

							if($bisherigeZahlungsart['Zahlungsart'] != $_SESSION['Zahlungsart'] )
							{								
								updateZahlungsart($mysqli);
							}

            } // ende try
            catch(Exception $err)
            {
                $err =' Update Fehler Adresse, Zahlungsart';
            }

							// soll nur gemacht werden, wenn die Zahlung erfolgreich war

						// 1.	Bestellposition befüllen ( insert into), check
						
						// 2.   Verfügabarkeitsstatus in Verkäuferposition ändern auf 2. // bedeutet nicht mehr verfügbar
						// 3.	Artikel aus dem Warenkob löschen, check
						
						// 4.   automatisch generierte Bestellbestätigung per Mail verschicken (Käufer) check (muss nochmal getestet werden wenn es auf dem Server vorhanden ist)
						// 5.   automatisch generierte Verkaufsinformation an den Verkäufer per Mail verschicken


						try{
									$Warenkorbartikel =	selectWarenkorbartikel($mysqli);	

									for($i = 0; $i  < count($Warenkorbartikel); $i++)
									{
										

										insertBestellposition($mysqli,  $Zeit , $Warenkorbartikel[$i]['idVerkaeuferposition']); // Befüllung Bestellposition
										upadteVerkaeuferposition($mysqli, $Warenkorbartikel[$i]['idVerkaeuferposition']);


										$idVerkaeuferposition = selectVerkaeuferposition($mysqli, $Warenkorbartikel[$i]['idVerkaeuferposition']);

                    // Annahme das Array $idVerkäuferposition und $Artikel sind gleich lang

										$Artikel =    selectArtikel($mysqli,$idVerkaeuferposition['idArtikel']);

                    
										$Kategorien =  selectKategorie($mysqli, $Artikel['Kategorien'], $Artikel['idArtikel']);

                    $Kaufarten =   selectKaufarten($mysqli,$Warenkorbartikel[$i]['idVerkaeuferposition']);

                    $Benutzer =    selectBenutzer($mysqli,$idVerkaeuferposition['idBenutzer']); // Benutzer ist der Verkäufer


										$ArtikelKategorie[$i] = array_merge($Benutzer,$idVerkaeuferposition, $Artikel, $Kategorien, $Kaufarten);
									}

                  $Kaeufername = selectBenutzer($mysqli,$_SESSION['idBenutzer']);
									//deleteWarenkorbartikel($mysqli); // lösche Warenkorbartikel

									//var_dump($ArtikelKategorie);
                  var_dump($_SESSION['Radiobutton']);
                  

									EMail($mysqli, $ArtikelKategorie, $Zeit, $Kaeufername);

                  $_SESSION['Zahlungsart'] = "";
                  $_SESSION['Adresse'] = "";




                            // im Original nehme den Array Benutzer und sortiere diesen nach  der Bentuzer id. Zähle danach die Artikel die zu einem Benutzer gehören und schreibe die ID der Benutzer sowie die Anzahl der Artikel in ein Array
            // wenn die id gleichbleibt dann t+1

            /*ein Käufer kauft Artikel und bekommt nach dem Kauf eine Bestätigungsmail seiner Einkäufe.

              die Verkäufer bekommen daraufhin eine Benachrichtigung das Sie Ihre Artikel versenden sollen.

              --> Schleife mit dem Versenden einer E-Mail für die Verkäufer
              --> wenn es mehrere Artikel sind variation zu mehr Artikeln ansonsten nur ein Artikel

              Wenn mehr als 1 Artikel vom gleichen Käufer gekauft werden, werden mehrere Artikel in einer Email angezeigt.*/

              $zaehler = 0;
              $t = 0;
               $ArtikelAnzahl = Array();

            echo 'AnzahlArtikel';
            echo count($Warenkorbartikel);


            for($x = 0; $x < count($Warenkorbartikel); $x++) //count($Warenkorbartikel)-1 normal anstatt 2 count(Array)
            {
              
              if($t == 1 || $t == 2 ) // falsch 
                {
                  //$zaehler gibt die letzte Position des Artikels eines Verkäufers an

                   $zaehler++;
                  $ArtikelAnzahl['0']['Position'] = $x ; // gibt die letzte position an
                  $ArtikelAnzahl['1']['ArtikelAnzahl'] = $zaehler; // gibt die Anzahl der Artikel aus

                  EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $ArtikelKategorie);


                  
                  $zaehler = 0;
                  echo $x;

                  echo ' Position ist '.$x.'</br>';

                  echo ' Anzahl der Artikel ' .$zaehler.'</br>';

                  echo' position 1 E-mail wurde ausgelöst';
                  
                  $t = 0;
                  $ArtikelAnzahl = Array(); 

                }




              if($x+1 < count($Warenkorbartikel) ) //count($Warenkorbartikel)-1 normal anstatt 2 count(Array)
              {
                if($Warenkorbartikel[$x]['idBenutzer'] != $Warenkorbartikel[$x+1]['idBenutzer'])
                {
                  $t = 2;
                  $ArtikelAnzahl = Array(); 

                  echo 'Benutzerid 1 ist ' . $Warenkorbartikel[$x]['idBenutzer'];
                  echo 'Benutzerid 2 ist ' . $Warenkorbartikel[$x+1]['idBenutzer'];
                  echo'Benutzer sind nicht gleich </br>';

                }
                else
                {
                  $t = 0;
                                  
                  
                  $zaehler++;
                  echo 'Benutzerid 1 ist ' . $Warenkorbartikel[$x]['idBenutzer'];
                  echo 'Benutzerid 2 ist ' . $Warenkorbartikel[$x+1]['idBenutzer'];
                  echo'Benutzer sind gleich </br>';
                }
              }
              else{ // wird ausgeführt wenn nur ein Artikel gekauft wurde
                  //$zaehleArtikel++;

                  // Anzahl der Artikel
                  // Position
                   
                   $zaehler++;
                  
                  $ArtikelAnzahl['0']['Position'] = $x+1 ; // gibt die letzte position an
                  $ArtikelAnzahl['1']['ArtikelAnzahl'] = $zaehler;


                  EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $ArtikelKategorie, $_SESSION['Radiobutton']);
                  
                  $zaehler = 0;

                  echo ' Position ist '.$x.'</br>';

                  echo ' Anzahl der Artikel ' .$zaehler.'</br>';

                  echo' position 2 E-mail wurde ausgelöst </br>';
              }
            } //ende for

							   } // ende try
						catch(Exception $err)
							{
								echo($err+'Fehler');
							}
							
							//var_dump($ArtikelKategorie);

					}// ende else
					 mysqli_close($mysqli);
				//wenn die Adresse gleich bleibt kei nupdate durchführen
			}


/*
function  upadteAdresse($mysqli, $numbers, $letters)
{

		        $query = sprintf("UPDATE Adresse SET  ausgewaehlt= '%s'  where idAdresse = '%s' " , 
		          
		          $mysqli->real_escape_string($letters),
		          $mysqli->real_escape_string($numbers)  
		                  
		       ); 

          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function selectAdresse($mysqli)
{

      $query = sprintf("select idAdresse, ausgewaehlt from Adresse where ausgewaehlt NOT LIKE 0 "       					
      					
      				);

       $result = $mysqli->query($query);

                  if ( ! $result )
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
}

function selectZahlungsart($mysqli)
{

      $query = sprintf("select * from Zahlungsart where idBenutzer = '%s' ",
     					 $mysqli->real_escape_string($_SESSION['idBenutzer']) 
      				);


       			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }


                $row = $result->fetch_array(MYSQLI_ASSOC);                                                                

                mysqli_free_result( $result );               

                return $row;                     
}

function  updateZahlungsart($mysqli)
{

		        $query = sprintf("UPDATE Zahlungsart SET Zahlungsart = '%s'  where idBenutzer = '%s' " , 
		          
		          $mysqli->real_escape_string($_POST['Zahlungsart']),  
		          $mysqli->real_escape_string($_SESSION['idBenutzer'])
		                  
		       ); 

          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}


function selectWarenkorbartikel($mysqli)
{

      $query = sprintf("select * from Warenkorb where idBenutzer = '%s' ",
     					 $mysqli->real_escape_string($_SESSION['idBenutzer']) 
      				);

       			$result = $mysqli->query($query);

                  if ( ! $result )
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
}

function  insertBestellposition($mysqli,$Zeit, $idVerkaeuferposition)
{

		        $query = sprintf("INSERT INTO Bestellposition ( Bestelldatum, Bestellstatus, idBenutzer, idVerkaeuferposition ) 
		        					VALUES ('%s', 0, '%s', '%s') " , 		          
		        
		        $mysqli->real_escape_string($Zeit),    
		        $mysqli->real_escape_string($_SESSION['idBenutzer']),
		        $mysqli->real_escape_string($idVerkaeuferposition)   
		              
		       ); 
          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  deleteWarenkorbartikel($mysqli)
{

		        $query = sprintf("DELETE FROM Warenkorb where idBenutzer = '%s'  " ,          
		        
		          
		        $mysqli->real_escape_string($_SESSION['idBenutzer'])
		                 
		       ); 
          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  upadteVerkaeuferposition($mysqli, $idVerkaeuferposition)
{

		        $query = sprintf("UPDATE Verkaeuferposition SET  Verfuegbarkeitsstatus= '2'  where idVerkaeuferposition = '%s' " , 
		          
		          $mysqli->real_escape_string($idVerkaeuferposition)
		                  
		       ); 

          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function selectArtikel($mysqli, $idArtikel )
{

      $query = sprintf("select * from artikel where idArtikel = '%s' ",
     					 $mysqli->real_escape_string($idArtikel) 
      				);

       			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
            	$row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}

function selectKategorie($mysqli, $Kategorie, $idArtikel)
{

      $query = sprintf("select * from %s where idArtikel = '%s' ",

     					 $mysqli->real_escape_string($Kategorie),
     					 $mysqli->real_escape_string($idArtikel) 
      				);

       			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }
      
            	$row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}



function selectBenutzer($mysqli,$idBenutzer)
{

      $query = sprintf("select  idBenutzer, Benutzername, Vorname, EMail from Benutzer where idBenutzer = '%s' ",
     					 $mysqli->real_escape_string($idBenutzer) 
      				);

       			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
            	$row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}


function selectVerkaeuferposition($mysqli,$idVerkaeuferposition )
{

  $query = sprintf("select idArtikel, idBenutzer, Zustand, Artikelbeschreibung from Verkaeuferposition where idVerkaeuferposition = '%s' ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row; 

}

function selectKaufarten($mysqli,$idVerkaeuferposition )
{

      $query = sprintf("select * from Kaufarten where idVerkaeuferposition = '%s' ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
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

function switchKategorieVerkaeufer($Artikel, $text)
{ 


  switch ($Artikel['Kategorien'])
  {
    case 'Buecher':

    $text .=  $Artikel['Autor']  . ", ".  $Artikel['Mediumart'] ; 
      # code...
      break;

    case 'Kleidung':

    $text .=   $Artikel['Marke'] . ", ".  $Artikel['Groesse'] . ", ".  $Artikel['Farbe'];
      # code...
      break;
    
    default:
      # code...
      break;
    }  
}

function switchKategorie($Artikel, $text)

{
  switch ($Artikel['Kategorien'])
  {


    case 'Buecher':

      $text .=  $Artikel['Autor'] . ", ". $Artikel['Erscheinungsjahr'] . ", ".$Artikel['Auflage']." , " .$Artikel['Mediumart']; 
      # code...
      break;

    case 'Kleidung':

      $text .=  $Artikel['Marke'] . ", ".  $Artikel['Groesse'] . ", ".  $Artikel['Farbe'];
      # code...
      break;
    
    default:
      # code...
      break;
    }
  

}

function EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $Warenkorbartikel)
{
    $Anz = count($ArtikelAnzahl);  // Anzahl der Artikel mit den gleichen Anbieter
    //echo $Anz;
     $Position = 0;

    //var_dump($ArtikelAnzahl);

  $empf = "stefanie.burkhardt22@t-online.de";//$benutzer['EMail'];
  $betreff = "Artikelverkauf";
  $from = "From: TuK.de <stefanie.burkhardt22@t-online.de>\n";
  $from .= "Reply-To: stefanie.burkhardt22@t-online.de\n";
  $from .= "Content-Type: text/html\n";
  $text = "

  <div style='max-hight:30px; max-width:60px; background-color:yellow; '>LOGO</div>
    <div style='margin-bottom:30px; border-top-style:solid; border-bottom-style:solid; border-color:black; border-width: 1px;'>Artikelverkauf</div>
      <div style='margin-left:60px;'>
      
      ";
      if($ArtikelAnzahl['1']['ArtikelAnzahl'] > 1)
      {
        $text .="  <h4>Herzlichen Gl&uuml;ckwunsch es wurden ".$ArtikelAnzahl['1']['ArtikelAnzahl']." Deiner Artikel vom gleichen K&auml;ufer gekauft!</h4>";
      }
      else{

        $text .="  <h4> Herzlichen Gl&uuml;ckwunsch Dein Artikel <b style='color:#4863a0;'>'". $Warenkorbartikel[$ArtikelAnzahl['0']['Position']-1]['Bezeichnung'] ."'</b> wurde verkauft!</h4>";
        
        }

      $text .=" </div>
         
    

    <div style='margin-left:60px;'>
            <table style=' margin-top:30px;'>";

            $Position = $ArtikelAnzahl['0']['Position'];
           
           for($c = 0; $c < $ArtikelAnzahl['1']['ArtikelAnzahl']; $c++)
            {
           
              
            $Position = $Position-1;
              echo 'Position in mail '.$Position;

               //var_dump($Warenkorbartikel);

            

              $text .="<tr><td style='width:200px; hight:150px;'> Bild
              </td>
              <td style='float:right; width:400px; '> " . $Warenkorbartikel[$Position]['Bezeichnung'].", 
                  ".switchKategorieVerkaeufer($Warenkorbartikel[$Position],$text ) . "
            </td>
            <td style='width:200px;'>" ;


                             $splitter = preg_split('/W/',$_SESSION['Radiobutton']['Kaufarten_'.$c]);



                                                    
                          //var_dump("HAllo hier kommt was neues");
                          //var_dump( $Kaufarten);

                          if($splitter['0'] == "Kaufwert")
                                                    {
                                                        $Kaufarten  = $Warenkorbartikel[$c]['1'];

                                                      $text .= "<b style='color:#4863a0;'> Verkauft zum Kaufwert von </b></br>";

                                                      $Kaufart = number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                      
                                                      $text .= "<b>".$Kaufart." &euro;<b>";
                                                    }

                          if($splitter['0'] == "Tauschwert")
                                                    {
                                                      $Kaufarten  = $Warenkorbartikel[$c]['0'];

                                                       $text .= "<b style='color:#4863a0;'> Verkauft zum Tauschwert von </b></br>";

                                                      $Kaufart2 =  number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                      $text .= "<b>".$Kaufart2. " &euro; </b>";
                                                    }
                        $text .="<tr> ";                           
                     }                          
                                                            
                                                            

  $text .=  "</td>                         
  </table></div>
                                                                           
  <div style='margin-top:50px; margin-left:40px;'>
    Du findest die Adresse des K&auml;ufers in deinem Konto im Bereich 'Nachrichten'.<br>  Einen Direktlink zu deinem Postfach findest du <a href=''> hier </a>.<br><br> 

   &Auml;ndere bitte den Status des P&auml;ckchens wenn du den Artikel verschickt hast. 
   
   <div style=' float:left; margin-top:50px; '>

   Viele Gr&uuml;&szlig;e <br>

   Dein TuK-Service.

   </div>
   </div>

  ";

  mail($empf,$betreff,$text,$from);
}

function EMail($mysqli, $Warenkorbartikel, $Zeit, $Kaeufername)
{


   $sammelArtikelsumme= 0;
   $sammelVersandkosten = 0;              
    
	
  $count = 0;

  var_dump($Kaeufername['Vorname']);
 var_dump($Warenkorbartikel);

	$empf = "stefanie.burkhardt22@tonline.de";//$benutzer['EMail'];
	$betreff = "Zahlungsbestaetigung";
	$from = "From: TuK.de <stefanie.burkhardt22@t-online.de>\n";
	$from .= "Reply-To: stefanie.burkhardt22@tonline.de\n";
	$from .= "Content-Type: text/html\n";
	$text = "
      <h3 style='text-align:center;'>Zahlungsbest&auml;tigung</h3>

      <div style='margin-left:40px;'>Hallo "; $text .= $Kaeufername['Vorname'] . ", <br>
           <br>
          vielen Dank f&uuml;r Deinen Kauf bei TuK.de.<br>
          Deine Bezahlung ist erfolgreich bei uns eingegangen.<br>
      </div><br>

       <div style=' width:600px; float:right; text-align:right; margin-bottom:30px;'>
          Bestelldatum: ". $Zeit."
      </div>";

     for($y= 0; $y < count($Warenkorbartikel); $y++)
            { 
              //$back =  switchKategorie($Warenkorbartikel[$y]);
              
      $text .= "<div style='margin-left:20px; width:600px; border-top-style:dashed; border-bottom-style:dashed; border-color:black; border-width: 1px; font-weight: bold; margin-bottom:20px;'> <div style='width:600px; margin-bottom:10px; margin-top:10px;color:#4863a0;'> 

                  Artikel ". $count++." - ". $Warenkorbartikel[$y]['Bezeichnung'].", ". switchKategorie($Warenkorbartikel[$y], $text) ."</div></div>";

     
      $text .= "<div style=' margin-bottom:10px; width:600px;'>

      <table class='table' id='WarenkorbTabelle' style='width:600px;  margin-left:40px; margin-bottom:3px;'>
                                                                    <tr >                                                                       
                                                                          <td  style=' width:10%;'>Verk&auml;ufer: 
                                                                          </td><td style='float:right; margin-left:20px;'>";

                                                                     $text .=    "<a href=''>".$Warenkorbartikel[$y]['Benutzername']."  
                                                                  </td>

                                                                     <td></td>                                                                       
                                                                  </tr> 
                                                                        <tr>   
                                                                            <td style=' width:10%;'>Zustand:
                                                                            </td>

                                                                            <td style='float:right;margin-left:20px;'> " . $Warenkorbartikel[$y]['Zustand']."
                                                                            </td>
                                                                             <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style=' width:10%;'>Beschreibung:
                                                                            </td>
                                                                              <td style='float:right; margin-left:20px;'> " . $Warenkorbartikel[$y]['Artikelbeschreibung']."
                                                                            </td>
                                                                             <td></td>
                                                                        </tr>";
                                              //ab hier Kontrollieren                       

                                                     // Kaufarten bei 0 == Tauschwert, Kaufarten bei 1 = Kaufwert



                                                    $splitter = preg_split('/W/',$_SESSION['Radiobutton']['Kaufarten_'.$y]);

                                                    if($splitter['0'] == "Kaufwert")
                                                    {
                                                      $change = 1;
                                                    }
                                                     if($splitter['0'] == "Tauschwert")
                                                    {
                                                      $change = 0;
                                                    }

                                                     $Kaufarten  = $Warenkorbartikel[$y][$change];
                                                     $andereKaufart = $Warenkorbartikel[$y];                           
                                  

                                                        if($splitter['0'] == $Kaufarten['Kaufarten'] && $splitter['1'] == $Kaufarten['Preis'] && $splitter['2'] == $Kaufarten['idVerkaeuferposition'] )
                                                        {

                                                          if($change == 1) // wenn change 0 ist dann wird der Kaufwertübernommen, ansonsten der Tauschwert
                                                          {
                                                            $sammelArtikelsumme = $Kaufarten['Preis'] + $sammelArtikelsumme ;
                                                            $sammelVersandkosten = $andereKaufart['1']['Preis']  + $sammelVersandkosten;

                                                            $Kaufart = number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                            $Kaufart2 =  number_format( $andereKaufart['1']['Preis']/100 , 2, ',', '.');

                                                             $text .= "   
                                                                  
                                                                  <tr>
                                                                  <td > <div style='width:80%; margin-top: 10px;border-top-style:dashed; border-color:black; border-width: 1px;' ><div style='margin-top: 10px; font-weight: bold;' >Artikelkosten:</div></div>                                                                       
                                                                        </td>

                                                                        <td>
                                                                        </td>

                                                                          <td style='float:right; width:20%;'> <div style='margin-top: 20px; text-align:right;'>" . $Kaufart."  &euro;</div>                                                                          
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='font-weight: bold; '>Versandkosten/Tauschkosten:
                                                                        </td>

                                                                        <td>
                                                                        </td> 

                                                                         <td><div style='float:right; text-align:right;'> " . $Kaufart2 ."    &euro;</div>
                                                                        </td>                                                                   
                                                                    </tr>
                                                              ";
                                                           }

                                                           if($change == 0)
                                                          {
                                                               $sammelVersandkosten = $Kaufarten['Preis']  + $sammelVersandkosten;
                                                              $Kaufart =  number_format($Kaufarten['Preis']/100 , 2, ',', '.');

                                                             $text .= " <tr>  <td> <div style='width:80%; margin-top: 10px; margin-left:20%; border-top-style:dashed; border-color:black; border-width: 1px;' > <div style='margin-top: 30px; font-weight: bold; ' > Artikelkosten:</div></div>
                                                                       
                                                                          </td>
                                                                          <td>
                                                                          </td>

                                                                            <td> <div style='float:right; margin-left:30px; width:150%; margin-top: 20px;'> 0,00 &euro;</div>
                                                                          </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td >Versandkosten/Tauschkosten:
                                                                        </td>

                                                                        <td>
                                                                        </td>    

                                                                         <td><div style='float:right; text-align:right; '> ".$Kaufart."  &euro;</div>
                                                                        </td>                                                                   
                                                                    </tr>";
                                                           }
                                                        }// ende if
       
       $text .= "</table></div>";
}// ende for
      $sammelArtikelsumme =  number_format($sammelArtikelsumme/100 , 2, ',', '.');
      $sammelVersandkosten = number_format($sammelVersandkosten/100 , 2, ',', '.');

      var_dump($Kaufarten);

       $text .= "<div style='width:600px; float:left; border-top-style:dashed; border-color:black; border-width: 1px; '> 
            <h4 style=' margin-top:40px;  '>Gesamtkosten:</h4>

            <table style=' margin-left:40px; float:left;width:600px; '>
              <tr> <td style='width:20%;'> Artikelkosten gesamt</td><td> <div style='text-align:right;'>". $sammelArtikelsumme." &euro; </div></td></tr>
              <tr> <td style='width:20%;'> Versandkosten/Tauschkosten gesamt</td><td><div style='text-align:right;'>". $sammelVersandkosten ." &euro; </div></td></tr>
              <tr> <td style='width:20%;'> Servicekosten</td><td><div style='text-align:right;'> ";

              var_dump($sammelArtikelsumme);
              var_dump($sammelVersandkosten);

              //einheitliche Methode zur Berechnung der Servicekosten !!! 

              (float) $gesamtSumme =  (float) $sammelArtikelsumme + (float) $sammelVersandkosten;
              var_dump($gesamtSumme);

             (float)  $Servicekosten =  ($gesamtSumme*0.018) + 0.18;

             (float) $gesamtSumme = $gesamtSumme+ $Servicekosten;
                  

              $text .= number_format($Servicekosten , 2, ',', '.')." &euro; </div></td></tr>
              <tr> <td> <div style='color:green; font-weight: bold;'> Gesamtsumme</div></td><td><div style='float:right; text-align:right; border-top-style:dashed; border-color:black; border-width: 1px; font-weight: bold;'> ". number_format($gesamtSumme , 2, ',', '.')." &euro;</div></td></tr>
             </table></div>"; // Farbe blau

       //


      
       $text .= "<p><div style='width:600px; float:left; border-top-style:dashed; border-color:black; border-width: 1px; margin-top:20px; margin-bottom:50px; margin-left:20px;'>
       <div style=' float:left; margin-top: 10px;'>
       Ein Verk&auml;ufer hat 5 Tage Zeit seinen Artikel zu verschicken. Zus&auml;tzlich k&ouml;nnen 2-5 Werktage vergehen bis die Ware bei dir eintrifft. <br>
      Bei &Auml;nderungen des Versandstatus wirst du umgehend per Mail informiert.<br> 
      Bei Fragen bez&uuml;glich der Artikel, setzten Sie sich bitte direkt mit dem Verk&auml;ufer auseinander. </div>

      <div style=' float:left; margin-top:50px; '>
      Mit freundlichen Gr&uuml;&szlig;en<br><br>

      <div style='margin-bottom:20px;'>

      Dein TuK-Team</div><br>

      service@tuk.de</div></div>      

      ";
		
			mail($empf,$betreff,$text,$from);

		
}


?>