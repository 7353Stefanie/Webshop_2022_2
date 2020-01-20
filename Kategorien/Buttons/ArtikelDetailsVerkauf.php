
<?php
 define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/');
 require_once(__ROOT__.'Hilfsdokumente/SucheUndAnzeige.php');

 session_start();

 $Anzeige = new Anzeige();
 $Sammlung =  $Anzeige->Sammlung();

 $gemerkteArtikel = $Anzeige->gemerkteArtikel();     


$Erg       = $Anzeige->Erg(); // ERgebnis Artikeldetail
$Artikel   = $Anzeige->gesamteArtikel();

 $AnzArtikel = count($Artikel);

 var_dump($Erg);
 echo '---- ende Erg---';
 var_dump($Artikel);
 echo '---- ende Artikel---';
 var_dump($Sammlung);
 echo '---- ende Sammlung---';
 var_dump($Anzeige);




function switchit($Kategorie,$Artikel, $Erg)
{

   

switch ($Kategorie) {
    case 'Buecher':

             echo'    <div class="ueberschrift" >

                        <div class="row">
                              <div class="col-md-2 BildAbstand">
                                 <div id="Vorschau"> 
                                     <img id="Vorschaubild2" class="media-object VorschaubildFormat " style=" margin-right: 20px;height:365px; width:250px;" src="'.$Artikel['Titelbild'].'"  alt='.'"'.$Artikel['Bezeichnung'] .'" >';
                             
                            echo'     </div> 
                              </div>                             

                          <div class="col-md-5 InhaltBuecher" >
                            
                             <div class="inhalt">';
                            

                              echo "<h5>". $Artikel['Bezeichnung']."</h5>". $Erg['0']['Autor'].", " .$Erg['0']['Erscheinungsjahr']. "</br></br></br>" ;
                              echo '<div class="row" >';
                               echo "<div class='col-sm-1 ArtikelInhalte' > <b class='color'> ISBN:</b></div>";
                               echo "<div class='col-sm-1 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['ISBN']."</div></div>";
                               echo '<div class="row">';
                                echo "<div class='col-sm-1 ArtikelInhalte' > <b class='color'>Genre:</b></div>";
                               echo "<div class='col-sm-1 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['Genre']."</div></div>";
                               echo '<div class="row">';
                                echo "<div class='col-sm-1 ArtikelInhalte' > <b class='color'>Seitenanzahl:</b></div>";
                               echo "<div class='col-sm-1 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['Seitenanzahl']."</div></div>

                            </div>             
                        </div><!-- col 4-->";

                       echo'  <div class="col-md-5 Kurzbeschreibung">
                                 
                                     <h4 class=" mittig"> Kurzbeschreibung </h4>';
                                     echo $Erg['0']['Kurzbeschreibung'];

                            echo'     </div> 
                              
                     </div> <!-- row-->
                    </div>';
      # code...
      break;

    case 'Kleidung':

            echo'    <div class="ueberschrift" >
                        <div class="row">
                              <div class="col-md-3" style="margin-right:25px;" > ';


                             echo'  <div id="effekt" >
                                      <div id="Vorschau" >  
                                          <div id="lupen"style="margin-top:50px;margin-left:80px;background-image: url( '.$Artikel['Titelbild'].' );">
                                       
                                         <div id="lupe" ></div>
                                          </div>
                                        
                                     <img id="Vorschaubild" class=" media-object VorschaubildFormat " src="'.$Artikel['Titelbild'].'"  alt='.'"'.$Artikel['Bezeichnung'] .'" >
                                    </div> 
                                    </div>   ';
                                 
                             
                          echo'     </div>  
                                <div class="my-col" style="margin-right:5px; margin-left:55px;  " >   
                                  <div class=" col-xs-2 col-sm-2 col-md-2 outerContent" style="height:75px;width:100px; margin-top:20px;float:left; ">                                   
                                                  <a  href="#" title="...">                
                                                     <div class="innerContent" name="'.$Artikel['Kategorien'].'" id='.  $Artikel["Titelbild"].' style=" background-image: url( '.$Artikel["Titelbild"].')"></div>             
                                                 </a>                 
                                    </div>'; 
                                    $y =0;

                                    //


/*
                                  if($Verkaeuferbild != '')
                                    { 
                                      $anzahl = count($Verkaeuferbild['0']);
                                     // echo $anzahl;

                                      for($i = 0; $anzahl > $i; $i++) 
                                     {
                                        
                                     echo'  <div class=" col-xs-2 col-sm-2 col-md-2 outerContent" style="height:75px;width:100px; margin-top:20px; float:left;">                                   
                                                  <a  href="#" title="...">                
                                                     <div class="innerContent" name="Titelbild" id='.  $Verkaeuferbild['0'][$y]["Verkaeuferbild"].' style=" background-image: url( '. $Verkaeuferbild['0'][$y]["Verkaeuferbild"].')"></div>             
                                                 </a>                 
                                        </div>';
                                        $y++;
                                     }

                                    }    
                                    */                
                             echo'   </div> 

                              <div class="col-md-10 InhaltKleidung"   >                           
                                   <div class="inhalt" >';

                                        echo "<h4><b class='color'>". $Erg['0']['Bezeichnung']."</b></h4>". $Erg['0']['Marke']."</br></br></br>" ;
                                         echo '<div class="row" >';
                                         echo "<div class='col-sm-1 ArtikelInhalte' > <b class='color'>Groesse:</b></div>";
                                         echo "<div class='col-sm-4 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['Groesse']."</div></div>";
                                        echo '<div class="row" >';
                                         echo "<div class='col-sm-1  ArtikelInhalte' > <b class='color'>Farbe:</b></div>";
                                         echo "<div class='col-sm-1 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['Farbe']."</div></div>";
                                         echo '<div class="row">';
                                         echo "<div class='col-sm-1  ArtikelInhalte ' > <b class='color'>Geschlecht: </b></div>";
                                         echo "<div class='col-sm-1 col-md-offset-3 ArtikelInhalteFormat' >" .$Erg['0']['Geschlecht']."</div></div>

                              </div>   
                          </div> <!-- row-->
                    </div>
                   </div>";
                 
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
             
            <!-- <link rel="stylesheet" href="willkommenStyle.css"> -->

             
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="Hilfsdokumente/css/Komprimierung.css">
            <link rel="stylesheet" href="Hilfsdokumente/css/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/css/Bilder.css">
    
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
                                            <a class="navbar-brand" href="../../Final.php">Brand</a>
                                          </div> 

                                          
                           <!-- die Suche  -->                     <!-- das obere ermöglicht bei einer kleineren Sicht die Verschiebung der Buttons. -->   
                            <div class="row">  
                              <div class="col-xs-7 col-md-7">
  
                  
                               <form action="sucheV2.php" method="post" class="navbar-form navbar-left ">
                                        <span >                                                                 
                                                                            <select  style="float: left; width: 150px; margin-right: 10px;" name="Kategorie" class="form-control" id="einfaches-addon1" >
                                                                              
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

                                            <div class="form-group" >
                                              <input type="text" class="form-control" placeholder="Search" name="suchen" style="width: 25em; display: flex;">
                                            </div>
                                          <button type="submit"  class="btn btn-default"> Suchen</button>
                               </form>                             
                             </div>  
                                                            <!-- Collect the nav links, forms, and other content for toggling -->
                              
                            <div class="col-sm-4 col-md-4" >
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  
                                               
                                       <ul class="nav navbar-nav navbar-right">                                      

                                           <?PHP
                                          
                                                  if(isset($_SESSION['benutzername']))
                                                  {                                                                                                        
                                                           echo   '<li><a href="..//StartseitenAnmeldung.php">';
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
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Optionen<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                  
                                                  <li><a href="Hilfsdokumente/Warenkorb.php">Warenkorb</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li>       

                                        </ul>
                                </div> <!--md4-->
                              </div> <!-- row-->
                            </div><!-- /.navbar-collapse -->
                         </div><!-- /.container-fluid -->
                      </nav>
            </header>

  </head> 
  <body>
     <?php 
        
          

//var_dump($Artikel['Kategorien'],$Artikel, $Erg);
          //var_dump($Artikel); 

           switchit($Artikel['Kategorien'],$Artikel, $Erg);
      ?>



       <div class="Verkaeufer" style="width:auto; height:auto; min-height: 188px; margin-left: 15px;margin-top: 20px; margin-bottom: 20px; margin-right:15px; border-width: 1px; border-style: solid; border-radius: 4px;">
        <div  style=" padding-top: 10px; font-style: bold;">
          
          
          <table style="width: 100%; " >
            <tr style="height: 50px">
               <th style="padding-left:20px;">
              Bild
              </th>
              <th>
               Verkäufer
              </th>
              <th>
                 Kosten                                
              </th>             
               <th>
                 Zustand
              </th>  
              <th>
                 Artikelbeschreibung
              </th>            
                <th>
             
              </th>              
            </tr>
 <?php

 $AnzahlDerArtikelImWarenkorb = 0; 
//var_dump($Artikel);   

$laeufer = 0;      
         
if($Sammlung != null)
        {  
          if(isset($_SESSION['idBenutzer'])) 
              {$benutzergesetzt = 1;}  //gesetzt
          else{$benutzergesetzt = 0;}//nicht gesetzt

          
            // var_dump($Sammlung['0']);
              $Anza = count($Sammlung['0'])  ; 
            // echo $Anza; 
            // echo 'Anzahl';   



             
                for($z = 0; $z < $Anza; $z++)
                  {

                    while(  boolval (  array_key_exists( $laeufer, $Sammlung['0'] ))  != true  ):
                   
                                   $laeufer++;                       
                    endwhile; 

                    $laeufer2 = $laeufer;
                     $laeufer++;

                   // echo $laeufer; 
                              

                            if($Sammlung['0'][$laeufer2] != null)
                            {                             
                                      

                                echo '<tr class="border">';  

                                echo '<td style="width:17%;">';
                                if($Artikel['Kategorien'] == 'Buecher')
                                {
                                echo ' <img class="Miniaturbild" style="  padding-top: 20px;  padding-left:20px; padding-bottom: 20px;" src= "'.$Artikel['Titelbild'].'" alt="'.$Artikel['Bezeichnung'] .'">' ;  
                                }
                                if($Artikel['Kategorien'] == 'Kleidung')
                                {
                                   echo ' <img class="Miniaturbild_Kleidung" style="  padding-top: 20px;  padding-left:20px; padding-bottom: 20px;" src= "'.$Artikel['Titelbild'].'" alt="'.$Artikel['Bezeichnung'] .'">' ;  
                                }
                                echo '</br><a style="font-size:12px; color: #4863a0; margin-left:20px;" href=""> weitere Bilder'; 
                             

                                //  var_dump($Sammlung[$z]['0']);
                                  
                              }// ende if
                                  
                                  echo '</td>';

                                  echo '<td style="font-weight: bold; width:10%;">';
                                  echo $Sammlung['0'][$laeufer2]['1']['Benutzername'];
                                  echo '</td>';

                                  echo '<td style="width:14%;">';
                                  echo '<br>';

                                  if($Sammlung['0'][$laeufer2]['0']['0']['Kaufarten'] == 'Tauschwert')
                                   {
                                     echo '<b>'.$Sammlung['0'][$laeufer2]['0']['0']['Kaufarten'].' : '.$Sammlung['0'][$laeufer2]['0']['0']['Preis']/100 .'€ </b>';
                                     echo '<h6 >inkl. Versand </h6>';
                                   }
                 

                  if($Sammlung['0'][$laeufer2]['0']['1']['Kaufarten'] == 'Restwert')
                   {
                    echo '<b>'.'Kaufwert ';
                    echo ' : '.$Sammlung['0'][$laeufer2]['0']['1']['Preis']/100 . '€ </b>'; 
                    echo '<h6>zzgl. Versand '.$Sammlung['0'][$laeufer2]['0']['0']['Preis']/100 .'€ </h6>';                    
                    }

                    echo '</td>';                    
                    echo '<td style=" width:13%;">';

                    echo '<class="cd" style="font-weight: bold; ">'.$Sammlung['0'][$laeufer2]['Zustand'] ;

                    echo '</td>';
                    echo '<td style="width:30%;"><h5>';
                    echo $Sammlung['0'][$laeufer2]['Artikelbeschreibung'];
                    echo '</h5></td>';

                    echo '<td style="text-align:left; width:20%;">';
                   // echo $Sammlung[$z][$w]['idVerkaeuferposition'];


                    echo '<div id="sofortKaufW'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'W'.$benutzergesetzt.'" class="EMSK" > <span style="margin-right:10px; margin-bottom:15px; "class="glyphicon glyphicon-euro" aria-hidden="true"> </span>Sofort kaufen</div>';
                     

                    echo '<div class="popup"><span class="popuptext" id="myPopup">Der Artikel wurde erfolgreich in Ihren Warenkorb übernommen und liegt dort eine Stunde für Sie bereit.</span><div id="EinkaufswagenW'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'W'.$benutzergesetzt.'"  class="EMSK"> <span style="margin-right:10px; margin-bottom:15px;  "class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>in den Warenkorb </div></div>';

                     $u = 0;
                     if( $gemerkteArtikel != null)
                    {   
                      $ArtikelAnzahl2 = count($gemerkteArtikel);

                   /*   var_dump($Sammlung[$z][$w]['idVerkaeuferposition'] );
                      var_dump($gemerkteArtikel[0]['idVerkaeuferposition'] );*/

                            for($v = 0; $v < $ArtikelAnzahl2 ; $v++ )
                          {
                             
                            if( $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] == $gemerkteArtikel[$v]['idVerkaeuferposition'] )
                             {
                             echo '<div id="MerkenW'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'W'.$benutzergesetzt.'" class="EMSK"> <span id="2Farbe'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'" style="margin-right:10px; color: red; margin-bottom:15px;  "class="glyphicon glyphicon-heart" aria-hidden="true"></span>Merken</div>';
                             }
                             else{
                                     $u++;  
                                 }
                          }  


                          if($u == $ArtikelAnzahl2)   
                             {
                                      echo '<div id="MerkenW'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'].'W'.$benutzergesetzt.'" class="EMSK"> <span id="Farbe'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'" style="margin-right:10px; margin-bottom:15px;" class="glyphicon glyphicon-heart" aria-hidden="true"></span>Merken</div>';
                             }                                      
                  }
                  else
                  {
                   echo '<div id="MerkenW'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'W'.$benutzergesetzt.'" class="EMSK"> <span id="Farbe'. $Sammlung['0'][$laeufer2]['idVerkaeuferposition'] .'" style="margin-right:10px; margin-bottom:15px;" class="glyphicon glyphicon-heart" aria-hidden="true"></span>Merken</div>';
                  }

                    echo '</td>';

                }// ende if

               //ende for          
            }// ende for
          //

          else
          {
              $AnzahlDerArtikelImWarenkorb++;
          }

           echo' </tr>';
            
          echo '</table>';

          if($AnzahlDerArtikelImWarenkorb >0)
           {
            echo  '<h4 style="color:grey; margin-left:20px; margin-top:50px;"> Leider sind alle Verfügbaren Artikel im Warenkorb anderer Kunden. Versuchen Sie es Bitte später nocheinmal!</h4>';
           } 

           ?> 
       </div>


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
                                                                                            <input class="form-control" id="benutzername"  name="benutzername"> 
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
                                                                                            <label for="DasPwAg" class="col-2 col-form-label"> Passwort wiederholen</label>
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
                                                                    
                                                                                            <label for="login" class="col-2 col-form-label" > Benutzername oder E-Mailadresse </label>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script>      
          <script src="Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    


     <script type="text/javascript">
        $(document).ready( function() {



         $('.EMSK').on('click', function(){ 
          var popup = this.id;

         
          Name = this.id.split('W');

          console.log(Name);


         console.log(this.id);
          var formData = new FormData(); 
         

          formData.append("idVerkaeuferposition", Name['1']);
          formData.append("Aktion", Name['0']);

          if(Name['2']==0)
          {
           // nicht eingeloggt 
           alert("Bitte melden sie sich an, bevor Sie diese Aktion ausführen. Danke!");
          }
          else
          {

      

      var xhr = new XMLHttpRequest(); 

       xhr.open("POST", "Hilfsdokumente/AuswahlArtikel.php");
                          //xhr.setRequestHeader("Content-Type", "image/png");
               xhr.onload = function (oEvent) { 

                if(xhr.status == 200) {
                            console.log("Uploaded!");

                            console.log( xhr.responseText);
                            // Session
                            if(Name['0'] =='Einkaufswagen')
                           {var popup = document.getElementById("myPopup");
                           
                            popup.style.visibility = "visible";
                            pausieren() ;   
                          }
                            

                             if(Name['0'] =='Merken')
                            {
                              console.log("hallo");

                              if(document.getElementById("Farbe"+Name['1']) )
                              {
                               $("#Farbe"+Name['1']).css('color', 'red');

                               document.getElementById("Farbe"+Name['1']).id = "2Farbe"+Name['1'];
                              }
                              else
                              {

                                $("#2Farbe"+Name['1']).css('color', 'black');

                                document.getElementById("2Farbe"+Name['1']).id = "Farbe"+Name['1'];

                              }
                            }  
                            window.document.location.href = "/../Final/Kategorien/Warenkorb.php";
                         }                            
                         
        }; // schliesse onload
        xhr.send(formData);// ende for
      }


        });


      function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
      }

         async function pausieren() {
         
          await sleep(3000);        

          var popup = document.getElementById("myPopup");
          popup.style.visibility = "hidden";
      }


    var rr = new Array;
    var jj = -1;

   $('.innerContent').on('click', function(){ vorschau(this.id, this.name) });

      function vorschau(Bildpfad, Kategorie)
  {  

  
                                   

      if(Kategorie == 'Buecher')
      {

        rr[++jj] =  "<div id='lupen' style=' background-image: url("  +Bildpfad+ " ); '></div>";
                                         
        rr[++jj] =  " <img style='width:200px; height:250px; padding-left:20px;' id='Vorschaubild' class='media-object' src="+Bildpfad+" >";}
      
      else
      {

         rr[++jj] = ' <div id="lupen" style="margin-top:50px;margin-left:80px;background-image: url( '+Bildpfad+ ' );">';
                                       
          rr[++jj] = " <div id='lupe' ></div></div>";
                                          
       
        rr[++jj] =  "<img  id='Vorschaubild' class='media-object VorschaubildFormat ' src="+Bildpfad+" >";
      }

      $('#Vorschau').html(rr.join(''));

      jj = -1;  
  }

//Lupe

$(document).ready(function(){
$("#effekt").mousemove(function(Pos){
var bild = new Image();
bild.src = $("#Vorschaubild").attr("src");
var width = bild.width;
var height = bild.height;
var li = Pos.pageX - $(this).offset().left;
var ob = Pos.pageY - $(this).offset().top;
if ((li > 0 && li < $(this).width()) && (ob > 0 && ob < $(this).height())) {
$("#lupen").fadeIn("fast");
} else {
$("#lupen").fadeOut("slow");
}
if ($("#lupen") .is (":visible")) {
var pw = $("#lupen").width()/2;
var ph = $("#lupen").height()/2;
var px = li - pw;
var py = ob - ph;
var grw = Math.round(pw - li/$("#Vorschaubild").width() * width * 3.03);
var grh = Math.round(ph - ob/$("#Vorschaubild").height() * height * 3.03);
var pos = grw + "px " + grh + "px";
$("#lupen").css({left: px, top: py, backgroundPosition: pos});
} }) })




      });
 

</script>
</html>