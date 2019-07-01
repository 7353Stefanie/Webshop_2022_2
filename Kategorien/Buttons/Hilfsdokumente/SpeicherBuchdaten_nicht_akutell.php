<?php
 		session_start();

 		
 		 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop03');

          if ($mysqli->connect_error)
             {
                echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
             } 

          else {  //alle zahlungsmittel von Benutzerid x holen
                                                           
               $query2 = sprintf("INSERT INTO bücher ( ISBN,  Buchtitel , Autor, Erscheinungsjahr, Auflage,  Kurzbeschreibung)
				   VALUES ('%s', '%s', '%s', '%s','%s', '') ",   

      				   	$mysqli->real_escape_string($_POST['ISBN']),
      				   	$mysqli->real_escape_string($_POST['Buchtitel']),
      				   	$mysqli->real_escape_string($_POST['Autor']),
                	$mysqli->real_escape_string($_POST['Erscheinungsjahr']),
                	$mysqli->real_escape_string($_POST['Auflage'])
               
                ); 

                $result = $mysqli->query($query2);

                 if ( !  $result )
                    {
                       die('Ungültige Abfrage: ' . mysqli_error());
                    }

                 header('Location: http://' . $_SERVER['HTTP_HOST'] . '../../MeineVerkaufsartikel.php');
             }


 ?>