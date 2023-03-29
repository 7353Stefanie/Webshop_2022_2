<?php

 session_start();

  // define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/');


 require_once(__DIR__.'/hintergrundSuche.php');
  require_once(__DIR__.'/Hilfsklasse.php');






?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Finale Startseite</title>   
                            
            
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
             <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap.css">
              <link rel="stylesheet" href="Hilfsdokumente/css/StyleSuche.css"> 
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

                
                               <form action="sucheV2.php" method="post"  class="navbar-form navbar-left "  >
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

                                           <?php
                                                    if(isset($_SESSION['benutzername']))
                                                    {
                                                           echo   '<li><a href="./ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="../StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';  
                                                    } 
                                                    else  
                                                    {
                                                         echo '<li><a href="#" data-toggle="modal" data-target="#modal-2">Registrieren</a></li>';
                                                         echo '<li><a href="#" data-toggle="modal" data-target="#modal-1">Login</a></li>';
                                                    }                                                      
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                   <?php
                                                    if(isset($_SESSION['benutzername']))
                                                    {                                              
                                                     echo ' <li><a href="Kategorien/StartseitenAnmeldung.php">Warenkorb</a></li>';
                                                    }
                                                  ?>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li> 
                                              <?PHP
                                              if(isset($_SESSION['benutzername']))
                                                    {
                                                      echo '<li><a href="Kategorien/Buttons/Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> ';
                                                    }
                                              ?>
                                             
                                        </ul>                             
                          
                         </div><!-- /.container-fluid -->
                      </nav>
            </header>            
          </head>
          <body>
            <?php
              // $alleBuecher =  $_SESSION['AlleBuecher'];

              // $Kaufarten =  $_SESSION['Kaufarten']; 
               //var_dump($alleBuecher);



                        $Suche = new Suche_Artikel();

                        $Hilfsklasse = new Hilfsklasse();

                        $alleBuecher = $Suche->sucheAlleArtikelEinerKategorie( 'Buecher');

                        $Position=  $Hilfsklasse->array_Key_count($alleBuecher, 'Kategorien');

                        /* [0]=> array(5) { ["idArtikel"]
                                            ["Kategorien"]
                                            ["Bezeichnung"]
                                            ["Zeitstempel"] 
                                            ["Titelbild"]

                                             ["idBuecher"]
                                             ["ISBN"]
                                             ["Autor"]
                                             ["Erscheinungsjahr"]
                                             ["Auflage"]
                                             ["Kurzbeschreibung"]
                                             ["idArtikel"]
                                             ["Genre"]
                                             ["Seitenanzahl"]
                                             ["Mediumart"] 

                                             array(2) { [0]=> int(0) [1]=> int(1)


                                            */

                       // var_dump($alleBuecher);
                       // var_dump($Position);

                         $s = 'src="'; $e = '"';  $a = 'alt="';$i = 0; 



              echo' <div class="extra container-fluid">
                        <div class="UeberschriftKategorie">';

             
                    echo 'Bücher';
                 

                

              echo' </div> 
                    </div> ';
            

              echo '<div style="float:left; width: inherit; height:270px;">';
              echo '<form action = "Hilfsdokumente/SucheUndAnzeige.php" method="post" >'; 

              $z = 0;
              echo '<div class="" style="float:left; margin-left:10px;">';
                for($i = 0; $i < count($Position); $i++)                  
                  { 

                          echo' <button style="   background: transparent;    border: none;"  type="submit" name="idArtikel" value="'.$alleBuecher[$i]['idArtikel'].'"><img class="bild3" style="z-index:10; width:140px; height: 180px;   "'; echo $s .  $alleBuecher[$i]['Titelbild']. $e ;  echo $a . $alleBuecher[$i]['Bezeichnung'] .$e.'  /></button>'; 

                    
                                  
                  } 
              echo '</div>';
              echo '</form>';
              echo '</div>';


            ?>

          </body>

            <script src="Kategorien/Buttons/Hilfsdokumente/js/jquery.min.js"></script>
            <script src="Kategorien/Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
</html>
     