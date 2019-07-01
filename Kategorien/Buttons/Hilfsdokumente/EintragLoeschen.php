<?php

 session_start();

 
	//  var_dump($Zeit . "Zeit");

 function Warenkorb(){

 $date = getdate();

  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);


			if (isset($_POST['Post']))
			{

				  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

				   if ($mysqli->connect_error) {

			          echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

			      } 
			      else {  
			      	echo $_POST['Post'];

			      	   $idVerkaeuferposition = selectVerkaeuferposition($mysqli, $_POST['Post']);     
				       deleteWarenAusWarenkorb($mysqli);				       
				       updateVerkaeuferposition($mysqli, $idVerkaeuferposition['idVerkaeuferposition'], $Zeit);

			       	  }// ende Else

			    mysqli_close($mysqli);
			}
}

function selectVerkaeuferposition($mysqli, $idWarenkorb)
{

      $query = sprintf("select idVerkaeuferposition from Warenkorb where idWarenkorb ='%s' " 
      					, $mysqli->real_escape_string($idWarenkorb));

       $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                 $row = $result->fetch_array(MYSQLI_ASSOC);                                                                

                mysqli_free_result( $result );               

                return $row; 
}

function selectWarenkorb($mysqli)
{

      $query = sprintf("select idWarenkorb from Warenkorb where idVerkaeuferposition ='%s' " 
      					, $mysqli->real_escape_string($_POST['Post']));

       $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                 $row = $result->fetch_array(MYSQLI_ASSOC);                                                                

                mysqli_free_result( $result );               

                return $row; 
}


function updateVerkaeuferposition($mysqli, $idVerkaeuferposition,$Zeit)
{  

        $query = sprintf("UPDATE Verkaeuferposition SET  Verfuegbarkeitsstatus= '1' , Aenderungsdatum = '%s'  where idVerkaeuferposition = '%s' " , 
          
          $mysqli->real_escape_string($Zeit),
          $mysqli->real_escape_string($idVerkaeuferposition)  
                  
       ); 

          $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }
}


function deleteWarenAusWarenkorb($mysqli)
{

				       $query = sprintf("delete from Warenkorb where idWarenkorb = '%s'  and idBenutzer='%s'",

				       	$mysqli->real_escape_string($_POST['Post']), 
				       	$mysqli->real_escape_string($_SESSION['idBenutzer']) 
				       	);

				       echo $_POST['Post'];

				       $result = $mysqli->query($query);

				        if ( ! $result )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }
}

 function Verkaufsartikel(){

			if (isset($_POST['Post']))
			{

				  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

				   if ($mysqli->connect_error) {

			          echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

			      } 
			      else {

			       $ImWarenkorb  =  selectWarenkorb($mysqli);

				       if($ImWarenkorb != null)	
				       	{
				       		if(isset($_POST['LoeschenOK']))
				       		{
				       			if( $_POST['LoeschenOK'] == 'OK')
				       			{deleteWarenAusWarenkorb($mysqli);				       
				       			updateVerkaeuferposition($mysqli, $idVerkaeuferposition['idVerkaeuferposition'], $Zeit);
				       			}
				       			else
				       			{
				       				exit;
				       			}
				       		}	
				       		else{
				       			echo 'Alert: Der Artikel liegt bei einem Kunden im Warenkorb';
				       			exit;
				       			}	

				        }  

			      		//1. Zahlarten löschen
			      		//2. Verkaufsposition löschen
			      	// 3. Verkaufsbilder

			      		  $query = sprintf("delete from Kaufarten where idVerkaeuferposition = '%s'",

					       	$mysqli->real_escape_string($_POST['Post'])
					       	
					       	);  

			      		$result = $mysqli->query($query);

				        if ( ! $result )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }

				       

			      		   $query3 = sprintf("delete from verkaeuferbild where idVerkaeuferposition = '%s'",

					       	$mysqli->real_escape_string($_POST['Post'])
					       	
					       	);


				        $result3 = $mysqli->query($query3);

				        if ( ! $result3 )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }
				       // echo $_POST['Post'];


				        $query4 = sprintf("delete from Merken where idVerkaeuferposition= '%s'",

				       	$mysqli->real_escape_string($_POST['Post'])
				       	);

				       	$result4 = $mysqli->query($query4);

				         if ( ! $result3 )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }
				           

				       	//im Warenkorb eines Kunden
				       	//mit select prüfen ob der Artikel im Warenkorb eines Kunden vorhanden ist

				      


				       $query2 = sprintf("delete from verkaeuferposition  where idVerkaeuferposition = '%s'  and idBenutzer='%s'",

				       	$mysqli->real_escape_string($_POST['Post']), 
				       	$mysqli->real_escape_string($_SESSION['idBenutzer']) 
				       	);				      

				          $result2 = $mysqli->query($query2);

				       

				        if ( ! $result2 )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }


				       if($_POST['Kategorie'] == 'Kleidung')
				       {
				       		$query4 = sprintf("Select * from Artikel where Zeitstempel = '%s'", 
				       				$mysqli->real_escape_string($_POST['Zeitstempel'])  );

				       		 $result4 = $mysqli->query($query4);

					        if ( ! $result4 )
					        {
					             die('Ungültige Abfrage: ' . mysqli_error());
					        }

				       		 $rows = Array();


                             while ($row = $result4->fetch_array(MYSQLI_ASSOC))
                                    {
                                        $rows[] = $row;                                                         
                                    }
                                   


				       		$query6 = sprintf("delete from Kleidung  where idArtikel = '%s'  limit 1" ,
					       	$mysqli->real_escape_string($rows["0"]["idArtikel"])					       	 
					       );

				       		$result6 = $mysqli->query($query6);

				        if ( ! $result6 )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }

							var_dump($_POST['Zeitstempel'], $_POST['Zeitstempel']);

				       		$query5 = sprintf("delete from Artikel  where Zeitstempel = '%s' limit 1 ",
					       	$mysqli->real_escape_string($_POST["Zeitstempel"])
					       );


				          $result5 = $mysqli->query($query5);

				        if ( ! $result5 )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }


				       		     mysqli_free_result( $result4 );
				       			 
				       }
				       echo("it Works");
				        echo("it Works");


			       }// ende Else

			    mysqli_close($mysqli);
			    // window.document.location.href = "Buttons/Hilfsdokumente/WarenkorbKommunikation.php";

			   // header('Location: http://' . $_SERVER['HTTP_HOST'] . 'Final/Kategorien/MeineVerkaufsartikel.php');

			}
}

