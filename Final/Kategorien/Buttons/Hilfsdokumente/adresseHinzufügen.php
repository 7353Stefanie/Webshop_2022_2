<?php
 		session_start();
 		

 		 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop03');

          if ($mysqli->connect_error)
             {
                echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
             } 

          else {  //alle zahlungsmittel von Benutzerid x holen
                                                           
               $query2 = sprintf("INSERT INTO adresse ( Ort,  Bundesland , Strasse, Postleitzahl, idBenutzer,  Land, Vorname,Nachname, Hausnummer)
				   VALUES ('%s','', '%s', '%s', '%s','%s', '%s','%s','%s') ",   

				   	$mysqli->real_escape_string($_POST['Ort']),
				   	$mysqli->real_escape_string($_POST['Strasse']),
				   	$mysqli->real_escape_string($_POST['Postleitzahl']),
                	$mysqli->real_escape_string($_SESSION['idBenutzer']),
                	$mysqli->real_escape_string($_POST['Land']),
                	$mysqli->real_escape_string($_POST['vorname']), 
                	$mysqli->real_escape_string($_POST['nachname']),
                	$mysqli->real_escape_string($_POST['Hausnummer'])
                ); 

                $result = $mysqli->query($query2);

                 if ( !  $result )
                    {
                       die('Ungültige Abfrage: ' . mysqli_error());
                    }

                 header('Location: http://' . $_SERVER['HTTP_HOST'] . '/test/ZuDenZahlungsdetails.php');
             }


 ?>