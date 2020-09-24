<?php
 session_start();

     if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
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

                
                               <form action="Buttons/Buttons/sucheV2.php" method="post"  class="navbar-form navbar-left "  >
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
                                              
                                              <li><a href="Buttons/Warenkorb.php">Warenkorb</a></li>
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
                      
                                           <li role="Willkommen" class="active"> <a href="StartseitenAnmeldung.php" > 
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
 <div class="collapse" id="Watchlist" role="tabpanel" aria-labelledby="Watchlist">
                                    <div class="tabStyle">
                                                <br>
                                                <h4 style="text-align: center; font-weight: bold">Meine Watchlist</h4>  
                                                <br>
                                          
                                                  <table class="table">
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          <td>Artikel</td>
                                                          <td> Bild</td>
                                                          <td><button type="button" style="font-size: 12px;" class="btn btn-default" aria-label="Links ausrichten">
                                                                <span id="hinzufügen" href="ArtikelHinzufügen.php" class="glyphicon glyphicon-plus" aria-hidden="true"></span> Artikel hinzufügen
                                                              </button>                                                              
                                                          </td>                                                                                                       
                                                       </tr>
                                               <?php

                                               $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop03');


                                                if ($mysqli->connect_error) {

                                                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                                                } else {   
   
                                                  $query = sprintf("SELECT ISBN, Buchtitel, Autor, Erscheinungsjahr, Auflage, idWatchlist  
                                                           from  Bücher b, Artikel a, Watchlist w
                                                            where b.idBücher = a.idBücher
                                                                                                              
                                                            and w.idBenutzer = b2.idBenutzer

                                                            and w.idArtikel = a.idArtikel
                                                            and w.Kategorien = a.Kategorien 
                                                            and w.idBenutzer='%s'",

                                                            $mysqli->real_escape_string($_SESSION['idBenutzer']) 

                                                            );

                                                  $result = $mysqli->query($query); # Enthält Benutzernamen und Passwort

                                                
                                                  if ( ! $result )
                                                  {
                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                  }
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                   
                                                  while ($zeile = $result->fetch_array(MYSQLI_ASSOC))
                                                  {
                                                   
                                                    echo '<tr style="font-size: 12px; width: 250px;">';
                                                    echo "<td>";

                                                    echo  $zeile['Buchtitel'] . ", ";
                                                    echo  $zeile['Autor'] . " <br>";
                                                    echo  $zeile['Erscheinungsjahr'] . ", ";
                                                    echo  $zeile['Auflage'] ;
                                                                                                      
                                                   
                                                    echo "<td> Bild als Link </td>";

                                                    
                                                                   
                                                    echo '<td><span id="'; echo $zeile['idWatchlist'].'Watchlist'; echo'"  onclick="WarenkorbEintragLöschen(this.id)" class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </td>';
                                                    
                                                  }                                                     
                                                     
                                                      mysqli_free_result( $result );
                                                    }

                                                      mysqli_close($mysqli);

                                                      ?>

                                                      </table> 
                                    </div> <!-- Tabstyle-->
 </div><!-- collaps-->   
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