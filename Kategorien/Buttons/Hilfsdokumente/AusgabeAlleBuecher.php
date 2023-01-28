<?php

Session_start();

// 1.Ausgabe Aller Artikel bei denen die Kategorie Buecher ist

//echo $_POST['Kategorie'];

$pos=strpos(__DIR__,'Final'); // suche im String nach Final

$rest = substr(__DIR__,0,$pos);


include $rest.'external_incl\my_incl.php';


$mysqli = @new mysqli($DBserver,$DBuser,$DBpassword,$DBname);

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } 
                   else 
                   {   
                      $Erg = Auswahl($mysqli);
                      $i = 0;

                     //var_dump($Erg );
                      foreach ($Erg as $key)
                      {
                       $ArtikelVorhanden =  SelectVerkaeuferposition($mysqli,$key['idArtikel']);

                       //var_dump($ArtikelVorhanden);

                               if($ArtikelVorhanden !=Null)
                               {                               
                                 $ArtikelListe[$i] = $key;

                                  if($_POST['Kategorie'] == 'Kleidungen')
                                      {
                                        // Kaufposition muss ermittelt werden
                                       $Kaufposition[$i] = Kaufposition($mysqli, $ArtikelVorhanden['0']['idVerkaeuferposition']);
                                       //
                                      }
                                 $i++;
                               }                                                               
                      }

                      $_SESSION['AlleBuecher'] = $ArtikelListe;

                      $_SESSION['Kaufposition'] = $Kaufposition;

                      //var_dump($_SESSION['AlleBuecher']);
                   }

                    mysqli_close($mysqli);



header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/Buttons/AlleBuecher.php');


function Kaufposition($mysqli, $idVerkaeuferposition)
{ 

  $query = sprintf("SELECT * FROM Kaufarten K                               
                    WHERE idVerkaeuferposition = '%s'",
                    $mysqli->real_escape_string($idVerkaeuferposition) 
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

                //var_dump($rows);            

                return $rows;                 
}


function SelectArtikelBuecher($mysqli)
{ 

  $query = sprintf("SELECT * FROM Artikel A RIGHT JOIN Buecher B
                               ON A.idArtikel = B.idArtikel
                             WHERE A.Kategorien = 'Buecher'"
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

                //var_dump($rows);            

                return $rows;                 
}


function SelectVerkaeuferposition($mysqli,$idArtikel)
 {

    $query = sprintf("select *  from Verkaeuferposition where idArtikel = '%s'" ,
                           $mysqli->real_escape_string($idArtikel)  
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

                return $rows;  
 }



function SelectArtikelKleidung($mysqli)
{ 

  $query = sprintf("SELECT * FROM Artikel A RIGHT JOIN Kleidung K
                                  ON A.idArtikel = K.idArtikel
                              WHERE A.Kategorien = 'Kleidung'"
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

                return $rows;                
}


 function Auswahl($mysqli)
 {
  $Erg = Array();
   

  if(isset($_POST['Kategorie']))
  {
      switch ($_POST['Kategorie']) 
      {
        case 'Buecher':

                $Erg = SelectArtikelBuecher($mysqli);
                return $Erg;
          # code...
          break;

        case 'Kleidungen':

              $Erg = SelectArtikelKleidung($mysqli);
              return $Erg;
          # code...
          break;
        
        default:
          # code...
          break;
      
      }
   }
 }



?>