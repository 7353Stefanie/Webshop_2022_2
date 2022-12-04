<?php
define('__ROOT__', '../../Final/Kategorien/Buttons/Hilfsdokumente');
 require_once(__ROOT__.'/BestellungenAktuallisieren.php'); 

 session_start();

    if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
    } 




 function switchIt($Artikel)
 {


  switch($Artikel['Kategorien']) {

    case 'Buecher':

      echo "<b>" .$Artikel['Bezeichnung'] . "</b>, <br>";
      echo  $Artikel['1']['Autor'] . ", ";
      echo  $Artikel['1']['Erscheinungsjahr'] . ", ";
      echo  'Auflage: '.$Artikel['1']['Auflage']; 
                                                      
      
      # code...
      break;

    case 'Kleidung':

      echo "<b>" .$Artikel['Bezeichnung'] . "</b>, <br>" ;
      echo  $Artikel['1']['Marke'] . ", ";
      echo  $Artikel['1']['Groesse'] . ", ";
      echo  $Artikel['1']['Farbe'];

     
      # code...
      break;
    
    default:
      # code...
      break;
  }
 }

?>
<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Benutzerseite</title>                             
             
            

            <link href="Buttons/Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Buttons/Hilfsdokumente/bootstrap-theme.min.css">
             <link rel="stylesheet" href="Buttons/Hilfsdokumente/bootstrap.css">
             
              <link rel="stylesheet" href="Buttons/Hilfsdokumente/css/willkommenStyle.css"> 
        
             
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
                                            <a class="navbar-brand" href="/../Final/final.php">Brand</a>
                                          </div> 

                
                               <form action="Buttons/sucheV2.php" method="post"  class="navbar-form navbar-left "  >
                                 <div class="form-group ">  
                                  
                                        <span >                                                                 
                                                                            <select  style="float: left; width: 150px; margin-right: 5px;" name="Kategorie" class="col-sm-1 form-control" id="einfaches-addon1" >
                                                                              
                                                                                  <option value="Alle">Alle Kategorien</option> 
                                                                                  <option value="Buecher">Bücher</option> 
                                                                                  <option value="Kleidung">Kleidung</option> 
                                                                                  <option value="FreizeitundSport">Freizeit und Sport</option> 
                                                                                  <option value="Spielzeug">Spielzeug</option> 
                                                                                  <option value="Fahrzeug">Fahrzeug</option> 
                                                                                  <option value="HaushaltundGarten">Haushalt und Garten</option> 
                                                                                  <option value="Sonstiges">Sonstiges</option> 

                                                                           </select>
                                           </span>
                                      </div>

                                      <div class="form-group "> 
                                        <input type="text" class="form-control " placeholder="Suchen" name="suchen" aria-describedby="einfaches-addon1" style="width: 25em; display: flex;">
                                      </div>
                                         <button type="submit" class="btn btn-default"> Suchen </button>
   
                               </form>                             
                               
                                    <ul class="nav navbar-nav navbar-right">    

                                           <?PHP
                                                           echo   '<li><a href="Buttons/ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';                                                          
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                              
                                              <li><a href="Buttons/Hilfsdokumente/WarenkorbKommunikation.php">Warenkorb</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li> 
                                            <li><a href="Buttons/Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> 
                                             
                                        </ul>                             
                          
                         </div><!-- /.container-fluid -->
                      </nav>
            </header> 
  </head>  
  <body>
        <header class="Kasten">
      <header style="margin-left: 5%;">
         <div  id="selector2" role="tablist">
             <div class="col-md-3" style="position: fixed; ">   
<!-- Überschriften -->                      
                 <ul class="nav nav-pills nav-stacked">  
                      <div class="head2" role="tab" id="WillkommenHead">
                              
                                           <li role="Willkommen" class="active"><a href="StartseitenAnmeldung.php" >
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
                      </div><!-- head ende -->

                      <div class="head2" role="tab" id="WarenkorbHead">
                                                          
                                          <li role="Warenkorb"><a href="Warenkorb.php"  >Mein Warenkorb</a></li>
                           
                      </div> <!-- head ende -->
                      
                      <div class="head2" role="tab" id="BestellungenHead">
                                                          
                                          <li role="Bestellungen"><a href="MeineBestellungen.php" >Meine Bestellungen</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="ArtikelHead">
                                                          
                                          <li role="Artikel"><a href="MeineVerkaufsartikel.php">Meine Artikel</a></li>
                           
                      </div> <!-- head ende -->

                       <div class="head2" role="tab" id="GemerktHead">
                                                          
                                          <li role="Artikel"><a href="gemerkteArtikel.php">Meine gemerkten Artikel</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="WatchlistHead">
                                                          
                                          <li role="Watchlist"><a  href="MeineWatchlist.php" >Meine Watchlist</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="Nachrichten">
                                                          
                                          <li role="Nachrichten"><a  href="MeineNachrichten.php" >Meine Nachrichten</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="KontoHead">
                                                          
                                          <li role="Konto"><a href="MeineKontodaten.php" >Meine Kontodaten</a></li>
                           
                      </div>

                      <div class="head2" role="tab" id="KontoeinstellungenHead">
                                                          
                                          <li role="Kontoeinstellungen"><a  href="MeineKontoeinstellungen.php" >Kontoeinstellungen</a></li>
                           
                      </div> <!-- head ende -->
                 </ul>
            </div><!-- col 3-->
 <div class="col-md-8" style="margin-left: 27%; display: box; align-items: center;  justify-content: center; " >                    
