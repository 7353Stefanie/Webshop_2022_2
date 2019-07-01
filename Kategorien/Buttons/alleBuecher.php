<?php

 session_start();


function switchit($Details, $Kaufarten)
{
 // var_dump($Erg);
   $s = 'src="'; $e = '"';  $a = 'alt="';$i = 0; 


switch ($Details['Kategorien']) {
    case 'Buecher':

          echo' <button style="   background: transparent;    border: none;"  type="submit" name="idArtikel" value="'.$Details['idArtikel'].'"><img class="bild3" style="z-index:10; width:140px; height: 180px;   "'; echo $s . $Details['Artikelbild']. $e ;  echo $a . $Details['Bezeichnung'] .$e.'  /></button>'; 

    break;


    case 'Kleidung':                     
                                                                    
                      echo'<div class="" style="border-width: 1px; text-align:center; border-style: solid; border-radius: 4px; float:left; padding-left:20px; border-color:black; margin-bottom:10px;  margin-top:10px; margin-right:20px; padding-right:20px; padding-top: 20px; padding-bottom:20px;">';

                      echo'<button style="   background: transparent;  color: white;  border: none; "  type="submit" name="idArtikel" value="'.$Details['idArtikel'].'"><img style="margin-top:10px; z-index:10; width:180px; height: 170px;   "'; echo $s . $Details['Artikelbild']. $e ;  echo $a . $Details['Bezeichnung'] .$e.'  /></button>
                                                    
                       <div style="">'; 
                      echo '</br> Tauschpreis: <b>'. $Kaufarten['0']['Preis']/100 .' € </b> </br> Kaufpreis: <b>'. $Kaufarten['1']['Preis']/100 .' €</b> </br> </br>Groesse: '.$Details['Groesse'].' </br> Marke: ' . $Details['Marke'].'</div></div>';

    break;

                    }
  }

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
                                                           echo   '<li><a href="Kategorien/Buttons/ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="Kategorien/StartseitenAnmeldung.php">';
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
               $alleBuecher =  $_SESSION['AlleBuecher'];

               $Kaufarten =  $_SESSION['Kaufarten']; 
               //var_dump($alleBuecher);

              echo' <div class="extra container-fluid">
                        <div class="UeberschriftKategorie">';

                if(  $alleBuecher['0']['Kategorien'] == 'Kleidung') // Bücher
                  { echo 'Kleidung';}

                  if(  $alleBuecher['0']['Kategorien'] == 'Buecher') 
                  {
                    echo 'Bücher';
                  }

              echo' </div> 
                    </div> ';
            

              echo '<div style="float:left; width: inherit; height:270px;">';
              echo '<form action = "Hilfsdokumente/SucheUndAnzeige.php" method="post" >'; 

              $z = 0;
              echo '<div class="" style="float:left; margin-left:10px;">';
                foreach($alleBuecher as $key)
                  { 
                    //var_dump($key);
                    switchit($key,  $Kaufarten[$z] );  
                    $z++;                  
                  } 
              echo '</div>';
              echo '</form>';
              echo '</div>';


            ?>

          </body>

            <script src="Kategorien/Buttons/Hilfsdokumente/js/jquery.min.js"></script>
            <script src="Kategorien/Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
</html>
     