<?php


 define('__ROOT__', __DIR__ .'/Kategorien/Buttons/Hilfsdokumente');
require_once(__ROOT__.'/AnzeigeArtikelinFinal.php');

 



 session_start();


    $Suche = new Suche();
    $Erg = $Suche->suche();
    

    //$Suche = new Suche_Artikel();

?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Finale Startseite</title>   
                            
            <link href="Kategorien/Buttons/Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Kategorien/Buttons/Hilfsdokumente/css/bootstrap-theme.min.css">
          <link rel="stylesheet" href="Kategorien/Buttons/Hilfsdokumente/css/FinalStyle.css">

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

                
                               <form action="Kategorien/Buttons/sucheV2.php" method="post"  class="navbar-form navbar-left "  >
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
              <div id="selector" role="tablist">
                  <div class="panel panel-default">
                     <div class="head" role="tab" id="VerlaufHead">

                         <div style="position:fixed; z-index: 100;  left:auto; margin-top:200px">
                                     <!--  Verlauf -->

                              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Verlauf" aria-controls="Verlauf" aria-expanded="false" data-parent="#selector"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true" ></span></button>

                          </div>
                     </div>

                     <div class="head" role="tab" id="EinkaufHead">                 

                          <div style="position:fixed; z-index: 100;  left:0px; margin-top:150px">
                                    <!--  Einkaufswagen  -->
                              <button class="btn btn-primary"  type="button" data-toggle="collapse" data-target="#Einkaufswagen" aria-controls="Einkaufswagen" aria-expanded="false" data-parent="#selector" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
                          </div>
                     </div>
                                    <!--  Kategorie -->
                     <div class="head" role="tab" id="KategorieHead">
                          <div style="position:fixed; z-index: 100;  left:0px; margin-top:100px">

                                  <button id="kategorie"  class="btn btn-primary"  type="button" data-toggle="collapse" data-target="#Kategorie" aria-controls="Kategorie" aria-expanded="false" data-parent="#selector" > <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                                  </button>
                            
                          </div>
                     </div>
                             <div class="collapse width" id="Verlauf" role="tabpanel" aria-labelledby="VerlaufHead">
                                 <div class="well" style="height:500px; width:200px;  margin-top:100px;  float:left; position:fixed; z-index: 99;"> <!-- Well rundet die Ecken ab -->
                                    <div Style=" margin-left:50px;  ">
                                      ...
                                           <br>Verlauf</br>
                                    </div>
                                 </div>
                               </div>

                        <div class="collapse width" id="Einkaufswagen" role="tabpanel" aria-labelledby="EinkaufHead" >

                                <div class="well" style="height:500px; width:200px;  float:left; margin-top:100px;  position:fixed; z-index: 99;"> <!-- Well rundet die Ecken ab -->
                                       
                                      <div Style="margin-left:50px; ">
                                        ...

                                               <!-- Well rundet die Ecken ab -->
                                      <font color="black">  <br>... hallo das ist ein Test Einkaufswagen</br></font>

                                      </div>
                                  </div>             
                         </div>

                         <div class="collapse width"  id="Kategorie" role="tabpanel" aria-labelledby="KategorieHead"  >
                                                    
                            <div class="well" style="height:500px; width:200px;  float:left; margin-top:100px; position: fixed; z-index: 99; "> <!-- Well rundet die Ecken ab -->
                                
                                <div Style="margin-left:50px;">
                                ...
                                 <br>Kategorie</br>
                                 </div>
                            </div>
                        </div>
         
   </div>
