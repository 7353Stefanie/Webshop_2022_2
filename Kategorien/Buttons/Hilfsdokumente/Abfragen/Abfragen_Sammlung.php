<?php



 class Abfragen
{
  public $row;
  public $result;
  public $rows = Array(); 
// Select#


  //gemerkte Artikel

  function inhaltVorhanden($rows)
                  {
                           if(isset($rows))
                               {
                                   return $rows; 
                                }
                                else{
                                  return null;
                                }  
                  }


  function VerkaufspositionsInfos($mysqli, $ArraygemerkterArtikel)
{
 $query = sprintf("select idVerkaeuferposition, idBenutzer, idArtikel, Zustand , Kauf, Tausch, Verfuegbarkeitsstatus from Verkaeuferposition where idVerkaeuferposition IN ('$ArraygemerkterArtikel')  "

                                                          
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


function Verkaufspositionsstatus($mysqli, $ArraygemerktArtikel)
{
 $query = sprintf("select idVerkaeuferposition, Verfuegbarkeitsstatus from Verkaeuferposition where idVerkaeuferposition IN ('$ArraygemerktArtikel')  "

                                                          
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


function liegtImWarenkorb($mysqli)
{
   $query = sprintf("select idVerkaeuferposition, idBenutzer from Warenkorb "

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

function selectMerken($mysqli, $idBenutzer)
{

      $query = sprintf("select * from Merken where idBenutzer = '%s' " ,                                                          
                                                          
                         $mysqli->real_escape_string($idBenutzer) ); 

                  $result = $mysqli->query($query);



                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                         

                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );  


               $Ausgabe =  $this->inhaltVorhanden($rows);

                  
               return $Ausgabe; 

                        

               
}




function selectAdresse_Zahlungsvorgang($mysqli)
{

      $query = sprintf("select idAdresse, ausgewaehlt from Adresse where ausgewaehlt NOT LIKE 0 "                 
                
              );

       $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }                 


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

function selectWarenkorbartikel($mysqli,$idBenutzer)
{

      $query = sprintf("select * from Warenkorb where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      

                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;                     
}

function Warenkorbinfos_Id($mysqli, $idBenutzer)
{

      $query =sprintf("SELECT   w.idVerkaeuferposition
                from Warenkorb w
               where w.idBenutzer = %s",
                
                $mysqli->real_escape_string($idBenutzer)

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

function Warenkorbinfos($mysqli, $idBenutzer)
{

      $query =sprintf("SELECT   w.idVerkaeuferposition, w.idBenutzer, idWarenkorb
                from Warenkorb w
               where w.idBenutzer = %s",
                
                $mysqli->real_escape_string($idBenutzer)

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



function selectKaufarten_by_idVerkaeuferposition_und_Kaufarten($mysqli, $idVerkaeuferposition, $Kaufarten) // Verwendet in Plausibilitätsprüfung
{

      $query = sprintf("select * from Kaufarten where idVerkaeuferposition = '%s' " ,
               $mysqli->real_escape_string($idVerkaeuferposition) ,
               $mysqli->real_escape_string($Kaufarten) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

        

                $row = $result->fetch_array(MYSQLI_ASSOC);
                                                      

                mysqli_free_result( $result );               

                return $row;                     
}

function selectZahlungsart_by_Benuzter($mysqli, $idBenutzer) // alle Zahlungsarten eines Benutzers
{

      $query = sprintf("select * from Zahlungsart where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
              );


            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

  while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;                    
}

function selectWarenkorbartikel_by_Benuzter($mysqli, $idBenutzer) // alle Warenkorbartikel eines Bentuzers
{

      $query = sprintf("select * from Warenkorb where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

       

                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;                     
}

function selectArtikel_by_ArtikelId($mysqli, $idArtikel ) // alle Artikel sortiert nach der Artikelid
{

      $query = sprintf("select * from artikel where idArtikel = '%s' ",
               $mysqli->real_escape_string($idArtikel) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}


function selectArtikel_by_ArtikelId_Array($mysqli, $idArtikel ) // alle Artikel sortiert nach der Artikelid
{

      $query = sprintf("select * from artikel where idArtikel IN ('$idArtikel') order by Kategorien "
               
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      

                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                    // var_dump($rows); 


             if(isset($rows))
             {
                 return $rows; 
              }
              else{
                return null;
              }  

                   
    }


function selectKategorie_by_Kategorie_und_ArtikelId($mysqli, $Kategorie, $idArtikel) // alle Artikel einer Kategorie und Artikelid
{

      $query = sprintf("select * from %s where idArtikel = '%s' ",

               $mysqli->real_escape_string($Kategorie),
               $mysqli->real_escape_string($idArtikel) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }
      
                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                    // var_dump($rows); 

                   return $rows;                    
}

function selectKategorie_by_Kategorie_und_ArtikelId_Array($mysqli, $Kategorie, $idArtikel) // alle Artikel einer Kategorie und Artikelid
{

      $query = sprintf("select * from %s where idArtikel IN ('$idArtikel') ",

               $mysqli->real_escape_string($Kategorie)
              );

            $result = $mysqli->query($query);
            $rows = Array();

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }
      
                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                    // var_dump($rows); 

                   return $rows;                   
}




 function selectKleidung($mysqli, $idArtikel)
 {
                    $query = sprintf("select * from  Kleidung k  where k.idArtikel = '%s'" ,
                           $mysqli->real_escape_string($idArtikel) 
                          ); 

                 $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                    // var_dump($rows); 

                   return $rows;
 }

  function selectKleidungArray($mysqli, $idArtikel)
 {
                 $rows = null;

                    $query = sprintf("select * from Kleidung a where idArtikel IN ('$idArtikel')" ,
                           $mysqli->real_escape_string($idArtikel) 
                          ); 

                 $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                    // var_dump($rows); 

                   return $rows;
 }


 function SelectWeitereArtikel($mysqli,$Kategorien, $Bezeichnung)
 { 

                    $query = sprintf("select * from Artikel where Kategorien = '%s' and Bezeichnung = '%s' " ,
                           $mysqli->real_escape_string($Kategorien) ,
                           $mysqli->real_escape_string($Bezeichnung) 
                          ); 

                 $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                     return $rows;
 }


  function SelectGemerkteArtikel($mysqli)
{

      $query = sprintf("select * from Merken"); 

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

function selectBenutzername($mysqli,$idBenutzer)
{

      $query = sprintf("select idBenutzer, Benutzername from Benutzer where idBenutzer IN ('$idBenutzer') ",
               $mysqli->real_escape_string($idBenutzer) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}


function selectBenutzer_Zahlungsvorgang($mysqli,$idBenutzer)
{

      $query = sprintf("select  idBenutzer, Benutzername, Vorname, EMail from Benutzer where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}

function SelectBenutzer_Name_Guthaben($mysqli,$idBenutzer)
 {
  $query = sprintf("select idBenutzer,Benutzername, Guthaben from Benutzer where idBenutzer = '%s'" ,
                           $mysqli->real_escape_string($idBenutzer)  
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

               


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;  

 }

 function SelectBenutzer_Name($mysqli,$idBenutzer)
 {
  $query = sprintf("select Benutzername from Benutzer where idBenutzer = '%s'" ,
                           $mysqli->real_escape_string($idBenutzer)  
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

               


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;  

 }


function selectBenutzer_Guthaben($mysqli,$idBenutzer)
{

      $query = sprintf("select  idBenutzer, Guthaben from Benutzer where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;                     
}

 
  function buecher_und_Artikel_by_idArtikel($idArtikel)
 {
                    $query = sprintf("select * from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and a.idArtikel = '%s'" ,
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

                    // var_dump($rows); 

                   return $rows;
 }


function selectVerkaeuferposition_Zahlungsvorgang($mysqli,$idVerkaeuferposition )
{

  $query = sprintf("select idArtikel, idBenutzer, Zustand, Artikelbeschreibung from Verkaeuferposition where idVerkaeuferposition = '%s' ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row; 

}

 function SelectVerkaeuferposition_byArtikel($mysqli,$idArtikel)
 {

    $query = sprintf("select *  from Verkaeuferposition where idArtikel = '%s'" ,
                           $mysqli->real_escape_string($idArtikel)  
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

             


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;  
 }

  function SelectVerkaeuferposition_byArtikel_outIdVerkaeuferposition_Verfuegbarkeitsstatus01($mysqli,$idArtikel) //Gib alle idVerkaeuferposition und Verfuegbarkeitsstatus 1 und 0 aus, von der Liste idArtikel
 {

    $query = sprintf("select idVerkaeuferposition, Verfuegbarkeitsstatus,idArtikel from Verkaeuferposition where Verfuegbarkeitsstatus = '1' and idArtikel IN ('$idArtikel')" ,
                           $mysqli->real_escape_string($idArtikel)  
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

             


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;  
 }


  function SelectVerkaufsbilder($mysqli,$idVerkaeuferposition)
 {

    $query = sprintf("select * from Verkaeuferbild where idVerkaeuferposition = '%s'" ,
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

                return $rows;  
 }

 function Artikelinformationen_byidBenutzer_sort_idVk($mysqli, $idBenutzer)
{

    $query = sprintf("Select * from Verkaeuferposition v where idBenutzer = '%s' group by v.idVerkaeuferposition",
                                                            
    $mysqli->real_escape_string($idBenutzer));
  
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


function selectVerkaeuferposition_idArtikel($mysqli,$idVerkaeuferposition)
{

  $query = sprintf("select idArtikel from Verkaeuferposition where idVerkaeuferposition = '%s' ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
              $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row; 

}

function Kaufinfos_Array($mysqli, $idVerkaeuferposition)
{
     // var_dump($idVerkaeuferposition);
      

      $query = sprintf("SELECT  Preis, Zustand, Verkaufsmenge,  Kaufarten, v.idVerkaeuferposition, idArtikel, Kauf, Tausch, Verfuegbarkeitsstatus
                         from    Kaufarten k, Verkaeuferposition v
                         where  v.idVerkaeuferposition = k.idVerkaeuferposition 
                         and    v.idVerkaeuferposition IN ('$idVerkaeuferposition')
                         Group by v.idVerkaeuferposition, Kaufarten " 

                         ); 

//(' . implode(' . implode(',', array_map('intval', %s)) . ')
                    $rows = Array();

                            $result = $mysqli->query($query);     

                    if ( !  $result )
                       {
                         die('Ungültige Abfrage: ' . mysqli_error());
                       }
             

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

                


                  while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                            $rows[] = $row;  
                     }                                                   

                  mysqli_free_result( $result );               

                  return $rows; 
}



function selectKaufarten_by_idVerkaeuferposition($mysqli,$idVerkaeuferposition )// Alle Artikel von Kaufarten nach id Verkäuferposition
{

      $query = sprintf("select * from Kaufarten where idVerkaeuferposition = '%s' ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

        
                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
             while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                            $rows[] = $row;  
                     }                                                   

                  mysqli_free_result( $result );               

                  return $rows;                 
}

function selectKaufarten_by_idVerkaeuferposition_Array($mysqli,$idVerkaeuferposition )// Alle Artikel von Kaufarten nach id Verkäuferposition
{

      $query = sprintf("select * from Kaufarten where idVerkaeuferposition in ('$idVerkaeuferposition') ",
               $mysqli->real_escape_string($idVerkaeuferposition) 
              );

            $result = $mysqli->query($query);

        
                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
             while ($row = $result->fetch_array(MYSQLI_ASSOC))
                     {
                            $rows[] = $row;  
                     }                                                   

                  mysqli_free_result( $result );  


    if(isset($rows))
             {

                 return $rows; 
              }
              else{
                return null;
              }                  
}


function selectKaufarten_by_idKaufarten($mysqli,$idKaufarten)// Alle Artikel von Kaufarten nach id Verkäuferposition
{

      $query = sprintf("select * from Kaufarten where idKaufarten = '%s' ",
               $mysqli->real_escape_string($idKaufarten) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

      
           

                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;                    
}



function sucheAlleArtikelEinerKategorie($mysqli, $Kategorie)
{// ändern

   $query = sprintf("Select * from Verkaeuferposition v, Artikel a where v.idArtikel= a.idArtikel and Verfuegbarkeitsstatus = '0' and Kategorien = '%s' Group by a.idArtikel",
                   $mysqli->real_escape_string($Kategorie) 
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


function selectBestellpostion_by_Benutzerid($mysqli,$idBenutzer)// Alle Artikel von Kaufarten nach id Verkäuferposition
{

      $query = sprintf("select * from Bestellposition where idBenutzer = '%s' ",
               $mysqli->real_escape_string($idBenutzer) 
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


function selectBuecher_byArtikelid($mysqli, $idArtikel)
{

    $query = sprintf("select * from Buecher where idArtikel = '%s' ",
               $mysqli->real_escape_string($idArtikel) 
              );

            $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

       $row = $result->fetch_array(MYSQLI_ASSOC);

                mysqli_free_result( $result );               

                return $row;  

}

function selectBuecher_byArtikelid_Liste($mysqli, $idArtikel)
{

    $query = sprintf("select * from Buecher where idArtikel IN ('$idArtikel')  ",
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

                   $Ausgabe =  $this->inhaltVorhanden($rows); 
                   
 //var_dump($rows);
                   return $Ausgabe; 

}


//SUCHE

function selectAlleArtikel_nur_Buecher($mysqli, $Suche)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And
                                    Verfuegbarkeitsstatus = 1
                                    and Kategorien = 'Buecher'
                                    and Bezeichnung like '%s' Group by Bezeichnung order by Kategorien"
                                      ,
                           $mysqli->real_escape_string('%'.$Suche.'%')  ); 

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

function selectAlleArtikel_nur_Kleidung($mysqli, $Suche)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And
                                    Verfuegbarkeitsstatus = 1
                                    and Kategorien = 'Kleidung'
                                    and Bezeichnung like '%s' Group by Bezeichnung order by Kategorien"
                                      ,
                           $mysqli->real_escape_string('%'.$Suche.'%')  ); 

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

 function selectAlleArtikel($mysqli, $Suche)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And
                                    Verfuegbarkeitsstatus = 1 
                                    and Bezeichnung like '%s' Group by Bezeichnung order by Kategorien"
                                      ,
                           $mysqli->real_escape_string('%'.$Suche.'%')  ); 

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

 function selectAlleBuecher_Alle($mysqli)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And Kategorien = 'Buecher'
                                    and Verfuegbarkeitsstatus = 1 Group by Bezeichnung ");
                            

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

 function selectAlleKleidung_Alle($mysqli)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And Kategorien = 'Kleidung'
                                    and Verfuegbarkeitsstatus = 1 Group by Bezeichnung ");
                            

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


 function selectAlleArtikel_Alle($mysqli)
 {
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And
                                    Verfuegbarkeitsstatus = 1 Group by Bezeichnung ");
                            

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

  function selectAlleArtikel_Alle_Liste($mysqli, $idArtikel)
 {
                    $query = sprintf("select * from Artikel  where idArtikel IN ('$idArtikel') ");
                            

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


 function selectKleidung_Suche($mysqli, $Suche)
 {
                     $query = sprintf("select * from Artikel a, Kleidung k where a.idArtikel = k.idArtikel and 
                                       (Marke like '%s'                                    
                                      or Geschlecht like '%s'  )",

                           $mysqli->real_escape_string('%'. $Suche. '%') ,
                           $mysqli->real_escape_string('%'.$Suche. '%')
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

  function selectKategorie($mysqli,  $Suche, $Tabelle)
 {
                    $query = sprintf("select * from Artikel a, %s k  where a.idArtikel = k.idArtikel and 
                                       
                                     Bezeichnung like '%s' 
                                     ",
                           $mysqli->real_escape_string($Tabelle) ,
                           $mysqli->real_escape_string('%'.$Suche. '%')
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

 function selectKategoriealle($mysqli, $Tabelle)
 {
                    $query = sprintf("select * from Artikel a, %s k  where a.idArtikel = k.idArtikel Group by Bezeichnung
                                     ",
                           $mysqli->real_escape_string($Tabelle) 
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

 
/*
 function selectBuecher_SucheAllg($mysqli)
 {
                     $query = sprintf("select a.idArtikel, Kategorien , Titelbild, Bezeichnung, Zeitstempel from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and 
                                       (ISBN like '%s' or Autor like'%s' or Bezeichnung like '%s' ) ",
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
 }*/

  function selectBuecher_AllgemeineSuche($mysqli, $Suche)
 {
                     $query = sprintf("select a.idArtikel, Kategorien , Titelbild, Bezeichnung, Zeitstempel from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and 
                                       (ISBN like '%s' or Autor like'%s' or Bezeichnung like '%s'  Group by Bezeichnung ) ",
                           $mysqli->real_escape_string('%'. $Suche . '%') ,
                           $mysqli->real_escape_string('%'. $Suche. '%'),
                           $mysqli->real_escape_string('%'. $Suche .'%')
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


 function selectBuecher($mysqli, $Suche)
 {
                    $query = sprintf("select * from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and 
                                       (ISBN like '%s'                                    
                                      or Autor like'%s' 
                                      or Bezeichnung like '%s' )
                                     ",
                           $mysqli->real_escape_string('%'. $Suche . '%') ,
                           $mysqli->real_escape_string('%'.$Suche. '%'),
                           $mysqli->real_escape_string('%'.$Suche.'%')
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

  function selectAlleArtikelFinal($mysqli)
 {
                    $query = sprintf("Select a.idArtikel, Bezeichnung, Kategorien, Titelbild from Artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
                                    And
                                    Verfuegbarkeitsstatus = 1
                                    Group by a.idArtikel");



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







// update

 function updateWarenkorbButton($mysqli, $idVerkaeuferposition, $Zahlungsart)
{
   
            $query = sprintf("UPDATE Warenkorb SET  Kaufart= '%s'  where idVerkaeuferposition = '%s' " , 
              
              $mysqli->real_escape_string($Zahlungsart),
              $mysqli->real_escape_string($idVerkaeuferposition)
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}


function  updateGuthaben_Plausibilitaet($mysqli, $idBenutzer, $Guthaben) // derzeitige Benutzereid notwenidg
{
   $query = sprintf("UPDATE benutzer SET  Guthaben = '%s'  where idBenutzer = '%s' " , 
              
              $mysqli->real_escape_string($Guthaben),
              $mysqli->real_escape_string($idBenutzer)  
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }   

}

function  upadteAdresse_Zahlungsvorgang($mysqli, $numbers, $letters)
{

            $query = sprintf("UPDATE Adresse SET  ausgewaehlt= '%s'  where idAdresse = '%s' " , 
              
              $mysqli->real_escape_string($letters),
              $mysqli->real_escape_string($numbers)  
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  upadteVerkaeuferposition_Zahlungsvorgang($mysqli, $idVerkaeuferposition)
{

            $query = sprintf("UPDATE Verkaeuferposition SET  Verfuegbarkeitsstatus= '2'  where idVerkaeuferposition = '%s' " , 
              
              $mysqli->real_escape_string($idVerkaeuferposition)
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  updateZahlungsart($mysqli,$Zahlungsart, $idBenutzer)
{

            $query = sprintf("UPDATE Zahlungsart SET Zahlungsart = '%s'  where idBenutzer = '%s' " , 
              
              $mysqli->real_escape_string($Zahlungsart),  
              $mysqli->real_escape_string($idBenutzer)
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  updateVerkaeuferposition($mysqli,$Preis, $idVerkaeuferposition)
{

            $query = sprintf("UPDATE verkaeuferposition SET gekauftZumPreisVon = '%s'  where idVerkaeuferposition = '%s' " , 
              
              $mysqli->real_escape_string($Preis),  
              $mysqli->real_escape_string($idVerkaeuferposition)
                      
           ); 

                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}


// insert

function  insertBestellposition($mysqli,$Zeit, $idBenutzer, $idVerkaeuferposition, $idKaufarten) // verwendet in Zahlungsborgang unf Plausibilität
{

            $query = sprintf("INSERT INTO Bestellposition ( Bestelldatum, Bestellstatus, idBenutzer, idVerkaeuferposition, idKaufarten ) 
                      VALUES ('%s', 0, '%s', '%s', '%s') " ,              
            
            $mysqli->real_escape_string($Zeit),    
            $mysqli->real_escape_string($idBenutzer),
            $mysqli->real_escape_string($idVerkaeuferposition),   
            $mysqli->real_escape_string($idKaufarten)      
           ); 
                $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}



//delete


function  deleteWarenkorbartikel($mysqli, $idBenutzer)
{

		        $query = sprintf("DELETE FROM Warenkorb where idBenutzer = '%s'  " ,          
		        
		          
		        $mysqli->real_escape_string($idBenutzer)
		                 
		       ); 
          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}


}//ende class




?>