function Merken()
{
	echo $_POST['Post'];
	echo $_POST['Tabelle'];

	if (isset($_POST['Post']))
	{

				  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

				   if ($mysqli->connect_error) {

			          echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

			      	} 
			      else { 
			      	 $query = sprintf("delete from Merken where idMerken = '%s'  and idBenutzer= '%s'",

				       	$mysqli->real_escape_string($_POST['Post']), 
				       	$mysqli->real_escape_string($_SESSION['idBenutzer']) 
				       	);

				       $result = $mysqli->query($query);

				        if ( ! $result )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }

				      

			       }// ende Else

			    mysqli_close($mysqli);

	}// ende if

}

 function Watchlist(){

			if (isset($_POST['Post']))
			{

				  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

				   if ($mysqli->connect_error) {

			          echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

			      } 
			      else {  

				       $query = sprintf("delete from Watchlist where idWatchlist = '%s'  and idBenutzer='%s'",

				       	$mysqli->real_escape_string($_POST['Post']), 
				       	$mysqli->real_escape_string($_SESSION['idBenutzer']) 
				       	);

				       $result = $mysqli->query($query);

				        if ( ! $result )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }

				       

			       }// ende Else

			    mysqli_close($mysqli);


			}
}

function Adresse()
{
	//adresse auslesen
if (isset($_POST['Post']))
			{

				  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

				   if ($mysqli->connect_error) {

			          echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

						} // ende if 
			      else{

						AdresseLoeschen($mysqli);

						$idAdresse = $_POST['Post'];

						//durchsuche $Session Adresse nach der id 						

						$AdressPos = array_search($idAdresse, array_column($_SESSION['Adresse'], 'idAdresse'));			       
				   		

				   		unset($_SESSION['Adresse'][$AdressPos]);
			   				
			      		}// ende Else

			   			mysqli_close($mysqli);
			}
}



 function AdresseLoeschen($mysqli){

			if (isset($_POST['Post']))
			{				 

				       $query = sprintf("delete from adresse where idAdresse = '%s'  and idBenutzer='%s'",

				       	$mysqli->real_escape_string($_POST['Post']), 
				       	$mysqli->real_escape_string($_SESSION['idBenutzer']) 
				       	);

				       $result = $mysqli->query($query);

				        if ( ! $result )
				        {
				             die('Ungültige Abfrage: ' . mysqli_error());
				        }
			    
			}//ende if
		}


switch ($_POST['Tabelle']) {
	case 'Warenkorb':
		Warenkorb();
		break;

	case 'Verkaufsartikel':	
		Verkaufsartikel();
	break;

	case 'Watchlist':	
		Watchlist();
	break;

	case 'Merken':	
		Merken();
	break;

	case 'Adresse':

		Adresse();

	 	
		
	break;


	default:
		# code...
		break;
}



?>