</div>  
                      <div class="row full-width-row" >
                          <div class="col-sm-12">  
                              <div class="format">
                                <div id='my-slider_head' class='carousel slide' data-ride='carousel' data-interval='20000' style="z-index: 200;" >
                                       
                                    <!-- Indikator dot nov -->   
                                    
                                          <ol class="carousel-indicators">
                                               <li data-target="#my-slider_head" data-slide-to="0" class="active"></li>  
                                               <li data-target="#my-slider_head" data-slide-to="1"></li> 
                                               <li data-target="#my-slider_head" data-slide-to="2"></li>
                                          </ol>                   
                                          <!-- wrapper for slides-->   
                                    
                                     <div class="carousel-inner" role="listbox">
                                     
                                         <div class="item active">  <!-- slide when we open the web page-->
                                     
                                                <img src="Kategorien/Buttons/Hilfsdokumente/Bilder/Tierbild.jpg"  alt="Tierbild"  />
                                                <div class="carousel-caption"> <!-- hier kann Text kommen-->
                                                
                                                </div>
                                          </div>  
                                          
                                          <div class="item">  <!-- slide when we open the web page-->
                                     
                                                <img src="Kategorien/Buttons/Hilfsdokumente/Bilder/Toilet.jpg" alt="Toilet"  />
                                                <div class="carousel-caption">
                                                
                                                </div>
                                          </div> 
                                          
                                          <div class="item">  <!-- slide when we open the web page-->
                                                <img src="Kategorien/Buttons/Hilfsdokumente/Bilder/Brisbane.jpg"  alt="Brisbane" />
                                                <div class="carousel-caption">  
                                                
                                                </div>
                                          </div>
                                     </div>
                                    
                                     <a class="left carousel-control" href="#my-slider_head" role="button" data-slide="prev">  
                                     
                                         <!--  width="150" height="250" die Rolle in Verbindung mit herf bedeutet, dass der Link als Button verwendet wird-->
                                         <!-- der Link mit herf 'my-slide' muss die gleiche bezeichnung besitzen wie oben die Carousel inner classe damit die slides wieder von vorne anfangen können.-->
                                         <!-- hierzu wird außerdem data-slide "prev" notwendig, preview bedeutet es fängt mit der ersten Folie wieder an. --> 
                                     
                                        <!-- controller or next and prev buttons      -->  
                                        
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                        
                                        <!-- sr-only = screen reader only-->
                                     </a>    
                                     
                                      <a class="right carousel-control" href="#my-slider_head" role="button" data-slide="next">  
                                      
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                       
                                     </a>
                                    </div>
                                </div>
                              </div>
                          </div>


                 <header class="carouselbuecher">

                      <div class="container">
                         <div class="row">
                            <div class="col-sm-12">  
                               <div class="format"> 

                                <div id='my-slider' class='carousel slide' data-ride='carousel' data-interval='15000'>
                                    <!-- Indikator dot nov -->   
                                    
                                          <ol class="carousel-indicators">
                                               <li data-target="#my-slider" data-slide-to="0" class="active"></li>  
                                               <li data-target="#my-slider" data-slide-to="1"></li> 
                                               <li data-target="#my-slider" data-slide-to="2"></li>
                                          </ol>                   
                                          <!-- wrapper for slides-->   
                                    
                                     <div class="carousel-inner" role="listbox">
                                      
                                         <div class="item active">  <!-- slide when we open the web page-->
                                     
                                           

                                            <div class='reihe'>
                                                  
                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                      
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                                   
                                             </div>
                                          </div>  
                                          
                                          <div class="item">  <!-- slide when we open the web page-->
                                     
                                              
                                                <div class='reihe'>


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                      
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />



                                               </div>
                                          </div> 
                                          
                                          <div class="item">  <!-- slide when we open the web page-->

                                                <div class='reihe'>
                                  
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                      
                                                   <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                           
                                              </div>
                                          </div>
                                     </div>

                                     <a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">  
                                     
                                         <!-- die Rolle in Verbindung mit herf bedeutet, dass der Link als Button verwendet wird-->
                                         <!-- der Link mit herf 'my-slide' muss die gleiche bezeichnung besitzen wie oben die Carousel inner classe damit die slides wieder von vorne anfangen können.-->
                                         <!-- hierzu wird außerdem data-slide "prev" notwendig, preview bedeutet es fängt mit der ersten Folie wieder an. --> 
                                     
                                        <!-- controller or next and prev buttons      -->  
                                        
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                        
                                        <!-- sr-only = screen reader only-->
                                     </a>    
                                     
                                      <a class="right carousel-control" href="#my-slider" role="button" data-slide="next">  
                                      
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                       
                                     </a>
                                    
                                    </div>

                                  </div>
                                </div>
                            </div>
                       </div>
                  </header>   


                 <header class="carouselbuecher">

                      <div class="container">
                         <div class="row">
                            <div class="col-sm-12">  
                               <div class="format"> 

                                <div id='my-slider2' class='carousel slide' data-ride='carousel' data-interval='15000' index-z='120'>
                                    <!-- Indikator dot nov -->   
                                    
                                          <ol class="carousel-indicators">
                                               <li data-target="#my-slider2" data-slide-to="0" class="active"></li>  
                                               <li data-target="#my-slider2" data-slide-to="1"></li> 
                                               <li data-target="#my-slider2" data-slide-to="2"></li>
                                          </ol>                   
                                          <!-- wrapper for slides-->   
                                    
                                     <div class="carousel-inner" role="listbox">
                                      
                                         <div class="item active">  <!-- slide when we open the web page-->
                                     
                                           

                                            <div class='reihe'>
                                                  
                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                      
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                                   
                                             </div>
                                          </div>  
                                          
                                          <div class="item">  <!-- slide when we open the web page-->
                                     
                                              
                                                <div class='reihe'>


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                      
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />

                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />



                                               </div>
                                          </div> 
                                          
                                          <div class="item">  <!-- slide when we open the web page-->

                                                <div class='reihe'>
                                  
                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                     <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Trudi_Canavan_Der_Wanderer.jpg"  alt="Trudi Canavan" />

                                      
                                                   <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Sebastian_Fitzek_Acht_Nacht.jpg" alt="Sebastian Fitzek" />


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />


                                                    <img id='bild3' src="Kategorien/Buttons/Hilfsdokumente/Bilder/002_Buchbilder/Brandon_Sanderson-Weg_der_Koenige_Scaliert.jpg"  alt="Brandon Sanderson - Der Weg der Koenige" />

                                              </div>
                                          </div>
                                     </div>

                                     <a class="left carousel-control" href="#my-slider2" role="button" data-slide="prev">  
                                     
                                         <!-- die Rolle in Verbindung mit herf bedeutet, dass der Link als Button verwendet wird-->
                                         <!-- der Link mit herf 'my-slide' muss die gleiche bezeichnung besitzen wie oben die Carousel inner classe damit die slides wieder von vorne anfangen können.-->
                                         <!-- hierzu wird außerdem data-slide "prev" notwendig, preview bedeutet es fängt mit der ersten Folie wieder an. --> 
                                     
                                        <!-- controller or next and prev buttons      -->  
                                        
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                        
                                        <!-- sr-only = screen reader only-->
                                     </a>    
                                     
                                      <a class="right carousel-control" href="#my-slider2" role="button" data-slide="next">  
                                      
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>
                                        <span class="sr-only">Previous</span>    
                                       
                                     </a>
                                    
                                    </div>
                                  </div>
                              </div>
                           </div>
                       </div>
                  </header>  

           <form action="http://localhost/Final/Kategorien/Buttons/Hilfsdokumente/Teste_Registrieren.php" method="post">
          <div class="container">          
                      <div class="row">
                      <div class="col-md-3">  
                      <div class="format">     
                                   <div class="modal" id="modal-2" >   
                                   <div class="modal-dialog modal-lg" style="margin-left:750px; margin-right: auto;" >                                         
                                   <div class="modal-content" style="width: 400px; "> 
                                   <!-- anfang-->
                                          <div class="modal-header"> 
                                                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>                                                             

                                                                        <h4>Registrieren</h4>                                         
                                          </div> 

                                          <div class="modal-body">   
                                          <div class="well">
                                          <div class="form-group row">
                                                                                            <label for="benutzername" class="col-2 col-form-label">Benutzername</label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="benutzername" name="benutzername"> 
                                                                   </div>
                                                                   </div>


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
                                                                                            <label for="email" class="col-2 col-form-label">E-Mailadresse </label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="email" name="email"> 
                                                                   </div>
                                                                   </div>


                                                                   <div class="form-group row">
                                                                                            <label for="DasPw" class="col-2 col-form-label"> Passwort </label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" type="password" id="DasPw" name="passwort">
                                                                    </div>                                                                         
                                                                    </div>

                                                                    <div class="form-group row">
                                                                                            <label for="DasPwAg" class="col-2 col-form-label"> Passwort </label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" type="password" id="DasPwAG" name="passwort_again">
                                                                    </div>                                                                                     
                                                                    </div>


                                                                    <div class="form-group row">
                                                                    <div class="col-10">
                                                                                            <button type="submit" class="btn btn-primary" style="float: left;">Registrieren</button>      
                                                                    </div>
                                                                    <div class="col-10">   <a href="" class="btn btn-default" data-dismiss="modal" style="float: left;" >Close</a>
                                                                    </div>
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



          <form action="http://localhost/Final/Kategorien/Buttons/Hilfsdokumente/login.php" method="post">
          <div class="container">          
                      <div class="row">
                      <div class="col-md-3">  
                      <div class="format">     
                                   <div class="modal" id="modal-1">   
                                   <div class="modal-dialog modal-lg" style="margin-left: 750px; margin-right: auto;" >                                         
                                   <div class="modal-content" style="width: 400px; "> 
                                 
                                   <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                   <div class="panel panel-default">
                                        <div class="modal-header"> 
                                        <div role="tab" id="ueberschriftEins">
                                                                     
                                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <div style="float: left; margin-left: 20px; margin-right: 20px">
                                                                              
                                                         <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseAnmelden" aria-expanded="true" aria-controls="collapseAnmelden">
                                                             <h4> Anmelden </h4>  
                                                         </a>                                                                                                
                                                        </div>                                     
                                       </div>   
                                        <div  role="tab" id="ueberschriftZwei">                                                                       
                                                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEMail" aria-expanded="false" aria-controls="collapseEMail" >
                                                                <h4> Passwort vergessen? </h4>  
                                                           </a>                                                                                           
                                        </div>                                                                    
                                                                                                                        
                                     </div> <!-- modal Header-->
                                   <div class="modal-body">
                                                   <div id="collapseAnmelden" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="ueberschriftEins">
                                             <!--      <div class="panel-collapse collapse in"  id="collapseAnmelden" role="tabpanel" aria-labelledby="ueberschriftEins">  -->   
                                                   <div class="well">
                                                                   <div class="form-group row">
                                                                                            <label for="login" class="col-2 col-form-label"> Benutzername oder E-Mailadresse </label>
                                                                   <div class="col-10">
                                                                                            <input class="form-control" id="login" name="benutzername"> 
                                                                   </div>
                                                                   </div>  

                                                                    <div class="form-group row">
                                                                                            <label for="passwort" class="col-2 col-form-label"> Passwort </label>
                                                                    <div class="col-10">
                                                                                            <input class="form-control" type="password" id="passwort" name="password">
                                                                    </div>                                                                                     
                                                                    </div>

                                                                    <div class="form-group row">
                                                                    <div class="col-10">
                                                                                            <button type="submit" class="btn btn-primary" style="float: left;">Anmelden</button>      
                                                                    </div>
                                                                    <div class="col-10">   <a href="" class="btn btn-default" data-dismiss="modal" style="float: left;" >Close</a>
                                                                    </div>                                                
                                                                    </div>  
                                                    </div> 
                                                           <div id="collapseEMail" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ueberschriftZwei">
                                                           <!-- <div class="collapse" id="collapseEMail"  role="tabpanel" aria-labelledby="ueberschriftZwei"> -->
                                                                   <div class="well">
                                                                        
                                                                             <div class="form-group row">
                                                                                          <label for="emailsenden" class="col-2 col-form-label"> Benutzername oder E-Mailadresse </label>
                                                                             <div class="col-10">
                                                                                          <input class="form-control" id="emailsenden" name="email">
                                                                             </div>
                                                                             </div>

                                                                             <div class="form-group row">
                                                                             <div class="col-10">   

                                                                                          <button type="submit" class="btn btn-primary" style="float: left;">E-Mail senden</button>  
                                                                             </div>
                                                                             </div>
                                                                        
                                                                    </div>
                                                            </div>                                                                           
                                   </div> <!-- modal body -->                                                      
                                 
                                          </div><!-- Panel Default-->
                                          </div><!-- Accordion Ende-->                                     
                                    
                                    </div><!-- modal content -->                                          
                                    </div><!-- modal dialog-->
                                    </div> <!-- modal -->                                      
                       </div>
                       </div>
                       </div>              
         </div>     
         </form>

     </body>  
            
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
    <script src="Kategorien/Buttons/Hilfsdokumente/js/jquery.min.js"></script>
     <script src="Kategorien/Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
     
 

     <script type="text/javascript">
     $(document).ready(function(){

        $(".btn-success").click(function(){
              $(".collapse").collapse('show'); 
         });

      }); 

    </script>   
   

</html>