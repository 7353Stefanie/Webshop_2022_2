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
 $query = sprintf("select idVerkaeuferposition, idBenutzer, idArtikel, Zustand , Kauf, Tausch, Verfuegbarkeitsstatus from verkaeuferposition where idVerkaeuferposition IN ('$ArraygemerkterArtikel')  "

                                                          
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
 $query = sprintf("select idVerkaeuferposition, Verfuegbarkeitsstatus from verkaeuferposition where idVerkaeuferposition IN ('$ArraygemerktArtikel')  "

                                                          
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
   $query = sprintf("select idVerkaeuferposition, idBenutzer from warenkorb "

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

      $query = sprintf("select * from merken where idBenutzer = '%s' " ,                                                          
                                                          
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

      $query = sprintf("select idAdresse, ausgewaehlt from adresse where ausgewaehlt NOT LIKE 0 "                 
                
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
                from warenkorb w
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
                from warenkorb w
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

      $query = sprintf("select * from zahlungsart where idBenutzer = '%s' ",
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

      $query = sprintf("select * from warenkorb where idBenutzer = '%s' ",
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

      $query = sprintf("select * from artikel where idArtikel IN ('$idArtikel') order by kategorien "
               
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
                    $query = sprintf("select * from  kleidung k  where k.idArtikel = '%s'" ,
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

                    $query = sprintf("select * from kleidung a where idArtikel IN ('$idArtikel')" ,
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

                    $query = sprintf("select * from artikel where Kategorien = '%s' and Bezeichnung = '%s' " ,
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

      $query = sprintf("select * from merken"); 

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

      $query = sprintf("select idBenutzer, Benutzername from benutzer where idBenutzer IN ('$idBenutzer') ",
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

      $query = sprintf("select  idBenutzer, Benutzername, Vorname, EMail from benutzer where idBenutzer = '%s' ",
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

function SelectBenutzer_Bentuzer($mysqli,$benutzername)
{

         $query = sprintf(" SELECT benutzername, idBenutzer FROM benutzer WHERE  benutzername = '%s'",
                    $mysqli->real_escape_string($benutzername)   
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





function SelectBenutzer_Name_Guthaben($mysqli,$idBenutzer)
 {
  $query = sprintf("select idBenutzer,Benutzername, Guthaben from benutzer where idBenutzer = '%s'" ,
                           $mysqli->real_escape_string($idBenutzer)  
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                 $rows[]  = "";


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                mysqli_free_result( $result );               

                return $rows;  

 }

 function SelectBenutzer_Name($mysqli,$idBenutzer)
 {
  $query = sprintf("select Benutzername from benutzer where idBenutzer = '%s'" ,
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

      $query = sprintf("select  idBenutzer, Guthaben from benutzer where idBenutzer = '%s' ",
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
                    $query = sprintf("select * from artikel a, buecher b  where a.idArtikel = b.idArtikel and a.idArtikel = '%s'" ,
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

  $query = sprintf("select idArtikel, idBenutzer, Zustand, Artikelbeschreibung from verkaeuferposition where idVerkaeuferposition = '%s' ",
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

    $query = sprintf("select *  from verkaeuferposition where idArtikel = '%s'" ,
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

    $query = sprintf("select idVerkaeuferposition, Verfuegbarkeitsstatus,idArtikel from verkaeuferposition where Verfuegbarkeitsstatus = '1' and idArtikel IN ('$idArtikel')" ,
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

    $query = sprintf("select * from verkaeuferbild where idVerkaeuferposition = '%s'" ,
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

    $query = sprintf("Select * from verkaeuferposition v where idBenutzer = '%s' group by v.idVerkaeuferposition",
                                                            
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

  $query = sprintf("select idArtikel from verkaeuferposition where idVerkaeuferposition = '%s' ",
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
                         from    kaufarten k, verkaeuferposition v
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
                         from    kaufarten k, verkaeuferposition v
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

      $query = sprintf("select * from kaufarten where idVerkaeuferposition = '%s' ",
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

      $query = sprintf("select * from kaufarten where idVerkaeuferposition in ('$idVerkaeuferposition') ",
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

      $query = sprintf("select * from kaufarten where idKaufarten = '%s' ",
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

   $query = sprintf("Select * from verkaeuferposition v, artikel a where v.idArtikel= a.idArtikel and Verfuegbarkeitsstatus = '0' and Kategorien = '%s' Group by a.idArtikel",
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

function alle_Artikel_einer_Kategorie($mysqli,$Buch)
{
     $query = sprintf("select Kategorien from artikel where idArtikel = '%s'" ,

                           $mysqli->real_escape_string($Buch) 
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

      $query = sprintf("select * from bestellposition where idBenutzer = '%s' ",
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

    $query = sprintf("select * from buecher where idArtikel = '%s' ",
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

    $query = sprintf("select * from buecher where idArtikel IN ('$idArtikel')  ",
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select a.idArtikel, Bezeichnung, Kategorien, Titelbild  from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
                    $query = sprintf("select * from artikel  where idArtikel IN ('$idArtikel') ");
                            

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
                     $query = sprintf("select * from artikel a, kleidung k where a.idArtikel = k.idArtikel and 
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
                    $query = sprintf("select * from artikel a, %s k  where a.idArtikel = k.idArtikel and 
                                       
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
                    $query = sprintf("select * from artikel a, %s k  where a.idArtikel = k.idArtikel Group by Bezeichnung
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
                     $query = sprintf("select a.idArtikel, Kategorien , Titelbild, Bezeichnung, Zeitstempel from artikel a, buecher b  where a.idArtikel = b.idArtikel and 
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
                    $query = sprintf("select * from artikel a, buecher b  where a.idArtikel = b.idArtikel and 
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
                    $query = sprintf("Select a.idArtikel, Bezeichnung, Kategorien, Titelbild from artikel a,  verkaeuferposition v  where a.idArtikel  = v.idArtikel
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
   
            $query = sprintf("UPDATE warenkorb SET  Kaufart= '%s'  where idVerkaeuferposition = '%s' " , 
              
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

            $query = sprintf("UPDATE adresse SET  ausgewaehlt= '%s'  where idAdresse = '%s' " , 
              
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

            $query = sprintf("UPDATE verkaeuferposition SET  Verfuegbarkeitsstatus= '2'  where idVerkaeuferposition = '%s' " , 
              
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

            $query = sprintf("UPDATE zahlungsart SET Zahlungsart = '%s'  where idBenutzer = '%s' " , 
              
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

function  insertRegistrierung($mysqli,$Benutzername,$Vorname, $Nachname, $EMail, $Passwort) // verwendet in Zahlungsborgang unf Plausibilität
{

$query = sprintf("INSERT INTO benutzer (Benutzername, Vorname, Nachname, EMail ,Passwort)
                            VALUES ('%s', '%s', '%s', '%s', '%s')",
                                $mysqli->real_escape_string($Benutzername),
                                $mysqli->real_escape_string($Vorname),
                                $mysqli->real_escape_string($Nachname),
                                $mysqli->real_escape_string($EMail),
                                $mysqli->real_escape_string($Passwort)
                            );
  $result = $mysqli->query($query);

                 if ($mysqli->affected_rows == 1) 
                {$result == true;
                }
                else
                {
                   $result == false;
                }  
                return $result;
}


function  insertBestellposition($mysqli,$Zeit, $idBenutzer, $idVerkaeuferposition, $idKaufarten) // verwendet in Zahlungsborgang unf Plausibilität
{

            $query = sprintf("INSERT INTO bestellposition ( Bestelldatum, Bestellstatus, idBenutzer, idVerkaeuferposition, idKaufarten ) 
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

		        $query = sprintf("DELETE FROM warenkorb where idBenutzer = '%s'  " ,          
		        
		          
		        $mysqli->real_escape_string($idBenutzer)
		                 
		       ); 
          			$result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }            
}

function  adresseHinzufiügen($mysqli, $idBenutzer, $Ort,  $Bundesland , $Strasse, $Postleitzahl,  $Land, $Vorname,$Nachname, $Hausnummer)
{

       

                 //alle zahlungsmittel von Benutzerid x holen
                                                           
               $query = sprintf("INSERT INTO adresse ( Ort,  Bundesland , Strasse, Postleitzahl, idBenutzer,  Land, Vorname,Nachname, Hausnummer)
                   VALUES ('%s','', '%s', '%s', '%s','%s', '%s','%s','%s') ",   

                    $mysqli->real_escape_string($Ort),
                    $mysqli->real_escape_string($Strasse),
                    $mysqli->real_escape_string($Postleitzahl),
                    $mysqli->real_escape_string($idBenutzer),
                    $mysqli->real_escape_string($Land),
                    $mysqli->real_escape_string($Vorname), 
                    $mysqli->real_escape_string($Nachname),
                    $mysqli->real_escape_string($Hausnummer)
                ); 

                $result = $mysqli->query($query2);

                 if ( !  $result )
                    {
                       die('Ungültige Abfrage: ' . mysqli_error());
                    }

                 header('Location: http://' . $_SERVER['HTTP_HOST'] . '/test/ZuDenZahlungsdetails.php');
             
}

}//ende class




?>