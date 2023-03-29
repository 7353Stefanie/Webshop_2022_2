<?php



// sofort kauf  

// 1. update Table Verkaeuferpostion column Verfuegbarkeitsstatus =0   // auf nicht mehr verfügbar setzen
// 2. Weiterleitung zum Direktkauf --> Übersicht des Produktes mit allen Informationen --> klick zum sofortkauf

// in den Warenkorb

// 1. update Table Verkaeuferpostion column Verfuegbarkeitsstatus =0   // auf nicht mehr verfügbar setzen // Zeitlich begrenzen
// 2. insert into Warenkorb (idWarenkorb, idBenutzer(Käufer),idVerkaeuferposition, Menge)
// 3. Nachricht --> Der Artikel wurde zu Ihrem Warenkorb hinzugefügt

// Merken

//1.  insert into Merken(idMerken, idBenutzer(Käufer),idVerkaeuferposition)

// wenn ein Artikel zum Merken angeklickt wurde wird überprüft ob es diese ArtikelNr schon in der Tabelle Merken gibt, wenn nicht wird der Artikel hinzugefügt Wenn es den Artikel schon gibt wird dieser gelöscht;
//Session true wenn 

Session_start();

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



include $rest.'/external_incl/my_incl.php';


$Aktion =  $_POST['Aktion'];





switch($Aktion) {

	case 'sofortKauf':
		# code...
		break;

	case 'Merken':
	Merken();
		# code...
		break;		

	case 'Einkaufswagen':
		Warenkorb();
		# code...
		break;
	
	default:
		# code...
		break;
}

function Warenkorb()
{
	 $date = getdate();

	  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
	  var_dump($Zeit . "Zeit");


	$mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else { 

                   	 $idVerkaeuferposition = 	$_POST['idVerkaeuferposition'];

                     $Verfuegbarkeitsstatus =  selectVerkaeuferposition($mysqli, $idVerkaeuferposition);

                     // var_dump($Verfuegbarkeitsstatus)  ;

                     if($Verfuegbarkeitsstatus['Verfuegbarkeitsstatus'] != 0)
                     { //	var_dump($idVerkaeuferposition)  ;
                   	 	// Verfuegbarkeitsstatus auf 0 ändern
                       	 $updateVerkaeuferposition = updateVerkaeuferposition($mysqli, $idVerkaeuferposition, $Zeit);

                       	// 2. insert into Warenkorb
                       	 $SelectWarenkorb = SelectWarenkorb($mysqli, $idVerkaeuferposition);

                       	 $AnzahlWarenkorb = count($SelectWarenkorb);
                       	 $u = '1';

                           	 for($i = 0; $i < $AnzahlWarenkorb; $i++ )
                           	 {
                           	 	if($SelectWarenkorb[$i]['idVerkaeuferposition'] == $idVerkaeuferposition )  // liest die Verkäuferpositionen im Warenkorb
                           	 	{
                           	 		$u = $u+1;                   	 		
                           	 	}                   	 	
                           	 }
                           	 
                           	 if($u == '1')
                           	 {// echo 'hier';
                           	 	$insertWarenkorb = insertWarenkorbeintrag($mysqli, $idVerkaeuferposition);
                           	 }
                      } // ende if
                    
                       
                      /* $Artikel =  selectVerkaeuferposition($mysqli, $idVerkaeuferposition);
                       
                       var_dump($Artikel);
                       var_dump($Artikel['idArtikel']);

                        echo "  
                                <br>
                                 <form action='/Final/Kategorien/Buttons/SucheUndAnzeige.php' method=post >
                                 
                                   <button  type='submit' name='idArtikel' id='dateForm' value='" .$Artikel['idArtikel']."'></button>;

                                 </form>
                                 

                                <script type='text/javascript'>                                
                                  $('#dateForm').submit();
                                </script>
                              ";      

                      //   header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/SucheUndAnzeige.php');
                      } */

                   	}   

                 mysqli_close($mysqli);

}



function Merken()
{
   $date = getdate();

    $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
    var_dump($Zeit . "Zeit");

	
	$mysqli = @new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {  

                   $idVerkaeuferposition = 	$_POST['idVerkaeuferposition'];

					$selectMerken = selectMerken($mysqli, $idVerkaeuferposition ); // sucht die id von Post

					//var_dump($selectMerken);

					if($selectMerken != null)
					{

						$deleteMerken = DeleteidVerkaeuferposition($mysqli, $idVerkaeuferposition);
					}
					else
					{
						$insertMerken = InsertidVerkaeuferposition($mysqli, $idVerkaeuferposition,$Zeit);
					}

					$selectAlleMerken = selectAlleMerken($mysqli, $idVerkaeuferposition);

					session_start();

					$_SESSION['gemerkteArtikel'] = $selectAlleMerken;

					var_dump($_SESSION['gemerkteArtikel']);
				}

       mysqli_close($mysqli);
}

function  SelectWarenkorb($mysqli, $idVerkaeuferposition)
{

	 $query = sprintf("select idVerkaeuferposition from Warenkorb " ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
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


function insertWarenkorbeintrag($mysqli, $idVerkaeuferposition)
{
		 $idBenutzer = selectVerkaeuferposition($mysqli, $idVerkaeuferposition);

	      $query = sprintf("insert into Warenkorb (idBenutzer, idVerkaeuferposition, Kaufmenge,Kaufart) VALUES ('%s', '%s', 1, 0) " , 
	 							 $mysqli->real_escape_string($_SESSION['idBenutzer']),
	 							 $mysqli->real_escape_string($idVerkaeuferposition)); 


              $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

}

function updateVerkaeuferposition($mysqli, $idVerkaeuferposition, $Zeit)
{
	

	      $query = sprintf("UPDATE Verkaeuferposition SET  Verfuegbarkeitsstatus= '0' , Aenderungsdatum = '%s'  where idVerkaeuferposition = '%s' " , 
	      	
	      	$mysqli->real_escape_string($Zeit),
	      	$mysqli->real_escape_string($idVerkaeuferposition)	
	      	       	
	     ); 

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

}

function selectMerken($mysqli, $idVerkaeuferposition)
{

      $query = sprintf("select * from Merken where idVerkaeuferposition ='%s' " , $mysqli->real_escape_string($idVerkaeuferposition) ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
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

function selectAlleMerken($mysqli)
{
	      $query = sprintf("select * from Merken " ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
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

function DeleteidVerkaeuferposition($mysqli, $idVerkaeuferposition)
{

      $query = sprintf("delete from Merken where idVerkaeuferposition ='%s' " , $mysqli->real_escape_string($idVerkaeuferposition)); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

}

function InsertidVerkaeuferposition($mysqli, $idVerkaeuferposition, $Zeit)
{


	 $query = sprintf("insert into Merken (idBenutzer, idVerkaeuferposition,Erstellungsdatum) 
	 	VALUES ('%s', '%s', '%s') " , $mysqli->real_escape_string($_SESSION['idBenutzer']),
	 							 $mysqli->real_escape_string($idVerkaeuferposition),
                 $mysqli->real_escape_string($Zeit)); 


                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }
}

function selectVerkaeuferposition($mysqli, $idVerkaeuferposition)
{

      $query = sprintf("select idBenutzer, idArtikel, Verfuegbarkeitsstatus from Verkaeuferposition where idVerkaeuferposition ='%s' " 
      					, $mysqli->real_escape_string($idVerkaeuferposition) ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                 $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row; 
}

?>