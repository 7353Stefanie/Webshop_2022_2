<?php
 session_start();
?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Zahlungsdetails</title>  

             <link rel="stylesheet" href="Hilfsdokumente/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/ZumKauf.css">
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
        
        <header> 
                  <nav class="navbar navbar-default ">
                        <div class="container-fluid"><!-- padding: 15px 15px 25px 15px; -->
                                <!-- Brand and toggleget grouped for better mobile display -->  
                                          <div class="navbar-header" >    
                                          
                                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> open</button>
                                                  <span class="sr-only">Toggle navigation</span>
                                                  <span class="icon-bar"></span>
                                                  <span class="icon-bar"></span>
                                                  <span class="icon-bar"></span>
                                                </button>
                                            <a class="navbar-brand" href="01_Bauteile/Final.html">Brand</a>
                                          </div> 
                                          
                                   <!-- die Suche  -->                     <!-- das obere ermöglicht bei einer kleineren Sicht die Verschiebung der Buttons. -->   
                                <div class="row">  
                                <div class="col-xs-12 col-md-7"> 
                                       <form class="navbar-form navbar-left ">
                                                    <div class="form-group" >
                                                      <input type="text" class="form-control" placeholder="Search" style="width: 30em; display: flex;">
                                                    </div>
                                                  <button type="submit" class="btn btn-default"> Suchen</button>
                                        </form>                                     
                                </div>  
                                                            <!-- Collect the nav links, forms, and other content for toggling -->                 
                                <div class="col-sm-4 col-md-4">
                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">    
                                               <ul class="nav navbar-nav navbar-right">
                                                  <li><a href="willkommen2_funktioniert.php">

                                                     <?PHP

                                                       try{                                                   
                                                            echo 'Willkommen ';
                                                            echo $_SESSION['benutzername'];
                                                        }
                                                       catch(Exception $e)
                                                        {   
                                                           echo 'Willkommen';
                                                        }
                                           
                                                    ?>
                                                 </a></li>                                                 
                                                 <li><a href="#">Kategorie</a></li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                                      <ul class="dropdown-menu">
                                                          
                                                 <li><a href="#">Warenkorb</a></li>
                                                 <li role="separator" class="divider"></li>
                                                 <li><a href="#">Impressum</a></li>
                                                 <li><a href="#">AboutUs</a></li> 
                                                 <li><a href="#">Hilfe &amp; Support</a></li>
                                                 <li><a href="#">FAQ</a></li> 
                                                 <li><a href="#">AGB</a></li>                                         
                                                      </ul>
                                                     </li>                                          
                                              </ul>
                                            </div> <!--nav bar-->
                                </div> <!-- col 3-->
                                </div><!-- row -->
                      </div><!-- /.container-fluid -->
                 </nav>
        </header>            
  </head>  
