<?php
define('__ROOT__', __DIR__.'/Kategorien/Buttons/Hilfsdokumente/Abfragen');
require_once(__ROOT__.'/Abfragen_Sammlung.php'); 
require_once(__ROOT__.'/EMail.php'); 

$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);


include $rest.'external_incl\my_incl.php';




							// 6. 	// Alle Verkausfsartikel auslesen, 

						/*		6.1	Tausch oder Kauf herausfinden,
								6.2 Preis ermitteln,
							  	6.3	Preise zusammenzählen, 
							   	6.4 guthaben ermitteln und auf Plausibilität prüfen (guthaben >= Tauschpreis) Guthaben */
 session_start();

  $date = getdate();

  $Abfragen = new Abfragen();
  $EMail = new EMails();

  $Adresse   =  Array();
  $Status = Array();
  $Benutzer = Array();

  $NGuthaben = 0;



  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
  var_dump($Zeit . "Zeit");

  try{


		if (isset($_POST['Adresse']) && isset($_POST['Zahlungsart'] ))
			{
				 $mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

	           if ($mysqli->connect_error)
	              {
	                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
	              } 

	          else { 	

	          					//1. Zahlungsvorgang
									/*1.1 update Table Adresse und Kaufarten check
									  1.1.1 Übertragung der Radiobuttonwerte über die Forms --> check
									  1.1.2 neue Zeile in DB einrichten (boolean) 0 = nicht angeklickt,  1 = angeklickt  
									  1.1 Tests durchgeführt Adresse übertragung*/

					try{			
								$_SESSION['Zahlungsart'] = $_POST['Zahlungsart'];

								echo ('erfolgreich');


								
	    						$Adresse  = $_POST['Adresse'] ;

	    						var_dump($Adresse);
	    					
	    						$numbers = preg_replace('/[^0-9]/', '', $Adresse);
	    						$letters = preg_replace('/[^a-zA-Z]/', '', $Adresse);

	    						var_dump($numbers);
	    						var_dump($letters);

	    						$Rueckgabe = $Abfragen->selectAdresse_Zahlungsvorgang($mysqli);			 // alle Werte in denen ein R , V oder RV vorkommt 	
	    						$id = array_search($Rueckgabe[0]['idAdresse'],$numbers);

	    						var_dump($Rueckgabe);
    						#
    				if($numbers[0] == $numbers[1]) 
    						{								
							// überprüfe ob die Einstellung gleichgeblieben ist // Annahme es können maximal 2 werte in Numbers vorhanden sein
							 

							 if($Rueckgabe[0]['ausgewaehlt'] != 'VR' || $Rueckgabe[0]['idAdresse'] != $numbers[0] )
							 {
								//löschen bzw. update der bisherigen werte
							 	
							 		$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli,$Rueckgabe[1]['idAdresse'], '0');
							 		$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli,$Rueckgabe[0]['idAdresse'], '0');

							 		$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli,$numbers[0], 'VR');
							 }							
						}
						else{ // es gibt 2 ids 							

								$id = array_search($Rueckgabe[0]['idAdresse'],$numbers);//  $id// weichen die vorhandenen Daten aus der Datenbank mit den neuen ab ? 
								 
								if(($Rueckgabe[0]['idAdresse'] != $letters[$id]) || ($Rueckgabe[1]['idAdresse'] == $letters[$id]))
								{
									$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli,$Rueckgabe[1]['idAdresse'], '0');
							 		$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli,$Rueckgabe[0]['idAdresse'], '0');

									$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli, $numbers[0], $letters[0]);
									$Abfragen->upadteAdresse_Zahlungsvorgang($mysqli, $numbers[1], $letters[1]);
								}	

							} // ende else

							// Ende update Adresse//Start update Zahlungsart in Tabelle Guthaben

							// select Guthaben  und updateGuthaben falls sich etwas geändert hat

							$bisherigeZahlungsart = $Abfragen->selectZahlungsart_by_Benuzter($mysqli, $_SESSION['idBenutzer']);  // Zahlungsart K, P, S


							var_dump($bisherigeZahlungsart);
							echo  $_POST['Zahlungsart'];

							$Var=  $Abfragen::selectZahlungsart_by_Benuzter($mysqli, $_SESSION['idBenutzer']);

							echo  $_POST['Zahlungsart'];
							echo $bisherigeZahlungsart;

							if($bisherigeZahlungsart['Zahlungsart'] != $_POST['Zahlungsart'] )
							{								
								$Abfragen->updateZahlungsart($mysqli,$_POST['Zahlungsart'],$_SESSION['idBenutzer']);
							}

            } // ende try
            catch(Exception $err)
            {
                $err =' Update Fehler Adresse, Zahlungsart';
            }

            					// 6. 	// Alle Verkausfsartikel auslesen, 

						/*		6.1	Tausch oder Kauf herausfinden,
								6.2 Preis ermitteln,
							  	6.3	Preise zusammenzählen, 
							   	6.4 guthaben ermitteln und auf Plausibilität prüfen (guthaben >= Tauschpreis) Guthaben */


							var_dump($_SESSION['buttonwerte']);
							$idRadio =  $_SESSION['buttonwerte'];

							$idKaufarten = Array();
							$ArtikelKategorie = Array();

							$NGuthaben = 0;
							$AbzueglichesGuthaben = 0;
							

							
							$Warenkorbartikel =	$Abfragen->selectWarenkorbartikel_by_Benuzter($mysqli,$_SESSION['idBenutzer']); //Alle Verkausfsartikel auslesen

						


							//ÜBERPRÜFUNG OB DIE ÜBERMITTELTEN PREISE ÜBEREINSTIMMEN
							//WENN ALLES STIMMT WIRD DER KUNDE/ANWENDER AN DIE ZAHLUNGSPLATTFORM WEITERGELEITET

							for($i = 0; $i<count($Warenkorbartikel); $i++)
							{

								$splitter = preg_split('/W/', $idRadio["Kaufarten_".$i]);
								$Verkaeuferpos = $Warenkorbartikel[$i]['idVerkaeuferposition'];	

								//$Kaufart = $Warenkorbartikel[$i]['Kaufart']; // inhalt K // inhalt Radio: Kaufwert

								//echo $splitter['0'];

								$Preise = $Abfragen->selectKaufarten_by_idVerkaeuferposition_und_Kaufarten($mysqli, $Verkaeuferpos, $splitter['0']);								
								
								//$Preise['Preis'] // $Preise['Kaufarten'] // $Preise['idVerkaeuferposition']
								
								$idKaufarten[$i] = $Preise['idKaufarten']; 


								if($splitter['0'] == $Preise['Kaufarten'] && $splitter['1'] == $Preise['Preis'] && $splitter['2'] == $Preise['idVerkaeuferposition'] )
								{
									$Status[$i] = 'OK';
								}
								else{$Status[$i] = 'Fehler';}

								// alles vergleichen mit den Radiobuttonwerten // aufbau Radio: Kaufart, Preis, idVerkaeuferpos
								var_dump($Preise); // [1] ist der Preis

							}

						


							var_dump($Status);

							$key = array_search('Fehler', $Status);

							var_dump($key);

							if($key != false)
							{
                 					
								var_dump( 'ein Fehler ist aufgetreten');

                 					header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Warenkorb.php');

							}
							else
							{
								// auslösen der Zahlung über Mangopay


								//MANGOPAY


								// Wenn die Zahlung Erfolgreich war, muss in die Php-Seite von Mangopay ein Link zu Zahlungsvorgang.php eingefügt werden. Siehe unten


								// soll nur gemacht werden, wenn die Zahlung erfolgreich war



						// 1.	Bestellposition befüllen ( insert into), check
						
						// 2.   Verfügabarkeitsstatus in Verkäuferposition ändern auf 2. // bedeutet nicht mehr verfügbar
						//		2.2 updete GekauftZumPreisVon
						// 3.	Artikel aus dem Warenkob löschen, check
						// 3.1	Guthaben verringern  --> muss noch gemacht werden
						
						// 4.   automatisch generierte Bestellbestätigung per Mail verschicken (Käufer) check (muss nochmal getestet werden wenn es auf dem Server vorhanden ist)
						// 5.   automatisch generierte Verkaufsinformation an den Verkäufer per Mail verschicken

								

								try{

											

									$Kaeufer = $Abfragen->selectBenutzer_Guthaben($mysqli,$_SESSION['idBenutzer']);


									for($i = 0; $i<count($Warenkorbartikel); $i++)
									{

										$splitter = preg_split('/W/', $idRadio["Kaufarten_".$i]);

										$AbzueglichesGuthaben = $AbzueglichesGuthaben + $splitter['1'] ;


										$Abfragen->updateVerkaeuferposition($mysqli,$splitter['1'], $splitter['2']);

										// Guthaben wird angeglichen
										$NGuthaben = $Kaeufer['Guthaben'];

									if($splitter['0'] == 'Tauschwert')
									{
										if( $AbzueglichesGuthaben != 0)
										{
											$NGuthaben = $NGuthaben - $AbzueglichesGuthaben;	
										}// ende if
										
									} // ende for
									 
												if($NGuthaben != $Kaeufer['Guthaben'])
												{
													echo 'Neues Guthaben ist ' . $NGuthaben;
													$Abfragen->updateGuthaben_Plausibilitaet($mysqli, $_SESSION['idBenutzer'],$NGuthaben );
												}
												


									for($i = 0; $i  < count($Warenkorbartikel); $i++)
									{
										

										$Abfragen->insertBestellposition($mysqli,  $Zeit ,$_SESSION['idBenutzer'], $Warenkorbartikel[$i]['idVerkaeuferposition'],$idKaufarten[$i]); // Befüllung Bestellposition //1.
										$Abfragen->upadteVerkaeuferposition_Zahlungsvorgang($mysqli, $Warenkorbartikel[$i]['idVerkaeuferposition']);		// 2.
										// 3.1 Guthaben

										$idVerkaeuferposition = $Abfragen->selectVerkaeuferposition_Zahlungsvorgang($mysqli, $Warenkorbartikel[$i]['idVerkaeuferposition']);

                    // Annahme das Array $idVerkäuferposition und $Artikel sind gleich lang

										$Artikel =    $Abfragen->selectArtikel_by_ArtikelId($mysqli,$idVerkaeuferposition['idArtikel']);

                    
										$Kategorien =  $Abfragen->selectKategorie_by_Kategorie_und_ArtikelId($mysqli, $Artikel['Kategorien'], $Artikel['idArtikel']);

					                    $Kaufarten =   $Abfragen->selectKaufarten_by_idVerkaeuferposition($mysqli,$Warenkorbartikel[$i]['idVerkaeuferposition']);

					                    $Benutzer =    $Abfragen->selectBenutzer_Zahlungsvorgang($mysqli,$idVerkaeuferposition['idBenutzer']); // Benutzer ist der Verkäufer


										$ArtikelKategorie[$i] = array_merge($Benutzer,$idVerkaeuferposition, $Artikel, $Kategorien, $Kaufarten);
									}

					                  $Kaeufername = $Abfragen->selectBenutzer_Zahlungsvorgang($mysqli,$_SESSION['idBenutzer']);
										
									$Abfragen->deleteWarenkorbartikel($mysqli,$_SESSION['idBenutzer']); // lösche Warenkorbartikel // 3.

									var_dump($Benutzer);

									
								

									

									//var_dump($ArtikelKategorie);
                  					var_dump($_SESSION['buttonwerte']);

									$EMail->EMail_Kaeufer($mysqli, $ArtikelKategorie, $Zeit, $Kaeufername, $_SESSION['buttonwerte']);

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

                  $EMail->EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $ArtikelKategorie, $_SESSION['buttonwerte']);



                  
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


                  $EMail->EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $ArtikelKategorie, $_SESSION['buttonwerte']);
                  
                  $zaehler = 0;

                  echo ' Position ist '.$x.'</br>';

                  echo ' Anzahl der Artikel ' .$zaehler.'</br>';

                  echo' position 2 E-mail wurde ausgelöst </br>';
              }
            } //ende for
        }

							   } // ende try
						catch(Exception $err)
							{
								echo($err+'Fehler');
							}
																				

				

					} // else
			}// if
		}

}// ende Try
catch(Exception $ex)
{
	echo $ex;
}

?>