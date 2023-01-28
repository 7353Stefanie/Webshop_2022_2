<?php


require_once(__DIR__.'/hintergrundSuche.php');
require_once(__DIR__.'/Hilfsklasse.php');

session_start();

  ?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Benutzerseite</title>                             
           

            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
             <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap.css">
              <link rel="stylesheet" href="Hilfsdokumente/css/StyleSuche.css"> 
        
             
       <header> 
                  <nav class="navbar navbar-default ">
                        <div class="extra2 container-fluid"><!-- padding: 15px 15px 25px 15px; -->
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

                
                               <form action="sucheV2.php" method="post" style="padding-top: 0px;" class="navbar-form navbar-left "  >
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
                                          
                                                  if(isset($_SESSION['benutzername']))
                                                  {  
                                                           echo   '<li><a href="ArtikelAuswahl.php">';
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
                                                  '<li><a href="../StartseitenAnmeldung.php">Warenkorb</a></li>';
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
                                              <?php
                                              if(isset($_SESSION['benutzername']))
                                                  { '<li><a href="Buttons/Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> ';
                                              }
                                              ?> 

                                        </ul>
                         </div><!-- /.container-fluid -->
                      </nav>
            </header>
  </head>  
  <body>
    <?php

    $Suche = new Suche_Artikel();
    $ArtikelAllg = Array();
    $Hilfsmethode = new Hilfsklasse();



    if($_POST!=null)
    {
      $_SESSION['Kategorie'] = $_POST['Kategorie'];
      $_SESSION['suchen'] = $_POST['suchen'];
    }

    //$Erg = $Suche->suche($_POST['Kategorie'] ,$_POST['suchen'],$_POST['suchen']);

    //var_dump($_POST);

    $erg = Array();
    if($erg != '')
    {$erg = $Suche->suche_allg($_SESSION['Kategorie'] ,$_SESSION['suchen']);}

  //var_dump($erg);
 /* else{

    '<div class="alert alert-info alert-dismissible">Preis
  <button type="button" class="close" data-dismiss="alert" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
  <strong>Hinweis!</strong> Bitte gebe einen Suchbefehl ein
</div>';

   gemerkteArtikeldP
  }*/
 // var_dump($erg);

  if(!is_null($erg) )
  {


    $anzPosArtikel =   $Hilfsmethode->array_Key_count($erg,'Kategorien'); // Gibt die Array Positionen aus in denen Kategorie vorkommt
    $anzPosKleidung =  $Hilfsmethode->array_Key_count($erg,'idKleidung');
    $anzPosStatus =    $Hilfsmethode->array_Key_count($erg,'Verfuegbarkeitsstatus');// evtl. nicht notwendig
    $anzPosKosten =    $Hilfsmethode->array_Key_count($erg,'Preis');

}



/*if($AnzahlArtikel!= null)
{$ArtikelArray = ( array_slice($erg, 0, $AnzahlArtikel, true));// schreibt alle Artikel von 0 bis x in ein Array; Artikel


$KleidungArray = ( array_slice($erg, $AnzahlArtikel, $Kleidung, true)); // Kleidung

$StatusArray = ( array_slice($erg, $Kleidung+$AnzahlArtikel, $Verfuegbarkeitsstatus, true));

$KaufartenArray = ( array_slice($erg, $Verfuegbarkeitsstatus+$Kleidung+$AnzahlArtikel, $Kaufarten, true));
}*/




//var_dump(array_count_values($erg['0']));


                    $s = 'src="'; $e = '"';  $a = 'alt="';$i = 0;                  
                    
                  //  var_dump($erg);

                if($erg != "")
                 { // Bildpfade im Ergebnis
                  
                  echo '<div class="extra container-fluid">
                  <form action = "Hilfsdokumente/AusgabeAlleBuecher.php" method="post" > 
                    <div class="UeberschriftKategorie">
                      <button type="submit" name="Kategorie" value="Buecher" style="background-color:black; border-color:black;"href="alleBuecher.php">Bücher</button>
                    </div>   
                  </form>';
                  echo '<form action = "ArtikelDetailsVerkauf.php" method="post" >';   
                     $x = 0;   

                   echo  '<div class="groesse">
                           <div class="row full-width-row" >
                            <div class="col-sm-12">  
                              <div class="format">
                                <div id="my-slider" class="carousel slide" data-ride="carousel" data-interval="false" style="z-index: 200; margin-bottom:-20px;" >';

                                // nach 8 Büchern soll das slide wechseln
                               

                                $durchgaenge =0;
                                $AnzahlVKPos =0;                                
                                $ArtikelArray = Array();
                                                         
                          

                                $ac =     array_column($erg, 'Kategorien');

                                // var_dump($ac);

                               $AnzahlValues= array_count_values($ac);
                              // echo ($AnzahlValues['Buecher'] );

                              // var_dump($AnzahlValues); // ["Buecher"]=> int(3) ["Kleidung"]=> int(2) }

                                 if(array_key_exists('Buecher',$AnzahlValues))                                  
                                 {
                                   $anzahlSlider = $AnzahlValues['Buecher']/8;

                                   
                                     echo '<ol class="carousel-indicators">';

                                         if($anzahlSlider > 0 )
                                         {
                                          echo '<li data-target="#my-slider" data-slide-to="0" class="active"></li>'; 
                                         }

                                         for($y = 1; $y <= $anzahlSlider;$y++ )                                          

                                          {                                                
                                              echo' <li data-target="#my-slider" data-slide-to="'.$y.'"></li>';                                               
                                          }

                                     echo '</ol>';
                                     $durchgaenge =0;

                                    echo' <div class="carousel-inner" role="listbox">  ';              
                                    echo '  <div class="item active" style="margin-left:100px;">  <!-- slide when we open the web page-->';
                                    $q = 0;
                                  }

                                    /*

                                        $anzPosArtikel =   $Hilfsmethode->array_Key_count($erg,'Kategorien');
    $anzPosKleidung =  $Hilfsmethode->array_Key_count($erg,'idKleidung');
    $anzPosStatus =    $Hilfsmethode->array_Key_count($erg,'Verfuegbarkeitsstatus');// evtl. nicht notwendig
    $anzPosKosten =    $Hilfsmethode->array_Key_count($erg,'Preis');

*/
   //var_dump($anzPosArtikel);
   // var_dump($erg);
                                         //   echo $erg[$anzPosArtikel['0']]['Kategorien'];
    
                                 for($i = 0; $i<count($anzPosArtikel) ;$i++)
                                        {

                                          $durchgaenge++;
                                          if($durchgaenge > 8)
                                          {
                                            echo $i;
                                             echo' </div> '; 
                                             echo ' <div class="item" style="margin-left:100px;" >  <!-- slide when we open the web page-->';
                                             $durchgaenge = 0;
                                          }
                                          

                                              if( $erg[$anzPosArtikel[$i]]['Kategorien'] == 'Buecher') // wenn bücher dann das ausgeben
                                                {                                    
                                                echo' <button style="   background: transparent;  color: black;  border: none;"  type="submit" name="idArtikel" value="'.$erg[$i]['idArtikel'].'"><img class="bild3" style="z-index:10; width:140px; height: 180px;" src="'. $erg[$anzPosArtikel[$i]]['Titelbild'].'" alt="'. $erg[$anzPosArtikel[$i]]['Bezeichnung']. '"  ></button>';  

                                               //S <img src="dummy-1.jpg" alt="Spaß in der Sonne"></button></li>
                                                }  
                                               
                                                echo $durchgaenge;
                                           // $anzPosArtikel++;                                             
                                        } 
                                
                                    
                                   echo'  </div>
                                    
                                     <a class="left carousel-control" style="width: 40px;" href="#my-slider" role="button" data-slide="prev">    
                                        
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                        
                                        <!-- sr-only = screen reader only-->
                                     </a>    
                                     
                                      <a class="right carousel-control" style="width: 40px;" href="#my-slider" role="button" data-slide="next">  
                                      
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                       
                                     </a>
                                    </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            </div>

                          </div> </form>' ;

                            

                  echo '<div class="extra container-fluid">

                        <form action = "Hilfsdokumente/AusgabeAlleBuecher.php" method="post" > 
                          <div class="UeberschriftKategorie">
                              <button type="submit" name="Kategorie" value="Kleidungen" style="background-color:black; border-color:black;" href="alleKleidungen.php">Kleidung</button>   
                          </div> </form>';  

                           if($erg !=null && array_key_exists('Kleidung',$AnzahlValues))

                            {

                   echo '<form action = "ArtikelDetailsVerkauf.php" method="post" >';                          

                   echo   ' <div class="groesse">
                            <div class="row full-width-row" >
                            <div class="col-sm-12">  
                              <div class="format">
                                <div id="my-slider_head" class="carousel slide" data-ride="carousel" data-interval="false" style="z-index: 200;" >';
                               
                                $v =0;
                                $p = 0;
                                   
                             
                                  $anzahlSlider = $AnzahlValues['Kleidung']/7;    

                                     echo ' <ol class="carousel-indicators">';

                                         if($anzahlSlider > 0 )
                                         {
                                          echo '<li data-target="#my-slider_head" data-slide-to="0" class="active"></li>'; 
                                          $p++;
                                         }

                                      for($y = 1; $y <= $anzahlSlider;$y++ )
                                          {                                                
                                              echo' <li data-target="#my-slider_head" data-slide-to="'.$y.'"></li>';  
                                              $p++;                                             
                                          }
                                          //echo $p;

                                     echo '</ol>';
                                     $durchgaenge =0;

                                    echo' <div class="carousel-inner" role="listbox">  ';              
                                    echo '  <div class="item active" style="margin-left:120px;margin-bottom:120px;" >  <!-- slide when we open the web page-->';
                                   echo '';
                                   

                                    
                                  
                                   //pos 5 und 6

                                    $listeKleidung = $Hilfsmethode->splitteEinenTeilInEineListe($erg, $anzPosKleidung);

                                    $listeArtikel = $Hilfsmethode->splitteEinenTeilInEineListe($erg, $anzPosArtikel);
                                    
                                    $listeVerkaeuferpos = $Hilfsmethode->splitteEinenTeilInEineListe($erg,  $anzPosStatus);

                                    $listeKosten = $Hilfsmethode->splitteEinenTeilInEineListe($erg,  $anzPosKosten);

                                    // ermittel die Position der idVerkaeuferposition von idArtikel $i

                                  

                                  

                                 for($i = 0; $i<count($listeArtikel) ;$i++)
                                        { #



                                            $durchgaenge++;

                                                   if($durchgaenge > 6)
                                                {
                                                   echo' </div> '; 
                                                   echo ' <div class="item" style="margin-left:120px; margin-bottom:120px;" >  <!-- slide when we open the web page-->';
                                                   
                                                   $durchgaenge = 0;                                                   
                                                }                                     
                                                                                             
                                            if( $listeArtikel[$i]['Kategorien'] == 'Kleidung') // wenn bücher dann das ausgeben
                                                {                                                 
                                                    

                                                    echo'<div class="" style="border-width: 1px; text-align:center; border-style: solid; border-radius: 4px; float:left; padding-left:20px; border-color:black; margin-bottom:10px;  margin-top:10px; margin-right:20px; padding-right:20px; padding-top: 20px; padding-bottom:20px;">';

                                                    echo'<button style="   background: transparent;  color: white;  border: none; "  type="submit" name="idArtikel" value="'.$listeArtikel[$i]['idArtikel'].'"><img style="margin-top:10px; z-index:10; width:180px; height: 170px;   "'; echo $s . $listeArtikel[$i]['Titelbild'] . $e ;  echo $a . $listeArtikel[$i]['Bezeichnung'] .$e.'  /></button>
                                                    
                                                    <div style="">'; 



                                                    

                                                            // gebe die Daten aus den Listen aus wenn die $idArtikel = $i ist

                                                    //1. suche die idVerkaeuferposition zu $idArtikel
                                                    //2. suche die Position von listeKleidung wenn $idArtikel = $i ist
                                                    //3. suche die Position von listeKosten wenn die $iVerkaeuferposition = $z ist


                                                    $PositionId = $Hilfsmethode->findeDiePositionInDerListe($listeVerkaeuferpos, $listeArtikel[$i]['idArtikel']);
                                                    //gibt den wert aus an deren Stelle sich die gesuchte Variable befindet
                                                    $PositionId = $PositionId['0'];
                                                    //var_dump($PositionId);     
                                                  


                                                  $PositionIdKosten = $Hilfsmethode->findeDiePositionInDerListe( $listeKosten,$listeVerkaeuferpos[$PositionId]['idVerkaeuferposition']);

                                                   $PositionKleidung = $Hilfsmethode->findeDiePositionInDerListe( $listeKleidung,$listeArtikel[$i]['idArtikel']);
                                              
                                              
                                                

                                                   // echo '</br> Bezeichnung:  <b>'. $listeArtikel[$i]['bezeichnung'].'</b>
                                                    echo'</br> Tauschpreis: <b>'. $listeKosten[$PositionIdKosten['0']]['Preis']/100 .' € </b> </br> Kaufpreis: <b>'.$listeKosten[$PositionIdKosten['1']]['Preis']/100 .' €</b> </br> </br>Groesse: '. $listeKleidung[$PositionKleidung['0']]['Groesse'].' </br> Marke: ' . $listeKleidung[$PositionKleidung['0']]['Marke'].'</div></div>';
                                                 
                                                  }                                                 
                                                  
                                          
                                        } //ende if


                                       
                                        
                                   echo'  </div>
                                    
                                     <a class="left carousel-control" style="width: 40px;" href="#my-slider_head" role="button" data-slide="prev">    
                                        
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                      
                                     </a>    
                                     
                                      <a class="right carousel-control"  style="width: 40px;" href="#my-slider_head" role="button" data-slide="next">  
                                      
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                       
                                     </a>
                                    </div>
                                </div>
                              </div>
                            </div>
                            </div>
                           
                             ';

                          echo'</form>';
                        }
                          echo'  </div>' ;    
                          } 
                                             
                       
                           ?> 
      

    </body>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <script type="text/javascript">
      
       $(document).ready( function() {



        /*

$(".bild3").on('click', function(){

 
  id = this.id ;

 
  alert (id);


      $.ajax({
           type: "POST",
           url: 'ArtikelDetailsVerkauf.php',
           data:{ idArtikel : id },
           success:function(html) {
             //alert(html);
           }

      });
 });


*/

       });

    </script>
    </html>