<body>

 <header style="margin-left: 5%; margin-right: 5%;">
    <div class="container-fluid" style=" background-color: #f5f5ff;">  

       <div class='row' style=" margin-left: 0; margin-right: 0; ">

                                 <button class="col-md-4" onclick="location.href='ZumKauf.php'" style=" background-color: #f5f5f5;">Kaufübersicht</button>                        
                                                
                                
                                 <button class="col-md-4"  onclick="location.href='ZuDenZahlungsdetails.php'" style="background-color: #f5f5f5;">                    
                                                Zahlungsdetails
                                 </button>
                                 <button class="col-md-4" onclick="location.href='ZurZahlungsbestaetigung.php'" style="background-color: #f5f5f5;">
                                                Zahlungsbestätigung
                                 </button> 
       </div> <!-- row-->

            <header style=" background-color: blue; margin-top: 3%; margin-bottom: 3%"> 
                    <div class="container-fluid">
                        <div style="">

                        <header  style=" background-color: white; margin-top:10px;">
                                    <div class="container-fluid">       
 
  <?php

                     echo  '<table id="Guthaben2" class="Guthaben2" style=" float:right; margin-top: 10px;  margin-bottom: 30px; margin-right: 100px; width: 20%; background-color:white;">';
                      

                               echo  '<tr style="height: 30px; padding-top: 5px;  padding-left: 5px; padding-bottom: 5px; padding-right:5px;" class="border_bottom">';
                                    echo  '<td  style=" font-weight: bold; padding-left:5px;">aktuelles Guthaben';
                                    echo  '</td>';
                               echo  '</tr>';
                            
                                $Value = 0;

                                   $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop03');

                                                if ($mysqli->connect_error)
                                                     {
                                                      echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                                                     } 

                                                else {  //alle zahlungsmittel von Benutzerid x holen
                                                           
                                                         $query2 = sprintf("SELECT * 
                                                                        from Adresse a            
                                                                        where  a.idBenutzer = '%s'",

                                                                        $mysqli->real_escape_string($_SESSION['idBenutzer']) 
                                                                        ); 

                                                         $result = $mysqli->query($query2);

                                                          if ( !  $result )
                                                                  {
                                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                                  }     

                                                         $adresse = array() ;

                                                         while ($adressen = $result->fetch_array(MYSQLI_ASSOC))
                                                                   {
                                                                       $adresse[] = $adressen;  
                                                                   }

                                                                     mysqli_free_result( $result );

                                                                  $query3 = sprintf("SELECT   Zahlungsart, Betrag 
                                                                        from Geldkonto g             
                                                                        where  g.idBenutzer = '%s'",

                                                                        $mysqli->real_escape_string($_SESSION['idBenutzer']) 
                                                                        );

                                                                  $result3 = $mysqli->query($query3);     

                                                               if ( !  $result3 )
                                                                  {
                                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                                  }
                                                                      
                                                                      $rows = array() ; 

                                                                   while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                                                                   {
                                                                       $rows[] = $row;                                                                  
                                                               
                                                                        echo '<tr id="DasGuthaben' . $Value . '" style="height: 25px;" >'; 
                                                                        echo '<td style="padding-left:5px;">';

                                                                        echo $row['Zahlungsart'];
                                                                        
                                                                        echo "</td>";
                                                                        echo '<td>';

                                                                        echo  $row['Betrag'];
                                                                        echo "</td>";

                                                                        echo "</tr>"; 

                                                                        $Value = $Value++;
                                                                
                                                              } 
                                                                                                                
                                                  
                                                      mysqli_free_result( $result3 );
                                                     }
                                 

                             echo '<tr style="height: 25px;" class="border_bottom">'; 
                                    echo '<td  style="font-weight: bold; padding-left:5px;">'; 

                                         echo "zu zahlen:";

                                    echo "</td>";                                                   
                              echo '</tr>';


                              $k = 0;
                              $zeilen = array() ;  
                              $var = 1;
                                                      
                                        
                                  while (isset($_POST['Zahlmethode'. $var ]))
                                       {                    
                                           try{                                                 
                                                 $zeilen[] = $_POST['Zahlmethode'. $var];                                                

                                                 $var++;                                                
                                              }
                                           catch(Exception $err)
                                            {
                                              break;
                                            }
                                        }  
                         $artikelTest  =  Array();                             
                          try
                          {
                               $Zaehle= 0;

                                  for($a = 0; $a < count($zeilen);$a++)
                                  {  
                                       $chars = preg_split("/W/",$zeilen[$a]);                              

                                       $artikelTest[$Zaehle] = $chars[0];
                                       $artikelTest[$Zaehle+1] = $chars[1];
                                       $Zaehle = $Zaehle+2;                                      
                                   }  
                                   //echo(count($zeilen));
                                   //var_dump($artikelTest);                                
                         }
                         catch(Exception $err)
                         {
                              if(count($zeilen) == 0)
                              {
                              echo( alert(" Ihre Sitzung ist abgelaufen. Bitte melden Sie sich erneut an. "));
                              }
                              echo($err);
                         }


