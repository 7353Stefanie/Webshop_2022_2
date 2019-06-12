<?php


 session_start();


if(isset($_POST))
{
	// try catch am Ende
	try{

	  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

          if ($mysqli->connect_error)
             {
                echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
             } 

          else {  
          			//var_dump($_POST);
          			if(isset($_POST) )
          			{
          				
                   $date = getdate();
                   $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);


          				 SpeicherAdresse($mysqli, $Zeit);
          				 $Adresse = Adresse($mysqli);
                   $letzteAdresse = letzteAdresse($mysqli, $Zeit);

                   //var_dump($letzteAdresse);
                   
          				 $_SESSION['Adresse']= "";
          				 $_SESSION['Adresse']= $Adresse;
                   $_SESSION['AdressseAkutallisieren'] = $_POST['AdressseAkutallisieren'];
                   echo 'TTT'.$letzteAdresse[0]['idAdresse'].'TTT';
          			}

          			 $mysqli->close();
          		}
      }

	catch(Exception $Err) 
	{
		echo "Try catch ". $Err;
	}
 }

function letzteAdresse($mysqli,$Zeit)
{
        $query = sprintf("SELECT *
                         from    Adresse
                         where  idBenutzer =   '%s' and Zeitstempel = '%s'",                                                         
                                                          
                         $mysqli->real_escape_string($_SESSION['idBenutzer']) ,
                          $mysqli->real_escape_string($Zeit) 

                         ); 

                            $result = $mysqli->query($query);     

                    if ( !  $result )
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


function Adresse($mysqli)
{
        $query = sprintf("SELECT *
                         from    Adresse
                         where  idBenutzer =   '%s' ",                                                         
                                                          
                         $mysqli->real_escape_string($_SESSION['idBenutzer']) 

                         ); 

                            $result = $mysqli->query($query);     

                    if ( !  $result )
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

 function SpeicherAdresse($mysqli,$Zeit)
{
            $query2 = sprintf("INSERT INTO adresse (Ort,Bundesland,Strasse, Postleitzahl, idBenutzer, Land, Vorname, Nachname, ausgewaehlt, Zeitstempel)
                                           VALUES ('%s' ,'',        '%s',     '%s',       '%s',       '',    '%s',   '%s',     '0',          '%s')" ,  
                 
                 	// DAtumsangabe 
                  $mysqli->real_escape_string($_POST['Ort']),
                  $mysqli->real_escape_string($_POST['Strasse']),
                  $mysqli->real_escape_string($_POST['PLZ']),
                  $mysqli->real_escape_string($_SESSION['idBenutzer']),
                  $mysqli->real_escape_string($_POST['Vorname']),
                  $mysqli->real_escape_string($_POST['Nachname']),
                  $mysqli->real_escape_string($Zeit)               
                ); 

         $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Adresse speichern ' . mysqli_error());
                    }
}
 