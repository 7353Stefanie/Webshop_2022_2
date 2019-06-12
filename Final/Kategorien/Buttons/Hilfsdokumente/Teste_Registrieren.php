<?php

	$message = array();

#sind die eingebefelder leer?

	if (!empty($_POST)) {
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
		 } else {
			unset($_POST['password_again']);
			$salt = ''; 

#passwort verschlüsseln

			$_POST['passwort'] = password_hash($_POST['passwort'],PASSWORD_DEFAULT, ['cost' => 13]);	
		

#Datenbankverbindung aufbauen

			$mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

#DB Verbindung Prüfen
			if ($mysqli->connect_error) {

				echo  'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
			}

#SQL Abfrage 

#			$query = sprintf(
#				"INSERT INTO benutzer (benutzername, vorname, nachname, email ,password)
#				SELECT * FROM (SELECT '%s', '%s', '%s', '%s', '%s') as new_user
#				WHERE NOT EXISTS (
#					SELECT benutzername FROM benutzer WHERE benutzername = '%s'
#				) LIMIT 1;",
#				$mysqli->real_escape_string($_POST['benutzername']),
#				$mysqli->real_escape_string($_POST['vorname']),
#				$mysqli->real_escape_string($_POST['nachname']),
#				$mysqli->real_escape_string($_POST['email']),
#				$mysqli->real_escape_string($_POST['passwort']),
#				$mysqli->real_escape_string($_POST['benutzername'])
#			);

			$query = sprintf("INSERT INTO benutzer (Benutzername, Vorname, Nachname, EMail ,Passwort)
							VALUES ('%s', '%s', '%s', '%s', '%s')",
								$mysqli->real_escape_string($_POST['benutzername']),
								$mysqli->real_escape_string($_POST['vorname']),
								$mysqli->real_escape_string($_POST['nachname']),
								$mysqli->real_escape_string($_POST['email']),
								$mysqli->real_escape_string($_POST['passwort'])
							);


#SQL Abfrage übermitteln
			$mysqli->query($query);

#Überprüfen ob der Nutzername noch vorhanden ist

			if ($mysqli->affected_rows == 1) {
				#echo  ' Ein Neuer Benutzer (' . htmlspecialchars($_POST['benutzername']) . ') wurde erfolgreich angelegt.
				#Zur Bestätigung Ihrer Registrierung werden Sie in kürze eine E-Mail auf die folgende E-Mail-Adresse erhalten : ' . htmlspecialchars($_POST['email']) . '.
				#Nach der Bestätigung Ihrer E-Mail-Adresse können Sie sich über folgenden link anmelden. 
				#, <a href="http:localhost/test/01_Bauteile/Final.html">weiter zur Anmeldung</a>.';

		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Final.html');

			} else {
				echo 'Der Benutzername ist bereits vergeben.';
			}

#Datenbank schließen
			  
			$mysqli->close();
		}
	} else {
		echo 'Übermitteln Sie das ausgefüllte Formular um ein neues Benutzerkonto zu erstellen.';
	}
?>