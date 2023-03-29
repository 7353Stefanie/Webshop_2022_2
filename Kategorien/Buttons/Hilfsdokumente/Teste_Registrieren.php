<?php


require_once(__DIR__.'/Abfragen/Abfragen_Sammlung.php'); 


if(  strpos(__DIR__,'Final') == false)
  {     $pos=strpos(__DIR__,'Webshop');
  }
  else
  {    $pos=strpos(__DIR__,'Final');
  }


$rest = substr(__DIR__,0,$pos);
include($rest.'/external_incl/my_incl.php');

 $Abfragen = new Abfragen();

 $Ergebnis= "";

  session_start();

 


  $_SESSION["RegistrierungStatus"]= false;


	

#sind die eingebefelder leer?

	if (!empty($_POST))
	{
		if (
			empty($_POST['benutzername']) ||
			empty($_POST['vorname']) ||
			empty($_POST['nachname']) ||
			empty($_POST['email']) ||
			empty($_POST['passwort']) ||
			empty($_POST['passwort_again'])
			)

		 {
			echo  'Es wurden nicht alle Felder ausgefüllt.';
		 } else if ($_POST['passwort'] != $_POST['passwort_again']) {
			echo  'Die eingegebenen Passwörter stimmen nicht überein.';
		 } else 
		 	{
					unset($_POST['password_again']);
					$salt = ''; 

#passwort verschlüsseln

					$_POST['passwort'] = password_hash($_POST['passwort'],PASSWORD_DEFAULT, ['cost' => 13]);	
		

#Datenbankverbindung aufbauen

			
           			$mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

#DB Verbindung Prüfen
					if ($mysqli->connect_error) 
					{
						echo  'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
					}
					else
					{
						$Ergebnis = $Abfragen->insertRegistrierung($mysqli,$_POST['benutzername'],$_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['passwort']);


#SQL Abfrage übermitteln
			

#Überprüfen ob der Nutzername noch vorhanden ist

							if ($Ergebnis == true)
							{
								#echo  ' Ein Neuer Benutzer (' . htmlspecialchars($_POST['benutzername']) . ') wurde erfolgreich angelegt.
								#Zur Bestätigung Ihrer Registrierung werden Sie in kürze eine E-Mail auf die folgende E-Mail-Adresse erhalten : ' . htmlspecialchars($_POST['email']) . '.
								#Nach der Bestätigung Ihrer E-Mail-Adresse können Sie sich über folgenden link anmelden. 
								#, <a href="http:localhost/test/01_Bauteile/Final.html">weiter zur Anmeldung</a>.';

								// Wenn die Registrierung erfolgreich war wird der Anwender direkt in den Kontoübersichtsm

						//header('Location: /Final/Kategorien/StartseitenAnmeldung.php');

								// Login muss beginnen

								 $_SESSION["RegistrierungStatus"]= 'true';
								 // damit login 

								 //ausgabe ID

								 $Ergebnis_Select = $Abfragen->SelectBenutzer_Bentuzer($mysqli,$_POST['benutzername']);	// damit login klappt

								 

								 if(is_null($Ergebnis_Select) == false)
								 {	
										 	$_SESSION['idBentuzer'] = $Ergebnis_Select['0']['idBenutzer'];
											$_SESSION['benutzername'] = $_POST['benutzername']; 															



											if ($name = 'Final')
											{
											 header('Location: /Final/Final.php');								 
											}
											else
												{
													header('Location: /Webshop/Final.php');
											    }
								 }
							} 

							else 
							{
								echo 'Die Registrierung war leider nicht erfolgreich.';
							}
#Datenbank schließen
			  
						$mysqli->close();
					} // ende else
			}  // ende else
	} // ende if

	 else {
		echo 'Übermitteln Sie das ausgefüllte Formular um ein neues Benutzerkonto zu erstellen.';
	}

?>