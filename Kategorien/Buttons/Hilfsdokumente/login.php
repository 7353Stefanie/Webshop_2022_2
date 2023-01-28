<?php



$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);


include $rest.'external_incl\my_incl.php';


if (isset($_SESSION['login'])) {
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/final.index.php');
} 
else {

	#wenn die Inhalte nicht leer sind
	if (!empty($_POST)) {
		if (
			empty($_POST['benutzername']) ||
			empty($_POST['password'])
			)
			 {

			echo  'Es wurden nicht alle Felder ausgefüllt.';

			 }
		 else {

			#Datenbank zugriff
			$mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);


			if ($mysqli->connect_error) {

				echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;


			} else {

				# gebe Benutzernamen und Passwort aus der Datenbank raus

				$query = sprintf(
					"SELECT benutzername, Passwort, idBenutzer FROM benutzer WHERE  Benutzername = '%s'",
					$mysqli->real_escape_string($_POST['benutzername'])
				);


				$result = $mysqli->query($query); # Enthält Benutzernamen und Passwort



				if ($row = $result->fetch_array(MYSQLI_ASSOC)) { #Schreibt die Ergebnisvariablen in $row

						//var_dump($row);

					if (password_verify($_POST['password'], $row['Passwort'])) { # wenn das passwort richtig ist 


						session_start();

						if ( !isset( $_SESSION['benutzername']  ) )
						
						{
							$_SESSION['benutzername']= $row['benutzername'];
							
							$_SESSION['idBenutzer'] = $row['idBenutzer'];
						}	
						

							
					//	echo session_encode ();


					#	echo  'Anmeldung erfolgreich, <a href="/test/willkommen2_funktioniert.php">weiter zum Inhalt.';


						header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/StartseitenAnmeldung.php');


					} else {
						echo  'Das Kennwort ist nicht korrekt.';
					}
				} else {
					echo 'Der Benutzer wurde nicht gefunden.';
				}

				 mysqli_free_result( $result );
                                                    
				$mysqli->close();
			}
		}
	} else {
		echo  'Geben Sie Ihre Zugangsdaten ein um sich anzumelden.<br />' .
			'Wenn Sie noch kein Konto haben, gehen Sie <a href="./register.php">zur Registrierung</a>.';
	}
}
?>