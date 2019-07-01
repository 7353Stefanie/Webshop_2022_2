<?php

 session_start();
 $date = getdate();

 $_SESSION['gemerkteArtikel'] = "";
 $_SESSION['gemerkteArtikelInfos'] = "";

	  $Zeit =  (date('Y-m-d').' '. $date['hours'].':'.$date['minutes'].':'.$date['seconds']);
	  var_dump($Zeit . "Zeit");
// gemerkte Artikel 
// ausgabe aller gemerkten Artikel von Benutzer mit der ID XX

	  $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
					
                   }
                    else 
                   { 
                   		$gemerkteArtikel = selectMerken($mysqli);

                   		$AnzahlGemerkteartikel =  count($gemerkteArtikel);   

                      $imWarenkorb = liegtImWarenkorb($mysqli) ;

                    //  var_dump($imWarenkorb);   

                      
                      
                       for($i = 0; $i< $AnzahlGemerkteartikel; $i++)
                         {  

                           $Warenkorbinformation = array_search( $gemerkteArtikel[$i]['idVerkaeuferposition'], array_column($imWarenkorb, 'idVerkaeuferposition'));

                           $Warenkorbinformation =   $imWarenkorb[$Warenkorbinformation] ;                        

                            $Kaufinfos = Kaufinfos($mysqli, $gemerkteArtikel[$i]['idVerkaeuferposition']);
                            //var_dump($Kaufinfos);               

                            $Artikelinfos = Artikel($mysqli, $Kaufinfos['0']['idArtikel']);
                            //var_dump($Artikelinfos);

                            $KategorieInfos = Kategorie($mysqli,  $Artikelinfos['0']['Kategorien'], $Artikelinfos['0']['idArtikel']) ;   
                            //var_dump($KategorieInfos);  

                            $Sammlung[$i] = array_merge( $Kaufinfos ,$Artikelinfos ,$KategorieInfos, $Warenkorbinformation);             

                         }// ende for
                         //var_dump( $Warenkorbinformation);


                         $_SESSION['gemerkteArtikel'] = $gemerkteArtikel;
                         $_SESSION['gemerkteArtikelInfos'] = $Sammlung;    
                         //var_dump($Sammlung);               
                 

                     header('Location: http://' . $_SERVER['HTTP_HOST'] . '/Final/Kategorien/gemerkteArtikel.php');                   	

                   		mysqli_close($mysqli);
                   		#var_dump( $gemerkteArtikel);

                   }

function Artikel($mysqli, $idArtikel)
{
                   $query = sprintf("SELECT  idArtikel, Kategorien, Bezeichnung, Artikelbild
                                     from     Artikel a
                                     where  idArtikel = '%s'",                                                         
                                                           
                                     $mysqli->real_escape_string($idArtikel) 

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

function Kategorie($mysqli,  $Kategorie, $idArtikel)
{
   
     $query =sprintf("SELECT   *
                from %s
                where idArtikel = '%s'",
                
                $mysqli->real_escape_string($Kategorie),
                $mysqli->real_escape_string($idArtikel)
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

function Kaufinfos($mysqli, $idVerkaeuferposition)
{
      $query = sprintf("SELECT  Preis, Zustand, Verkaufsmenge,  Kaufarten, v.idVerkaeuferposition, idArtikel, Kauf, Tausch, Verfuegbarkeitsstatus
                         from    Kaufarten k, Verkaeuferposition v
                         where  v.idVerkaeuferposition = k.idVerkaeuferposition 
                         and    v.idVerkaeuferposition = '%s'
                         Group by v.idVerkaeuferposition, Kaufarten",                                                         
                                                          
                         $mysqli->real_escape_string($idVerkaeuferposition) 

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

function selectMerken($mysqli)
{

      $query = sprintf("select * from Merken where idBenutzer = '%s' " , $mysqli->real_escape_string($_SESSION['idBenutzer'] )); 

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

function liegtImWarenkorb($mysqli)
{
   $query = sprintf("select idVerkaeuferposition, idBenutzer from Warenkorb  "  ); 

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


?>