<?php

  session_start();

require_once(__DIR__.'/Abfragen/Abfragen_Sammlung.php'); 


if(  strpos(__DIR__,'Final') == false)
  { 
    $pos=strpos(__DIR__,'Webshop');
    $bezi= 'Webshop';
  }
  else
  {
    $pos=strpos(__DIR__,'Final');
    $bezi = 'final';
  }


$rest = substr(__DIR__,0,$pos);

include $rest.'/external_incl/my_incl.php';



 $Abfragen = new Abfragen();

 $Ergebnis= "";




if (isset($_SESSION['login'])) 
{
																	if($bezi == 'Webshop')
																			{header('Location: https://sb-box42.de/Webshop/Final.php');}

																	else{ header('Location: http://' . $_SERVER['HTTP_HOST'] . __DIR__);}
} 
else
 {



	#wenn die Inhalte nicht leer sind
				if (!empty($_POST))
				 {
							if (
								empty($_POST['benutzername']) ||
								empty($_POST['password'])
								)
								 {
											echo  'Es wurden nicht alle Felder ausgefüllt.';
								 }
					 else {

						#Datenbank zugriff
														$mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);


														if ($mysqli->connect_error) 
														{

															echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

														} else {

																					# gebe Benutzernamen und Passwort aus der Datenbank raus

																					$Ergebnis = $Abfragen->SelectBenutzer_Name_Guthaben($mysqli,$_POST['benutzername']);		


																													if (password_verify($_POST['password'], $Ergebnis['Passwort'])) 
																															{ # wenn das passwort richtig ist 

																																//session_start();
																															
																																	$_SESSION['benutzername']= $row['benutzername'];
																																	
																																	$_SESSION['idBenutzer'] = $row['idBenutzer'];
																																
																																																#	echo  'Anmeldung erfolgreich, <a href="/test/willkommen2_funktioniert.php">weiter zum Inhalt.';

																																header('Location: https://sb-box42.de/Webshop/Kategorien/StartseitenAnmeldung.php');

																															} 
																													else {
																																	echo  'Das Kennwort ist nicht korrekt oder der Benutzer wurde nicht gefunden.';

																																	  $_SESSION['LoginDat'] = 1;
																																		header('Location: https://sb-box42.de/Webshop/Final.php');

																															 }															 			

																						mysqli_free_result( $result );
																					                                                    
																						$mysqli->close();
																		} //ende else
		
				} // ende else
			}// ende if

	else {
						echo  'Geben Sie Ihre Zugangsdaten ein um sich anzumelden.<br />' .
							'Wenn Sie noch kein Konto haben, gehen Sie <a href="https://sb-box42.de/Final">zur Registrierung</a>.';
			 }
}// ende else

?>