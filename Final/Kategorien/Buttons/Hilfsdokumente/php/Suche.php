

<?php
namespace php;


 session_start();

 class Suche {

   function __construct() {
      
   }

 function suche()
 { 
                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                    $ErgebnisidArtikel = switchIt($mysqli);                   
               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 }



 function selectBuecher($mysqli)
 {
                     $query = sprintf("select * from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and 
                                       (ISBN like '%s'                                    
                                      or Autor like'%s' 
                                      or Bezeichnung like '%s' )
                                     ",
                           $mysqli->real_escape_string('%'. $_POST['suchen'] . '%') ,
                           $mysqli->real_escape_string('%'.$_POST['suchen']. '%'),
                           $mysqli->real_escape_string('%'.$_POST['suchen'] .'%')
                          );


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

                        // var_dump($rows); 

                   return $rows;
 }

  function selectAlle($mysqli)
 {
                    $query = sprintf("select * from Artikel where Bezeichnung like '%s' limit 10"
                                      ,
                           $mysqli->real_escape_string('%'.$_POST['suchen'].'%')  ); 

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
                   
 //var_dump($rows);
                   return $rows;
 }

 function switchIt($mysqli)
 {

  if(isset($_POST['Kategorie']))
  {

 switch ($_POST['Kategorie']) {
   case 'Buecher':
              $Erg = selectBuecher($mysqli);

              return($Erg);
     break;

 case 'Alle':

              $Erg = selectAlle($mysqli);

              return($Erg);
     # code...
     break;

  case 'Kleidung':
     # code...
     break;

    case 'Fahrzeug':
     # code...
     break;
     case 'Spielzeug':
     # code...
     break;
     case 'freizeit+sport':
     # code...
     break;
     case 'sonstiges':
     # code...
     break;
     case 'haushaltundgarten':
     # code...
     break;
   
   default:
     # code...
     break;
 }
}
}


}
  ?>