//
                        //   $Artikelnummern=   Array();
                        //   $artikelKaufart=   Array();
                          

                            //foreach($rows as $row) 
                            //{
                          //    $artikelnummer[] = $row['idartikel'];
                          //  }
                           
                          //  $alleArtikel = array_unique($artikelnummer);

                          //  sort($alleArtikel);  

                           // var_dump($alleArtikel);
                           // echo($alleArtikel[0]);
                           // echo(count($alleArtikel));

                            //$alleArtikel enthällt alle Artikelnummern
                            $Platz = 0;
                            $Zuweisung = 0;
                            $nochMehr = 0;

                     //       foreach($rows as $row) 
                     //       {
                     //             if ($alleArtikel[$nochMehr] == $row['idartikel'] ) 
                     //             {                                      
                     //                 $artikelKaufart[$Zuweisung][$Platz] =   $row['idartikel'];
                    //                  $artikelKaufart[$Zuweisung][$Platz+1] = $row['Kaufarten'];
                     //                 $artikelKaufart[$Zuweisung][$Platz+2] = $row['Preis'];
                    //                                                        
                    //                  $Zuweisung++;
                    //              }
                     ////             else
                    ////              {                                      
                     ////                 $artikelKaufart[$Zuweisung][$Platz] =   $row['idartikel'];
                   ////                   $artikelKaufart[$Zuweisung][$Platz+1] = $row['Kaufarten'];
                   ////                   $artikelKaufart[$Zuweisung][$Platz+2] = $row['Preis'];
                    //                
                   //                  $Zuweisung++;
                   //                  $nochMehr++;
                   //               }
                  //          }
                            //var_dump($artikelKaufart);
                            
                            // Zeilen[] enhthält die value Werte


                            // erstelle ein Array Warenkorb id
                            //schreibe die Werte (Betrag und Kaufart) von der Datenbank in ein Array            
                            //Übergebe das Array mit dem Betrag und der Kaufart in das Warenkorb array
                            // Ergebnis ist 

                            
                            //Vergleiche 
                            // $zeilen[0];
                            //echo $zeilen[1]; 

                            $laengevonAT = count($artikelTest);
                            $laengevonAT2 = count($artikelTest);
                            $neuesArray = Array();
                            //$DStelle  = 0;
                            $Erg=0;
                            $ZuEntfernen  = Array();

                            $k = 1;
                            $Pos = 0;
                            $i2  = 0;

                            $ErstePos = 0;
                            $letztePos = 0;

                            //$ATDerWert = 2; // suche von hinten beginn mit dem Letzten Namen
                            $ATDerWert2 = 1; // suche von hinten ausgabe Wert

                            for($i = 0; $i < $laengevonAT2/2 ; $i++)
                            {           
                                 //echo($laengevonAT);

                                  $ErstePos = array_search($artikelTest[$i2],$artikelTest); // first index
                                  $letztePos = array_search($artikelTest[$i2],array_reverse($artikelTest));

                                 // var_dump($artikelTest);
                                  //var_dump(array_reverse($artikelTest));

                                  
                                  $rev = array_reverse($artikelTest);
                                  //länge ist 8 , 

                                  if( $artikelTest[$ErstePos] == $rev[$letztePos] )

                                   { if(($laengevonAT - $k) != $letztePos)//wenn die letzte Pos 0 ist )

                                         {  
                                          $Erg = intval($artikelTest[$ErstePos+1]) + intval($rev[$letztePos -1]);
                                          //echo($Erg . "Ergebnis");


                                          $Wert = $artikelTest[$ErstePos]; // Name des Doppelten  
                                           

                                          unset($artikelTest[$ErstePos]);// wert zahl
                                          unset($artikelTest[$ErstePos+1]);// wert  name

                                         // var_dump($artikelTest);

                                          $rev = array_reverse($artikelTest);                                         

                                          unset( $rev[$letztePos]);
                                          unset($rev[$letztePos -1]);

                                          $rev = array_reverse($rev); 
                                          $artikelTest = $rev;

                                          array_push($artikelTest,$Wert,$Erg);

                                          //var_dump($artikelTest);

                                           $laengevonAT = count($artikelTest);
                                          // echo($laengevonAT.$i2);

                                           $i2 = $i2 -2;
                                            $k = $k -2;
                                          }
                                  }
                                  $i2 = $i2 +2;
                              $k = $k +2;
                             // $i = $i +1;
                                
                            }
             // var_dump($artikelTest);
              if(isset($_POST['Zahlmethode'. 1]))
              {  
              $_SESSION['ArtikelInfos'] = array($artikelTest);
              //var_dump($_SESSION['ArtikelInfos']);
               session_encode ();
              }
              //var_dump($_SESSION['ArtikelInfos']);
              $artikelTest = $_SESSION['ArtikelInfos'];
              //var_dump($artikelTest);
              $artikelTest = $artikelTest[0];
              //var_dump($artikelTest);

                              for($i= 0; $i< count($artikelTest) ;$i++)
                               {
                                if($artikelTest[$i] != null)
                                 {    
                                      echo '<tr id="Zahlmethode'.$i . '" style="  padding-top: 5px;  padding-left: 10px; padding-bottom: 5px; padding-right:  5px;" >';
                                      echo '<td style="padding-left:5px; padding-top: 5px;">';
                                      echo $artikelTest[$i];
                                      echo '</td>';
                                      echo '<td style="padding-left:5px; padding-top: 5px;">';

                                      if($artikelTest[$i] == "Euro")
                                     { echo $artikelTest[$i+1]/100 . " €";}
                                    else
                                      {echo $artikelTest[$i+1];}

                                      echo '</td>';
                                      echo '</tr>';
                                      $i = $i+1;
                                 }
                               }

                               echo '<tr style="height: 25px;" class="border_bottom">'; 
                                    echo '<td  style="font-weight: bold; padding-left:5px;">'; 

                                         echo "offener Gesamtbetrag:";

                                    echo "</td>";                                                   
                              echo '</tr>';

                      $Guthaben = Array();
                      $Gesamtbetrag = Array();
                      $p = 0;


                     foreach($rows as $row) 
                     {
                       $Guthaben[$p] =$row['Zahlungsart']; 
                       $p = $p+1;  

                       $Guthaben[$p] = $row['Betrag'] ;
                       $p = $p+1;                     
                     } 
                      
                      //var_dump($Guthaben);

                      $laengeGuthaben = count($Guthaben);
                      $offenerBetrag = Array();
                      $offenerRest = Array();
                      $k = 0;
                      $Erg = 0;
                      $Gesamt = 0;
                      $Rest = 0;
                      $offen = 0;
                      $offen2 = 0;

                     for($i = 0; $i <$laengeGuthaben/2 ; $i++)
                     {
                       $Erg = array_search($Guthaben[$k],$artikelTest);

                       if($artikelTest[$Erg] == $Guthaben[$k])
                          {

                            if ($artikelTest[$Erg +1] < $Guthaben[$k+1])
                            {
                              $Gesamt =  intval($Guthaben[$k+1]) - intval($artikelTest[$Erg +1]);
                              $offenerBetrag[$offen] = $artikelTest[$Erg];
                              $offen = $offen+1;

                              $offenerBetrag[$offen] = $Gesamt;
                              $offen = $offen+1;

                              unset($artikelTest[$Erg]);
                              unset($artikelTest[$Erg+1]);

                            }
                            else
                            {
                              $Rest =  intval($artikelTest[$Erg +1]) - intval($Guthaben[$k+1]) ;

                               $offenerRest[$offen2]=  $artikelTest[$Erg];
                               
                               $offenerRest[$offen2+1] = $Rest;                               

                                unset($artikelTest[$Erg]);
                                unset($artikelTest[$Erg+1]);

                              $artikelTest=  array_merge($artikelTest,$offenerRest);
                            }
                          }

                      $k = $k+2;
                    }



                     // var_dump($offenerBetrag);
                     // var_dump($artikelTest);
                      //echo count($artikelTest); 
                   $richtigerWert = 0;
                   $Artikelpos = 0; 

                     for($i= 0; $i< count($artikelTest) ;$i++)
                         {    
                                if(! empty($artikelTest[$Artikelpos]))
                                 { 
                                      echo '<tr id="Zahlmethode'. $Artikelpos . '" style="  padding-top: 5px;  padding-left: 10px; padding-bottom: 5px; padding-right:  5px;" >';
                                      echo '<td style="padding-left:5px; padding-top: 5px;">';
                                      echo $artikelTest[$Artikelpos];
                                      echo '</td>';
                                      echo '<td style="padding-left:5px; padding-top: 5px;">';

                                      if($artikelTest[ $Artikelpos] == "Euro")
                                     { echo $artikelTest[ $Artikelpos+1]/100 . " €";
                                     }
                                    else
                                      {echo $artikelTest[ $Artikelpos+1];
                                      }

                                      echo '</td>';
                                      echo '</tr>';
                                       $i++;
                                      $richtigerWert++;
                                      $Artikelpos++;
                                   }
                                else{
                                          if($richtigerWert <= count($artikelTest))
                                            {$i--;}
                                    }
                                    $Artikelpos++;

                          }

                     //  echo ( var_dump($adresse));

                         //ende des class "Guthaben divs"      
                       ?> 

                      </table>
                              
                                    <table>
                                             <tr style=" width: 50px;">                                             
                                                       
                                                       <h4><b><u>Versandadresse:</u></b></h4>
                                              </tr>
                                              <tr>
                                               <td style="width: 200px;"  >                 
                                                  
                                                  <button data-toggle="modal" data-target="#myModal" style=" font-size: 14px; font-style: arial; background-color: white; border:none;  padding-bottom: 5px; padding-top: 5px;"> 
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"> 
                                                  </span> Adresse hinzufügen</button><br>                                                   
                                                                
                                                  <button data-toggle="modal" data-target="#myModal" style=" font-size: 14px; font-style: arial; background-color: white; border:none;  padding-bottom: 5px; padding-top: 5px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Adresse ändern</button>

                                                  <!-- Modal -->

                                                        
                                                </td>                                               
                                                 <td style="position: center;">
                                                          <table class="table"  id="Adressen" style="width: 200px; margin-left: 50px;">
                                                                
                                                                  <?php  
                                                                 
                                                                      echo "  <tr>";
                                                                      echo "  <td>";
                                                                      echo $adresse[0]["Vorname"] . " ";                                                              
                                                                      
                                                                       echo $adresse[0]["Nachname"] ; 
                                                                       echo " </td>"; 
                                                                       echo "<tr>";
                                                                       echo "  <td>";
                                                                       echo $adresse[0]["Strasse"] . " " ;                                                              
                                                                      
                                                                       echo $adresse[0]["Hausnummer"] ; 
                                                                       echo " </td>";                   
                                                                       echo "</tr>"; 

                                                                       echo "<tr>";
                                                                       echo "  <td>";

                                                                       echo $adresse[0]["Postleitzahl"] . " " ; 
                                                                      
                                                                      echo $adresse[0]["Ort"]  ;                                                              
                                                                                                                                            
                                                                       echo " </td>";                   
                                                                       echo "</tr>";  

                                                                       echo "<tr>";
                                                                       echo "  <td>";
                                                                      
                                                                      echo $adresse[0]["Land"]  ;                                                              
                                                                                                                                            
                                                                       echo " </td>";                   
                                                                       echo " </tr>";     
                                                                  ?>                                                               
                                                                                                                    
                                                          </table>
                                                 </td>
                                                 </tr>
                                        </table>  
                                      </div>                     
                               </header>


                 <header style=" background-color: white; margin-top: 3%; margin-bottom: 3%"> 
                    <div class="container-fluid">
                    <div style=""> 
                        <table ">
                           <tr >                             
                              <h4><b><u>Zahlungsarten:</u></b></h4>

                              <dt>
                                <form action="ZurZahlungsbestaetigung.php" name="Formular" id="Formular" method="post">

                                  <table  style="margin-left: 250px; margin-bottom: 50px; width: 20%;margin-left: ">
                                    <tr><td>

                                      <label style="margin-left:10px; " for="masterca">Kreditkarte - MasterCard
                                      </td><td >  

                                           <input style="margin-left: 20px;  ;" type="radio" id="masterca" name="Zahlung" value="MasterCard">
                                      </label>
                                     </td></tr>
                                    <tr><td>

                                      <label style="margin-left:10px;" for="visa">Kreditkarte - VISA
                                      </td><td>
                                            <input style="margin-left: 20px;"  type="radio" id="visa" name="Zahlung" value="VISA">

                                      </label>

                                     </td></tr>
                                      <tr><td>

                                      <label style=" margin-left:10px;" for="PayPal">PayPal

                                      </td><td>
                                            <input style="margin-left: 20px;"  type="radio" id="PayPal" name="Zahlung" value="PayPal">
                                      </label>

                                      </td></tr>
                                      <tr><td>

                                      <label style=" margin-left:10px;" for="Sofortueberweisung">Sofortueberweisung

                                      </td><td>
                                            <input style="margin-left: 20px;"  type="radio" id="Sofortueberweisung" name="Zahlung" value="Sofortueberweisung">
                                      </label>

                                      </td></tr>
                                      <tr><td>

                                        <label style=" margin-left:10px;" for="EC">ECLastschrift

                                        </td> <td>
                                            <input style="margin-left: 20px;  margin-bottom: 5px;" type="radio" id="EC" name="Zahlung" value="ECLastschrift">
                                      </label>
                                      </dt>
                                    </tr>
                                    </tr>
                                  </table>

                                </form>
                              </dt>

                           </tr>
                       </table>     

                    </div>
                    </div>
              </header> 


                              
                         </div>
                     </div>
              </header>               

                   




          
       </div>
  </header>

   
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                            <div class="modal-content">
                                  <div class="modal-header">

                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                               <table>
                                               <tr>
                                                   <td style=" width: 60%;" ><h4 class="modal-title">Adressen</h4>
                                                   </td>

                                                   <td style=" width: 10%;">
                                                           <button  type="button" data-toggle="modal" data-target="#modalAdresse"   style=" font-size: 12px; background-color: white; border:none; "> <span class="glyphicon glyphicon-plus" aria-hidden="true"> <br>
                                                             </span><br> Adresse hinzufügen</button><br> 
                                                    </td>

                                                    <td style=" width: 10%;">
                                                            <button  type="button" style=" font-size: 12px; background-color: white; border:none; "> <span class="glyphicon glyphicon-pencil" aria-hidden="true">
                                                             </span>Adresse ändern</button><br> 
                                                   </td>
                                                </tr>
                                                </table>

                                  </div>
                                  <div class="modal-body">
                                    <div class="container-fluid">
                                        
                                        <form class="form" id="ModalAdressen" name="ModalAdressen" action="ZuDenZahlungsdetails.php" method="post">
                                     
                                             <?php
                                               $var = 1;
                                             foreach ($adresse as $adressen) 
                                              { 
                                               echo '<div class="row" style=" padding-bottom:10px; padding-top:10px; border-bottom:1pt solid gray; ">';
                                               
                                                              echo '<div class="col-md-2" > ';   
                                                              
                                                               echo "Nr ". $var;     
                                                                echo '</div>'; 
                                                      
                                                              echo '<div class="col-sm-7"> ';                

                                                                                            echo '<label for="Adresse '. $var .'">';

                                                                                               echo '<div class="row">';                                            
                                                                                                  echo '<div class=".col-8 .col-sm-6 "> ';  

                                                                                                   echo $adressen["Vorname"] . " ";
                                                                                                   echo $adressen["Nachname"] ; 

                                                                                                   echo ' </div>';
                                                                                                echo ' </div>'; 

                                                                                                echo '<div class="row">'; 
                                                                                                  echo '<div class=".col-8 .col-sm-6  "> ';

                                                                                                   echo $adressen["Strasse"] . " " ;
                                                                                                   echo $adressen["Hausnummer"] ; 

                                                                                                  echo ' </div>';
                                                                                                echo ' </div>';

                                                                                                echo '<div class="row">';                                            
                                                                                                  echo '<div class=".col-8 .col-sm-6   "> ';  

                                                                                                   echo $adressen["Postleitzahl"] . " " ;                                  
                                                                                                   echo $adressen["Ort"]  ;                                                              
                                                                                                  echo ' </div>';
                                                                                                echo ' </div>';  

                                                                                                echo '<div class="row">';                                            
                                                                                                  echo '<div class=".col-8 .col-sm-6 "> ';  
                                                                                                  
                                                                                                  echo $adressen["Land"]  ;  
                                                                                                                                                               
                                                                                                  echo ' </div>';
                                                                                                echo ' </div>';  

                                                                                            echo '</label> '; 
                                                                 echo ' </div>'; 
                                                                                                                     
                                                                echo '<div class="col-md-2" style="vertical-align: middle;"> '; 

                                                                      echo '<input type="radio" style="vertical-align: middle;" id="Adresse '. $var .'" name="Adresse" value="';echo $adressen["Vorname"] ." ". $adressen["Nachname"] ." ".  $adressen["Strasse"] ." ".  $adressen["Hausnummer"] ." ".  $adressen["Postleitzahl"] ." ".  $adressen["Ort"] ." ".  $adressen["Land"]; echo'">';

                                                               echo ' </div>';  
                                                   echo ' </div>';  
                                                   echo '<div class="row">';
                                                   echo ' </div>'; 
                                                   echo '<div class="row">';
                                                   echo ' </div>'; 
                                                   echo '<div class="row">';
                                                   echo ' </div>'; 
                                                   $var = $var+1;
                                               }
                                               ?>  

                                           </form>
                                      </div> <!-- container -->
                                  </div> <!-- body -->

                                  <div class="modal-footer" style=" text-align: center; padding-right: 50px;" >
                                  
                                                    <button type="button"  class="btn btn-default" data-dismiss="modal">Schließen</button>
                                 
                                                     <p><button id="adresseAendern" data-dismiss="modal" name="submit" type="submit" class="btn btn-primary">Änderungen speichern
                                                     </button></p>
                                      
                                  </div><!-- footer--> 
                                  
                            </div>
                                                            <!-- /.modal-content -->
                     </div>
                                                        <!-- /.modal-dialog -->
  </div>
                                            <!-- /.modal -->



 <form action="adresseHinzufügen.php" method="post">
          <div class="container">          
                      <div class="row">
                      <div class="col-md-3">  
                      <div class="format">     
                                   <div class="modal" id="modalAdresse">   
                                   <div class="modal-dialog modal-lg" style="margin-left: 450px; margin-right: auto;" >                                         
                                   <div class="modal-content" style="width: 400px; "> 
                                   <!-- anfang-->
                                          <div class="modal-header"> 
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>                                                             

                                              <h4>Adresse hinzufügen</h4>                                         
                                          </div> 

                                          <div class="modal-body">   
                                          <div class="well">

                                                                   <div class="form-group row">
                                                                                            <label for="vorname" class="col-2 col-form-label">Vorname</label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="vorname" name="vorname"> 
                                                                   </div>
                                                                   </div>  


                                                                   <div class="form-group row">
                                                                                            <label for="nachname" class="col-2 col-form-label">Nachname</label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="nachname" name="nachname"> 
                                                                   </div>
                                                                   </div> 


                                                                   <div class="form-group row">
                                                                                            <label for="email" class="col-2 col-form-label">Straße und Hausnummer </label>
                                                                   <div class="col-10">
                                                                        <div class="form-inline">
                                                                                            <input class="form-control " style="width:65%;" id="Strasse" name="Strasse"> 
                                                                                            <input class="form-control " style="width:30%;" id="Hausnummer" name="Hausnummer"> 
                                                                        </div>
                                                                   </div>
                                                                   </div>


                                                                   <div class="form-group row">
                                                                                            <label for="email" class="col-2 col-form-label">Postleitzahl und Ort </label>
                                                                   <div class="col-10">
                                                                        <div class="form-inline">
                                                                                            <input class="form-control" style="width:30%;" id="Postleitzahl" name="Postleitzahl"> 
                                                                                            <input class="form-control" style="width:65%;" id="Ort" name="Ort"> 
                                                                        </div>
                                                                    </div>                                                                         
                                                                    </div>

                                                                    

                                                                    <div class="form-group row">
                                                                                            <label for="email" class="col-2 col-form-label">Land </label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="Land" name="Land"> 
                                                                    </div>                                                                         
                                                                    </div>
                                            
                                          
                                            </div>
                                            </div>
                                            <div class="modal-footer" style="text-align: center; ">

                                                                    <div class="form-group row" >
                                                                    <div class="col-10">
                                                                                            <button type="submit" class="btn btn-primary"> Adresse hinzufügen</button>      
                                                                      <a href="" class="btn btn-default" data-dismiss="modal"  >Close</a>
                                                                        </div>
                                                                    </div>
                                            </div>

                                    </div>  
                                    </div>
                                    </div><!-- modal content -->                                                                          
                       </div>
                       </div>
                       </div>              
          </div> 
