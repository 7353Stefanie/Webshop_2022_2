<?php


      session_start()   


if(  strpos(__DIR__,'Final') == false)
  { 
    $pos=strpos(__DIR__,'Webshop');
  }
  else
  {
    $pos=strpos(__DIR__,'Final');
  }


//echo ('pos'.$pos);

$rest = substr(__DIR__,0,$pos);

//echo ('rest'.$rest);


include($rest.'external_incl/my_incl.php');   

 
class adresseHinzufuegen()

{

    function adresseHinzufuegen()
{





 		 $mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
                 

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


    }
}

 ?>