<!-- Inhalte -->         
<div class="tabStyle">
                                                <br>
                                                <h4 style="text-align: center; font-weight: bold">Meine Bestellungen</h4>  
                                                <br>


              
          
                               
                                                
                                          <div style="box-sizing:border-box;  margin-left: auto; margin-right: auto;  border-radius: 4px; position: relative;  ">
                                                                                                               
                                               <table class="table" >
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          <td>Nr.</td>
                                                          <td>Verkaufsdatum</td>
                                                          <td>Artikel</td>
                                                          <td> Bild</td>                                                          
                                                          <td> Verkaufsbetrag </td>
                                                            
                                                           
                                                                                                                                                                
                                                       </tr>

                                               <?php   
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden

                                                $Artikelinfos =  Array() ; 
                                                $array = array();

                                                $var = 1;

                                                $MeineBestellungen = new meineBestellungen();
                                                $Sammlung = $MeineBestellungen->AusgabeBestellungen($_SESSION['idBenutzer']);

                                                   for($y= 0; $y < count($Sammlung)/2; $y++)
                                                    {

                                                      $Artikelinfos =  $Sammlung[count($Sammlung)/2+$y];
                                                     
                                                       $Artikelinfo2 = $Sammlung[$y];
                                                      

                                                    echo '<tr style="font-size: 12px;">';
                                                    echo "<td style='width:2%;'>";
                                                    echo $var++;
                                                    echo "</td>";
                                                    echo "<td style='width:7%;'>";
                                                    echo  $Artikelinfos['Bestelldatum'] . "</td> ";

                                                    echo "<td style='width:30%;'>";


                                                    switchIt($Artikelinfo2);
                                                   echo  '</td>';

                                                  echo "<td style='width:12%;'><img id='miniaturbild' style='width:60px; height:80px;' src='Buttons/". $Artikelinfo2['Titelbild']."' alt='titelbild'>";

                                                 // var_dump($Artikelinfo2);

                                                   echo "<td style='width:10%;'>";

                                                   if( $Artikelinfo2['0']['Kaufarten'])
                                                   {
                                                    echo 'gekauft für '. number_format($Artikelinfo2['0']['Preis']/100, 2, ',', '.') .' €';
                                                   }
                                                   else
                                                   {
                                                    echo ' getauscht für ' . number_format($Artikelinfo2['0']['Preis']/100, 2, ',', '.') .' &euro';
                                                   }
                                                        
                                                   echo  '</td>';         

                                                    echo '</tr>';

                                                   }       
                                                                                                       
                                                     
                                                      ?>

                                    </table> 
                        </div> 
            </div> <!-- ende col 8-->

                                              <!--  <h9> Woher kommen die Daten?:
                                                Wurde ein Artikel bestellt werden die Daten dieses Artikels, aus dem Warenkorb in die Tabelle Bestellungen übertragen.

                                                          Beim Kauf:
                                                          Wenn garantiert ist, das alle bestellten Artikel, in die Tabelle Bestellungen hinzugefügt wurden, werden diese aus der Tabelle Warenkorb gelöscht.

                                                Bestellungen beim Start:
                                                Die aktuelle Tabelle Bestellungen wird aufgerufen und alle Artikel der Tabelle werden angezeigt.

                                                          Status der Bestellungen:
                                                          Der Status einer Bestellung wird fortlaufend geändert.

                                                                Einflussfaktoren:
                                                                Der Verkäufer gibt an, dass die Bestellung versand wurde. Tag, Zeitpunkt und Neuer Status der Bestellung wird in die Tabelle Bestellungen übertragen.

                                                          Der Standard Status ist: 'noch nicht versendet'.


                                                Funktionen:
                                                Der Status kann verfolgt werden. Es kann angegeben werden, ob eine E-Mail oder Nachrricht auf dem Handy erfolgen soll, falls der Status der Bestellung sich verändert.

                                                </h9>-->
                                              

                                                      </table></h6>   
                                    </div>
 
</div> <!-- ende col 8-->            
</div><!-- selector -->
       

    </header>
  </header>

    </body>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Buttons/Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    

     <script type="text/javascript">


       function WarenkorbEintragLöschen(Warenkorbeintrag)
       {

          var res = Warenkorbeintrag.split("Z");

          console.log(res[0]+res[1]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]); 
          formData.append("Tabelle", res[1]);    

        xhttp.open("POST", "EintragLoeschen.php", true);
        xhttp.onreadystatechange = function()
        {if (xhttp.readyState ==4 && xhttp.status == 200)
          {console.log("it Works");
          }

        }
        xhttp.send(formData); 
             
       }

     </script>  

  </html>