</form>              
                                          
              
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
    
    <script  src="https://code.jquery.com/jquery-1.10.2.js"></script>

     <script type="text/javascript">
    
    $(document).ready( function() {

      var a = document.getElementById("adresseAendern");
      
       a.onclick = function() {


             var r = new Array;
             var j = -1;
       
       var ausgabeCheckedButtons = $("input[name='Adresse']:checked").val();

              if(ausgabeCheckedButtons != undefined)
           {
             var res = ausgabeCheckedButtons.split(" ");        // in res werden die geteilten Werte gespeichert

              r[++j] = '<tr>';
              r[++j] = '<td>';
              r[++j] = res[0]+ ' ';                                                              
                                                                      
              r[++j] = res[1]+ ' ' ; 
              r[++j] = '</td>'; 
              r[++j] = '<tr>';
              r[++j] = '<td>';
              r[++j] = res[2]+ ' ' ;                                                              
                                                                      
              r[++j] = res[3]+ ' ' ; 
              r[++j] = '</tr>';
              r[++j] = '</td>';

              r[++j] = '<tr>';
              r[++j] = '<td>';

              r[++j] = res[4] + ' '; 
                                                                      
              r[++j] = res[5] + ' ';                                                              
                                                                                                                                            
              r[++j] = '</tr>';
              r[++j] = '</td>'; 

              r[++j] = '<tr>';
              r[++j] = '<td>';
                                                                       
              r[++j] = res[6] + ' ' ;                                                             
                                                                                                                                             
              r[++j] = '</tr>';
              r[++j] = '</td>'; 

              $('#Adressen').html(r.join(''));


            }

        // finde heraus weleche der Radiobuttons in der form mit der id ModalAdressen angeklickt ist
      }
});
      
        
     </script>

     <!-- PayPal integration https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/add-paypal-button/ -->
</html>