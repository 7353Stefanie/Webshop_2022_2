<?php


 session_start();

if(  strpos(__DIR__,'Final') == false)
  { 
    $pos=strpos(__DIR__,'Webshop');
  }
  else
  {
    $pos=strpos(__DIR__,'Final');
  }


$rest = substr(__DIR__,0,$pos);

include $rest.'/external_incl/my_incl.php';



if(isset($_POST))
{
	// try catch am Ende
	try{


	   $mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

          if ($mysqli->connect_error)
             {
                echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
             } 

          else {  
 
                Verkaeuferposition($mysqli); # befüllt Verkaeuferposition

               $AnweisungVerkaeuferposition =   selectVerkaeuferposition($mysqli); # Ausgabe Verkaeuferposition

             
               $laenge= count($AnweisungVerkaeuferposition) -1;

               if(isset($_SESSION['Bilder']))
               {

               Verkaeuferbild($mysqli, $AnweisungVerkaeuferposition[$laenge]['idVerkaeuferposition']); # befüllt Verkaeuferbild

               $AusgabeVerkaeuferbild = selectVerkaeuferbild($mysqli, $AnweisungVerkaeuferposition['0']['idVerkaeuferposition']); # Ausgabe Verkaeuferbild

              }

              Kaufarten($mysqli, $AnweisungVerkaeuferposition['0']['idVerkaeuferposition']);

              $AusgabeKaufarten = selectKaufarten($mysqli,$AnweisungVerkaeuferposition['0']['idVerkaeuferposition']);



             } // ende else

                          
        $mysqli->close();

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/MeineVerkaufsartikel.php');

               
     } // ende Try

	catch(Exception $Err) 
	{
		echo "Try catch ". $Err;
	}

}else
{
	echo "Es sind keine Daten angekommen";
}

function Verkaeuferposition($mysqli)
{
            $query2 = sprintf("INSERT INTO Verkaeuferposition (idBenutzer, Verkaufspositionsdatum, Verkaufsmenge, idArtikel, Zustand, Notiz, Artikelbeschreibung, Verfuegbarkeitsstatus)
                                 VALUES ('%s',NOW(), '%s','%s', '%s','%s','%s','Verfügbar')" ,   

                  $mysqli->real_escape_string($_SESSION['idBenutzer']),
                 	// DAtumsangabe 
                  $mysqli->real_escape_string($_POST['Menge']),
                  $mysqli->real_escape_string($_SESSION['hochgeladenesBuch'][0]['idArtikel']),
                  $mysqli->real_escape_string($_POST['Zustand']),
                  $mysqli->real_escape_string($_POST['Beschreibung']),
                  $mysqli->real_escape_string($_POST['Titel'])                  
               
                ); 

         $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Verkaeuferposition ' . mysqli_error());
                    }



}

function selectVerkaeuferposition($mysqli)
{
  $query3 = sprintf("Select * from Verkaeuferposition where idBenutzer = '%s' and idArtikel ='%s'", 
    $mysqli->real_escape_string($_SESSION['idBenutzer']),
    $mysqli->real_escape_string($_SESSION['hochgeladenesBuch'][0]['idArtikel']) ); 

   $Rows = Array(); 
      $result3 = $mysqli->query($query3);
                
                  if ( !  $result3)
                    {
                       die('Ungültige Abfrage: selectVerkaeuferposition' . mysqli_error());
                    }


       while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten

                         
                     }

                      mysqli_free_result( $result3 );
                      return $Rows;
}

function Verkaeuferbild($mysqli, $idVerkaeuferposition)
{
 $laengeBilder=count($_SESSION['Bilder']);

         for(  $i = 0; $i < $laengeBilder; $i++)
         {

         $query2 = sprintf("INSERT INTO Verkaeuferbild(idVerkaeuferposition, Verkaeuferbild)
                            VALUES ('%s','%s')" ,

                         $mysqli->real_escape_string($idVerkaeuferposition), 


                          $mysqli->real_escape_string($_SESSION['Bilder'][$i]) );
        }

        $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Verkaeuferbild' . mysqli_error());
                    }

 #schleife über alle Bilder
      
}

function selectVerkaeuferbild($mysqli,$idVerkaeuferposition)
{
    

    $query4 = sprintf("Select * from Verkaeuferbild where 'idVerkaeuferposition' = '%s' ", 
    $mysqli->real_escape_string($idVerkaeuferposition) ); 

      $result4 = $mysqli->query($query4);
      $Rows = Array(); 

                
                  if ( !  $result4)
                    { die('Ungültige Abfrage:  selectVerkaeuferbild' . mysqli_error());
                    }


       while ($row = $result4->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten
                     }

                      mysqli_free_result( $result4 );
                      return $Rows;
  
}

function Kaufarten($mysqli, $idVerkaeuferposition)
{

 $query = sprintf("INSERT INTO Kaufarten(Preis, Kaufarten, idVerkaeuferposition,ausgewaehlt)
                    VALUES ('%s','Tauschwert','%s', '0')" ,

                  $mysqli->real_escape_string($_POST['Tauschwert']*100) ,
                $mysqli->real_escape_string($idVerkaeuferposition) );

 $result = $mysqli->query($query);

                         if ( !  $result)
                    {
                       die('Ungültige Abfrage: Kaufarten ' . mysqli_error());
                    }

  $query2 = sprintf("INSERT INTO Kaufarten(Preis, Kaufarten, idVerkaeuferposition,ausgewaehlt)
                    VALUES ('%s','Kaufwert','%s','0')" ,

                  $mysqli->real_escape_string($_POST['Restwert']*100),
                   $mysqli->real_escape_string($idVerkaeuferposition) );

  $result2 = $mysqli->query($query2);

                         if ( !  $result2 )
                    {
                       die('Ungültige Abfrage: Kaufarten' . mysqli_error());
                    }
}

function selectKaufarten($mysqli,$idVerkaeuferposition)
{
  $query4 = sprintf("Select * from Kaufarten where 'idVerkaeuferposition' = '%s' ", 
    $mysqli->real_escape_string($idVerkaeuferposition) ); 

      $result4 = $mysqli->query($query4);

   $Rows = Array();                 
                  if ( !  $result4)
                    { die('Ungültige Abfrage: selectKaufarten' . mysqli_error());
                    }


       while ($row = $result4->fetch_array(MYSQLI_ASSOC))
                     {
                         $Rows[] = $row; // enthällt die kosten
                     }

                      mysqli_free_result( $result4 );
                      return $Rows;
}

